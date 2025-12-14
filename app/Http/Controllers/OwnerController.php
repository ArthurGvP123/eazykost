<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\RentRequest;
use App\Models\KostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OwnerController extends Controller
{
    // =========================================================================
    // DASHBOARD & LISTING
    // =========================================================================

    /**
     * Menampilkan Dashboard Pemilik.
     * Memisahkan permintaan sewa menjadi 'Baru Masuk' (Pending) dan 'Arsip' (Contacted).
     */
    public function index()
    {
        $myKosts = Kost::where('user_id', Auth::id())->get();
        $kostIds = $myKosts->pluck('id');
        
        // 1. Ambil permintaan yang statusnya PENDING (Belum dihubungi)
        $incomingRequests = RentRequest::whereIn('kost_id', $kostIds)
                            ->where('status', 'pending')
                            ->with(['user', 'kost'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        // 2. Ambil permintaan yang statusnya CONTACTED (Sudah dihubungi / Arsip)
        $archivedRequests = RentRequest::whereIn('kost_id', $kostIds)
                            ->where('status', 'contacted')
                            ->with(['user', 'kost'])
                            ->orderBy('updated_at', 'desc') // Urutkan dari yang terakhir dihubungi
                            ->get();

        return view('owner.dashboard', compact('myKosts', 'incomingRequests', 'archivedRequests'));
    }

    // =========================================================================
    // MANAJEMEN REQUEST (KONTAK & ARSIP)
    // =========================================================================

    /**
     * Menandai calon penyewa sebagai 'sudah dihubungi' dan redirect ke WhatsApp.
     */
    public function markAsContacted($id)
    {
        // Cari request, pastikan milik salah satu kost owner ini (Security Check)
        $rentRequest = RentRequest::with(['user', 'kost'])->findOrFail($id);
        
        if ($rentRequest->kost->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke permintaan ini.');
        }

        // Update status jadi 'contacted' agar masuk ke Arsip
        $rentRequest->update(['status' => 'contacted']);

        // Siapkan Link WhatsApp
        // Mengubah format 08xx menjadi 628xx
        $phone = preg_replace('/^0/', '62', $rentRequest->user->phone); 
        
        // Pesan otomatis
        $text = urlencode("Halo {$rentRequest->user->name}, saya pemilik kost {$rentRequest->kost->name}. Saya melihat permintaan sewa Anda di Eazy Kost. Apakah masih berminat?");
        
        $waUrl = "https://wa.me/{$phone}?text={$text}";

        // Redirect user ke Link WA (Membuka tab baru biasanya diatur di view dengan target="_blank")
        return redirect()->away($waUrl);
    }

    // =========================================================================
    // CRUD KOST (CREATE, STORE, SHOW, UPDATE, DESTROY)
    // =========================================================================

    public function create()
    {
        return view('owner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_daily' => 'nullable|numeric|min:0',
            'price_monthly' => 'nullable|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'room_total' => 'required|integer|min:1',
            'location' => 'required|string',
            'address' => 'required|string',
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048' 
        ]);

        if (!$request->price_daily && !$request->price_monthly && !$request->price_yearly) {
            return back()->withErrors(['price_monthly' => 'Minimal salah satu jenis harga harus diisi!'])->withInput();
        }

        $kost = Kost::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(5),
            'description' => $validated['description'],
            'price_daily' => $validated['price_daily'],
            'price_monthly' => $validated['price_monthly'],
            'price_yearly' => $validated['price_yearly'],
            'room_total' => $validated['room_total'],
            'location' => $validated['location'],
            'address' => $validated['address'],
        ]);

        if ($request->hasFile('images')) {
            $order = 1;
            foreach ($request->file('images') as $image) {
                $path = $image->store('kost-images', 'public');
                KostImage::create([
                    'kost_id' => $kost->id,
                    'image_path' => $path,
                    'sort_order' => $order++,
                ]);
            }
        }

        return redirect()->route('owner.dashboard')->with('success', 'Kost berhasil ditambahkan');
    }

    public function show($id)
    {
        $kost = Kost::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $reports = \App\Models\Report::where('kost_id', $id)->with('user')->latest()->get();

        return view('owner.manage', compact('kost', 'reports'));
    }

    public function update(Request $request, $id)
    {
        $kost = Kost::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        // 1. Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_daily' => 'nullable|numeric|min:0',
            'price_monthly' => 'nullable|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'room_total' => 'required|integer|min:1',
            'location' => 'required|string',
            'address' => 'required|string',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // 2. Logic Smart Upload (Cek Slot)
        $currentCount = $kost->images()->count();
        $deleteCount = count($request->delete_images ?? []);
        $newCount = count($request->file('new_images') ?? []);
        $remainingSlots = 10 - ($currentCount - $deleteCount);

        $filesToUpload = $request->file('new_images') ?? [];
        
        if ($newCount > $remainingSlots) {
            $filesToUpload = array_slice($filesToUpload, 0, $remainingSlots);
        }

        if (($currentCount - $deleteCount + count($filesToUpload)) < 1) {
             return back()->withErrors(['new_images' => 'Kost harus memiliki minimal 1 foto.']);
        }

        // 3. Update Data Teks
        $kost->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price_daily' => $request->has('check_daily') ? $validated['price_daily'] : null,
            'price_monthly' => $request->has('check_monthly') ? $validated['price_monthly'] : null,
            'price_yearly' => $request->has('check_yearly') ? $validated['price_yearly'] : null,
            'room_total' => $validated['room_total'],
            'location' => $validated['location'],
            'address' => $validated['address'],
        ]);

        // 4. Hapus Gambar Lama
        if ($request->has('delete_images')) {
            $imagesToDelete = KostImage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $img) {
                if (Storage::disk('public')->exists($img->image_path)) {
                    Storage::disk('public')->delete($img->image_path);
                }
                $img->delete();
            }
        }

        // 5. Upload Gambar Baru
        foreach ($filesToUpload as $image) {
            $path = $image->store('kost-images', 'public');
            KostImage::create([
                'kost_id' => $kost->id,
                'image_path' => $path,
                'sort_order' => 999, // Taruh di belakang sementara
            ]);
        }

        // 6. Update Urutan Gambar (Sorting dari Frontend)
        if ($request->has('ordered_ids') && !empty($request->ordered_ids)) {
            $order = 1;
            $orderedIds = explode(',', $request->ordered_ids);
            
            foreach ($orderedIds as $imgId) {
                $imgModel = KostImage::where('kost_id', $kost->id)->where('id', $imgId)->first();
                if ($imgModel) {
                    $imgModel->update(['sort_order' => $order]);
                    $order++;
                }
            }
        }

        return back()->with('success', 'Data kost berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kost = Kost::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        // Hapus fisik gambar
        foreach ($kost->images as $img) {
             if (Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
        }

        // Hapus Data (Cascade)
        $kost->delete();

        return redirect()->route('owner.dashboard')->with('success', 'Kost berhasil dihapus secara permanen.');
    }
}
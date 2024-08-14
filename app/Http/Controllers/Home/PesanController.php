<?php

namespace App\Http\Controllers\Home;

use App\Models\Bank;
use App\Models\Pesan;
use App\Models\Route;
use App\Models\Tiket;
use App\Models\Payment;
use Barryvdh\DomPDF\PDF;
use App\Models\Kendaraan;
use App\Models\Penumpang;
use Illuminate\Http\Request;
use App\Models\DataKendaraan;
use App\Models\DataPenumpang;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function index()
    {
        $data['penumpangs'] = Penumpang::all();
        $data['kendaraans'] = Kendaraan::all();
        $data['routes'] = Route::all();
        $data['banks'] = Bank::all();
        $data['tikets'] = Tiket::all();
        $data['content'] = ['index'];
        return view('home.pesan.template', $data);
    }

    public function search(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'name' => 'nullable|array',
            'name.*' => 'exists:tikets,id',
            'start_point' => 'nullable|string',
            'end_point' => 'nullable|string',
            'created_at' => 'nullable|date',
            'penumpang_id' => 'nullable|exists:penumpangs,id',
            'kendaraan_id' => 'nullable|exists:kendaraans,id',
        ]);

        $names = $request->input('name', []);
        $penumpangId = $request->input('penumpang_id');
        $kendaraanId = $request->input('kendaraan_id');
        $startPoint = $request->input('start_point');
        $endPoint = $request->input('end_point');
        $createdAt = $request->input('created_at');

        $query = Route::query();

        // Filter berdasarkan start_point dan end_point jika tersedia
        if ($startPoint && $endPoint) {
            $query->where('start_point', 'like', '%' . $startPoint . '%')
                ->where('end_point', 'like', '%' . $endPoint . '%');
        }

        $data['routes'] = $query->get();

        $data['penumpangs'] = Penumpang::all();
        $data['kendaraans'] = Kendaraan::all();
        $data['banks'] = Bank::all();
        $data['content'] = ['cari'];

        // Kirim data hasil pencarian ke view
        return view('home.pesan.template', $data);
    }



    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'penumpang_id' => 'nullable|exists:penumpangs,id',
            'kendaraan_id' => 'nullable|exists:kendaraans,id',
            'jumlah_tiket' => 'required|integer',
            'total_harga' => 'required|numeric',
            'bank_id' => 'required|exists:banks,id',
        ]);

        $data = $request->only(['route_id', 'penumpang_id', 'kendaraan_id', 'jumlah_tiket', 'total_harga', 'bank_id']);
        $data['booking'] = now();
        $data['user_id'] = Auth::id();

        // Simpan data pemesanan sementara
        $pesan = Pesan::create($data);

        // Cek apakah penumpang atau kendaraan dipilih
        if ($request->filled('penumpang_id') && !$request->filled('kendaraan_id')) {
            // Jika hanya penumpang yang dipilih
            return redirect()->route('pesan.form.penumpang', ['id' => $pesan->id]);
        } elseif (!$request->filled('penumpang_id') && $request->filled('kendaraan_id')) {
            // Jika hanya kendaraan yang dipilih
            return redirect()->route('pesan.form.kendaraan', ['id' => $pesan->id]);
        } elseif ($request->filled('penumpang_id') && $request->filled('kendaraan_id')) {
            // Jika penumpang dan kendaraan dipilih
            return redirect()->route('pesan.form.both', ['id' => $pesan->id]);
        } else {
            // Jika tidak ada penumpang atau kendaraan yang dipilih
            return redirect()->route('pesan.index')->with('error', 'Tidak ada penumpang atau kendaraan yang dipilih.');
        }
    }


    public function getPrice($type, $id)
    {
        if ($type === 'penumpang') {
            $price = Penumpang::findOrFail($id)->price;
        } elseif ($type === 'kendaraan') {
            $price = Kendaraan::findOrFail($id)->price;
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }

        return response()->json(['price' => $price]);
    }


    public function formPenumpang($id)
    {
        // Ambil data pemesanan berdasarkan ID
        $pesan = Pesan::find($id);

        // Validasi jika data tidak ditemukan
        if (!$pesan) {
            return redirect()->route('pesan.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Ambil data penumpang
        $data['penumpangs'] = Penumpang::all();
        $data['pesan'] = $pesan;
        $data['jumlah_tiket'] = $pesan->jumlah_tiket;
        $data['content'] = ['penumpang'];

        // Pass data ke view
        return view('home.pesan.template', $data);
    }

    public function formKendaraan($id)
    {
        // Ambil data pemesanan berdasarkan ID
        $pesan = Pesan::find($id);

        // Validasi jika data tidak ditemukan
        if (!$pesan) {
            return redirect()->route('pesan.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Ambil data kendaraan
        $data['kendaraans'] = Kendaraan::all();
        $data['pesan'] = $pesan;
        $data['jumlah_tiket'] = $pesan->jumlah_tiket;
        $data['content'] = ['kendaraan'];

        // Pass data ke view
        return view('home.pesan.template', $data);
    }

    public function formBoth($id)
    {
        // Ambil data pemesanan berdasarkan ID
        $pesan = Pesan::find($id);

        // Validasi jika data tidak ditemukan
        if (!$pesan) {
            return redirect()->route('pesan.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Ambil data kendaraan dan penumpang
        $data['kendaraans'] = Kendaraan::all();
        $data['penumpangs'] = Penumpang::all();
        $data['pesan'] = $pesan;
        $data['jumlah_tiket'] = $pesan->jumlah_tiket;
        $data['content'] = ['formboth'];

        // Pass data ke view
        return view('home.pesan.template', $data);
    }

    public function storePenumpang(Request $request, $id)
    {
        // Validasi input dari request
        $request->validate([
            'jumlah_tiket' => 'required|integer',
            'route_id' => 'required|exists:routes,id',
            'penumpangs.*.name' => 'required|string',
            'penumpangs.*.email' => 'required|email',
            'penumpangs.*.kendaraan_id' => 'nullable|exists:kendaraans,id',
        ]);

        $pesan = Pesan::find($id);
        if (!$pesan) {
            return redirect()->route('pesan.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        foreach ($request->input('penumpangs') as $penumpang) {
            DataPenumpang::create([
                'name' => $penumpang['name'],
                'email' => $penumpang['email'],
                'pesan_id' => $pesan->id,
                'kendaraan_id' => $penumpang['kendaraan_id'] ?? null,
            ]);
        }

        return redirect()->route('payment.index', ['id' => $pesan->id])
            ->with('success', 'Pesanan berhasil disimpan. Silakan lanjutkan ke pembayaran.');
    }


    public function storeKendaraan(Request $request, $id)
    {
        // Validasi input dari request
        $request->validate([
            'jumlah_tiket' => 'required|integer',
            'route_id' => 'required|exists:routes,id',
            'kendaraans.*.kendaraan_id' => 'nullable|exists:kendaraans,id',
            'kendaraans.*.plat' => 'required|string',
        ]);

        $pesan = Pesan::find($id);
        if (!$pesan) {
            return redirect()->route('pesan.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Simpan data kendaraan
        foreach ($request->input('kendaraans') as $kendaraan) {
            DataKendaraan::create([
                'plat' => $kendaraan['plat'],
                'pesan_id' => $pesan->id,
                'kendaraan_id' => $kendaraan['kendaraan_id'] ?? null,
            ]);
        }

        return redirect()->route('payment.index', ['id' => $pesan->id])
        ->with('success', 'Pesanan berhasil disimpan. Silakan lanjutkan ke pembayaran.');
    }


    public function storeBoth(Request $request, $id)
    {
        // Validasi input dari request
        $request->validate([
            'jumlah_tiket' => 'required|integer',
            'route_id' => 'required|exists:routes,id',
            'penumpangs.*.penumpang_id' => 'nullable|exists:penumpangs,id',
            'penumpangs.*.name' => 'required|string',
            'penumpangs.*.email' => 'required|email',
            'kendaraans.*.kendaraan_id' => 'nullable|exists:kendaraans,id',
            'kendaraans.*.plat' => 'required|string',
        ]);

        $pesan = Pesan::find($id);
        if (!$pesan) {
            return redirect()->route('pesan.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Simpan data penumpang
        foreach ($request->input('penumpangs') as $penumpang) {
            DataPenumpang::create([
                'name' => $penumpang['name'],
                'email' => $penumpang['email'],
                'pesan_id' => $pesan->id,
                'kendaraan_id' => $penumpang['kendaraan_id'] ?? null,
            ]);
        }

        // Simpan data kendaraan
        foreach ($request->input('kendaraans') as $kendaraan) {
            DataKendaraan::create([
                'plat' => $kendaraan['plat'],
                'pesan_id' => $pesan->id,
                'kendaraan_id' => $kendaraan['kendaraan_id'] ?? null,
            ]);
        }

        return redirect()->route('payment.index', ['id' => $pesan->id])
            ->with('success', 'Pesanan berhasil disimpan. Silakan lanjutkan ke pembayaran.');
    }




    public function save(Request $request)
    {
        // Validasi input
        $request->validate([
            'pesan_id' => 'required|exists:pesans,id',
            'names.*' => 'required|string',
            'emails.*' => 'required|email',
            'kendaraan' => 'nullable|string', // Validasi untuk kendaraan baru
        ]);

        // Ambil data pemesanan
        $pesan = Pesan::find($request->input('pesan_id'));

        // Validasi jika data tidak ditemukan
        if (!$pesan) {
            return redirect()->route('pesan.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Jika ada input kendaraan, simpan atau buat entri kendaraan baru
        $kendaraanId = null;
        $kendaraanInput = $request->input('kendaraan');
        if ($kendaraanInput) {
            // Cek jika kendaraan sudah ada
            $kendaraan = Kendaraan::firstOrCreate(['nama' => $kendaraanInput]);
            $kendaraanId = $kendaraan->id;
        }

        // Simpan data untuk tiket pertama
        $pesan->name = $request->input('names')[0];
        $pesan->email = $request->input('emails')[0];
        $pesan->save();

        // Jika ada lebih dari satu tiket, buat entri tambahan
        for ($i = 1; $i < count($request->input('names')); $i++) {
            Pesan::create([
                'name' => $request->input('names')[$i],
                'email' => $request->input('emails')[$i],
                'booking' => $pesan->booking,
                'penumpang_id' => $pesan->penumpang_id,
                'kendaraan_id' =>  $pesan->penumpang_id,
                'route_id' => $pesan->route_id,
                'bank_id' => $pesan->bank_id,
                'jumlah_tiket' => 1, // Set 1 untuk setiap tiket
                'total_harga' => $pesan->total_harga, // Total harga bisa diatur sesuai kebutuhan
            ]);
        }

        // Redirect ke halaman pembayaran setelah menyimpan
        return redirect()->route('payment.index', ['id' => $pesan->id])->with('success', 'Pesanan berhasil disimpan. Silakan lanjutkan ke pembayaran.');
    }

    public function history()
    {
         // Mendapatkan ID pengguna yang sedang login
         $userId = Auth::id();

         // Mengambil daftar pesanan milik pengguna yang sedang login
         $pesans = Pesan::where('user_id', $userId)
             ->with('route', 'penumpang', 'kendaraan', 'dataKendaraan', 'dataPenumpang', 'bank', 'payments') // Muat relasi yang dibutuhkan
             ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal pembuatan
             ->get();
 
         // Mengirim data ke view
        return view('home.pesan.history', compact('pesans'));
    }


    public function show($id)
    {
        // Mengambil data pesanan dengan semua relasi yang diperlukan
        $pesan = Pesan::with('user', 'penumpang', 'kendaraan', 'dataKendaraan', 'dataPenumpang', 'route', 'bank')
            ->find($id);


            $payments = $pesan ? $pesan->payments : collect();
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengecek apakah pesanan milik pengguna yang sedang login
        if (!$pesan || $pesan->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }
        $data['payments'] = $payments;
        $data['pesan'] = $pesan;
        $data['dataKendaraans'] =  $pesan->dataKendaraans ?? [];
        $data['dataPenumpangs'] = $pesan->dataPenumpangs ?? [];
        $data['route'] = $pesan->route;
        $data['bank'] = $pesan->bank;
        $data['content'] = ['show'];
        // dd($data);
        // Mengirim data ke view
        return view('home.pesan.template', $data);
    }




    public function printTicket($id)
    {
        $pesan = Pesan::with('payments','user', 'penumpang', 'kendaraan', 'dataKendaraan', 'dataPenumpang', 'route', 'bank')
        ->find($id);
        // dd($pesan);
        // Generate PDF or handle ticket printing logic
        $pdf = $this->pdf->loadView('home.pesan.print', ['pesan' => $pesan]);

        return $pdf->stream('tiket-' . $pesan->id . '.pdf'); // For downloading the PDF
    }
}

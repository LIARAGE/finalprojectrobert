<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Faktur;
use App\Models\FakturDetail;
use Barryvdh\DomPDF\Facade\Pdf;

class FakturController extends Controller
{
    // Tambahkan barang ke keranjang (session)
    public function tambahKeranjang($id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['qty'] += 1;
        } else {
            $keranjang[$id] = [
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'qty' => 1
            ];
        }

        session(['keranjang' => $keranjang]);

        return redirect()->route('barang.user')->with('success', 'Barang ditambahkan ke faktur!');
    }

    // Tampilkan isi keranjang & form input faktur
    public function tampilFaktur()
    {
        $keranjang = session('keranjang', []);
        $total = 0;

        foreach ($keranjang as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        return view('faktur.index', compact('keranjang', 'total'));
    }

    // Simpan faktur ke database
    public function simpanFaktur(Request $request)
    {
        $request->validate([
            'alamat' => 'required|min:10|max:100',
            'kode_pos' => 'required|digits:5',
        ]);

        $keranjang = session('keranjang', []);
        if (empty($keranjang)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        $faktur = Faktur::create([
            'nomor_invoice' => strtoupper('INV' . now()->format('YmdHis')),
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'total_harga' => $total,
        ]);

        foreach ($keranjang as $item) {
            FakturDetail::create([
                'faktur_id' => $faktur->id,
                'nama_barang' => $item['nama'],
                'harga' => $item['harga'],
                'qty' => $item['qty'],
                'subtotal' => $item['harga'] * $item['qty'],
            ]);
        }

        session()->forget('keranjang');

        // Kirim data faktur ke tampilan agar bisa cetak PDF
        return view('faktur.index', [
            'keranjang' => [],
            'total' => 0,
            'faktur' => $faktur,
        ])->with('success', 'Faktur berhasil disimpan dengan nomor: ' . $faktur->nomor_invoice);
    }

    // Cetak PDF faktur
    public function cetakFaktur($id)
    {
        $faktur = Faktur::with('details')->findOrFail($id);

        $pdf = Pdf::loadView('faktur.pdf', compact('faktur'));
        return $pdf->download('faktur_' . $faktur->nomor_invoice . '.pdf');
    }
}

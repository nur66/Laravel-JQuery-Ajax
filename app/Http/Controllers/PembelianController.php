<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    // user interface
    public function pembelian()
    {
        if (Auth::user()) {
            $data = [];
            $total_pembelian = $total_penjualan = 0;
            $penjualan = Penjualan::with('barang')->get();
            $barang = Barang::get();
            $pembelian = Pembelian::with('barang')->get();

            if (count($pembelian) > 0) foreach ($pembelian as $row) $total_pembelian += $row->qty;
            if (count($penjualan) > 0) foreach ($penjualan as $row) $total_penjualan += $row->qty;

            $best_seller = "SELECT barang_id, SUM(qty) AS biggest FROM penjualans GROUP BY barang_id ORDER BY biggest DESC";
            $best_seller = DB::select($best_seller);

            if (count($best_seller) > 0) {
                $best_seller_barang = Barang::where('id', $best_seller[0]->barang_id)->first();
                // $best_seller = $best_seller[0]->nama;
                $best_seller_barang = $best_seller_barang['nama'];
            } else {
                $best_seller_barang = 'Empty';
            }

            $data = [
                'pembelian' => $pembelian,
                'barang' => $barang,
                'total_pembelian' => $total_pembelian,
                'total_penjualan' => $total_penjualan,
                'selisih' => $total_pembelian - $total_penjualan,
                'best_seller' => $best_seller_barang
            ];

            return view('pembelian.master-pembelian')->with('data', $data);;
        }else{
            return redirect('/');
        }
    }

    public function addPembelian()
    {
        $data = [];
        $pembelian = Pembelian::with('barang')->get();
        $barang = Barang::get();

        $data = [
            'pembelian' => $pembelian,
            'barang' => $barang
        ];

        return view('pembelian.master-add-pembelian')->with('data', $data);
    }

    public function editPembelian(Request $request)
    {
        $data = [];
        $pembelian = Pembelian::with('barang')->where('id', $request->id)->get();
        $barang = Barang::get();

        $data = [
            'pembelian' => $pembelian,
            'barang' => $barang
        ];

        return view('pembelian.master-edit-pembelian')->with('data', $data);
    }


    // api 
    public function post_pembelian(Request $request)
    {
        if (Auth::user()) {

            Pembelian::create([
                'nomor_nota' => $request->nomor_nota,
                'barang_id' => $request->barang,
                'qty' => $request->qty,
                'tanggal_pembelian' => $request->tanggal_penjualan
            ]);

            return redirect('/pembelian');
        } else {
            return redirect('/');
        }
    }

    public function update_pembelian(Request $request)
    {
        if (Auth::user()) {

            Pembelian::where('id', $request->id)->update([
                'nomor_nota' => $request->nomor_nota,
                'barang_id' => $request->barang,
                'qty' => $request->qty,
                'tanggal_pembelian' => $request->tanggal_penjualan
            ]);

            return redirect('/pembelian');
        } else {
            return redirect('/');
        }
    }

    public function delete_pembelian(Request $request)
    {
        if (Auth::user()) {
            Pembelian::where('id', $request->id)->delete();

            return redirect('/pembelian');
        } else {
            return redirect('/');
        }
    }
}

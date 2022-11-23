<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class PenjualanController extends Controller
{
    // user interface
    public function penjualan()
    {
        if(Auth::user()){
            $data = [];
            $total_pembelian = $total_penjualan = 0;
            $penjualan = Penjualan::with('barang')->get();
            $barang = Barang::get();
            $pembelian = Pembelian::get('qty');
    
            if (count($pembelian) > 0) foreach ($pembelian as $row) $total_pembelian += $row->qty;
            if (count($penjualan) > 0) foreach ($penjualan as $row) $total_penjualan += $row->qty;
    
            $best_seller = "SELECT barang_id, SUM(qty) AS biggest FROM penjualans GROUP BY barang_id ORDER BY biggest DESC";
            $best_seller = DB::select($best_seller);
            
            if(count($best_seller) > 0){
                $best_seller_barang = Barang::where('id', $best_seller[0]->barang_id)->first();
                // $best_seller = $best_seller[0]->nama;
                $best_seller_barang = $best_seller_barang['nama'];
            }else{
                $best_seller_barang = 'Empty';
            }
    
            $data = [
                'penjualan' => $penjualan,
                'barang' => $barang,
                'total_pembelian' => $total_pembelian,
                'total_penjualan' => $total_penjualan,
                'selisih' => $total_pembelian - $total_penjualan,
                'best_seller' => $best_seller_barang
            ];
    
            return view('penjualan.master-penjualan')->with('data', $data);;
        }else{
            return redirect('/');
        }
    }

    public function addPenjualan()
    {
        $data = [];
        $penjualan = Penjualan::with('barang')->get();
        $barang = Barang::get();

        $data = [
            'penjualan' => $penjualan,
            'barang' => $barang
        ];

        return view('penjualan.master-add-penjualan')->with('data', $data);
    }

    public function editPenjualan(Request $request)
    {
        $data = [];
        $penjualan = Penjualan::with('barang')->where('id', $request->id)->get();
        $barang = Barang::get();

        $data = [
            'penjualan' => $penjualan,
            'barang' => $barang
        ];

        return view('penjualan.master-edit-penjualan')->with('data', $data);
    }


    // api 
    public function post_penjualan(Request $request)
    {
        if(Auth::user()){
    
            Penjualan::create([
                'nomor_nota' => $request->nomor_nota,
                'barang_id' => $request->barang,
                'qty' => $request->qty,
                'tanggal_pembelian' => $request->tanggal_penjualan
            ]);

            return redirect('/penjualan');
        } else {
            return redirect('/');
        }
    }

    public function update_penjualan(Request $request)
    {
        if(Auth::user()){

            Penjualan::where('id', $request->id)->update([
                'nomor_nota' => $request->nomor_nota,
                'barang_id' => $request->barang,
                'qty' => $request->qty,
                'tanggal_pembelian' => $request->tanggal_penjualan
            ]);

            return redirect('/penjualan');
        } else {
            return redirect('/');
        }
    }

    public function delete_penjualan(Request $request){
        if(Auth::user()){
            Penjualan::where('id',$request->id)->delete();

            return redirect('/penjualan');
        } else {
            return redirect('/');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = [];
        $barang = Barang::get();
        foreach($barang as $row){
            if(count($row->penjualan) > 0){
                $qty_penjualan = 0;
                foreach($row->penjualan as $s){
                    $qty_penjualan = $s->qty;
                }
                $row['qty'] = $row->saldo_awal - $qty_penjualan;
            } 
            elseif(count($row->pembelian) > 0){
                $qty_pembelian = 0;
                foreach($row->pembelian as $t){
                    $qty_pembelian = $t->qty;
                }
                $row['qty'] = $row->saldo_awal + $qty_pembelian;  
            } 
            elseif(count($row->penjualan) > 0 && count($row->pembelian) > 0){
                // pembelian
                $qty_pembelian = 0;
                foreach($row->pembelian as $t){
                    $qty_pembelian = $t->qty;
                }

                // penjualan
                $qty_penjualan = 0;
                foreach($row->penjualan as $s){
                    $qty_penjualan = $s->qty;
                }

                $row['qty'] = $row->saldo_awal + $qty_pembelian - $qty_penjualan;
            } 
            else $row['qty'] = $row->saldo_awal;
        }
        
        // jika dibawah 100 maka akan di unset
        foreach($barang as $key => $val)
        {
            if($val->qty <= 100){
                unset($barang[$key]);
            }
        }

        // Menampilkan 3 saja
        // if(count($barang)){
        //     if(count($barang) >= 3){
        //         for($i = 0; $i <= 3; $i++){
        //             $barang[$i] = $barang;
        //         }
        //     }
        // }
        // dd($barang);

        $pembelian = Pembelian::with('barang')->limit(5)->orderBy('tanggal_pembelian', 'desc')->get();
        $penjualan = Penjualan::with('barang')->limit(5)->orderBy('tanggal_pembelian', 'desc')->get();

        $arrBarang = Barang::get();

        // dd($barang);

        $data = [
            'barang' => $barang,
            'pembelian' => $pembelian,
            'penjualan' => $penjualan,
            'arrBarang' => $arrBarang
        ];
        return view('content.landing-page')->with('data', $data);
    }
}

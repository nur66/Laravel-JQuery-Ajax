<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LokasiController extends Controller
{
    public function index()
    {
        $data = [];
        $total_pembelian = $total_penjualan = 0;

        $lokasi = Lokasi::get();
        $pembelian = Pembelian::get('qty');
        $penjualan = Penjualan::get('qty');

        if (count($pembelian) > 0) foreach ($pembelian as $row) $total_pembelian += $row->qty;
        if (count($penjualan) > 0) foreach ($penjualan as $row) $total_penjualan += $row->qty;

        $best_seller = "SELECT nama FROM barangs WHERE id IN (SELECT barang_id FROM penjualans GROUP BY barang_id ORDER BY COUNT(barang_id) DESC) LIMIT 1";
        $best_seller = DB::select($best_seller);
        if(count($best_seller) > 0){
            $best_seller = $best_seller[0]->nama_barang;
        }else{
            $best_seller = null;
        }

        $data = [
            'lokasi' => $lokasi,
            'total_pembelian' => $total_pembelian,
            'total_penjualan' => $total_penjualan,
            'selisih' => $total_pembelian - $total_penjualan,
            'best_seller' => $best_seller
        ];

        return view('lokasi.master-lokasi')->with('data', $data);
    }

    public function addLokasi() 
    {
        return view('lokasi.master-add-lokasi');
    }

    public function editLokasi(Request $request)
    {
        $data = [];
        $lokasi = Lokasi::where('id', $request->id)->get();

        $data = [
            'lokasi' => $lokasi
        ];
        // dd($data);

        return view('lokasi.master-edit-lokasi')->with('data', $data);
    }


    // api
    public function post_lokasi(Request $request)
    {
        if (Auth::user()) {
            $this->validate($request, [
                'gambar' => 'required | image | mimes:jpg,jpeg,png,svg,gif | max:20000000'
            ]);

            $foto = $request->file('gambar');
            $foto_name = $foto->getClientOriginalName();
            $save_foto = time().$foto_name;
            $foto->move(('image'), $save_foto);

            Lokasi::create([
                'lokasi' => $request->lokasi,
                'gambar' => $save_foto
            ]);

            return redirect('/lokasi');
        } else {
            return redirect('/');
        }
    }

    public function update_lokasi(Request $request)
    {
        if (Auth::user()) {

            if($request->gambar != null){
                File::delete('image/' . $request->gambar);

                $this->validate($request, [
                    'gambar' => 'required | image | mimes:jpg,jpeg,png,svg,gif | max:20000000'
                ]);
    
                $foto = $request->file('gambar');
                $foto_name = $foto->getClientOriginalName();
                $save_foto = time().$foto_name;
                $foto->move(('image'), $save_foto);

                Lokasi::where('id', $request->id)->update([
                    'lokasi' => $request->lokasi,
                    'gambar' => $save_foto
                ]);
            }else{
                Lokasi::where('id', $request->id)->update([
                    'lokasi' => $request->lokasi,
                    'gambar' => $request->gambar
                ]);
            }

            return redirect('/lokasi');
        } else {
            return redirect('/');
        }
    }

    public function delete_lokasi(Request $request)
    {
        if (Auth::user()) {
            Lokasi::where('id', $request->id)->delete();

            return redirect('/lokasi');
        } else {
            return redirect('/');
        }
    }
}

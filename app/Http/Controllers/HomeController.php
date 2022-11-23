<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = [];
        $total_pembelian = $total_penjualan = 0;

        if ($request->has('search')){
            if($request->search != '' || $request->search != null){
                $barang = Barang::with(['penjualan', 'pembelian'])->where('nama', 'LIKE', '%' . $request->search . '%')->get();  
            } else {
                $barang = Barang::with(['penjualan', 'pembelian'])->get();
            }
        } else $barang = Barang::with(['penjualan', 'pembelian'])->get();

        $pembelian = Pembelian::get('qty');
        $penjualan = Penjualan::get('qty');

        if (count($pembelian) > 0) foreach ($pembelian as $row) $total_pembelian += $row->qty;
        if (count($penjualan) > 0) foreach ($penjualan as $row) $total_penjualan += $row->qty;

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

        $data = [
            'barang' => $barang,
            'pembelian' => $total_pembelian,
            'penjualan' => $total_penjualan,
            'selisih' => $total_pembelian - $total_penjualan,
            // 'best_seller' => $best_seller_barang
        ];

        return view('barang.master-barang')->with('data', $data);
    }

    public function addBarang() 
    {
        $data = [];
        $lokasi = Lokasi::all();
        
        $data = [
            'lokasi' => $lokasi
        ];
        return view('barang.master-add-barang')->with('data', $data);
    }

    public function editBarang(Request $request)
    {
        $data = [];
        $barang = Barang::where('id', $request->id)->get();
        $lokasi = Lokasi::get();

        $data = [
            'barang' => $barang,
            'lokasi' => $lokasi
        ];

        return view('barang.master-edit-barang')->with('data', $data);
    }


    // api
    public function post_barang(Request $request)
    {
        if (Auth::user()) {
            $this->validate($request, [
                'gambar' => 'required | image | mimes:jpg,jpeg,png,svg,gif | max:20000000'
            ]);

            $foto = $request->file('gambar');
            $foto_name = $foto->getClientOriginalName();
            $save_foto = time().$foto_name;
            $foto->move(('image'), $save_foto);

            Barang::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'saldo_awal' => $request->saldo_awal,
                'lokasi' => $request->lokasi,
                'gambar' => $save_foto
            ]);

            return redirect('/home');
        } else {
            return redirect('/');
        }
    }

    public function update_barang(Request $request)
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

                Barang::where('id', $request->id)->update([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'saldo_awal' => $request->saldo_awal,
                    'lokasi' => $request->lokasi,
                    'gambar' => $request->gambar
                ]);
            }else{
                Barang::where('id', $request->id)->update([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'saldo_awal' => $request->saldo_awal,
                    'lokasi' => $request->lokasi,
                    'gambar' => $request->gambar
                ]);
            }

            return redirect('/home');
        } else {
            return redirect('/');
        }
    }

    public function delete_barang(Request $request)
    {
        if (Auth::user()) {
            Barang::where('id', $request->id)->delete();

            return redirect('/home');
        } else {
            return redirect('/');
        }
    }

    public function get_barang_pembelian()
    {
        $data = [];
        $pembelian = Pembelian::with('barang')->orderBy('tanggal_pembelian', 'desc')->get();

        $sumGroup = "SELECT 
        b.id,
        b.nama,
        SUM(p.qty) AS quantity
        FROM barangs b
        LEFT JOIN pembelians p ON p.barang_id = b.id
        GROUP BY b.id, b.nama
        HAVING quantity != NULL OR quantity != 0
        ";
        $sumGroup = DB::select($sumGroup);
        
        $data = [
            'pembelian' => $pembelian,
            'sumGroup' => $sumGroup
        ];

        return view('content.barang-pembelian')->with('data', $data);
    }

    public function get_barang_penjualan()
    {
        $data = [];
        $penjualan = Penjualan::with('barang')->orderBy('tanggal_pembelian', 'desc')->get();

        $sumGroup = "SELECT 
        b.id,
        b.nama,
        SUM(p.qty) AS quantity
        FROM barangs b
        LEFT JOIN penjualans p ON p.barang_id = b.id
        GROUP BY b.id, b.nama
        HAVING quantity != NULL OR quantity != 0
        ";
        $sumGroup = DB::select($sumGroup);
        
        $data = [
            'penjualan' => $penjualan,
            'sumGroup' => $sumGroup
        ];

        return view('content.barang-penjualan')->with('data', $data);
    }

    public function get_kartu_stok()
    {
        $data = [];
        $barang = Barang::with(['penjualan', 'pembelian'])->get();

        foreach($barang as $row){
            if(count($row->penjualan) > 0 && count($row->pembelian) <= 0){
                $qty_penjualan = 0;
                foreach($row->penjualan as $s){
                    $qty_penjualan = $s->qty;
                }
                $row['penjualan'] = $qty_penjualan;
                $row['pembelian'] = 0;
                $row['qty'] = $row->saldo_awal - $qty_penjualan;
            } 
            elseif(count($row->pembelian) > 0 && count($row->penjualan) <= 0){
                $qty_pembelian = 0;
                foreach($row->pembelian as $t){
                    $qty_pembelian = $t->qty;
                }
                $row['pembelian'] = $qty_pembelian;
                $row['penjualan'] = 0;
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

                $row['pembelian'] = $qty_pembelian;
                $row['penjualan'] = $qty_penjualan;
                $row['qty'] = $row->saldo_awal + $qty_pembelian - $qty_penjualan;
            } 
            else {
                $row['pembelian'] = 0;
                $row['penjualan'] = 0;
                $row['qty'] = $row->saldo_awal;
            }
        }

        

        $data = [
            'barang' => $barang
        ];

        return view('content.kartu-stok')->with('data', $data);
    }
}

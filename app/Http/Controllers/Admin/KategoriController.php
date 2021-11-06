<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use DNS1D;

class KategoriController extends Controller
{
    public function index(){
        // echo  DNS1D::getBarcodeHTML('12345', 'CODABAR') ;
        // die;
        // DB::select("DELETE FROM penjualan");
        // DB::select("DELETE FROM detail_penjualan");
        $data['kategori'] = Kategori::all();
        return view('pages.admin.kategori.index', $data);
    }

    public function create(){
        return view('pages.admin.kategori.create');
    }

    public function store(Request $request){

        $kd_terakhir = DB::select("SELECT * FROM `kategori` ORDER BY kd_kategori DESC LIMIT 1");

        // dd($kd_terakhir);

        if(empty($kd_terakhir)){
            $kd_kategori = '001';
        }else{
            $kd_kategori = sprintf('%03d', $kd_terakhir[0]->kd_kategori+1);
        }

        // dd($kd_kategori);

        $data = [
            'kd_kategori' => $kd_kategori,
            'nama_kategori' => $request->nama_kategori
        ];

        Kategori::create($data);

        return redirect('/admin/kategori');
    }

    public function edit($kd_kategori){
        $data['kategori'] = Kategori::where('kd_kategori',$kd_kategori)->first();
        return view('pages.admin.kategori.edit',$data);
    }

    public function update(Request $request, $kd_kategori){
        $data = [
            'nama_kategori' => $request->nama_kategori
        ];

        Kategori::where('kd_kategori', $kd_kategori)->update($data);

        return redirect('/admin/kategori');
    }

    public function destroy($kd_kategori){
        Kategori::where('kd_kategori', $kd_kategori)->delete();

        return redirect('/admin/kategori');
    }
}

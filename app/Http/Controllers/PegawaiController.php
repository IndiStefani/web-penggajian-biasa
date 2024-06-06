<?php

namespace App\Http\Controllers;

use App\Models\Devisi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {    
        // $data = Pegawai::with('devisi');
        $pegawai = Pegawai::all();
        $devisi = Devisi::all();
        // return view('data_pegawai', compact('pegawai'));
        // $pegawai = Pegawai::with('devisis');
        // return view('data_pegawai', compact('pegawais'));
        // $pegawai = Pegawai::with('devisi');

        // Mengembalikan view dengan data pegawais
        return view('pegawai.index', compact('pegawai', 'devisi'));
    }

    public function tambahpegawai(){
        return view('tambah_datapegawai');
    }

    public function insertdata_pegawai(Request $request){
        Pegawai::create($request->all());
        return redirect()->route('pegawai')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function tampilkandata_pegawai($id){
        $data = Pegawai::find($id);
            return view('pegawai.tampil_datapegawai', compact('data'));
        
    }

    public function updatedata_pegawai(Request $request, $id){
        $data = Pegawai::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('sukses', 'Data Berhasil Diupdate');
    }
    public function deletedata_pegawai($id){
        $data = Pegawai::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('sukses', 'Data Berhasil Dihapus');
    }
    
    public function show($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return redirect()->route('show')->with('error', 'Pegawai tidak ditemukan');
        }

        return view('pegawai.detail_datapegawai', compact('pegawai'));
    }

    
}
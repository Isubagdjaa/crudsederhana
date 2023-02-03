<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Datasample;

class CDatasiswa extends Controller
{
    public function index()
    {
    $datasiswa = Datasample::latest()->paginate(5);

        //render view with posts
        return view('datasiswa.index', compact('datasiswa'));
    }

    public function create()
    {
        return view('datasiswa.tambahdata');
    }

    //tambah data
    public function store(Request $request)
    {
        //validasi form
        $this->validate($request, [
            'nama_siswa'    => 'required|min:5',
            'email_siswa'   => 'required|min:5',
            'alamat'        => 'required|min:10'
        ]);


        //input data ke db
        Datasample::create([
            'nama_siswa'      => $request->nama_siswa,
            'email_siswa'     => $request->email_siswa,
            'alamat'          => $request->alamat
        ]);

        //redirect to index
        return redirect()->route('datasiswa.index')->with(['success' => 'Berhasil Tambah Data Siswa']);
    }

    //menuju form edit data siswa
    public function edit(Datasample $datasiswa)
    {
        return view('datasiswa.editsiswa', compact('datasiswa'));
    }

    public function update(Request $request, Datasample $datasiswa)
    {
        
        $this->validate($request, [
            'nama_siswa'        => 'required|min:5',
            'email_siswa'       => 'required|min:5',
            'alamat'            => 'required|min:10'
        ]);

        $datasiswa->update([
            'nama_siswa'      => $request->nama_siswa,
            'email_siswa'     => $request->email_siswa,
            'alamat'          => $request->alamat
        ]);
                
        return redirect()->route('datasiswa.index')->with(['success' => 'Data Siswa Berhasil Diperbaharui!']);
    }

    public function destroy(Datasample $datasiswa)
    {
        //query hapus
        $datasiswa->delete();

        return redirect()->route('datasiswa.index')->with(['success' => 'Data Siswa Berhasil Dihapus!']);
    }


}

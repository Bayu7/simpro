<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = Pegawai::where('nama', 'LIKE', '%' . $request->cari . "%")->paginate(7);
        } else {
            $data = Pegawai::paginate(7);
        }
        return view('pegawai/data_pegawai', compact('data'));
    }

    public function tambah_pegawai()
    {
        return view('pegawai/tambah_pegawai');
    }

    public function proses_insert_pegawai(Request $request)
    {
        $data = Pegawai::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Tambahkan!');
    }

    public function edit_pegawai($id)
    {
        $data = Pegawai::find($id);
        // dd($data);
        return view('pegawai/edit_pegawai', compact('data'));
    }

    public function proses_edit_pegawai(Request $request, $id)
    {
        $data = Pegawai::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Update!');
    }

    public function delete_pegawai($id)
    {
        $data = Pegawai::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Hapus!');
    }

    public function exportpdf_pegawai()
    {
        $data = Pegawai::all();
        view()->share('data', $data);
        $pdf = Pdf::loadview('pegawai/datapegawaipdf');
        return $pdf->download('datapegawai.pdf');
    }
}

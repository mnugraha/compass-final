<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Peran;
use App\Models\Kompetensi_en;
use App\Models\Peran_en;
use App\Models\Level;
use App\Models\Nilai_en;
use App\Models\Struktur_en;
use Illuminate\Support\Facades\Hash;

class BackendController_en extends Controller
{
    public function kompetensi_en()
    {
        $dataKompetensi = Kompetensi_en::all();
        return view('backend/kompetensi_en', ['dataKompetensi' => $dataKompetensi]);
    }

    public function kompetensiSimpan_en(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_kompetensi' => 'required|unique:kompetensi'
        ], $pesan_error);

        Kompetensi_en::create([
            'id_kompetensi' => $a->id_kompetensi,
            'nm_kompetensi' => $a->kompetensi,
            'value' => $a->value,
            'definisi' => $a->definisi
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dkompetensi_en');
    }

    public function kompetensiUpdate_en($x, Request $a)
    {
        Kompetensi_en::where('id_kompetensi', $x)->update([
            'nm_kompetensi' => $a->kompetensi,
            'value' => $a->value,
            'definisi' => $a->definisi
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dkompetensi_en');
    }

    public function kompetensiDelete_en($x)
    {
        $data = Kompetensi_en::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dkompetensi_en');
    }

    public function value_en()
    {
        //$dataValue = Nilai::all();
        $dataValue = Nilai_en::join('struktur_en', 'nilai_en.id_struktur', '=', 'struktur_en.id_struktur')
            ->join('kompetensi_en', 'nilai_en.id_kompetensi', '=', 'kompetensi_en.id_kompetensi')
            ->get(['nilai_en.*', 'struktur_en.*', 'kompetensi_en.*']);
        $dataStruktur = Struktur_en::all();
        $dataKompetensi = Kompetensi_en::all();
        return view('backend/value_en', ['dataValue' => $dataValue, 'dataStruktur' => $dataStruktur, 'dataKompetensi' => $dataKompetensi]);
    }

    public function valueSimpan_en(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_value' => 'required'
        ], $pesan_error);

        Nilai_en::create([
            'id_nilai' => $a->id_value,
            'id_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi,
            'deskripsi' => $a->deskripsi
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dvalue_en');
    }

    public function valueUpdate_en($x, Request $a)
    {
        Nilai_en::where('id_nilai', $x)->update([
            'id_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi,
            'deskripsi' => $a->deskripsi
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dvalue_en');
    }

    public function valueDelete_en($x)
    {
        $data = Nilai_en::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dvalue_en');
    }

    public function peran_en()
    {
        $dataPeran = Peran_en::all();
        return view('backend/peran_en', ['dataPeran' => $dataPeran]);
    }

    public function peranSimpan_en(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_peran' => 'required'
        ], $pesan_error);

        Peran_en::create([
            'id_peran' => $a->id_peran,
            'nm_peran' => $a->peran
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dperan_en');
    }

    public function peranUpdate_en($x, Request $a)
    {
        Peran_en::where('id_peran', $x)->update([
            'id_peran' => $a->id_peran,
            'nm_peran' => $a->peran
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dperan_en');
    }

    public function peranDelete_en($x)
    {
        $data = Peran_en::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dperan_en');
    }

    public function struktur_en()
    {
        $dataStruktur = Struktur_en::join('kompetensi_en', 'struktur_en.id_kompetensi', '=', 'kompetensi_en.id_kompetensi')
            ->get(['struktur_en.*', 'kompetensi_en.*']);
        $dataKompetensi = Kompetensi_en::all();
        return view('backend/struktur_en', ['dataStruktur' => $dataStruktur, 'dataKompetensi' => $dataKompetensi]);
    }

    public function strukturSimpan_en(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_struktur' => 'required'
        ], $pesan_error);

        Struktur_en::create([
            'id_struktur' => $a->id_struktur,
            'nm_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dstruktur_en');
    }

    public function strukturUpdate_en($x, Request $a)
    {
        Struktur_en::where('id_struktur', $x)->update([
            'id_struktur' => $a->id_struktur,
            'nm_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dstruktur_en');
    }

    public function strukturDelete_en($x)
    {
        $data = Struktur_en::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dstruktur_en');
    }
}
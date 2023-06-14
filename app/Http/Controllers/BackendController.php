<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Peran;
use App\Models\Kompetensi;
use App\Models\Peran_en;
use App\Models\Level;
use App\Models\Nilai;
use App\Models\Struktur;
use Illuminate\Support\Facades\Hash;

class BackendController extends Controller
{
    public function user()
    {
        $dataLevel = Level::all();
        $dataPeran = Peran_en::all();
        $dataUser = User::join('peran_en', 'users.function_en', '=', 'peran_en.id_peran')
            ->join('level', 'level.id_level', '=', 'users.level')
            ->get(['users.*', 'peran_en.*', 'level.*']);
        return view('backend/user', ['dataUser' => $dataUser, 'dataLevel' => $dataLevel, 'dataPeran' => $dataPeran]);
    }
    public function userSimpan(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
            'unique' => "User dengan ID ini Sudah terdaftar"
        ];
        $a->validate([
            'id_user' => 'required|unique:users',
            'nama' => 'required',
            'password' => 'required',
            'function' => 'required',
            'level' => 'required'
        ], $pesan_error);

        User::create([
            'id_user' => $a->id_user,
            'name' => $a->nama,
            'password' => Hash::make($a->password),
            'departemen' => $a->departemen,
            'hp' => $a->hp,
            'function' => $a->function,
            'function_en' => $a->function,
            'level' => $a->level
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/user');
    }

    public function userUpdate($x, Request $a)
    {
        User::where('id_user', $x)->update([
            'name' => $a->nama,
            'password' => Hash::make($a->password),
            'departemen' => $a->departemen,
            'hp' => $a->hp,
            'function' => $a->function,
            'function_en' => $a->function,
            'level' => $a->level
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/user');
    }

    public function userDelete($x)
    {
        $data = User::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/user');
    }

    public function updatePass($x, Request $a)
    {
        User::where('id_user', $x)->update([
            'password' => Hash::make($a->password)
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/user');
    }

    public function kompetensi()
    {
        $dataKompetensi = Kompetensi::all();
        return view('backend/kompetensi', ['dataKompetensi' => $dataKompetensi]);
    }

    public function kompetensiSimpan(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_kompetensi' => 'required|unique:kompetensi'
        ], $pesan_error);

        Kompetensi::create([
            'id_kompetensi' => $a->id_kompetensi,
            'nm_kompetensi' => $a->kompetensi,
            'value' => $a->value,
            'definisi' => $a->definisi
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dkompetensi');
    }

    public function kompetensiUpdate($x, Request $a)
    {
        Kompetensi::where('id_kompetensi', $x)->update([
            'nm_kompetensi' => $a->kompetensi,
            'value' => $a->value,
            'definisi' => $a->definisi
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dkompetensi');
    }

    public function kompetensiDelete($x)
    {
        $data = Kompetensi::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dkompetensi');
    }

    public function level()
    {
        $dataLevel = Level::all();
        return view('backend/level', ['dataLevel' => $dataLevel]);
    }

    public function levelSimpan(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_level' => 'required'
        ], $pesan_error);

        Level::create([
            'id_level' => $a->id_level,
            'level' => $a->level
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dlevel');
    }

    public function levelUpdate($x, Request $a)
    {
        Level::where('id_level', $x)->update([
            'level' => $a->level
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dlevel');
    }

    public function levelDelete($x)
    {
        $data = Level::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dlevel');
    }

    public function value()
    {
        //$dataValue = Nilai::all();
        $dataValue = Nilai::join('struktur', 'nilai.id_struktur', '=', 'struktur.id_struktur')
            ->join('kompetensi', 'nilai.id_kompetensi', '=', 'kompetensi.id_kompetensi')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $dataStruktur = Struktur::all();
        $dataKompetensi = Kompetensi::all();
        return view('backend/value', ['dataValue' => $dataValue, 'dataStruktur' => $dataStruktur, 'dataKompetensi' => $dataKompetensi]);
    }

    public function valueSimpan(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_value' => 'required'
        ], $pesan_error);

        Nilai::create([
            'id_nilai' => $a->id_value,
            'id_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi,
            'deskripsi' => $a->deskripsi
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dvalue');
    }

    public function valueUpdate($x, Request $a)
    {
        Nilai::where('id_nilai', $x)->update([
            'id_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi,
            'deskripsi' => $a->deskripsi
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dvalue');
    }

    public function valueDelete($x)
    {
        $data = Nilai::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dvalue');
    }

    public function peran()
    {
        $dataPeran = Peran::all();
        return view('backend/peran', ['dataPeran' => $dataPeran]);
    }

    public function peranSimpan(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_peran' => 'required'
        ], $pesan_error);

        Peran::create([
            'id_peran' => $a->id_peran,
            'nm_peran' => $a->peran
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dperan');
    }

    public function peranUpdate($x, Request $a)
    {
        Peran::where('id_peran', $x)->update([
            'id_peran' => $a->id_peran,
            'nm_peran' => $a->peran
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dperan');
    }

    public function peranDelete($x)
    {
        $data = Peran::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dperan');
    }

    public function struktur()
    {
        $dataStruktur = Struktur::join('kompetensi', 'struktur.id_kompetensi', '=', 'kompetensi.id_kompetensi')
            ->get(['struktur.*', 'kompetensi.*']);
        $dataKompetensi = Kompetensi::all();
        return view('backend/struktur', ['dataStruktur' => $dataStruktur, 'dataKompetensi' => $dataKompetensi]);
    }

    public function strukturSimpan(Request $a)
    {
        $pesan_error = [
            'required' => ':attribute harus di isi',
        ];
        $a->validate([
            'id_struktur' => 'required'
        ], $pesan_error);

        Struktur::create([
            'id_struktur' => $a->id_struktur,
            'nm_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi
        ]);
        //Session::flash('simpan', 'Data Berhasil Disimpan!');
        return redirect('/Dstruktur');
    }

    public function strukturUpdate($x, Request $a)
    {
        Struktur::where('id_struktur', $x)->update([
            'id_struktur' => $a->id_struktur,
            'nm_struktur' => $a->struktur,
            'id_kompetensi' => $a->kompetensi
        ]);
        //Session::flash('update', 'Data Berhasil Diupdate!');
        return redirect('/Dstruktur');
    }

    public function strukturDelete($x)
    {
        $data = Struktur::find($x);
        $data->delete();
        //Session::flash('hapus', 'Data Berhasil Didelete!');
        return redirect('/Dstruktur');
    }

    public function LoginAdmin()
    {
        return view('loginAdmin');
    }

    public function login_proses(Request $a)
    {
        $cek = $a->validate([
            'id_user' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($cek)) {
            $a->session()->regenerate();
            return redirect()->intended('/user');
        }
        //return view('index');
        return back()->with('loginError', 'Login Gagal! User atau Password salah.');
    }
}
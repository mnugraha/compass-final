<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use App\Models\Level;
use App\Models\Nilai;
use App\Models\Peran;
use App\Models\Peringkat;
use App\Models\Profile;
use App\Models\Struktur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UtamaController extends Controller
{
    public function index()
    {
        return view('master-top');
    }

    public function contoh()
    {
        return view('contoh');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function handbook()
    {
        return view('handbook');
    }

    public function video()
    {
        return view('video');
    }

    public function profil()
    {
        $dataNilai = Nilai::all();
        $dataKompetensi = Kompetensi::all();
        $dataStruktur = Struktur::all();
        $dataLevel = Level::all();
        $dataPeringkat = Peringkat::all();
        $dataPeran = Peran::all();
        $dataUser1 = User::all();
        if (isset(Auth::user()->id_user)) {
            $dataProfile = Profile::join('nilai', 'profile.nilai', '=', 'nilai.id_nilai')
                ->join('peran', 'peran.id_peran', '=', 'profile.peran')
                ->join('level', 'level.id_level', '=', 'profile.level')
                ->where('profile.peran', '=', Auth::user()->function)
                ->where('profile.level', '=', Auth::user()->level)
                ->orderBy('nilai', 'asc')
                ->get(['nilai.*', 'profile.*', 'peran.*', 'level.*']);

            $dataUser = User::join('peran', 'peran.id_peran', '=', 'users.function')
                ->join('level', 'level.id_level', '=', 'users.level')
                ->where('users.id_user', '=', Auth::user()->id_user)
                ->get(['users.*', 'level.*', 'peran.*'])->first();
            $kompetensiUser = Profile::where('peran', '=', Auth::user()->function)
                ->where('level', '=', Auth::user()->level)
                ->where('nilai', 'NOT LIKE', '%f')
                ->get();
            $jmlKompetensi = (int) (($kompetensiUser->count()) / 3);
        } else {
            return view('login');
        }
        return view('profile', ['dataUser' => $dataUser, 'nilai' => $dataNilai, 'level' => $dataLevel, 'peran' => $dataPeran, 'profile' => $dataProfile, 'kompetensi' => $dataKompetensi, 'struktur' => $dataStruktur, 'jmlKompetensi' => $jmlKompetensi, 'dataPeringkat' => $dataPeringkat, 'dataUser1' => $dataUser1]);
    }
    public function login()
    {
        return view('login');
    }

    public function login_proses(Request $a)
    {
        $cek = $a->validate([
            'id_user' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($cek)) {
            $a->session()->regenerate();
            return redirect()->intended('/profile');
        }
        //return view('index');
        return back()->with('loginError', 'Login Gagal! User atau Password salah.');
    }

    public function logout(Request $a)
    {
        Auth::logout();
        $a->session()->invalidate();
        $a->session()->regenerateToken();
        return redirect('/login');
    }

    public function A()
    {
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'A1')
            ->orWhere('id_kompetensi', '=', 'A2')
            ->orWhere('id_kompetensi', '=', 'A3')
            ->get();
        return view('A', ['kompetensi' => $dataKompetensi]);
    }

    public function B()
    {
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'B1')
            ->orWhere('id_kompetensi', '=', 'B2')
            ->orWhere('id_kompetensi', '=', 'B3')
            ->get();
        return view('B', ['kompetensi' => $dataKompetensi]);
    }

    public function C()
    {
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'C1')
            ->orWhere('id_kompetensi', '=', 'C2')
            ->orWhere('id_kompetensi', '=', 'C3')
            ->get();
        return view('C', ['kompetensi' => $dataKompetensi]);
    }

    public function D()
    {
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'D1')
            ->orWhere('id_kompetensi', '=', 'D2')
            ->orWhere('id_kompetensi', '=', 'D3')
            ->get();
        return view('D', ['kompetensi' => $dataKompetensi]);
    }

    public function A1()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A11')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A12')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A13')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A11')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A12')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A13')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'A1')
            ->first();
        return view('A1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function A2()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A21')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A22')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A23')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A21')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A22')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A23')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'A2')
            ->first();
        return view('A1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }
    public function A3()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A31')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A32')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A33')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A31')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A32')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'A33')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'A3')
            ->first();
        return view('A1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function B1()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B11')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B12')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B13')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B11')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B12')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B13')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'B1')
            ->first();
        return view('B1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function B2()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B21')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B22')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B23')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B21')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B22')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B23')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'B2')
            ->first();
        return view('B1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function B3()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B31')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B32')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B33')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B31')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B32')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'B33')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'B3')
            ->first();
        return view('B1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function C1()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C11')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C12')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C13')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C11')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C12')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C13')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'C1')
            ->first();
        return view('C1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function C2()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C21')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C22')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C23')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C21')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C22')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C23')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'C2')
            ->first();
        return view('C1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function C3()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C31')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C32')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C33')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C31')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C32')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'C33')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'C3')
            ->first();
        return view('C1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function D1()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D11')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D12')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D13')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D11')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D12')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D13')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'D1')
            ->first();
        return view('D1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function D2()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D21')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D22')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D23')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D21')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D22')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D23')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'D2')
            ->first();
        return view('D1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function D3()
    {
        $a1 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D31')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a2 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D32')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $a3 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D33')
            ->get(['nilai.*', 'struktur.*', 'kompetensi.*']);
        $A11 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D31')->first();
        $A12 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D32')->first();
        $A13 = Nilai::join('struktur', 'struktur.id_struktur', '=', 'nilai.id_struktur')
            ->join('kompetensi', 'kompetensi.id_kompetensi', '=', 'nilai.id_kompetensi')
            ->where('nilai.id_struktur', '=', 'D33')->first();
        $dataKompetensi = Kompetensi::where('id_kompetensi', '=', 'D3')
            ->first();
        return view('D1', ['kompetensi' => $dataKompetensi, 'jointabel1' => $a1, 'jointabel2' => $a2, 'jointabel3' => $a3, 'A11' => $A11, 'A12' => $A12, 'A13' => $A13]);
    }

    public function kompetensi()
    {

        $dataKompetensiA = Kompetensi::where('id_kompetensi', '=', 'A1')
            ->orWhere('id_kompetensi', '=', 'A2')
            ->orWhere('id_kompetensi', '=', 'A3')
            ->get();

        $dataKompetensiB = Kompetensi::where('id_kompetensi', '=', 'B1')
            ->orWhere('id_kompetensi', '=', 'B2')
            ->orWhere('id_kompetensi', '=', 'B3')
            ->get();

        $dataKompetensiC = Kompetensi::where('id_kompetensi', '=', 'C1')
            ->orWhere('id_kompetensi', '=', 'C2')
            ->orWhere('id_kompetensi', '=', 'C3')
            ->get();

        $dataKompetensiD = Kompetensi::where('id_kompetensi', '=', 'D1')
            ->orWhere('id_kompetensi', '=', 'D2')
            ->orWhere('id_kompetensi', '=', 'D3')
            ->get();
        return view('kompetensi', ['kompetensiA' => $dataKompetensiA, 'kompetensiB' => $dataKompetensiB, 'kompetensiC' => $dataKompetensiC, 'kompetensiD' => $dataKompetensiD]);
        // return view('kompetensi');
    }

    public function updatePass($x, Request $a)
    {
        User::where('id_user', $x)->update([
            'password' => Hash::make($a->password),
        ]);
        return redirect('/profile');
    }

    public function faq()
    {
        return view('faq');
    }

    public function underConstruction()
    {
        return view('underConstruction');
    }
}
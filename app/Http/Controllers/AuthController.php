<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function simpan_user(Request $request){
        try{
            $validate = $request->validate([
                'role' => 'required|string|in:supplier,admin',
                'nama_lengkap' => 'required|string|max:255',
                'nik' => 'required|string',
                'no_hp' => 'required|max:255',
                'desa' => 'required|string',
                'kecamatan' => 'required|string',
                'kabupaten' => 'required|string',
                'provinsi' => 'required|string',
                'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);
        }catch (\Illuminate\Validation\ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }

        if ($request->hasFile('foto_ktp')) {
            $imageName = time(). '.'.$request->foto_ktp->extension();
            $request->foto_ktp->move(public_path('images'), $imageName);
            
            $imageName = 'images/' . $imageName;
        }

        $kode_user = Str::uuid()->toString();
        $hashpass = Hash::make($validate['password']);

        $user = new User();
        $user->kode_user = $kode_user;
        $user->role = $validate['role'];
        $user->nama_lengkap = $validate['nama_lengkap'];
        $user->nik = $validate['nik'];
        $user->no_hp = $validate['no_hp'];
        $user->desa = $validate['desa'];
        $user->kecamatan = $validate['kecamatan'];
        $user->kabupaten = $validate['kabupaten'];
        $user->provinsi = $validate['provinsi'];
        $user->foto_ktp = $imageName;
        $user->email = $validate['email'];
        $user->password = $hashpass;
        $user->save();

        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect()->route('verification.notice');

    }

    public function cek_user(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'supplier') {
                return redirect()->route('supplier.dashboard');
            } elseif ($user->role == 'customer') {
                return redirect()->route('customer.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        session()->flash('kesahalan');
        return redirect('/login');
    }

    public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}

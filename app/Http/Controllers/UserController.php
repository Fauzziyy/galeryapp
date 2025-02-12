<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create($validasi);
        if ($user) {
            return redirect()->route('beranda.index')->with('success', 'Registrasi berhasil');
        } else {
            return redirect()->route('beranda.index')->with('error', 'Registrasi Gagal');
        }
    }

    public function login(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $login_check = Auth::attempt($validasi);

        if ($login_check) {
            return redirect()->route('beranda.index')->with('success', 'Login Berhasil');
        } else {
            return redirect()->route('beranda.index')->with('error', 'Login Gagal');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('beranda.index')->with('success', 'Logout Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

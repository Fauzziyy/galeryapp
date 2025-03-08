<?php

namespace App\Http\Controllers;

use App\Models\AlbumFoto;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $album = AlbumFoto::where('users_id', Auth::user()->id)->get();
        $fotos = Foto::with(['user', 'likes.user'])->orderBy('created_at', 'desc')->where('users_id', Auth::user()->id)->get();
        return view('profile', compact('album', 'fotos'));
    }

    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $foto = $request->file('foto');
        $fotoName = time() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('/storage/img-profile'), $fotoName);
        $user = User::find($id);
        $user->foto = $fotoName;
        $user->save();
        return redirect()->route('profile')->with('success', 'Foto berhasil diubah');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $foto = $request->file('foto');
        $fotoName = time() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('storage/img-profile'), $fotoName);

        $user = User::find($id);
        $user->foto = $fotoName;
        $user->save();

        return redirect()->route('profile')->with('success', 'Foto berhasil diubah');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->alamat = $request->alamat;
        $user->save();
        return redirect()->route('profile')->with('success', 'Profile berhasil diubah');
    }
}

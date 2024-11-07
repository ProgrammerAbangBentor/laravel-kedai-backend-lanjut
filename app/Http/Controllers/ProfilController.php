<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profil($id)
    {
        $user = User::findOrFail($id);

        return view('user.profil', compact('user'));
    }


     // Update Profil
     public function updateProfile(Request $request, $id)
     {
         // Validasi input data
         $request->validate([
             'name' => 'required|string|max:255',
             'phone' => 'nullable|string|max:15',
         ]);

         // Cari user berdasarkan ID
         $user = User::findOrFail($id);

         // Perbarui data jika ada perubahan
         $user->name = $request->input('name');
         $user->phone = $request->input('phone');

         // Jika password diisi, hash dan update password
         if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
         } else {
             //if password is empty, then use the old password
             $data['password'] = $user->password;
         }

         // Simpan perubahan ke database
         $user->save();

         // Redirect ke profil dengan pesan sukses
         return redirect()->route('home', $id)->with('success', 'Profile updated successfully');
    }
}

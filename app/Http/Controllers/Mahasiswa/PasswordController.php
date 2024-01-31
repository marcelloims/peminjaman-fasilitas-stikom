<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index($id)
    {
        $data['id']    = $id;
        $data['title'] = "Ubah Password";
        return view('mahasiswa_templates.pages.edit_password', $data);
    }

    public function updatePassword(Request $request)
    {
        $data['id'] = $request->id;

        $password = User::where("id", $request->id)->select('password')->first();
        if (Hash::check($request->input('password_lama'), $password->password)) {
            User::where('id', $request->id)->update(['password' => bcrypt($request->password_baru)]);
            return redirect('mahasiswa/ubahpassword/' . $request->id)->with('message', 'Berhasil disimpan');
        } else {
            $data['id']    = $request->id;
            $data['title'] = "Ubah Password";
            return redirect('mahasiswa/ubahpassword/' . $request->id)->with('error', 'Password Lama Salah');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class JamaahController extends Controller
{
    // Tambah Jamaah
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'jamaah',
        ]);

        return back()->with('success', 'Jamaah berhasil ditambahkan!');
    }

    // Update Jamaah
    public function update(Request $request, $id)
    {
        $jamaah = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $jamaah->id,
            'no_hp' => 'required|string|max:20',
        ]);

        $jamaah->update($request->only('name', 'email', 'no_hp'));

        return back()->with('success', 'Jamaah berhasil diperbarui!');
    }

    // Hapus Jamaah
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Jamaah berhasil dihapus!');
    }
}

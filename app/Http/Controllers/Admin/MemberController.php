<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    // Menampilkan daftar member (sudah ada)
    public function index()
    {
        $members = User::where('role', 'member')->paginate(10);
        return view('kelola-member', ['members' => $members]);
    }

    // Menampilkan form tambah member
    public function create()
    {
        return view('admin.tambah-member');
    }

    // Menyimpan member baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'member', // Otomatis set role sebagai member
        ]);

        return redirect()->route('admin.member.index')->with('success', 'Member baru berhasil ditambahkan.');
    }

    // Menampilkan form edit member
    public function edit(User $member)
    {
        return view('admin.edit-member', ['member' => $member]);
    }

    // Memperbarui data member
   public function update(Request $request, User $member)
    {
    // ... (logika update data Anda tetap sama) ...
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($member->id)],
        'phone' => ['nullable', 'string', 'max:20'],
        'password' => ['nullable', 'string', 'min:8'],
    ]);

    $member->update($request->only('name', 'email', 'phone'));

    if ($request->filled('password')) {
        $member->update(['password' => \Illuminate\Support\Facades\Hash::make($request->password)]);
    }
    // ...

    // ▼▼▼ PERBAIKI BARIS INI ▼▼▼
    return redirect()->route('admin.member.index')->with('success', 'Data member berhasil diperbarui.');
    }
    // Menghapus member
    public function destroy(User $member)
    {
        $member->delete();
        return redirect()->route('kelola-member')->with('success', 'Data member berhasil dihapus.');
    }
}
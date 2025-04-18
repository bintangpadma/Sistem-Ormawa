<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('authenticate.login', [
            'page' => 'Halaman Login'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email:dns|max:255',
                'password' => 'required|max:255',
            ]);

            if (Auth::attempt($validatedData)) {
                $request->session()->regenerate();
                if (!auth()->user()->admin->status) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->back()->with('failed', 'Akun admin ini sudah tidak aktif!');
                }
                return redirect()->route('dashboard.index')->with('success', 'Berhasil login akun!');
            }

            return redirect()->back()->with('failed', 'Email atau password tidak ditemukan!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Email atau password tidak ditemukan!');
        }
    }

    public function delete(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.index')->with('success', 'Berhasil logout akun!');
    }
}

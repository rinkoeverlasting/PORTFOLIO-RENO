<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('home', compact('profile'));
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = Profile::first();

        if ($profile->profile_image) {
            Storage::disk('public')->delete($profile->profile_image);
        }

        $path = $request->file('photo')->store('profiles', 'public');
        $profile->update(['profile_image' => $path]);

        return back()->with('success', 'Foto profil berhasil diunggah.');
    }

    public function deletePhoto()
    {
        $profile = Profile::first();

        if ($profile->profile_image) {
            Storage::disk('public')->delete($profile->profile_image);
            $profile->update(['profile_image' => null]);
        }

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }
}

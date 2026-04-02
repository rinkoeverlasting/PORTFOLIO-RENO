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

        // Auto-seed if profile is empty (to prevent error on first deployment)
        if (!$profile) {
            $profile = Profile::create([
                'name' => 'Albertus Reno Aditama',
                'age' => 19,
                'birth_date' => '2006-11-15',
                'school' => 'SMAK Frateran',
                'class' => '12 E',
                'description' => 'Seorang siswa SMAK Frateran kelas 12 E yang memiliki minat di bidang informatika dan gaming.',
                'profile_image' => null,
            ]);
        }

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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->route('admin.profile.edit')->with('status', 'Profile berhasil diperbarui!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,jpg,png,gif', 'max:3072'], // 3MB max
        ]);

        $user = Auth::user();

        // Delete old avatar if exists
        if ($user->avatar) {
            ImageHelper::delete($user->avatar);
        }

        // Compress and store new avatar (max 500px width for avatars)
        $path = ImageHelper::compressAndSave(
            $request->file('avatar'),
            'avatars',
            500,  // Avatar doesn't need to be huge
            90    // High quality for avatars
        );

        $user->update(['avatar' => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Avatar berhasil diperbarui!',
            'avatar_url' => asset('storage/' . $path)
        ]);
    }

    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            ImageHelper::delete($user->avatar);
        }

        $user->update(['avatar' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Avatar berhasil dihapus!'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('admin.profile.edit')->with('status', 'Password berhasil diubah!');
    }
}

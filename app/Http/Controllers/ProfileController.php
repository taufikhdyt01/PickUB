<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->only(['name']);

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '-IMAGE.' . $file->getClientOriginalExtension();
            $file->move(public_path('media'), $filename);
            $data['image_url'] = 'media/' . $filename;
        }

        if ($request->input('remove_image') == 'true') {
            $data['image_url'] = 'media/default.jpg';
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}

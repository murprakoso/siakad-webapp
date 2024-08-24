<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('settings.index', compact('settings'));
    }

    public function edit()
    {
        $settings = Setting::first();
        return view('settings.form', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Pengaturan Sekolah
            'school_name' => 'required|string|max:255',
            'school_address' => 'nullable|string',
            'school_phone' => 'nullable|string',
            'school_email' => 'nullable|email',

            // Pengaturan Website
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            // 'site_favicon' => 'nullable|image|mimes:ico,jpg,png,jpeg|size:16',
            'site_favicon' => 'nullable|image|mimes:ico,jpg,png,jpeg|max:2048',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'contact_address' => 'nullable|string',
        ]);

        $settings = Setting::first() ?? new Setting();
        // Pengaturan Sekolah
        $settings->school_name = $request->input('school_name');
        $settings->school_address = $request->input('school_address');
        $settings->school_phone = $request->input('school_phone');
        $settings->school_email = $request->input('school_email');

        // Pengaturan Website
        $settings->site_name = $request->input('site_name');
        $settings->site_description = $request->input('site_description');

        if ($request->hasFile('site_logo')) {
            if ($settings->site_logo) {
                Storage::delete($settings->site_logo);
            }
            $settings->site_logo = $request->file('site_logo')->store('logos', 'public');
        }

        if ($request->hasFile('site_favicon')) {
            if ($settings->site_favicon) {
                Storage::delete($settings->site_favicon);
            }
            $settings->site_favicon = $request->file('site_favicon')->store('favicons', 'public');
        }

        $settings->contact_email = $request->input('contact_email');
        $settings->contact_phone = $request->input('contact_phone');
        $settings->contact_address = $request->input('contact_address');

        $settings->save();

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}

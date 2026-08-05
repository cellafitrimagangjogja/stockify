<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Services_admin\SettingService;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
class PengaturanAdminController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $setting = $this->settingService->getSetting();

        return view(
            'example_admin.content.crud.admin.pengaturan.index',
            compact('setting')
        );
    }

    public function update(Request $request)
{
    $request->validate([
        'app_name' => 'required|max:255',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
    ]);

    $setting = Setting::first();

    $data = [
        'app_name' => $request->app_name,
    ];

    if ($request->hasFile('logo')) {

        if ($setting && $setting->logo) {
            Storage::disk('public')->delete($setting->logo);
        }

        $data['logo'] = $request->file('logo')->store('settings', 'public');
    }

    Setting::updateOrCreate(
        ['id' => $setting?->id],
        $data
    );

    return redirect()
        ->route('admin.pengaturan.index')
        ->with('success', 'Pengaturan berhasil diperbarui.');
}
}
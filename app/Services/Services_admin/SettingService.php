<?php

namespace App\Services\Services_admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingService
{
    public function getSetting()
    {
        return Setting::first();
    }

    public function update(array $data)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'app_name' => 'Stockify',
            ]);
        }

        if (isset($data['logo'])) {

            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $data['logo'] = $data['logo']->store(
                'settings',
                'public'
            );
        }

        $setting->update($data);

        return $setting;
    }
}
<?php

namespace App\Repositories;

use App\Events\TicketAssigned;
use App\Models\ClassroomManager;
use App\Models\SiteSetting;
use App\Models\Ticket;

class SiteSettingsRepository
{
    public function getAllSiteSettings()
    {
        return SiteSetting::all();
    }

    public function getAllKeyValues()
    {
        $settings = $this->getAllSiteSettings();
        $keyValues = [];

        foreach ($settings as $setting) {
            $keyValues[$setting->name] = $setting->value;
        }

        return (object) $keyValues;
    }

    public function getSiteSettingValue(string $settingName)
    {
        return SiteSetting::where('name', $settingName);
    }

    public function setSiteSettingValue(string $settingName, string $settingValue)
    {
        SiteSetting::where('name', $settingName)->update('value', $settingValue);
    }
}

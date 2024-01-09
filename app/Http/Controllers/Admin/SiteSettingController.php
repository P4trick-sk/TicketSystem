<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Repositories\SiteSettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class SiteSettingController extends Controller
{
    public function __construct(SiteSettingsRepository $siteSettingsRepository) {
        $this->siteSettingsRepository = $siteSettingsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = $this->siteSettingsRepository->getAllKeyValues();
        return view('admin.settings.index')->with('settings', $settings);
    }

    public function updateSchoolInfo(Request $request)
    {
        $request->validate([
            'school_name' => ['required', 'string', 'max:256'],
            'school_logo' => ['nullable', 'image', 'max:10240'],
        ]);

        $settingName = SiteSetting::where('name', 'school_name')->first();
        $settingLogo = SiteSetting::where('name', 'school_logo')->first();

        $settingName->value = $request->school_name;
        $settingName->save();

        if ($request->school_logo != null) {
            $path = $request->school_logo->store('logo');
            Storage::delete($settingLogo->value);
            $settingLogo->value = $path;
            $settingLogo->save();
        }

        return to_route('admin.settings.index');
    }

    public function updateGoogleOauth(Request $request)
    {
        $clientId = SiteSetting::where('name', 'google_client_id')->first();
        $clientSecret = SiteSetting::where('name', 'google_client_secret')->first();

        $clientId->value = $request->google_client_id;
        $clientId->save();

        $clientSecret->value = $request->google_client_secret;
        $clientSecret->save();

        return to_route('admin.settings.index');
    }

    public function updateEnableRegister(Request $request)
    {
        $request->validate([
            'is_register_enabled' => ['required', 'boolean'],
        ]);

        $registerEnabled = SiteSetting::where('name', 'is_register_enabled')->first();

        $registerEnabled->value = $request->is_register_enabled;
        $registerEnabled->save();

        return to_route('admin.settings.index');
    }

    public function updateWordFilter(Request $request)
    {
        $request->validate([
            'is_filter_enabled' => ['required', 'boolean'],
        ]);

        $filterEnabled = SiteSetting::where('name', 'is_filter_enabled')->first();

        $filterEnabled->value = $request->is_filter_enabled;
        $filterEnabled->save();

//        foreach (explode(',',$request->filter_list) as $word) {
//
//        }

        return to_route('admin.settings.index');
    }
}

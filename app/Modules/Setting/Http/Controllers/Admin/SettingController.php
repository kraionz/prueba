<?php

namespace App\Modules\Setting\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Setting;
use App\Http\Controllers\Controller;


class SettingController extends Controller
{
    public function __construct()
    {
       //$this->middleware('auth');
    }

    /**
     * Display general settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function general()
    {
        return view('settings::general');
    }

    /**
     * Display Authentication & Registration settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auth()
    {
        return view('settings::auth');
    }

    /**
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->updateSettings($request->except("_token"));

        return back()->withSuccess(trans('app.settings_updated'));
    }

    /**
     * Update settings and fire appropriate event.
     *
     * @param $input
     */
    private function updateSettings($input)
    {
        foreach ($input as $key => $value) {
            Setting::set($key, $value);
        }

        Setting::save();

    }

    /**
     * Display notification settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notifications()
    {
        return view('settings::notifications');
    }
}

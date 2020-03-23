<?php

namespace App\Http\Controllers;
use App\Setting;
use Illuminate\Http\Request;
use Session;

use App\Http\Requests\CreateSettingRequest;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.setting')->with('setting', Setting::first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSettingRequest $request)
    {
        $setting = Setting::first();
        $setting->site_name = $request->site_name;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->phone_number = $request->phone_number;
        $setting->about = $request->about;

        $setting->save();
        Session::flash('success', 'The setting has been Updated');

        return redirect()->back();
    }

}

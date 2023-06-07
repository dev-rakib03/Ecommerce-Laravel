<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;

class SettingsController extends Controller
{
    public function saveArrayToEnv(array $keyPairs)
    {
        $envFile = app()->environmentFilePath();
        $newEnv = file_get_contents($envFile);

        $newlyInserted = false;

        foreach ($keyPairs as $key => $value) {
            // Make sure key is uppercase (can be left out)
            $key = Str::upper($key);

            if (str_contains($newEnv, "$key=")) {
                // If key exists, replace value
                $newEnv = preg_replace("/$key=(.*)\n/", "$key=$value\n", $newEnv);
            } else {
                // Check if spacing is correct
                if (!str_ends_with($newEnv, "\n\n") && !$newlyInserted) {
                    $newEnv .= str_ends_with($newEnv, "\n") ? "\n" : "\n\n";
                    $newlyInserted = true;
                }
                // Append new
                $newEnv .= "$key=$value\n";
            }
        }

        $fp = fopen($envFile, 'w');
        fwrite($fp, $newEnv);
        fclose($fp);
    }

    public function index()
    {
        return view('admin.websitesettings.index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
         'site_logo' => 'image|mimes:png',
         'favicon' => 'image|mimes:png',
         'logo_invoice' => 'image|mimes:jpg',
        ]);

        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo');
            $name = 'logo.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/front_assets');
            $image->move($destinationPath, $name);
        }

        if ($request->hasFile('logo_invoice')) {
            $image = $request->file('logo_invoice');
            $name = 'logo.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/front_assets');
            $image->move($destinationPath, $name);
        }

        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $name = 'favicon.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/front_assets');
            $image->move($destinationPath, $name);
        }


        $keyPairs = [
            'SITE_NAME'=>'"'.$request->site_name.'"',
            'SITE_EMAIL'=>'"'.$request->contact_email.'"',
            'SITE_PHONE'=>'"'.$request->contact_phone.'"',
            'SITE_ADDRESS'=>'"'.$request->contact_address.'"',
            'SITE_FACEBOOK'=>'"'.$request->site_facebook.'"',
            'SITE_TWITTER'=>'"'.$request->site_twitter.'"',
            'SITE_INSTAGRAM'=>'"'.$request->site_instagram.'"',
            'SITE_YOUTUBE'=>'"'.$request->site_youtube.'"',
            'IN_DHAKA'=>'"'.$request->in_dhaka.'"',
            'OUT_DHAKA'=>'"'.$request->out_dhaka.'"'
        ];

        $this->saveArrayToEnv($keyPairs);

        \Artisan::call('cache:clear');
        \Artisan::call('route:cache');
        $request->session()->flush('massage','Website Settings Updated');
        return back();
    }

    public function customcode()
    {
        $fb_pixel_path = public_path('/front_assets/fb_pixel.php');
        $css_path = public_path('/front_assets/css/admin_custom.css');
        $js_path = public_path('/front_assets/js/admin_custom.js');

        //check file exist or not--fb pixel
        if (file_exists($fb_pixel_path)) {
            //if retrive data
            $result['fb_pixel'] = file_get_contents($fb_pixel_path);
        }
        else{
            //else create file
            $file = fopen($fb_pixel_path, 'w');
            fwrite($file, '<!--add facebook pixel code-->');
            fclose($file);
            $result['fb_pixel'] = file_get_contents($fb_pixel_path);
        }

        //check file exist or not--css
        if (file_exists($css_path)) {
            //if retrive data
            $result['css'] = file_get_contents($css_path);
        }
        else{
            //else create file
            $file = fopen($css_path, 'w');
            fwrite($file, '/'.'*add custom css*/');
            fclose($file);
            $result['css'] = file_get_contents($css_path);
        }

        //check file exist or not--JS
        if (file_exists($js_path)) {
            //if retrive data
            $result['js'] = file_get_contents($js_path);
        }
        else{
            //else create file
            $file = fopen($js_path, 'w');
            fwrite($file, '//add custom JS');
            fclose($file);
            $result['js'] = file_get_contents($js_path);
        }

        return view('admin.websitesettings.customcode',$result);
    }

    public function customcodeupdate(Request $request)
    {
        $fb_pixel_path = public_path('/front_assets/fb_pixel.php');
        $css_path = public_path('/front_assets/css/admin_custom.css');
        $js_path = public_path('/front_assets/js/admin_custom.js');

        //fb pixel
        if($request->fb_pixel){
            $file = fopen($fb_pixel_path, 'w');
            fwrite($file, $request->fb_pixel);
            fclose($file);
        }
        else{
            $file = fopen($fb_pixel_path, 'w');
            fwrite($file, '<!--add facebook pixel code-->');
            fclose($file);
        }

        //css
        if($request->custom_css){
            $file = fopen($css_path, 'w');
            fwrite($file, $request->custom_css);
            fclose($file);
        }
        else{
            $file = fopen($css_path, 'w');
            fwrite($file, '/'.'*add custom css*/');
            fclose($file);
        }

        //JS
        if($request->custom_js){
            $file = fopen($js_path, 'w');
            fwrite($file, $request->custom_js);
            fclose($file);
        }
        else{
            $file = fopen($js_path, 'w');
            fwrite($file, '//add custom JS');
            fclose($file);
            $result['js'] = file_get_contents($js_path);
        }

        \Artisan::call('cache:clear');
        \Artisan::call('route:cache');
        $request->session()->flush('massage','Website Settings Updated');
        return redirect()->back();
    }
}

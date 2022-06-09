<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\SiteSetting;
use Illuminate\Http\Request;
use ImageHelper;

class SiteSettingController extends Controller
{
    public function index()
    {   
        $data['setting'] = SiteSetting::find(1);	
    	return view('backend.settings.edit-site-settings')->with($data);
    }
 
    public function updateSetting(Request $request)
    {
        $params     = $request->all();
        $setting    = SiteSetting::find(1);
        // dd($setting);

        if($request->file('site_header_logo'))
        {
            @unlink(public_path('upload/logo/'.$setting->site_header_logo));
            $config = array(
                'name'      => "site_header_logo",
                'path'      => 'upload/logo',
                'width'     => 350,
                'height'    => 70
            );
            $image = ImageHelper::uploadImage($config);
            $params['site_header_logo'] = $image['filename'];
        }

        if($request->file('site_footer_logo'))
        {
            @unlink(public_path('upload/logo/'.$setting->site_footer_logo));
            $config = array(
                'name'      => "site_footer_logo",
                'path'      => 'upload/logo',
                'width'     => 350,
                'height'    => 70
            );
            $image = ImageHelper::uploadImage($config);
            $params['site_footer_logo'] = $image['filename'];
        }

        if($request->file('site_favicon'))
        {
            @unlink(public_path('upload/logo/'.$setting->site_favicon));
            $config = array(
                'name'      => "site_favicon",
                'path'      => 'upload/logo',    
                'width'     => 60,
                'height'    => 60
            );
            $image = ImageHelper::uploadImage($config);
            $params['site_favicon'] = $image['filename'];
        }  

        if($request->file('site_banner_image'))
        {
            @unlink(public_path('upload/logo/'.$setting->site_banner_image));
            $config = array(
                'name'      => "site_banner_image",
                'path'      => 'upload/logo',
                'width'     => 1024,
                'height'    => 300
            );
            $image = ImageHelper::uploadImage($config);
            $params['site_banner_image'] = $image['filename'];
        }

        $setting->update($params);
        return redirect()->back()->with('success','Site Settings updated successfully');

    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
		'company_name',
		'site_title',
		'site_title_bn',
		'site_short_description',
		'site_short_description_bn',
		'site_header_logo',		
		'site_footer_logo',		
		'site_favicon',		
		'site_banner_image',		
		'site_email',
		'site_phone_primary',
		'site_phone_secondary',
		'site_address',
		'facebook_url',
		'twitter_url',
		'google_plus_url',
		'linkedin_url',
		'youtube_url',
		'instagram_url',
		'pinterest_url',
		'tumblr_url',
		'flickr_url',
		'recaptcha_key',
		'recaptcha_secret',
		'google_map_api',
		'facebook_key',
		'facebook_secret',
		'twitter_key',
		'twitter_secret',
		'google_plus_key',
		'google_plus_secret',
		'mail_driver',
		'mail_host',
		'mail_port',
		'mail_password',
		'mail_encryption',
		'image_width',
		'image_height',
		'image_size',
		'file_type',
		'notification_type'
    ];
}

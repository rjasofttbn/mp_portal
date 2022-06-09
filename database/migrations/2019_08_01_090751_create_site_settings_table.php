<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Site Settings
            $table->text('company_name')->nullable();
            $table->text('site_title')->nullable();
            $table->text('site_title_bn')->nullable();
            $table->text('site_short_description')->nullable();
            $table->text('site_short_description_bn')->nullable();
            $table->text('site_header_logo')->nullable();
            $table->text('site_footer_logo')->nullable();
            $table->text('site_favicon')->nullable();
            $table->text('site_banner_image')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone_primary')->nullable();
            $table->string('site_phone_secondary')->nullable();
            $table->text('site_address')->nullable();

            // Mail Send settings
            $table->string('mail_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();

            // Social page Url
            $table->text('facebook_url')->nullable();
            $table->text('twitter_url')->nullable();
            $table->text('google_plus_url')->nullable();
            $table->text('linkedin_url')->nullable();
            $table->text('youtube_url')->nullable();
            $table->text('instagram_url')->nullable();
            $table->text('pinterest_url')->nullable();
            $table->text('tumblr_url')->nullable();
            $table->text('flickr_url')->nullable();

            //Google reCaptcha settings            
            $table->text('recaptcha_key')->nullable();
            $table->text('recaptcha_secret')->nullable();

            //Social Login key & secret
            $table->text('facebook_key')->nullable();
            $table->text('facebook_secret')->nullable();
            $table->text('twitter_key')->nullable();
            $table->text('twitter_secret')->nullable();
            $table->text('google_plus_key')->nullable();
            $table->text('google_plus_secret')->nullable();

            //Google Maps Api 
            $table->string('google_map_api')->nullable();

            //Home slider settings 
            $table->text('image_width')->nullable();
            $table->text('image_height')->nullable();
            $table->text('image_size')->nullable();
            $table->text('file_type')->nullable();

            //For Notification like toastr/sweetalert/notifyjs
            $table->tinyInteger('notification_type')->default(1)->comment("1 = toastr; 2 = sweetalert; 3 = notifyjs");
            // $table->text()->nullable();
            // $table->text()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}

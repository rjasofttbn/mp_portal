<?php
 
namespace App\Helpers;
use Image;
 
class ImageHelper{
 
	static function uploadImage($config){
		$image 		= [];		
		$request 	= request();	
		$path = public_path($config['path']).'/';

		$file = $request->file($config['name']);
		if($file){
			if (!is_dir($path)){
			    mkdir($path);     
			}

			$filename = date('Ymd') .'_'.time().rand(0,1000). '.' . $file->getClientOriginalExtension();
			$file->move($path, $filename);
			if(!empty($config['width'] && !empty($config['height']))){
				$interventaion_image = Image::make($path.$filename);
				$interventaion_image->resize($config['width'],$config['height'])->save($path.$filename);
			}
			
			$image['status'] 	= True;
			$image['filename']	= $filename;
			$image['message']	= "Upload successful";

		}else{
			$image['status'] 	= False;
			$image['filename']	= '';
			$image['message']	= "File not found. Plese try again";
		}
		
		return $image;
	}
}

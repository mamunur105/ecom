<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setSuccessMessage($message){
    	session()->flash('message',$message);
    	session()->flash('type','success');
    }

    public function setErrorMessage($message){
    	session()->flash('message',$message);
    	session()->flash('type','danger');
    }

    public function setFileName($photo_file){
		$file_basename = $photo_file->getClientOriginalName();
		$file_basename = pathinfo($file_basename,PATHINFO_FILENAME);
		$file_basename = str_replace(' ', '-', $file_basename);
		$extension = $photo_file->extension();;
		$file_modify_name = $file_basename.'_'.time().'.'. $extension;
		return $file_modify_name ;
    }



}

<?php

use Illuminate\Support\Facades\Storage;

if(!function_exists('handleFileUpload'))
{
    function handleFileUpload($file, $type ,$directory ,$old_path = null)
    {
        $path = '/app/public/'. $directory;
        if($type === 'update' && $old_path){
            if(Storage::exists($old_path))
                Storage::delete($old_path);
        }
        $file_name = time() . '_' .  $file->getClientOriginalName();
        $new_path = $file->storeAs($path, $file_name);
        return env('APP_URL').'/storage/'.str_replace('public/', '', $new_path);
    }
}

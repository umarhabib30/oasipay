<?php

namespace App\Helpers;

use Exception;
use stdClass;

class FileHelper
{
    public static function save($file, $path){
        // Allowed file types
        $allowedMimeTypes = ['image/jpeg', 'image/png','image/jpg','image/webp', 'application/pdf', 'text/plain'];
        if (!in_array($file->getClientMimeType(), $allowedMimeTypes)) {
            throw new Exception('Invalid file type');
        }

        // Generate a unique file name with the correct extension
        $filename = '/file-'.time().'-'.uniqid().'.'.$file->guessExtension();

        // Construct the full path
        $Path = public_path().'/'.$path.'/';

        // Ensure the directory exists
        if (!file_exists($Path)) {
            mkdir($Path, 0777, true); // Create directory if it doesn't exist
        }

        // Move the file to the target location
        $file->move($Path, $filename);

        // Return the path where the file was saved
        return $path . $filename;
    }


    public static function saveFiles($files){
        $savedFiles = [];
        foreach ($files as $key => $file)
        {
            // Generate a file name with extension
            $fileName = 'file-'.time().$key.'.'.$file->getClientOriginalExtension();
            // Save the file

            $object = new stdClass();
            $object->name = 'File-'.($key+1);
            $object->handle = $file->storeAs('public/files', $fileName);
            $savedFiles[] = $object;
        }
        return $savedFiles;
    }

    public static function saveFile($file){

        // Generate a file name with extension
        $fileName = 'file-'.time().'.'.$file->getClientOriginalExtension();
        // Save the file

        $object = new stdClass();
        $object->name = 'File-'. uniqid();
        $object->handle = $file->storeAs('documents', $fileName,'public');
        return $object->handle;
    }
    public static function saveCVFile($file){
        // Generate a file name with extension
        $fileName = 'file-'.time().'.'.$file->getClientOriginalExtension();
        // Save the file

        $object = new stdClass();
        $object->name = 'File-'. uniqid();
        $object->handle = $file->storeAs('cv', $fileName);
        return $object->handle;
    }


}

<?php

class WebpConverter
{
    static $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
    static $scriptPath = HELPERS_PATH . 'cwebp';
    static $outputExtension = '.webp';
    static $quality = '80';

    // folder name is equal to the new post id in the database
    static function upload($images, $folderName) {

        $filescounter = count($images['image']['name']);
        $uploadedCounter = 0;
        $relativePath = 'images'. DS . $folderName . DS;
        $savePath = PUBLIC_PATH . 'images' . DS . $folderName . DS;

        if (!file_exists($savePath)) {
            mkdir($savePath);
        }

        for ($i = 0; $i < $filescounter; $i++) {
            $imageInfo = pathinfo($images['image']['name'][$i]);
            $extension = $imageInfo['extension'];
            $name = md5($imageInfo['filename']);
            $tmpFolder = $images['image']['tmp_name'][$i];

            // if the file is with not allowed extension it will be skipped
            if (!in_array($extension, static::$allowedFormats)) {
                continue;
            }

            if (move_uploaded_file($tmpFolder, $savePath. $name . '.' . $extension)) {
                $convertInput = $savePath . $name . '.' . $extension;
                $convertOutput = $savePath . $name . static::$outputExtension;
                $script = static::$scriptPath . ' -q ' . static::$quality .  ' ' . $convertInput . ' -o ' . $convertOutput;
                static::convert($script);
                
            }

        }

    }

    // converts uploaded images to webp format (default quality - 80)
    static function convert($script)
    {
        $output = null;
        $code = null;
        exec($script, $output, $code);
    }

}
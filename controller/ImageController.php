<?php

class ImageController
{
    static $allowedFormats = ['jpg', 'jpeg', 'png'];
    static $scriptPath = HELPERS_PATH . 'cwebp';
    static $outputExtension = 'webp';
    static $quality = '80';
    static $resizeWidth = 1024;
    static $resizeHeigth = 768;
    static $imageFolder = 'images';

    // folderName equals to the new post id in the database
    static function upload($images, $folderName) {
        $data = [];
        $filescounter = count($images['image']['name']);

        /* @uploadedCounter Collects all image paths which relate to this post and which are successfully uploaded 
        and converted and pass them for database upload */
        $relativePath = static::$imageFolder . DS . $folderName . DS;

        // Checks whether is created image folder and creates it if its not created yet
        if(!file_exists(PUBLIC_PATH . static::$imageFolder)) {
            mkdir(PUBLIC_PATH . static::$imageFolder);
        }

        $savePath = PUBLIC_PATH . static::$imageFolder . DS . $folderName . DS;


        // Creates folder to save images if it is not created yet
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
                $originalFilename =  $name . '.' . $extension;
                $convertedFilename = $name . '.' . static::$outputExtension;
                $scriptInput = $savePath . $originalFilename;
                $scriptOutput = $savePath . $convertedFilename;
                $resize = static::reszie($scriptInput, $scriptOutput);
                if ($resize !== 0) {
                    continue;
                }

                $convert = static::convert($scriptInput, $scriptOutput);
                

                // If @convert not equals to 0 the script is failed and only the original image should be uploaded
                if ($convert !== 0) {

                    array_push($data, static::prepareData($relativePath, $originalFilename, (int) $folderName, $extension));
                    continue;
                }
                array_push($data, static::prepareData($relativePath, $originalFilename, (int) $folderName, $extension));
                array_push($data, static::prepareData($relativePath, $convertedFilename, (int) $folderName, static::$outputExtension));

            }

        }
        if (!empty($data)) {
            static::recordToDatabase($data);
        }
    }

    // Converts uploaded images to webp format (default quality - 80)
    static function convert($scriptInput, $scriptOutput)
    {
        $script = static::$scriptPath . ' -q ' . static::$quality .  ' ' . $scriptInput . ' -o ' . $scriptOutput;
        $output = null;
        $code = null;
        exec($script, $output, $code);
        return $code;
        
    }

    static function reszie($scriptInput)
    {
        $script = static::$scriptPath . ' -resize ' . static::$resizeWidth . ' ' . static::$resizeHeigth . ' -q ' . static::$quality .  ' ' . $scriptInput . ' -o ' . $scriptInput;
        $output = null;
        $code = null;
        exec($script, $output, $code);
        return $code;
        
    }


    // Records all uploaded images which are passed the restrictions to the database
    static function recordToDatabase($data) {

        require_once (MODEL_PATH . 'Image.php');

        foreach ($data as $imageData) {
            $image = new Image;
            $result = $image->insertRow($imageData);
        }
    }

    // Prepares array with requirement data for each image
    static function prepareData($relativePath, $imagePath, $relatedPostId, $format) {

        return $imageData = [ 'path' => $relativePath . $imagePath, 'related_post_id' => $relatedPostId, 'format' => $format ];

    }

}
<?php

namespace App\Utilities;

class Appfiles
{

    public static function saveFile($filePath, $extension, $folder = "", $prefix = "")
    {
        $data = file_get_contents($filePath);
        $filename = "";
        $newFilePath = "";
        $exists = true;

        while ($exists)
        {
            $filename = (($prefix) ? ($prefix . "-") : "" ) .
                number_format(microtime(true) * 10000, 0, '.', '') . "." . $extension;
            $newFilePath = public_path() . "/files/" . (($folder) ? ($folder . "/") : "" ) . $filename;
            $exists = file_exists($newFilePath);
        }

        file_put_contents($newFilePath, $data);
        return $filename;
    }

    public static function saveBase64Image($base64_string, $folder = "", $prefix = "")
    {
        $random = uniqid($prefix);
        $data = explode(',', $base64_string);
        $ext = "";
        if ($data[0] == "data:image/png;base64")
        {
            $ext = "png";
        }
        else if ($data[0] == "data:image/jpg;base64" || $data[0] == "data:image/jpeg;base64")
        {
            $ext = "jpg";
        }
        if (!$ext)
        {
            return false;
        }

        $newFilename = $random . "." . $ext;
        $newFilePath = public_path() . "/files/" . (($folder) ? ($folder . "/") : "" ) . $newFilename;

        file_put_contents($newFilePath, base64_decode($data[1]));
        return $newFilename;
    }

    public static function saveFileFromFacebook($fbuserid)
    {
        $filename = uniqid("fbuser_") . ".jpg";
        $url = "http://graph.facebook.com/" . $fbuserid . "/picture?width=200&height=200";
        $data = file_get_contents($url);

        file_put_contents(public_path() . "/files/users/" . $filename, $data);
        return $filename;
    }

    public static function getImageUrl($image, $path = "")
    {
        return config("app.url") . "files/" . $path . $image;
    }

    public static function removeFile($filename)
    {
        unlink(public_path() . "/files/" . $filename);
    }

}

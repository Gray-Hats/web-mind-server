<?php

require_once '../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

class UploadResult {
  // Properties
  public $bucket_name;
  public $url;
}



function uploadFile($fileObj, $cloudPath) {
    $bucketName = "webmind-e-learning-system";
    
    try {
        
        $file = pathinfo($fileObj['file']['name']);
        $prefix = uniqid('profile_', true); //generate random string to avoid name conflicts
        $filename = $cloudPath."/".$prefix . "." . $file['extension'];

        $storage = new StorageClient([
            'keyFilePath' => getcwd().'/../cloud-config.json',
        ]);
        $bucket = $storage->bucket($bucketName);

        $storageObject = $bucket->upload(
            fopen($fileObj['file']['tmp_name'], 'r'),
            ['name' => $filename]
        );

        if($storageObject != null) {

            $res = new UploadResult();
            $res->bucket_name = $filename;
            $res->url = "https://storage.googleapis.com/$bucketName/$filename";
        
            return $res;
        }
        else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }

}

function deleteFile($filename) {
    $bucketName = "webmind-e-learning-system";
    
    try {
        $storage = new StorageClient([
            'keyFilePath' => getcwd().'/../cloud-config.json',
        ]);

        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($filename);
     
        $object->delete();

        return true;

    } catch (Exception $e) {
        return false;
    }
}

?>
<?php 
namespace App\Controller;

require './../../vendor/autoload.php';

use App\Model\FileUpload;


$request = $_POST;
$requestFile = $_FILES;

$method = $request['method'] ?? null;

try {

    if (!isset($request['enviar']) || !empty($method)) {

        switch ($method) {
            case 'store':
        
                $file = new FileUpload($requestFile['file']);
                $file->setExtension(array('jpg', 'png', 'jpeg', 'pdf'));
                $file->upload();

                break;
            
            default:
                break;
        }
    
    } else {

      die("Error Processing Request");

    }

} catch (RuntimeException $e) {
    echo $e->getMessage();
}


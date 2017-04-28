<?php


namespace Controller\UploadProfiles;


use Core\Services\X;
use Kamille\Architecture\Controller\ControllerInterface;
use Module\UploadProfiles\ProfileCollection\ProfileCollectionInterface;

class UploadController implements ControllerInterface
{


    public function handleUpload()
    {
        a("kk");
        a($_GET);
        a($_FILES);
        if (array_key_exists("file", $_GET)) {
            $file = $_GET['file'];


            $coll = X::get("UploadProfilesServices_profileCollection");
            /**
             * @var $coll ProfileCollectionInterface
             */
            $profiles = $coll->getProfiles();
            if (array_key_exists($file, $profiles)) {
                a("kk");
            }
            a("ss");


        }
    }


}
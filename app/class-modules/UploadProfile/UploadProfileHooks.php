<?php


namespace Module\UploadProfile;


class UploadProfileHooks
{


    protected static function Core_feedAjaxUri2Controllers(array &$uri2Controllers)
    {
        $uri2Controllers[\Kamille\Services\XConfig::get("UploadProfile.uploadUri")] = "Controller\UploadProfile\UploadController:handleUpload";
    }
}
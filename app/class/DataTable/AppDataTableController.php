<?php


namespace DataTable;


use Core\Controller\ApplicationController;
use Kamille\Architecture\Response\Web\GscpErrorResponse;
use Kamille\Architecture\Response\Web\GscpResponse;
use Kamille\Architecture\Response\Web\GscpSuccessResponse;

class AppDataTableController extends ApplicationController
{


    public function handleAjaxAction()
    {
        $type = $_GET['type'];
        $id = "";
        $s = "";
        if ('action' === $type) {
            $id = $_POST['id'];
            switch ($id) {
                case 'all':
                    break;
                default:
                    break;
            }
        } elseif ('bulk' === $type) {
            $id = $_POST['id'];
            switch ($id) {
                case 'all':
                    break;
                default:
                    break;
            }
        }
        $s .= "type: $type,";
        return GscpSuccessResponse::create("ok, $s id=" . $id);
        return GscpErrorResponse::create("ok, $s id=" . $id);
    }


}
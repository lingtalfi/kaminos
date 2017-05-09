<?php


namespace Controller\DataTable;


use Bat\ObTool;
use Core\Architecture\Response\Web\ModalGscpResponse;
use Core\Controller\ApplicationController;
use Core\Services\A;
use Core\Services\X;
use Kamille\Architecture\Response\Web\JsonResponse;
use Kamille\Services\XLog;
use ModelRenderers\Renderer\ModelAwareRendererInterface;
use Models\DataTable\DataTableModel;
use Module\DataTable\DataTableProfileFinder\DataTableProfileFinderInterface;
use PersistentRowCollection\Finder\PersistentRowCollectionFinderInterface;
use PersistentRowCollection\PersistentRowCollectionInterface;
use PersistentRowCollection\Util\PersistentRowCollectionHelper;
use RowsGenerator\ArrayRowsGenerator;
use RowsGenerator\QuickPdoRowsGenerator;
use RowsGenerator\RowsGeneratorInterface;
use RowsGenerator\Util\RowsTransformerUtil;

class CrudController extends ApplicationController
{
    public function handleCrud()
    {
        if (
            array_key_exists('id', $_POST) &&
            array_key_exists('ric', $_POST) &&
            array_key_exists('prc', $_GET)
        ) {
            try {

                $prcId = $_GET['prc'];
                /**
                 * @var $finder PersistentRowCollectionFinderInterface
                 */
                $finder = X::get("Core_PersistentRowCollectionFinder");
                if (false === ($prc = $finder->find($prcId))) {
                    return $this->log("Prc not found with id $prcId", true);
                }

                $id = $_POST['id'];
                $ric = $_POST['ric'];
                $successResponse = null; // other than null means success
                switch ($id) {
                    case 'delete':
                        $badge = $prcId . ".delete";
                        A::has($badge, true);
                        $prc->delete(PersistentRowCollectionHelper::combineRic($ric, $prc->getRic()));
                        $successResponse = $this->getSuccessResponse("The entry has been successfully deleted");
                        break;
                    default:
                        return $this->log("Don't know how to handle this id: $id");
                        break;
                }


                if (null !== $successResponse) {
                    return $successResponse;
                }

            } catch (\Exception $e) {
                $this->log("$e");
                ObTool::cleanAll();
                return ModalGscpResponse::make($e->getMessage(), "error", $this->getModalTitle());
            }
        } else {
            return JsonResponse::create([
                'type' => 'error',
                'data' => "no id or ric or prc",
            ]);
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function log($msg, $response = true)
    {
        $msg = "CrudController: " . $msg;
        XLog::error("$msg");
        if (true === $response) {
            return ModalGscpResponse::make($msg, "error", $this->getModalTitle());
        }
    }

    private function getSuccessResponse($msg)
    {
        return ModalGscpResponse::make($msg, "success", "Yes!");
    }

    private function getModalTitle()
    {
        return "Oops: An error occurred";
    }
}
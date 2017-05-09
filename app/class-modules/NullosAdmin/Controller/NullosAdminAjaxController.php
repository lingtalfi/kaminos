<?php


namespace Controller\NullosAdmin;


use Core\Controller\ApplicationController;
use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputSubmitControl;
use FormModel\Control\InputTextControl;
use FormModel\FormModel;
use Kamille\Architecture\Response\Web\GscpSuccessResponse;
use Kamille\Architecture\Response\Web\HttpResponse;
use Module\NullosAdmin\FormModel\Collection\FormModelCollection;

class NullosAdminAjaxController extends ApplicationController
{

    public function handleRequest()
    {
        $type = "json";


        $id = $_GET['id'];
        switch ($id) {
            case 'users':

                $formModel = FormModelCollection::create()->

                $viewId = "NullosAdmin/ajax/test";
                return $this->renderAjaxByViewId($viewId, [
                    "widgets" => [
                        "main.form" => [
                            "conf" => [
                                "formModel" => $formModel->getArray(),
                            ],
                        ],
                    ],
                ]);
                break;
            default:
                break;
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function renderModalByViewId($viewId, array $config = [])
    {
        $c = $this->renderAjaxByViewId($viewId, $config);
        return $this->renderModal($c);
    }


    protected function renderModal($content)
    {


        $content = <<<EEE
                   <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            {body}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
EEE;

        $content = str_replace('{body}', $c, $content);
        return GscpSuccessResponse::create($content);
    }

}
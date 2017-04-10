<?php


namespace Controller\Test;


use Core\Controller\ApplicationController;
use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputSubmitControl;
use FormModel\Control\InputTextControl;
use FormModel\FormModel;
use FormModel\FormModelInterface;
use Kamille\Architecture\Application\Web\WebApplication;
use Kamille\Architecture\Request\Web\HttpRequestInterface;
use Kamille\Architecture\Response\Web\HttpResponse;
use Kamille\Architecture\Response\Web\RedirectResponse;
use Kamille\Ling\Z;

class TestController extends ApplicationController
{


    public function render()
    {
        return $this->renderByViewId("loginForm", function (array &$conf) {


            $formConf = $conf['widgets']['main.loginForm']['conf'];

            /**
             * @var $formModel FormModelInterface
             */
            $formModel = FormModel::create()
                ->addControl("username", InputTextControl::create()
                    ->placeholder($formConf['textUserName'])
                    ->name($formConf['nameUserName'])
                )
                ->addControl("password", InputPasswordControl::create()
                    ->placeholder($formConf['textPassword'])
                    ->name($formConf['namePassword'])
                )
                ->addControl("submit", InputSubmitControl::create()
                    ->value($formConf['textSubmit'])
                    ->name("form_posted")
                );

            if (array_key_exists("form_posted", $_POST)) {
                $formModel->inject($_POST);
                if (true === $formModel->validate($_POST)) {
                    az($_POST);
                    $url = Z::uri(null, ["success" => "1"], false, true);
                    return RedirectResponse::create($url);
                }
            }

            $conf['widgets']['main.loginForm']['conf']['formModel'] = $formModel->getArray();
        });
    }


}
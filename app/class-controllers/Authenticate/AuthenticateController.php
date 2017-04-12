<?php


namespace Controller\Authenticate;


use Authenticate\SessionUser\SessionUser;
use Authenticate\UserStore\UserStoreInterface;
use Authenticate\Util\UserToSessionConvertor;
use Core\Controller\ApplicationController;
use Core\Services\X;
use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputSubmitControl;
use FormModel\Control\InputTextControl;
use FormModel\FormModel;

class AuthenticateController extends ApplicationController
{


    public function renderForm()
    {
        $key = "AuthenticateController_renderForm";


        //--------------------------------------------
        // FORM MODEL DEFINITION
        //--------------------------------------------
        $formModel = FormModel::create()
            ->setFormErrorPosition('central')
            ->addControl("name", InputTextControl::create()
                ->placeholder("Name")
                ->name("name")
            )
            ->addControl("password", InputPasswordControl::create()
                ->placeholder("Password")
                ->name("pass")
            )
            ->addControl("submit", InputSubmitControl::create()
                ->name($key)
                ->addHtmlAttribute("value", "Send")
            );





        //--------------------------------------------
        // HANDLING SUBMIT
        //--------------------------------------------
        if (array_key_exists($key, $_POST)) {
            $name = $_POST['name'];
            $pass = $_POST['pass'];


            /**
             * @var $userStore UserStoreInterface
             */
            $userStore = X::get("Authenticate_userStore");
            if (false !== ($user = $userStore->getUserByCredentials($name, $pass))) {

                $props = UserToSessionConvertor::toSession($user);
                SessionUser::connect($props);

                // redirect to any page

            } else {
                // say: invalid credentials
            }

        }




        //--------------------------------------------
        // DISPLAYING THE VIEW
        //--------------------------------------------
        return $this->renderByViewId("Authenticate/loginForm", [
            "widgets" => [
                "main.loginForm" => [
                    "conf" => [
                        "formModel" => $formModel->getArray(),
                    ],
                ],
            ],
        ]);
    }


}
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
use FormModel\FormModelInterface;
use Kamille\Architecture\Response\Web\RedirectResponse;
use Kamille\Services\XConfig;
use Models\Notification\NotificationsModel;

class AuthenticateController extends ApplicationController
{


    public function renderForm()
    {
        $key = "AuthenticateController_renderForm";
        $notifications = NotificationsModel::create();
        $isConnected = SessionUser::isConnected();


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
        $doRedirect = false;
        if (array_key_exists($key, $_POST)) {
            $name = $_POST['name'];
            $pass = $_POST['pass'];


            /**
             * @var $formModel FormModelInterface
             */
            $formModel = $formModel->inject($_POST);
            if (true === $formModel->validate($_POST)) {


                /**
                 * @var $userStore UserStoreInterface
                 */
                $userStore = X::get("Authenticate_userStore");
                if (false !== ($user = $userStore->getUserByCredentials($name, $pass))) {

                    $props = UserToSessionConvertor::toSession($user);
                    SessionUser::connect($props);

                    $doRedirect = true;
                    // redirect to the page defined in the module
                    return RedirectResponse::create(0);


                } else {
                    // say: invalid credentials
                    $notifications->addNotification("error", "Error", "Invalid credentials were provided");
                }
            }

        }

        //--------------------------------------------
        // DISPLAYING THE VIEW
        //--------------------------------------------
        return $this->renderByViewId("Authenticate/loginForm", [
            "widgets" => [
                "main.notification" => [
                    "conf" => [
                        "notifications" => $notifications->getArray(),
                    ],
                ],
                "main.loginForm" => [
                    "conf" => [
                        "formModel" => $formModel->getArray(),
                    ],
                ],
            ],
        ]);
    }


}
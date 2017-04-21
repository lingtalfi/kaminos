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
use Kamille\Ling\Z;
use Kamille\Services\XConfig;
use Kamille\Utils\Routsy\RoutsyUtil;
use Models\Notification\NotificationsModel;

/**
 * There is only one method in this controller,
 * we use the treat'n'display technique for the forms, which is described below.
 *
 * The form is first display,
 * the same controller is used for processing the form,
 * which is handy to handle data persistency in case of form errors.
 *
 * On a successful form post, we always connect the user.
 * Then, we can choose to redirect or not.
 *
 * To not redirect is useful in case the form is embedded in the page,
 * like a form in the top bar present on any page.
 * Of course the form widget needs to change its state depending on whether or not the
 * user is connected (or maybe we need two separated widgets for that, I haven't dig to much yet).
 *
 * To redirect comes handy when the form is a back end login form which takes the whole screen.
 * Then, when her credentials are passed successfully, the user enters the admin home page for instance.
 *
 *
 *
 *
 *
 *
 */
class AuthenticateController extends ApplicationController
{


    public function renderForm()
    {
        $key = "AuthenticateController_renderForm";
        $tf = "common/form";
        $t = $this->getTranslationContext();
        $notifications = NotificationsModel::create();
        $isConnected = SessionUser::isConnected();


        //--------------------------------------------
        // FORM MODEL DEFINITION
        //--------------------------------------------
        $formModel = FormModel::create()
            ->setFormErrorPosition('central')
            ->addControl("name", InputTextControl::create()
                ->placeholder(__("label.name", $tf))
                ->name("name")
            )
            ->addControl("password", InputPasswordControl::create()
                ->placeholder(__("label.password", $tf))
                ->name("pass")
            )
            ->addControl("submit", InputSubmitControl::create()
                ->name($key)
                ->addHtmlAttribute("value", __("label.send", $tf))
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
                    $sessionTimeout = XConfig::get("Authenticate.sessionTimeout");
                    SessionUser::connect($props, $sessionTimeout);


                    $onSuccessRedirectMode = XConfig::get("Authenticate.onSuccessRedirectMode");
                    if (true === $onSuccessRedirectMode) {
                        // redirect to the current page with success flag on
                        return RedirectResponse::create(Z::uri(null, ["success" => 1], false, true));
                    } elseif ("uri" === $onSuccessRedirectMode) {
                        $uri = XConfig::get("Authenticate.onSuccessRedirectValue");
                        return RedirectResponse::create($uri);
                    } elseif ("route" === $onSuccessRedirectMode) {
                        $routeIdentifier = XConfig::get("Authenticate.onSuccessRedirectValue");
                        return RedirectResponse::create(RoutsyUtil::routeIdentifierToUri($routeIdentifier));
                    }

                } else {
                    // say: invalid credentials
                    $notifications->addNotification("error", __("title.error", $tf), __("message.error", $tf, ["error" => __("invalid.credentials", $t)]));
                }
            }

        }

        //--------------------------------------------
        // SUCCESS MESSAGE
        //--------------------------------------------
        if (array_key_exists("success", $_GET)) {
            $notifications->addNotification("success", __("title.success", $tf), __("message.success", $tf));
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
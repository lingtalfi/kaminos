<?php


namespace Controller\NullosAdmin;


use Core\Architecture\Response\Web\ModalGscpResponse;
use Core\Services\A;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Response\Web\GscpResponse;
use Kamille\Services\XConfig;
use Kamille\Services\XLog;
use Kamille\Utils\Laws\Config\LawsConfig;
use Models\Notification\NotificationsModel;
use PersistentRowCollection\Util\PersistentRowCollectionHelper;

class CrudController extends NullosAdminController
{


    public function render()
    {
        /**
         * type can be: list|form|form-update
         */
        $type = (array_key_exists('type', $_GET)) ? $_GET['type'] : 'list';
        $prcId = (array_key_exists('prc', $_GET)) ? $_GET['prc'] : null;

        if (null !== $prcId) {
            switch ($type) {
                case 'ajaxForm':
                case 'ajaxFormPost':
                case 'form':
                case 'formPost':


                    $isAjax = false;
                    if ('ajaxForm' === $type || "ajaxFormPost" === $type) {
                        $isAjax = true;
                    }

                    $ric = null;
                    $isUpdate = false;
                    $formMode = 'insert';
                    if (array_key_exists('ric', $_POST)) {
                        $isUpdate = true;
                        $formMode = 'update';
                        $ric = $_POST['ric'];
                    }


                    $p = explode(".", $prcId);
                    $prcName = array_pop($p);
                    $title = $prcName; /* todo: use translate... */

                    $prc = A::getPrc($prcId);
                    $formModel = $prc->getForm($formMode, $ric);


                    $listLink = A::prcLink($prcId, "list");
                    $notifs = NotificationsModel::create();


                    $isSuccess = true;
                    if ('formPost' === $type || "ajaxFormPost" === $type) {
                        $isSuccess = false;
                        $formModel->inject($_POST);
                        if (true === $formModel->validate($_POST)) {


                            try {
                                if (false === $isUpdate) {
                                    $ric = $prc->create($_POST);
                                    $msg = "The item was inserted successfully.";
                                    $msg .= '&nbsp;&nbsp;<br><a href="' . $listLink . '">Back to the list</a>';
                                    $notifs->addNotification("success", "Yes!", $msg);
                                    $isSuccess = true;
                                } else {
                                    $ric = $_POST['ric'];
                                    unset($_POST['ric']);
                                    $aRic = PersistentRowCollectionHelper::combineRic($ric, $prc->getRic());
                                    $prc->update($aRic, $_POST);
                                    $msg = "The item was updated successfully.";
                                    $msg .= '&nbsp;&nbsp;<br><a href="' . $listLink . '">Back to the list</a>';
                                    $notifs->addNotification("success", "Yes!", $msg);
                                    $isSuccess = true;
                                }


                            } catch (\Exception $e) {
                                $msg = "The form was posted successfully, ";
                                $msg .= "but a problem occurred while creating the record, please contact the webmaster, sorry.";
                                XLog::error("CrudController: couldn't create the row in the persistent collection. $e");
                                $notifs->addNotification("error", "Oops!", $msg);
                            }

                        }
                    } else {
                        if (array_key_exists('ric', $_POST)) {
                            $ric = $_POST['ric'];
                            if (false !== ($values = $prc->readByRic($ric))) {
                                $formModel->inject($values);
                            } else {
                                if (true === ApplicationParameters::get('debug')) {
                                    XLog::error("CrudController: ric not matching any row: $ric");
                                }
                            }
                        }
                    }


                    $uriPost = "formPost";
                    $dataAjax = 0;
                    if (true === $isAjax) {
                        $uriPost = "ajaxFormPost";
                        $dataAjax = 1;
                    }

                    $formArray = $formModel->getArray();
                    $formArray['form']['htmlAttributes']['action'] = 'crud?type=' . $uriPost . '&prc=' . $prcId;
                    $formArray['form']['htmlAttributes']['method'] = "POST";
                    $formArray['form']['htmlAttributes']['data-ajax'] = "$dataAjax";
                    $formArray['form']['formErrorPosition'] = "control";


                    //--------------------------------------------
                    // SWITCH BETWEEN AJAX FORM AND STATIC FORM
                    //--------------------------------------------
                    $position = "maincontent";
                    if (true === $isAjax) {
                        $position = 'main';
                    }
                    $config = [
                        'widgets' => [
                            $position . '.notifications' => [
                                'grid' => "1",
                                "tpl" => "Notification/default",
                                'conf' => [
                                    'notifications' => $notifs->getArray(),
                                ],
                            ],
                            $position . '.crudForm' => [
                                'grid' => "1",
                                'tpl' => "NullosAdmin/Main/Form/default",
                                'conf' => [
                                    "wrap" => true,
                                    "title" => $title,
                                    "subtitle" => '<a href="' . $listLink . '">Back to the list</a>',
                                    "formModel" => $formArray,
                                    /**
                                     * onAjaxPostMode:
                                     *      - reloadIfSuccess: will refresh the page if the form validates
                                     */
                                    "onAjaxPostMode" => "reloadIfSuccess",
                                ],
                            ],
                        ],
                        "grid" => [$position],
                    ];

                    if (true === $isAjax) {

                        $responseType = (true === $isSuccess) ? 'success' : 'error';

                        $config['layout']['tpl'] = "ajax/default";
                        $config['widgets']['main.crudForm']['conf']['wrap'] = false;
                        $config['widgets']['main.crudForm']['conf']['isAjax'] = true;


                        $content = $this->renderAjaxByViewId("NullosAdmin/crudForm", function (array &$c) use ($config) {
                            unset($c['maincontent.crudForm']);
                            $c = $config;
                        });

                        if ('ajaxFormPost' === $type) {
                            /**
                             * If ajax is called, a modal is already opened, we just pass the content of the modal.
                             */
                            return GscpResponse::make($content, $responseType);
                        }
                        return ModalGscpResponse::make($content, $responseType, $title);
//                            ->setJsInitScript("/path");
                    }
                    return $this->renderByViewId("NullosAdmin/crudForm", LawsConfig::create()->replace($config));

                    break;
                case "delete":

                    try {

                        $ric = $_POST['ric'];
                        $prc = A::getPrc($prcId);
                        $aRic = PersistentRowCollectionHelper::combineRic($ric, $prc->getRic());
                        $prc->delete($aRic);
                        return ModalGscpResponse::make('The item has been deleted', 'success', 'Kool!');
                    } catch (\Exception $e) {
                        XLog::error("$e");
                        return ModalGscpResponse::make('An error occurred, the item might not be deleted, please check the logs', 'error', 'Oops!');
                    }

                    break;
                default:
                    $dataTableProfileId = str_replace('.', '/', $prcId);
                    $p = explode('.', $prcId);
                    $title = array_pop($p);
                    return $this->renderByViewId("NullosAdmin/dataTable", LawsConfig::create()->replace([
                        'widgets' => [
                            'maincontent.dataTable' => [
                                'conf' => [
                                    "showHeader" => true,
                                    "title" => $title,
                                    "profileId" => $dataTableProfileId,
                                ],
                            ],
                        ],
                    ]));
                    break;
            }
        } else {
            return $this->renderPageError("You need to define the prc first");
        }

    }


}
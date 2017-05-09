<?php


namespace Controller\NullosAdmin;


use Core\Services\A;
use Kamille\Services\XConfig;

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
                case 'form':


                    $p = explode(".", $prcId);
                    $prcName = array_pop($p);
                    $title = $prcName; /* todo: use translate... */

                    $prc = A::getPrc($prcId);
                    $formModel = $prc->getForm('insert');
                    $listLink = A::prcLink($prcId, "list");
                    return $this->renderByViewId("NullosAdmin/crudForm", [
                        'widgets' => [
                            'maincontent.crudForm' => [
                                'conf' => [
                                    "title" => $title,
                                    "subtitle" => '<a href="' . $listLink . '">Back to the list</a>',
                                    "formModel" => $formModel->getArray(),
                                ],
                            ],
                        ],
                    ]);
                    break;
                default:
                    $profileId = str_replace('.', '/', $prcId);
                    $p = explode('.', $prcId);
                    $title = array_pop($p);
                    return $this->renderByViewId("NullosAdmin/dataTable", [
                        'widgets' => [
                            'maincontent.dataTable' => [
                                'conf' => [
                                    "showHeader" => true,
                                    "title" => $title,
                                    "profileId" => $profileId,
                                ],
                            ],
                        ],
                    ]);
                    break;
            }
        } else {
            return $this->renderPageError("You need to define the prc first");
        }

    }


}
<?php


namespace Core\Architecture\Response\Web;


use Core\Services\Hooks;
use Core\Services\X;
use Kamille\Architecture\Response\Web\HttpResponse;
use Kamille\Utils\Laws\LawsUtilInterface;


/**
 * This gscp response comes with modal capabilities.
 *
 * For modals, by default it uses the ModalContent widget (https://github.com/KamilleWidgets/ModalContent)
 * if found.
 *
 */
class ModalGscpResponse extends HttpResponse
{

    private $type;
    private $modalTitle;
    private $modalTemplate;
    private $buttons;

    public static function make($data, $type = "success", $title = null)
    {
        $o = parent::create($data, 200);
        $o->type = $type;
        $o->modalTitle = $title;
        $buttons = [
            "close" => [
                "flavour" => "default",
                "label" => "Close",
                "htmlAttr" => [],
            ],
        ];
        Hooks::call("Core_ModalGscpResponseDefaultButtons", $buttons);
        $o->buttons = $buttons;
        $o->modalTemplate = "ModalContent/default";
        return $o;
    }

    public function setModalTemplate($modalTemplate)
    {
        $this->modalTemplate = $modalTemplate;
        return $this;
    }

    public function setButtons(array $buttons)
    {
        $this->buttons = $buttons;
        return $this;
    }

    public function addButton($id, array $button)
    {
        $this->buttons[$id] = $button;
        return $this;
    }





    //--------------------------------------------
    //
    //--------------------------------------------
    protected function sendContent()
    {
        /**
         * @var $laws LawsUtilInterface
         */
        $laws = X::get("Core_lawsUtil");
        $content = $laws->renderLawsView([
            "layout" => [
                "tpl" => "ajax/default",
            ],
            "widgets" => [
                "main.modal" => [
                    "tpl" => $this->modalTemplate,
                    "conf" => [
                        "type" => $this->type,
                        "title" => $this->modalTitle,
                        "message" => $this->content,
                        "buttons" => $this->buttons,
                    ],
                ],
            ],
        ]);

        echo json_encode([
            'type' => $this->type,
            'data' => $content,
        ]);
    }


}
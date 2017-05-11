<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;
use FormModel\Control\InputPasswordControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_backoffice_userPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_backoffice_user");
        $this->fields = '
ek_backoffice_user.id,
ek_backoffice_user.email,
ek_backoffice_user.pass,
ek_lang.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_backoffice_user
inner join kamille.ek_lang on kamille.ek_lang.id=ek_backoffice_user.lang_id
';
    }


    public function getRic()
    {
        return [
    'id',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        
    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("email", InputTextControl::create()
                ->label("email")
                ->name("email")
            )
            ->addControl("pass", InputPasswordControl::create()
                ->label("pass")
                ->name("pass")
            )
            ->addControl("lang_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_lang')
                 
                ->label("lang_id")
                ->name("lang_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}
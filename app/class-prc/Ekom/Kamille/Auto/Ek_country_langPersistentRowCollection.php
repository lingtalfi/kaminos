<?php



namespace Prc\Ekom\Kamille\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_country_langPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_country_lang");
        $this->fields = '
ek_country_lang.country_id,
ek_country_lang.lang_id,
ek_country_lang.label,
ek_country.iso_code,
ek_lang.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_country_lang
inner join kamille.ek_country on kamille.ek_country.id=ek_country_lang.country_id
inner join kamille.ek_lang on kamille.ek_lang.id=ek_country_lang.lang_id
';
    }


    public function getRic()
    {
        return [
    'country_id',
    'lang_id',
    'label',
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
            ->addControl("country_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, iso_code from kamille.ek_country')
                 
                ->label("country_id")
                ->name("country_id")
            )
            ->addControl("lang_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_lang')
                 
                ->label("lang_id")
                ->name("lang_id")
            )
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}
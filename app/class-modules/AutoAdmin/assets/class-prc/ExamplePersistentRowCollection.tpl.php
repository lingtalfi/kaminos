<?php



//-namespace


//-use
use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class ExamplePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("{db}.{table}");
        $this->fields = '{fields}';
        $this->query = '{query}';
    }


    public function getRic()
    {
        return $ric;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        //-validator
    }

    protected function decorateFormModel(FormModel $model)
    {
        //-model
    }

    protected function getAutoIncrementedColumn()
    {
        return $aic;
    }
}
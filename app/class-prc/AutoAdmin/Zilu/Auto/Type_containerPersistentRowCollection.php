<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Type_containerPersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.type_container");
        $this->fields = '
type_container.id,
type_container.label,
type_container.poids_max,
type_container.volume_max
';
        $this->query = '
SELECT
%s
FROM zilu.type_container
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
        $validator
			->setTests("label", "label", [
                RequiredControlTest::create(),
            ])
			->setTests("poids_max", "poids_max", [
                RequiredControlTest::create(),
            ])
			->setTests("volume_max", "volume_max", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            )
            ->addControl("poids_max", InputTextControl::create()
                ->label("poids_max")
                ->name("poids_max")
            )
            ->addControl("volume_max", InputTextControl::create()
                ->label("volume_max")
                ->name("volume_max")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}
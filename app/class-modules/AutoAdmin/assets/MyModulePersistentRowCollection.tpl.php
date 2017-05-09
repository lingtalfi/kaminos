<?php


namespace Prc\{ModuleName};


use Core\Framework\PersistentRowCollection\ApplicationPersistentRowCollection;
use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputTextControl;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use FormModel\Validation\ControlTest\WithFields\MinCharControlTest;
use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\NullosFormModel;
use PersistentRowCollection\InteractivePersistentRowCollectionInterface;

class UserPersistentRowCollection extends ApplicationPersistentRowCollection
{


    public function getForm($type)
    {

        $validator = ControlsValidator::create()
            ->setTests("name", "Name", [
                RequiredControlTest::create(),
                MinCharControlTest::create()->min(10),
            ]);


        return NullosFormModel::create()
            ->setValidator($validator)
            ->addControl("id", InputTextControl::create()
                ->label("id")
                ->name("id")
            )
            ->addControl("name", InputTextControl::create()
                ->label("name")
                ->name("name")
            )
            ->addControl("pass", InputPasswordControl::create()
                ->label("password")
                ->name("pass")
            )
            ->addControl("profile", InputTextControl::create()
                ->label("profile")
                ->name("profile")
            );
    }

    public function create(array $row)
    {
        // TODO: Implement create() method.
    }

    public function read(&$page, $nipp, array $searchValues = [], array $sortValues = [], &$nbTotalItems = 0)
    {
        $rand = 10;
        $ret = [];
        for ($i = 1; $i <= $rand; $i++) {
            $ret[] = $this->getRandomRow($i);
        }
        $nbTotalItems = $rand;
        if ($page < 1) {
            $page = 1;
        }
        $maxPage = 500;
        if ($page > $maxPage) {
            $page = $maxPage;
        }
        return $ret;
    }

    public function readByRic($ric)
    {
        return [
            "id" => 6,
            "name" => "Jean-Louis",
            "pass" => "tamere",
            "profile" => "tarace",
        ];
    }


    public function update(array $ric, array $newRow)
    {
        // TODO: Implement update() method.
    }

    public function delete(array $ric)
    {
        return true;
    }

    public function getRic()
    {
        return ["id"];
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    private function getRandomRow($i)
    {
        return [
            "id" => "$i",
            "name" => "Name $i",
            "pass" => "Pass $i",
            "profile" => "Profile $i",
            "action" => "",
        ];
    }
}
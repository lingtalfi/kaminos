<?php


namespace Module\NullosAdmin\Authenticate\Users;


use Authenticate\UserStore\FileUserStore;
use Authenticate\UserStore\UserStoreInterface;
use Core\Services\X;
use CrudWithFile\CrudWithFile;
use CrudWithFile\CrudWithFileInterface;
use GetRowsInterface\GetRowsInterface;
use Kamille\Services\XConfig;
use Kamille\Utils\ModuleInstallationRegister\ModuleInstallationRegister;

class AuthenticateUsersRowsAdapter implements GetRowsInterface
{

    /**
     * @var CrudWithFileInterface
     */
    private $crud;


    public function __construct()
    {
//        $ric = [];
//        if (false === ModuleInstallationRegister::isInstalled('Authenticate')) {
//            throw new \Exception("Authenticate module must be installed first");
//        }
//        $file = XConfig::get("Authenticate.pathUserStore");
//        $this->crud = CrudWithFile::create($file, $ric);
    }



    public function getRows()
    {

        $userStore = X::get(XConfig::get("Authenticate.serviceUserStore"));
        /**
         * @var $userStore UserStoreInterface
         */
        $users = $userStore->getUsers();

        return $this->toRows($users);
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    private function toRows(array $users)
    {
        foreach ($users as $id => $user) {
            $users[$id]['id'] = $id;
        }
        return array_values($users);
    }

}
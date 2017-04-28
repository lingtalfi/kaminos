<?php


use Core\Services\A;
use QuickPdo\QuickPdo;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";





A::quickPdoInit();
a(QuickPdo::fetchAll("select * from hali"));
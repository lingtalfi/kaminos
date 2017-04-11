

$f = '/myphp/kaminos/app/class-core/Services/X.php';
a(ClassCooker::create()->setFile($f)->getMethodsBoundaries());
a(ClassCooker::create()->setFile($f)->getMethodsBoundaries(['protected', 'static']));

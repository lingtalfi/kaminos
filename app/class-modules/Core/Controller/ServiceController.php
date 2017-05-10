<?php


namespace Controller\Core;


use Bat\UriTool;
use Core\Controller\ApplicationController;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Architecture\Response\Web\GscpResponse;
use Kamille\Architecture\Response\Web\HttpResponse;
use Kamille\Architecture\Response\Web\JsonResponse;
use Kamille\Ling\Z;
use Kamille\Services\XLog;

class ServiceController extends ApplicationController
{


    public function render()
    {
        try {

            $serviceId = Z::getUrlParam("serviceIdentifier", null, true);
            $servicesDir = ApplicationParameters::get('app_dir') . "/service";
            $serviceId = UriTool::noEscalating($serviceId);


            $p = explode('/', $serviceId, 3);
            if (3 === count($p)) {

                $___type___ = $p[0];
                if (in_array($___type___, [
                    'json',
                    'gscp',
                    'html',
                ])) {

                    $f = $servicesDir . "/$serviceId.php";
                    if (file_exists($f)) {

                        $type = 'error'; //
                        $out = null;
                        include $f;

                        switch ($___type___) {
                            case 'html':
                                return HttpResponse::create($out);
                                break;
                            case 'json':
                                return JsonResponse::create($out);
                                break;
                            case 'gscp':
                                return GscpResponse::make($out, $type);
                                break;
                            default:
                                break;
                        }


                    } else {
                        $this->error("File doesn't exist: $f");
                    }
                } else {
                    $this->error("Don't know how to handle this type: $___type___");
                }
            } else {
                $this->error("serviceId does not respect the scheme: type/Module/serviceName: $serviceId");
            }

        } catch (\Exception $e) {
            XLog::error("$e");
            $msg = $e->getMessage();
            return HttpResponse::create("An error occurred with message $msg, please check the logs for more details");
        }

    }


    private function error($msg)
    {
        throw new \Exception($msg);
    }

}
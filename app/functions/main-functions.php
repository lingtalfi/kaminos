<?php


//------------------------------------------------------------------------------/
// BONUS FUNCTIONS, SO HANDFUL... (a huge time saver in the end)
//------------------------------------------------------------------------------/
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Services\XLog;

if (!function_exists('a')) {
    function a()
    {
        foreach (func_get_args() as $arg) {
            ob_start();
            var_dump($arg);
            $output = ob_get_clean();
            if ('1' !== ini_get('xdebug.default_enable')) {
                $output = preg_replace("!\]\=\>\n(\s+)!m", "] => ", $output);
            }
            if ('cli' === PHP_SAPI) {
                echo $output;
            } else {
                echo '<pre>' . $output . '</pre>';
            }
        }
    }

    function az()
    {
        call_user_func_array('a', func_get_args());
        exit;
    }
}


//--------------------------------------------
// TRANSLATIONS - FEEL FREE TO OVERRIDE
/**
 * Below is the default kamille translation mechanism,
 * it's very simple, as you can see.
 */
//--------------------------------------------
function __($identifier, $context = 'default', array $tags = [])
{
    static $terms = [];

    // load definitions for the given context
    if (array_key_exists($context, $terms)) {
        $defs = $terms[$context];
    } else {
        $lang = ApplicationParameters::get("lang", "en");
        $defs = [];
        $file = __DIR__ . '/../lang/' . $lang . "/" . $context . '.trans.php';
        if (true === file_exists($file)) {
            require $file;
            $terms[$context] = $defs;
        } else {
            XLog::error("translation file not found: " . $file);
        }
    }


    // use the loaded definitions and check if there is a matching identifier
    if (array_key_exists($identifier, $defs)) {
        $value = $defs[$identifier];

    } else {
        $value = $identifier;
        XLog::error("dictionary term not found: " . $identifier);
    }
    if (count($tags) > 0) {
        $ks = array_map(function ($v) {
            return '{' . $v . '}';
        }, array_keys($tags));
        $vs = array_values($tags);
        $value = str_replace($ks, $vs, $value);
    }
    return $value;
}

function ___()
{
    return htmlspecialchars(call_user_func_array('__', func_get_args()));
}
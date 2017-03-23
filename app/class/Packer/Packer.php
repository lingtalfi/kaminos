<?php


namespace Packer;


use DirScanner\YorgDirScannerTool;

/**
 * Note: this is a simple naive packer,
 * which isn't very safe in that it doesn't deal with namespace tokens as a packer should.
 *
 * Instead, it uses regexes, and assumes that the files you want to pack have a namespace AT THE TOP of the file.
 * So, for instance if your code has some comments at the top of your file, and that comment contains the word
 * "namespace", then the code of THIS packer might have unexpected consequences.
 *
 * But usually, you don't have that kind of comment, do you?
 *
 *
 */
class Packer
{
    public static function create()
    {
        return new static();
    }


    /**
     * - rootDirectory: at its root, contains the planets/packages to pack.
     *
     *
     * @return string, the packed output
     */
    public function pack($rootDirectory)
    {
        $files = YorgDirScannerTool::getFilesWithExtension($rootDirectory, 'php', false, true, true);
        $classFiles = array_filter($files, function ($v) use ($rootDirectory) {
            $file = $rootDirectory . "/$v";
            $c = file_get_contents($file);
            $match = [];
            /**
             * Todo: check existence of namespace token instead
             */
            if (preg_match("!namespace!", $c, $match)) {
                return true;
            }
            return false;
        });


        $namespace2Files = [];
        foreach ($classFiles as $classFile) {
            $p = explode('/', $classFile);
            array_pop($p);
            $namespace = implode('\\', $p);
            $namespace2Files[$namespace][] = $rootDirectory . "/" . $classFile;
        }


        $s = "";
        foreach ($namespace2Files as $namespace => $files) {
            $s .= 'namespace ' . $namespace . ' {' . PHP_EOL;
            foreach ($files as $file) {
                $c = file_get_contents($file);
                $c = preg_replace('!namespace.*!', '', $c);
                $c = trim($c);
                if ('<?php' === substr($c, 0, 5)) {
                    $c = substr($c, 5);
                }
                if ('?>' === substr($c, -2)) {
                    $c = substr($c, 0, -2);
                }
                $s .= $c;
                $s .= PHP_EOL;
                $s .= PHP_EOL;
            }
            $s .= '}' . PHP_EOL;
            $s .= "// ------------------------------";
            $s .= PHP_EOL;
            $s .= PHP_EOL;
        }
        return $s;
    }
}
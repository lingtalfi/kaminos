<?php


namespace ClassCooker;


use ClassCooker\Exception\ClassCookerException;

class ClassCooker
{

    private $file;

    public static function create()
    {
        return new static();
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function removeMethod($methodName)
    {
    }

    public function addMethod()
    {
    }

    public function updateMethodContent()
    {
    }



    public function getMethods(array $signatureTags = [])
    {
        $ret = [];
        $preret = [];

        $captureFunctionNamePattern = '!function\s+([a-zA-Z0-9_]+)\s*\(.*\)!';

        $lines = $this->getLines();
        $lineNumber = 1;
        $endBrackets = [];
        $methods = [];

        // first capture all method signatures, and all possible end brackets
        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match($captureFunctionNamePattern, $line, $match)) {
                $func = $match[1];
                $methods[] = [$func, $line, $lineNumber];
            }
            if ('}' === $line) {
                $endBrackets[] = $lineNumber;
            }
            $lineNumber++;
        }
    }

    /**
     * This method will get the startLine and endLine number of every methods it finds.
     * However, in order for this method to work correctly, the class needs to be formatted in a certain way:
     *
     * - there must be only one class in the file
     * - the class ends with a proper } (end curly bracket) on its own line (possibly surrounded with whitespaces)
     * - the method signature is on its own line, and only one line (not split in multiple lines)
     * - a method ends with a proper } (end curly bracket) on its own line (possibly surrounded with whitespaces)
     *
     *
     * $signatureTags: array of desired tags, a tag can be one of the following:
     *                      - public
     *                      - protected
     *                      - private
     *                      - static
     *
     *
     *
     * @return array of method => [startLine, endLine]
     */
    public function getMethodsBoundaries(array $signatureTags = [])
    {
        $ret = [];
        $preret = [];

        $captureFunctionNamePattern = '!function\s+([a-zA-Z0-9_]+)\s*\(.*\)!';

        $lines = $this->getLines();
        $lineNumber = 1;
        $endBrackets = [];
        $methods = [];

        // first capture all method signatures, and all possible end brackets
        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match($captureFunctionNamePattern, $line, $match)) {
                $func = $match[1];
                $methods[] = [$func, $line, $lineNumber];
            }
            if ('}' === $line) {
                $endBrackets[] = $lineNumber;
            }
            $lineNumber++;
        }

        // now let's bind the end brackets back to the methods they belong to
        // the very last bracket must be the class' one, we don't need it
        array_pop($endBrackets);


        // then the last one in the current list must be the end line of the last method
        $nbMethods = count($methods);

        if (count($endBrackets) >= $nbMethods) {

            foreach ($methods as $k => $info) {
                $startLine = $info[2];
                $p = explode('function', $info[1], 2);
                $tags = explode(' ', $p[0]);
                $tags = array_filter(array_map(function ($v) {
                    $v = trim(strtolower($v));
                    return $v;
                }, $tags));
                if (array_key_exists($k + 1, $methods)) {
                    $nextInfo = $methods[$k + 1];
                    $nextStartLine = $nextInfo[2];
                    $lastEndLine = 0;
                    foreach ($endBrackets as $endLine) {
                        if ($endLine > $nextStartLine) {
                            $preret[$info[0]] = [$startLine, $lastEndLine, $tags];
                            break;
                        }
                        $lastEndLine = $endLine;
                    }
                } else {
                    $endLine = array_pop($endBrackets);
                    $preret[$info[0]] = [$startLine, $endLine, $tags];
                }
            }

            $n = count($signatureTags);
            foreach ($preret as $func => $v) {
                $tags = array_pop($v);
                if ($n > 0) {
                    foreach ($signatureTags as $tag) {
                        if (false === in_array($tag, $tags, true)) {
                            continue 2;
                        }
                    }
                }
                $ret[$func] = $v;
            }

            return $ret;
        } else {
            throw new ClassCookerException("Class not well formatted, please read the doc carefully");
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function getLines()
    {
        if (file_exists($this->file)) {
            return file($this->file);
        }
        throw new ClassCookerException("file not found: " . $this->file);
    }
}
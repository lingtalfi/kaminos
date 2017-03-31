<?php


namespace ApplicationItemManager\Repository;


class LingUniverseRepository extends AbstractRepository
{
    public function getName()
    {
        return 'ling';
    }

    //--------------------------------------------
    // OVERRIDE THOSE METHODS
    //--------------------------------------------
    protected function createItemList()
    {
        return [
            'AdminTable' => [
                'deps' => [
                    'ling.QuickPdo',
                ],
                'description' => 'An object to display administrable list of rows.',
            ],
            'ApplicationItemManager' => [
                'deps' => [
                    "ling.Bat",
                    "ling.Output",
                    "ling.Program",
                    "ling.CommandLineInput",
                ],
                'description' => "A planet to help creating certain types of module management console program",
            ],
            'ApplicationLog' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => "Lightweight object to quickly send a message to a log file.",
            ],
            'ArrayExport' => [
                'deps' => [
                    'ling.ArrayToString',
                ],
                'description' => 'This class can export a php array containing closures (aka anonymous functions).',
            ],
            'ArrayStore' => [
                'deps' => [
                    'ling.ArrayExport',
                    'ling.Bat',
                ],
                'description' => 'Store/retrieve an array to/from a file.',
            ],
            'ArrayToString' => [
                'deps' => [
                ],
                'description' => 'Utility to export a php array in various string formats.',
            ],
            'ArrayToTable' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Create an html table from a php array.',
            ],
            'AssetLoader' => [
                'deps' => [
                ],
                'description' => 'Load assets (js/css) in your html page.',
            ],
            'AssetsList' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A helper class to manage assets in your website.',
            ],
            'BabyDash' => [
                'deps' => [
                    'ling.IndentedLines',
                ],
                'description' => 'BabyDash is a notation to write an array in a language independent manner.',
            ],
            'BabyYaml' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'php implementation of a babyYaml reader.',
            ],
            'Bat' => [
                'deps' => [
                    'ling.CopyDir',
                    'ling.Tiphaine',
                ],
                'description' => 'Bat (Basic Tools) is an ensemble of basic tools that one can use to hopefully do a job faster (from the coding point of view, not performance).',
            ],
            'Bate' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Bate (Basic Tools Extension) is an extension pack for Bat.',
            ],
            'Beauty' => [
                'deps' => [
                    'ling.DirScanner',
                ],
                'description' => 'Beauty searches for your test pages and executes them.',
            ],
            'BullSheet' => [
                'deps' => [
                    'ling.Bat',
                    'ling.DirScanner',
                    'ling.QuickPdo',
                ],
                'description' => 'Generate fake data to populate your database.',
            ],
            'BumbleBee' => [
                'deps' => [
                ],
                'description' => 'Simple BSR-0 autoloader for a php project.',
            ],
            'Colis' => [
                'deps' => [
                    'ling.Bat',
                    'ling.YouTubeUtils',
                    'ling.Tim',
                    'ling.UploaderHandler',
                ],
                'description' => 'Colis is an input form control connected to a library of user items (videos, images, you decide...).',
            ],
            'CommandLineInput' => [
                'deps' => [
                    "ling.Output",
                ],
                'description' => 'Api to access command line options and parameters.',
            ],
            'CommandLineManiac' => [
                'deps' => [
                ],
                'description' => 'Tools for command line scripts written in php.',
            ],
            'ConventionGuy' => [
                'deps' => [
                ],
                'description' => 'Check out my conventions. Tools can use them as references.',
            ],
            'ConsoleTool' => [
                'deps' => [
                ],
                'description' => 'A tool to help creating console programs.',
            ],
            'CopyDir' => [
                'deps' => [
                ],
                'description' => 'Utility to copy a dir recursively.',
            ],
            'Csv' => [
                'deps' => [
                ],
                'description' => 'Csv utility tools.',
            ],
            'DirScanner' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Utility to scan a directory recursively and do something on every entry.',
            ],
            'DirectoryCleaner' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A tool to remove undesirable entries from a directory.',
            ],
            'DirTransformer' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'DirTransformer creates a modified copy of a given directory.',
            ],
            'Dreamer' => [
                'deps' => [
                ],
                'description' => 'This is a blog about my dreams.',
            ],
            'Escaper' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A tool helping with string escaping.',
            ],
            'Explorer' => [
                'deps' => [
                ],
                'description' => 'Tool for installing planets into your application.',
            ],
            'Ffmpeg' => [
                'deps' => [
                ],
                'description' => 'A ffmpeg wrapper for php.',
            ],
            'FileCleaner' => [
                'deps' => [
                ],
                'description' => 'A helper class to clean a directory based on conditions.',
            ],
            'FileCreator' => [
                'deps' => [
                ],
                'description' => 'Create a file, line by line, or block by block.',
            ],
            'GetFileSize' => [
                'deps' => [
                ],
                'description' => 'Php service to get the size of the file.',
            ],
            'Here' => [
                'deps' => [
                ],
                'description' => 'Helper to represent events on an horizontal timeline.',
            ],
            'HtmlTemplate' => [
                'deps' => [
                ],
                'description' => 'A simple template system to work with jquery.',
            ],
            'Icons' => [
                'deps' => [
                ],
                'description' => 'Add svg icons to your website.',
            ],
            'IndentedLines' => [
                'deps' => [
                    'ling.Bat',
                    'ling.Bate',
                    'ling.Quoter',
                ],
                'description' => 'Convert lists in indentedLines format to php arrays.',
            ],
            'Installer' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Generic installer for a cms/framework.',
            ],
            'InstantLog' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A quick log tool for your php apps.',
            ],
            'JAjaxLoader' => [
                'deps' => [
                ],
                'description' => 'A jquery plugin to start/stop an ajax loader.',
            ],
            'JChronometer' => [
                'deps' => [
                ],
                'description' => 'A javascript chronometer.',
            ],
            'JCookie' => [
                'deps' => [
                ],
                'description' => 'A javascript library to handle cookies.',
            ],
            'JDragSlider' => [
                'deps' => [
                ],
                'description' => 'A helper drag function for your sliders.',
            ],
            'JFullScreen' => [
                'deps' => [
                ],
                'description' => 'Helper code to fullscreen with javascript.',
            ],
            'JGoodies' => [
                'deps' => [
                ],
                'description' => 'Some functions that I found useful while playing with jQuery/javascript.',
            ],
            'JImageRotator' => [
                'deps' => [
                ],
                'description' => 'simple image rotator for jquery.',
            ],
            'JInfiniteSlider' => [
                'deps' => [
                ],
                'description' => 'Simple jquery infinite (circular) slider.',
            ],
            'JItemSlider' => [
                'deps' => [
                ],
                'description' => 'Simple responsive jquery infinite (circular) slider, based on items.',
            ],
            'JQuery' => [
                'deps' => [
                ],
                'description' => 'Some compressed Jquery libraries.',
            ],
            'JVideoPlayer' => [
                'deps' => [
                ],
                'description' => 'A javascript library to help building a video player.',
            ],
            'JqueryUrlWithDropZone' => [
                'deps' => [
                    'ling.Jquery',
                ],
                'description' => 'A jquery based snippet to create a form control consisting of an input text and a dropzone.',
            ],
            'Kamille' => [
                'deps' => [
                    'ling.Bat',
                    'ling.Output',
                    'ling.TokenFun',
                ],
                'description' => 'My first implementation of the kam framework.',
            ],
            'KamilleWidgets' => [
                'deps' => [
                    'ling.Kamille',
                ],
                'description' => 'Widgets for the kamille framework.',
            ],
            'KaminosUtils' => [
                'deps' => [
                    'ling.CopyDir',
                    'ling.Output',
                ],
                'description' => 'A planet to help implementing the kaminos admin system.',
            ],
            'Linker' => [
                'deps' => [
                ],
                'description' => 'Tool to help manage application symlinks.',
            ],
            'LogSlicer' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Paginate your log file for display.',
            ],
            'Lys' => [
                'deps' => [
                ],
                'description' => 'Another infinite scroll jquery plugin.',
            ],
            'Meredith' => [
                'deps' => [
                    'ling.Bat',
                    'ling.QuickPdo',
                    'ling.Tim',
                    'ling.StringFormatter',
                    'ling.SuspiciousException',
                ],
                'description' => 'Php plugin for implementing a crud strategy based on the jquery datatables plugin.',
            ],
            'MethodInjector' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A tool for injecting methods from a class to another.',
            ],
            'MikeMagicTools' => [
                'deps' => [
                ],
                'description' => 'This is a set of various tools.',
            ],
            'MySimpleXmlElement' => [
                'deps' => [
                ],
                'description' => 'Yet another implementation of php\'s SimpleXmlElement class.',
            ],
            'MysqlTabular' => [
                'deps' => [
                ],
                'description' => 'Generate a mysql table with the "console" format.',
            ],
            'NotationFan' => [
                'deps' => [
                ],
                'description' => 'Planet about user notation.',
            ],
            'Observer' => [
                'deps' => [
                ],
                'description' => 'I\'m an eye of the universe. I observe patterns emerging while the universe is being created.',
            ],
            'Ornella' => [
                'deps' => [
                ],
                'description' => 'Ornella is a notation for replacing {tags} with a customized value.',
            ],
            'Output' => [
                'deps' => [
                ],
                'description' => 'Object representing an output.',
            ],
            'Packer' => [
                'deps' => [
                    'ling.DirSscanner',
                    'ling.TokenFun',
                ],
                'description' => 'A tool to pack multiple files into one.',
            ],
            'Pea' => [
                'deps' => [
                ],
                'description' => 'Php like functions in js.',
            ],
            'PermsHiker' => [
                'deps' => [
                    'ling.Bat',
                    'ling.DirScanner',
                ],
                'description' => 'PermsHiker helps migrating permissions from a server to another.',
            ],
            'PhpBeast' => [
                'deps' => [
                    'ling.ArrayToTable',
                ],
                'description' => 'This is a php implementation of the Beast component of the Beauty n Beast pattern.',
            ],
            'PhpTemplate' => [
                'deps' => [
                ],
                'description' => 'Simple php template system.',
            ],
            'Privilege' => [
                'deps' => [
                ],
                'description' => 'Grant privileges to your users.',
            ],
            'Program' => [
                'deps' => [
                    "ling.CommandLineInput",
                    "ling.Output",
                ],
                'description' => 'A class to help creating console programs',
            ],
            'PublicException' => [
                'deps' => [
                ],
                'description' => 'An exception for the gui user.',
            ],
            'QuickForm' => [
                'deps' => [
                    'ling.Bat',
                    'ling.QuickPdo',
                ],
                'description' => 'Quick and dirty form helper class in php.',
            ],
            'QuickLog' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Lightweight object to quickly send a message to a log file.',
            ],
            'QuickPdo' => [
                'deps' => [
                ],
                'description' => 'It\'s a static class that contains basic methods to interact with a mysql database via pdo.',
            ],
            'Quoter' => [
                'deps' => [
                    'ling.Bat',
                    'ling.WrappedString',
                    'ling.Escaper',
                ],
                'description' => 'Utilities to manipulate quotes.',
            ],
            'ReflectionRepresentation' => [
                'deps' => [
                    'ling.VariableToString',
                ],
                'description' => 'Class to help with representation of \\Reflection elements.',
            ],
            'RssUtil' => [
                'deps' => [
                    'ling.MySimpleXmlElement',
                ],
                'description' => 'RssUtil contains utilities related to rss.',
            ],
            'ScreenDebug' => [
                'deps' => [
                ],
                'description' => 'javascript helper to debug data that change rapidly.',
            ],
            'SecureImageUploader' => [
                'deps' => [
                    'ling.Bat',
                    'ling.ThumbnailTools',
                ],
                'description' => 'A simple to use and secure uploader for images in php.',
            ],
            'SelectChain' => [
                'deps' => [
                    'ling.Tim',
                ],
                'description' => 'A simple javascript object to handle a select chain.',
            ],
            'SequenceMatcher' => [
                'deps' => [
                ],
                'description' => 'Find/replace a pattern in a sequence of things.',
            ],
            'SitemapBuilderBox' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Utilities to create basic sitemaps.',
            ],
            'SitemapSlicer' => [
                'deps' => [
                    'ling.Bat',
                    'ling.SitemapBuilderBox',
                ],
                'description' => 'Generate a sitemap index and its related sitemaps using data from your database.',
            ],
            'StringFormatter' => [
                'deps' => [
                    'ling.ArrayToString',
                    'ling.VariableToString',
                ],
                'description' => 'Tool to format string.',
            ],
            'SuspiciousException' => [
                'deps' => [
                ],
                'description' => 'This is an interface for the suspicious exception paradigm.',
            ],
            'SvgGridGenerator' => [
                'deps' => [
                ],
                'description' => 'Create css grid lines.',
            ],
            'TheAnarchist' => [
                'deps' => [
                ],
                'description' => 'Hi, I\'m a php developer; this is my blog.',
            ],
            'TheBar' => [
                'deps' => [
                ],
                'description' => 'Various discussions about the universe and everything.',
            ],
            'TheScientist' => [
                'deps' => [
                ],
                'description' => 'No description, website, or topics provided.',
            ],
            'ThumbnailTools' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Tool for manipulating thumbnails.',
            ],
            'Tim' => [
                'deps' => [
                    'ling.Jquery',
                ],
                'description' => 'Tim is a simple protocol to help with communication between a client and a server.',
            ],
            'TimeFileUtil' => [
                'deps' => [
                ],
                'description' => 'A helper class to get the start date and end date from a directory.',
            ],
            'Tiphaine' => [
                'deps' => [
                ],
                'description' => 'Tool for converting a string to a mixed value, using tiphaine notation.',
            ],
            'TokenFun' => [
                'deps' => [
                    'ling.Bat',
                    'ling.DirScanner',
                ],
                'description' => 'Tools for playing with php tokens.',
            ],
            'Tokens' => [
                'deps' => [
                ],
                'description' => 'Manipulate the tokens inside a file.',
            ],
            'TreeListHelper' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Creates an array representing a directory (tree view).',
            ],
            'Umail' => [
                'deps' => [
                    'ling.DirScanner',
                ],
                'description' => 'A helper class to send mails.',
            ],
            'UniqueNameGenerator' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Tool to generate unique names.',
            ],
            'Updf' => [
                'deps' => [
                ],
                'description' => 'A helper class to create pdf.',
            ],
            'Uploader' => [
                'deps' => [
                ],
                'description' => 'Helps implementing a server side service to handle file uploads.',
            ],
            'UploaderHandler' => [
                'deps' => [
                ],
                'description' => 'A tool to help implementing an upload server (with or without chunking).',
            ],
            'UrlFriendlyListHelper' => [
                'deps' => [
                    'ling.Bat',
                    'ling.Jquery',
                    'ling.QuickPdo',
                ],
                'description' => 'Utility to handle pagination, sort and search in your html lists.',
            ],
            'VSwitch' => [
                'deps' => [
                ],
                'description' => 'Simple helper to show/hide portions of your html page.',
            ],
            'VariableToString' => [
                'deps' => [
                    'ling.ArrayToString',
                    'ling.ReflectionRepresentation',
                ],
                'description' => 'Utility to write any php variable to a string representation.',
            ],
            'VideoSubtitles' => [
                'deps' => [
                ],
                'description' => 'Tools to work with subtitles.',
            ],
            'WrappedString' => [
                'deps' => [
                    'ling.Escaper',
                ],
                'description' => 'Low level utilities to work with wrapped strings.',
            ],
            'YouTubeUtils' => [
                'deps' => [
                ],
                'description' => 'Tools to manipulate Youtube Apis.',
            ],
            'Zoli' => [
                'deps' => [
                ],
                'description' => 'a modal dialog.',
            ],
        ];
    }
}
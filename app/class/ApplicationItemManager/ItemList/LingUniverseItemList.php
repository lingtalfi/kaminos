<?php


namespace ApplicationItemManager\ItemList;


class LingUniverseItemList extends AbstractItemList
{

    //--------------------------------------------
    // OVERRIDE THOSE METHODS
    //--------------------------------------------
    protected function createItemList()
    {
        return [
            'ling.AdminTable' => [
                'deps' => [
                    'ling.QuickPdo',
                ],
                'description' => 'An object to display administrable list of rows.',
            ],
            'ling.ApplicationLog' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Lightweight object to quickly send a message to a log file.',
            ],
            'ling.ArrayExport' => [
                'deps' => [
                    'ling.ArrayToString',
                ],
                'description' => 'This class can export a php array containing closures (aka anonymous functions).',
            ],
            'ling.ArrayStore' => [
                'deps' => [
                    'ling.ArrayExport',
                    'ling.Bat',
                ],
                'description' => 'Store/retrieve an array to/from a file.',
            ],
            'ling.ArrayToString' => [
                'deps' => [
                ],
                'description' => 'Utility to export a php array in various string formats.',
            ],
            'ling.ArrayToTable' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Create an html table from a php array.',
            ],
            'ling.AssetLoader' => [
                'deps' => [
                ],
                'description' => 'Load assets (js/css) in your html page.',
            ],
            'ling.AssetsList' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A helper class to manage assets in your website.',
            ],
            'ling.BabyDash' => [
                'deps' => [
                    'ling.IndentedLines',
                ],
                'description' => 'BabyDash is a notation to write an array in a language independent manner.',
            ],
            'ling.BabyYaml' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'php implementation of a babyYaml reader.',
            ],
            'ling.Bat' => [
                'deps' => [
                    'ling.CopyDir',
                    'ling.Tiphaine',
                ],
                'description' => 'Bat (Basic Tools) is an ensemble of basic tools that one can use to hopefully do a job faster (from the coding point of view, not performance).',
            ],
            'ling.Bate' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Bate (Basic Tools Extension) is an extension pack for Bat.',
            ],
            'ling.Beauty' => [
                'deps' => [
                    'ling.DirScanner',
                ],
                'description' => 'Beauty searches for your test pages and executes them.',
            ],
            'ling.BullSheet' => [
                'deps' => [
                    'ling.Bat',
                    'ling.DirScanner',
                    'ling.QuickPdo',
                ],
                'description' => 'Generate fake data to populate your database.',
            ],
            'ling.BumbleBee' => [
                'deps' => [
                ],
                'description' => 'Simple BSR-0 autoloader for a php project.',
            ],
            'ling.Colis' => [
                'deps' => [
                    'ling.Bat',
                    'ling.YouTubeUtils',
                    'ling.Tim',
                    'ling.UploaderHandler',
                ],
                'description' => 'Colis is an input form control connected to a library of user items (videos, images, you decide...).',
            ],
            'ling.CommandLineManiac' => [
                'deps' => [
                ],
                'description' => 'Tools for command line scripts written in php.',
            ],
            'ling.ConventionGuy' => [
                'deps' => [
                ],
                'description' => 'Check out my conventions. Tools can use them as references.',
            ],
            'ling.ConsoleTool' => [
                'deps' => [
                ],
                'description' => 'A tool to help creating console programs.',
            ],
            'ling.CopyDir' => [
                'deps' => [
                ],
                'description' => 'Utility to copy a dir recursively.',
            ],
            'ling.Csv' => [
                'deps' => [
                ],
                'description' => 'Csv utility tools.',
            ],
            'ling.DirScanner' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Utility to scan a directory recursively and do something on every entry.',
            ],
            'ling.DirTransformer' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'DirTransformer creates a modified copy of a given directory.',
            ],
            'ling.Dreamer' => [
                'deps' => [
                ],
                'description' => 'This is a blog about my dreams.',
            ],
            'ling.Escaper' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A tool helping with string escaping.',
            ],
            'ling.Explorer' => [
                'deps' => [
                ],
                'description' => 'Tool for installing planets into your application.',
            ],
            'ling.Ffmpeg' => [
                'deps' => [
                ],
                'description' => 'A ffmpeg wrapper for php.',
            ],
            'ling.FileCleaner' => [
                'deps' => [
                ],
                'description' => 'A helper class to clean a directory based on conditions.',
            ],
            'ling.FileCreator' => [
                'deps' => [
                ],
                'description' => 'Create a file, line by line, or block by block.',
            ],
            'ling.GetFileSize' => [
                'deps' => [
                ],
                'description' => 'Php service to get the size of the file.',
            ],
            'ling.Here' => [
                'deps' => [
                ],
                'description' => 'Helper to represent events on an horizontal timeline.',
            ],
            'ling.HtmlTemplate' => [
                'deps' => [
                ],
                'description' => 'A simple template system to work with jquery.',
            ],
            'ling.Icons' => [
                'deps' => [
                ],
                'description' => 'Add svg icons to your website.',
            ],
            'ling.IndentedLines' => [
                'deps' => [
                    'ling.Bat',
                    'ling.Bate',
                    'ling.Quoter',
                ],
                'description' => 'Convert lists in indentedLines format to php arrays.',
            ],
            'ling.Installer' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Generic installer for a cms/framework.',
            ],
            'ling.InstantLog' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A quick log tool for your php apps.',
            ],
            'ling.JAjaxLoader' => [
                'deps' => [
                ],
                'description' => 'A jquery plugin to start/stop an ajax loader.',
            ],
            'ling.JChronometer' => [
                'deps' => [
                ],
                'description' => 'A javascript chronometer.',
            ],
            'ling.JCookie' => [
                'deps' => [
                ],
                'description' => 'A javascript library to handle cookies.',
            ],
            'ling.JDragSlider' => [
                'deps' => [
                ],
                'description' => 'A helper drag function for your sliders.',
            ],
            'ling.JFullScreen' => [
                'deps' => [
                ],
                'description' => 'Helper code to fullscreen with javascript.',
            ],
            'ling.JGoodies' => [
                'deps' => [
                ],
                'description' => 'Some functions that I found useful while playing with jQuery/javascript.',
            ],
            'ling.JImageRotator' => [
                'deps' => [
                ],
                'description' => 'simple image rotator for jquery.',
            ],
            'ling.JInfiniteSlider' => [
                'deps' => [
                ],
                'description' => 'Simple jquery infinite (circular) slider.',
            ],
            'ling.JItemSlider' => [
                'deps' => [
                ],
                'description' => 'Simple responsive jquery infinite (circular) slider, based on items.',
            ],
            'ling.JQuery' => [
                'deps' => [
                ],
                'description' => 'Some compressed Jquery libraries.',
            ],
            'ling.JVideoPlayer' => [
                'deps' => [
                ],
                'description' => 'A javascript library to help building a video player.',
            ],
            'ling.JqueryUrlWithDropZone' => [
                'deps' => [
                    'ling.Jquery',
                ],
                'description' => 'A jquery based snippet to create a form control consisting of an input text and a dropzone.',
            ],
            'ling.Kamille' => [
                'deps' => [
                    'ling.Bat',
                    'ling.Output',
                    'ling.TokenFun',
                ],
                'description' => 'My first implementation of the kam framework.',
            ],
            'ling.KamilleWidgets' => [
                'deps' => [
                    'ling.Kamille',
                ],
                'description' => 'Widgets for the kamille framework.',
            ],
            'ling.KaminosUtils' => [
                'deps' => [
                    'ling.CopyDir',
                    'ling.Output',
                ],
                'description' => 'A planet to help implementing the kaminos admin system.',
            ],
            'ling.Linker' => [
                'deps' => [
                ],
                'description' => 'Tool to help manage application symlinks.',
            ],
            'ling.LogSlicer' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Paginate your log file for display.',
            ],
            'ling.Lys' => [
                'deps' => [
                ],
                'description' => 'Another infinite scroll jquery plugin.',
            ],
            'ling.Meredith' => [
                'deps' => [
                    'ling.Bat',
                    'ling.QuickPdo',
                    'ling.Tim',
                    'ling.StringFormatter',
                    'ling.SuspiciousException',
                ],
                'description' => 'Php plugin for implementing a crud strategy based on the jquery datatables plugin.',
            ],
            'ling.MethodInjector' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'A tool for injecting methods from a class to another.',
            ],
            'ling.MikeMagicTools' => [
                'deps' => [
                ],
                'description' => 'This is a set of various tools.',
            ],
            'ling.MySimpleXmlElement' => [
                'deps' => [
                ],
                'description' => 'Yet another implementation of php\'s SimpleXmlElement class.',
            ],
            'ling.MysqlTabular' => [
                'deps' => [
                ],
                'description' => 'Generate a mysql table with the "console" format.',
            ],
            'ling.NotationFan' => [
                'deps' => [
                ],
                'description' => 'Planet about user notation.',
            ],
            'ling.Observer' => [
                'deps' => [
                ],
                'description' => 'I\'m an eye of the universe. I observe patterns emerging while the universe is being created.',
            ],
            'ling.Ornella' => [
                'deps' => [
                ],
                'description' => 'Ornella is a notation for replacing {tags} with a customized value.',
            ],
            'ling.Output' => [
                'deps' => [
                ],
                'description' => 'Object representing an output.',
            ],
            'ling.Packer' => [
                'deps' => [
                    'ling.DirSscanner',
                    'ling.TokenFun',
                ],
                'description' => 'A tool to pack multiple files into one.',
            ],
            'ling.Pea' => [
                'deps' => [
                ],
                'description' => 'Php like functions in js.',
            ],
            'ling.PermsHiker' => [
                'deps' => [
                    'ling.Bat',
                    'ling.DirScanner',
                ],
                'description' => 'PermsHiker helps migrating permissions from a server to another.',
            ],
            'ling.PhpBeast' => [
                'deps' => [
                    'ling.ArrayToTable',
                ],
                'description' => 'This is a php implementation of the Beast component of the Beauty n Beast pattern.',
            ],
            'ling.PhpTemplate' => [
                'deps' => [
                ],
                'description' => 'Simple php template system.',
            ],
            'ling.Privilege' => [
                'deps' => [
                ],
                'description' => 'Grant privileges to your users.',
            ],
            'ling.PublicException' => [
                'deps' => [
                ],
                'description' => 'An exception for the gui user.',
            ],
            'ling.QuickForm' => [
                'deps' => [
                    'ling.Bat',
                    'ling.QuickPdo',
                ],
                'description' => 'Quick and dirty form helper class in php.',
            ],
            'ling.QuickLog' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Lightweight object to quickly send a message to a log file.',
            ],
            'ling.QuickPdo' => [
                'deps' => [
                ],
                'description' => 'It\'s a static class that contains basic methods to interact with a mysql database via pdo.',
            ],
            'ling.Quoter' => [
                'deps' => [
                    'ling.Bat',
                    'ling.WrappedString',
                    'ling.Escaper',
                ],
                'description' => 'Utilities to manipulate quotes.',
            ],
            'ling.ReflectionRepresentation' => [
                'deps' => [
                    'ling.VariableToString',
                ],
                'description' => 'Class to help with representation of \\Reflection elements.',
            ],
            'ling.RssUtil' => [
                'deps' => [
                    'ling.MySimpleXmlElement',
                ],
                'description' => 'RssUtil contains utilities related to rss.',
            ],
            'ling.ScreenDebug' => [
                'deps' => [
                ],
                'description' => 'javascript helper to debug data that change rapidly.',
            ],
            'ling.SecureImageUploader' => [
                'deps' => [
                    'ling.Bat',
                    'ling.ThumbnailTools',
                ],
                'description' => 'A simple to use and secure uploader for images in php.',
            ],
            'ling.SelectChain' => [
                'deps' => [
                    'ling.Tim',
                ],
                'description' => 'A simple javascript object to handle a select chain.',
            ],
            'ling.SequenceMatcher' => [
                'deps' => [
                ],
                'description' => 'Find/replace a pattern in a sequence of things.',
            ],
            'ling.SitemapBuilderBox' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Utilities to create basic sitemaps.',
            ],
            'ling.SitemapSlicer' => [
                'deps' => [
                    'ling.Bat',
                    'ling.SitemapBuilderBox',
                ],
                'description' => 'Generate a sitemap index and its related sitemaps using data from your database.',
            ],
            'ling.StringFormatter' => [
                'deps' => [
                    'ling.ArrayToString',
                    'ling.VariableToString',
                ],
                'description' => 'Tool to format string.',
            ],
            'ling.SuspiciousException' => [
                'deps' => [
                ],
                'description' => 'This is an interface for the suspicious exception paradigm.',
            ],
            'ling.SvgGridGenerator' => [
                'deps' => [
                ],
                'description' => 'Create css grid lines.',
            ],
            'ling.TheAnarchist' => [
                'deps' => [
                ],
                'description' => 'Hi, I\'m a php developer; this is my blog.',
            ],
            'ling.TheBar' => [
                'deps' => [
                ],
                'description' => 'Various discussions about the universe and everything.',
            ],
            'ling.TheScientist' => [
                'deps' => [
                ],
                'description' => 'No description, website, or topics provided.',
            ],
            'ling.ThumbnailTools' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Tool for manipulating thumbnails.',
            ],
            'ling.Tim' => [
                'deps' => [
                    'ling.Jquery',
                ],
                'description' => 'Tim is a simple protocol to help with communication between a client and a server.',
            ],
            'ling.TimeFileUtil' => [
                'deps' => [
                ],
                'description' => 'A helper class to get the start date and end date from a directory.',
            ],
            'ling.Tiphaine' => [
                'deps' => [
                ],
                'description' => 'Tool for converting a string to a mixed value, using tiphaine notation.',
            ],
            'ling.TokenFun' => [
                'deps' => [
                    'ling.Bat',
                    'ling.DirScanner',
                ],
                'description' => 'Tools for playing with php tokens.',
            ],
            'ling.Tokens' => [
                'deps' => [
                ],
                'description' => 'Manipulate the tokens inside a file.',
            ],
            'ling.TreeListHelper' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Creates an array representing a directory (tree view).',
            ],
            'ling.Umail' => [
                'deps' => [
                    'ling.DirScanner',
                ],
                'description' => 'A helper class to send mails.',
            ],
            'ling.UniqueNameGenerator' => [
                'deps' => [
                    'ling.Bat',
                ],
                'description' => 'Tool to generate unique names.',
            ],
            'ling.Updf' => [
                'deps' => [
                ],
                'description' => 'A helper class to create pdf.',
            ],
            'ling.Uploader' => [
                'deps' => [
                ],
                'description' => 'Helps implementing a server side service to handle file uploads.',
            ],
            'ling.UploaderHandler' => [
                'deps' => [
                ],
                'description' => 'A tool to help implementing an upload server (with or without chunking).',
            ],
            'ling.UrlFriendlyListHelper' => [
                'deps' => [
                    'ling.Bat',
                    'ling.Jquery',
                    'ling.QuickPdo',
                ],
                'description' => 'Utility to handle pagination, sort and search in your html lists.',
            ],
            'ling.VSwitch' => [
                'deps' => [
                ],
                'description' => 'Simple helper to show/hide portions of your html page.',
            ],
            'ling.VariableToString' => [
                'deps' => [
                    'ling.ArrayToString',
                    'ling.ReflectionRepresentation',
                ],
                'description' => 'Utility to write any php variable to a string representation.',
            ],
            'ling.VideoSubtitles' => [
                'deps' => [
                ],
                'description' => 'Tools to work with subtitles.',
            ],
            'ling.WrappedString' => [
                'deps' => [
                    'ling.Escaper',
                ],
                'description' => 'Low level utilities to work with wrapped strings.',
            ],
            'ling.YouTubeUtils' => [
                'deps' => [
                ],
                'description' => 'Tools to manipulate Youtube Apis.',
            ],
            'ling.Zoli' => [
                'deps' => [
                ],
                'description' => 'a modal dialog.',
            ],
        ];
    }
}
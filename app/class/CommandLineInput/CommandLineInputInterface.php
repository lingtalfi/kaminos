<?php


namespace CommandLineInput;

/**
 * This object is an api to access command line options and parameters.
 * What's an option and what's a parameter might be redefined on a per concrete class basis.
 *
 * But if otherwise not specified, here is the conception that should prevail.
 *
 *
 *
 * Options
 * =============
 * An option is one of two types:
 *
 * - short option
 * - long option
 *
 * A short option starts with a dash, and is followed by one letter (for instance -v).
 * It's possible to have multiple short options combined in one, the notation being one dash followed
 * by all the short options letters, for instance: -vp (equivalent to -v -p).
 *
 * By default, the value of a short option is a boolean: either it's set or not set (and the value is then true or
 * false respectively).
 *
 * But you can also bind a value to a short option, like the mysql password of the mysql command:
 *
 *      mysql -proot
 *
 * In this case, the value of the p short option would be the string "root",
 * or false if not set.
 *
 * You cannot combine short options that accept values together, because that would be a mess to handle
 * (imagine handling this -piejgroot, what are the short options and what are the values?).
 * So, you can only combine short options that don't accept value (aka flags).
 *
 * And if your short option accepts a value, it has to be written alone.
 *
 *
 *
 *
 * A long option starts with two dashes, and is followed by a word, for instance: --marshmallow
 * A value can be associated with a long option, by adding an equal symbol next to the option word, and then the value.
 * No space should be found around the equal symbol. For instance: --email=myemail@gmail.com.
 *
 * If your value contains space, you can protect it with single or double quotes.
 *
 *
 * Parameters
 * =============
 * A parameter is any string in the command line that doesn't start with a dash.
 *
 * So for instance, given the following command line:
 *
 *      php -f myprogram.php makecoffee -v --sugars=2 viennois
 *
 * The parameters are: makecoffee and viennois.
 * They should be accessible by their number, starting with 1 (not 0).
 * So parameter 1 would be makecoffee, and viennois would be parameter 2.
 *
 * Note that a parameter can be a command name (like makecoffee in this case),
 * but that's your responsibility to decide what's a command and what's a parameter for this command.
 *
 *
 *
 */
interface CommandLineInputInterface
{
    public function getOptionValue($optionName, $default = null);

    public function getParameter($index, $default = null);
}
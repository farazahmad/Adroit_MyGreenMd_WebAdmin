<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * InitialDesign class
 */
class Id
{
    
    function Id()
    {
        
    }

    function tinymce($elements) {
		return 'tinyMCE_GZ.init({themes : "simple,advanced",languages : "en",disk_cache : false,debug : false});
		tinyMCE.init({mode : "exact",theme : "advanced",plugins:"ibrowser",theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,separator,ibrowser,code",theme_advanced_buttons3 : "",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,theme_advanced_resize_horizontal : true,elements : "'.$elements.'",onchange_callback: function(editor) {tinyMCE.triggerSave();$("#" + editor.id).valid();}});
		';
	}



    function sql_date($date)
    {
        $d = explode('/', $date);
        if(count($d)==3)
        {
            $d[0] = $d[0]-0;
            $d[1] = $d[1]-0;
            $d[2] = $d[2]-0;

            if(!$d[0] or !$d[1] or !$d[2])return '';
            //m-d-y
            else return @date("Y-m-d", mktime(0, 0, 0, $d[0], $d[1], $d[2]));
        }
    }

    function from_sql_date($date)
    {
        $d = explode('-', $date);
        if(count($d)==3)
        {
            $d[0] = $d[0]-0;
            $d[1] = $d[1]-0;
            $d[2] = $d[2]-0;

            if(!$d[0] or !$d[1] or !$d[2])return '';
            else return @date("m/d/Y", mktime(0, 0, 0, $d[1], $d[2], $d[0]));
        }
    }

}

?>

<?php
/**
 * Description of Mstatic
 *
 * @author wiz
 */
class All_js extends Id {

    function All_js()
    {
        parent::Id ();
		$this->CI =& get_instance();
    }

    function addJS($val,$val2=""){
		$BASE_JS_PATH=JS_PATH;
		$BASE_URL = BASE_URL;
		if($val=="jquery_126"){
			$datajs= "<script type=\"text/javascript\" src=\"{$BASE_JS_PATH}jquery/jquery.1.2.6.js\"></script> \n";	
		}
                if($val=="jquery_161"){
			$datajs= "<script type=\"text/javascript\" src=\"{$BASE_JS_PATH}jquery/jquery1.6.1.js\"></script> \n";	
		}
		if($val=="jquery"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/jquery-1.8.1.min.js"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/jquery-ui-1.8.23.custom.min.js"></script> \n
END;
		}		
                if($val=="jqueryui"){
		$datajs= <<<END
		<link type="text/css" href="{$BASE_JS_PATH}jquery/css/jquery-ui.css" rel="stylesheet" />\n
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/jquery-ui-1.9.1.js"></script> \n
END;
		}
		if($val == 'effect_transfer')
		{
		$datajs= "
							<script type=\"text/javascript\" src=\"{$BASE_JS_PATH}jquery/effects.core.js\"></script>
							<script type=\"text/javascript\" src=\"{$BASE_JS_PATH}jquery/effects.transfer.js\"></script>";
		}
		if($val=="id_tinymce"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}tiny_mce/tiny_mce_gzip.js"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}tiny_mce/tiny_mce.js"></script> \n
END;
		}
		if($val=="uicalendar"){
		$datajs= <<<END
		<link type="text/css" href="{$BASE_JS_PATH}jquery/css/ui-darkness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />\n
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/ui.core.js"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/ui.datepicker.js"></script> \n	
END;
		}
		if($val=="rating"){
		$datajs= <<<END
		<link type="text/css" href="{$BASE_JS_PATH}jquery/rating/jquery.rating.css" rel="stylesheet" />\n
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/rating/jquery.rating.js"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/rating/jquery.rating.pack.js"></script> \n	
END;
		}
		if($val=="editor"){
		$datajs= <<<END
		<link type="text/css" href="{$BASE_JS_PATH}jquery/css/ui-darkness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />\n
		<script type="text/javascript" src="{$BASE_JS_PATH}editor/jquery-ui-1.7.2.custom.min.js"></script>	
		<script type="text/javascript" src="{$BASE_JS_PATH}editor/editor.js"></script>
		<link type="text/css" href="{$BASE_JS_PATH}editor/editor.css" rel="stylesheet" />
END;
		}
		if($val=="jcarousel"){
		$datajs=<<<END
		<link rel="stylesheet" type="text/css" href="{$BASE_JS_PATH}jquery/jcarousel/css/slider4espresso.css" media="screen" />
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/jcarousel/jquery.jcarousel.pack.js"></script> \n
		<link rel="stylesheet" type="text/css" href="{$BASE_JS_PATH}jquery/jcarousel/css/jcarousel/jquery.jcarousel.css" /> \n
		<link rel="stylesheet" type="text/css" href="{$BASE_JS_PATH}jquery/jcarousel/css/jcarousel/tango/skin.css" /> \n
END;
		}			
		if($val=="pngFix"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/pngFix.js"></script> \n
END;
		}
		if($val=="jmenu"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/jmenu/jmenu.js"></script> \n
		<link rel="stylesheet" href="{$BASE_JS_PATH}jquery/jmenu/jmenu.css" type="text/css" />	\n
END;
		}
		if($val=="jmenu_admin"){
		$datajs=<<<END
	<script type="text/javascript" src="{$BASE_JS_PATH}jquery/jmenu/jmenu.js"></script> \n
		<link rel="stylesheet" href="{$BASE_JS_PATH}jquery/jmenu/jmenu_admin.css" type="text/css" />	\n	
END;
		}
	   if($val=="date_picker"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/date_picker/ui.datepicker.packed.js"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/date_picker/ui.datepicker-id.js"></script> \n
		<link rel="stylesheet" href="{$BASE_JS_PATH}jquery/date_picker/ui.datepicker.css" type="text/css" />	\n	
END;
		}		
		if($val=="jlightbox"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/jlightbox/js/jquery.lightbox-0.5.pack.js"></script>\n	
		<link rel="stylesheet" type="text/css" href="{$BASE_JS_PATH}jquery/jlightbox/css/jquery.lightbox-0.5.css" media="screen" />\n	
END;
		}
		if($val=="siFr"){
		$datajs= <<<END
		<link rel="stylesheet" href="{$BASE_JS_PATH}sifr/sIFR-screen.css" type="text/css" media="screen">\n	
		<link rel="stylesheet" href="{$BASE_JS_PATH}sifr/sIFR-print.css" type="text/css" media="print">\n	
		<script type="text/javascript" src="{$BASE_JS_PATH}sifr/sifr.js"></script>\n
END;
		}
		
		if($val=="lazyload"){
		$datajs= <<<END
		<script src="{$BASE_JS_PATH}jquery/lazyload/jquery.lazyload.pack.js" type="text/javascript"></script>\n	
END;
		}		
		if($val=="boxy"){
		$datajs=<<<END
		<script type='text/javascript' src='{$BASE_JS_PATH}jquery/boxy/jquery.boxy.js'></script>
		<link rel="stylesheet" href="{$BASE_JS_PATH}jquery/boxy/boxy.css" type="text/css" />		
END;
		}
		if($val=="jfromvalidator"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/formvalidator/form.js"></script> \n		
		<link rel="stylesheet" href="{$BASE_JS_PATH}jquery/formvalidator/form.css" type="text/css" /> \n
END;
		}
		if($val=="lavalamp"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/lavalamp/jquery.lavalamp.min.js"></script>\n
		<link rel="stylesheet" href="{$BASE_JS_PATH}jquery/lavalamp/lavalamp_test.css" type="text/css" media="screen">\n
END;
		}
		if($val=="jeasing"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/easing/jquery.easing.min.js"></script>\n
END;
		}
		if($val=="filestyle"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/filestyle/jquery.filestyle.mini.js"></script>\n
END;
		}
		if($val=="tinymce"){
		$datajs= <<<END
		<script language="JavaScript" type="text/javascript" src="{$BASE_JS_PATH}tinymce/tiny_mce.js"></script> \n		
END;
		}
			
		if($val=="jw_flv"){
		$datajs= <<<END
		<script language="JavaScript" type="text/javascript" src="{$BASE_JS_PATH}flvplayer/swfobject.js"></script> \n		
END;
		}
		
		if($val=="php_js"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}php.js"></script>\n
END;
		}
		if($val=="swfuploader"){
		$datajs=<<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}swfuploader/vendor/swfupload/swfupload.js"></script>
		<script type="text/javascript" src="{$BASE_JS_PATH}swfuploader/src/jquery.swfupload.js"></script>
END;
		}
		if($val=="screenBox"){
		$datajs=<<<END
				<link rel="stylesheet" href="{$BASE_URL}templates/default/admin/css/base/ui.all.css" type="text/css" />	\n
				<script type="text/javascript" src="{$BASE_JS_PATH}jquery/ui.core.js"></script>
				<script type="text/javascript" src="{$BASE_JS_PATH}jquery/ui.draggable.js"></script>
				<script type="text/javascript" src="{$BASE_JS_PATH}jquery/ui.resizable.js"></script>
				<script type="text/javascript" src="{$BASE_JS_PATH}jquery/ui.dialog.js"></script>
				<script type="text/javascript" src="{$BASE_JS_PATH}jquery/bgiframe/jquery.bgiframe.js"></script>
END;
		}
		
		if($val=="uploader"){
		$datajs=<<<END
		<link href="{$BASE_JS_PATH}uploader/uploadify.css?1.0.0'?>" rel="stylesheet" type="text/css" /> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}uploader/jquery/jquery-ui.js"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}uploader/jquery/idesign.js?1.1.0"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}uploader/jquery/default.js?1.0.0"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}uploader/jquery/jquery.uploadify.js"></script> \n
		<script type="text/javascript" src="{$BASE_JS_PATH}uploader/upload.js"></script> \n
END;
		}
		
		if($val=="facebook"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}facebook/facebox.js"></script> \n
		<link rel="stylesheet" href="{$BASE_JS_PATH}facebook/facebox.css" type="text/css" />	\n	
END;
		}
                
                if($val=="timepicker"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}jquery/timepicker/jquery.timepicker.js"></script> \n
		<link rel="stylesheet" href="{$BASE_JS_PATH}jquery/timepicker/jquery.timepicker.css" type="text/css" />	\n	
END;
		}
                
		if($val=="highcharts"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}highcharts/highcharts.js"></script> \n
END;
		}
		
                if($val=="colorbox"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}colorbox/jquery.colorbox.js"></script> \n
		<link rel="stylesheet" href="{$BASE_JS_PATH}colorbox/colorbox.css" type="text/css" />	\n	
END;
		}                
                
		if($val=="fullcalendar"){
		$datajs= <<<END
		<script type="text/javascript" src="{$BASE_JS_PATH}fullcalendar/fullcalendar.min.js"></script> \n
		<link  href="{$BASE_JS_PATH}fullcalendar/cupertino/theme.css" rel="stylesheet" type="text/css" >\n
                <link  href="{$BASE_JS_PATH}fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" >\n
                <link  href="{$BASE_JS_PATH}fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" >\n
END;
		}
		return $datajs;
	}
	
	function tinymce($elements, $mode = 'exact'){
		$this->CI->smarty->append("add_JS",$this->CI->all_js->addJS("id_tinymce"));
		$addinlineJS='tinyMCE.init({themes : "simple,advanced",languages : "en",disk_cache : false,debug : false});
												tinyMCE.init({
												file_browser_callback : "tinyBrowser",
												mode : "'.$mode.'",
												theme : "advanced",
												theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
												theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,code",theme_advanced_buttons3 : "",
												theme_advanced_toolbar_location : "top",
												theme_advanced_toolbar_align : "left",
												theme_advanced_statusbar_location : "bottom",
												theme_advanced_resizing : true,
												theme_advanced_resize_horizontal : true,
												';
		if($elements != '')
		{
			$addinlineJS .= ' elements : "'.$elements.'",';
		}
		$addinlineJS .= '	onchange_callback: function(editor) {tinyMCE.triggerSave();/*$("#" + editor.id).valid();*/}});';
												
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	
	function formvalidator($page_url,$form_id="form",$save_id="save",$ajax="false",$validCheck="false"){
		$this->CI->smarty->append("add_JS",$this->CI->all_js->addJS("php_js"));
		$this->CI->smarty->append("add_JS",$this->CI->all_js->addJS("jfromvalidator"));
		$addinlineJS=<<<END
		$(document).ready(function(){
			$("#{$form_id}").FormValidate({
					phpFile:"{$page_url}",
					ajax: {$ajax},
					validCheck: {$validCheck}
			});
			$("#{$save_id}").click(function(){
				$('#{$form_id}').submit();
			});			
		 });
END;
        $this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	
	function useJlightbox($elements=".lightbox"){
		$this->CI->smarty->append("add_JS",$this->CI->all_js->addJS("jlightbox"));
		$JS_PATH=JS_PATH;
		$addinlineJS=<<<END
		$(document).ready(function(){
			$("$elements").lightBox({
				imageLoading: "{$JS_PATH}jquery/jlightbox/images/lightbox-btn-loading.gif",
				imageBtnClose: "{$JS_PATH}jquery/jlightbox/images/lightbox-btn-close.gif",
				imageBtnPrev: "{$JS_PATH}jquery/jlightbox/images/lightbox-btn-prev.gif",
				imageBtnNext: "{$JS_PATH}jquery/jlightbox/images/lightbox-btn-next.gif",
				imageBlank: "{$JS_PATH}jquery/jlightbox/images/lightbox-blank.gif",
				txtImage: "foto",
				txtOf: "tot"
			});	
		 });
END;
        $this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	function icoAccordMenu($selector = 'icon_menu'){
		$BASE_URL = BASE_URL;
		$addinlineJS=<<<END
		$(document).ready(function(){
			$("$selector").bind("click",function(){
				var parent = $(this).attr("id");
				if($(this).attr("src") == "{$BASE_URL}static/js/jquery/jmenu/images/arrow-down.png")
				{
					$(this).attr("src","{$BASE_URL}static/js/jquery/jmenu/images/arrow-right.png");
					hide_submenus(parent);					
				}else{
					$(this).attr("src","{$BASE_URL}static/js/jquery/jmenu/images/arrow-down.png");
					$(this).parents("table#table_content").find("tr.id_parent_"+parent).show();
				}
			});
			
			function hide_submenus(parent)
			{
				var n_id_menu = $("table#table_content").find("tr.id_parent_"+parent);
				n_id_menu = n_id_menu.length;
				
				for(i = 0; i < n_id_menu; i++)
				{
					var id_menu = $("table#table_content").find("tr.id_parent_"+parent).eq(i).find("img.icon_menu").attr("id");
					if(id_menu == "undefined")
					{
					}else{
						/*hide_submenus(id_menu);*/
						$("table#table_content").find("tr.id_parent_"+parent).find("img#"+id_menu).attr("src","{$BASE_URL}static/js/jquery/jmenu/images/arrow-right.png");
						$("table#table_content").find("tr.id_parent_"+parent).hide();
					}
				}
			}
		 });
END;
        $this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	
	function screenBox($selector = 'a.show_page')
	{
		$BASE_URL = BASE_URL;
		$JS_PATH=JS_PATH;
		$this->CI->smarty->append("add_JS",$this->CI->all_js->addJS("screenBox"));
		$addinlineJS=<<<END
		$(document).ready(function(){
			$("$selector").bind("click",function(){
				tinyMCE.execCommand("mceAddControl",false,"page_description"); 
				tinyMCE.execCommand("mceRemoveControl",false,"page_description"); 
				var add_url = $(this).attr("alt");
				$("div#box_screen").show();
				$("div#box_screen").css({background:"#cccccc", opacity:"1.9"});
				$("div#container_page_form").css({background:"#ffffff",
																					width:"800px", 
																					height: "auto",
																					margin: "20px auto auto auto"
																					});
				var id_menu = $(this).attr("id");																	
				var menu_url = $(this).attr("alt");													
				$.ajax({
									type: "POST",
									url : "../services/viewcontent",
									data : "&id_menu="+id_menu+"&menu_url="+menu_url,
									success : function(msg){
												var data_page = msg.split("{||}");
												$("input#id_page").val(data_page[0]);
												$("input#web_title").val(data_page[6]);
												$("input#page_title").val(data_page[1]);
												$("input#page_url").val(data_page[2]);
												var page_desc1 = data_page[5];
												var page_desc = unreplace(page_desc1);
												$("textarea#page_description").val(page_desc);
												$("textarea#meta_keywords").val(data_page[3]);
												$("textarea#meta_description").val(data_page[4]);
												//$("#template_pace").html(data_page[7]);
												$("input#hide_template_val").val(data_page[7]);
												$("img.layout_template").removeClass("tmpt_selected");
												$("img.layout_template[alt='"+data_page[7]+"']").addClass("tmpt_selected");
												tinyMCE.execCommand("mceAddControl",false,"page_description"); 
									}
							});
			});
			$("a#close_box_screen").bind("click",function(){
				$("div#box_screen").animate({opacity:"0"},1000, callback);
			});
			$("input#save").bind("click",function(){
				savecontent();
			});
			function replaceChars(entry) {
				out = "&"; // replace this
				add = "{:and:}"; // with this
				temp = "" + entry; // temporary holder

				while (temp.indexOf(out)>-1) {
					pos= temp.indexOf(out);
					temp = "" + (temp.substring(0, pos) + add + 
					temp.substring((pos + out.length), temp.length));
				}
				return temp;
			}
			function unreplace(entry) {
				out = "{:and:}"; // replace this
				add = "&"; // with this
				temp = "" + entry; // temporary holder

				while (temp.indexOf(out)>-1) {
					pos= temp.indexOf(out);
					temp = "" + (temp.substring(0, pos) + add + 
					temp.substring((pos + out.length), temp.length));
				}
				return temp;
			}
			function savecontent()
			{
				tinyMCE.execCommand('mceFocus',false,'page_description'); 
				$("textarea#page_description").focus();
				var id_page = $("input#id_page").val();
				var web_title = $("input#web_title").val();
				var page_title = $("input#page_title").val();
				var page_url = $("input#page_url").val();
				var page_content1 = $("textarea#page_description").val();
				var page_content = replaceChars(page_content1);
				var meta_keywords = $("textarea#meta_keywords").val();
				var meta_description = $("textarea#meta_description").val();
				//var template = $("input#template").val();
				var template = $("input#hide_template_val").val();
					$.ajax({
										type: "POST",
										url : "../services/savecontent",
										data : "&web_title="+web_title+"&page_title="+page_title+"&page_url="+page_url+"&meta_keywords="+meta_keywords+"&meta_description="+meta_description+"&template="+template+"&page_content="+page_content+"&id_page="+id_page,
										success : function(msg){
											$("div#box_screen").animate({opacity:"0"},1000, callback);
											tinyMCE.execCommand("mceRemoveControl",false,"page_description"); 
										}
								});
			}
			function callback(){
				$("div#box_screen").hide();
			}
		 });
END;
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	
	function dialog($selector = 'a.show_page', $target = '#dialog', $height = '550', $width = '600')
	{
		$BASE_URL = BASE_URL;
		$JS_PATH=JS_PATH;
		$addinlineJS=<<<END
		$(document).ready(function() {
				
				$("{$target}").dialog({
					bgiframe: true,
					autoOpen: false,
					resizable: true,
					height:{$height},
					width:{$width},
					modal: true,
					overlay: {
						backgroundColor: '#000',
						opacity: 0.5
					},
					buttons: {
						Cancel: function() {
							$(this).dialog('close');
						}
					}
				});
				
				$("{$selector}").click(function() {
					$("{$target}").dialog('open');
				});
			});
END;
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	
	function overValueOption($selection1 = '"#toright"', $selection2 = '"#toleft"', $target1 = '"#target1"', $target2 = '"#target2"')
	{
		$BASE_URL = BASE_URL;
		$JS_PATH=JS_PATH;
		$addinlineJS=<<<END
		$(document).ready(function() {
				$('{$selection1}').bind("click",function() {
					return !$('{$target2} option:selected').remove().appendTo('{$target1}');
				});
				
				$('{$selection2}').bind("click",function() {
					return !$('{$target1} option:selected').remove().appendTo('{$target2}');
				});
		});
END;
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	
	function ajaxPost($selector = "input.saveajax", $url = "../services", $data = '', $success = "alert(msg);", $event = "click")
	{
		$BASE_URL = BASE_URL;
		$JS_PATH=JS_PATH;
		$addinlineJS=<<<END
		$(document).ready(function() {
				$('{$selector}').bind("{$event}",function() {
							$.ajax({
										type: "POST",
										url : "{$url}",
										data : {$data},
										success : function(msg){
											{$success}
										}
								});
				});
		});
END;
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}

	
	function uploader($events_id, $session){
		$this->CI->smarty->append("add_JS",$this->CI->all_js->addJS("uploader"));
		$JS_PATH=JS_PATH;
		$BASE_URL = BASE_URL;
		$IMG_PATH = IMG_PATH;
		$addinlineJS=<<<END
			var BASE_PATH = "{$BASE_URL}";
			var IMG_PATH = "{$IMG_PATH}";
			var JS_PATH = "{$JS_PATH}";
			var SESSION = "{$session}";
			var UNID = "{$events_id}";
			$(document).ready(function(){IDesign.ui.Default.init();})
			$(document).ready(function(){IDesign.ui.Upload.init();})
END;
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	
	function swfuploader($swfcontroller = "#swfupload-control", $button = "#button", $linkprocess = "upload.php", $log = "#log", $file_type = "*.*")
	{
		$BASE_URL = BASE_URL;
		$JS_PATH=JS_PATH;
		$this->CI->smarty->append("add_JS",$this->CI->all_js->addJS("swfuploader"));
		$addinlineJS=<<<END
		$(document).ready(function(){
									$('{$swfcontroller}').swfupload({
										upload_url: "{$linkprocess}",
										file_size_limit : "10240",
										file_types : "{$file_type}",
										file_types_description : "All Files",
										file_upload_limit : "0",
										flash_url : "{$JS_PATH}swfuploader/vendor/swfupload/swfupload.swf",
										button_image_url : '{$JS_PATH}swfuploader/vendor/swfupload/XPButtonUploadText_61x22.png',
										button_width : 61,
										button_height : 22,
										button_placeholder : $('{$button}')[0],
										debug: true,
										custom_settings : {}
									})
										.bind('swfuploadLoaded', function(event){
											$('{$log}').append('<li>Loaded</li>');
										})
										.bind('fileQueued', function(event, file){
											$('{$log}').append('<li>File queued - '+file.name+'</li>');
											// start the upload since it's queued
											$(this).swfupload('startUpload');
										})
										.bind('fileQueueError', function(event, file, errorCode, message){
											$('{$log}').append('<li>File queue error - '+message+'</li>');
										})
										.bind('fileDialogStart', function(event){
											$('{$log}').append('<li>File dialog start</li>');
										})
										.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
											$('{$log}').append('<li>File dialog complete</li>');
										})
										.bind('uploadStart', function(event, file){
											$('{$log}').append('<li>Upload start - '+file.name+'</li>');
										})
										.bind('uploadProgress', function(event, file, bytesLoaded){
											$('{$log}').append('<li>Upload progress - '+bytesLoaded+'</li>');
										})
										.bind('uploadSuccess', function(event, file, serverData){
											$('{$log}').append('<li>Upload success - '+file.name+'</li>');
										})
										.bind('uploadComplete', function(event, file){
											$(this).swfupload('startUpload');
											/*$('{$log}').append('<li>Upload complete - '+file.name+'</li>').html('<li>Loaded</li>');*/
											// upload has completed, lets try the next one in the queue
										})
										.bind('uploadError', function(event, file, errorCode, message){
											$('{$log}').append('<li>Upload error - '+message+'</li>');
										});
									
								});	
END;
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}
}

<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * InitialDesign Utility class
 */
class Utility extends Id
{
    
	var $themes_table = 'themes';
    
    function Utility()
    {
        parent::Id();
		$this->CI =& get_instance();
    }
	
    /**
	 * Remove HTML tags, including invisible text such as style and
	 * script code, and embedded objects.  Add line breaks around
	 * block-level tags to prevent word joining after tag removal.
	 */
	function show_info($type_info,$text_info="",$error_area=".errortxt",$confirm_area=".confirmtxt",$errortxt=".errortxt",$confirmtxt=".confirmtxt")
	{
		$addinlineJS="";
		if($type_info=="error"){
			$get_errortxt=$text_info;
		}
		if($type_info=="confirm"){
			$get_confirmtxt=$text_info;
		}
		if(!empty($get_errortxt)){			
				$addinlineJS.=<<<END
		$(document).ready(function(){		
				$('{$errortxt}').html("{$get_errortxt}");
				$('{$error_area}').show('slow');
		});
END;
		}
		if(!empty($get_confirmtxt)){			
				$addinlineJS.=<<<END
		$(document).ready(function(){		
				$('{$confirmtxt}').html("{$get_confirmtxt}");
				$('{$confirm_area}').show('slow');
		});
END;
		}
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}
	function get_info($error_area=".errortxt",$confirm_area=".confirmtxt",$errortxt=".errortxt",$confirmtxt=".confirmtxt")
	{
		$addinlineJS="";
		$get_errortxt=$this->CI->session->flashdata('errortxt');
		if(!empty($get_errortxt)){			
				$addinlineJS.=<<<END
		$(document).ready(function(){		
				$('{$errortxt}').html("{$get_errortxt}");
				$('{$error_area}').show('slow');
		});
END;
		}
		$get_confirmtxt=$this->CI->session->flashdata('confirmtxt');
		if(!empty($get_confirmtxt)){			
				$addinlineJS.=<<<END
		$(document).ready(function(){		
				$('{$confirmtxt}').html("{$get_confirmtxt}");
				$('{$confirm_area}').show('slow');
		});
END;
		}
		$this->CI->smarty->append('InlineJS', $addinlineJS);
	}	
	function remove_html( $text )
	{
	    $text = preg_replace(
	        array(
	          // Remove invisible content
	            '@<head[^>]*?>.*?</head>@siu',
	            '@<style[^>]*?>.*?</style>@siu',
	            '@<script[^>]*?.*?</script>@siu',
	            '@<object[^>]*?.*?</object>@siu',
	            '@<embed[^>]*?.*?</embed>@siu',
	            '@<applet[^>]*?.*?</applet>@siu',
	            '@<noframes[^>]*?.*?</noframes>@siu',
	            '@<noscript[^>]*?.*?</noscript>@siu',
	            '@<noembed[^>]*?.*?</noembed>@siu',
	          // Add line breaks before and after blocks
	            '@</?((address)|(blockquote)|(center)|(del))@iu',
	            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
	            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
	            '@</?((table)|(th)|(td)|(caption))@iu',
	            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
	            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
	            '@</?((frameset)|(frame)|(iframe))@iu',
	        ),
	        array(
	            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
	            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
	            "\n\$0", "\n\$0",
	        ),
	        $text );
	    return strip_tags( $text );
	}
	
	function FormChecked($dt_assign,$data){
		$data2[$data]="checked=\"checked\"";
		$this->CI->smarty->assign($dt_assign, $data2);
	}
	function checked($dt_assign,$data){
		$data2[$data]="checked=\"checked\"";
		$this->CI->smarty->assign($dt_assign, $data2);
	}
	function selected($dt_assign,$data){
		$data2[$data]="selected=\"selected\"";
		$this->CI->smarty->assign($dt_assign, $data2);
	}
	function addText($val1,$val2,$separator){
		if(!empty($val2)){
			if(empty($val1)){
				$val1=$val2;
			}else
			{
				$val1.=$separator.$val2;
			}
		}
		return $val1;
	}
	function price_convert($val1){
		//check decimal
		$xval=explode(".",$val1);
		if(empty($xval[1])){
			$val1=$xval[0];
		}else
		{
			if($xval[1]=="00"){
				$val1=$xval[0];
			}else
			{				
				$val1=$xval[0].".".$xval[1];
			}
		}	
		$val1=str_replace(".",",",$val1);
		return $val1;
	}
	function mydate($var1,$xformat="Y-m-d H:i:s"){
		$var1_exp=explode(" ",$var1);
		$var1_exp2=explode("-",$var1_exp[0]);
		$var1_exp3=explode(":",$var1_exp[1]);
		$mydate=date($xformat,mktime($var1_exp3[0],$var1_exp3[1],$var1_exp3[2],$var1_exp2[1],$var1_exp2[2],$var1_exp2[0]));
		return $mydate;
	}
    
	function minidesc($text, $length = 200, $ending = '...', $exact = true, $considerHtml = true) {
		if ($considerHtml) {
			// if the plain text is shorter than the maximum length, return the whole text
			if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
				return $text;
			}
			// splits all html-tags to scanable lines
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';
			foreach ($lines as $line_matchings) {
				// if there is any html-tag in this line, handle it and add it (uncounted) to the output
				if (!empty($line_matchings[1])) {
					// if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
						// do nothing
					// if tag is a closing tag (f.e. </b>)
					} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
						// delete tag from $open_tags list
						$pos = array_search($tag_matchings[1], $open_tags);
						if ($pos !== false) {
							unset($open_tags[$pos]);
						}
					// if tag is an opening tag (f.e. <b>)
					} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
						// add tag to the beginning of $open_tags list
						array_unshift($open_tags, strtolower($tag_matchings[1]));
					}
					// add html-tag to $truncate'd text
					$truncate .= $line_matchings[1];
				}
				// calculate the length of the plain text part of the line; handle entities as one character
				$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
				if ($total_length+$content_length> $length) {
					// the number of characters which are left
					$left = $length - $total_length;
					$entities_length = 0;
					// search for html entities
					if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
						// calculate the real length of all entities in the legal range
						foreach ($entities[0] as $entity) {
							if ($entity[1]+1-$entities_length <= $left) {
								$left--;
								$entities_length += strlen($entity[0]);
							} else {
								// no more characters left
								break;
							}
						}
					}
					$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
					// maximum lenght is reached, so get off the loop
					break;
				} else {
					$truncate .= $line_matchings[2];
					$total_length += $content_length;
				}
				// if the maximum length is reached, get off the loop
				if($total_length>= $length) {
					break;
				}
			}
		} else {
			if (strlen($text) <= $length) {
				return $text;
			} else {
				$truncate = substr($text, 0, $length - strlen($ending));
			}
		}
		// if the words shouldn't be cut in the middle...
		if (!$exact) {
			// ...search the last occurance of a space...
			$spacepos = strrpos($truncate, ' ');
			if (isset($spacepos)) {
				// ...and cut the text in this position
				$truncate = substr($truncate, 0, $spacepos);
			}
		}
		// add the defined ending to the text
		$truncate .= $ending;
		if($considerHtml) {
			// close all unclosed html-tags
			foreach ($open_tags as $tag) {
				$truncate .= '</' . $tag . '>';
			}
		}
		return $truncate;
	}
	
	function objToArray($obj)
	{
		$_arr = is_object($obj) ? get_object_vars($obj) : $obj;
		foreach ($_arr as $key => $val)
		{
			$val = (is_array($val) || is_object($val)) ? $this->_objToArray($val) : $val;
			$arr[$key] = $val;
		}
		return $arr;
	}
	
}

?>

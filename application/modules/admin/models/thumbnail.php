<?php
/**
 * Description of Mhome
 *
 * @author opq
 */
class Thumbnail extends MY_Model {

	
	function Thumbnail()
    {
        parent::MY_Model();
    }

    function do_thumb($data,$folder,$des_folder="_thumb",$trail_name="_thumb",$limit_thumb=64)
	{
		/* PATH */
		$source             = PATH_UPLOAD.$folder."/".$data["file_name"];
		$destination_thumb	= PATH_UPLOAD.$folder.$des_folder."/";
									
		// Permission Configuration
		//chmod($source, 0777) ;
							 
		/* Resizing Processing */
		// Configuration Of Image Manipulation :: Static
		$this->load->library('image_lib') ;
		$img['image_library'] = 'GD2';
		$img['create_thumb']  = TRUE;
		$img['maintain_ratio']= TRUE;
					 
		/// Limit Width Resize
		//$limit_thumb    = 64 ;
							 
		// Size Image Limit was using (LIMIT TOP)
		$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
							 
		// Percentase Resize
		if ($limit_use > $limit_thumb) {
			$percent_thumb  = $limit_thumb/$limit_use ;
		}
							 
		//// Making THUMBNAIL ///////
		$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
		$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
							 
		// Configuration Of Image Manipulation :: Dynamic
		$img['thumb_marker'] = $trail_name;
		$img['quality']      = '100%' ;
		$img['source_image'] = $source ;
		$img['new_image']    = $destination_thumb ;
							 
		// Do Resizing
		$this->image_lib->initialize($img);
		$this->image_lib->resize();
		$this->image_lib->clear() ;	
										
		$img_thumb=$data["raw_name"].$trail_name.$data["file_ext"];
		return $img_thumb;
	}

}

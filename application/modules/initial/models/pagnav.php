<?php
class Pagnav extends MY_Model {

	var $menus = '';
	var $submenus = '';
    
	function Pagnav()
    {
        parent::MY_Model();
    }
    
	function pagination($noPage=1,$pageDisplay="",$tblName="menu_",$orderBy='',$add_where='',$limit_display_page=100,$pagingURL="",$pageName='',$searchVar="",$SQLselect="*",$add_sqljoin="OR"){		
		if(empty($noPage)){$noPage=1;}else
		{
			$trans = array(".html" => "", "page_" => "");
			$noPage=strtr($noPage, $trans);		
		}
		if(empty($pageDisplay)){$pageDisplay=PER_PAGE;}
		//check for search session
		if(!empty($searchVar['query'])){
				$searchVar_query=$searchVar['query'];
				if(!empty($add_where)){
					$add_where.=" AND ($searchVar_query) ";
				}else
				{
					$add_where.="$searchVar_query";
				}
		}

		//other query
		if(!empty($add_where)){$add_where="WHERE ".$add_where;}
		if(!empty($orderBy)){$orderBy="ORDER BY ".$orderBy;}
		$cek_all_page2 = $this->db->query("SELECT {$SQLselect} FROM {$tblName} {$add_where} {$orderBy}");
		
		$total_all_page2=$cek_all_page2->num_rows();
		
		$pageNum=($noPage-1)*$pageDisplay;
		$showPage=ceil($total_all_page2/$pageDisplay);
		
		$cek_all_page = $this->db->query("SELECT {$SQLselect} FROM {$tblName} {$add_where} {$orderBy} LIMIT {$pageNum},{$pageDisplay}");
		$total_all_page=$cek_all_page->num_rows();
		
		$firstNews=$pageNum+1;
		$lastNews=$pageNum+$total_all_page;
		$pagination="";
		if($showPage>=$limit_display_page){													
			if($noPage<=$limit_display_page){
				$showPage_end=$limit_display_page;
				$showPage_start=1;
			}else
			{
				$showPage_end=$noPage+4;
				$showPage_start=$noPage-4;				
			}
			if($showPage_start<=0){
				$showPage_start=1;
			}
			if($showPage_end>=$showPage){
				$showPage_end=$showPage;
			}
														
		}else
		{
			$showPage_end=$showPage;
			$showPage_start=1;
		}
		if($noPage<=$showPage AND $noPage>1){
			$page_link=$pagingURL.$pageName."1".extension;
			#$pagination.= '<li><a href="'.$page_link.'">&laquo</a></li>';
		}
		if(($noPage-1)>=1){
			$no=$noPage-1;
			$page_link=$pagingURL.$pageName.$no.extension;
			$pagination.= '<li><a href="'.$page_link.'">&laquo</a></li>';
		}
		for ($no=$showPage_start;$no<=$showPage_end;$no++){
			if($showPage>1){
				$page_link=$pagingURL.$pageName.$no.extension;
				if($no==$noPage){
					$pagination.= ' <li class="active"><a href="#" >'.$no.'</a></li>';
				}else
				{
					$pagination.= ' <li><a href="'.$page_link.'" >'.$no.'</a></li>';
				}
			}	
		}	
		if(($noPage+1)<=$showPage){
			$no=$noPage+1;
			$page_link=$pagingURL.$pageName.$no.extension;
			$pagination.= ' <li><a href="'.$page_link.'">&raquo;</a></li>';
		}
		if($noPage<$showPage){		
			$page_link=$pagingURL.$pageName.$showPage.extension;
			#$pagination.= ' <li><a href="'.$page_link.'">&raquo;</a></li>';
		}
		if(!empty($pagination)){$pagination;}
		$USEDATA['result']=$cek_all_page->result_array();
		$USEDATA['result_total']=$cek_all_page2->result_array();
		$USEDATA['paging']=$pagination;
		$USEDATA['num_row_total']=$total_all_page2;
		$USEDATA['num_row']=$total_all_page;
		$USEDATA['pagenum']=$pageNum;
		//$this->smarty->assign('data_show', $total_all_page);
		
		//$this->output->enable_profiler(TRUE);
		return $USEDATA;
	}
        
        function send_email($to='', $content='', $subject='') {
		/* Dalam CodeIgniter disediakan library pengiriman notifikasi ke user, dsb, yaitu library class Email.php
		   diinisialisasi dulu dengan :*/
		 $this->load->library('email');
		 
		/*setting secara manual,simpan di dalam satu variabel array $config */
		 $config['protocol']='smtp';
		 $config['smtp_host']='ssl://smtp.gmail.com';
		 $config['smtp_port']='465';
		 $config['smtp_timeout']='30';
		 $config['smtp_user']='aribascom@gmail.com';
		 $config['smtp_pass']='setya87890m';
		 $config['charset'] = "iso-8859-1";
		 $config['wordwrap'] = TRUE;
		 $config['mailtype'] = "html";
		 $config['newline']="\r\n";
		 
		/*panggil dengan perintah initialize dari objek email :*/
		 $this->email->initialize($config);
		 
		/*metode pengiriman email dari library */
		 $this->email->from('admin@pasarindustri.com','PASAR INDUSTRI');      
		 $this->email->to($to);
		 $this->email->subject($subject);
		 $this->email->message($content);
		 return $this->email->send(); 
	}

}

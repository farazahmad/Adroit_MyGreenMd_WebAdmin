<?php
/**
 * Description of Mhome
 *
 * @author opq
 */
class Pagnav extends MY_Model {

	var $menus = '';
	var $submenus = '';
    
	function Pagnav()
    {
        parent::MY_Model();
    }

    function addSearch($searchVar=""){
		$searchVar_session = $searchVar['session'];
		$ADMIN_PATH=MEMBER_PATH;
		$addinlineJS=<<<END
		$(document).ready(function(){
			$("#do_search").click(function(){
				$('#{$searchVar_session}_do').val('search');
				$('#fsearch').submit();
			});
			$("#do_reset").click(function(){
				$('#{$searchVar_session}_do').val('reset');
				$('#fsearch').submit();
			});
			$("#searchtxt").click(function(){
				$("#searchtxt").val('');
			});
		 });
END;
		$this->smarty->append('InlineJS', $addinlineJS);
		$searchVar_txtsearch = $this->session->userdata($searchVar_session."_txtsearch");
		$txtShow="";
		if(!empty($searchVar_txtsearch)){$txtShow="Search for : {$searchVar_txtsearch}";}
		$searchForm=<<<END
		<form action="{$ADMIN_PATH}{$searchVar_session}" name="fsearch" id="fsearch" method="POST">
		{$txtShow}
				<div class="fright">
					<input type="hidden" id="{$searchVar_session}_do" name="{$searchVar_session}_do" value="">
					<input type="text" name="{$searchVar_session}_txtsearch" value="{$searchVar_txtsearch}" id="searchtxt">
					<a class="buttonLink2 button_searchL " id="do_search">Search</a>&nbsp;|&nbsp;<a class="buttonLink2 button_resetL " id="do_reset">Reset</a>						
				</div>
				<div class="clearall"></div>
			</form>
END;
		$this->smarty->assign("searchForm", $searchForm);
		$sess_search = $this->input->post($searchVar_session."_txtsearch");
		$sess_do = $this->input->post($searchVar_session."_do");
		if($sess_do=="reset"){
			$this->session->unset_userdata($searchVar_session."_txtsearch");
			redirect('member/'.$searchVar_session);
		}else
		{
			if(!empty($sess_search)){
				$this->session->set_userdata(array($searchVar['session']."_txtsearch"=>$sess_search));
				redirect('member/'.$searchVar['session']);
			}
			
		}	
	}
	function search_get($getData="",$tblName="",$add_where='',$orderBy='',$searchVar=''){	
		
		
			$searchVar_data=$this->session->userdata($searchVar['session']."_txtsearch");
			if(!empty($searchVar_data)){
				$replaceData = array("{searchVar}" => $searchVar_data);
				$searchVar_query=strtr($add_where, $replaceData);
				$add_where="$searchVar_query";
			}		
		
		if(!empty($add_where)){$add_where="WHERE ".$add_where;}
		if(!empty($orderBy)){$orderBy="ORDER BY ".$orderBy;}	
		$cek_all_data = $this->db->query("SELECT {$getData} FROM {$tblName} {$add_where} {$orderBy}");
		$outPut="";
		foreach($cek_all_data->result_array() as $row){
			$outPut[]="$getData = '{$row[$getData]}'";
		}
		$allout="";
		if($cek_all_data->num_rows()>=1){
			$allout=implode(" OR ",$outPut);
		}
		return $allout;
	}
	function pagination($noPage=1,$pageDisplay="",$tblName="menu_",$orderBy='',$add_where='',$limit_display_page=100,$pagingURL="",$pageName='',$searchVar="",$SQLselect="*",$add_sqljoin="OR"){		
		if(empty($noPage)){$noPage=1;}else
		{
			$trans = array(".html" => "", "page_" => "");
			$noPage=strtr($noPage, $trans);		
		}
		if(empty($pageDisplay)){$pageDisplay=PER_PAGE;}
		//check for search session
		if(!empty($searchVar['session']) AND !empty($searchVar['query'])){
			$searchVar_data=$this->session->userdata($searchVar['session']."_txtsearch");
			if(!empty($searchVar_data)){
				$replaceData = array("{searchVar}" => $searchVar_data);
				$searchVar_query=strtr($searchVar['query'], $replaceData);
				
				if(!empty($add_where)){
					$add_where.=" {$add_sqljoin} ($searchVar_query) ";
				}else
				{
					$add_where.="$searchVar_query";
				}
			}
		}
		//echo $add_where; die();
		//if(!empty($add_where)){$this->db->where($add_where);}		
		//if(!empty($orderBy)){$this->db->order_by($orderBy);}		
		//$cek_all_page2 = $this->db->get($tblName);
		
		//other query
		if(!empty($add_where)){$add_where="WHERE ".$add_where;}
		if(!empty($orderBy)){$orderBy="ORDER BY ".$orderBy;}	
		$cek_all_page2 = $this->db->query("SELECT {$SQLselect} FROM {$tblName} {$add_where} {$orderBy}");
		
		$total_all_page2=$cek_all_page2->num_rows();
		
		$pageNum=($noPage-1)*$pageDisplay;
		$showPage=ceil($total_all_page2/$pageDisplay);
		
		//if(!empty($add_where)){$this->db->where($add_where);}		
		//if(!empty($orderBy)){$this->db->order_by($orderBy);}
		//$cek_all_page = $this->db->get($tblName,$pageDisplay,$pageNum);		
		
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
			$pagination.= ' <a href="'.$page_link.'">First</a>';
		}
		if(($noPage-1)>=1){	
			$no=$noPage-1;
			$page_link=$pagingURL.$pageName.$no.extension;
			$pagination.= ' <a href="'.$page_link.'">&lsaquo;&lsaquo;</a>';
		}
		for ($no=$showPage_start;$no<=$showPage_end;$no++){
			if($showPage>1){
				$page_link=$pagingURL.$pageName.$no.extension;
				if($no==$noPage){
					$pagination.= ' <b class="this-page">'.$no.'</b>';
				}else
				{
					$pagination.= ' <a href="'.$page_link.'" >'.$no.'</a>';
				}
			}	
		}	
		if(($noPage+1)<=$showPage){
			$no=$noPage+1;
			$page_link=$pagingURL.$pageName.$no.extension;
			$pagination.= ' <a href="'.$page_link.'" >&rsaquo;&rsaquo;</a>';
		}
		if($noPage<$showPage){		
			$page_link=$pagingURL.$pageName.$showPage.extension;
			$pagination.= ' <a href="'.$page_link.'">Last</a>';
		}
		if(!empty($pagination)){$pagination="PAGE : ".$pagination;}
		$USEDATA['result']=$cek_all_page->result_array();
		$USEDATA['result_total']=$cek_all_page2->result_array();
		$USEDATA['paging']=$pagination;
		$USEDATA['num_row_total']=$total_all_page2;
		$USEDATA['num_row']=$total_all_page;
		$USEDATA['pagenum']=$pageNum;
		
		//$this->smarty->assign('data_show', $total_all_page);
		return $USEDATA;
	}

}

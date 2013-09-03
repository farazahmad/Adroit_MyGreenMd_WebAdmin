<?php
/*************************************************
 * Max's Whois
 *
 * Version: 1.0
 * Date: 2007-11-28
 *
 ****************************************************/

class Maxwhois{

    var $serverList;
    var $tr = 0;

function Maxwhois($lang)
{
    $this->CI =& get_instance();

    $query = $this->CI->db->get('domain');
    if ($query->num_rows() > 0)
    {
        foreach($query->result_array() as $id=>$row)
        {
            $this->serverList[$id] = array(
                'top'           => $row['domain_ext'],
                'server'        => $row['server'],
                'response'      => $row['response'],
                'check'         => false,
                'price'         => $row['price'],
                'description'   => $row[$lang.'_description'],
                'features'      => $row[$lang.'_feature'],
                'link'          => $row[$lang.'_link'],
                'lang'          => $lang,
                );
        }
    }
//        $this->serverList[0]['top']      = 'com';
//        $this->serverList[0]['server']   = 'whois.crsnic.net';
//        $this->serverList[0]['response'] = 'No match for';
//        $this->serverList[0]['check']    = true;
//        $this->serverList[0]['price']    = '$9,90';
//        $this->serverList[0]['description']    = 'DOT COM Description';
//
//        $this->serverList[1]['top']      = 'net';
//        $this->serverList[1]['server']   = 'whois.crsnic.net';
//        $this->serverList[1]['response'] = 'No match for';
//        $this->serverList[1]['check']    = false;
//        $this->serverList[1]['price']    = '$9,90';
//        $this->serverList[1]['description']    = 'DOT NET Description';
//
//        $this->serverList[2]['top']      = 'org';
//        $this->serverList[2]['server']   = 'whois.publicinterestregistry.net';
//        $this->serverList[2]['response'] = 'NOT FOUND';
//        $this->serverList[2]['check']    = false;
//        $this->serverList[2]['price']    = '$9,90';
//        $this->serverList[2]['description']    = 'DOT ORG Description';
//
//        $this->serverList[3]['top']      = 'info';
//        $this->serverList[3]['server']   = 'whois.afilias.net';
//        $this->serverList[3]['response'] = 'NOT FOUND';
//        $this->serverList[3]['check']    = false;
//        $this->serverList[3]['price']    = '$9,90';
//        $this->serverList[3]['description']    = 'DOT INFO Description';
//
//        $this->serverList[4]['top']      = 'name';
//        $this->serverList[4]['server']   = 'whois.nic.name';
//        $this->serverList[4]['response'] = 'No match';
//        $this->serverList[4]['check']    = false;
//        $this->serverList[4]['price']    = '$9,90';
//        $this->serverList[4]['description']    = 'DOT NAME Description';
//
//        $this->serverList[5]['top']      = 'us';
//        $this->serverList[5]['server']   = 'whois.nic.us';
//        $this->serverList[5]['response'] = 'Not found:';
//        $this->serverList[5]['check']    = false;
//        $this->serverList[5]['price']    = '$9,90';
//        $this->serverList[5]['description']    = 'DOT US Description';
//
//        $this->serverList[6]['top']      = 'biz';
//        $this->serverList[6]['server']   = 'whois.nic.biz';
//        $this->serverList[6]['response'] = 'Not found';
//        $this->serverList[6]['check']    = false;
//        $this->serverList[6]['price']    = '$9,90';
//        $this->serverList[6]['description']    = 'DOT BIZ Description';
    
}

function showWhois(){

    $i = 0;
    $show = '';
    foreach ($this->serverList as $value) {
        if ($value['check'] == true) $checked=" checked ";
        else $checked = " ";

        $show .= '<td align="left" style="padding:5px; font-size:15px"><input type="checkbox" name="top_'.$value['top'].'"'.$checked.'/>.'.$value['top'].'</td>';
        $i++;
        if ($i > 4) {
            $i = 0;
            $show .= '</tr><tr>';
        }
    }
    return $show;
}

function processWhois(){

    $domainName = (isset($_POST['domain'])) ? $_POST['domain'] : '';

    for ($i = 0; $i < sizeof($this->serverList); $i++) {
        $actTop = "top_".$this->serverList[$i]['top'];
        $this->serverList[$i]['check'] = isset($_POST[$actTop]) ? true : false;
    }

    // Check domains only if the base name is big enough
    if (strlen($domainName)>2){
        $show = '';

        for ($i = 0; $i < sizeof($this->serverList); $i++) {
            if ($this->serverList[$i]['check']){
                $show .= $this->showDomainResult($domainName.".".$this->serverList[$i]['top'],
                                        $this->serverList[$i]['server'],
                                        $this->serverList[$i]['response'],
                                        $this->serverList[$i]['price'],
                                        $this->serverList[$i]['description'],
                                        $this->serverList[$i]['features'],
                                        $this->serverList[$i]['link'],
                                        $this->serverList[$i]['lang']);
            }
        }
        return $show;
    }


}

function showDomainResult($domain,$server,$findText,$price,$description,$features,$link,$lang){
   if ($this->tr == 0){
       $this->tr = 1;
       $class = " class='tr2'";
   } else {
       $this->tr = 0;
       $class = "";
   }
   $show = '';
   $registered = ($lang=='en')?'Registered':'Geregistreerd';
   if ($this->checkDomain($domain,$server,$findText)){
      $show .= '<tr>
                    <td width="157" height="70" align="center" valign="middle">'.$domain.'</td>
                    <td width="7">&nbsp;</td>
                    <td width="200" align="left" valign="middle">'.$description.'</td>
                    <td width="105" align="center" valign="middle" class="boldtxt orangetxt">&euro; '.$price.'</td>
                    <td width="1">&nbsp;</td>
                    <td width="117" align="left" valign="middle">'.$features.'</td>
                    <td align="center" valign="middle"><a href="'.$link.'"><img src="'.IMG_PATH.'/button/order_btn_'.$lang.'.gif"></a></td>
                </tr>';
   } else {
      $show .= '<tr>
                    <td width="157" height="70" align="center" valign="middle">'.$domain.'</td>
                    <td width="7">&nbsp;</td>
                    <td width="200" align="left" valign="middle">'.$description.'</td>
                    <td width="105" align="center" valign="middle" class="boldtxt orangetxt">&euro; '.$price.'</td>
                    <td width="1">&nbsp;</td>
                    <td width="117" align="left" valign="middle">'.$features.'</td>
                    <td align="center" valign="middle">'.$registered.'</td>
                </tr>';
   }
   return $show;
}

function checkDomain($domain,$server,$findText){
    $con = fsockopen($server, 43);
    if (!$con) return false;

    // Send the requested doman name
    fputs($con, $domain."\r\n");

    // Read and store the server response
    $response = ' :';
    while(!feof($con)) {
        $response .= fgets($con,128);
    }

    // Close the connection
    fclose($con);

    // Check the response stream whether the domain is available
    if (strpos($response, $findText)){
        return true;
    }
    else {
        return false;
    }
}

}
?>

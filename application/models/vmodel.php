<?php
class vmodel extends CI_Model{
	var $tittle;
	var $uname;
    var $cct;
	var $catalog=array();
	function con($i,$pic,$ms,$uid)
	{
		//echo $i;
		//echo $pic;
		$pics=array("tupian/yangpi.jpg","tupian/dongri.jpg","tupian/lanse.jpg","tupian/lvse.jpg","tupian/shuidi.jpg","tupian/qianse.jpg");
		if($i == 0)
            $this->convertopdf("http://myvbook.sinaapp.com/mytest/".$pics[$pic],$ms,$uid);
		else if($i == 1)
			$this->convertopdf1("http://myvbook.sinaapp.com/mytest/".$pics[$pic],$ms,$uid);
		else if($i == 2)
			$this->convertopdf2("http://myvbook.sinaapp.com/mytest/".$pics[$pic],$ms,$uid);
		else if($i == 3)
			$this->convertopdf3("http://myvbook.sinaapp.com/mytest/".$pics[$pic],$ms,$uid);
			
	}
	function convertopdf($back,$ms,$uid)
	{
		require_once(APPPATH.'/libraries/tcpdf/config/lang/chi.php');
		require_once(APPPATH.'/libraries/tcpdf/tcpdf.php');
        try{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('中文');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(5);
		$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray($l);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('droidsansfallback', '', 12);
		//$this->user=unserialize($_SESSION["User"]);
		//$ms=$this->user->ms;
		$len=count($ms);
		$pg=$len/6;
		$i=0;
		$pi=0;
		$ai=0;
		$ifpage=false;
		$pdf->AddPage();
		$pdf->SetFooterMargin(0);
		$pdf->SetTextColor(0, 63, 127);
		$pdf->Image($back,0,0,210,298);
		$html = $this->getcover("myvbook","limuhit");
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->startPageGroup();
        $i=$len-1;
		for($p=0;$i>=0;$p++)
		{
            //$fin = fopen("{$p}.html","w");
			$ifpage=false;
			$html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
			for($ll=0;$ll <78&&$i>=0;$i-- )
			{
				$item=$ms[$i];
				$time=$item->time;
				
				if($item->used)
				{
					$ifpage=true;
					$this->catalog[$ai]=array("time"=>$item->ttime,"page"=>($pi+1));
					$html.="<tr>
					<td align=\"center\" width =\"540\" height =\"30\"  font style=\"font-size:40px;font-weight:bold;color:#003366;}\">{$time}</td ></tr>";
					if($item->img!="")
					{
						$html.="<tr>
						<td width =\"180\"  ><img src=\"{$item->img}\"  height=\"125\" /></td>
						<td width =\"360\"font style=\" font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
						
						</tr>";
						$ll+=20;
					}
					else
					{
						$html.="<tr>
						
						<td align=\"left\" width =\"540\" font style=\"font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
						</tr>
						";
						$ll+=20;
					}
					$ai++;
				}
				
			}
			$pi++;
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
			if($ifpage)
			{
				$pdf->AddPage();
				$pdf->SetFooterMargin(6);
				$pdf->SetTextColor(0, 63, 127);
				$pdf->Image($back,0,0,210,298);
                $pdf->writeHTML($html, true, false, true, false, '');
			}
            //fwrite($fin,$html);
            //fclose($fin);
		}
        if($this->cct>0)
        {
         	$cat=$this->getcat();
    	 	$llt=count($cat);
        	$st=2;
        	for($i=0;$i<$llt;)
       	 	{
                $html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
         	$j=0;
			for(;$i<$llt,$j<11;$i++,$j++)
			{
				$html.=$cat[$i];
			}
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
      		$pdf->AddPage();
	 		$pdf->SetFooterMargin(0);
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
            $pdf->movePage($pi+2, $st);
            $st++;
            $pi++;
        	}
        }
        //  print_r($cat);
        // die();
        //print_r($cat);
        // $cct=$this->getcat();
        //  print_r($cct);
        //die();
		$pdf->lastPage();
		$mypdf=$pdf->Output($uid.'_0.pdf', 'S');
        $s = new SaeStorage();
        $s->write('stmyvbook',$uid.'_0.pdf',$mypdf);
        }
        catch (Exception $e) {   
			echo "不好意思,网速略卡，无法获取微博中的图片，请刷新浏览器尝试重新获取";   
			exit();   
		}   
		
		
	}
    function creatcat()
    {
        $cat=array();
        
        foreach($this->catalog as $it)
        {       
            $tm1=$it['time']['year']."年".$it['time']['mon']."月";
           	$tm2=$it["time"]["mon"]."月".$it["time"]["day"]."日";
            if(!isset($cat[$tm1]))
            {
                
                $cat[$tm1]=array();
                $cat[$tm1]['name']=$tm1;
            }
     	 	if(!isset($cat[$tm1][$tm2]))
            {
                $cat[$tm1][$tm2]['pg']=$it["page"];
                $cat[$tm1][$tm2]['str']=$tm2;
            }
        }
        return $cat;
    }
    function getcat()
    {
      $cat=$this->creatcat();  
	  $cct=array();
      $i=0;
      $j=1;
         foreach($cat as $ab)
	 {
          $cct[$i]="<tr><td><font size = \"24\" >."."第".$j."章"."		".$ab['name']."</font></td></tr>";
          $i++;
          $j++;
          //<a href="#3">go to page 3</a>
          foreach($ab as $item)
          {
            if($item["str"]=="2")
                continue;
              $html="<tr><td><a href=\"#".floor($item["pg"]+1+$i/11)."\"><font size = \"16\" >.".$item["str"];
			$html.="\t……………………………………………………";
			$html.=$item["pg"];
              $html.="</font></a></td></tr>";
            $cct[$i]=$html;
              //     echo $html;
            $i++;
          }
      }
        //die();
        return $cct;
    }
	function getcover()
	{
		
		$html=" 
<html>
<body>
<table>
<tr><td height = \"50\" ></td></tr>
<tr><td height = \"50\"></td></tr>
<tr><td height = \"50\"></td></tr>
<tr><td height = \"50\"></td></tr>
<tr><td height = \"90\"></td></tr>
<tr><td height = \"90\" width =\"440\" align =\"center\" ><font size = \"36\" >";
$html.=$this->tittle;
$html.="</font></td><td height = \"100\" width =\"120\"></td></tr>
<tr><td height = \"90\"></td></tr>
<tr><td height = \"90\"></td></tr>
<tr><td height = \"90\" width =\"160\" ></td><td height = \"90\" width =\"210\"align =\"right\"><font size = \"24\">";
$html.=$this->uname;
$html.="</font></td><td height = \"80\" width =\"180\"></td></tr>
<tr><td height = \"90\"></td></tr>
<tr><td height = \"90\" width =\"180\" ></td><td height = \"90\" width =\"180\"></td><td height = \"170\" width =\"180\"align =\"right\"><font size = \"24\">";
$html.=date('Y-m-d',time());
$html.="</font></td></tr>
<tr><td height = \"50\"><td></tr>
</table>
</body>
</html>";
	return $html;
	}
	function convertopdf3($back,$ms,$uid)
	{
		require_once(APPPATH.'/libraries/tcpdf/config/lang/chi.php');
		require_once(APPPATH.'/libraries/tcpdf/tcpdf.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('中文');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        try{
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(5);
		$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray($l);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('droidsansfallback', '', 12);
		//$this->user=unserialize($_SESSION["User"]);
		//$ms=$this->user->ms;
		$len=count($ms);
		$pg=$len/6;
		$i=0;
        $pi=0;
		$ai=0;
		$pdf->AddPage();
		$pdf->SetFooterMargin(0);
		$pdf->SetTextColor(0, 63, 127);
		$pdf->Image($back,0,0,210,298);
		$html = $this->getcover("myvbook","limuhit");
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->startPageGroup();
        $i=$len-1;
		for($p=0;$i>=0;$p++)
		{
            //$fin = fopen("{$p}.html","w");
			$html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
			for($ll=0;$ll <64&&$i>=0;$i-- )
			{
				$item=$ms[$i];
				$time=$item->time;
				if($item->used)
				{
                    $llmt=0;
                    if(count($item->comments)>0)
					{
					
                      for($ij=0;$ij<$item->ci;$ij++)
						{
							$itm=$item->comments[$ij];
                 		    $llmt+=2*ceil((strlen($itm->text)+18)/49);
						}
						
					}
                    if($ll+$llmt>64&&$ll>0)
                    {
                           goto endt;
                    }
                    $this->catalog[$ai]=array("time"=>$item->ttime,"page"=>($pi+1));
                    $ai++;
					$html.="<tr>
					<td align=\"center\" width =\"540\" height =\"30\"  font style=\"font-size:40px;font-weight:bold;color:#003366;}\">{$time}</td ></tr>";
					if($item->img!="")
					{
						$html.="<tr>
						<td width =\"180\"  ><img src=\"{$item->img}\"  height=\"125\" /></td>
						<td width =\"360\"font style=\" font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
						
						</tr>";
						$ll+=20;
					}
					else
					{
						$html.="<tr>
						
						<td align=\"left\" width =\"540\" font style=\"font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
						</tr>
						";
						$ll+=20;
					}
				
					if(count($item->comments)>0)
					{
						$html.="<tr><td align=\"left\" width =\"540\" font style=\"font-size:30px;font-weight:bold;color:#666666;}\">";
						$html.="评论:<br>";
						for($ij=0;$ij<$item->ci;$ij++)
						{
							$itm=$item->comments[$ij];
							$html=$html.$itm->cname.":".$itm->text."	(".$itm->time.")<br>";
                        	$ll+=2*ceil((strlen($itm->text)+18)/49);
						}
						$html.="</td></tr>";
					}
               }
			}
            endt:         $pi++;
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
			$pdf->AddPage();
			$pdf->SetFooterMargin(6);
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
            $pdf->writeHTML($html, true, false, true, false, '');
            //fwrite($fin,$html);
            //fclose($fin);
		}
        if($this->cct>0)
        {
         $cat=$this->getcat();
    	 $llt=count($cat);
        $st=2;
        for($i=0;$i<$llt;)
        {
                $html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
         	$j=0;
			for(;$i<$llt,$j<11;$i++,$j++)
			{
				$html.=$cat[$i];
			}
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
      		$pdf->AddPage();
	 		$pdf->SetFooterMargin(0);
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
            $pdf->movePage($pi+2, $st);
            $st++;
            $pi++;
        }
        }
		$pdf->lastPage();
		$mypdf=$pdf->Output($uid.'_3.pdf', 'S');
        $s = new SaeStorage();
        $s->write('stmyvbook',$uid.'_3.pdf',$mypdf);
        }
		catch (Exception $e) {   
			echo "不好意思,网速略卡，无法获取微博中的图片，请刷新浏览器尝试重新获取";   
			exit();   
		}   
		
		
	}
	function convertopdf1($back,$ms,$uid)
	{
		require_once(APPPATH.'/libraries/tcpdf/config/lang/chi.php');
		require_once(APPPATH.'/libraries/tcpdf/tcpdf.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        try{
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('中文');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(5);
		$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray($l);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('droidsansfallback', '', 12);
		//$this->user=unserialize($_SESSION["User"]);
		//$ms=$this->user->ms;
		$len=count($ms);
		$pg=$len/6;
		$i=0;
        $pi=0;
		$ai=0;
		$pdf->AddPage();
		$pdf->SetFooterMargin(0);
		$pdf->SetTextColor(0, 63, 127);
		$pdf->Image($back,0,0,210,298);
		$html = $this->getcover("myvbook","limuhit");
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->startPageGroup();
		$time="";
        $i=$len-1;
		for($p=0;$i>=0;$p++)
		{
            //$fin = fopen("{$p}.html","w");
			$html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
			for($ll=0;$ll <9;$i-- )
			{
                if($i>=0)
					$item=$ms[$i];
  				else
                {
					$item=$ms[$len];
                    $item->used=true;
                }
				if($item->used)
				{
					$time=$item->time;
                    if($i>=0)
                    {
                    	$this->catalog[$ai]=array("time"=>$item->ttime,"page"=>($pi+1));
                    	$ai++;
                    }
					if($ll%3==0)
						$html.="<tr>";
					
					$html.="<td  font style=\"font-size:25px;font-weight:bold;color:#003366;}\">";
					$html.="{$time}<br /><br /><br />";
					if($item->img!="")
					{
						$html.="
						<img src=\"{$item->img}\"  height=\"125\" /><br />
						 {$item->text}<br /></td>";
						
					}
					else
					{
						$html.="
						{$item->text}<br /></td>
						";
					}
					if($ll%3==2)
						$html.="</tr>";
					$ll++;
				}
			}
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
            $pi++;
            $pdf->SetFooterMargin(6);
			$pdf->AddPage();
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
            //fwrite($fin,$html);
            //fclose($fin);
		}
        if($this->cct>0)
        {
        $cat=$this->getcat();
    	 $llt=count($cat);
        $st=2;
        for($i=0;$i<$llt;)
        {
                $html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
         	$j=0;
			for(;$i<$llt,$j<11;$i++,$j++)
			{
				$html.=$cat[$i];
			}
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
      		$pdf->AddPage();
	 		$pdf->SetFooterMargin(0);
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
            $pdf->movePage($pi+2, $st);
            $st++;
            $pi++;
        }
        }
		$pdf->lastPage();
		$mypdf=$pdf->Output($uid.'_1.pdf', 'S');
        $s = new SaeStorage();
        $s->write('stmyvbook',$uid.'_1.pdf',$mypdf);
        }
        catch (Exception $e) {   
			echo "不好意思,网速略卡，无法获取微博中的图片，请刷新浏览器尝试重新获取";   
			exit();   
		}   
		//$data['name']=$this->user->uid.'.pdf';
		//$this->load->view('download',$data);
		
	}
	function convertopdf2($back,$ms,$uid)
	{
		require_once(APPPATH.'/libraries/tcpdf/config/lang/chi.php');
		require_once(APPPATH.'/libraries/tcpdf/tcpdf.php');
        try{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('中文');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(5);
		$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray($l);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('droidsansfallback', '', 12);
		//$this->user=unserialize($_SESSION["User"]);
		//$ms=$this->user->ms;
		$len=count($ms);
		$pg=$len/6;
		$i=0;
        $pi=0;
		$ai=0;
		$pdf->AddPage();
		$pdf->SetFooterMargin(0);
		$pdf->SetTextColor(0, 63, 127);
		$pdf->Image($back,0,0,210,298);
		$html = $this->getcover("myvbook","limuhit");
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->startPageGroup();
        $i=$len-1;
		for($p=0;$i>=0;$p++)
		{
            //$fin = fopen("{$p}.html","w");
			$html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
			for($ll=0;$ll <78&&$i>=0;$i-- )
			{
				$item=$ms[$i];
				$time=$item->time;
				if($item->used)
				{
                    $this->catalog[$ai]=array("time"=>$item->ttime,"page"=>($pi+1));
                    $ai++;
					$html.="";
					if($i%2==1)
						$html.="<tr>
					<td align=\"right\" width =\"540\" height =\"20\"  font style=\"font-size:40px;font-weight:bold;color:#003366;}\">{$time}</td ></tr>
					<tr> <td width = \"80\"></td>";
					else
						$html.="<tr>
					<td align=\"left\" width =\"540\" height =\"20\"  font style=\"font-size:40px;font-weight:bold;color:#003366;}\">{$time}</td ></tr><tr>";
					if($item->img!="")
					{
						if($i%2==1)
						{
							$html.="
							<td width =\"300\"font style=\" font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
							<td width =\"160\"  ><img src=\"{$item->img}\"  height=\"125\" /></td>
							";
						}
						else
						{
							$html.="
							<td width =\"160\"  ><img src=\"{$item->img}\"  height=\"125\" /></td>
							<td width =\"300\"font style=\" font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
							";
						}
						$ll+=20;
					}
					else
					{
						$html.="
						
						<td align=\"left\" width =\"460\" font style=\"font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
						
						";
						$ll+=20;
					}
					if($i%2==1)
						$html.="</tr>";
					else
						$html.="<td width = \"40\"></td></tr>";
				}
			}
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
			$pdf->AddPage();
            $pi++;
            $pdf->SetFooterMargin(6);
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
            //fwrite($fin,$html);
            //fclose($fin);
		}
        if($this->cct>0)
        {
        $cat=$this->getcat();
    	 $llt=count($cat);
        $st=2;
        for($i=0;$i<$llt;)
        {
                $html= 
<<<EOF
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<table border="2" cellpadding="20" cellspacing="0" align="left">
EOF;
         	$j=0;
			for(;$i<$llt,$j<11;$i++,$j++)
			{
				$html.=$cat[$i];
			}
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
      		$pdf->AddPage();
	 		$pdf->SetFooterMargin(0);
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
            $pdf->movePage($pi+2, $st);
            $st++;
            $pi++;
        }
        }
		$pdf->lastPage();
		$mypdf=$pdf->Output($uid.'_2.pdf', 'S');
        $s = new SaeStorage();
        $s->write('stmyvbook',$uid.'_2.pdf',$mypdf);
        }
        catch (Exception $e) {   
			echo "不好意思,网速略卡，无法获取微博中的图片，请刷新浏览器尝试重新获取";   
			exit();   
		}   
		//$data['name']=$this->user->uid.'.pdf';
		//$this->load->view('download',$data);
	}
}
?>
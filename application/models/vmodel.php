<?php
class vmodel extends CI_Model{
	
	function con($i,$pic,$ms,$uid)
	{
		//echo $i;
		//echo $pic;
		$pics=array("tupian/jingdian.jpg","tupian/blue.jpg","tupian/green.jpg","tupian/jiangshan.jpg","tupian/zhuyin.jpg","tupian/gucun.jpg");
		if($i == 0)
			$this->convertopdf(APPPATH.$pics[$pic],$ms,$uid);
		else if($i == 1)
			$this->convertopdf1(APPPATH.$pics[$pic],$ms,$uid);
		else if($i == 2)
			$this->convertopdf2(APPPATH.$pics[$pic],$ms,$uid);
			
	}
		function entocht($st)
	{
		$tm=explode(" ",$st);
		$week ="";
		$mon="";
		if($tm[0]=="Mon")
			$week="星期一";
		else if($tm[0]=="Tue")
			$week="星期二";
		else if($tm[0]=="Wed")
			$week="星期三";
		else if($tm[0]=="Thu")
			$week="星期四";
		else if($tm[0]=="Fri")
			$week="星期五";
		else if($tm[0]=="Sat")
			$week="星期六";
		else if($tm[0]=="Sun")
			$week="星期日";
		if($tm[1]=="Jan")
			$mon="1月";
		else if($tm[1]=="Feb")
			$mon="2月";
		else if($tm[1]=="Mar")
			$mon="3月";
		else if($tm[1]=="Apr")
			$mon="4月";
		else if($tm[1]=="May")
			$mon="5月";
		else if($tm[1]=="Jun")
			$mon="6月";
		else if($tm[1]=="Jul")
			$mon="7月";
		else if($tm[1]=="Aug")
			$mon="8月";
		else if($tm[1]=="Sep")
			$mon="9月";
		else if($tm[1]=="Oct")
			$mon="10月";
		else if($tm[1]=="Nov")
			$mon="11月";
		else if($tm[1]=="Dec")
			$mon="12月";
		return $tm[5]."年 ".$mon." ".$tm[2]."日 ".$week." ".$tm[3];
		
	}
	function convertopdf($back,$ms,$uid)
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
		
		for($p=0;$i<$len;$p++)
		{
			$fin = fopen("{$p}.html","w");
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
			for($ll=0;$ll <78&&$i<$len;$i++ )
			{
				$item=$ms[$i];
				$time=$this->entocht($item->time);
				if($item->used)
				{
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
						
						<td align=\"center\" width =\"540\" font style=\"font-size:30px;font-weight:bold;color:#666666;}\">{$item->text}</td>
						</tr>
						";
						$ll+=20;
					}
				}
			}
			$html.='</table>';
			$html.='</body>';
			$html.='</html>';
			$pdf->AddPage();
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
			fwrite($fin,$html);
			fclose($fin);
		}
		$pdf->lastPage();
		$pdf->Output($uid.'_0.pdf', 'F');

		
		
	}
	function convertopdf1($back,$ms,$uid)
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
		$time="";
		for($p=0;$i<$len;$p++)
		{
			$fin = fopen("{$p}.html","w");
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
			for($ll=0;$ll <9&&$i<$len;$i++ )
			{
				$item=$ms[$i];
				if($item->used)
				{
					$time=$this->entocht($item->time);
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
			$pdf->AddPage();
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
			fwrite($fin,$html);
			fclose($fin);
		}
		$pdf->lastPage();
		$pdf->Output($this->user->uid.'_1.pdf', 'F');

		//$data['name']=$this->user->uid.'.pdf';
		//$this->load->view('download',$data);
		
	}
	function convertopdf2($back,$ms,$uid)
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
		
		for($p=0;$i<$len;$p++)
		{
			$fin = fopen("{$p}.html","w");
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
			for($ll=0;$ll <78&&$i<$len;$i++ )
			{
				$item=$ms[$i];
				$time=$this->entocht($item->time);
				if($item->used)
				{
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
			$pdf->SetTextColor(0, 63, 127);
			$pdf->Image($back,0,0,210,298);
			$pdf->writeHTML($html, true, false, true, false, '');
			fwrite($fin,$html);
			fclose($fin);
		}
		$pdf->lastPage();
		$pdf->Output($this->user->uid.'_2.pdf', 'F');
		//$data['name']=$this->user->uid.'.pdf';
		//$this->load->view('download',$data);
	}
}
?>
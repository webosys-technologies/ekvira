<?php @session_start();

	//EOF Token
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	</head>

	<body>
	<div class="header">
		<div class="wrapper">
			<div class="logo"><img src="<?php echo $path;?>images/logo.png" alt="Logo" /></div>
			<div class="clr"></div>
			<div class="logotxt"><img src="<?php echo $path;?>images/logo_txt.png" alt="Ordinance Factory Ambajhari Napur" /></div>
			
			<div class="clr"></div>
		</div>
	</div>
<?php	
function site_right($path,$tblpref,$db,$uploadpath)
{
	@session_start();
	$userval = $_SESSION['userval'];	
	?>
	
<?php
}
function site_footer($path, $tblpref, $db, $uploadpath, $connection)
{?>
		<div class="footer">
		<div class="wrapper">
			<div class="fflt">Copyright &copy; <?php echo @date('Y');?> <b>Ordinance Factory Ambajhari Napur</b>. All Rights Reserved</div>
			<div class="ffrt">Designed &amp; Developed by <b>Ocean SoftTech</b></div>
			<div class="clear"></div>
		</div>
	</div>
	</body>
	</html>
<?php
	mysql_close($connection);
}
function admin_header($path2,$title,$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin)
{
	@session_start();
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome To Admin Panel :: <?=$title?></title>
	<link href="<?=$path2?>images/adminfavicon.ico" type="image/x-icon" rel="shortcut icon" />
	<script type="text/javascript" src="<?=$path2?>js/jquery-1.3.1.min.js"></script>
	<link href="<?=$path2?>css/admin.css" rel="stylesheet" type="text/css" />
	<!-- <script type="text/javascript" src="<?=$path2?>js/curvy.js"></script> -->
	<script type="text/javascript" src="<?=$path2?>js/admin-validations.js"></script>
	</head>
	<body>
	<div class="header">
	<?if($_SESSION[username]==""){?>
		<img src="<?=$path2?>images/admin-logo.png" alt="SMS Logo" />
	<?}
	else
	{?>
	<img src="<?=$path2?>images/admin-logo.png" alt="SMS Logo" />
		<div class="logout">
			<div class="admin">
			<div class="admnimg"><a href="<?=$path2.'cplosms/'?>admin-info.php"><img src="<?=$path2?>images/admin.png" alt="Edit Info" title="Edit Info"/></a> </div>
			<?php 
			switch(stripslashes($_SESSION[user_type]))
			{
				case "superadmin":
									echo "Super Administrator";
									break;
				case "subadmin":
									echo "Sub Administrator";
									break;
				
			}?><br/>
			<p class="nameAdm"><a href="<?=$path2.'cplosms/'?>admin-info.php" alt="Edit Info" title="Edit Info"><?=stripslashes(ucfirst($row_admin[admin_name]))?></a></p>
		</div>
		<a href="<?=$path2.'cplosms/'?>changepassword.php"><img src="<?=$path2?>images/lock.png" alt="change password" title="change password" /></a>     
		<a href="<?=$path2.'cplosms/'?>home.php"><img src="<?=$path2?>images/gohome.png" alt="Home" title="Home" /></a>
		<a href="<?=$path2.'cplosms/'?>logout.php" onclick='if(confirm("Do You Really Want To Logoff ?")){return true;}else{return false;}'><img src="<?=$path2?>images/exit.png" alt="Logout" title="Logout" /></a> 
		<!-- <a href="<?=$path2?>help/index.html" target="_blank"><img src="<?=$path2?>images/help.png" alt="Help" title="Help" /></a>  -->
		<p class="welcome">Welcome to the Admin Section of <br/><?=$path1."cplosms/"?></p>
		</div>
		<div class="clear"></div>
	<?}?>
	</div>
	<? }
function admin_footer()
{ ?>
			<div class="footer">
		<p class="flt">Copyright &copy; <?php echo @date('Y');?>. All Rights Reserved </p>
		<p class="frt" style="padding-right:25px;"><a href="http://www.weblogic.co.bw/">Designed &amp; Developed by Weblogic</a></p>
		<div class="clear"></div>
	</div>    

	</body>
	</html>
<? }

//START generation of paging code
function pagination($strsql_pag, $current_page=0, $link_pag=null, $more_querystr=null,
$page_size=0)
{
		global $sitefont,$sitefontweight ;

	if (($page_size+0)==0)
		$page_size=10;
	if ($link_pag == null or $link_pag == "")
		$link_pag=$PHP_SELF ;

	if ($more_querystr != null or $more_querystr != "")
		$more_querystr="&" . $more_querystr ;

	// COUNT
	if (!($result_pag = mysql_query($strsql_pag))){echo "SQL: ".$strsql_pag."<br>ERROR: ".mysql_error();exit;}

	$row_pag = mysql_fetch_array($result_pag);
	$ex_count=mysql_num_rows($result_pag);

	$no_page=ceil($ex_count/$page_size);

	if ($current_page>0)
		$show_from=($current_page-1)*$page_size;
	else
		$show_from=0;
	

	if( $ex_count>$page_size )
	{
		$diplay_string = "<TABLE cellPadding=0 cellspacing=0 width=30% size=0 align=center ><form Name='frmGotoPage'  id='frmGotoPage' method ='post' action ='". $link_pag ."?wew=qwq".$more_querystr ."' onsubmit='return validate();'><TR bgcolor=>";

		if(($current_page + 0)<=0)
			$current_page=1;
		else if (($current_page + 0)>$no_page)
			$current_page=$no_page + 0;
		else
			$current_page=ceil($current_page) + 0;

		if ($current_page  != 1 )
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=>        <A title='Go to the first page' class=Link-TableHeader target=_self href='". "". $link_pag ."?page=1".$more_querystr ."'><b>First</b></A></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=><b>First</b></TD>";


		if ($current_page  !=1 )
			$diplay_string = $diplay_string . "        <TD align=middle width='10%' bgcolor=>        <A title='Go to the previous page' target=_self href='". "". $link_pag ."?page=".($current_page -1).$more_querystr ."'><b>Prev</b></A></TD>";
		else
			$diplay_string = $diplay_string . "        <TD width='10%' align=middle bgcolor=><b>Prev</b></font></TD>";


		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle bgcolor=''><b>Next</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD width='10%' align=middle bgcolor=>$no_pages	<A title='Go to the next page' target=_self href='". $link_pag ."?page=" .($current_page + 1) . $more_querystr. "'><b>Next</b></A></TD>";


		if ($no_page == $current_page)
			$diplay_string = $diplay_string . "	<TD width='10%' align=middle bgcolor=''><b>Last</b></TD>";
		else
			$diplay_string=$diplay_string. "<TD align=middle width='10%' bgcolor=> 	<A title='Go to the last page' target=_self href='". $link_pag ."?page=" .$no_page . $more_querystr. "'><b>Last</b></A></TD>";

		$diplay_string=$diplay_string . "	</TR></form></TABLE>	";

	}

	// make string eg. [1-20 OF 290]
	if ($ex_count > 0)
	{
		$last_record_no = $show_from + $page_size;
		if ($last_record_no > $ex_count)
			$last_record_no = $ex_count;

		$first_record_no = ($show_from+1);
	}
	else
	{
		$last_record_no = 0;
		$first_record_no = 0;
	}


	$return_this = $show_from .",". $page_size ."~". $diplay_string ."~ [ ". $first_record_no . "-". $last_record_no ." OF ". $ex_count ." ] ";

	return  $return_this;

}
function imageresize($width, $height, $target) 
{ 
	//takes the larger size of the width and height and applies the  
	//formula accordingly...this is so this script will work  
	//dynamically with any size image 

	if ( ($width < $target) && ($height < $target) ) { 
		$percentage = 1; 
	} else if ($width > $height) { 
		$percentage = ($target / $width); 
	} else { 
		$percentage = ($target / $height); 
	} 

	//gets the new value and applies the percentage, then rounds the value 
	$width = round($width * $percentage); 
	$height = round($height * $percentage); 

	//returns the new sizes in html image tag format...this is so you 
	//can plug this function inside an image tag and just get the 
	return "width=\"$width\" height=\"$height\""; 
}
//////END generation of pageing code

////// start function to display error

function displayerror($title,$errorno,$errordesc,$links,$reporterror)

{

		global $sitefont ,$sitefontweight;



    //Dim arrlinks 'Array to stores hyperlink text and Url

    //Dim intI 'Counter for For loop

    print "<body>";

    print "<center>";

    print "<table border=1 cellspacing=0 cellpadding=1 width=90%> ";

    print "  <tr bgcolor=#70b4eb>";

    print "    <td><font color=#FFFFFF face='$sitefont' ><b>".$title."</b></font></td>";

    print "  </tr>";

    print "  <tr>";

    print "    <td><br>";

    print "<font face='$sitefont' size='$sitefontweight' ><b> &nbsp;An error occurred during this process.</b></font><br><br>";

    print "<font face='$sitefont' size='$sitefontweight' >".$errorno."&nbsp;"."</font>";

    print "<font face='$sitefont' size='$sitefontweight' >".$errordesc."</font>";

    //$err.$clear;



    $arrlinks=explode(",",$links);

    //echo "<br>".$arrlinks[0]."<p>".$arrlinks[1]."<p>".$arrlinks[2]."<p>".$arrlinks[3];//exit;



    print "<ul>";



    //Loop to show all hyperlinks

    for ($intI=0; ($intI<=count($arrlinks)-1);$intI=$intI+2){

      print "<li><font face=$sitefont size=$sitefontweight><b><a href='".$arrlinks[$intI+1]."'>".$arrlinks[$intI]."</a></font></li>";

    }





    //Condition checks if reporterror is one then show "Report This error" hyperlink

    //if cint(reporterror) = 1 then

    //        Response.Write "<li><a href='#'>Report This error</a></li>"

    //end if

    print "</ul>";

    print "</td>";

    print "</tr>";

    print "</table>";

    print "</center>";

}//end sub


function dateformate2($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
$txtdate=$date1[2]."-".$date1[1]."-".$date1[0];
return $txtdate;
}
function dateformate1($datefor='')
{
$date=$datefor;
$date1=explode("-",$date);
$txtdate=$date1[2].".".$date1[1].".".$date1[0];
return $txtdate;
}
function date_monthh($datefor='')
{
	$date=$datefor;
	$date1=explode("-",$date);
	if($date1[1]=="01"){$date1[1]="January";}
	if($date1[1]=="02"){$date1[1]="February";}
	if($date1[1]=="03"){$date1[1]="March";}
	if($date1[1]=="04"){$date1[1]="April";}
	if($date1[1]=="05"){$date1[1]="May";}
	if($date1[1]=="06"){$date1[1]="June";}
	if($date1[1]=="07"){$date1[1]="July";}
	if($date1[1]=="08"){$date1[1]="August";}
	if($date1[1]=="09"){$date1[1]="September";}
	if($date1[1]=="10"){$date1[1]="October";}
	if($date1[1]=="11"){$date1[1]="November";}
	if($date1[1]=="12"){$date1[1]="December";}
	return substr($date1[1],0,3);
}
function log_entry($module,$modtitle,$action,$tblpref,$db,$adminid,$ip)
{
	@session_start();
	include("config.php");
	$perqury = sprintf("INSERT INTO ".$tblpref."log SET log_admin_id='%d', log_admin_module='%s',log_admin_rec_title='%s', log_admin_action='%s', log_admin_ip='%s',log_admin_date=CURDATE(), log_admin_time=CURTIME()",$adminid, $module, $modtitle, $action, $ip);
	if(!($perresult=mysql_query($perqury)))
	{
		echo mysql_error();
	}
	return true;
}

function str_rand($length = 8, $seeds = 'alphanum')
{
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }
    //echo  $str;
    return $str;
}
function count_table_record($tablename, $fieldname, $tblpref, $db)
{	
	$query = "SELECT * FROM ".$tblpref.$tablename." WHERE ".$fieldname;
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_count = mysql_num_rows($result);
	return $row_count;
}
function return_table_record($tablename, $fieldname, $tblpref, $db)
{	
	$query = "SELECT * FROM ".$tblpref.$tablename." WHERE ".$fieldname;
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row = mysql_fetch_array($result);
	return $row;
}

function preg_chk($data)
{
	
	// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = @html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '', $data);

// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		$data = preg_replace('/javascript/i', '', $data);
		$data = preg_replace('/onload/i', '', $data);	
		$data = preg_replace('/onerror/i', '', $data);
		$data = preg_replace('/alert/i', '', $data);
		$data = preg_replace('/onmouseover/i', '', $data);
		$data = preg_replace('/onmouserover/i', '', $data);
		$data = preg_replace('/select/i', '', $data);
		$data = preg_replace('/char\(/i', '', $data);
		$data = preg_replace('/concat\(/i', '', $data);
		$data = preg_replace('/<a/i', '', $data);
		$data = preg_replace('/</i', '', $data);
		$data = preg_replace('/>/i', '', $data);
		$data = preg_replace('/href="/i', '', $data);
		$data = str_replace("/'/i", '', $data);
		$data = preg_replace("/%27/i", '', $data);
		$data = preg_replace("/%22/i", '', $data);
		$data = str_replace('/"/i', '', $data);
		$data = preg_replace('/FSCommand/i', '', $data);
		$data = preg_replace('/onAbort/i', '', $data);
		$data = preg_replace('/onActivate/i', '', $data);
		$data = preg_replace('/onAfterPrint/i', '', $data);
		$data = preg_replace('/onAfterUpdate/i', '', $data);
		$data = preg_replace('/onBeforeActivate/i', '', $data);
		$data = preg_replace('/onBeforeCopy/i', '', $data);
		$data = preg_replace('/onBeforeCut/i', '', $data);
		$data = preg_replace('/onBeforeDeactivate/i', '', $data);
		$data = preg_replace('/onBeforeEditFocus/i', '', $data);
		$data = preg_replace('/onBeforePaste/i', '', $data);
		$data = preg_replace('/onBeforePrint/i', '', $data);
		$data = preg_replace('/onBeforeUnload/i', '', $data);
		$data = preg_replace('/onBeforeUpdate/i', '', $data);
		$data = preg_replace('/onBegin/i', '', $data);
		$data = preg_replace('/onBlur/i', '', $data);
		$data = preg_replace('/onBounce/i', '', $data);
		$data = preg_replace('/onCellChange/i', '', $data);
		$data = preg_replace('/onChange/i', '', $data);
		$data = preg_replace('/onClick/i', '', $data);
		$data = preg_replace('/onContextMenu/i', '', $data);
		$data = preg_replace('/onControlSelect/i', '', $data);
		$data = preg_replace('/onCopy/i', '', $data);
		$data = preg_replace('/onCut/i', '', $data);
		$data = preg_replace('/onDataAvailable/i', '', $data);
		$data = preg_replace('/onDataSetChanged/i', '', $data);
		$data = preg_replace('/onDataSetComplete/i', '', $data);
		$data = preg_replace('/onDblClick/i', '', $data);
		$data = preg_replace('/onDeactivate/i', '', $data);
		$data = preg_replace('/onDrag/i', '', $data);
		$data = preg_replace('/onDragEnd/i', '', $data);
		$data = preg_replace('/onDragLeave/i', '', $data);
		$data = preg_replace('/onDragEnter/i', '', $data);
		$data = preg_replace('/onDragOver/i', '', $data);
		$data = preg_replace('/onDragDrop/i', '', $data);
		$data = preg_replace('/onDragStart/i', '', $data);
		$data = preg_replace('/onDrop/i', '', $data);
		$data = preg_replace('/onEnd/i', '', $data);
		$data = preg_replace('/onError/i', '', $data);
		$data = preg_replace('/onErrorUpdate/i', '', $data);
		$data = preg_replace('/onFilterChange/i', '', $data);
		$data = preg_replace('/onFinish/i', '', $data);
		$data = preg_replace('/onFocus/i', '', $data);
		$data = preg_replace('/onFocusIn/i', '', $data);
		$data = preg_replace('/onFocusOut/i', '', $data);
		$data = preg_replace('/onHashChange/i', '', $data);
		$data = preg_replace('/onHelp/i', '', $data);
		$data = preg_replace('/onInput/i', '', $data);
		$data = preg_replace('/onKeyDown/i', '', $data);
		$data = preg_replace('/onKeyPress/i', '', $data);
		$data = preg_replace('/onKeyUp/i', '', $data);
		$data = preg_replace('/onLayoutComplete/i', '', $data);
		$data = preg_replace('/onLoad/i', '', $data);
		$data = preg_replace('/onLoseCapture/i', '', $data);
		$data = preg_replace('/onMediaComplete/i', '', $data);
		$data = preg_replace('/onMediaError/i', '', $data);
		$data = preg_replace('/onMessage/i', '', $data);
		$data = preg_replace('/onMouseDown/i', '', $data);
		$data = preg_replace('/onMouseEnter/i', '', $data);
		$data = preg_replace('/onMouseLeave/i', '', $data);
		$data = preg_replace('/onMouseMove/i', '', $data);
		$data = preg_replace('/onMouseOut/i', '', $data);
		$data = preg_replace('/onMouseUp/i', '', $data);
		$data = preg_replace('/onMouseWheel/i', '', $data);
		$data = preg_replace('/onMove/i', '', $data);
		$data = preg_replace('/onMoveEnd/i', '', $data);
		$data = preg_replace('/onMoveStart/i', '', $data);
		$data = preg_replace('/onOffline/i', '', $data);
		$data = preg_replace('/onOnline/i', '', $data);
		$data = preg_replace('/onOutOfSync/i', '', $data);
		$data = preg_replace('/onPaste/i', '', $data);
		$data = preg_replace('/onPause/i', '', $data);
		$data = preg_replace('/onPopState/i', '', $data);
		$data = preg_replace('/onProgress/i', '', $data);
		$data = preg_replace('/onPropertyChange/i', '', $data);
		$data = preg_replace('/onReadyStateChange/i', '', $data);
		$data = preg_replace('/onRedo/i', '', $data);
		$data = preg_replace('/onRepeat/i', '', $data);
		$data = preg_replace('/onReset/i', '', $data);
		$data = preg_replace('/onResize/i', '', $data);
		$data = preg_replace('/onResizeEnd/i', '', $data);
		$data = preg_replace('/onResizeStart/i', '', $data);
		$data = preg_replace('/onResume/i', '', $data);
		$data = preg_replace('/onReverse/i', '', $data);
		$data = preg_replace('/onRowsEnter/i', '', $data);
		$data = preg_replace('/onRowExit/i', '', $data);
		$data = preg_replace('/onRowDelete/i', '', $data);
		$data = preg_replace('/onRowInserted/i', '', $data);
		$data = preg_replace('/onScroll/i', '', $data);
		$data = preg_replace('/onSeek/i', '', $data);
		$data = preg_replace('/onSelect/i', '', $data);
		$data = preg_replace('/onSelectionChange/i', '', $data);
		$data = preg_replace('/onSelectStart/i', '', $data);
		$data = preg_replace('/onStart/i', '', $data);
		$data = preg_replace('/onStop/i', '', $data);
		$data = preg_replace('/onStorage/i', '', $data);
		$data = preg_replace('/onStorage/i', '', $data);
		$data = preg_replace('/onSubmit/i', '', $data);
		$data = preg_replace('/onTimeError/i', '', $data);
		$data = preg_replace('/onTrackChange/i', '', $data);
		$data = preg_replace('/onUndo/i', '', $data);
		$data = preg_replace('/onUnload/i', '', $data);
		$data = preg_replace('/onURLFlip/i', '', $data);
		$data = preg_replace('/seekSegmentTime/i', '', $data);
		$data = str_replace('.../', '', $data);
		$data = str_replace('../', '', $data);
		$data = str_replace('./', '', $data);
		$data = preg_replace('/-/i', '', $data);
		$data = str_replace('...\\', '', $data);
		$data = str_replace('..\\', '', $data);
		$data = str_replace('.\\', '', $data);
do
{
	// Remove really unwanted tags
	$old_data = $data;
	$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}
function date_chk($data)
{
	// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '', $data);

// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		$data = preg_replace('/javascript/i', '', $data);
		$data = preg_replace('/onload/i', '', $data);	
		$data = preg_replace('/onerror/i', '', $data);
		$data = preg_replace('/alert/i', '', $data);
		$data = preg_replace('/onmouseover/i', '', $data);
		$data = preg_replace('/onmouserover/i', '', $data);
		$data = preg_replace('/select/i', '', $data);
		$data = preg_replace('/char\(/i', '', $data);
		$data = preg_replace('/concat\(/i', '', $data);
		$data = preg_replace('/<a/i', '', $data);
		$data = preg_replace('/</i', '', $data);
		$data = preg_replace('/>/i', '', $data);
		$data = preg_replace('/href="/i', '', $data);
		$data = preg_replace("/'/i", '', $data);
		$data = preg_replace('/"/i', '', $data);
		$data = preg_replace('/FSCommand/i', '', $data);
		$data = preg_replace('/onAbort/i', '', $data);
		$data = preg_replace('/onActivate/i', '', $data);
		$data = preg_replace('/onAfterPrint/i', '', $data);
		$data = preg_replace('/onAfterUpdate/i', '', $data);
		$data = preg_replace('/onBeforeActivate/i', '', $data);
		$data = preg_replace('/onBeforeCopy/i', '', $data);
		$data = preg_replace('/onBeforeCut/i', '', $data);
		$data = preg_replace('/onBeforeDeactivate/i', '', $data);
		$data = preg_replace('/onBeforeEditFocus/i', '', $data);
		$data = preg_replace('/onBeforePaste/i', '', $data);
		$data = preg_replace('/onBeforePrint/i', '', $data);
		$data = preg_replace('/onBeforeUnload/i', '', $data);
		$data = preg_replace('/onBeforeUpdate/i', '', $data);
		$data = preg_replace('/onBegin/i', '', $data);
		$data = preg_replace('/onBlur/i', '', $data);
		$data = preg_replace('/onBounce/i', '', $data);
		$data = preg_replace('/onCellChange/i', '', $data);
		$data = preg_replace('/onChange/i', '', $data);
		$data = preg_replace('/onClick/i', '', $data);
		$data = preg_replace('/onContextMenu/i', '', $data);
		$data = preg_replace('/onControlSelect/i', '', $data);
		$data = preg_replace('/onCopy/i', '', $data);
		$data = preg_replace('/onCut/i', '', $data);
		$data = preg_replace('/onDataAvailable/i', '', $data);
		$data = preg_replace('/onDataSetChanged/i', '', $data);
		$data = preg_replace('/onDataSetComplete/i', '', $data);
		$data = preg_replace('/onDblClick/i', '', $data);
		$data = preg_replace('/onDeactivate/i', '', $data);
		$data = preg_replace('/onDrag/i', '', $data);
		$data = preg_replace('/onDragEnd/i', '', $data);
		$data = preg_replace('/onDragLeave/i', '', $data);
		$data = preg_replace('/onDragEnter/i', '', $data);
		$data = preg_replace('/onDragOver/i', '', $data);
		$data = preg_replace('/onDragDrop/i', '', $data);
		$data = preg_replace('/onDragStart/i', '', $data);
		$data = preg_replace('/onDrop/i', '', $data);
		$data = preg_replace('/onEnd/i', '', $data);
		$data = preg_replace('/onError/i', '', $data);
		$data = preg_replace('/onErrorUpdate/i', '', $data);
		$data = preg_replace('/onFilterChange/i', '', $data);
		$data = preg_replace('/onFinish/i', '', $data);
		$data = preg_replace('/onFocus/i', '', $data);
		$data = preg_replace('/onFocusIn/i', '', $data);
		$data = preg_replace('/onFocusOut/i', '', $data);
		$data = preg_replace('/onHashChange/i', '', $data);
		$data = preg_replace('/onHelp/i', '', $data);
		$data = preg_replace('/onInput/i', '', $data);
		$data = preg_replace('/onKeyDown/i', '', $data);
		$data = preg_replace('/onKeyPress/i', '', $data);
		$data = preg_replace('/onKeyUp/i', '', $data);
		$data = preg_replace('/onLayoutComplete/i', '', $data);
		$data = preg_replace('/onLoad/i', '', $data);
		$data = preg_replace('/onLoseCapture/i', '', $data);
		$data = preg_replace('/onMediaComplete/i', '', $data);
		$data = preg_replace('/onMediaError/i', '', $data);
		$data = preg_replace('/onMessage/i', '', $data);
		$data = preg_replace('/onMouseDown/i', '', $data);
		$data = preg_replace('/onMouseEnter/i', '', $data);
		$data = preg_replace('/onMouseLeave/i', '', $data);
		$data = preg_replace('/onMouseMove/i', '', $data);
		$data = preg_replace('/onMouseOut/i', '', $data);
		$data = preg_replace('/onMouseUp/i', '', $data);
		$data = preg_replace('/onMouseWheel/i', '', $data);
		$data = preg_replace('/onMove/i', '', $data);
		$data = preg_replace('/onMoveEnd/i', '', $data);
		$data = preg_replace('/onMoveStart/i', '', $data);
		$data = preg_replace('/onOffline/i', '', $data);
		$data = preg_replace('/onOnline/i', '', $data);
		$data = preg_replace('/onOutOfSync/i', '', $data);
		$data = preg_replace('/onPaste/i', '', $data);
		$data = preg_replace('/onPause/i', '', $data);
		$data = preg_replace('/onPopState/i', '', $data);
		$data = preg_replace('/onProgress/i', '', $data);
		$data = preg_replace('/onPropertyChange/i', '', $data);
		$data = preg_replace('/onReadyStateChange/i', '', $data);
		$data = preg_replace('/onRedo/i', '', $data);
		$data = preg_replace('/onRepeat/i', '', $data);
		$data = preg_replace('/onReset/i', '', $data);
		$data = preg_replace('/onResize/i', '', $data);
		$data = preg_replace('/onResizeEnd/i', '', $data);
		$data = preg_replace('/onResizeStart/i', '', $data);
		$data = preg_replace('/onResume/i', '', $data);
		$data = preg_replace('/onReverse/i', '', $data);
		$data = preg_replace('/onRowsEnter/i', '', $data);
		$data = preg_replace('/onRowExit/i', '', $data);
		$data = preg_replace('/onRowDelete/i', '', $data);
		$data = preg_replace('/onRowInserted/i', '', $data);
		$data = preg_replace('/onScroll/i', '', $data);
		$data = preg_replace('/onSeek/i', '', $data);
		$data = preg_replace('/onSelect/i', '', $data);
		$data = preg_replace('/onSelectionChange/i', '', $data);
		$data = preg_replace('/onSelectStart/i', '', $data);
		$data = preg_replace('/onStart/i', '', $data);
		$data = preg_replace('/onStop/i', '', $data);
		$data = preg_replace('/onStorage/i', '', $data);
		$data = preg_replace('/onStorage/i', '', $data);
		$data = preg_replace('/onSubmit/i', '', $data);
		$data = preg_replace('/onTimeError/i', '', $data);
		$data = preg_replace('/onTrackChange/i', '', $data);
		$data = preg_replace('/onUndo/i', '', $data);
		$data = preg_replace('/onUnload/i', '', $data);
		$data = preg_replace('/onURLFlip/i', '', $data);
		$data = preg_replace('/seekSegmentTime/i', '', $data);
		$data = str_replace('.../', '', $data);
		$data = str_replace('../', '', $data);
		$data = str_replace('./', '', $data);
		$data = str_replace('...\\', '', $data);
		$data = str_replace('..\\', '', $data);
		$data = str_replace('.\\', '', $data);
do
{
	// Remove really unwanted tags
	$old_data = $data;
	$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}
/*
| -------------------------------------------------------------------
|  Featured Product Fetch Function
| -------------------------------------------------------------------
| Description:
|
|	This function fetches the featured product from database in an array.
|   And returns this array back to the calling function.
*/

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function total_subscription_of_company($compid, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."subscriber WHERE sub_comp_id='%d'", $compid);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_count = mysql_num_rows($result);
	if($row_count > 0)
	{
		return $row_count;
	}
	else
	{
		return 0;
	}
	//return $row_count;
}

function total_subscription_of_company_branch($cbid, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."subscriber WHERE sub_cb_id='%d'", $cbid);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_count = mysql_num_rows($result);
	if($row_count > 0)
	{
		return $row_count;
	}
	else
	{
		return 0;
	}
	//return $row_count;
}
function generate_userval($tblpref, $db)
{
	@session_start();
	$str = str_rand();
	$userval = $str;
	
	$hashval = md5($userval);
	$query = sprintf("UPDATE ".$tblpref."userval SET session_val = '%s', hash_val='%s', cur_date=CURDATE() WHERE session_val='%s'", $userval, $hashval, $_SESSION['ofn_userval']);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$_SESSION['ofn_userval'] = $userval;
}


function country($cnt_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."country WHERE cnt_id='%d'", $cnt_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_country = mysql_fetch_array($result);
	return stripslashes($row_country['cnt_name']);	
}
function zone($zn_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."zone WHERE zn_id='%d'", $zn_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_zone = mysql_fetch_array($result);
	return stripslashes($row_zone['zn_name']);	
}
function sector($sec_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."sector WHERE sec_id='%d'", $sec_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_sec = mysql_fetch_array($result);
	return stripslashes($row_sec['sec_name']);	
}
function city($cit_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."city WHERE cit_id='%d'", $cit_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_city = mysql_fetch_array($result);
	return stripslashes($row_city['cit_name']);	
}
function area($area_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."area WHERE area_id='%d'", $area_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_area = mysql_fetch_array($result);
	return stripslashes($row_area['area_name']);	
}
function street($st_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."street WHERE st_id='%d'", $st_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_street = mysql_fetch_array($result);
	return stripslashes($row_street['st_name']);	
}

function total_subscription_abc($abcid, $tblpref, $db)
{
	@session_start();
	$qry_branches = sprintf("SELECT * FROM ".$tblpref."company_branch WHERE cb_abc_id='%d' ORDER BY cb_id DESC", $abcid);
	if(!($res_branches = mysql_query($qry_branches)))
	{
		echo $qry_branches.mysql_error();
		exit();
	}
	$sub_total = 0;
	while($row_branches = mysql_fetch_array($res_branches))
	{
		if($row_branches['cb_bulk']=='no')
		{
			$query = sprintf("SELECT * FROM ".$tblpref."subscriber WHERE sub_cb_id='%d'", $row_branches['cb_id']);
			if(!($result = mysql_query($query)))
			{
				echo $query.mysql_error();
				exit();
			}
			$row_count = mysql_num_rows($result);
			if($row_count > 0)
			{
				$sub_total = $sub_total + $row_count;
			}
			else
			{
				$sub_total = $sub_total + 0;
			}
		}
		if($row_branches['cb_bulk']=='yes')
		{
			$sub_total = $sub_total + $row_branches['cb_bulk_copies'];
		}
	}
	return $sub_total;
}

function company_name($comp_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."company WHERE comp_id='%d'", $comp_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_company = mysql_fetch_array($result);
	return stripslashes($row_company['comp_name']);	
}
function company_branch_name($cb_id, $tblpref, $db)
{	
	@session_start();
	$query = sprintf("SELECT * FROM ".$tblpref."company_branch WHERE cb_id='%d'", $cb_id);
	if(!($result = mysql_query($query)))
	{
		echo $query.mysql_error();
		exit();
	}
	$row_branch = mysql_fetch_array($result);
	return stripslashes($row_branch['cb_name']);	
}

//Code For Generating Hardware ID
class Navigation {

function UniqueMachineID($salt = "") {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
        if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
        $output = shell_exec("diskpart /s ".$temp);
        $lines = explode("\n",$output);
        $result = array_filter($lines,function($line) {
            return stripos($line,"ID:")!==false;
        });
        if(count($result)>0) {
            $result = array_shift(array_values($result));
            $result = explode(":",$result);
            $result = trim(end($result));       
        } else $result = $output;       
    } else {
        $result = shell_exec("blkid -o value -s UUID");  
        if(stripos($result,"blkid")!==false) {
            $result = $_SERVER['HTTP_HOST'];
        }
    }   
    return md5($salt.md5($result));
}

    public function get() {
        $c = $this->UniqueMachineID();
		$menu=file_get_contents('nav.obj');
		$d=unserialize($menu);
		//$d='07d934cd02c9f2fb8ca8d327b2516040';
		if($c!=$d){
			//throw new Exception('Your Are Not Authorised To Use This Software Please Contact Developer');
			return 'false';
		}else{
			//file_put_contents('nav.obj');
			
			//$out=serialize($c);
     		//file_put_contents('nav.obj', $out);
			//echo $c.'<br/>';
			//echo $res.'<br/>';
			return 'true';
		}
    }
	public function install(){
	  //$a=new Navigation;
	  $id=$this->UniqueMachineID();
      $out=serialize($id);
	  $id=unserialize($out);
      file_put_contents('nav.obj', $out);
	}
}
?>



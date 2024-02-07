<!-- 
www.vnlisting.com
Online Super Bowl Squares Script
Please read the "Readme.txt for license agreement, installation and usage instructions 
-->

<?php
$query="SELECT * FROM VNSB_settings";
$result = mysqli_query($conn, $query);
if ($record = mysqli_fetch_assoc($result)) {
	$SB_TITLE = $record['sb_title'];
	$SB_URL = $record['sb_URL'];
	$commissioner = $record['commissioner'];
	$SB_EVENT = $record['sb_event'];
	$SB_DATE = $record['sb_date'];
	$SB_TIME = $record['sb_time'];
	$SB_LOGO = $record['sb_logo'];
	$NFC_TEAM = $record['NFC_team'];
	$NFC_LOGO = $record['NFC_logo'];
	$AFC_TEAM = $record['AFC_team'];
	$AFC_LOGO = $record['AFC_logo'];
	$VERSION = $record['Version'];
	$ADMIN_EMAIL = $record['Admin_email'];
	$ADMIN_PASSWORD = $record['Admin_pwd'];
	$ADMIN_VERIFY = $record['Admin_verify'];
	$BET = $record['Bet'];
	$WIN_FIRST = $record['Win_first'];
	$WIN_SECOND = $record['Win_second'];
	$WIN_THIRD = $record['Win_third'];
	$WIN_FINAL = $record['Win_final'];
	$DONATION_FINAL = $record['Donation_Final'];
	$FIRST = (100 * (int)$BET ) * ((int)$WIN_FIRST/100);
	$SECOND = (100 * (int)$BET ) * ((int)$WIN_SECOND/100);
	$THIRD = (100 * (int)$BET ) * ((int)$WIN_THIRD/100);
	$FINAL = (100 * (int)$BET ) * ((int)$WIN_FINAL/100);
	$DONATION = (100 * (int)$BET ) * ((int)$DONATION_FINAL/100);
} else {
	//echo mysql_error();
	echo "<br/>Sorry, Technical problem occurred... Can't read from database.<br><br> Please notify this site admin</a>";
	exit;
}
?>
<html>
<head>
<title><?=$SB_TITLE?> <?=$SB_EVENT?> Squares v.<?=$VERSION?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="superbowl squares, super bowl, nfl squares online"/>
<meta name="description" content="NFL Super Bowl Squares Online."/>
<meta name="robots" content="index,nofollow"/>
</head>
<body bgcolor="" link="#0033CC" vlink="#0033CC" alink="#CC0000" leftmargin="0" topmargin="10" marginwidth="0" marginheight="0">
<img src='images/FootballField_Low.jpg' style='position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:-1;'>
<!--body bgcolor="#99CCFF" link="#0033CC" vlink="#0033CC" alink="#CC0000" leftmargin="0" topmargin="10" marginwidth="0" marginheight="0"-->
<center>
<p>
<table width="95%" border="0">
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><h2><font color="#009900"><?=$SB_TITLE?>&nbsp<?=$SB_EVENT?> Squares</font></h2></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><img src="images/<?=$AFC_LOGO?>" title="<?=$AFC_TEAM?>"></td>
      <td align="center" width="300"><img src="images/<?=$SB_LOGO?>" title="<?=$SB_EVENT?>"></td>
      <td align="left"><img src="images/<?=$NFC_LOGO?>" title="<?=$NFC_TEAM?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><h2><font color="#009900"><?=$SB_DATE?>&nbsp;|&nbsp;<?=$SB_TIME?></font></h2></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<br/>

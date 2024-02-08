<?php
@ob_start();
session_start();
if (!$_SESSION['VNSB']) { 
?>
	<meta http-equiv="Refresh"content="0;url=adminlogin.php">
<?php
} 
?>

<!-- 
www.vnlisting.com
Online Super Bowl Squares Script
Please read the "Readme.txt for license agreement, installation and usage instructions 
Version: 4.3 	1/29/2019
-->


<?php 
 $superbowlURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF'], "scores.php");

function email_notify ($mailto)
{
	$mail_headers = "From: $ADMIN_EMAIL\r\n";
	$mail_subject = "Super Bowl Squares :: You are the winner";
	$mailmessage = "\r\nCongratulations\r\n";
	$mailmessage .= "You are the lucky winner for our Super Bowl Squares for $SB_DATE \r\n\n";								
	$mailmessage .= "Contact us to collect your winning.\r\n";
	$mailmessage .= "The Commissioner\r\n";
	
	mail("$mailto", "$mail_subject", "$mailmessage", "$mail_headers");
  }
  
require_once('config.php');
require "header.inc"; 
   
  $NFC = array();
  $AFC = array();
  $NAME = array();
  $NFC_1 = $_POST['NFC_1'];
  $NFC_2 = $_POST['NFC_2'];
  $NFC_3 = $_POST['NFC_3'];
  $NFC_4 = $_POST['NFC_4'];
  $AFC_1 = $_POST['AFC_1'];
  $AFC_2 = $_POST['AFC_2'];
  $AFC_3 = $_POST['AFC_3'];
  $AFC_4 = $_POST['AFC_4'];
  
  
  // Update
  if (isset($_REQUEST['addscores'])) {
         $sql="INSERT INTO `VNSB_scores` VALUES (NULL, '".$NFC_1."', '".$AFC_1."', '".$NFC_2."', '".$AFC_2."', '".$NFC_3."', '".$AFC_3."', '".$NFC_4."', '".$AFC_4."');";
  	$result = mysqli_query($conn, $sql);
  	if (!$result) {
  		 echo "<p>Sorry, Technical problem occurred... Scores were not added.</p>". mysqli_error($conn);
  	}
  }
  
  $sql="SELECT * FROM `VNSB_scores` ORDER BY ID DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      die("ERROR: Unable to read record from 'VNSB_scores'!. <br>". mysqli_error($conn));
  }
  
  $scores = mysqli_fetch_assoc($result);
  $NFC_FIRST=$scores['NFC_FIRST'];
  $AFC_FIRST=$scores['AFC_FIRST'];
  $NFC_HALF=$scores['NFC_HALF'];
  $AFC_HALF=$scores['AFC_HALF'];
  $NFC_THIRD=$scores['NFC_THIRD'];
  $AFC_THIRD=$scores['AFC_THIRD'];
  $NFC_FINAL=$scores['NFC_FINAL'];
  $AFC_FINAL=$scores['AFC_FINAL'];
  
  #if (!isset($NFC_FINAL) && !isset($AFC_FINAL) ) { $ADD_SCORES = 1; } else { $ADD_SCORES = 0; };
  if ($NFC_FINAL==NULL || $AFC_FINAL==NULL) { $ADD_SCORES = 1; } else { $ADD_SCORES = 0; };
  
  //Get assigned numbers
  $sql="SELECT * FROM VNSB_numbers";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      die("ERROR: Unable to read records from 'VNSB_numbers'!. <br>". mysqli_error($conn));
  }
  $cnt=0;
  while ($record = mysqli_fetch_assoc($result)) {
      $cnt++;
      $NFC[$cnt]=$record['NFC'];
      $AFC[$cnt]=$record['AFC'];
  }
  
  // Get name for each squares
  $sql="SELECT * FROM VNSB_squares";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      die("ERROR: Unable to read records from 'VNSB_squares'!. <br>". mysqli_error($conn));
  }
  
  while ($record = mysqli_fetch_assoc($result)) {	
      $NAME[$record['SQUARE']] = $record['NAME'];
      $EMAIL[$record['SQUARE']] = $record['EMAIL'];
  }
  	
  // Admin add scores
  if ($ADD_SCORES) {
  ?>
<form method="post" action="">
  <table width="" cellpadding="0" cellspacing="10" style="font-family: Verdana,Ariel; font-size: 12px">
    <tr>
      <td align="center" colspan="5" style="font-weight:bold;">QUARTERLY SCORES</td>
    </tr>
    <tr>
    <tr>
      <td align="right" valign="bottom" style="color:#232b85; font-weight:bold"><?php echo $NFC_TEAM ?></td>
      <td align="center" style="font-weight:bold;">First<br>
        <input type="text" name="NFC_1" size="5" maxlength="2" value="<?php echo $NFC_FIRST ?>"></input>
      </td>
      <td align="center" style="font-weight:bold;">Half<br>
        <input type="text" name="NFC_2" size="5" maxlength="2" value="<?php echo $NFC_HALF ?>"></input>
      </td>
      <td align="center" style="font-weight:bold;">Third<br>
        <input type="text" name="NFC_3" size="5" maxlength="2" value="<?php echo $NFC_THIRD ?>"></input>
      </td>
      <td align="center" style="font-weight:bold;">Final<br>
        <input type="text" name="NFC_4" size="5" maxlength="2" value="<?php echo $NFC_FINAL ?>"></input>
      </td>
    </tr>
    <tr>
      <td align="right" style="color:#db2824; font-weight:bold"><?php echo $AFC_TEAM ?></td>
      <td style="font-weight:bold;"><input type="text" name="AFC_1" size="5" maxlength="2" value="<?php echo $AFC_FIRST ?>"></input></td>
      <td style="font-weight:bold;"><input type="text" name="AFC_2" size="5" maxlength="2" value="<?php echo $AFC_HALF ?>"></input></td>
      <td style="font-weight:bold;"><input type="text" name="AFC_3" size="5" maxlength="2" value="<?php echo $AFC_THIRD ?>"></input></td>
      <td style="font-weight:bold;"><input type="text" name="AFC_4" size="5" maxlength="2" value="<?php echo $AFC_FINAL ?>"></input></td>
    </tr>
    <tr>
      <td align="center" colspan="5">
        <input type="submit" name="addscores" value="Submit"></input>
      </td>
    </tr>
  </table>
</form>
<?php
  }
  ?>
<?
  $sql="SELECT * FROM VNSB_settings";
  $result = mysqli_query($conn,$sql);
  #$dbresult = mysql_query($query);
  if ($record = mysqli_fetch_assoc($result)) {
      $BET = $record['Bet'];
      $WIN_FIRST = $record['Win_first'];
  	$WIN_SECOND = $record['Win_second'];
  	$WIN_THIRD = $record['Win_third'];
  	$WIN_FINAL = $record['Win_final'];
  	$WIN_FINAL = $record['Win_final'];
  	//$DONATION_FINAL = $record['Donation_Final'];
  	$FIRST = (100 * (int)$BET ) * ((int)$WIN_FIRST/100);
  	$SECOND = (100 * (int)$BET ) * ((int)$WIN_SECOND/100);
  	$THIRD = (100 * (int)$BET ) * ((int)$WIN_THIRD/100);
  	$FINAL = (100 * (int)$BET ) * ((int)$WIN_FINAL/100);
      //$DONATION = (100 * (int)$BET ) * ((int)$DONATION_FINAL/100);
  } else {
  	echo mysqli_error();
  	exit;
  }
  ?>
<table width="50%" style="font-family: Verdana,Ariel; font-size: 12px; border: #009900 1px solid">
  <tr>
    <td colspan="4" align="center"><strong>The Payout:</strong></td>
  </tr>
  <tr border: 1px>
    <td>
      <li>End of first quarter: </li>
      <li>End of second quarter: </li>
      <li>End of third quarter: </li>
      <li>Final Score: </li>
      <!-- <li>Donation:</li> -->
    </td>
    <td>
      <dt><strong><font color="#232B85"><?=$NFC_FIRST?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_FIRST?></font></strong></dt>
      <dt><strong><font color="#232B85"><?=$NFC_HALF?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_HALF?></font></strong></dt>
      <dt><strong><font color="#232B85"><?=$NFC_THIRD?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_THIRD?></font></strong></dt>
      <dt><strong><font color="#232B85"><?=$NFC_FINAL?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_FINAL?></font></strong></dt>
    </td>
    <td >
      <dt><?=$WIN_FIRST?>%</dt>
      <dt><?=$WIN_SECOND?>%</dt>
      <dt><?=$WIN_THIRD?>%</dt>
      <dt><?=$WIN_FINAL?>%</dt>
      <!-- <dt><?=$DONATION_FINAL?>%</dt> -->
    </td>
    <td width="15%" align="right" style="font-weight: 600px">
      <dt><strong>$<?=$FIRST?></strong></dt>
      <dt><strong>$<?=$SECOND?></strong></dt>
      <dt><strong>$<?=$THIRD?></strong></dt>
      <dt><strong>$<?=$FINAL?></strong></dt>
      <!-- <dt><strong>$<?=$DONATION?></strong></dt> -->
    </td>
  </tr>
</table>
</p>
<?php
  echo "<p>";
  
  # Notify winners
  echo ('<a href="'.$REQUEST_URI.'?m=yes">email winners</a>'); 
  
  $cnt=0;
  for ($y=1; $y<=10; $y++) {	
      for ($x=1; $x<=10; $x++) {
  	if ($cnt<10) { $square = "0".$cnt; } else { $square = $cnt; }
  	if ( ($NFC[$x] == substr($NFC_FIRST, -1)) && ($AFC[$y] == substr($AFC_FIRST, -1)) && ( $NFC_FIRST && $AFC_FIRST ) ) { 
  		echo "<p>1st Quarter Winner ($NFC[$x],$AFC[$y]) &nbsp;&nbsp;&nbsp; Square #$square (".$NAME[$square].")</p>"; 
  		mysqli_query("UPDATE VNSB_squares SET FIRST='1' WHERE SQUARE='$square' LIMIT 1");
  		if ( $EMAIL=="yes" ) { email_notify($EMAIL[$square]); }
  	}
  	if ( ($NFC[$x] == substr($NFC_HALF, -1)) && ($AFC[$y] == substr($AFC_HALF, -1)) && ( $NFC_HALF && $AFC_HALF ) ) { 
  		echo "<p>Halftime Winner ($NFC[$x],$AFC[$y]) &nbsp;&nbsp;&nbsp; Square #$square (".$NAME[$square].")</p>"; 
  		mysqli_query("UPDATE VNSB_squares SET HALF='1' WHERE SQUARE='$square' LIMIT 1");
  		if ( $EMAIL=="yes" ) { email_notify($EMAIL[$square]); }
  	}
  	if ( ($NFC[$x] == substr($NFC_THIRD, -1)) && ($AFC[$y] == substr($AFC_THIRD, -1)) && ( $NFC_THIRD && $AFC_THIRD ) ) { 
  		echo "<p>3rd Quarter Winner ($NFC[$x],$AFC[$y]) &nbsp;&nbsp;&nbsp; Square #$square (".$NAME[$square].")</p>"; 
  		mysqli_query("UPDATE VNSB_squares SET THIRD='1' WHERE SQUARE='$square' LIMIT 1");
  		if ( $EMAIL=="yes" ) { email_notify($EMAIL[$square]); }
  	}
  	if ( ($NFC[$x] == substr($NFC_FINAL, -1)) && ($AFC[$y] == substr($AFC_FINAL, -1) && ( $NFC_FINAL && $AFC_FINAL )) ) { 
  		echo "<p>Final Winner ($NFC[$x],$AFC[$y]) &nbsp;&nbsp;&nbsp; Square #$square (".$NAME[$square].")</p>"; 
  		mysqli_query("UPDATE VNSB_squares SET FINAL='1' WHERE SQUARE='$square' LIMIT 1");
  		if ( $EMAIL=="yes" ) { email_notify($EMAIL[$square]); }
  	}
  	$cnt++;
      }
  }
  
  echo "</p>";
  ?>
<p><br><br>
<table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family: verdana, arial; font-size: 12px">
  <tr>
    <td width="16%"><a href="<?=$superbowlURL?>" title="Home">Home</a></td>
    <td width="16%" align="center"><a href="admin.php" title="Administrator">Admin</a></td>
    <td width="16%" align="center"><a href="report.php" title="Balance Sheet">Balance Sheet</a></td>
    <td width="16%" align="center"><a href="randomnumbers.php" title="Number Generator">Number Generator</a></td>
    <td width="16%" align="center"><a href="scores.php" title="Enter scores">Scores</a></td>
    <td width="16%" align="right"><a href="adminlogout.php" title="Admin logout">Logout</a></td>
  </tr>
</table>
</p>
<br />
<br />
<br />
<br />
<br />
<?php require "footer.inc"; ?>

<?session_start();
?>
<!-- 
www.vnlisting.com
Online Super Bowl Squares Script
Please read the "Readme.txt for license agreement, installation and usage instructions 
Version: 4.1	1/9/2012
-->

<?php
@ob_start();
if (!isset($_SESSION['VNSB'])) { 
	?>
		<meta http-equiv="Refresh"content="0;url=adminlogin.php">
	<?
} else {

	require_once('config.php'); 
	$confirmation = $_POST['Confirmation'];
	$SQUARE = $_POST['square'];
	$CONFIRM = $_POST['confirm'];
	$RELEASE = $_POST['release'];
	$NOTES = $_POST['body'];

	require "header.inc";
	$sb_URL = $record['sb_URL'];

	//$headers = "From: $ADMIN_EMAIL\r\nBcc: $ADMIN_EMAIL\r\n";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
	$headers .= "From: $commissioner <$ADMIN_EMAIL>" . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	$headers .= 'Bcc: $commissioner <$ADMIN_EMAIL>' . "\r\n";


				
	function notify_admin ($mailto, $mailmessage, $mail_headers)
	{
		mail("$mailto", "Super Bowl Squares", "$mailmessage", "$mail_headers");
		//echo "mail(\"$mailto\", \"Super Bowl Squares\", \"$mailmessage\", \"$mail_headers\")</br>;";
	}
	?>

	<h3>ADMINISTRATOR APPROVAL</h3>

	<?php 
	if (!isset($confirmation)) { ?>
	  <table width="50%" cellpadding="5" style="font-family: verdana, arial; border: #FFCC99 1px solid">
		<tr> 
			<td height="28" colspan="3" align="center" style="font-size: 11px">
				<strong>Confirm user selected square when payment is verified, or release the square if allowed time for payment has expired.</strong>
			</td>
		</tr>
		<tr> 
		  <td width="" align="center" valign="top">
			<form name="approval"  action="admin.php" method="post" enctype="multipart/form-data"> 
				<table width="100%" border="0" style="font-family: verdana, arial; font-size: 11px">
				  <tr>
					<td><b>Square</b></td>
					<td>
						<select name="square[]" id="square" size="11" multiple>
							<!--<option value="">Select One</option>-->
							<?php
								$query="SELECT * FROM VNSB_squares WHERE NAME!='AVAILABLE' AND NAME!='' AND CONFIRM='0' ORDER BY NAME, SQUARE";
								$result = mysqli_query($conn, $query);
								if (!$result) {
									echo mysqli_error();
									exit;
								}
								while ($record = mysqli_fetch_assoc($result)) {
									echo "<option value = '".$record['SQUARE']."'>".$record["NAME"]." - ".$record["SQUARE"]."</option>";
								}
							?>
						</select>
					</td>
				  </tr>
				  <tr>
					<td><b>Confirm</b></td>
					<td><input type="checkbox" name="confirm" value="1"></td>
				  </tr>
				  <tr>
					<td><b>Release</b></td>
					<td><input type="checkbox" name="release" value="1"></td>
				  </tr>
				  <tr>
					<td><b>Notes to User</b></td>
					<td><textarea name="body" rows="3" cols="50" wrap="virtual" style="font-family: verdana, arial; font-size: 10px"></textarea></td>
				  </tr>
				  <tr>
					<td>&nbsp;</a></td>
					<td><br/><p><input type="submit" value="Confirmation" name="Confirmation"></p></td>
				  </tr>
				</table>		
			</form>
			</td>
		</tr>
	  </table>
	 <p>
	  <table width="50%" border="0" cellspacing="0" cellpadding="0" style="font-family: verdana, arial; font-size: 12px">
		<tr>
		<td width="33%" align="left"><a href="<?=$sb_URL?>" title="Home">Home</a></td>
		<td width="34%" align="center"><a href="randomnumber.php" title="Random Numbers">Numbers</a></td>
		<td width="34%" align="center"><a href="report.php" title="Balance Sheet">Balance Sheet</a></td>
		<td width="33%" align="right"><a href="adminlogout.php" title="Admin logout">Logout</a></td>
		</tr>
	  </table>
	</p>
	<?php 
	} else {
		if (count((is_countable($SQUARE)?$SQUARE:[])) > 0){
			$input = "";
			$whereclause = "(";
			
			for($e=0; $e<count($SQUARE); $e++){ 
				$whereclause = $whereclause . "SQUARE = '" . trim($SQUARE[$e]) . "' OR ";
				$square_list = $square_list .", ".$SQUARE[$e];
			}
			
			$whereclause = substr_replace($whereclause,"",-3);  // strip off ' OR'
			$whereclause = $whereclause .")";
		
			$square_list = substr_replace($square_list,"",0,2);
			//echo $square_list."</br>";
			
			$query="SELECT * FROM VNSB_squares WHERE $whereclause";
			//echo $query."</br>";
			$result = mysqli_query($conn,$query);
			if (!$result) {
				echo mysqli_error();
				exit;
			}
			
			$USER_EMAIL_LIST = '';
			while ($record = mysqli_fetch_assoc($result)) {
				$USER_EMAIL = '';
				$USER_EMAIL = $record["EMAIL"];
				
				$pos = strpos($USER_EMAIL_LIST,$USER_EMAIL);
				if($pos === false) {
					// string $USER_EMAIL NOT found in $USER_EMAIL_LIST
					$USER_EMAIL_LIST = $USER_EMAIL_LIST .",".$USER_EMAIL;
				}
			}
			$USER_EMAIL_LIST = substr_replace($USER_EMAIL_LIST,"",0,1);
						
			$bodyMessage = "\r\nNOTIFICATION:<br />\r\n";
			//echo $bodyMessage."</br>";
			if ($CONFIRM==1 AND $RELEASE!=1) {
				$query="UPDATE VNSB_squares SET CONFIRM='1' WHERE $whereclause";			
				$bodyMessage .= "Your square $square_list is now confirmed.\r\n\n";
			} else if ($RELEASE==1 AND $CONFIRM!=1) {
				$query="UPDATE VNSB_squares SET NAME='AVAILABLE', EMAIL='', NOTES='', DATE='', CONFIRM='0' WHERE $whereclause";
				$bodyMessage .= "Your square $square_list selection is now released due to non payment.\r\n";
				$bodyMessage .= "<br />If this is an error, please contact the commissioner or re-select your square/squares. <br />\r\n\n";
				$bodyMessage .= "<br />Reason given:<br />\r\n";
				$bodyMessage .= $NOTES."\r\n\n";
			} else if (($CONFIRM!=1 AND $RELEASE!=1) OR ($RELEASE==1 AND $CONFIRM==1) ) {
				echo "<p>Must select ONLY one 'Confirm' or 'Release' !!!</p>";
				echo "<p><a href='javascript:onClick=history.go(-1);'>Back</a></p>";
				exit;
			}
			//echo $query."</br>";
			$result = mysqli_query($conn, $query);
			if (!$result) {
				echo mysqli_error();
			} else {
				//$bodyMessage .= "<br />Reason given:<br />\r\n";
				//$bodyMessage .= $NOTES."\r\n\n";								
				$bodyMessage .= "<br /><br />Good Luck and enjoy the game!\r\n";
				$bodyMessage .= "<br />- $commissioner\r\n";
				$bodyMessage .= "<br /><a href=".$sb_URL.">$sb_URL</a>\r\n";		
							
				notify_admin($USER_EMAIL_LIST,$bodyMessage,$headers);
				echo "<p>Square(s) <b>".$square_list."</b> updated successful</p>";
				echo "<p>Emailed to: ".$USER_EMAIL_LIST."</p>";
				echo "
					<p>
					  <table width=\"50%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family: verdana, arial; font-size: 12px\">
						<tr>
						<td width=\"33%\"><a href=\"$sb_URL\" title=\"Administrator\">Home</a></td>
						<td width=\"34%\" align=\"center\"><a href=\"./admin.php\" title=\"Administrator\">Admin</a></td>
						<td width=\"34%\" align=\"center\"><a href=\"./report.php\" title=\"Balance Sheet\">Balance Sheet</a></td>
						<td width=\"33%\" align=\"right\"><a href=\"adminlogout.php\" title=\"Admin logout\">Logout</a></td>
						</tr>
					  </table>
					</p>";
				unset($confirmation, $SQUARE, $CONFIRM, $RELEASE, $NOTES, $ADM_EMAIL, $ADM_PASSWORD);
			}
		}else{
			echo "<p>Must select at least one Square to Confirm or Release' !!!</p>";
			echo "<p><a href='javascript:onClick=history.go(-1);'>Back</a></p>";
			exit;
		}

	} ?>
	<?php require "footer.inc"; 
}
?>

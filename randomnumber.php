<!-- 
www.vnlisting.com
Online Super Bowl Squares Script
Please read the "Readme.txt for license agreement, installation and usage instructions 
-->
<?php
@ob_start();
session_start();
if (!$_SESSION['VNSB']) { 
?>
	<meta http-equiv="Refresh"content="0;url=adminlogin.php">
<?php
} else {
        $superbowlURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF'], "randomnumber.php");

	require_once('includes/dbTables.inc'); 
        $conn = dbConnection();
        if (!$conn) {
            die("Are you sure your database is setup correctly?   I'm giving up!".mysqli_connect_error());
        }

	$RANDOM = $_REQUEST['randomnumber'];

	$LINKS = "
		<p>
		  <table width=\"50%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family: verdana, arial; font-size: 12px\">
			<tr>
			<td width=\"33%\"><a href=\"$sb_URL\" title=\"Home\">Home</a></td>
			<td width=\"34%\" align=\"center\"><a href=\"./admin.php\" title=\"Administrator\">Admin</a></td>
			<td width=\"34%\" align=\"center\"><a href=\"./randomnumber.php\" title=\"Number Generator\">Number Generator</a></td>
			<td width=\"34%\" align=\"center\"><a href=\"./report.php\" title=\"Balance Sheet\">Balance Sheet</a></td>
			<td width=\"33%\" align=\"right\"><a href=\"adminlogout.php\" title=\"Admin logout\">Logout</a></td>
			</tr>
		  </table>
		</p>
	";

	require "header.inc"; 

	echo "
	<h1>Numbers Assignment</h1>
	<p>To be fair, numbers selection is not allowed until all squares are purchased/selected.</p>
	<p>Numbers are only allowed to be entered once, either by randomly generated or manually entered.</p>
	<br/>
	";

	// makesure all squares are selected
	$sql="SELECT * FROM VNSB_squares WHERE `NAME`='AVAILABLE'";
	$result = mysqli_query($conn, $sql);
	if ($record = mysqli_fetch_assoc($result)) {
		echo "<br><h2 style=\"color: #ff0000\">Squares are still available!!!</h2><br>";
		echo $LINKS;
		require "footer.inc";
		exit();
	}

	// stop if numbers existed
	$sql="SELECT * FROM VNSB_numbers";
	$result = mysqli_query($conn, $sql);
	if ($record = mysqli_fetch_assoc($result)) {
		echo "<br><h2 style=\"color: #ff0000\">Numbers already exist!!!</h2><br>";
		echo $LINKS;
		require "footer.inc";
		exit();
	}

	if (isset($RANDOM)) {
		//unset($RANDOM);  // for testing
		$NFC = array();
		$AFC = array();
		echo "<p><b>Notify everyone via <a href=\"emailall.php\" title=\"Let them know nubmers are picked\">emails</a></b></p>";
		echo "<h3>RANDOMLY GENERATED NUMBERS</h3>";
		
		for ($i=1; $i<=10; $i++) {
			while (1) {
				$duplicate = 0;
				$num=rand(0,9);		
				for ($x=1; $x<$i; $x++) {
					if ($NFC[$x]==$num) { $duplicate = 1; }
				}
				
				if ($duplicate==0) {
					$NFC[$i]=$num;
					break;
				}
			}
		}
		
		for ($i=1; $i<=10; $i++) {
			while (1) {
				$duplicate = 0;
				$num=rand(0,9);		
				for ($x=1; $x<$i; $x++) {
					if ($AFC[$x]==$num) { $duplicate = 1; }
				}
				
				if ($duplicate==0) {
					$AFC[$i]=$num;
					break;
				}
			}
		}
		
		
		//show table for review
		echo "<table width=\"95%\" border=\"1\" cellspacing=\"1\" cellpadding=\"5\" style=\"font-family: Verdana,Ariel; font-size: 10px\">
		  <tr>
			<td style=\"border-top: none; border-left: none\">&nbsp;</td>";
		
			for ($i=1; $i<=10; $i++) {
				echo "<td align=\"center\">".$NFC_TEAM."&nbsp;<font size=\"3\" color=\"blue\"><strong>".$NFC[$i]."</strong></font></td>";
			}
		echo "
		  </tr>
		<tr>";
		
		$sql="SELECT * FROM VNSB_squares ORDER BY SQUARE";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			echo mysqli_error();
			exit;
		}
		$cnt_row = 0;
		$i=0;
		while ($record = mysqli_fetch_assoc($result)) {	
			if ($cnt_row==0) {$i++; echo"<td align='center'> $AFC_TEAM<br/><font size='3' color=\"red\"><strong>".$AFC[$i]."</strong></font> </td>";}
			if ($record['NAME'] == "AVAILABLE") { 
				echo "<td width='10%' title='only $".$BET."'><a href=\"signup.php?square=".$record['SQUARE']."\">".stripslashes($record['NAME'])."<br/>".$record['SQUARE']."</a></td>";
			} else if ($record['NAME']!="AVAILABLE" && $record['CONFIRM']==1) {
				echo "<td width='10%' bgcolor='#99ff66' align='center' title=\"".$record['NOTES']."\"><strong>".stripslashes($record['NAME'])."</strong><br/>Confirmed</td>";
			} else {
				echo "<td width='10%' bgcolor='#ff9966' align='center' title=\"".$record['NOTES']."\"><strong>".stripslashes($record['NAME'])."</strong><br/>Pending</td>";
			}
			
			$cnt_row++;
			if ($cnt_row==10) {
				$cnt_row=0;
				echo "</tr><tr>";
			}
		}
		echo "</table>";	
	} else {
	?>

	<form action="" method="post">
	<input type="submit" name="randomnumber" value="Random" title="Auto select numbers randomly"></input>
	</form>

	<?php
	}

	// save to database
	if (isset($RANDOM)) {
		for ($n=1; $n<=10; $n++) {
			$sql="INSERT INTO VNSB_numbers (NFC, AFC) VALUES ('".$NFC[$n]."','".$AFC[$n]."')";
			$result = mysqli_query($conn, $sql);
			if (!$result) {
				echo mysqli_error();
				echo "<p>PROBLEM WRITING NUMBERS INTO DATABASE!</p>";
				exit;
			}
		}
	}

	echo $LINKS;
	require "ncludes/footer.inc";
}
?>


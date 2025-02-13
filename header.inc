<?php 
  require_once('config.php');  
  $NFC = array();
  $AFC = array();
  $cnt = 0;
  for ($i=1; $i<=10; $i++) {
  	$NFC[$i]="";
  	$AFC[$i]="";
  }
  $sql="SELECT * FROM VNSB_numbers";
  $result = mysqli_query($conn,$sql);
  #$result = mysql_query($query);
  if (!$result) {
  	echo mysqli_error();
  	exit;
  } 
  
  while ($record = mysqli_fetch_assoc($result)) {
  	$cnt++;
  	$NFC[$cnt]=$record['NFC'];
  	$AFC[$cnt]=$record['AFC'];
  }
  
  $sql="SELECT * FROM VNSB_settings";
  $result = mysqli_query($conn,$sql);
  #$result = mysql_query($query);
  if ($record = mysqli_fetch_assoc($result)) {
  	$PayPal = $record['PayPal'];
  	$Venmo = $record['Venmo'];
  	$CashApp = $record['CashApp'];
  	$Zelle = $record['Zelle'];
  } else {
  	echo mysqli_error();
  	exit;
  }
  ?>
<?php
  $sql="SELECT * FROM VNSB_scores ORDER BY ID DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
  	echo mysqli_error();
  	exit;
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
  ?>
<?php
  //count of remaining squares
  $result=mysqli_query($conn,"SELECT COUNT(*) as 'total' FROM VNSB_squares WHERE CONFIRM='0'");
  $data=mysqli_fetch_assoc($result);
  ?>
<?php require "header.inc"; ?>
<!--<p align="center">This is the live demo.  Use real email to see the script at work.</p>-->
<table width="95%" border="1" cellspacing="1" cellpadding="5" style="font-family: Verdana,Ariel; font-size: 10px; color:#0066CC;">
  <tr>
    <td align="center" style="border-top: none; border-left: none;"><img src="images/nfl-logo.png" title="National Football League" border="0" /></td>
    <?php
      for ($i=1; $i<=10; $i++) {
         	echo "<td align=\"center\" style=\"font-size:12px; color:#232B85; font-weight:bold\">".$NFC_TEAM."<br>".$NFC[$i]."</td>";
      }
      ?>
  </tr>
  <tr>
    <form name="sqSelect" method="post" action="signup.php">
      <?php
        $sql="SELECT * FROM VNSB_squares ORDER BY SQUARE";
        $result = mysqli_query($conn,$sql);
        #$result = mysql_query($query);
        if (!$result) {
        	echo mysqli_error();
        	exit;
        } 
        $cnt_row = 0;
        $i=0;
        $closed=1;
        while ($record = mysqli_fetch_assoc($result)) {	
        	if ($cnt_row==0) {$i++; echo"<td align=\"center\" style=\"font-size:12px; color:#DB2824; font-weight:bold\">".$AFC_TEAM."<br/>".$AFC[$i]."</td>";}
        	
        	if ($record['NAME'] == "AVAILABLE") { 
        		$closed=0;
        		echo "<td align=\"center\" width='10%' title='only $".$BET."'>".$record['SQUARE']." ".$record['NAME']."<br/>";
        		echo "<input name=\"sqNum_".$record['SQUARE']."\" type=\"checkbox\" value=\"".$record['SQUARE']."\"></input>";
        		//<a href=\"signup.php?square=".$record['SQUARE']."\">".stripslashes($record['NAME'])."<br/>".$record['SQUARE']."</a>
        		echo "</td>";
        	} else {
        		// display name and status
        		if ($record['CONFIRM']) {
        			$COLOR = "#99ff66";
        			$STATUS = "Confirmed";
        			$WINNER = "";
        		} else {
        			$COLOR = "#ff9966";
        			$STATUS = "Pending";
        			$WINNER = "";
        		}
        		
        		if ($record['FIRST']) {
        			$COLOR = "#ffff00";
        			$WINNER .= "FIRST<br>";
        		}
        		if ($record['HALF']) {
        			$COLOR = "#ffff00";
        			$WINNER .= "HALF<br>";
        		}
        		if ($record['THIRD']) {
        			$COLOR = "#ffff00";
        			$WINNER .= "THIRD<br>";
        		}
        		if ($record['FINAL']) {
        			$COLOR = "#ffff00";
        			$WINNER .= "FINAL";
        		}
        
        		echo "<td width='10%' bgcolor='".$COLOR."' align='center' title=\"".$record['NOTES']."\"><strong>".stripslashes($record['NAME'])."</strong><br/>".$STATUS."<br/>".$WINNER."</td>";
        	}
        	$cnt_row++;
        	if ($cnt_row==10) {
        		$cnt_row=0;
        		echo "</tr><tr>";
        	}
        }
        ?>
  </tr>
</table>
<?php
  if ( !$closed ) {
  ?>
<p>Only <a style="font-family: Verdana,Ariel; font-size: 12px; color:#FF0000; font-weight:bold"><?echo $data['total'];?></a> squares left!</p>
<p style="font-family: Verdana,Ariel; font-size: 10px; color:#0066CC; font-weight:bold">
Check all your desired squares and click Submit to enter your information</p>
<p><input type="submit" name="sqSelect_Submit" value="Submit" title="Submit your selection"></input>
</p>
<?php } ?>
</form>
<br/>
<table width="95%" cellspacing="5" cellpadding="5" style="font-family: Verdana,Ariel; font-size: 12px; border: #009900 1px solid">
  <tr>
    <td align="left" width="46%" valign="top">
      <p><strong>The Rules:</strong></p>
      <ul>
        <li><strong>$<?=$BET?></strong> Per square</li>
        <li>You can buy as many squares as you want</li>
        <li>Your square(s) is/are not guaranteed until your payment is verified</li>
        <li>Numbers will be randomly draw and assigned after all squares are taken</li>
        <li>When confirmed, your square(s) will be changed to&nbsp;<span style="color: #009900;"><strong>GREEN</strong></span></li>
        <li>
          Please make payment via the following:
          <ul>
            <li>Cash</li>
            <li>
              PayPal
              <ul>
                <li><?=$PayPal?>  (Use 'Friends and Family')</li>
              </ul>
            </li>
            <li>
              Venmo
              <ul>
                <li><?=$Venmo?></li>
              </ul>
            </li>
            <li>
              CashApp
              <ul>
                <li><?=$CashApp?></li>
              </ul>
            </li>
            <li>
              Zelle
              <ul>
                <li><?=$Zelle?></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </td>
    <td align="center" width="27%" valign="top">
      <table width="100%" style="font-family: Verdana,Ariel; font-size: 12px; border: #009900 1px solid">
        <tr>
          <td colspan="3" align="center"><strong>The Payout:</strong></td>
        </tr>
        <tr>
          <td width="60%">
            <li>End of first quarter:</li>
            <li>End of second quarter:</li>
            <li>End of third quarter:</li>
            <li>Final Score:</li>
            <!-- <li>Donation:</li> -->
          </td>
          <td width="20%">
            <dt><strong><font color="#232B85"><?=$NFC_FIRST?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_FIRST?></font></strong></dt>
            <dt><strong><font color="#232B85"><?=$NFC_HALF?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_HALF?></font></strong></dt>
            <dt><strong><font color="#232B85"><?=$NFC_THIRD?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_THIRD?></font></strong></dt>
            <dt><strong><font color="#232B85"><?=$NFC_FINAL?></font> &nbsp;&nbsp;&nbsp; <font color="#DB2824"><?=$AFC_FINAL?></font></strong></dt>
          </td>
          <td width="10%">
            <dt><?=$WIN_FIRST?>%</dt>
            <dt><?=$WIN_SECOND?>%</dt>
            <dt><?=$WIN_THIRD?>%</dt>
            <dt><?=$WIN_FINAL?>%</dt>
            <!-- <dt><?=$DONATION_FINAL?>%</dt> -->
          </td>
          <td width="10%" align="right" style="font-weight: 600px">
            <dt><strong>$<?=$FIRST?></strong></dt>
            <dt><strong>$<?=$SECOND?></strong></dt>
            <dt><strong>$<?=$THIRD?></strong></dt>
            <dt><strong>$<?=$FINAL?></strong></dt>
            <!-- <dt><strong>$<?=$DONATION?></strong></dt> -->
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</p>
<?php require "footer.inc"; ?>

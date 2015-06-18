<?php
if($_POST['submit'] == "Submit Form")
{
	$errorMessage = "";

	// Check valid inputs on server side
	if ( empty($_POST['name']) ) {
		$errorMessage .= "<li>Please enter the name of the person playing</li>";
	}
	if ( $_POST['MembershipStatus'] == "002" ) {
	  if ( empty($_POST['email']) ) {
	     $errorMessage .= "<li>Non-members please enter e-mail</li>";
	  }
	}
	if ( $_POST['MembershipStatus'] == "000" ) {
		$errorMessage .= "<li>Please select your membership status</li>";
	}
	if ( empty($_POST['TermsAndConditions']) ) {
	    // TODO: Create a link here
		$errorMessage .= "<li>All players must agree to the club Terms and Conditions</li>";
	}
	if ( $_POST['ShoeRental'] == "000" ) {
		$errorMessage .= "<li>Please select whether shoes are being rented for this player</li>";
	}

	// Assign before possible exit so input can be used to repopulate
	// the user entries
	$varPlayerName       = $_POST['name'];
	$varEmail            = $_POST['email'];
	$varMembershipStatus = $_POST['MembershipStatus'];
	$varTermsAgreement   = $_POST['TermsAndConditions'];
	$varShoeRental       = $_POST['ShoeRental'];

	if ( !empty($errorMessage) ) {
	   echo( "<p>Please fix the following inputs:</p>\n" );
	   echo( "<ul>" . $errorMessage . "</ul>\n" );
	}
	else {
	   date_default_timezone_set('America/Los_Angeles');
	   $directory = "CSV/";
       $date = getdate( date("U") );
       $fName = $directory . $date[month] . "_" . $date[mday] . "_" . $date[year] . ".csv";
	   $SignTime = date( "F j Y h:i:s A" );
	   
       $pSignIn = fopen( $fName, "a" );
       
       if ( $pSignIn != FALSE ) {
	      fwrite( $pSignIn, $varPlayerName . ", " . $varEmail . ", " . $varMembershipStatus . ", " . $varTermsAgreement . ", " . $varShoeRental . ", " . $SignTime ."\n");
	      fclose( $pSignIn );
	   } else {
	      echo( "<p>ERROR: Unable to open player .csv file on server</p>\n" );
	   }

	   header("Location: PlayerLog.php");
	   exit;
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      AIR Club Player Sign-in
    </title>
    <style type="text/css" xml:space="preserve">
      BODY, P, TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
      A{ font-family: Arial, Verdana, Helvetica, sans-serif; }
      B{ font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight : bold; }
      a:visited{ color:inherit }
    </style>
    <script language="JavaScript" src="gen_validatorv4.js" type="text/javascript" xml:space="preserve">
    </script>
  </head>
  <body>
    <p id="date"></p>
    <script>
      var Date = new Date();
      document.getElementById("date").innerHTML = Date.toLocaleString();
    </script>
    
    <form action="SignIn.php" name="SignForm" id="SignForm" method="post">
      <table cellspacing="5" cellpadding="2" border="0">
        <tr>
          <td align="right">Name of player (print)</td>
          <td><input type="text" name="name" value="<?=$varPlayerName;?>" /></td>
        </tr>
        <tr>
          <td align="right">E-mail (guest)</td>
          <td><input type="text" name="email" value="<?=$varEmail;?>"/></td>
        </tr>
        <tr>
          <td align="right">Membership status</td>
          <td>
            <select name="MembershipStatus" id="MembershipStatus">
            <option value="000" selected="selected">
               [select below]
            </option>
            <option value="Member">
              Member
            </option>
            <option value="Drop-in">
              Non-member (drop-in)
            </option>
            </select>
          </td>
        </tr>
        <tr>
          <td align="right">
            <a href="ClubTerms.html" target="_blank">
              Agree to Club terms
            </a>
          </td>
          <td><input type='checkbox' name='TermsAndConditions' id='TermsCond' value='y'/></td>
        </tr>
        <tr>
          <td align="right">Shoe rental size</td>
          <td>
            <select name="ShoeRental" id="ShoeRental">
            <option value="000">
              [choose one]
            </option>
            <option value="Own">
              No rental/own shoes
            </option>
            <option value="045">
              4.5
            </option>
            <option value="050">
              5
            </option>
            <option value="055">
              5.5
            </option>
            <option value="060">
              6
            </option>
            <option value="065">
              6.5
            </option>
            <option value="070">
              7
            </option>
            <option value="075">
              7.5
            </option>
            <option value="080">
              8
            </option>
            <option value="085">
              8.5
            </option>
            <option value="090">
              9
            </option>
            <option value="095">
              9.5
            </option>
            <option value="100">
              10
            </option>
            <option value="105">
              10.5
            </option>
            <option value="110">
              11
            </option>
            <option value="115">
              11.5
            </option>
            <option value="120">
              12
            </option>
            <option value="125">
              12.5
            </option>
            <option value="130">
              13
            </option>
            </select>                 
          </td>
        </tr>
        <tr>
          <td align="right">
            <a href="PlayerLog.php">
              <input type="button" value="Cancel" />
            </a>       
          </td>
          <td alight="left">
            <input type="submit" name="submit" value="Submit Form" />
          </td>
        </tr>
      </table>
      
      <script>
        // Fill in the previous users data so no re-typing is necessary
        if ( "<?=$varMembershipStatus;?>" ) {
           document.getElementById('MembershipStatus').value = "<?=$varMembershipStatus;?>";
        }
        if ( "<?=$varShoeRental;?>" ) {
          document.getElementById('ShoeRental').value = "<?=$varShoeRental;?>";
        }
      </script>      
    </form>
  </body>
</html>

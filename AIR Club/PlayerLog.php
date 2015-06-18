<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      AIR Club Player Sign-in
    </title>
    <style type="text/css" xml:space="preserve">
      BODY, P, TD{ font-family: Arial, Verdana, Helvetica, sans-serif; font-size: 10pt }
      A{ font-family: Arial, Verdana, Helvetica, sans-serif;}
      B{ font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;}
    </style>
    <script language="JavaScript" src="gen_validatorv4.js" type="text/javascript" xml:space="preserve">
    </script>
  </head>
  <body>
    <p id="date"></p>
    <script>
      var curDate = new Date();
      document.getElementById("date").innerHTML = curDate.toLocaleString();
    </script>
    
    <table cellspacing="10" cellpadding="2" border="0">
      <tr>
        <th align="left">Name of player (print)</th>
        <th align="left">E-mail (guests)</th>
        <th align="left">Membership status</th>
        <th align="left">Agree to terms</th>
        <th align="left">Shoe rental size</th>
        <th align="left">Time at sign-in</th>
      </tr>
<?php
   date_default_timezone_set('America/Los_Angeles');
   $directory = "CSV/";
   $date = getdate( date("U") );
   $fName = $directory . $date[month] . "_" . $date[mday] . "_" . $date[year] . ".csv";
   $file = fopen( $fName, "r" );

   // Read .csv file and populate html table with its contents; each cell
   // matches to a table header
   if ( $file != FALSE ) {
      while ( ($line = fgetcsv($file)) !== false ) {
         echo "<tr>";
         foreach ($line as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
         }
         echo "</tr>\n";
      }
      fclose($f);
   }
?>
   </table>
   <script>
     var tables = document.getElementsByTagName('table');
     var table = tables[tables.length - 1];
     var rows = table.rows;

     // "#" for first row with labels
     td = document.createElement('td');
     td.appendChild(document.createTextNode("#"));
     rows[0].insertBefore(td, rows[0].firstChild);

     // Incrementing # for all other rows
     for (var i = 1, td; i < rows.length; i++) {
         td = document.createElement('td');
         td.appendChild(document.createTextNode(i));
         rows[i].insertBefore(td, rows[i].firstChild);
     }
   </script>
   <p><a href="SignIn.php" target=_self>New Player Sign-in</a></p>
  </body>
</html>

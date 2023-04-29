<?php

$hostname = "db.osucascades.net"; $username = "cs290"; $password = "290-motor-mania"; $database = "motorcycle_mania";
$port = 3306;

$number_of_rows = 10;
$table = "motorcycles";

/* Set up the connector object */
$db = new mysqli(
  $hostname, // hostname of the database host
  $username, $password, // authentication
  $database, // name of db connecting
  $port // default is 3306 but can be configured otherwise
);

/* Fail if can't connect */
if ($db->connect_error) {
  die("Error: Could not connect to database. " . $db->connect_error);
}

function printHTMLForTableWithLimit($table_name, $limit_number) {
  $DB_query = "SELECT * FROM $table_name LIMIT $limit_number";
  printHTML($DB_query);
}

function printHTML($query) {
  $result = $db->query($query);
  /* Do stuff with response */ /* Draw one row at a time, each row is an array */
  echo "<table>\n";
  while ($line = $result->fetch_assoc()) {
    echo "\t<tr>\n";
     foreach ($line as $col_value) {
       echo "\t\t<td>$col_value</td>\n";
     }
    echo "\t</tr>\n";
  }
  echo "</table>\n";
}

$table_names = array("motorcycles", "categories");

function displayTables($display_names) {
  foreach ($display_names as $current_display_name) {
    printHTMLForTableWithLimit($current_display_name, $number_of_rows);
  }
}

displayTables($table_names);

/* Close the connection */
mysqli_close($db);
?>

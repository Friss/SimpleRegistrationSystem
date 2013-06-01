<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Current Registrants</title>
<style>
th {
	border:1px solid #000;
}
td {
	border:1px solid #000;
}
</style>
</head>

<body>
<table style="border:1px solid #000;">
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
<th>Day Phone</th>
<th>Evening Phone</th>
<th>Affilation</th>
</tr>
<?


include('includes/database.php');

$regisrations = $mysqli->query('SELECT * FROM `regisrations`');



// fetch a row and write the column names out to the file
while($entry= $regisrations->fetch_assoc()){
   
 
?>
<tr>
<td><?=$entry['firstname'];?></td>
<td><?=$entry['lastname'];?></td>
<td><?=$entry['email'];?></td>
<td><?=$entry['address'];?></td>
<td><?=$entry['city'];?></td>
<td><?=$entry['state'];?></td>
<td><?=$entry['zip'];?></td>
<td><?=$entry['dayphone'];?></td>
<td><?=$entry['eveningphone'];?></td>
<td><?=$entry['affiliation'];?></td>
</tr>
<? } ?>
</table>
<?
$fp = fopen('registrations.csv', "w");

$res = $mysqli->query('SELECT * FROM `regisrations`');



// fetch a row and write the column names out to the file
$row = $res->fetch_assoc();
$line = "";
$comma = "";
foreach($row as $name => $value) {
    $line .= $comma . '"' . str_replace('"', '""', $name) . '"';
    $comma = ",";
}
$line .= "\n";
fputs($fp, $line);

// remove the result pointer back to the start
$res->data_seek(0);


// and loop through the actual data
while($row = $res->fetch_assoc()) {
   
    $line = "";
    $comma = "";
    foreach($row as $value) {
        $line .= $comma . '"' . str_replace('"', '""', $value) . '"';
        $comma = ",";
    }
    $line .= "\n";
    fputs($fp, $line);
   
}

fclose($fp);
$mysqli->close();
echo "<h3><a href='registrations.csv'>To Download as a .csv click here</a></h3>";
exit();
?>


</body>
</html>
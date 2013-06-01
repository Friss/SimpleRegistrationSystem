<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registration</title>
</head>

<body>
<?
$mysqli = new mysqli("localhost", "user", "pass", "database");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if ($stmt = $mysqli->prepare("INSERT INTO `regisrations`(`firstname`,`lastname`,`email`,`address`,`city`,`state`,`zip`,`dayphone`,`eveningphone`,`affiliation`) VALUES (?,?,?,?,?,?,?,?,?,?)")){

$stmt->bind_param('ssssssisss',$_SESSION[firstname],$_SESSION[lastname],$_SESSION[email],$_SESSION[address],$_SESSION[city],$_SESSION[state],$_SESSION[zip],$_SESSION[dayphone],$_SESSION[eveningphone],$_SESSION[affiliation]);

$_SESSION[firstname] = $_POST['firstname'];
$_SESSION[lastname] = $_POST['lastname'];
$_SESSION[email] = $_POST['email'];
$_SESSION[address] = $_POST['address'];
$_SESSION[city] = $_POST['city'];
$_SESSION[state] = $_POST['state'];
$_SESSION[zip] = $_POST['zip'];
$_SESSION[dayphone] = $_POST['dayphone'];
$_SESSION[eveningphone] = $_POST['eveningphone'];
$_SESSION[affiliation] = $_POST['affiliation'];

$stmt->execute();


$stmt->close();

}else {
	printf("Prepared Statement Error: %s\n", $mysqli->error);
}


echo "<h1>Registration Complete!</h1>";
echo "<br />Thank you! You should receive an email shortly confirming your registration as shown below:";

$msg = "Thank you for registering for the Random Conference. We look forward to seeing you at the event on June 1st, 2013<br /><br />";

$msg .= "===================================================================<br />";
$msg .= "Contact Information:<br />";
$msg .= "===================================================================<br />";
$msg .= "First Name: $_SESSION[firstname] <br />";
$msg .= "Last Name: $_SESSION[lastname] <br />";
$msg .= "Street Address: $_SESSION[address] <br />";
$msg .= "City: $_SESSION[city] <br />";
$msg .= "State: $_SESSION[state] <br />";
$msg .= "Zip: $_SESSION[zip] <br />";
$msg .= "Daytime Phone: $_SESSION[dayphone] <br />";
$msg .= "Evening Phone: $_SESSION[eveningphone] <br />";
$msg .= "Email Address: $_SESSION[email] <br />";

$msg .= "===================================================================<br />";
$msg .= "Registration Information:<br />";
$msg .= "===================================================================<br />";
$msg .= "Affiliation: $_SESSION[affiliation] <br />";

$msg .= "===================================================================<br />";
$msg .= "If you have any questions, contact Jane Doe at 123-456-7890 or Bob Smith at 123-456-7890<br />";

echo $msg;

//Send confirmation message to user. 

$sender = "admin@example.com";
$subject = "Registration Confirmed";
$mailheaders = "MIME-Version: 1.0\r\n";
$mailheaders .= "Content-type: text/html; charset=ISO-8859-1\r\n";
$mailheaders .= "From: $sender";

mail($_SESSION[email], $subject, $msg, $mailheaders);

?>



</body>
</html>
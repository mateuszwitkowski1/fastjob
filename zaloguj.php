<?php
session_start();
$servername = "sql.freshwebsite.nazwa.pl";
$username = "freshwebsite_5";
$password = "Projekt123";
$dbname = "freshwebsite_5";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Połączono z bazą.";

$login=$_POST["login"];
$haslo=$_POST["haslo"];;
//echo $login, $haslo;

$sql = "SELECT id, login FROM Zleceniodawca WHERE login='$login' AND haslo='$haslo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $conn->close();
	$row = $result->fetch_assoc();
	$_SESSION['login']=$login;
	$_SESSION['id']=$row["id"];
	header("location: panel.php");
	die();
} else {
	$conn->close();
    die("Nie ma takiego użytkownika.");
}
?>
<script type="text/javascript">
//window.location.replace("panel.php");
</script>
<?
die();
?>
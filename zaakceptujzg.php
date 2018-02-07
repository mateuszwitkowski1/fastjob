<?
session_start();
$login = $_SESSION['login'];
$id = $_SESSION['id'];
$servername = "sql.freshwebsite.nazwa.pl";
$username = "freshwebsite_5";
$password = "Projekt123";
$dbname = "freshwebsite_5";

$idzgloszenia = $_GET["id"];
$idoferta = $_GET["oferta"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Połączono z bazą.";
$q1="SET CHARSET utf8";
$q2="SET NAMES `utf8` COLLATE `utf8_polish_ci`";
 $conn->query($q1);
 $conn->query($q2);

$sql = "UPDATE Zgloszenia SET zaakceptowana=1 WHERE id=$idzgloszenia";
$conn->query($sql);
$sql = "UPDATE Zgloszenia SET zaakceptowana=0 WHERE id!=$idzgloszenia AND id_oferta = $idoferta";
$conn->query($sql);
header("location: zgloszenie.php?id=$idzgloszenia");
	die();
?>

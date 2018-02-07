<?
session_start();
$login = $_SESSION['login'];
$id = $_SESSION['id'];
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
$q1="SET CHARSET utf8";
$q2="SET NAMES `utf8` COLLATE `utf8_polish_ci`";
 $conn->query($q1);
 $conn->query($q2);

$nazwa=$_POST["nazwa"];
$kategoria=$_POST["kategoria"];

$sql = "SELECT id FROM Zainteresowanie WHERE nazwa = '$kategoria'";
$result = $conn->query($sql);
$kategoriaid=0;
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$kategoriaid=$row["id"];
} else {
    
}

$opis=$_POST["opis"];
$cena=$_POST["cena"];
$data=$_POST["data"];
$czas=$_POST["czas"];
$miasto=$_POST["miasto"];
$godzina=$_POST["godzina"];
$ulica=$_POST["ulica"];


$plik_tmp = $_FILES['plik']['tmp_name'];
$plik_nazwa = $_FILES['plik']['name'];
$plik_rozmiar = $_FILES['plik']['size'];

if(is_uploaded_file($plik_tmp)) {
     move_uploaded_file($plik_tmp, "upload/$plik_nazwa");
}



$sql2 = "INSERT INTO `Oferty` (`nazwa`,`opis`,`id_zleceniodawca`,`kategoria`,`cena`,`czas`,`aktywna`,`miasto`,`ulica`,`dzien`,`godzina`,`plik`) VALUES ('$nazwa','$opis',$id,$kategoriaid,$cena,'$czas',1,'$miasto','$ulica','$data','$godzina','$plik_nazwa')";

$conn->query($sql2);

header("location: panel.php");
	die();
?>
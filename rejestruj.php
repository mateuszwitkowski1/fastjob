<?php
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
echo "Połączono z bazą.";

$login=$_POST["login"];
$haslo=$_POST["haslo"];
$email=$_POST["email"];
$telefon=$_POST["telefon"];
echo $login, $haslo, $email, $telefon;

$sql = "INSERT INTO Zleceniodawca (login, haslo, aktywny, email, telefon, zablokowany) VALUES ('$login', '$haslo', '1', '$email', '$telefon', '0')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<script type="text/javascript">
window.location.replace("index2.html");
</script>
<?
die();
?>
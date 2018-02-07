<?
session_start();
$login = $_SESSION['login'];
$iduz = $_SESSION['id'];
$servername = "sql.freshwebsite.nazwa.pl";
$username = "freshwebsite_5";
$password = "Projekt123";
$dbname = "freshwebsite_5";

$idzgloszenia = $_GET["id"];
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
$dzisiaj = date('Y-m-d');
				//echo $dzisiaj;
$sql = "SELECT opis,id_uzytkownik,zaakceptowana,id_oferta FROM Zgloszenia WHERE id = $idzgloszenia";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    	$row = $result->fetch_assoc();
		$id_uzytkownik=$row["id_uzytkownik"];
		$sql2 = "SELECT login,imie,nazwisko,wiek,email,telefon,opis from Uzytkownik WHERE id = $id_uzytkownik";
		$result2 = $conn->query($sql2);
		$row2=$result2->fetch_assoc();
		$loginuz = $row2["login"];
	$imie = $row2["imie"];
$nazwisko = $row2["nazwisko"];
$wiek = $row2["wiek"];
	$email = $row2["email"];
	$telefon = $row2["telefon"];
		$opis=$row2["opis"];
	$opiszg=$row["opis"];
	$idoferta=$row["id_oferta"];
	$zaakceptowane=$row["zaakceptowana"];

} else {
    echo "0 results";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>FastJob- Twoja platforma wszystkich zleceń</title>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

 	<body>
		  <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">FastJob- panel zleceniodawcy</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="panel.php">Strona główna</a></li>
			<li class="active"><a href="#">Zarządzaj zleceniami</a></li>
			<li><a href="#">Edytuj profil</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">Kontakt</a></li>
          </ul>
			<form class="navbar-form navbar-right">
            <button type="submit" class="btn btn-success">Wyloguj</button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	</body>
	
	<div class="container">
		<div class="row">
			<h1>Zgłoszenie od <? echo "<button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>$loginuz</button>"; ?> na ogłoszenie "Malowanie pokoju":
			</h1>
		</div>
		<div class="row">
		<p><? echo $opiszg; ?>
			<?
			if($zaakceptowane == NULL){
			?>
		<h1><a style="float:right;margin-left:10px;" type="button" href="zaakceptujzg.php?id=<? echo $idzgloszenia;?>&oferta=<? echo $idoferta; ?>" class="btn btn-lg btn-success">Zaakceptuj zgłoszenie</a><!--<a style="float:right;" type="button" href="#" class="btn btn-lg btn-danger">Odrzuć zgłoszenie</a>--></h1>
			<?
			}
			else if($zaakceptowane == 1){
				?>
			<h4>Zaakceptowałeś już to zgłoszenie! Gratulacje, możesz skontaktować się z wykonawcą, nr tel użytkownika <? echo "$loginuz ";?>to <? echo "$telefon";?>.</h4>
			<?
			}
			else{?>
			<h3>Zaakceptowałeś już inne zgłoszenie na to zlecenie.</h3>
			<?}?>
		</div>
		
		<!--
		<div class="row">
			<h1>Odpowiedz na wiadomość:</h1>
			<form>
				<div class="form-group">
    <textarea class="form-control" id="exampleTextarea" rows="5"></textarea>
  </div>
			</form>
			<h1><a style="float:right;" type="button" href="#" class="btn btn-lg btn-success">Wyślij</a></h1>
		</div>
-->
		<hr>

      <footer>	  
        <p>&copy; 2017, FastJob.</p>
		</footer>
	</div>
	
	<!--info o użytkowniku-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
					<div class="col-md-3">
					 <img style="margin-top:30px;" src="img/malarz.jpg" class="img-rounded" alt="avatar" width="100%">
					 <img src="img/2_ocena.jpg" alt="ocena" width="100%">
					</div>
					<div class="col-md-9">
						<h1><b><? echo $loginuz; ?></b><a style="float:right;" type="button" href="#" class="btn btn-lg btn-info">Wyświetl opinie</a></h1>
						<h2><b>Opis użytkownika:</b></h2>
						<p><? echo $opis; ?></p>						<h4><b>Liczba wykonanych zleceń:</b> 15</h4>
						<h4><b>Procent pozytywnych opinii:</b> <span style="color:#5cb85c;">93%</span></h4>
						<h4><b>Imię i nazwisko:</b> <? echo " $imie $nazwisko"; ?></h4>
						
					</div>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>
	<!--koniec info o użytkowniku-->
	
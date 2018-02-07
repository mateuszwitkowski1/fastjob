<?
session_start();
$login = $_SESSION['login'];
$iduz = $_SESSION['id'];
$servername = "sql.freshwebsite.nazwa.pl";
$username = "freshwebsite_5";
$password = "Projekt123";
$dbname = "freshwebsite_5";
$idoferty = $_GET["id"];
//echo $id;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Połączono z bazą.";
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
	<?
			$q1="SET CHARSET utf8";
$q2="SET NAMES `utf8` COLLATE `utf8_polish_ci`";
					 $conn->query($q1);
					 $conn->query($q2);
$dzisiaj = date('Y-m-d');
				//echo $dzisiaj;
$sql = "SELECT opis,nazwa,id,nazwa,kategoria,dzien,godzina,cena,czas,miasto,ulica,aktywna,plik FROM Oferty WHERE id_zleceniodawca = $iduz AND id=$idoferty";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    	$row = $result->fetch_assoc();
		$czyakt="";
		if($row["aktywna"]==1)$czyakt="Tak";
		else $czyakt="<td style='color:red;'>Nie</td>";
		$nazwa_kat = $row["kategoria"];
		$sql2 = "SELECT nazwa from Zainteresowanie WHERE id = $nazwa_kat";
		$result2 = $conn->query($sql2);
		$row2=$result2->fetch_assoc();
		$kategoria=$row2["nazwa"];
		$opis=$row["opis"];
		$godzina=$row["godzina"];
		$dzien=$row["dzien"];
		$miasto=$row["miasto"];
		$cena=$row["cena"];
		$czas=$row["czas"];
		$zdjecie=$row["plik"];
		$ulica=$row["ulica"];
	$nazwazl=$row["nazwa"];

} else {
    //echo "0 results";
}
?>
	<div class="container">
		<div class="row">
			<h1><? echo $nazwazl; ?> :
			<a style="float:right;" type="button" href="#" class="btn btn-lg btn-info">Edytuj zlecenie</a>
			</h1>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h4><b>Opis zlecenia:</b></h4>
				<p><? echo $opis; ?></p>
				<h4><b>Data:</b> <? echo "$dzien, godz. $godzina"; ?></h4>
				<h4><b>Id zlecenia:</b> <? echo " $idoferty"; ?></h4>
				<h4><b>Miejsce:</b><? echo " $miasto, ul. $ulica"; ?></h4>
				<h4><b>Aktywne:</b> <? echo " $czyakt"; ?></h4>
				<h4><b>Kategoria:</b><? echo " $kategoria"; ?></h4>
				<h4><b>Cena:</b> <? echo " $cena zł"; ?></h4>
				<h4><b>Orientacyjny czas:</b><? echo " $czas godzin"; ?></h4>
				
			</div>
			
			<div class="col-md-6">
				<h2>Odpowiedzi:</h2>
				<table class="table table">
					<thead>
						<tr>
							<th>Użytkownik</th>
							<th>Wiadomość</th>
							<th>Data</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?
			$sql = "SELECT id,id_uzytkownik,kiedy,opis FROM Zgloszenia WHERE id_oferta = $idoferty";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    	while($row = $result->fetch_assoc()){
		$idzgloszenia=$row["id"];
		$id_uzytkownik = $row["id_uzytkownik"];
		$sql42 = "SELECT login from Uzytkownik WHERE id = $id_uzytkownik";
		$result42 = $conn->query($sql42);
		$row42=$result42->fetch_assoc();
			$uzytkownik=$row42["login"];
			$kiedy=$row["kiedy"];
			$opis=$row["opis"];
			$krotki=substr($opis,0,20);
			echo "<tr><td>$uzytkownik</td><td>$krotki...</td><td>$kiedy</td><td><a type='button' href='zgloszenie.php?id=$idzgloszenia' class='btn btn-xs btn-success'>Wyświetl</a></td></tr>";
		}
} else {
    //echo "0 results";
}
			?>
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row">
				<h1>Zdjęcia:
			<a style="float:right;" type="button" href="#" class="btn btn-lg btn-info">Zarządzaj zdjęciami</a></h1>
				<h5>Dodanie zdjęć sprawia, że Twoje ogłoszenie staje się atrakcyjniejsze, a Twoje ogłoszenie będzie się wyróżniać.</h5>
		 <div class="row">
  <div class="col-md-3">
    <div class="thumbnail">
      <a href="<? echo "upload/$zdjecie"; ?>">
        <img src="<? echo "upload/$zdjecie"; ?>" alt="ogloszenie" style="width:100%">
      </a>
    </div>
  </div>
</div>	
		
		
		</div>
		<hr>

      <footer>
        <p>&copy; 2017, FastJob.</p>
		</footer>
	</div>
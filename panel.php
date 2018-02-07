<?
session_start();
$login = $_SESSION['login'];
$iduz = $_SESSION['id'];
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	  <script type="text/javascript">
google_adtest = "on";         // new line
google_ad_client = "pub-6151763470684693";
google_alternate_color = "ffffff";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
google_ad_channel = "0000000000";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
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
            <li class="active"><a href="#">Strona główna</a></li>
			<li><a href="#">Zarządzaj zleceniami</a></li>
			<li><a href="#">Edytuj profil</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">Kontakt</a></li>
          </ul>
			<form class="navbar-form navbar-right" action="wyloguj.php">
				<span style="color:#9d9d9d;margin-right:5px;"><?echo "Witaj, ", $login;?></span>
            <button type="submit" class="btn btn-success">Wyloguj</button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	</body>
	
	<div class="container">
		<div class="row">
		<div class="col-md-12">
			<h1>Twoje nadchodzące zlecenia:
			<a style="float:right;" type="button" href="dodaj.php" class="btn btn-lg btn-info">Dodaj zlecenie</a>
				</h1>
			 <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Kategoria</th>
                <th>Data</th>
				<th>Ilość zgłoszeń</th>
				<th>Aktywne</th>
				<th></th>
				<th></th>
              </tr>
            </thead>
            <tbody>
				<?					 
$q1="SET CHARSET utf8";
$q2="SET NAMES `utf8` COLLATE `utf8_polish_ci`";
					 $conn->query($q1);
					 $conn->query($q2);
$dzisiaj = date('Y-m-d');
				//echo $dzisiaj;
					$sql = "SELECT nazwa,id,nazwa,kategoria,dzien,aktywna FROM Oferty WHERE id_zleceniodawca = $iduz AND dzien>=$dzisiaj";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$czyakt="";
		if($row["aktywna"]==1)$czyakt="Tak";
		else $czyakt="<td style='color:red;'>Nie</td>";
		$nazwa_kat = $row["kategoria"];
		$sql2 = "SELECT nazwa from Zainteresowanie WHERE id = $nazwa_kat";
		$result2 = $conn->query($sql2);
		$row2=$result2->fetch_assoc();
		$idofer=$row["id"];
		$sql3 = "SELECT count(id) as total from Zgloszenia WHERE id_oferta=$idofer";
		$result3 = $conn->query($sql3);
		$row3=$result3->fetch_assoc();
		$odpowiedzi=$row3["total"];
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nazwa"]. "</td><td>" . $row2["nazwa"]. "</td><td>" . $row["dzien"]. "</td><td><b>" . $odpowiedzi. "</b></td><td>" . $czyakt. "</td><td></td><td><a type='button' href='zlecenie.php?id=" . $row["id"]. "' class='btn btn-xs btn-success'>Szczegóły</a></td></tr>";
    }
} else {
    //echo "0 results";
}?>
            </tbody>
          </table>
        </div>
		</div>
		<div class="row">
		<div class="col-md-12">
			<h1>Zakończone zlecenia:
				</h1>
			 <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nazwa</th>
                <th>Wykonawca</th>
                <th>Data</th>
				<th>Koszt</th>
				<th></th>
				<th></th>
              </tr>
            </thead>
            <tbody>
				<?					 
$q1="SET CHARSET utf8";
$q2="SET NAMES `utf8` COLLATE `utf8_polish_ci`";
					 $conn->query($q1);
					 $conn->query($q2);
$dzisiaj = date('Y-m-d');
				//echo $dzisiaj;
					$sql = "SELECT nazwa,id,nazwa,kategoria,dzien,aktywna,cena,id_uzytkownik FROM Oferty WHERE id_zleceniodawca = $iduz AND dzien<=$dzisiaj";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$nazwa_uz = $row["id_uzytkownik"];
		$sql43 = "SELECT login from Uzytkownik WHERE id = $nazwa_uz";
		$result43 = $conn->query($sql43);
		$kto = "nikt";
		if($result43->num_rows > 0){
		while($row43=$result43->fetch_assoc()){
			$kto=$row43["login"];
		
		}}
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nazwa"]. "</td><td>" . $kto. "</td><td>" . $row["dzien"]. "</td><td>" . $row["cena"]. "</td><td><a type='button' href='zlecenie.html' class='btn btn-xs btn-danger'>Usuń z listy</a></td><td><a type='button' href='zlecenie.php' class='btn btn-xs btn-success'>Wystaw opinię</a></td></tr>";
    }
} else {
}?>
            </tbody>
          </table>
        </div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h1>Twój profil:
				<a style="float:right;" type="button" href="#" class="btn btn-lg btn-info">Edytuj profil</a></h1>
				<h5>Tylko od Ciebie zależy, jak widzą Cię inni użytkownicy.</h5>
				<div class="row">
					<div class="col-md-4">
					 <img style="margin-top:30px;" src="img/1_avatar.jpg" class="img-rounded" alt="avatar" width="100%">
					 <img src="img/2_ocena.jpg" alt="ocena" width="100%">
					</div>
					<div class="col-md-8">
						<h2><? echo $login; ?></h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet magna nibh. Fusce vel ornare libero, scelerisque imperdiet nulla. Sed et tristique diam. Etiam lectus magna, scelerisque lacinia turpis id, aliquam dictum magna. Pellentesque et nulla ut nunc fringilla semper id vitae lectus. Pellentesque quis scelerisque augue.</p>
						
					</div>
				</div>
			</div>
			<div class="col-md-6" style="text-align:center;">
				<img src="img/testad.png" style="margin-top:20px;"alt="testad">
				
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Homepage Leaderboard -->
<ins class="adsbygoogle";
	 google_adtest = “on”;
    google_ad_client: "pub-6151763470684693";
	 google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
	 ></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
			
			</div>
		</div>
		<hr>

      <footer>
        <p>&copy; 2017, FastJob.</p>
      </footer>
	</div>

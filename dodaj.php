<?
session_start();
$login = $_SESSION['login'];
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
<html lang="pl">
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
            <li class="active"><a href="panel.php">Strona główna</a></li>
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
			<h1>Witaj w kreatorze zlecenia!</h1>
			<h4>Zadbaj o to, by Twoje zlecenie się wyróżniało. Szczegółowy opis, zachęcająca cena przyciągnie na pewno wielu zainteresowanych. Pamiętaj, że im z większym wyprzedzeniem dodajesz zlecenie, tym większa szansa na znalezienie wykonawcy.</h4>
			<div class="row">
			<form id='register' action='dodaj2.php' method='post' form enctype="multipart/form-data" accept-charset='UTF-8' style="margin-top:30px;">
			<div class="row">
				<div class="col-sm-6">
			<div class="form-group">
    			<label for="exampleInputEmail1">Nazwa zlecenia</label>
    			<input type="text" name="nazwa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nazwa zlecenia">
    			<small id="emailHelp" class="form-text text-muted">Krótka nazwa charakteryzująca Twoje zlecenie (np. "Malowanie pokoju").</small>
  			</div>
				</div>
				<div class="col-sm-6">
			<div class="form-group">
 				 <label for="sel1">Kategoria zlecenia:</label>
 				 <select class="form-control" id="sel1" name="kategoria">
<?
					 
$q1="SET CHARSET utf8";
$q2="SET NAMES `utf8` COLLATE `utf8_polish_ci`";
					 $conn->query($q1);
					 $conn->query($q2);
					 
					$sql = "SELECT nazwa FROM Zainteresowanie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option>" . $row["nazwa"]. "</option>";
    }
} else {
    echo "0 results";
}
//$conn->close();
					?>
 				 </select>
				</div> 
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">

								 <div class="form-group">
  					<label for="comment">Opis zlecenia:</label>
				 	 <textarea class="form-control" rows="5" name="opis" id="comment"></textarea>
			</div> 
				</div>
				<div class="col-sm-6">
			<div class="form-group">
   				<label for="exampleInputEmail1">Cena</label>
    			<input type="text" name="cena" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Cena zlecenia w zł">
    			<small id="emailHelp" class="form-text text-muted">Ustal uczciwą cenę za wykonanie zlecenia.</small>
 			</div>
				</div>
				<div class="col-sm-6">
			<div class="form-group">
   				<label for="example-date-input" class="col-2 col-form-label">Data</label>
 				   <input name="data" class="form-control" type="date" value="RRRR-MM-DD"  aria-describedby="emailHelp" id="example-date-input">
				<small id="emailHelp" class="form-text text-muted">Data wykonania zlecenia w formacie RRRR-MM-DD (np. 2017-07-21).</small>
 			</div>
				</div>
				<div class="col-sm-6">
			<div class="form-group">
   				<label for="exampleInputEmail1">Godzina</label>
    			<input type="text" name="godzina" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="GG:MM">
    			<small id="emailHelp" class="form-text text-muted">Przewidywana godzina rozpoczęcia pracy w formacie GG-MM (np. 18:30).</small>
 			</div>
				</div>
								<div class="col-sm-6">
			<div class="form-group">
   				<label for="exampleInputEmail1">Czas</label>
    			<input type="text" name="czas" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Czas w godzinach">
    			<small id="emailHelp" class="form-text text-muted">Przewidywany czas wykonania zlecenia.</small>
 			</div>
				</div>
								<div class="col-sm-6">
			<div class="form-group">
   				<label for="exampleInputEmail1">Miasto</label>
    			<input type="text" name="miasto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Miasto">
    			<small id="emailHelp" class="form-text text-muted">Miasto, w którym odbędzie się zlecenie.</small>
 			</div>
				</div>
								<div class="col-sm-6">
			<div class="form-group">
   				<label for="exampleInputEmail1">Ulica</label>
    			<input type="text" name="ulica" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ulica">
    			<small id="emailHelp" class="form-text text-muted">Ulica na której odbędzie się zlecenie (nie musisz podawać dokładnego adresu- umówicie się telefonicznie).</small>
 			</div>
				</div>
				
				<div class="col-sm-6">
			 <div class="form-group">
    <label for="exampleInputFile">Wybierz zdjęcie</label>
    <input type="file" name="plik" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">Wybierz zdjęcie najlepiej opisujące wybrane zlecenie.</small>
  </div>
									</div>

				<div class="col-sm-6">
			        <p><input class="btn btn-primary btn-lg" type="Submit" name="Submit" value="Dodaj zlecenie &raquo;"/></p>
				</div>
				</div>
			

			</form>
			</div>
		
		</div>
		<hr>
      <footer>
        <p>&copy; 2017, FastJob.</p>
      </footer>
	</div>

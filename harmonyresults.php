  <html>
  <title>
    MusicNet
  </title>
    <head>
    <h1 style="margin-bottom:0;background-color:#DCDCDC;"><a href="home.php" style="text-decoration:none;">MusicNet</a></h1>
    <link rel="icon" type="image/png" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="http://cs445.cs.umass.edu/groups/cfr/www/css/garfCSS.css">

    <script src="http://cs445.cs.umass.edu/groups/cfr/www/js/jQuery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cs445.cs.umass.edu/groups/cfr/www/js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css" >
    <script src="http://cs445.cs.umass.edu/groups/cfr/www/js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
	
	<style>
		#toolbar {
		padding: 4px;
		display: inline-block;
		background: #DCDCDC;
		border: #DCDCDC;
		}
		a:visited {color: #000000}
	</style>
	<?php //Open a connection
		$connection = mysql_connect("cs445sql", "stferrar", "EL440stf");
		  if (!$connection){
			echo "Database connection unsuccessful";
		  }
		  if (!mysql_select_db("cfr")){
			echo "Database selection unsuccessful";
		  }
	?>
    <script>
    $(document).ready(function(){
		
		var isSignedIn = false;

		oTable = $('#datatable').dataTable( {
			"aaData": [
			  [ "Ryan's Opera","3:00", "Front Row","W"],
			  [ "Scott Rap","3:00", "Grandma Scott","W"],
			  [ "Steve's Rap","3:00", "Greatest White Rapper","W"],
			  [ "N***** Guy","3:00", "Front Row","W"]
			],
			"aoColumns": [
			  { "sTitle": "Song" },
			  { "sTitle": "Album" },
			  { "sTitle": "Artist" },
			  { "sTitle": "Genre"}
			],
			"bFilter":false,
			"bInfo":false,
			"sDom": '<"top">rt<"bottom"><"clear"i>'
		  } );
		
		<?php //This script gets the results of the test and sends a query to select a song based on answers
			if(isset($_POST["qone"]))
				$answer1 = intval($_POST["qone"]);
			else
				$answer1 = 1;
			if(isset($_POST["qtwo"]))
				$answer2 = intval($_POST["qtwo"]);
			else
				$answer2 = 1;
			if(isset($_POST["qthree"]))
				$answer3 = intval($_POST["qthree"]);
			else
				$answer3 = 1;
			if(isset($_POST["qfour"]))
				$answer4 = intval($_POST["qfour"]);
			else
				$answer4 = 1;
			if(isset($_POST["qfive"]))
				$answer5 = intval($_POST["qfive"]);
			else
				$answer5 = 1;

			$inputs = array($answer1, $answer2, $answer3, $answer4, $answer5);
			$genreList = array("country","rock","jazz","hip hop");
			$genreArray = array(0,0,0,0);
			for($i = 0; $i < count($inputs); $i++){
				$selectedanswer = $inputs[$i] - 1;
				$genreArray[$selectedanswer]++;
			}
			$max = 0;
			$maxIndex = 1;
			for($x = 0; $x < count($genreArray); $x++){
				if($genreArray[$x] > $max){
					$max = $genreArray[$x];
					$maxIndex = $x;
				}
			}
			$selectedgenre = $genreList[$maxIndex];
			
			//Random Song by Genre selecting query
			$query = "SELECT S.title, Al.album_name, Ar.artist_name, TW.term  FROM Songs S, Term_Weights TW, Artists Ar, Albums Al WHERE S.artist_id = Ar.artist_id AND S.album_id = Al.album_id AND TW.term ='".$selectedgenre."' AND S.song_id = TW.song_id AND TW.weight > 0.50 ORDER BY RAND() LIMIT 1;";
			$query = "SELECT S.title, Al.album_name, Ar.artist_name, HTT.term FROM Songs S, HarmonyTermsTable HTT, Artists Ar, Albums Al WHERE S.artist_id = Ar.artist_id AND S.album_id = Al.album_id AND HTT.term ='".$selectedgenre."' AND S.song_id = HTT.song_id AND HTT.weight > 0.50 ORDER BY RAND() LIMIT 1;";
			$result = mysql_query($query);
			$row = "";
			if($result)
				$row = mysql_fetch_array($result, MYSQL_NUM );
		?>
		//Display song in Datatable
		var results = <?php echo json_encode($row); ?>;
		var genrestring = results[3];
		var fixgenre = genrestring.charAt(0).toUpperCase() + genrestring.slice(1);
		results[3] = fixgenre;
		oTable.fnClearTable();
		oTable.fnAddData(results);
		oTable.fnDraw();

	});
	
	function expand(s) //Used for drop down menu
    {
		$("div.menuNormal").show();
    }
    function collapse(s)
    {
		$("div.menuNormal").hide();
    }	
    </script>
    </head>
	<body>
	
	<!-- Login Form -->
    <div id="signin-form" title="Create new user" style="display:none">
	<p class="validateTips">All form fields are required.</p>
		<form>
		<fieldset>
			<label for="name">Username: </label>
			<input type="text" name="name" id="username" class="text ui-widget-content ui-corner-all"><br>
			<label for="password">Password:  </label>
			<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
		</fieldset>
		</form>
		<p style="color:red;display:none">Incorrect information entered.</p>
	</div>

	<!-- Search form -->
	<div id="search-modal" title="Advanced Search" style="display:none">
		<form>
	        <fieldset>
	          Song Title: <input type="text" name="title"><br>
	          Album: <input type="text" name="album"><br>
	          Artist: <input type="text" name="artist"><br>
	          Artist Location: <input type="text" name="artloc"><br>
	          Year: <input type="text" name="year"><br>
	        </fieldset>
	      </form>
	</div>
	
	<div id="rate-modal" title="Rate this Song" style="display:none">
	<p>Rating: </p>
	<br>
	<div id="rater">
		0<input type="range" name="rating" min="0" max="5">5
	</div>
	</div>
	
	<!-- Nav Bar -->
    <div id="menu" style="background-color:#DCDCDC;width:100%">
		<table class="menu" width="120">
			<tr>
				<td class="menuNormal" width="120" onmouseover="expand(this);" onmouseout="collapse(this);">
					<p>Menu</p>
					<div class="menuNormal" width="120">
						<table class="menu" width="120">
							<tr>
							<td class="menuNormal">
								<a href = "home.php" class="menuitem">Home</a>
							</td>
							</tr>
						</table>
						
						<table class="menu" width="120">
							<tr>
							<td class="menuNormal">
								<a href = "admin.php" class="menuitem">Admin</a>
							</td>
							</tr>
						</table>

						<table class="menu" width="120">
							<tr>
								<td class="menuNormal">
									<a href = "harmony.php" class="menuitem">Harmony</a>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	  <div style="display:inline;width:45%;text-align:right;float:right;">
			<div style="margin-top:10px;display:none">
							
				<?php
				//Script used to check or create cookies for login persistence
					  if (isset($_POST["deletecookie"])){
						@setcookie("username", "", time()-3600);
						unset($_COOKIE["username"]);
					  }
					  else if(@$_POST["uid"] && $_POST["password"]){
						if (@$_POST["uid"] != "" && $_POST["password"] != ""){
						$connection = mysql_connect("cs445sql", "stferrar", "EL440stf");
						$query = "SELECT Users.user_name, Users.password FROM Users WHERE Users.user_id='" . @$_POST["uid"]."'";
						$result = mysql_query($query);
						if (!$result){
						  die("User not found!" . mysql_error());
						}
						else{
						  if ($row = mysql_fetch_array($result)){
							$name = $row[0];
							$pass = $row[1];
							if ($pass == $_POST["password"]){
							  @setcookie("username", $name, time()+3600);
							  $_COOKIE["username"] = $name;
							}
						  } 
						}
					  }
					  }
					if (isset($_COOKIE["username"])){
					?>
					<?php
					  echo "Welcome, " . $_COOKIE["username"] . "!<br><br>\n";
					  echo "<form method=\"post\" action=\"home.php\">\n";
					  echo "<input type=\"hidden\" name=\"deletecookie\">\n";
					  echo "<input type=\"submit\" value=\"Logout\">\n";
					  echo "</form>";
					  }
					  else{
					?>
						<form id="login-form" method="POST" action="home.php">
							<label for="uid">Username: </label>
							<input type="text" name="uid" id="username" class="text ui-widget-content ui-corner-all"><br>
							<label for="password">Password: </label>
							<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all"><br>
							<input type="submit" value="Login">
						</form>
					<?php
					  }
					?>
				<p style="display:none" id="user-label"><p>
				<button id="loggout-button" style="display:none">Logout</button>
			</div>

			<br>
	  </div>
	<div style="display:inline; width:30%">
          <h3 class="panel">MusicNet is a social network for music enthusiasts. It contains a large database of songs, artists, and albums, as well as provides a medium for friends to share their music interests. Users of MusicNet can search for and rate songs, giving their profile a unique personal twist.</h3>
    </div>

	<br>
	
	<!-- Datatable init -->
	<div id="datatable-div" style="width:100%">
		<table id="datatable" border="1">
		  <thead>
			<tr>
				<th>Title</th>
				<th>Album</th>
				<th>Artist</th>
				<th>Genre</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Row 1 Data 1</td>
			</tr>
			<tr>
				<td>Row 2 Data 1</td>
			</tr>
		</tbody>
		</table>
	</div>

	<br>

</body>
    <!-- Footer -->
 
  <footer>
      <hr>
        <div>
          <p>&copy; Copyright Front Row Connell Inc</p>
        </div>
  </footer>
    
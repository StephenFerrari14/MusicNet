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
	<?php
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
		oTable = $('#datatable').dataTable( { //Datatable initialization
		"aaData": [
		  [ "Ryan's Opera","3:00", "Front Row", "Ryan^2", 4, 2],
		  [ "Scott Rap","3:00", "Grandma Scott", "Frojee", 5, 20],
		  [ "Steve's Rap","3:00", "Greatest White Rapper", "Steve Ferrari", 5, 25],
		],
		"aoColumns": [
		  { "sTitle": "Song" },
		  { "sTitle": "Duration", "sClass": "center"},
		  { "sTitle": "Album" },
		  { "sTitle": "Artist" },
		  { "sTitle": "Rating", "sClass": "center" },
		  { "sTitle": "Times Played", "sClass": "center"}
		],
		"bFilter":false,
		"bInfo":false,
		"sDom": '<"top">rt<"bottom"><"clear"i>'
		} );


		$( "#signin" ).click(function() { //event for logging in along with button events
			$( "#signin-form" ).dialog({
				height: 300,
				width: 350,
				buttons: {
					"Sign In": function() {
						var username = $("#username").val();
						var password = $("#password").val();
						//retrieve information and php stuff
						if(password == password){
							isSignedIn = true;
							$("#signin").hide();
							$("#logout").show();
							$("#loggedin-user").text(username);
							$("#loggedin-user").show();
							$("#loggedin-user").css("display","inline");
							$( this ).dialog( "close" );
						}
					},
					"Cancel": function() {
						$( this ).dialog( "close" );
					}
				}
			});
			console.log("Clicked");
		});


				
		$("#searchbutton").click(function(){
		});

		<?php
		//Advanced search query algorithm
		$titleInput = isset($_POST['title']) ? $_POST['title'] : '';
		$albumInput = isset($_POST['album']) ? $_POST['album'] : '';
		$artistInput = isset($_POST['artist']) ? $_POST['artist'] : '';
		$artLocInput = isset($_POST['artloc']) ? $_POST['artloc'] : '';
		$yearInput = isset($_POST['year']) ? $_POST['year'] : '';
		$counter = 0;

		//Takes care if title input
		if($titleInput != '' && $counter < 1){
			$titleInput = "AND S.title=" . $titleInput;
			$counter++;
		}
		else if($titleInput != '' && $counter >= 1){
			$titleInput = "AND S.title='" . $titleInput. "'";
			$counter++;
		}
		else{
			$titleInput = '';
		}

		//Takes care of album input
		if($albumInput != '' && $counter < 1){
			$albumInput = "AND Al.album_name=" . $albumInput;
			$counter++;
		}
		else if($albumInput != '' && $counter >= 1){
			$albumInput = "AND Al.album_name='" . $albumInput. "'";
			$counter++;
		}
		else{
			$albumInput = '';
		}

		//Takes care of artist input
		if($artistInput != '' && $counter < 1){
			$artistInput = "Ar.artist_name=" . $artistInput;
			$counter++;
		}
		else if($artistInput != '' && $counter >= 1){
			$artistInput = "AND Ar.artist_name='" . $artistInput. "'";
			$counter++;
		}
		else{
			$artistInput = '';
		}

		//Takes care of artist location input
		if($artLocInput != '' && $counter < 1){
			$artLocInput = "Ar.artist_location=" . $artLocInput;
			$counter++;
		}
		else if($artLocInput != '' && $counter >= 1){
			$artLocInput = "AND Ar.artist_location='" . $artLocInput. "'";
			$counter++;
		}
		else{
			$artLocInput = '';
		}

		//Takes care of year input
		if($yearInput != '' && $counter < 1){
			$yearInput = "S.year=" . $yearInput;
			$counter++;
		}
		else if($yearInput != '' && $counter >= 1){
			$yearInput = "AND S.year='" . $yearInput . "'";
			$counter++;
		}
		else{
			$yearInput = '';
		}

		$query = "SELECT S.title, S.duration, Al.album_name, Ar.artist_name, Ar.artist_location, S.year FROM Songs S, Albums Al, Artists Ar WHERE S.album_id = Al.album_id AND S.artist_id = Ar.artist_id". $titleInput . $albumInput . $artistInput . $artLocInput . $yearInput;
		$result = mysql_query($query);
		$message = "Fine";
		if (!$result)
			$message = "Query failed!";
		$row = mysql_fetch_array($result, MYSQL_NUM);
		?>

		//Impossible error around here, can't figure it out
		var results = <?php echo json_encode($row); ?>;
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
	<!-- User Login -->
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
	
	<!-- Search Modal -->
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
	
	<!-- Rate Modal-->
	<div id="rate-modal" title="Rate this Song" style="display:none">
		<p>Rating: </p>
		<br>
		<div id="rater">
			0<input type="range" name="rating" min="0" max="5">5
		</div>
	</div>
	
	<!-- Nav Menu -->
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
		<div style="margin-top:10px">
						
			<?php
				//Script to use to check for cookies and persistent login
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
          <h3 class="panel">MusicNet is a social network for music enthusiasts, containing a database of songs, artists, etc., and a social network of music enthusiasts. Users of MusicNet can search for songs and artists. They can also rate songs. MusicNet also stores the songs played by the users. They can further be friends with each other based on music interests or other similarities. An online music store can pay to join MusicNet and publish ads that are customized to each user based on her music interest. </h3>
    </div>

	<br>
	
	<!-- html for Datatable init -->
	<div id="datatable-div" style="width:100%">
		<table id="datatable" border="1">
		  <thead>
			<tr>
				<th>Title</th>
				<th>Duration</th>
				<th>Album</th>
				<th>Artist</th>
				<th>Rating</th>
				<th>Timesplayed</th>
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
	
	<!-- "Song Player" placeholder -->
	<div>
		<div>
			<img src="http://placehold.it/250x250&text=Song" />
			Now Playing: <p id="played-song" style="display:inline">Song Description</p>
		</div>
	</div>
	<div id="toolbar" style="margin-top:10px" class="ui-widget-header ui-corner-all">
		<button id="play">play</button>
		<button id="stop">stop</button>
	</div>
</body>
    <!-- Footer -->
 
  <footer>
      <hr>
        <div>
          <p>&copy; Copyright Front Row Connell Inc</p>
        </div>
  </footer>
    
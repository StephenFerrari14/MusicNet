  <!DOCTYPE html>
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
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

    <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">

    <!--<link href="js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="http://cs445.cs.umass.edu/groups/cfr/www/js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css" >
	<!--<script src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>-->
    <!--<script src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>-->
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
	
	 oTable = $('#datatable').dataTable( {
        "aaData": [
          [ "Ryan's Song","3:00", "FR", "Ryan^2", 4, 2],
          [ "Scott's Rap","3:00", "GS", "Rojee", 5, 20],
          [ "Steve's Rap","3:00", "Greatest White Rapper", "Steve", 5, 25]
        ],
        "aoColumns": [
          { "sTitle": "Song" },
          { "sTitle": "Duration(sec)", "sClass": "center"},
          { "sTitle": "Album" },
          { "sTitle": "Artist" },
          { "sTitle": "Rating", "sClass": "center" },
		  { "sTitle": "Times Played", "sClass": "center"}
        ],
		"bFilter":false,
		"bInfo":false,
		"sDom": '<"top">rt<"bottom"><"clear"i>'
      } );
		
	var isSignedIn = false;
	<?php 
		if(isset($_POST["songid"]) && isset($_POST["rating"])){
			$input = $_POST["songid"];
			$rating = $_POST["rating"];
			
		$query = "UPDATE Rate R SET	R.rating = ".$rating." WHERE R.user_id = 'david_kelly6' AND R.song_id = '".$input."';";
		$result = mysql_query($query);
			
		$query = "SELECT S.title, S.duration, Al.album_name, Ar.artist_name, R.rating, P.play_count, S.song_id FROM Songs S, Albums Al, Artists Ar, Rate R, Play P, Users U WHERE U.user_id = 'david_kelly6' AND S.album_id = Al.album_id AND S.artist_id = Ar.artist_id AND S.song_id = R.song_id AND S.song_id = P.song_id AND U.user_id = R.user_id AND U.user_id = P.user_id AND S.song_id='". $input ."'";
		
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_NUM );
		}
	?>
	var results = <?php echo json_encode($row); ?>;
	oTable.fnClearTable();
	oTable.fnAddData(results);
	oTable.fnDraw();
	var songtitle = results[0];
	$("#rate-song").text(songtitle + " has been rated.");
 
	
	$("#play").click(function(){
		console.log("Play");
	});
	
	$("#rate").click(function(){
		console.log("Rate");
		var rateValue = $("#rater").val();
		console.log(rateValue);
	});
	
}); 
	
    function expand(s)
    {
    $("div.menuNormal").show();
    }
    function collapse(s)
    {
    $("div.menuNormal").hide();
    }
    function openOwen(){
        alert("Owen!");
    }
    </script>
    </head>
	<body>
	
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
					  if (isset($_POST["deletecookie"])){
						@setcookie("username", "", time()-3600, "/php-wrapper/stferrar", "cs445.cs.umass.edu");
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
							  @setcookie("username", $name, time()+3600, "/php-wrapper/stferrar", "cs445.cs.umass.edu");
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

	<div id="datatable-div" style="width:100%">
		<table id="datatable" border="1">
		  <thead>
			<tr>
				<th>Title</th>
				<th>Duration(sec)</th>
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
	<p id="rate-song" style="text-align:center"></p>
	<br>
</body>
    <!-- Footer -->
 
  <footer>
      <hr>
        <div>
          <p>&copy; Copyright Front Row Connell Inc</p>
        </div>
  </footer>
    
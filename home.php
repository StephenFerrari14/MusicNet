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
    <script>
    $(document).ready(function(){
	
	
	
	var isSignedIn = false;

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
	
	<div id="rate-modal" title="Rate this Song" style="display:none">
	<p>Rating: </p>
	<br>
	<div id="rater">
		0<input type="range" name="rating" min="0" max="5">5
	</div>
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
			<div style="margin-top:10px">
							
				<?php

				$connection = mysql_connect("cs445sql", "stferrar", "EL440stf");
			  if (!$connection){
				echo "Database connection unsuccessful";
			  }
			  if (!mysql_select_db("cfr")){
				echo "Database selection unsuccessful";
			  }

					  if (isset($_POST["deletecookie"])){
						@setcookie("username", "", time()-3600, "/php-wrapper/cfr", "cs445.cs.umass.edu");
						unset($_COOKIE["username"]);
					  }
					  else if(@$_POST["uid"] && @$_POST["password"]){
						if (@$_POST["uid"] != "" && @$_POST["password"] != ""){
						$connection = mysql_connect("cs445sql", "stferrar", "EL440stf");
						$query = "SELECT Users.user_name, Users.password FROM Users WHERE Users.user_id='" . $_POST["uid"]."'";
						$result = mysql_query($query);
						if (!$result){
						  die("User not found!" . mysql_error());
						}
						else{
						  if ($row = mysql_fetch_array($result)){
							$name = $row[0];
							$pass = $row[1];
							if ($pass == $_POST["password"]){
							  @setcookie("username", $name, time()+3600, "/php-wrapper/cfr", "cs445.cs.umass.edu");
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
          <h3 class="panel">MusicNet is a social network for music enthusiasts. It contains a large database of songs, artists, and albums, as well as provides a medium for friends to share their music interests. Users of MusicNet can search for and rate songs, giving their profile a unique personal twist. </h3>
    </div>

	<br>
	<br>
	<div style="margin-top:10px;text-align:center">
			<form method="POST" action="searchresults.php">
			  <p style="display:inline">Song Search:</p>
			  <input type="search" name="songsearch">
			  <input type="submit" value="Submit">
			</form>
			<div>
			<p>Advanced Search</p>
			<form method="POST" action="advsearchresults.php">
				Song Title: <input type="search" name="title"><br>
				Album: <input type="search" name="album"><br>
				Artist: <input type="search" name="artist"><br>
				Artist Location: <input type="search" name="artloc"><br>
				Year: <input type="search" name="year"><br>
				<input type="submit" value="Submit">
			</form>
			</div>
	</div>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

</body>
    <!-- Footer -->
 
  <footer>
      <hr>
        <div>
          <p>&copy; Copyright Front Row Connell Inc</p>
        </div>
  </footer>
    
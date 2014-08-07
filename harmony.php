  <html>
  <title>
    Harmony
  </title>
    <head>
    <h1 style="margin-bottom:0;background-color:#DCDCDC;"><a href="home.php" style="text-decoration:none;">MusicNet - Harmony</a></h1>
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
	a:visited {color: #000000}
	</style>
    <script>
    $(document).ready(function(){
	
	
		var Q1 = ["What is your favorite season?", "Summer", "Spring", "Fall", "Winter"];
		var Q2 = ["What would you prefer to have right now?", "Steak", "Tacos", "Ice Cream", "I'm not hungry"];
		var Q3 = ["On Friday night, what do you prefer to do?", "Go camping.", "Play video games.", "Watch something on TV.", "Go out with my friends."];
		var Q4 = ["If all your forks were dirty, how would you eat spaghetti?", "With my hands", "Spaghetti is terrible.", "I'd clean my forks before I ate.", "Looks like I'm going out for dinner."];
		var Q5 = ["What is your ideal vacation?", "Staying in a house by a lake.", "Going to the mountains to ski.", "Las Vagas.", "Going somewhere tropical"];
		var Q6 = ["Which one of these things would scare you the most if it was under your bed?", "A burglar.", "I'm not afraid of anything.", "A family of spiders.", "A ghost."];
		var Q7 = ["Which one of these names is your favorite?", "Spud", "Ashley", "Sampson", "Stef"];
		var Q8 = ["What is the best part of the day?", "Anytime I get to eat.", "Getting out of work.", "Pajama Time.", "Waking up."];
		var Q9 = ["How do you feel about sushi?", "I'd rather eat a pine cone.", "Love it.", "Only if it's vegetarian.", "It's alright."];
		var Q10 = ["Which one of these activities do you least enjoy?", "Working out", "Any sport", "Reading", "Fishing"];
		var Q11 = ["What do you look for in a hotel?", "Directions to the nearest campground. Hotels aren't for me.", "Free room service.", "It needs to be classy.", "As long as it's clean, it's fine by me."];
		var Q12 = ["What do you look for when channel surfing?", "Reality TV", "Anything related to cars", "Educational programs", "Sports"];
		var Q13 = ["What is your favorite way to cook?", "Deep fry it!", "On the grill.", "I bake everything.", "I can only use a microwave."];
		var Q14 = ["If your toilet was clogged, what would you do?", "Get in there and unclog it.", "Wait for someone else to fix it.", "Call the plumber.", "I guess it's time to move."];
		var Q15 = ["If you could ride an animal into battle, what would it be?", "A giant frog.", "An oversized wolf.", "A unicorn.", "A noble steed."];

		var questArray = [Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,Q9,Q10,Q11,Q12,Q13,Q14,Q15];
		var displayArray = [0,0,0,0];		
		for(var j, x, i = questArray.length; i; j = Math.floor(Math.random() * i), x = questArray[--i], questArray[i] = questArray[j], questArray[j] = x);
		for(var i; i <= 4; i++){
			displayArray[i] = questArray[i];
		}
		
		$("#questions").append(displayArray[0][0] + '<br><input type="radio" name="qone" value="1"/>'+displayArray[0][1]+'<br><input type="radio" name="qone" value="2"/>'+displayArray[0][2]+'<br><input type="radio" name="qone" value="3"/>'+displayArray[0][3]+'<br><input type="radio" name="qone" value="4"/>'+displayArray[0][4]+'<br>');
		
		$("#questions").append(displayArray[1][0] + '<br><input type="radio" name="qtwo" value="1"/>'+displayArray[1][1]+'<br><input type="radio" name="qtwo" value="2"/>'+displayArray[1][2]+'<br><input type="radio" name="qtwo" value="3"/>'+displayArray[1][3]+'<br><input type="radio" name="qtwo" value="4"/>'+displayArray[1][4]+'<br>');
		
		$("#questions").append(displayArray[2][0] + '<br><input type="radio" name="qthree" value="1"/>'+displayArray[2][1]+'<br><input type="radio" name="qthree" value="2"/>'+displayArray[2][2]+'<br><input type="radio" name="qthree" value="3"/>'+displayArray[2][3]+'<br><input type="radio" name="qthree" value="4"/>'+displayArray[2][4]+'<br>');
		
		$("#questions").append(displayArray[3][0] + '<br><input type="radio" name="qfour" value="1"/>'+displayArray[3][1]+'<br><input type="radio" name="qfour" value="2"/>'+displayArray[3][2]+'<br><input type="radio" name="qfour" value="3"/>'+displayArray[3][3]+'<br><input type="radio" name="qfour" value="4"/>'+displayArray[3][4]+'<br>');
		
		$("#questions").append(displayArray[4][0] + '<br><input type="radio" name="qfive" value="1"/>'+displayArray[4][1]+'<br><input type="radio" name="qfive" value="2"/>'+displayArray[4][2]+'<br><input type="radio" name="qfive" value="3"/>'+displayArray[4][3]+'<br><input type="radio" name="qfive" value="4"/>'+displayArray[4][4]+'<br>');
		
		$("#questions").append('<input type="submit" value="Submit">');
	
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
    <div id="dialog" style="display:none">
    Sign In Modal
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
			<div style="margin-top:10px;display:none">
							
				<?php
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
		</div>
	<br>
  </div>
	<div style="display:inline; width:30%">
          <h3 class="panel">MusicNet is a social network for music enthusiasts. It contains a large database of songs, artists, and albums, as well as provides a medium for friends to share their music interests. Users of MusicNet can search for and rate songs, giving their profile a unique personal twist.</h3>
    </div>

	<br>

	<div id="harmony" style="text-align:center">
		<div style="width:60%;display:inline">
		
			<h3>Hello let me pick a song for you.</h3>
			<img src="http://newsplies.com/wp-content/uploads/2014/01/Scarlett-Johansson-image.jpg" alt="Super Hot" width="460" height="550">
		
		</div>
		
	</div>
	<br>
	<div>
		<form method="POST" action="harmonyresults.php"> 
		<fieldset id="questions">	<legend>Harmony's Questions:</legend>
		</fieldset>
		</form>
	</div>

	<br>
	</body>
	
    <!-- Footer -->
 
  <footer class="row">
      <hr>
		<div>
          <p>&copy; Copyright Front Row Inc</p>
        </div>
  </footer>
    
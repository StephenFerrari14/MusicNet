  <html>
  <title>
    MusicNet
  </title>
    <head>
    <h1 style="margin-bottom:0;background-color:#DCDCDC;"><a href="home.php" style="text-decoration:none;">MusicNet - Admin</a></h1>
    <link rel="icon" type="image/png" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="http://cs445.cs.umass.edu/groups/cfr/www/css/garfCSS.css">

    <script src="http://cs445.cs.umass.edu/groups/cfr/www/js/jQuery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
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
    <script>
    $(document).ready(function(){
	
	//Check if userid is admin
	//If admin then show div
		$("#password-button").click(function(){
			<?php 
				$query = "SELECT Users.password FROM Users WHERE Users.user_id='admin'";
				$result = mysql_query($query);
				if($result){
					$row = mysql_fetch_array($result);
				}
			?>
			var adminpassword = "<?php echo $row[0]; ?>";
			var password = $("#password-entry").val();
			if(password == adminpassword){
				$("#admin-auth").hide();
				$("#admin-query-div").show();
			}
		});

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
  </div>

	<div style="display:inline; width:30%">
          <h3 class="panel">MusicNet is a social network for music enthusiasts. It contains a large database of songs, artists, and albums, as well as provides a medium for friends to share their music interests. Users of MusicNet can search for and rate songs, giving their profile a unique personal twist. </h3>
    </div>
	<!-- Password field -->
	<div id="admin-auth">

		<p>Enter Admin Password:</p>
		<input type="password" id="password-entry">
		<button id="password-button">Submit</button>
		
	</div>
	<!-- Admin Query field -->
	<div id="admin-query-div" style="display:none">
		<form method="post" action="admin.php" id="queryform">
			<input type="hidden" value="0" name="isadmin" id="isAdmin">
			<input type="submit" value="Submit Query">
		</form>
		<textarea id="admin-query-input" name="admin-query" form="queryform" rows="10" cols="100"></textarea>
	</div>
	<br>

		<div id="queryresults">
		<?php
		//php that opens a connection then passes a sql query to the database and returns the results
		$connection = mysql_connect("cs445sql", "stferrar", "EL440stf");
			  if (!$connection){
				echo "Database connection unsuccessful";
			  }
			  if (!mysql_select_db("cfr")){
				echo "Database selection unsuccessful";
			  }
			if(isset($_POST["admin-query"])){
				$input = $_POST["admin-query"];
				$query = $input;
				$result = mysql_query($query);
				if($result){
					$rows = array();
					$count = 0;
					while($row = mysql_fetch_row($result)){
						array_push($rows,$row);
					}
					for($x = 0;$x < count($rows);$x++){
						for($y = 0;$y < mysql_num_fields($result);$y++){
							echo $rows[$x][$y].", ";
						}
						echo "<br><br>";
					}
				}
				else{
					echo "Query Failed!";
				}
			
		}
		?>
		</div>
  <br>
 
    <!-- Footer -->
 
  <footer>
      <hr>
        <div>
          <p>&copy; Copyright Front Row Connell Inc</p>
        </div>
  </footer>
    
<?php
// Turn on error reporting
ini_set('display_errors', 'On');
// Connect to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","doddp-db","xuOdjRlLARQY0zei","doddp-db");
if ($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Star Wars Planets</title>
	<style>
		ul{
			list-style-type: none;
			padding: 0;
			overflow: hidden;
		}
		li {
			float: left;
		}
		li a{
			text-align: center;
			padding: 10px;
		}
	</style>
</head>
<body>
	<h1>Star Wars Database</h1>
	<div>
		<table>
			<tr>
				<td><b>Planets</td>
			</tr>
		</table>
	</div>
	<ul>
		<li><a href="planets.php">Planets</a></li>
		<li><a href="people.php">People</a></li>
		<li><a href="ships.php">Ships</a></li>
		<li><a href="alliances.php">Alliances</a></li>
	</ul>
	<div>
		<p>List of Current Planets
			<select>
				<?php
					if(!($stmt = $mysqli->prepare("SELECT id, pname FROM planets"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
				
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
				
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
				
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
				
					$stmt->close();
				?>	
			</select>
		</p>
		<form method="post" action="addplanet.php">
		<td><b>Add Planet to Database<br><br></td>
			<fieldset>
				<legend>Planet Info</legend>
				<p>Name: <input type="text" name="pname"/></p>
				<p>Primary Language: <input type="text" name="lang"/></p>
				<p>Population: <input type="number" name="population"/></p>
			</fieldset>
			<p><input type="submit" value="Add Planet to Database"/></p>
		</form>
	</div>
</body>
</html>
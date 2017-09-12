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
	<title>Star Wars Ships</title>
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
			<td><b>Ships</td>
		</tr>
	</table>
</div>
	<ul>
		<li><a href="planets.php">Planets</a></li>
		<li><a href="people.php">People</a></li>
		<li><a href="ships.php">Ships</a></li>
		<li><a href="alliances.php">Alliances</a></li>
	</ul>
	
	<p>List of Current Ships
			<select>
				<?php
					if(!($stmt = $mysqli->prepare("SELECT id, sname FROM ships"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
				
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
				
					if(!$stmt->bind_result($id, $sname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
				
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $sname . '</option>\n';
					}
				
					$stmt->close();
				?>	
			</select>
		</p>
	
	<div>
		<form method="post" action="addship.php">
		<td><b>Add A Ship to Database<br><br></td>
			<fieldset>
				<legend>Ship Info</legend>
				<p>Alliance:
				<select name="aid">
					<?php
						if(!($stmt = $mysqli->prepare("SELECT id, title FROM alliance"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
					
						if(!$stmt->execute()){
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
					
						if(!$stmt->bind_result($id, $title)){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
					
						while($stmt->fetch()){
							echo '<option value=" '. $id . ' "> ' . $title . '</option>\n';
						}
					
						$stmt->close();
					?>					
				</select>
				</p>
				<p>Name: <input type="text" name="sname"/></p>
				<p>Description: <input type="text" name="description"/></p>
			</fieldset>
			<p><input type="submit" value="Add Ship to Database"/></p>
		</form>
	</div>
</body>
</html>
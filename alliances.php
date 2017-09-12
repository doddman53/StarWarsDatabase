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
		<title>Star Wars Alliances</title>
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
						<td><b>Alliances<br></td>
					</tr>
				</table>
			</div>
		<ul>
			<li><a href="planets.php">Planets</a></li>
			<li><a href="people.php">People</a></li>
			<li><a href="ships.php">Ships</a></li>
			<li><a href="alliances.php">Alliances</a></li>
		</ul>

		<p>List of Current Alliances
			<select>
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
		<form method="post" action="addalliance.php">
			<td><b>Add An Alliance to Database<br><br></td>
			<fieldset>
				<legend>Alliance</legend>
					<p>Name: <input type="text" name="aname"/>
			</fieldset>
			<p><input type="submit" value="Add Alliance to Database"/></p>
		</form>
	</body>
</html>
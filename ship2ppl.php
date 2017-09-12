<?php
// Turn on error reporting
ini_set('display_errors', 'On');
// Connect to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","doddp-db","xuOdjRlLARQY0zei","doddp-db");
?>

<!DOCTYPE html>
<html>
<body>
<div>
	<table>
		<tr>
			<td>All Ships Particular Person Serves On</td>
		</tr>
		<tr>
			<td><b>First Name</td>
			<td><b>Last Name</td>
			<td><b>Age</td>
			<td><b>Race</td>
			<td><b>Alliance</td>
			<td><b>Homeworld</td>
			<td><b>Serves On</td>
		</tr>
		<?php
		if(!($stmt = $mysqli->prepare("SELECT people.fname, people.lname, people.age, people.race, alliance.title, planets.pname, ships.sname FROM ships_people INNER JOIN people ON ships_people.pid = people.id INNER JOIN alliance ON people.aid = alliance.id INNER JOIN planets ON people.homeworld = planets.id INNER JOIN ships ON ships_people.sid = ships.id WHERE people.id = ?"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!($stmt->bind_param("i",$_POST['PeopleFilter']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($fname, $lname, $age, $race, $title, $pname, $sname)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
		 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $age . "\n</td>\n<td>\n" . $race . "\n</td>\n<td>\n" . $title . "\n</td>\n<td>\n" . $pname . "\n</td>\n<td>\n" . $sname . "\n</td>\n</tr>";
		}
		$stmt->close();
		?>
	</table>
</div>

</body>
</html>
<br><br><a href="people.php">Filter by a different person<br></a>
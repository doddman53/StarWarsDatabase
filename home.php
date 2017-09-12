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
				<td><b>Welcome!!</td>
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
		<p>
			Welcome to the Star Wars Database! <a href="planets.php">Click Here</a> to begin.  Have fun!
	</div>
</body>
</html>
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
	<title>Star Wars People</title>
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
				<td><b>People</td>
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
		
		<p>List of Current People
			<select>
				<?php
					if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM people"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
				
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
				
					if(!$stmt->bind_result($id, $fname, $lname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
				
					while($stmt->fetch()){
						echo '<option value=" '. $id . ' "> ' . $fname . " " . $lname . '</option>\n';
					}
				
					$stmt->close();
				?>	
			</select>
		</p>
		
			<form method="post" action="addperson.php">
			<td><b>Add Person to Database<br><br></td>
			<fieldset>
				<legend>Name</legend>
				<p>First Name: <input type="text" name="FirstName"/></p>
				<p>Last Name: <input type="text" name="LastName"/></p>
			</fieldset>
			<fieldset>
				<legend>Race</legend>
					<p>Race: <input type="text" name="Race"/></p>
			</fieldset>
			<fieldset>
				<legend>Homeworld</legend>
				<select name="Homeworld">
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
			</fieldset>
			<fieldset>
				<legend>Age</legend>
				<p>Age: <input type="text" name="Age"/></p>
			</fieldset>
			
			<fieldset>
				<legend>Alliance Affiliation</legend>
				<select name="Alliance">
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
			</fieldset>
			<p><input type="submit" value="Add Person to Database"></p>
			</form>
		</div>
			
		<div>
			<td><b>Assign People to Ships (Many to Many Relationship)<br><br></td>
			<form method="post" action="addship_person.php">
				<fieldset>
					<legend>Ships</legend>
					<select name="Ship">
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
								echo '<option value=" '. $id . ' "> ' . $sname . '</option><br>';
							}
						
							$stmt->close();
						?>					
					</select>
				</fieldset>
			
				<fieldset>
					<legend>People</legend>
					<select name="Person">
						<?php
							if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM people"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}
						
							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
						
							if(!$stmt->bind_result($id, $fname, $lname)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
						
							while($stmt->fetch()){
								echo '<option value=" '. $id . ' "> ' . $fname . " " . $lname . '</option>\n';
							}
						
							$stmt->close();
						?>					
					</select>
				</fieldset>
			
			
			<p><input type="submit" value="Add Relationship to Database"></p>
			</form>
		</div>
		
		<div>
			<form method="post" action="ppl2ship.php">
				<fieldset>
					<legend>Display People For Particular Ship</legend>
					<select name="ShipFilter">
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
							echo '<option value=" '. $id . ' "> ' . $sname . '</option><br>';
						}
					
						$stmt->close();
						?>
					</select>
				</fieldset>
				<p><input type="submit" value="Filter by Ship"></p>
			</form>
		</div>
		
		<div>
			<form method="post" action="ship2ppl.php">
				<fieldset>
					<legend>Display Ships Particular Person Serves On</legend>
					<select name="PeopleFilter">
					<?php
						if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM people"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
					
						if(!$stmt->execute()){
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
					
						if(!$stmt->bind_result($id, $fname, $lname)){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
					
						while($stmt->fetch()){
							echo '<option value=" '. $id . ' "> ' . $fname . " " . $lname . '</option><br>';
						}
					
						$stmt->close();
						?>
					</select>
				</fieldset>
				<p><input type="submit" value="Filter by Person"></p>
			</form>
		</div>
		
		<div>
			<form method="post" action="deletePerson.php">
				<fieldset>
					<legend>Remove a Person From Database?</legend>
					<select name="DeletePerson">
					<?php
						if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM people"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
					
						if(!$stmt->execute()){
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
					
						if(!$stmt->bind_result($id, $fname, $lname)){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
					
						while($stmt->fetch()){
							echo '<option value=" '. $id . ' "> ' . $fname . " " . $lname . '</option><br>';
						}
					
						$stmt->close();
						?>
					</select>
				</fieldset>
				<p><input type="submit" value="Remove Person"></p>
			</form>
		</div>
		
	</body>
</html>
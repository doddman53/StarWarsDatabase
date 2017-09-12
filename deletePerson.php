<?php
// Turn on error reporting
ini_set('display_errors', 'On');
// Connect to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","doddp-db","xuOdjRlLARQY0zei","doddp-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("DELETE FROM people WHERE people.id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['DeletePerson']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Removed " . $stmt->affected_rows . " rows from people.";
}
?>
<br><br><a href="people.php">Remove another person<br></a>
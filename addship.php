<?php
// Turn on error reporting
ini_set('display_errors', 'On');
// Connect to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","doddp-db","xuOdjRlLARQY0zei","doddp-db");

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("INSERT INTO ships(aid, sname, description) VALUES(?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("iss",$_POST['aid'],$_POST['sname'],$_POST['description']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to ships.";
}
?>
<br><br><a href="ships.php">Add another ship<br></a>
<?php
require_once ("../db-connect.php");
$sql="SELECT account, name, email FROM users WHERE account LIKE '%ja%'";
$result=$conn->query($sql);
$resultCount=$result->num_rows;

if($resultCount>0) {
    while ($row = $result->fetch_assoc()) {
        var_dump($row);
        echo "<br>";
    }
}

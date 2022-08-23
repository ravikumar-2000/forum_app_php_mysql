<?php 

define('DB_HOST', 'localhost');
define('DB_NAME', 'forum');
define('DB_USER', 'ravikumar');
define('DB_PASS', 'ravi2000');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// if($conn -> connect_error) {
//     die('Connection Failed ' . $conn -> connect_error);
// } else {
//     echo '<h6 style="color: green;">CONNECTED</h6>';
// }

?>
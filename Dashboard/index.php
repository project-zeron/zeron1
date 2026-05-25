//get message and echo it if it exists
<?php
if (isset($_GET['message'])) {
    $message=$_GET['message'];
}

echo $message;

?>
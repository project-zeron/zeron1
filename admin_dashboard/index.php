
<?php
//get message and echo it if it exists
$message = $_GET['message'] ?? '';

if ($message !== '') {

    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    
    echo $safeMessage;

}
?>

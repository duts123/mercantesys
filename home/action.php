<?php
$location = "https://web.sympies.net/SendMailSubs?recadd=".$_POST['email'];
header('Location: '.$location);
     exit();
?>
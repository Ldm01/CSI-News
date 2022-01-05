<?php
require 'connectDb.php';

$response = $db->prepare('CALL devAboConf()');
$response->execute();
header('Location: admin.php');
exit();
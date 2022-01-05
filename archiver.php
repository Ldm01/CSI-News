<?php
require 'connectDb.php';

$response = $db->prepare('CALL archiver()');
$response->execute();
header('Location: admin.php');
exit();
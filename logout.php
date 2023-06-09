<?php

require_once("db_connection.php");
session_unset();
session_destroy();
header("location:Login.php");
?>
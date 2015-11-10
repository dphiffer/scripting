<?php

$_SESSION['username'] = null;
session_destroy();
echo "You are logged out.";

?>

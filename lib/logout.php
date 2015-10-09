<?php

require_once dirname(__DIR__) . '/config.php';

session_start();
unset($_SESSION['github']);
session_destroy();

header("Location: $base_path");

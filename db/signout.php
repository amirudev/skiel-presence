<?php
session_start();

$_SESSION['user'] = array();
header('Location: ../signin.php');
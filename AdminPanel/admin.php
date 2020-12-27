<?php
session_start();
require('connection.php');

if ($_SESSION['admin'] == 1){
    header('Location:admin.php');
}

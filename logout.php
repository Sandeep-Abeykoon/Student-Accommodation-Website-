<?php
include 'admin/essentials.php';

session_start();
session_destroy();
redirect("index.php")
?>
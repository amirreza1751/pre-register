<?php
require_once('main.php');
session_destroy();
//global $post;
//$post['create'] = false;
header("Location: login.php");

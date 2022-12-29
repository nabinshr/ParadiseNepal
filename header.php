<?php
require_once 'init.php';
require_once 'database.php';
require_once 'helper.php';
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Paradise Nepal
    </title>
    <link rel="stylesheet" href="<?=ASSET . "css/bootstrap.min.css"?>">
    <link rel="stylesheet" href="<?=ASSET . "css/styleparadisenepal.css"?>" type="text/css">
    <script type="text/javascript" src="<?=ASSET . "js/jquery.js"?>"></script>
    <script type="text/javascript" src="<?=ASSET . "js/bootstrap.min.js"?>"></script>


</head>

<body class="body">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img alt="Brand" src="<?=ASSET . "images/app/logo.png"?>" height="50px;">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Things to do</a></li>
                    <li><a href="planyourtrip.php">Plan your trip</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- <div class="navbar-header">

        <a href="#" class="navbar-brand">
            <img src="img/logolen.jpg" height="850%" width="102%"></a>
    </div> -->
    <!--navbar-header-->

    <!-- <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="#active">Home</a></li>
            <li><a href="#section-aboutus">About Us</a></li>
            <li><a href="#section-things-to-do">Things to do</a></li>
            <li><a href="#section-gallery">Gallery</a></li>
            <li><a href="#section-FAQs">FAQs</a></li>
            <li><a href="#section-planning-to-do">Planning to do</a></li>
            <li><a href="#section-contact">Contact</a></li>
            <li><a href="#section-abc">abc</a></li>

        </ul>
    </div>  -->
    <!-- end collapse -->
    <!--banner-->

    <div class="container">
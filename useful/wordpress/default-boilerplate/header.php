<?php
  // if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
  // header('Cache-Control: max-age=259200');
  // header('Accept-Encoding: gzip, deflate');
  // For performance
DEFINE( 'TEMPLATE_URL', get_template_directory_uri() );
DEFINE( 'SITE_URL', home_url() );
// DEFINE( 'LAZY_IMG', TEMPLATE_URL.'/images/lazy.png' );
?><!doctype html>
<!--[if lt IE 7]>       <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>          <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>          <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">
  <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo TEMPLATE_URL; ?>/favicon.ico"/>
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo TEMPLATE_URL; ?>/favicon.ico"/>
  <meta name="author" content="Guilherme Budnieswski - Agencia Planos"/>

  <title>Document</title>

  <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/css/normalize.css">
  <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/css/boilerplate.css">
  <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/css/main.css">
  <script src="<?php echo TEMPLATE_URL; ?>/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
<!--[if lt IE 7]>
  <p class="chromeframe">
    You are using an <strong>outdated</strong> browser.
    Please <a href="http://browsehappy.com/">upgrade your browser</a> or
    <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a>
    to improve your experience.
  </p>
<![endif]-->

<div id="wrapper">
  
  <div id="header">
    //
  </div> <!-- e#header -->

  <div id="content">


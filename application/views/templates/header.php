<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $title; ?></title>

  <?php
    $this->load->view('components/css');
  ?>
  

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

  	<?php
	    $this->load->view('components/main_menu');
	    $this->load->view('components/mobile_menu');
	 ?>
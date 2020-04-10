<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>File Tracker</title>
  <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">File Tracker</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">

    </ul>
		<ul class="navbar-nav ml-auto">
		<?php echo anchor('admin/logout', 'Logout', 'class="nav-link"') ?>
		</ul>
  </div>
</nav>

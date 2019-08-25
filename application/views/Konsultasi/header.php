<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>.: SISTEM PAKAR :.</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<!-- icon -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/all.css">
	<!-- custom -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">

</head>
<body class="d-flex flex-column bg-transparent">
	<header class="header col-auto bg-transparent">

		<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
	    <div class="container">

	      <a class="navbar-brand text-uppercase" href="<?php echo base_url() ?>">sistem pakar</a>

	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#HeaderContent" aria-controls="HeaderContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-bars fa-lg"></i>
	      </button>

	      <div class="collapse navbar-collapse" id="HeaderContent">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item">
							<a href="<?php echo base_url() ?>" class="nav-link">home</a>
						</li>

	          <li class="nav-item active">
							<a href="<?php echo base_url('Konsultasi') ?>" class="nav-link">konsultasi <span class="sr-only">(current)</span></a>
						</li>
	          <li class="nav-item">
							<a href="<?php echo base_url('Informasi') ?>" class="nav-link">informasi</a>
						</li>
	        </ul>
	      </div>
		  </div>
	  </nav>

	</header>

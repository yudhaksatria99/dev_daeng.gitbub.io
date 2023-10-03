<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= ucfirst($active) ?></title>
	<link href="<?= base_url() . 'assets/' ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/datepicker3.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/styles.css" rel="stylesheet">
	<link href="<?= base_url() . 'assets/' ?>css/bootstrap-table.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url(); ?>assets\images\logo.png" type="image/x-icon">
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="<?= base_url() . 'assets/' ?>js/html5shiv.js"></script>
	<script src="<?= base_url() . 'assets/' ?>js/respond.min.js"></script>
	<![endif]-->
	<script src="<?= base_url() . 'assets/' ?>js/jquery-1.11.1.min.js"></script>

</head>

<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>ProTRac</span> CMS</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">

			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?= $admin->nama ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span><?= $admin->jabatan ?></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		<ul class="nav menu">

			<li class="<?= $active == 'dashboard' ? 'active' : '' ?>"><a href="<?= base_url() ?>"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<?php if ($admin->jabatan == 'SUPERUSER') { ?>

				<li class="parent "><a data-toggle="collapse" href="#sub-item-list">
						<em class="fa fa-navicon">&nbsp;</em> Check List <span data-toggle="collapse" href="#sub-item-list" class="icon pull-right"><em class="fa fa-plus"></em></span>
					</a>
					<ul class="children <?= in_array($active, array('departement', 'rekomendasi', 'informasi', 'group', 'category', 'item', 'reason')) ? '' : 'collapse' ?>" id="sub-item-list">
						<li><a class="<?= $active == 'departement' ? 'active' : '' ?>" href="<?= base_url('Departement') ?>">
								<span class="fa fa-user-circle">&nbsp;</span> Departement
							</a></li>
						<li><a class="<?= $active == 'category' ? 'active' : '' ?>" href="<?= base_url('ListCategory') ?>">
								<span class="fa fa-columns">&nbsp;</span> Category
							</a></li>
						<li><a class="<?= $active == 'rekomendasi' ? 'active' : '' ?>" href="<?= base_url('Rekomendasi') ?>">
								<span class="fa fa-volume-up">&nbsp;</span> Rekomendasi
							</a></li>
						<li><a class="<?= $active == 'informasi' ? 'active' : '' ?>" href="<?= base_url('Informasi') ?>">
								<span class="fa fa-book">&nbsp;</span> Sumber Informasi
							</a></li>
						<li><a class="<?= $active == 'group' ? 'active' : '' ?>" href="<?= base_url('ListGroup') ?>">
								<span class="fa fa-files-o">&nbsp;</span> Group
							</a></li>
						<li><a class="<?= $active == 'reason' ? 'active' : '' ?>" href="<?= base_url('Reason') ?>">
								<span class="fa fa-question-circle">&nbsp;</span> Schedule Reason
							</a></li>

					</ul>
				</li>

				<li class="<?= $active == 'banner' ? 'active' : '' ?>"><a href="<?= base_url('Banner') ?>"><em class="fa fa-photo">&nbsp;</em> Banner</a></li>

				<li class="<?= $active == 'jenis report' ? 'active' : '' ?>"><a href="<?= base_url('JenisReport') ?>"><em class="fa fa-bar-chart">&nbsp;</em> Jenis Report</a></li>

				<li class="<?= $active == 'user' ? 'active' : '' ?>"><a href="<?= base_url('User') ?>"><em class="fa fa-user">&nbsp;</em> User</a></li>

				<li class="<?= $active == 'otherapp' ? 'active' : '' ?>"><a href="<?= base_url('Otherapp') ?>"><em class="fa fa-link">&nbsp;</em> DSS</a></li>

				<li class="<?= $active == 'administrator' ? 'active' : '' ?>"><a href="<?= base_url('Administrator') ?>"><em class="fa fa-cogs">&nbsp;</em> Administrator</a></li>

			<?php } ?>

			<li><a href="<?= base_url('Dashboard/logout') ?>"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div>
	<!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?= base_url() ?>">
						<em class="fa fa-home"></em>
					</a></li>
				<li class="active"><?= $this->uri->segment(2) != null ? $this->uri->segment(2) : $this->uri->segment(1) ?></li>
			</ol>
		</div>
		<!--/.row-->
<!DOCTYPE html>
<html lang='cs'>

<head>

  <title>EventFusion</title>
  <meta charset='utf-8' />
  
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/util.css'); ?>">

  <link rel="icon" href="<?= base_url('/eventfussion.png'); ?>">

</head>
</head>

<body>

  <?php $this->renderSection('content'); ?>

  <script src="<?= base_url('/assets/js/jquery.js?v='.time()); ?>"></script>
  <script src="<?= base_url('/assets/js/popper.min.js?v='.time()); ?>"></script>
  <script src="<?= base_url('/assets/js/bootstrap.min.js?v='.time()); ?>"></script>
  <script src="<?= base_url('/assets/js/jquery.validate.min.js?v='.time()); ?>"></script>
  <script src="<?= base_url('/assets/js/login.js?v='.time()); ?>"></script>
  <script src="<?= base_url('/assets/js/custom.js?v='.time()); ?>"></script>
</body>
</html>
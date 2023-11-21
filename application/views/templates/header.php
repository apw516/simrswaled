<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?= base_url('assets/img/logo_rs.png'); ?>">
  <title><?= $title; ?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url().'assets/css/jquery-ui.css'?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css');?>">

  <link href="<?= base_url('assets/css/datepicker.css');?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url().'assets/css/bootstrap-datetimepicker.css'?>">
  <link rel="stylesheet" href="<?= base_url().'assets/css/bootstrap-datetimepicker.min.css'?>">
  <style type="text/css">
.preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background-color: #fff;
  opacity: 0.9;
}
.preloader .loading {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  font: 14px arial;
}
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="preloader">
  <div class="loading">
    <img src="<?= base_url('assets/assets/img/loading_big.gif');?>" width="80">
    <p>Harap Tunggu</p>
  </div>
</div>

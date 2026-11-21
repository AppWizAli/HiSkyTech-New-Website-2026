<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "config/db.php";
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Admin Panel — Smooth Animated Dashboard</title>
 <?php include 'partials/css.php'; ?> <!-- Sidebar -->
</head>
<body><div class="overlay" id="overlay"></div>
<?php include 'partials/preloader.php'; ?> <!-- Sidebar -->
<div class="app">
 <?php include 'partials/sidebar.php'; ?> <!-- Sidebar -->

    <!-- Main content -->
    <div class="main">
   <?php include 'partials/head.php'; ?> <!-- Sidebar -->
        <div class="container-fluid top-container">
            <!-- Font Awesome CDN -->


<header class="main-dashboard-header mt-3">
  <div class="header-content">
    <i class="fas fa-tachometer-alt header-icon"></i>
    <div>
      <h1 class="header-title">Dash Overview</h1>
      <p class="header-subtitle">Welcome back, here’s what’s happening today</p>
    </div>
  </div>
</header>

<!-- Stats Section -->
<div class="row g-4 mt-3">

  <!-- CLIENTS -->
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="stat-card text-white bg-sales p-4 rounded-3 position-relative overflow-hidden">
      <div class="stat-label">Total Clients</div>
      <div class="stat-value">85</div>
      <div class="icon-wrap position-absolute top-0 end-0 m-3">
        <i class="fas fa-users fa-2x"></i>
      </div>
    </div>
  </div>

  <!-- PROJECTS -->
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="stat-card text-white bg-purchase p-4 rounded-3 position-relative overflow-hidden">
      <div class="stat-label">Projects Completed</div>
      <div class="stat-value">45</div>
      <div class="icon-wrap position-absolute top-0 end-0 m-3">
        <i class="fas fa-check-circle fa-2x"></i>
      </div>
    </div>
  </div>

  <!-- TEAM MEMBERS -->
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="stat-card text-white bg-profit p-4 rounded-3 position-relative overflow-hidden">
      <div class="stat-label">Team Members</div>
      <div class="stat-value">12</div>
      <div class="icon-wrap position-absolute top-0 end-0 m-3">
        <i class="fas fa-user-tie fa-2x"></i>
      </div>
    </div>
  </div>

  <!-- AWARDS -->
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="stat-card text-white bg-products p-4 rounded-3 position-relative overflow-hidden">
      <div class="stat-label">Awards Won</div>
      <div class="stat-value">8</div>
      <div class="icon-wrap position-absolute top-0 end-0 m-3">
        <i class="fas fa-trophy fa-2x"></i>
      </div>
    </div>
  </div>

</div>


</body>
</html>

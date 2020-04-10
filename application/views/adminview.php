<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin DashBoard</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" />

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Welcome <?php echo $this->session->userdata('username') ?></h3>
            </div>


            <ul class="list-unstyled components">
                <p>ID:  <?php echo $this->session->userdata('email') ?></p>
                <li>
                    <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Users</a>
                    <ul class="collapse list-unstyled" id="userSubmenu">
                      <li>
                        <?php echo anchor('admin/addUser', 'Add User', 'class="nav-link"') ?>
                      </li>

                        <li>
                            <?php echo anchor('admin/userList', 'View Users', 'class="nav-link"') ?>
                        </li>

                        <li>
                          <?php echo anchor('admin/userPermissionList', 'Set User Permissions', 'class="nav-link"') ?>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Departments</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                      <li>
                        <?php echo anchor('admin/newDept', 'Add Department', 'class="nav-link"') ?>
                      </li>
                      <li>
                        <?php echo anchor('admin/departmentList', 'View Departments', 'class="nav-link"') ?>
                      </li>
                      <li>
                        <?php echo anchor('admin/SetUsersPermissions', 'Set Department Permissions', 'class="nav-link"') ?>
                      </li>

                    </ul>
                </li>


                <li>
                  <?php echo anchor('admin/checkFileStatus', 'Check File Status', 'class="nav-link"') ?>
                </li>
                <li>
                  <?php echo anchor('admin/generateReports', 'Generate Report', 'class="nav-link"') ?>
                </li>


            </ul>


        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>MENU</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">

                            <li class="nav-item">
                              <?php echo anchor('admin/logout', 'Logout', 'class="nav-link"') ?>

                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
    </li>

  </ul>
  <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active show" id="home">
    <h1>Home Page</h1>
    </div>
    <div class="tab-pane fade" id="profile">
      <h1>Other Page</h1>
    </div>
    </div>
    <div class="line"></div>

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>

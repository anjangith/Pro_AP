<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User DashBoard</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" />
    <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
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
                <hr>
                <h5> <?php echo $this->session->userdata('d_name') ?></h5>
            </div>

            <ul class="list-unstyled components">
                <p>ID:  <?php echo $this->session->userdata('email')?> </p>
                <hr>
                <li>
                  <?php echo anchor('user/myTickets', 'My Tickets', 'class="nav-link"') ?>
                </li>
                <li>
                  <?php echo anchor('user/inbox', 'Inbox', 'class="nav-link"') ?>
                </li>


            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                  <?php echo anchor('user/forward', 'Forward New Ticket', 'class="nav-link download"') ?>
                </li>
                <li>
                  <?php echo anchor('user/endorse', 'Endorse New Ticket', 'class="nav-link download"') ?>
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
            <?php if($error = $this->session->flashdata('message')):?>
              <div class="row mt-2 mb-3">
                  <div class="col-md-6">
                    <div class="alert alert-dismissible alert-success">
                      <?php echo $error ?>
                    </div>
                  </div>
              </div>
            <?php endif; ?>
<!--- Homepage content starts from here ----->
<h1 class="display-5 text-info">Notifications<span class="badge badge-info"><div id="badgecount">0</div></span><button type="button" class="btn btn-outline-dark ml-3">Clear</button>
</h1>
<hr>
<div id="notification">
  <div class="alert alert-primary" role="alert">
    No Notifications!
  </div>
</div>

      </div>
  </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

            setInterval(function() {
              $.ajax({
                url: '<?php echo site_url('user/loadNot'); ?>',
                type: 'POST',
                data: {d_id: '<?php echo $this->session->userdata('d_id'); ?>'},
                success: function(data) {
                    var newdata = $.parseJSON(data);
                   if(newdata == null){
                      var codeBlock = ' <div class="alert alert-primary" role="alert">'+
                      'No Notifications!' +'</div>';
                                   $("#notification").html(codeBlock);
                                   $("#badgecount").html('0');

                    }else{
                      var codeBlock='<div>';
                      $.each(newdata['result'], function(i, item) {
                       codeBlock += ' <div class="alert alert-primary" role="alert">'+
                        item.description +'</div>';
                        codeBlock+='</div>'
                      $("#notification").html(codeBlock);
                      });
                      $("#badgecount").html(newdata['count']);

                    }

                }
            });
          }, 2000);
        });
    </script>
</body>
</html>

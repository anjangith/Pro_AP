<?php include("inc/header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-5 display-3">
  FILE
  <small class="text-muted">TRACKER SYSTEM</small>
</h1>
    </div>
    <div class="col-5">
      <div class="col">
        <div id="container" class="mt-5">
          <fieldset>
          <legend class="ml-4">LOGIN</legend>
          <?php echo form_open("homepage/signin", ['class' => 'form-horizontal']); ?>
          <?php if($error = $this->session->flashdata('message')):?>
            <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-dismissible alert-danger">
                    <?php echo $error ?>
                  </div>
                </div>
            </div>
          <?php endif; ?>
        <div class="row">
        <div class="col-md-12">
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-12">
            <?php echo form_input(['name' => 'email','class'=>'form-control','placeholder'=>'as273863@gmail.com','value'=>set_value('user_name')]); ?>
          </div>
        </div>
        </div>
        </div>
        <div class="col-md-6">
          <?php echo form_error('email','<div class="text-danger">','</div>');
          ?>
        </div>

        <div class="row">
        <div class="col-md-12">
        <div class="form-group">
          <label class="col-md-12 control-label">Password</label>
          <div class="col-md-12">
            <?php echo form_password(['name' => 'password','class'=>'form-control','placeholder'=>'Password']); ?>
          </div>
        </div>
        </div>
        </div>
        <div class="col-md-12">
          <?php echo form_error('password','<div class="text-danger">','</div>');
          ?>
        </div>

        </div>
        <button type="submit" class="btn btn-success ml-3">Login</button>
      </fieldset>
        <div>
        <?php echo form_close(); ?>
        </div>
      </div>
    </div>
    <div class="col">
<p class="lead mt-5">In present situation in any organization file work is mandatory, so every time moving files from one department other department or from one branch to other branch manually is some what difficult. To avoid this problem and to to communicate each and every branch, each and every department we are going to introduce online “File tracking system”.</p>
    </div>
  </div>
</diV>

<?php include("inc/footer.php"); ?>

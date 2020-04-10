<?php include("inc/loginheader.php"); ?>
<div id="container">
	<?php echo form_open("admin/createNewUser", ['class' => 'form-horizontal']); ?>
	<?php echo anchor("admin/adminpage","GO BACK",['class'=>'btn btn-outline-danger btn-lg ml-3 mt-3']); ?>

	<h1 class="display-1 ml-5 mt-3 mb-5">Add User</h1>
	<?php if($error = $this->session->flashdata('message')):?>
		<div class="row mt-2 mb-1">
				<div class="col-md-6">
					<div class="alert alert-dismissible alert-success">
						<?php echo $error ?>
					</div>
				</div>
		</div>
	<?php endif; ?>
<div class="ml-3">
<div class="row">
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 ml-3 control-label">Name</label>
	<div class="col-md-9">
		<?php echo form_input(['name' => 'name','class'=>'form-control','placeholder'=>'Nick124','value'=>set_value('studentname')]); ?>
	</div>
</div>
</div>
</div>
<div class="col-md-6">
	<?php echo form_error('name','<div class="alert alert-dismissible alert-danger ml-3">','</div>');
	?>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 ml-3 control-label">Email or ID</label>
	<div class="col-md-9">
		<?php echo form_input(['name' => 'email','class'=>'form-control','placeholder'=>'as273863@gmail.com','value'=>set_value('user_name')]); ?>
	</div>
</div>
</div>
</div>
<div class="col-md-6">
	<?php echo form_error('email','<div class="alert alert-dismissible alert-danger ml-3">','</div>');
	?>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 ml-3 control-label">Role</label>
	<select class="col-md-9 ml-3" name="role_id">
			<option value="">Select</option>
			<?php if(count($roles)):?>
				<?php foreach($roles as $role):?>
						<option value=<?php echo $role->id?>><?php echo $role->rolename?></option>
				<?php endforeach; ?>
				<?php endif;?>
	</select>
</div>
</div>
</div>
<div class="col-md-6">
	<?php echo form_error('role_id','<div class="alert alert-dismissible alert-danger ml-3">','</div>');
	?>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 ml-3 control-label">Department</label>
	<select class="col-md-9 ml-3" name="college_id">
			<option value="">Select</option>
			<?php if(count($depts)):?>
				<?php foreach($depts as $dept):?>
						<option value=<?php echo $dept->d_id?>><?php echo $dept->d_name?></option>
				<?php endforeach; ?>
				<?php endif;?>
	</select>
</div>
</div>
</div>
<div class="col-md-6">
	<?php echo form_error('college_id','<div class="alert alert-dismissible alert-danger ml-3">','</div>');
	?>
</div>


<div class="row">
<div class="col-md-9">
<dicv class="form-group">
	<label class="col-md-6 control-label">Password</label>
	<div class="col-md-6">
		<?php echo form_password(['name' => 'password','class'=>'form-control','placeholder'=>'Password']); ?>
	</div>
</div>
</div>
<div class="col-md-12">
	<?php echo form_error('password','<div class="alert alert-dismissible alert-danger">','</div>');
	?>
</div>
</div>
<button type="submit" class="btn btn-outline-primary btn-lg ml-5 mt-3 mb-5">ADD NEW USER</button>

<div>
<?php echo form_close(); ?>
</div>
</div>
<?php include("inc/footer.php"); ?>

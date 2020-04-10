<?php include("inc/loginheader.php"); ?>
<div id="container">
	<?php echo anchor("admin/adminpage","BACK",['class'=>'ml-3 mt-3 btn btn-outline-danger btn-lg']); ?>
	<h1 class="display-1 ml-2 mt-3 mb-5">Add Department</h1>

	<?php echo form_open("users/createNewDept", ['class' => 'form-horizontal']); ?>
	<?php if($error = $this->session->flashdata('message')):?>
		<div class="row">
				<div class="col-md-12">
					<div class="alert alert-dismissible alert-success">
						<?php echo $error ?>
					</div>
				</div>
		</div>
	<?php endif; ?>



<div class="row">
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 ml-3 control-label">Department</label>
	<div class="col-md-9">
		<?php echo form_input(['name' => 'department','class'=>'form-control','placeholder'=>'Department Name','value'=>set_value('user_name')]); ?>
	</div>
</div>
</div>
</div>
<div class="col-md-6">
	<?php echo form_error('department','<div class="alert alert-dismissible alert-danger ml-3">','</div>');
	?>
</div>



</div>
<button type="submit" class="btn btn-outline-success btn-lg ml-3 mt-3">ADD</button>
<div>
<?php echo form_close(); ?>
</div>
<?php include("inc/footer.php"); ?>

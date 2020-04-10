<?php include("inc/loginheader.php"); ?>

<div class="container-fluid">
	<?php echo anchor("user/userpage","GO BACK",['class'=>'btn btn-outline-danger btn-lg mt-3']); ?>
  <h1 class="display-1  mt-3 mb-5">Forward</h1>

	<?php if($error = $this->session->flashdata('message')):?>
		<div class="row">
				<div class="col-md-12 mt-3">
					<div class="alert alert-dismissible alert-success">
						<?php echo $error ?>
					</div>
				</div>
		</div>
	<?php endif; ?>
      <?php echo form_open_multipart('user/do_ex_upload/'.$ticket_id.'/'.$initial_d);?>
      <form action = "" method = "">
				<div class="row">
				<div class="col-md-6 mt-3">
				<div class="form-group">
					<label class="col-md-3 control-label">Department</label>
					<select class="col-md-9" name="college_id">
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
					<?php echo form_error('college_id','<div class="alert alert-dismissible alert-danger">','</div>');
					?>
				</div>

         <input type = "file" name = "userfile" size = "20" />
         <br /><br />
				 <button type="submit" class="btn btn-primary mt-3">Forward</button>
      </form>
</div>
<?php include("inc/footer.php"); ?>

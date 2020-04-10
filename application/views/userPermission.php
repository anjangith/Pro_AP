<?php include("inc/header.php"); ?>
<div id="container">
	<?php echo anchor("admin/adminpage","GO BACK",['class'=>'btn btn-outline-danger btn-lg ml-5 mt-3']); ?>

<h1 class="display-1 ml-5 mt-3 mb-5">Set User Permission</h1>
<div class="container-fluid">
	<?php if($error = $this->session->flashdata('message')):?>
		<div class="row mt-2 mb-3">
				<div class="col-md-6">
					<div class="alert alert-dismissible alert-success">
						<?php echo $error ?>
					</div>
				</div>
		</div>
	<?php endif; ?>
<?php echo form_open("admin/saveUserPermission", ['class' => 'form-horizontal']); ?>
<table class="table table-dark table-hover">
<thead>
<tr>
<th scope="col">U_ID</th>
<th scope="col">U_NAME</th>
<th scope="col">Role</th>
<th scope="col">Department</th>
<th scope="col">Forward</th>
<th scope="col">Endorse</th>
<th scope="col">Track</th>
</tr>
</thead>
<tbody>
	<?php if(count($users)):?>
		<?php foreach($users as $user): ?>
<?php if($user->r_id == 1 ):?>
<?php else:?>
<tr class="table-active">
<td><?php echo $user->u_id; ?></td>
<td><?php echo $user->username; ?></td>
<td><?php echo $user->rolename; ?></td>
<td><?php echo $user->d_name; ?></td>

<?php if($user->forward == 1): ?>
  <td>
		<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="forward<?php echo $user->u_id ?>" value="1"  checked>ON
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="forward<?php echo $user->u_id ?>" value="0" >OFF
  </label>
</div></td>
<?php else:?>
	<td>
		<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="forward<?php echo $user->u_id ?>" value="1"  >ON
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="forward<?php echo $user->u_id ?>" value="0" checked >OFF
  </label>
</div></td>
<?php endif ?>


<?php if($user->endorse == 1): ?>
  <td>
		<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="endorse<?php echo $user->u_id ?>" value="1"  checked>ON
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="endorse<?php echo $user->u_id ?>" value="0" >OFF
  </label>
</div></td>
<?php else:?>
	<td>
		<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="endorse<?php echo $user->u_id ?>" value="1"  >ON
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="endorse<?php echo $user->u_id ?>" value="0" checked >OFF
  </label>
</div></td>
<?php endif ?>


<?php if($user->track == 1): ?>
  <td>
		<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="track<?php echo $user->u_id ?>" value="1"  checked>ON
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="track<?php echo $user->u_id ?>" value="0" >OFF
  </label>
</div></td>
<?php else:?>
	<td>
		<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="track<?php echo $user->u_id ?>" value="1"  >ON
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="track<?php echo $user->u_id ?>" value="0" checked >OFF
  </label>
</div></td>
<?php endif ?>


<?php endif; ?>
</tr>
<?php endforeach;?>
<?php else:?>
	<tr><td>No Records Found</td></tr>
<?php endif; ?>
</tbody>
</table>
<button type="submit" class="btn btn-outline-primary btn-lg mt-3 mb-5 mr-5 float-right">SAVE</button>

<?php echo form_close(); ?>

</div>
</div>
<?php include("inc/footer.php"); ?>

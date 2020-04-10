<?php include("inc/header.php"); ?>
<div id="container">
	<?php echo anchor("admin/adminpage","GO BACK",['class'=>'btn btn-outline-danger btn-lg ml-5 mt-3']); ?>

<h1 class="display-1 ml-5 mt-3 mb-5">List of Users</h1>
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
<table class="table table-dark table-hover">
<thead>
<tr>
<th scope="col">U_ID</th>
<th scope="col">U_NAME</th>
<th scope="col">ID</th>
<th scope="col">Role</th>
<th scope="col">Department</th>
<th scope="col">Action</th>


</tr>
</thead>
<tbody>
	<?php if(count($users)):?>
		<?php foreach($users as $user): ?>
<tr class="table-active">
<td><?php echo $user->u_id; ?></td>
<td><?php echo $user->username; ?></td>
<td><?php echo $user->email; ?></td>
<td><?php echo $user->rolename; ?></td>
<td><?php echo $user->d_name; ?></td>
<?php if($user->u_id == 12 ):?>
<td><button type="button" class="btn btn-outline-info disabled">Delete</button></td>
<?php else:?>
	<td><?php echo anchor('admin/removeUser/'.$user->u_id,"Remove",['class'=>'btn btn-warning']); ?></td>
<?php endif; ?>
</tr>
<?php endforeach;?>
<?php else:?>
	<tr><td>No Records Found</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<?php include("inc/footer.php"); ?>

<?php include("inc/header.php"); ?>
<div id="container">
	<?php echo anchor("user/userpage","GO BACK",['class'=>'btn btn-outline-danger btn-lg ml-5 mt-3']); ?>

<h1 class="display-1 ml-5 mt-3 mb-5">My Tickets</h1>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title">Track</h5>
        </button>
      </div>
			<div class="modal-body">
    <div id="trackcontent">
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Cras justo odio
  </a>
  <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in
  </a>
  <a href="#" class="list-group-item list-group-item-action disabled">Morbi leo risus
  </a>
	</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
    </div>
  </div>
</div>

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
<table class="table table-light table-hover" id="myTable">
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">NAME</th>
<th scope="col">TICKET ID</th>
<th scope="col">TIME</th>
<th scope="col">SENT TO</th>
<th scope="col">ACTION</th>
<th scope="col">ACTION</th>
<th scope="col">ACTION</th>
</tr>
</thead>
<tbody>
	<?php if(count($tickets)):?>
		<?php foreach($tickets as $ticket): ?>
<tr class="table-active">
<td><?php echo $ticket->f_id; ?></td>
<td><?php echo $ticket->f_name; ?></td>
<td><?php echo $ticket->t_id; ?></td>
<td><?php echo $ticket->time; ?></td>
<td><?php echo $ticket->d_name; ?></td>
<td><button class="btn btn-warning" id="trackbtn">Track</button></td>
<td><?php echo anchor('user/viewpdf/'.$ticket->f_name.'.pdf',"View",['class'=>'btn btn-warning']); ?></td>
<td><?php echo anchor('user/ex_forward/'.$ticket->t_id.'/'.$ticket->initial_d,"Forward",['class'=>'btn btn-warning']); ?></td>

<?php endforeach;?>
<?php else:?>
	<tr><td>No Records Found</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<script>
$(document).ready(function(){


  $("#myTable").on('click','#trackbtn',function(){
          // get the current row
          var currentRow=$(this).closest("tr");
          var id=currentRow.find("td:eq(2)").html(); // get current row 1st table cell TD value
          $.ajax({
            url: '<?php echo site_url('user/trackFile'); ?>',
            type: 'POST',
            data: {t_id: id},
            error: function() {
                  alert('Something is wrong');
             },
            success: function(data) {
                console.log(data);
     					 $("#trackcontent").html(data);
                $('#myModal').modal('show');
            }
        });
     });
});


</script>
<?php include("inc/footer.php"); ?>

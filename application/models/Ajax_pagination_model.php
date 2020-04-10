<?php
class Ajax_pagination_model extends CI_Model
{
 function count_all()
 {
  $query = $this->db->get("top_freelancer");
  return $query->num_rows();
 }

 function fetch_details($limit, $start)
 {
  $output = '';
  $this->load->helper('url');
  $this->db->select("*");
  $this->db->from("top_freelancer");
  $this->db->order_by("points", "DESC");
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  $output .= '
  <div class="col mt-3">
  <ul class="list-group">
  ';
  foreach($query->result() as $row)
  {

   $output .= '

   <li class="list-group-item d-flex justify-content-between align-items-center">
   <img class="mt-2" src='.base_url('assets/images/user.png').' alt="Card image cap" width="50" height="50">

   <h5>
    '.$row->name.'</h5>
      <span class="text-primary ml-auto mt-2 mr-2">'.'<p>Points</p>'.'</span>
    <span class="badge badge-primary badge-pill">'.$row->points.'</span>.<button class="btn btn-success ml-3">Profile</button>
  </li>
   ';
  }
  $output .= '</ul></div>';
  return $output;
 }
}

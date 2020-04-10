<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller {

public function __construct(){
  parent::__construct();
  if(!$this->session->userdata('user_id')){
    return redirect('homepage/login');
  }
}


public function signDocument(){
$this->load->library('Pdf');
$this->load->view('signPdf');
}


public function viewpdf($filename){
  $this->load->view('pdf',['pdf_file'=>$filename]);
}

public function trackFile(){
$this->load->model('queries');
$t_id = $this->input->post('t_id');
$result_html = '<div class="list-group">';
$depts = $this->queries->getTrackDept($t_id);

foreach($depts as $result) {
      $initialDept =  $this->queries->getDeptById($result->s_d);
      $finalDept =  $this->queries->getDeptById($result->r_d);
      $result_html .= '<a class="list-group-item list-group-item-action"><b>' . $initialDept->d_name . '</b><svg class="bi bi-arrow-bar-right" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 01.708 0l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708-.708L12.793 8l-2.647-2.646a.5.5 0 010-.708z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M6 8a.5.5 0 01.5-.5H13a.5.5 0 010 1H6.5A.5.5 0 016 8zm-2.5 6a.5.5 0 01-.5-.5v-11a.5.5 0 011 0v11a.5.5 0 01-.5.5z" clip-rule="evenodd"/>
</svg><b>' .$finalDept->d_name;
      $result_html .= '</b></a>';

  }

$result_html .= '</div>';
echo($result_html);
}


public function loadNot(){
$this->load->model('queries');
$d_id = $this->input->post('d_id');
$result_html = '<div class="list-group">';
$not = $this->queries->getNotifications($d_id);
echo json_encode($not);
}


public function myTickets(){
  $this->load->model('queries');
  $tickets = $this->queries->getMyTickets($this->session->userdata('user_id'));
  $this->load->view('mytickets',['tickets'=>$tickets]);
}

public function inbox(){
  $this->load->model('queries');
  $tickets = $this->queries->getInboxTickets($this->session->userdata('d_id'));
  $this->load->view('inbox',['tickets'=>$tickets]);
}

public function userpage(){
  $this->load->view('userview');
}

public function ex_forward($t_id){
  $initial_d = $this->uri->segment(4);
  $this->load->model('queries');
  $depts = $this->queries->getDepartments();
 $this->load->view('ex_forward',['depts'=>$depts,'ticket_id'=>$t_id,'initial_d'=>$initial_d]);
}

public function forward(){
  $this->load->model('queries');
  $depts = $this->queries->getDepartments();
  $this->load->view('forward',['depts'=>$depts]);
}

public function do_upload() {
  $this->form_validation->set_rules('college_id','Department','required');
    if($this->form_validation->run()){
      $config['upload_path']   = './uploads/';
      $config['allowed_types'] = 'pdf';
      $config['max_size']      = 0;
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('userfile')) {
         $error = array('error' => $this->upload->display_errors());
         $this->session->set_flashdata('message',implode(" ",$error));
         return redirect("user/forward");
      }
      else {
         $this->load->model('queries');
         $data = array('upload_data' => $this->upload->data());
         $str=rand();
         $result = md5($str);
         $rd_id = $this->input->post('college_id');
         $insert = array(
         'f_name' => $data['upload_data']['raw_name'],
         't_id' => $result,
         's_id' => $this->session->userdata('user_id'),
         's_d' => $this->session->userdata('d_id'),
         'r_d' => $rd_id,
         'initial_d' =>$this->session->userdata('d_id')
       );
       if($this->queries->postNewTicket($insert)){
         $senderName = $this->session->userdata('username');
         $deptName = $this->session->userdata('d_name');
         $ndata = array(
         'n_category' => 'Forward',
         's_id' => $this->session->userdata('user_id'),
         's_d' => $this->session->userdata('d_id'),
         'r_d' => $rd_id,
         'description' => 'You have a new ticket Forwarded by '.$senderName.' from '.$deptName. ' Department' ,
       );
         $this->queries->postNewNotification($ndata);
         $this->session->set_flashdata('message','Successfully Forwarded');
         return redirect("user/forward");
       }else{
         $this->session->set_flashdata('message','Database Error');
         return redirect("user/forward");
       }
    }
    }else{
    $this->forward();
    }
  }

  public function do_ex_upload($ticket_id) {

    $initial_d = $this->uri->segment(4);
    $this->form_validation->set_rules('college_id','Department','required');
      if($this->form_validation->run()){
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = 0;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')) {
           $error = array('error' => $this->upload->display_errors());
           $this->session->set_flashdata('message',implode(" ",$error));
           return redirect("user/forward");
        }

        else {
           $this->load->model('queries');
           $data = array('upload_data' => $this->upload->data());
           $rd_id = $this->input->post('college_id');
           $insert = array(
           'f_name' => $data['upload_data']['raw_name'],
           't_id' => $ticket_id,
           's_id' => $this->session->userdata('user_id'),
           's_d' => $this->session->userdata('d_id'),
           'r_d' => $rd_id,
           'initial_d' =>$initial_d
         );
         if($this->queries->postNewTicket($insert)){
           $senderName = $this->session->userdata('username');
           $deptName = $this->session->userdata('d_name');
           $ndata = array(
           'n_category' => 'Forward',
           's_id' => $this->session->userdata('user_id'),
           's_d' => $this->session->userdata('d_id'),
           'r_d' => $rd_id,
           'description' => 'You have a new ticket Forwarded by '.$senderName.' from '.$deptName. ' Department' ,
         );
           $this->queries->postNewNotification($ndata);
           $this->session->set_flashdata('message','Successfully Forwarded');
           return redirect("user/userpage");
         }else{
           $this->session->set_flashdata('message','Database Error');
           return redirect("user/userpage");
         }
      }
      }else{
      $this->forward();
    }
    }


}

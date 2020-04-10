<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends My_Controller {

public function __construct(){
  parent::__construct();
  if(!$this->session->userdata('user_id')){
    return redirect('homepage/login');
  }
}


public function adminpage(){
$this->load->view('adminview');
}

public function departmentList(){
  $this->load->model('queries');
  $users = $this->queries->getDepartments();
  $this->load->view('viewDepartment',['users'=>$users]);
}


public function addUser(){

  $this->load->model('queries');
  $depts = $this->queries->getDepartments();
  $roles = $this->queries->getRoles();
  $this->load->view('addUser',['depts'=>$depts,'roles'=> $roles]);

}

public function saveUserPermission(){
  $this->load->model('queries');
  $users = $this->queries->getUserPermissionID();
  foreach ($users as $user) {
  $p_id = $user->p_id;
  $id = $user->u_id;
  $forward = $this->input->post('forward'.$id);
  $endorse = $this->input->post('endorse'.$id);
  $track = $this->input->post('track'.$id);
  $data = array(
    'u_id' => $id,
    'forward' => $forward,
    'endorse' => $endorse,
    'track' => $track,
  );
  $this->queries->updateUserPermission($p_id,$data);
  }
  $this->session->set_flashdata('message','Permission Updated');
  return redirect("admin/userPermissionList");
}

public function userList(){
  $this->load->model('queries');
  $users = $this->queries->getAllUsers();
  $this->load->view('userList',['users'=>$users]);
}


public function userPermissionList(){
  $this->load->model('queries');
  $users = $this->queries->getUserPermission();
  $this->load->view('userPermission',['users'=>$users]);
}

public function removeUser($id){
  $this->load->model('queries');
  if($this->queries->removeUserById($id)){
    $this->session->set_flashdata('message','User removed');
    return redirect("admin/userList");
  }else{
    $this->session->set_flashdata('message','Failed to remove user');
    return redirect("admin/userList");
  }
}

public function removeDepartment($id){
  $this->load->model('queries');
  if($this->queries->removeDepartmentById($id)){
    $this->session->set_flashdata('message','Department removed');
    return redirect("admin/departmentList");
  }else{
    $this->session->set_flashdata('message','Failed to remove Department');
    return redirect("admin/departmentList");
  }
}



  public function sanctionList(){

    $this->load->model('queries');
    $files = $this->queries->getSanctioned();
    $this->load->view('sanctionList',['files'=>$files]);


  }
    public function rejectedFile(){

      $this->load->model('queries');
      $files = $this->queries->getRejected();
      $this->load->view('rejectList',['files'=>$files]);

    }
      public function processedFile(){

        $this->load->model('queries');
        $files = $this->queries->getProcessed();
        $this->load->view('processList',['files'=>$files]);

      }

      public function checkFileStatus(){
        $this->load->model('queries');
        $files = $this->queries->getEveryFile();
        $this->load->view('status',['files'=>$files]);

      }



public function createNewUser(){
  $this->form_validation->set_rules('role_id','Role','required');
  $this->form_validation->set_rules('name','Name','required');
  $this->form_validation->set_rules('email','Email','required');
  $this->form_validation->set_rules('college_id','Department','required');
  $this->form_validation->set_rules('password','Password','required');
  $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
  if($this->form_validation->run()){
    $data = array(
      'r_id' => $this->input->post('role_id'),
      'username' => $this->input->post('name'),
      'email' => $this->input->post('email'),
      'password' => sha1($this->input->post('password')),
      'd_id' => $this->input->post('college_id'),
    );
    $this->load->model('queries');
    if($this->queries->postNewUser($data)){
      if($this->queries->getIdByName($data['username'])){
        $row = $this->queries->getIdByName($data['username']);
          $data = array(
          'u_id' => $row->u_id,
          'forward' => 1,
          'endorse' => 1,
          'track' => 1
        );
        if($this->queries->setPermission($data)){
          $this->session->set_flashdata('message','New User Added');
          return redirect("admin/addUser");
        }


      }
    }else{
      $this->session->set_flashdata('message','Failed to add a new User!');
      return redirect("admin/addUser");
    }
  }else
  {
  //  echo ($this->input->post['p_title']);
    $this->addUser();
  }
}


public function trackFile(){
  $this->load->model('queries');
  $u_id = $this->session->userdata('user_id');
  $files = $this->queries->getTrackFiles($u_id);
/*  $u_name = $this->queries->getUserName($files[0]->u_id);
  $f_name = $this->queries->getFileName($files[0]->f_id);
  $s_dept = $this->queries->getDeptName($files[0]->s_dept);
  $r_dept = $this->queries->getDeptName($files[0]->r_dept);
  $files['username'] = $u_name->username;
  $files['sender'] = $s_dept->d_name;
  $files['receiver'] = $r_dept->d_name;
  $files['filename'] = $f_name->f_name;
  print_r($files);*/
  $this->load->view('trackFile',['files'=>$files]);
}


public function checkIn(){
  $this->load->model('queries');
  $files = $this->queries->getAllFiles();
  $this->load->view('checkIn',['files'=>$files]);
}


public function generateReports(){
  $this->load->view('generateReports');
}

public function updateFileCheck(){
  $this->form_validation->set_rules('file_id','File Name','required');
  if($this->form_validation->run()){
    if($this->input->post('checkbtn') == "accept") {
      $this->load->model('queries');
      $this->queries->updateReceiveStatus($this->input->post('file_id'));
      $this->session->set_flashdata('message','File Accepted');
      return redirect("users/checkIn");
    } else if($this->input->post('checkbtn') == "reject"){
      $this->load->model('queries');
      $this->queries->rejectFile($this->input->post('file_id'));
      $this->session->set_flashdata('message','File Rejected');
      return redirect("users/checkIn");
    }else if($this->input->post('checkbtn') == "sanction"){
      $this->load->model('queries');
      $this->queries->sanctionFile($this->input->post('file_id'));
      $this->session->set_flashdata('message','File Sanctioned');
      return redirect("users/checkIn");
    }else if($this->input->post('checkbtn') == "dispatch"){
      $this->session->set_flashdata('message','File Rejected');
      return redirect("users/checkIn");
    }
  //  print_r($data);
  }else
  {
    $this->checkIn();
  }
}

public function newDept(){
  $this->load->model('queries');
  $depts = $this->queries->getDepartments();
  $this->load->view('addDepartment',['depts'=>$depts]);
}

public function dispatchFile(){
  $this->load->model('queries');
  $depts = $this->queries->getDepartments();
  $files = $this->queries->getAllFiles();
  $this->load->view('dispatchFile',['depts'=>$depts,'files'=>$files]);
}

public function postDispatchFile(){
  $this->form_validation->set_rules('file_id','File Name','required');
  $this->form_validation->set_rules('college_id','Department','required');
  $this->form_validation->set_rules('remarks','Remarks','required');

  if($this->form_validation->run()){
    $this->load->model('queries');
    $department = $this->queries->getDeptName($this->session->userdata('d_id'));
    $s_dept = $this->queries->getDeptName($this->session->userdata('d_id'));
    $r_dept = $this->queries->getDeptName($this->input->post('college_id'));
    $username = $this->queries->getUserName($this->session->userdata('user_id'));
    $filename = $this->queries->getFileName($this->input->post('file_id'));
    $data = array(
      'u_id' => $this->session->userdata('user_id'),
      'f_id' => $this->input->post('file_id'),
      's_dept' => $this->session->userdata('d_id'),
      'r_dept' => $this->input->post('college_id'),
      'username' => $username->username,
      'filename' => $filename->f_name,
      'sender' => $s_dept->d_name,
      'receiver' => $r_dept->d_name,
      'remark' => $this->input->post('remarks'),
      'dispatchstatus' => 'TRUE',
      'receivestatus' => 'FALSE',
      'curlocation' =>$department->d_name,
      'filestatus' => 'PROCESSING'
    );
  if($this->queries->postNewDispatchFile($data)){
      $this->session->set_flashdata('message','File Dispatched');
      return redirect("users/dispatchFile");
    }else{
      $this->session->set_flashdata('message','Failed to Dispatch File!');
      return redirect("users/dispatchFile");
    }
  //  print_r($data);
  }else
  {
  //  echo ($this->input->post['p_title']);
    $this->dispatchFile();
  }
}

public function addFile(){
  $this->load->model('queries');
  $depts = $this->queries->getDepartments();
  $this->load->view('addFile',['depts'=>$depts]);
}

public function createNewFile(){
  $this->form_validation->set_rules('fname','Name','required');
  $this->form_validation->set_rules('college_id','Department','required');

  if($this->form_validation->run()){

    $data = array(
      'u_id' => $this->session->userdata('user_id'),
      'f_name' => $this->input->post('fname'),
      'f_dept' => $this->input->post('college_id'),
    );
    $this->load->model('queries');
    if($this->queries->postNewFile($data)){
      $this->session->set_flashdata('message','New File Added');
      return redirect("users/addFile");
    }else{
      $this->session->set_flashdata('message','Failed to add a new File!');
      return redirect("users/addFile");
    }
    //print_r($data);
  }else
  {
  //  echo ($this->input->post['p_title']);
    $this->addFile();
  }
}

public function createNewDept(){
  $this->form_validation->set_rules('department','Name','required');
  if($this->form_validation->run()){

    $data = array(
      'd_name' => $this->input->post('department'),
    );
    $this->load->model('queries');
    if($this->queries->postNewDept($data)){
      $this->session->set_flashdata('message','New Department Added');
      return redirect("users/newDept");
    }else{
      $this->session->set_flashdata('message','Failed to add a new Department!');
      return redirect("users/newDept");
    }
  }else
  {
  //  echo ($this->input->post['p_title']);
    $this->newDept();
  }
}


public function postWork(){

  $this->form_validation->set_rules('post_work','Work Title','required');
  $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
  if($this->form_validation->run()){

    $data = $this->input->post();
    $post = $data['post_work'];
    $this->load->model('queries');
    $categories = $this->queries->getCategories();
    $this->config->set_item('post',$post);
    $this->load->view('postwork',['post'=>$post,'categories'=> $categories]);

  }else{
    $this->find();
  }
}


public function logout(){
  $this->session->unset_userdata("user_id");
  return redirect('homepage/login');
}

public function find(){

  $this->load->view('userpage');

}

public function category($id){

$this->load->model('queries');
$c_name = $this->queries->getCName($id);
$sections = $this->queries->getSections($id);
$this->load->view('section',['cname'=>$c_name->c_name,'sections'=>$sections]);

}

public function loadPostWork(){

  $this->load->model('queries');
  $categories = $this->queries->getCategories();
  $this->load->view('postwork',['post'=>'','categories'=> $categories]);
}

public function postFinal(){

  $this->form_validation->set_rules('p_title','Post Title','required');
  $this->form_validation->set_rules('c_id','Category','required');
  $this->form_validation->set_rules('p_description','Description','required');
  $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
  if($this->form_validation->run()){

    $data = array(
      'p_uid' => $this->session->userdata('user_id'),
      'p_title' => $this->input->post('p_title'),
      'p_description' => $this->input->post('p_description')
    );
    $this->load->model('queries');
    if($this->queries->postWork($data)){
      $this->session->set_flashdata('message','New Post Added');
      return redirect("users/find");
    }else{
      $this->session->set_flashdata('message','Failed to add a new Post!');
      return redirect("users/loadPostWork");
    }
    //print_r($data);
  }else
  {
  //  echo ($this->input->post['p_title']);
    $this->loadPostWork();
  }
}
}

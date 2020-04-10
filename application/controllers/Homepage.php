<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends My_Controller {

	public function index()
	{

		$this->load->view('home');

	}

	public function signin(){
		$this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
    if($this->form_validation->run()){
          $email= $this->input->post('email');
          $password= sha1($this->input->post('password'));
          $this->load->model('queries');
          $usrExist = $this->queries->adminExist($email, $password);
          if($usrExist){
            if($usrExist->r_id == '1'){
            $sessionData = [
              'user_id' => $usrExist->u_id,
              'username' => $usrExist->username,
              'email' => $usrExist->email,
              'role_id' => $usrExist->r_id,
            ];
              $this->session->set_userdata($sessionData);
              return redirect('admin/adminpage');

          }else if($usrExist->r_id > '1'){
						$dept_name = $this->queries->getDeptById($usrExist->d_id);
            $sessionData = [
              'user_id' => $usrExist->u_id,
              'username' => $usrExist->username,
              'email' => $usrExist->email,
              'role_id' => $usrExist->r_id,
							'd_id' => $usrExist->d_id,
							'd_name' => $dept_name->d_name
            ];
            $this->session->set_userdata($sessionData);
            return redirect('user/userpage');
          }
          }else{
            $this->session->set_flashdata('message','Email or Password is Incorrect!');
            redirect('homepage/');
          }
    }else{
      $this->index();
    }
	}



  public function register(){

    $this->load->model('queries');
    $roles = $this->queries->getRoles();
    $this->load->view('newuser',['roles'=>$roles]);

  }

public function adminlogin(){
	$this->load->view('adminlogin');
}

  public function login(){
			$this->index();
	 }


  public function adminRegister(){

  }

  public function userSignUp(){

					$this->form_validation->set_rules('user_name','Username','required');
					$this->form_validation->set_rules('email','Email','required|valid_email');
					$this->form_validation->set_rules('gender','Gender','required');
					$this->form_validation->set_rules('role_id','Role','required');
					$this->form_validation->set_rules('password','Password','required');
					$this->form_validation->set_rules('confpwd','Confirm Password','required|matches[password]');
					$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
					if($this->form_validation->run()){

						$data = $this->input->post();
						$data['password']=sha1($this->input->post('password'));
						$data['confpwd']=sha1($this->input->post('confpwd'));
						$this->load->model('queries');
						if($this->queries->registerAdmin($data)){
							$this->session->set_flashdata('message','Registered Successfully');
							return redirect("homepage/login");
						}else{
							$this->session->set_flashdata('message','Failed to register!');
							return redirect("homepage/register");
						}
					}else{
						$this->register();
					}
	}
}

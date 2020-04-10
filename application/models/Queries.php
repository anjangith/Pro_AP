<?php
  class Queries extends CI_Model {

    public function postNewTicket($data){
      return $this->db->insert('all_files',$data);
    }

    public function postNewNotification($data){
      return $this->db->insert('notifications',$data);
    }

    public function getNotifications($r_d){
      $not = $this->db->where(['r_d'=>$r_d])->order_by('n_id', 'asc')->get('notifications');
      if($not->num_rows()>0){
        $row['result'] = $not->result();
        $row['count'] =$not->num_rows();
        return $row;
      }
    }



    public function getRoles(){
      $roles = $this->db->get('role');
      if($roles->num_rows()>0){
        return $roles->result();
      }
    }

    public function getTrackDept($t_id){
      $depts = $this->db->where(['t_id'=>$t_id])->get('all_files');
      if($depts->num_rows()>0){
        return $depts->result();
      }
    }


    public function getInboxTickets($d_id){
      $this->db->select('*');
      $this->db->from('all_files');
      $this->db->join('department','department.d_id=all_files.s_d');
      $this->db->join('user','user.u_id=all_files.s_id');
      $this->db->where(['all_files.r_d'=> $d_id]);
      $student = $this->db->get();
      return $student->result();
    }

    public function getMyTickets($u_id){
      $this->db->select('*');
      $this->db->from('all_files');
      $this->db->join('department','department.d_id=all_files.r_d');
      $this->db->where(['all_files.s_id'=> $u_id]);
      $student = $this->db->get();
      return $student->result();
    }


    public function updateUserPermission($id,$data){
      return $this->db->where('p_id',$id)->update('userper',$data);
    }


    public function getUserPermissionID(){
      $users = $this->db->get('userper');
      if($users->num_rows()>0){
        return $users->result();
      }
    }


    public function getUserPermission(){
      $users = $this->db->select('*')
     ->from('user u')
     ->join('department d', 'u.d_id = d.d_id', 'LEFT')
     ->join('role r', 'u.r_id = r.id', 'LEFT')
     ->join('userper p','u.u_id = p.u_id', 'LEFT')
     ->get();
      if($users->num_rows()>0){
        return $users->result();
      }
    }

    public function getCategories(){
      $roles = $this->db->get('category');
      if($roles->num_rows()>0){
        return $roles->result();
      }
    }

    public function getSanctioned(){
      $files = $this->db->where(['filestatus'=>'SANCTIONED'])->get('filetracker');
      if($files->num_rows()>0){
        return $files->result();
      }
    }

    public function removeUserById($id){
      return $this->db->delete('user',['u_id'=>$id]);
    }

    public function removeDepartmentById($id){
      return $this->db->delete('department',['d_id'=>$id]);
    }

    public function setPermission($data){
      return $this->db->insert('userper',$data);
    }



      public function getDeptById($id){
        $chkDept = $this->db->where(['d_id'=>$id])->get('department');
        if($chkDept->num_rows()>0){
          return $chkDept->row();
        }
      }


    public function getIdByName($name){
      $chkAdmin = $this->db->where(['username'=>$name])->get('user');
      if($chkAdmin->num_rows()>0){
        return $chkAdmin->row();
      }
    }

    public function postNewUser($data){
      return $this->db->insert('user',$data);
    }

    public function postNewDept($data){
      return $this->db->insert('department',$data);
    }





    public function postNewFile($data){
      return $this->db->insert('files',$data);
    }

    public function getDepartments(){
      $dept = $this->db->get('department');
      if($dept->num_rows()>0){
        return $dept->result();
      }
    }

    public function updateReceiveStatus($fid){
      $data = array(
    'receivestatus'=>'TRUE');
      $this->db->where('f_id', $fid);
      $this->db->update('filetracker', $data);
    }

    public function getAllUsers(){
      $users = $this->db->select('*')
     ->from('user u')
     ->join('department d', 'u.d_id = d.d_id', 'LEFT')
     ->join('role r', 'u.r_id = r.id', 'LEFT')
     ->get();
      if($users->num_rows()>0){
        return $users->result();
      }
    }

    public function rejectFile($fid){
      $data = array(
    'filestatus'=>'REJECTED'
   );
      $this->db->where('f_id', $fid);
      $this->db->update('filetracker', $data);
    }

    public function sanctionFile($fid){
      $data = array(
    'filestatus'=>'SANCTIONED'
   );
      $this->db->where('f_id', $fid);
      $this->db->update('filetracker', $data);
    }





    public function registerAdmin($data){
      return $this->db->insert('users',$data);
    }

    public function checkAdminExist(){
      $chkAdmin=$this->db->where(['role_id'=>'1'])->get('user');
      if($chkAdmin->num_rows()>0){
        return $chkAdmin->num_rows();
      }
    }



    public function adminExist($email, $password){
      $chkAdmin = $this->db->where(['email'=>$email,'password'=>$password])->get('user');
      if($chkAdmin->num_rows()>0){
        return $chkAdmin->row();
      }
    }

    public function makeCollege($data){
      return $this->db->insert('tbl_college',$data);
    }

    public function postWork($data){
      return $this->db->insert('posts',$data);
    }

    public function getColleges(){
      $colleges = $this->db->get('tbl_college');
      if($colleges->num_rows()>0){
        return $colleges->result();
      }
  }

  public function getTrackFiles($id){


    $files =  $this->db->where(['u_id'=>$id])->get('filetracker');
    if($files->num_rows()>0){
      return $files->result();
    }
  }


  public function registerCoAdmin($data){
    return $this->db->insert('tbl_users',$data);
  }

  public function insertStudent($data){
    return $this->db->insert('tbl_student',$data);
  }

  public function getStudents($college_id){
    $this->db->select(['tbl_college.collegename','tbl_student.id','tbl_student.studentname','tbl_student.email','tbl_student.gender','tbl_student.course']);
    $this->db->from('tbl_student');
    $this->db->join('tbl_college','tbl_college.college_id=tbl_student.college_id');
    $this->db->where(['tbl_student.college_id'=> $college_id]);
    $student = $this->db->get();
    return $student->result();
  }

  public function getStudentRecord($id){
    $this->db->select(['tbl_college.college_id','tbl_college.collegename','tbl_student.id','tbl_student.email','tbl_student.gender','tbl_student.studentname',
    'tbl_student.course']);
    $this->db->from('tbl_student');
    $this->db->join('tbl_college','tbl_college.college_id=tbl_student.college_id');
    $student= $this->db->get();
    return $student->row();
  }

  public function updateStudent($data, $id){
    return $this->db->where('id',$id)->update('tbl_student',$data);
  }

  public function removeStudent($id){
    return $this->db->delete('tbl_student',['id'=>$id]);
  }

  public function getDeptName($id){
    $dept = $this->db->where(['d_id'=>$id])->get('department');
    if($dept->num_rows()>0){
      return $dept->row();
    }
  }

  public function getCName($id){
    $category = $this->db->where(['c_id'=>$id])->get('category');
    if($category->num_rows()>0){
      return $category->row();
    }
  }

  public function getFileName($id){
    $category = $this->db->where(['f_id'=>$id])->get('files');
    if($category->num_rows()>0){
      return $category->row();
    }
  }

  public function getUserName($id){
    $category = $this->db->where(['u_id'=>$id])->get('user');
    if($category->num_rows()>0){
      return $category->row();
    }
  }
}
 ?>

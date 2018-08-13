<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Profiles extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
    }
    /*Get RSM Profile Details*/
    public function get_profile_details(){ 
        $loggedin_data = $this->session->userdata('logged_in');
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.id',$loggedin_data->id);
        $this->db->join('rsm_details','rsm_details.user_id=users.id','LEFT');
        $query=$this->db->get();
        return $query->result_array();
    }
    /*Change RSM Profile Image*/
    public function change_profile_pic($id,$data){
        $this->db->where('id',$id);
        if ($this->db->update('users',$data)){
           return true;
        }else{
            return false;
        }
    }
   /*Change RSM Password*/
   public function change_password($id,$data){
        $this->db->where('id',$id);
        if ($this->db->update('users',$data)){
            $insert_id = $this->db->insert_id();
           return $insert_id;
        }else{
            return false;
        }
    }
    /*Edit RSM Details*/
    public function change_name($id,$data){
        $this->db->where('id',$id);
        if ($this->db->update('users',$data)){
            $insert_id = $this->db->insert_id();
           return $insert_id;
        }else{
            return false;
        }
    }
/*Check RSM Password */
    public function checkpassword($id,$password){

        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id',$id);
        $this->db->where('password',$password);
        $query = $this->db->get();
        $data =  $query->row();
        if ($data){
            return true;
        }else{
            return false;
        }   
    }
/*Check RSM Password */

/*Change RSM Password*/
   public function changepassword($id,$data){

        $this->db->where('id',$id);
        $res = $this->db->update('users',$data);
        return $res;
           
    }
/*Change RSM Password*/

    
}
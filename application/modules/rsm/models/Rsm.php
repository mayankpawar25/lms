<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Rsm extends CI_Model {
    private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
    }
    // for get all admins
    public function get_all_admins(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_role',5);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function get_forgot_password($email=""){
        // check email is valid
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query=$this->db->get();
        if($query->num_rows()>=1){
            $row = $query->result_array();
            // update reset token
             $token = date('YmdHis');
             $this->db->where('id',$row[0]['id']);       
             $this->db->update('users',['reset_pass_token'=>$token]);    
            return $token;
        }else{
            return false;
        }
    }
    public function check_token($token){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('reset_pass_token', $token);
        $query=$this->db->get();
        if($query->num_rows()>=1){
            $row = $query->result_array();
            return $row;
        }else{
            return false;
        }
    }
    public function change_userdata($data,$where)
    {
        $this->db->where($where);
        $this->db->update('users',$data);
    }
    public function get_admin($username){
        $this->db->where('username',$username);
        $this->db->select('u.*,r.role_name as type');
        $this->db->from($this->table.' u');
        $this->db->join('user_roles r','u.user_role=r.id');
        //$this->db->join('rsm_details','rsm_details.user_id=u.id');
        $query = $this->db->get();
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }
}
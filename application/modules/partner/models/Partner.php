<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Partner extends CI_Model {
    private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

    /* Genrate random passwor for partner after approval */
    public function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
        }
    return implode($pass); //turn the array into a string
    }

    /*Fogot Password function*/
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

    /*token Check fumction*/
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
    
    /*Change user data*/
    public function change_userdata($data,$where)
    {
        $this->db->where($where);
        $this->db->update('users',$data);
    }
    
    public function get_partner($username){
        $this->db->where('username',$username);
        $this->db->select('u.*,r.role_name as type');
        $this->db->from($this->table.' u');
        $this->db->join('user_roles r','u.user_role=r.id');
        $query = $this->db->get();
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }

   /*Add Partner function*/
   public function add_partner($data){
        if($this->db->insert('partner_info', $data)){
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }else{
            return false;
        }
   }

   /*Add Partner in user table*/
   public function add_partner_users($data){
        if($this->db->insert('users', $data)){
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }else{
            return false;
        }
   }

   /*update user by id*/
   public function update_user_id($user_id, $partner_id){
        $this->db->set('user_id', $user_id);
        $this->db->where('id', $partner_id);
        $this->db->update('partner_info');
   }

   /*select partner by id*/
   public function get_partner_id($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->select('id');
        $this->db->from('partner_info');
        $query = $this->db->get();
        $result = $query->row();
        
        if ($result){
            return $result;
        }
        return false;
   }

   public function get_partner_det_by_id($id){
        $this->db->select('*');
        $this->db->from('partner_info');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        return false;
   }
}
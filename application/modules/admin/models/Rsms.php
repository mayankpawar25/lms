<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Rsms extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
    }
    /*Fetch All the RSM*/
    public function get_all_rsm_data(){
        $this->db->select('rsm_details.*,states.id as state_id');
        $this->db->from('rsm_details');
        $this->db->where('rsm_details.is_deleted',0);
        $this->db->where('users.user_role',5);
        $this->db->join('users' ,'rsm_details.user_id = users.id');
        $this->db->join('states' ,'rsm_details.states = states.id', 'LEFT');
        $this->db->order_by('rsm_details.id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }
    /*Fetch all the deleted RSM*/
    public function get_all_deleted_rsm(){
        $this->db->select('rsm_details.*,states.id as state_id');
        $this->db->from('rsm_details');
        $this->db->where('rsm_details.is_deleted',1);
        $this->db->where('users.user_role',5);
        $this->db->join('users','rsm_details.user_id = users.id');
        $this->db->join('states','rsm_details.states = states.id', 'LEFT');
        $this->db->order_by('rsm_details.id', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
    }
    /*Get state by id*/
    public function getstatebyId($id)
    {
     return $this->db->select('name')->where('id',$id)->get('states')->row();
 }
 /*get RSM for edit*/
 public function get_rsm_by_id($id){
    $this->db->select('*');
    $this->db->from('rsm_details');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
}
/*update RSM*/
public function update_rsm($id,$data){
    $this->db->where('id',$id);
    if($this->db->update('rsm_details',$data)){
        return true;
    }else{
        return false;
    }
}
/*Update RSM status*/
public function update_rsm_status($id,$data){
    $this->db->where('id',$id);
    if($this->db->update('rsm_details',$data)){
        return true;
    }else{
        return false;
    }
}
/*Get user_id from rsm_details table*/
public function get_rsm($id){
    $this->db->select('user_id');
    $this->db->from('rsm_details');
    $this->db->where('id',$id);
    $query = $this->db->get();        
    $result = $query->row();
    return $result->user_id;
}
/*Update RSM status in users table*/
public function update_rsm_status_users($rsm_id,$data){
    $this->db->where('id',$rsm_id);
    if($this->db->update('users',$data)){
        return true;
    }else{
        return false;
    }
}
/*delete RSM*/
public function delete_rsm($id,$data){
    $this->db->where('id', $id);
    if($this->db->update('rsm_details',$data)){
        return true;
    }else{
        return false;
    }
}
/*Add new RSM*/
public function add_new_rsm($data){
    if($this->db->insert('rsm_details', $data)){
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }else{
        return false;
    }
}
/*Add new RSM data into users table*/
public function add_rsm_users($data){
    if($this->db->insert('users', $data)){
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }else{
        return false;
    }
}
/*genrate random password*/
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
/*update user_id into rsm_details table*/
public function update_user_id($user_id, $rsm_id){
    $this->db->set('user_id', $user_id);
    $this->db->where('id', $rsm_id);
    $this->db->update('rsm_details');
}
/*View RSM details*/
public function get_rsm_details($id){
    $this->db->select('rsm_details.*,states.id as state_id');
    $this->db->from('rsm_details');
    $this->db->where('rsm_details.is_deleted',0);
    $this->db->where('rsm_details.id',$id);
    $this->db->join('states' ,'rsm_details.states = states.id', 'LEFT');
    $query=$this->db->get();
    return $query->row();
}

/*View Deleted RSM Details*/
public function get_deleted_rsm($id){
    $this->db->select('rsm_details.*,states.id as state_id');
    $this->db->from('rsm_details');
    $this->db->where('rsm_details.is_deleted',1);
    $this->db->where('rsm_details.id',$id);
    $this->db->join('states' ,'rsm_details.states = states.id', 'LEFT');
    $query=$this->db->get();
    return $query->row();
}



/*Restore deleted RSM Again*/
public function restore_this_rsm($id,$data){
    $this->db->where('id', $id);
    if($this->db->update('rsm_details', $data)){
        return true;
    }else{
        return false;
    }
}
/*user_id from rsm details table*/
public function get_rsm_by_id_rsm_details($id){
    $this->db->select('*');
    $this->db->from('rsm_details');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
} 
}
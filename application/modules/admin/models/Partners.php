<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Partners extends CI_Model {
    //private $table = 'users';
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
    
    /*count total partners*/ /*change by 001*/
    public function get_total_partners(){
        $this->db->select('COUNT(*) as total');
        $this->db->from('partner_info');
        $this->db->where('is_deleted',0);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }

   
    /*count total approved partners*/
    public function get_total_approved_partners(){
        $this->db->select('COUNT(*) as total');
        $this->db->from('partner_info');
        $this->db->where('is_deleted',0);
        $this->db->where('approval',1);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }

    /*count total inactive partners*/
    public function get_total_inactive_partners(){
        $this->db->select('COUNT(*) as total');
        $this->db->from('partner_info');
        $this->db->where('is_deleted',0);
        $this->db->where('status',0);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }


    /*Fetch all partners*/

    public function get_all_partnerss(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_role',4);
        $query=$this->db->get();
        return $query->result_array();
    }


    public function get_all_partners(){
    $this->db->select('partner_info.*, states.id as st_id,states.name as st_name, cities.id as c_id,cities.name as c_name');
    $this->db->from('partner_info');
    $this->db->join('users' ,'users.id = partner_info.user_id');
    $this->db->join('states' ,'states.id = partner_info.state');
    $this->db->join('cities' ,'cities.id = partner_info.city');
    $this->db->where('is_deleted',0);
    $this->db->where('users.user_role',4);
    $this->db->order_by('id', 'DESC');
    $query=$this->db->get();
    return $query->result_array();
    }

    // public function get_all_partners(){
    //     $this->db->select('*');
    //     $this->db->from('partner_info');
    //     $this->db->where('is_deleted',0);
    //     $this->db->order_by('id', 'DESC');
    //     //$this->db->order_by('owner_name', 'Asc');
    //     $query=$this->db->get();
    //     return $query->result_array();
    // }


    public function get_all_deleted_partners(){

    $this->db->select('partner_info.*, states.id as st_id,states.name as st_name, cities.id as c_id,cities.name as c_name');
    $this->db->from('partner_info');
    $this->db->join('users' ,'users.id = partner_info.user_id');
    $this->db->join('states' ,'states.id = partner_info.state');
    $this->db->join('cities' ,'cities.id = partner_info.city');
    $this->db->where('is_deleted',1);
    $this->db->where('users.user_role',4);
    $this->db->order_by('owner_name', 'Asc');
    //$this->db->order_by('id', 'DESC');
    $query=$this->db->get();
    return $query->result_array();

    }

    // public function get_all_deleted_partners(){
    //     $this->db->select('*');
    //     $this->db->from('partner_info');
    //     $this->db->where('is_deleted',1);
    //     $this->db->order_by('owner_name', 'Asc');
    //     $query=$this->db->get();
    //     return $query->result_array();
    // }

    /*Fetch single partner to edit*/
   public function get_partner_by_id($id){
    $this->db->select('*');
    $this->db->from('partner_info');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }

   public function get_partner_by_id_from_users($id){
    $this->db->select('*');
    $this->db->from('partner_info');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }

   

   /*Fetch partner's email for send email*/
   public function get_partner_email($id){
    $this->db->select('email');
    $this->db->from('partner_info');
    $this->db->where('id',$id);
    $query=$this->db->get();
    if($query->num_rows()==1)
        {
            $row = $query->result_array();
            return $row[0];
        }
        else
        {
            return false;
        }
   }
   /*Update partner with genrated Username and Password*/
   public function update_username_password_partner($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('partner_info',$data)){
            return true;
        }else{
            return false;
        }
    }


    /*update status of partner in users table*/
    public function update_status_user_table($user_id,$data){
        $this->db->where('id',$user_id);
        if($this->db->update('users',$data)){
            return true;
        }else{
            return false;
        }
    }

    /*Update approval status in users table*/
    public function update_approval_user_table($user_id,$data){
        $this->db->where('id',$user_id);
        if($this->db->update('users',$data)){
            return true;
        }else{
            return false;
        }
    }


    /*Get user_id from partner_info table*/
    public function get_partner_userid($id){
            $this->db->select('user_id');
            $this->db->from('partner_info');
            $this->db->where('id',$id);
            $query = $this->db->get();        
            $result = $query->row();
            return $result->user_id;
    }

   
    public function update_partner($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('partner_info',$data)){
            return true;
        }else{
            return false;
        }
    }
    /*update partner's status for active and inactive*/
    public function update_partner_status($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('partner_info',$data)){
            return true;
        }else{
            return false;
        }
    }
    /*Delete a partner*/
   
   public function delete_partner($id,$data){
    $this->db->where('id', $id);
    if($this->db->update('partner_info',$data)){
        return true;
    }else{

        return false;
    }
   }
   /*Add new partner*/
   public function add_new_partner($data){
    if($this->db->insert('partner_info', $data)){
        return true;
    }else{
        return false;
    }
   }
   /*update partner info after get approval by admin*/
   public function approval_by_admin($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('partner_info',$data)){
            return true;
        }else{
            return false;
        }
    }

   
    public function assigned_to_this_admin($id,$data){
        $this->db->where('id', $id);
        if($this->db->update('partner_info', $data)){
            return true;
        }else{
            return false;
        }
   }

   public function restore_this_partner($id,$data){
    $this->db->where('id', $id);
        if($this->db->update('partner_info', $data)){
            return true;
        }else{
            return false;
        }
   }


   public function get_partner_details($id){
    $this->db->select('partner_info.*, states.id as st_id,states.name as st_name, cities.id as c_id,cities.name as c_name');
    $this->db->from('partner_info');
    $this->db->join('states' ,'states.id = partner_info.state');
    $this->db->join('cities' ,'cities.id = partner_info.city');
    $this->db->where('partner_info.id',$id);
    $query=$this->db->get();
    return $query->row();
   }

   public function view_deleted_partner_details($id){
    $this->db->select('partner_info.*, states.id as st_id,states.name as st_name, cities.id as c_id,cities.name as c_name');
    $this->db->from('partner_info');
    $this->db->join('states' ,'states.id = partner_info.state');
    $this->db->join('cities' ,'cities.id = partner_info.city');
    $this->db->where('partner_info.id',$id);
    $query=$this->db->get();
    return $query->row();
   }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Banners extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   /*update banner content*/ 
    public function update_banner_content($data){
        if($this->db->insert('banner_content',$data)){
            return true;
        }else{
            return false; 
        }
    }

    /*Fetch all banners*/
    public function get_all_banners_details(){
        $this->db->select('*');
        $this->db->from('banner_content');
        $this->db->order_by("id", "DESC");
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_all_active_banners_details(){
        $this->db->select('*');
        $this->db->from('banner_content');
        $this->db->where('status',1);
        $this->db->order_by("id", "DESC");
        $query=$this->db->get();
        return $query->result_array();
    }

    /*Delete banner*/
   public function delete_banner($id){
    $this->db->where('id', $id);
    $this->db->delete('banner_content');
   }

   /*update banner status*/
   public function update_banner_status($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('banner_content',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_banner_data($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('banner_content',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function get_banner_by_id($id){
        $this->db->select('*');
        $this->db->from('banner_content');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return $query->result_array();
    }

}
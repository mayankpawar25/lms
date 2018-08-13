<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Zones extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_zones(){

        $this->db->select('*');
        $this->db->from('zones');
        $query=$this->db->get();
        return $query->result_array();
    }


   public function get_zone_by_id($id){
    $this->db->select('*');
    $this->db->from('zones');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }



    public function update_zone($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('zones',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_zone_status($id,$data){

        $this->db->where('id',$id);
        if($this->db->update('zones',$data)){
            return true;
        }else{
            return false;
        }
    }

   public function delet_zone($id){

    $this->db->where('id', $id);
    $this->db->delete('zones');

   }

   public function add_new_zone($data){
    if($this->db->insert('zones', $data)){

        return true;
    }else{

        return false;
    }
   }

}
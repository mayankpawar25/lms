<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventorys extends CI_Model {
    
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_inventory(){
        $this->db->select('*');
        $this->db->from('inventory');
        $query=$this->db->get();
        return $query->result_array();
    }


   public function get_inventory_by_id($id){
    $this->db->select('*');
    $this->db->from('inventory');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }



    public function update_inventory($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('inventory',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_inventory_status($id,$data){

        $this->db->where('id',$id);
        if($this->db->update('inventory',$data)){
            return true;
        }else{
            return false;
        }
    }

   public function delete_inventory($id){
        $this->db->where('id', $id);
         $this->db->delete('inventory');
   }

   public function add_new_inventory($data){
    if($this->db->insert('inventory', $data)){

        return true;
    }else{

        return false;
    }
   }

}
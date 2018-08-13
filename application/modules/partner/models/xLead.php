<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead extends CI_Model {
    
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_leads(){
        $this->db->select('*');
        $this->db->from('leads_details');
        $query=$this->db->get();
        return $query->result_array();
    }


   public function get_subdistributor_by_id($id){
    $this->db->select('*');
    $this->db->from('leads_details');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }



    public function update_subdistributor($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_leads_status($id,$data){

        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }

   public function delete_leads($id){
        $this->db->where('id', $id);
         $this->db->delete('leads_details');
   }

   

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partners extends CI_Model {
    
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_partners(){
        //die("sdhjf");
        $this->db->select('*');
        $this->db->from('partner_info');
        $query=$this->db->get();
        return $query->result_array();
    }


   public function get_partner_by_id($id){
    $this->db->select('*');
    $this->db->from('partner_info');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }



    public function update_partner($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('partner_info',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_partner_status($id,$data){

        $this->db->where('id',$id);
        if($this->db->update('partner_info',$data)){
            return true;
        }else{
            return false;
        }
    }

   public function delete_partner($id){
        $this->db->where('id', $id);
         $this->db->delete('partner_info');
   }

   public function add_new_partner($data){
    if($this->db->insert('partner_info', $data)){

        return true;
    }else{

        return false;
    }
   }

}
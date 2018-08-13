<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Distributors extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_distributors(){

        $this->db->select('*');
        $this->db->from('distributor_info');
        $query=$this->db->get();
        return $query->result_array();
    }


   public function get_distributor_by_id($id){
    $this->db->select('*');
    $this->db->from('distributor_info');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }



    public function update_distributor($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('distributor_info',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_distributor_status($id,$data){

        $this->db->where('id',$id);
        if($this->db->update('distributor_info',$data)){
            return true;
        }else{
            return false;
        }
    }

   public function delete_distributor($id){
    $this->db->where('id', $id);
    $this->db->delete('distributor_info');

   }

   public function add_new_distributor($data){
    if($this->db->insert('distributor_info', $data)){

        return true;
    }else{

        return false;
    }
   }

}
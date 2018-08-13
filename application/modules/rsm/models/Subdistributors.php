<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Subdistributors extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_subdistributors(){

        $this->db->select('*');
        $this->db->from('subdistributor_info');
        $query=$this->db->get();
        return $query->result_array();
    }


   public function get_subdistributor_by_id($id){
    $this->db->select('*');
    $this->db->from('subdistributor_info');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }



    public function update_subdistributor($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('subdistributor_info',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_subdistributor_status($id,$data){

        $this->db->where('id',$id);
        if($this->db->update('subdistributor_info',$data)){
            return true;
        }else{
            return false;
        }
    }

   public function delete_subdistributor($id){
    $this->db->where('id', $id);
    $this->db->delete('subdistributor_info');

   }

   public function add_new_subdistributor($data){
    if($this->db->insert('subdistributor_info', $data)){

        return true;
    }else{

        return false;
    }
   }

}
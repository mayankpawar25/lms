<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */ 
class Cities extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    /*Select Cities by id*/
    public function get_cities($id){

        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('state_id',$id);
        $query=$this->db->get();
        return $query->result_array();

    }

    /*Select All Cities*/
    public function get_all_cities(){
        $this->db->select('*');
        $this->db->from('cities');
        //$this->db->limit(100);
        $query=$this->db->get();
        return $query->result_array();
    }

     /*public function get_all_edit_cities($customer_city){
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('id',$customer_city);
        //$this->db->limit(100);
        $query=$this->db->get();
        return $query->result_array();
    }*/
    /*Get City in Edit section*/
     public function get_edit_cities($id){

        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('state_id',$id);
        $query=$this->db->get();
        return $query->result_array();

    }
   

}
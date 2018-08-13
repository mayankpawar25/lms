<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */ 
class States extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_states(){

        $this->db->select('*');
        $this->db->from('states');
        $this->db->limit(100);
        $query=$this->db->get();
        return $query->result_array();
    }


   

}
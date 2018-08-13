<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */ 
class Bdm extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_all_bdms(){
        $this->db->select('*');
        $this->db->from('microsoft_bdm');
        $query=$this->db->get();
        return $query->result_array();
    }


   

}
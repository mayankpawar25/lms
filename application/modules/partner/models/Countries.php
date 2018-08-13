<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */ 
class Countries extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   /*Select All Countries*/
    public function get_all_countries(){

        $this->db->select('*');
        $this->db->from('countries');
        $query=$this->db->get();
        return $query->result_array();
    }


   

}
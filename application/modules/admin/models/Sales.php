<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */ 
class Sales extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   
    public function get_sales_motions(){
        $this->db->select('*');
        $this->db->from('sales_motion');
        //$this->db->limit(100);
        $query=$this->db->get();
        return $query->result_array();
    }


   

}
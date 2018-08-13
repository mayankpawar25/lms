<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */ 
class Current_status extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }

   /*Show Current Status of leads*/
    public function get_current_status_of_leads(){
        $this->db->select('*');
        $this->db->from('lead_current_status');
        //$this->db->limit(100);
        $query=$this->db->get();
        return $query->result_array();
    }


   

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class LeadCurrentStatusmodel extends CI_Model {
    //private $table = 'users';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

   
    public function get_id_by_name($name){
        $this->db->where(['status_types' => $name]);    
        $this->db->select('id');
        $this->db->from('lead_current_status');
        $query=$this->db->get();
        // echo $this->db->last_query();
        return $query->row_array();
    }
}
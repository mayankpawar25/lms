<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class ValueDealmodel extends CI_Model {
	//private $table = 'users';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

   
    public function get_id_by_name($name){
        $this->db->where(['deal_types' => $name]);    
        $this->db->select('id');
        $this->db->from('value_of_deal');
        $query=$this->db->get();

        return $query->row_array();
    }
}
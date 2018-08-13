<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Statemodel extends CI_Model {
	// private $table = 'states';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

   
    public function state_details(){
        $this->db->where('country_id',101);
        $this->db->select('id, name');
        $this->db->from('states');
        $query=$this->db->get();

        return $query->result_array();
    }

    public function state_names(){
        $this->db->where('country_id',101);
        $this->db->select('name');
        $this->db->from('states');
        $query=$this->db->get();

        return $query->result_array();
    }
}
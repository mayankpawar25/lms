<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Citymodel extends CI_Model {
	//private $table = 'cities';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

   
    public function get_id_by_name($name){
        $this->db->where(['name' => $name]);    
        $this->db->select('id, state_id');
        $this->db->from('cities');
        $query=$this->db->get();

        return $query->row_array();
    }

    public function cities_by_state_id($state_id){
        $this->db->where(['state_id' => $state_id]);    
        $this->db->select('id, name');
        $this->db->from('cities');
        $query=$this->db->get();

        return $query->result_array();
    }

    public function cities_name_state_id($state_id){
        $this->db->where(['state_id' => $state_id]);    
        $this->db->select('name');
        $this->db->from('cities');
        $query=$this->db->get();

        return $query->result_array();
    }

    public function get_cities(){
        $this->db->select('*');
        $this->db->from('states_n_cities');
        $query=$this->db->get();
        return $query->result_array();
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Bdmmodel extends CI_Model {
    //private $table = 'users';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function get_all_bdm($id=null){
        if($id){
            $this->db->where(['id' => $id]);
        }
        $this->db->select('*');
        $this->db->from('microsoft_bdm');
        $query=$this->db->get();

        if($query->num_rows() > 0){
        	return $query->result_array();
        }else{
        	return false;
        }
    }

    public function get_id_by_name($name){
        $this->db->where(['bdm_name LIKE ' => $name]);    
        $this->db->select('id');
        $this->db->from('microsoft_bdm');
        $query=$this->db->get();

        return $query->row_array();
    }
}
?>
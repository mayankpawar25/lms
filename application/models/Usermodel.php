<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Usermodel extends CI_Model {
    //private $table = 'users';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function get_admin($id=null){
        if($id){
            $this->db->where(['id' => $id]);
        }
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(['user_role' => 1, 'status' => 1, 'approval' => 1]);
        $query=$this->db->get();

        if($query->num_rows() > 0){
        	return $query->result_array();
        }else{
        	return false;
        }
    }
}
?>
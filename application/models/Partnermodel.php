<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Partnermodel extends CI_Model {
    //private $table = 'users';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

   
    public function get_id_by_contact_number($contact){
        $this->db->where(['contact_no' => $contact, 'status' => 1, 'approval' => 1]);    
        $this->db->select('id');
        $this->db->from('partner_info');
        $query=$this->db->get();

        return $query->row_array();
    }

    public function get_det_by_contact_number($contact){
        $this->db->where(['contact_no' => $contact, 'status' => 1, 'approval' => 1]);    
        $this->db->select('*');
        $this->db->from('partner_info');
        $query=$this->db->get();

        return $query->row_array();
    }
}
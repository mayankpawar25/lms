<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class FollowupDetailsmodel extends CI_Model {
    //private $table = 'users';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function insert_leads_followup($data){
        $this->db->insert('followup_details',$data);
        $insert_id = $this->db->insert_id();
        if($insert_id)
            return $insert_id;
        return false;
    }

    public function get_lead_followup(){
        $this->db->select('*');
        $this->db->from('followup_status');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_recent_partner_lead_followup($lead_id, $partner_id){
        $this->db->select('t1.*, t2.status');
        $this->db->from('followup_details t1');
        $this->db->join('followup_status t2','t1.status_id = t2.id', 'LEFT');
        $this->db->where(['lead_id' => $lead_id, 'partner_id' => $partner_id]);
        $this->db->limit(1,0);
        $this->db->order_by('t1.id', 'DESC');
        $query=$this->db->get();
        return $query->row_array();
    }


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Leadmodel extends CI_Model {
    //private $table = 'users';
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

   
    public function get_all_leads($id=null){
        if($id){
            $this->db->where(['id' => $id]);
        }
        $this->db->select('*');
        $this->db->from('leads_details');
        $this->db->WHERE('is_deleted', 0);
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_all_created_partner_leads($partner_id, $id=null){
        if($id){
            $this->db->where(['t1.id' => $id]);
        }
        
        $this->db->select('t1.*,t2.motion_types, t3.segment_types, t4.involvement_types, t5.days_types, t6.status_types, t7.deal_types, t8.name as city_name, t9.name as state_name, t10.bdm_name');
        $this->db->from('leads_details t1');
        $this->db->join('sales_motion t2', 't1.sales_motion = t2.id','left');
        $this->db->join('customer_segment t3', 't1.customer_segment = t3.id','left');
        $this->db->join('ms_involvement t4', 't1.involvement = t4.id','left');
        $this->db->join('expected_closing_date t5', 't1.expected_closing_date = t5.id','left');
        $this->db->join('lead_current_status t6', 't1.current_status_lead = t6.id','left');
        $this->db->join('value_of_deal t7', 't1.value_of_deal = t7.id','left');
        $this->db->join('cities t8', 't1.customer_city = t8.id','left');
        $this->db->join('states t9', 't1.customer_state = t9.id','left');
        $this->db->join('microsoft_bdm t10', 't1.ms_bdm = t10.id','left');
        $this->db->WHERE(['t1.is_deleted' => '0', 't1.approval' => '0', 'partner_id' => $partner_id]);
        $this->db->order_by("t1.id", "desc");

        $query=$this->db->get();

        /*echo $this->db->last_query();
        die;*/
        return $query->result_array();

    }

    public function get_all_assigned_partner_leads($partner_id, $id=null){
        if($id){
            $this->db->where(['t1.id' => $id]);
        }
        $this->db->select('t1.*,t2.motion_types, t3.segment_types, t4.involvement_types, t5.days_types, t6.status_types, t7.deal_types, t8.name as city_name, t9.name as state_name, t10.bdm_name');
        $this->db->from('leads_details t1');
        $this->db->join('sales_motion t2', 't1.sales_motion = t2.id','left');
        $this->db->join('customer_segment t3', 't1.customer_segment = t3.id','left');
        $this->db->join('ms_involvement t4', 't1.involvement = t4.id','left');
        $this->db->join('expected_closing_date t5', 't1.expected_closing_date = t5.id','left');
        $this->db->join('lead_current_status t6', 't1.current_status_lead = t6.id','left');
        $this->db->join('value_of_deal t7', 't1.value_of_deal = t7.id','left');
        $this->db->join('cities t8', 't1.customer_city = t8.id','left');
        $this->db->join('states t9', 't1.customer_state = t9.id','left');
        $this->db->join('microsoft_bdm t10', 't1.ms_bdm = t10.id','left');
        $this->db->WHERE(['t1.is_deleted' => '0', 't1.approval' => '1', 't1.status' => '1','assigned_to_partner' => $partner_id]);
        $this->db->order_by("t1.modified", "desc");
        $query=$this->db->get();
        return $query->result_array();

    }

    public function add_lead($data){
        $this->db->insert('leads_details',$data);
        $insert_id = $this->db->insert_id();
        if($insert_id)
            return $insert_id;
        return false;
    }

    public function verify_assigned_leads($partner_id, $id){
        $this->db->select('*');
        $this->db->from('leads_details');
        $this->db->where(['assigned_to_partner' => $partner_id, 'id' => $id]);
        $query=$this->db->get();
        $data = $query->row();
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }

    public function update_lead($data,$id){
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('leads_details');
        return true;
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Leads extends CI_Model {
    //private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
    }

    /*count total leads*/
    public function get_total_leads(){
        $this->db->select('COUNT(*) as total');
        $this->db->from('leads_details');
        //$this->db->where('user_role',4);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }
    /*count total approved leads*/
    public function get_total_approved_leads(){
        $this->db->select('COUNT(*) as total');
        $this->db->from('leads_details');
        $this->db->where('approval',1);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }
    /*count total inactive leads*/
    public function get_total_inactive_leads(){
        $this->db->select('COUNT(*) as total');
        $this->db->from('leads_details');
        $this->db->where('status',0);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }

    /* Get all the leads*/
    public function get_all_leads(){
        $this->db->select('leads_details.*, sales_motion.id as sales_motion_id, sales_motion.motion_types, customer_segment.id as customer_segment_id, customer_segment.segment_types, value_of_deal.id as value_of_deal_id, value_of_deal.deal_types, ms_involvement.id as involvement_id, ms_involvement.involvement_types, expected_closing_date.id as closing_date_id, expected_closing_date.days_types, lead_current_status.id as lead_current_status_id, lead_current_status.status_types, cities.id as city_id, cities.name as city_name, states.id as state_id, states.name');
        $this->db->from('leads_details');
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $query=$this->db->get();

        // echo $this->db->last_query();

        // die();

        return $query->result_array();
    }

    public function get_all_leads_data(){
        $this->db->select('leads_details.*, sales_motion.id as sales_motion_id, sales_motion.motion_types, customer_segment.id as customer_segment_id, customer_segment.segment_types, value_of_deal.id as value_of_deal_id, value_of_deal.deal_types, ms_involvement.id as involvement_id, ms_involvement.involvement_types, expected_closing_date.id as closing_date_id, expected_closing_date.days_types, lead_current_status.id as lead_current_status_id, lead_current_status.status_types, cities.id as city_id, cities.name as city_name, states.id as state_id, states.name, partner_info.owner_name');
        $this->db->from('leads_details');
        $this->db->where('leads_details.is_deleted',0);
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $this->db->join('partner_info' ,'partner_info.id = leads_details.assigned_to_partner', 'LEFT');
        $this->db->order_by('leads_details.id', 'DESC');
        $query=$this->db->get();

        // echo $this->db->last_query();

        // die();

        return $query->result_array();
    }


    public function get_all_deleted_leads(){
        $this->db->select('leads_details.*, sales_motion.id as sales_motion_id, sales_motion.motion_types, customer_segment.id as customer_segment_id, customer_segment.segment_types, value_of_deal.id as value_of_deal_id, value_of_deal.deal_types, ms_involvement.id as involvement_id, ms_involvement.involvement_types, expected_closing_date.id as closing_date_id, expected_closing_date.days_types, lead_current_status.id as lead_current_status_id, lead_current_status.status_types, cities.id as city_id, cities.name as city_name, states.id as state_id, states.name, partner_info.owner_name');
        $this->db->from('leads_details');
        $this->db->where('leads_details.is_deleted',1);
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $this->db->join('partner_info' ,'partner_info.id = leads_details.assigned_to_partner', 'LEFT');
        $this->db->order_by('leads_details.id', 'DESC');
        $query=$this->db->get();

        return $query->result_array();
    }

   public function get_lead_by_id($id){
    $this->db->select('*');
    $this->db->from('leads_details');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }
    public function update_lead($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function update_lead_status($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }
   public function delete_lead($id,$data){
    $this->db->where('id', $id);
    if($this->db->update('leads_details',$data)){
        return true;
    }else{

        return false;
    }
   }
   public function add_new_lead($data){
    if($this->db->insert('leads_details', $data)){
        return true;
    }else{
        return false;
    }
   }
   public function approval_by_partner($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function assigned_to_this_partner($id,$data){
        $this->db->where('id', $id);
        if($this->db->update('leads_details', $data)){
            return true;
        }else{
            return false;
        }
   }

    public function get_banner_details(){
        //die('hello');
        //$loggedin_data = $this->session->userdata('logged_in'); 
        $this->db->select('*');
        $this->db->from('banner_content');
        $this->db->where('image != ', '');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function get_lead_details($id){
        $this->db->select('leads_details.*, sales_motion.motion_types, customer_segment.segment_types, value_of_deal.deal_types, ms_involvement.involvement_types, expected_closing_date.days_types, lead_current_status.status_types, cities.name as city_name ,states.name');
        $this->db->from('leads_details');
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $this->db->where('leads_details.id',$id);
        $query=$this->db->get();
        return $query->row();
    }


    public function get_assigned_status_lead_details($id){
    $this->db->select('*');
    $this->db->from('followup_details');
    $this->db->where('lead_id',$id);
    $this->db->join('followup_status','followup_status.id=followup_details.status_id');
     $this->db->order_by("modified","desc");
    $query=$this->db->get();
    return $query->result_array();
   }

   public function get_partner_id($partner_id){
    $this->db->select('user_id');
    $this->db->from('partner_info');
    $this->db->where('id',$partner_id);
    $query=$this->db->get();
    //echo $this->db->last_query();
    return $query->row()->user_id;
   }

   public function update_followup_details($data){
        //$this->db->where('id', $id);
        if($this->db->insert('followup_details', $data)){
            return true;
        }else{
            return false;
        }
   }

   public function update_lead_details($id,$data){
        $this->db->where('id', $id);
        if($this->db->update('leads_details', $data)){
            return true;
        }else{
            return false;
        }
   }

   public function restore_this_lead($id,$data){
    $this->db->where('id', $id);
        if($this->db->update('leads_details', $data)){
            return true;
        }else{
            return false;
        }
   } 

    public function get_partner_details($id){
        $this->db->select('partner_info.*,cities.name as city_name ,states.name as state_name');
        $this->db->from('partner_info');
        $this->db->join('states' ,'states.id = partner_info.state');
        $this->db->join('cities' ,'cities.id = partner_info.city');
        $this->db->where('partner_info.id',$id);
        $query=$this->db->get();
        return $query->row();
    }
}
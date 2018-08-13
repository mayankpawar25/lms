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
    /*Get All leads*/
   public function get_all_leads(){
        $this->db->select('leads_details.*,sales_motion.id as sales_motion_id,sales_motion.motion_types,customer_segment.id as customer_segment_id,customer_segment.segment_types,value_of_deal.id as value_of_deal_id ,value_of_deal.deal_types,ms_involvement.id as involvement_id,ms_involvement.involvement_types,expected_closing_date.id as closing_date_id,expected_closing_date.days_types,lead_current_status.id as lead_current_status_id,lead_current_status.status_types,cities.id as city_id,cities.name as city_name,states.id as state_id,states.name');
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
        return $query->result_array();
    }
    /*Show Assigned Leads*/
    public function get_assigned_leads(){
        $this->db->select('leads_details.*,sales_motion.id as sales_motion_id,sales_motion.motion_types,customer_segment.id as customer_segment_id,customer_segment.segment_types,value_of_deal.id as value_of_deal_id ,value_of_deal.deal_types,ms_involvement.id as involvement_id,ms_involvement.involvement_types,expected_closing_date.id as closing_date_id,expected_closing_date.days_types,lead_current_status.id as lead_current_status_id,lead_current_status.status_types,cities.id as city_id,cities.name as city_name,states.id as state_id,states.name');
        $this->db->from('leads_details');
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        //$this->db->join('users' ,'users.full_name = partner_info.owner_name');
        $query=$this->db->get();
        return $query->result_array();
    }
    /*Show All deleted leads*/
    public function get_all_deleted_leads(){
        $partner_id = $this->session->userdata('logged_in')->partner_id;
        $this->db->select('leads_details.*,sales_motion.id as sales_motion_id,sales_motion.motion_types,customer_segment.id as customer_segment_id,customer_segment.segment_types,value_of_deal.id as value_of_deal_id ,value_of_deal.deal_types,ms_involvement.id as involvement_id,ms_involvement.involvement_types,expected_closing_date.id as closing_date_id,expected_closing_date.days_types,cities.id as city_id,cities.name as city_name,states.id as state_id,states.name,leads_details.ms_bdm ,microsoft_bdm.id as bdm_id,microsoft_bdm.bdm_name');
        $this->db->from('leads_details');
        $this->db->where('is_deleted',1);
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('microsoft_bdm','microsoft_bdm.id = leads_details.ms_bdm');
        //$this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $this->db->where('partner_id= '.$partner_id.' AND ( assigned_to_partner=0 OR approval=0)');
        $this->db->order_by("leads_details.id", "desc");
        $query=$this->db->get();

        // echo $this->db->last_query();
        // die();
        return $query->result_array();
    }


    /*Partner Profile Change*/
    public function change_profile_pic($id,$data){
        $this->db->where('id',$id);
        if ($this->db->update('users',$data)){
           return true;
        }else{
            return false;
        }
    }
    /*Partner Password Chnage*/
    public function change_password($id,$data){
        $this->db->where('id',$id);
        if ($this->db->update('users',$data)){
            $insert_id = $this->db->insert_id();
           return $insert_id;
        }else{
            return false;
        }
    }
    /*Show Leads by ID*/
   public function get_lead_by_id($id){
    $this->db->select('*');
    $this->db->from('leads_details');
    $this->db->where('id',$id);
    $query=$this->db->get();
    return $query->result_array();
   }
   /*Show lead Details*/
   public function get_lead_details($id){
    $this->db->select('leads_details.*, sales_motion.motion_types, customer_segment.segment_types, value_of_deal.deal_types, ms_involvement.involvement_types, expected_closing_date.days_types, microsoft_bdm.bdm_name, cities.name as city_name ,states.name ,followup_details.status_id ,followup_status.status as status_name,followup_details.description as lead_status_description ');
    $this->db->from('leads_details');
    $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion','LEFT');
    $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment','LEFT');
    $this->db->join('states' ,'states.id = leads_details.customer_state','LEFT');
    $this->db->join('cities' ,'cities.id = leads_details.customer_city','LEFT');
    $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal','LEFT');
    $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement','LEFT');
    $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date','LEFT');
    $this->db->join('microsoft_bdm','microsoft_bdm.id = leads_details.ms_bdm' ,'LEFT' );
    //$this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
     $this->db->join('followup_details' ,'followup_details.lead_id = leads_details.id','LEFT');
    $this->db->join('followup_status' ,'followup_status.id = followup_details.status_id','LEFT');
    $this->db->order_by("followup_details.modified", "desc");
    $this->db->where('leads_details.id',$id);
    $query=$this->db->get();
    return $query->row();
   }
   /*Update Leads*/
    public function update_lead($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }
    /*Update leads status*/
    public function update_lead_status($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }
   /*delete Leads function*/ 
   public function delete_lead($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }

     /*Restore Delete Leads*/
    public function restore_delete_lead($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }

   /*Add New Lead Function*/ 
   public function add_new_lead($data){
    //$this->db->insert('leads_details', $data);
    if($this->db->insert('leads_details', $data)){

       
        return true;
    }else{
        return false;
    }
   }
   /*Leads Approval by partner*/
   public function approval_by_partner($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('leads_details',$data)){
            return true;
        }else{
            return false;
        }
    }
    /*Leads Assigned to partner*/
    public function assigned_to_this_partner($id,$data){
        $this->db->where('id', $id);
        if($this->db->update('leads_details', $data)){
            return true;
        }else{
            return false;
        }
   } 
   /*Show specific leads to partner*/
   public function get_all_created_leads(){
        $partner_id = $this->session->userdata('logged_in')->partner_id;
        $this->db->select('leads_details.*,sales_motion.id as sales_motion_id,sales_motion.motion_types,customer_segment.id as customer_segment_id,customer_segment.segment_types,value_of_deal.id as value_of_deal_id ,value_of_deal.deal_types,ms_involvement.id as involvement_id,ms_involvement.involvement_types,expected_closing_date.id as closing_date_id,expected_closing_date.days_types,cities.id as city_id,cities.name as city_name,states.id as state_id,states.name,leads_details.ms_bdm ,microsoft_bdm.id as bdm_id,microsoft_bdm.bdm_name');
        $this->db->from('leads_details');
        $this->db->where('is_deleted',0);
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('microsoft_bdm','microsoft_bdm.id = leads_details.ms_bdm');
        //$this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $this->db->where('partner_id= '.$partner_id.' AND ( assigned_to_partner=0 OR approval=0)');
        $this->db->order_by("leads_details.id", "desc");
        $query=$this->db->get();

        // echo $this->db->last_query();
        // die();
        return $query->result_array();
    }
    /*Show Assigned leads to Partner*/
    public function get_assigned_leads_of_partner(){
        $partner_id = $this->session->userdata('logged_in')->partner_id;
        $this->db->select('leads_details.*,sales_motion.id as sales_motion_id,sales_motion.motion_types,customer_segment.id as customer_segment_id,customer_segment.segment_types,value_of_deal.id as value_of_deal_id ,value_of_deal.deal_types,ms_involvement.id as involvement_id,ms_involvement.involvement_types,expected_closing_date.id as closing_date_id,expected_closing_date.days_types,cities.id as city_id,cities.name as city_name,states.id as state_id,states.name,leads_details.ms_bdm ,microsoft_bdm.id as bdm_id,microsoft_bdm.bdm_name');
        $this->db->from('leads_details');
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('microsoft_bdm','microsoft_bdm.id = leads_details.ms_bdm');
        //$this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $this->db->where(['assigned_to_partner'=> $partner_id , 'approval'=> 1]);
        $this->db->order_by("leads_details.modified", "desc");
        //$this->db->join('users' ,'users.full_name = partner_info.owner_name');
        $query=$this->db->get();

       
        return $query->result_array();
    }
    
    /*count total leads*/
    public function get_total_leads(){
       $loggedin_data = $this->session->userdata('logged_in'); 
       $this->db->select('COUNT(*) as total');
        $this->db->from('leads_details');
        $this->db->where('partner_id',$loggedin_data->partner_id);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }
    /*count total approved leads*/
    public function get_total_unassigned_leads(){
        $partner_id = $this->session->userdata('logged_in')->partner_id;
        $this->db->select('leads_details.*,sales_motion.id as sales_motion_id,sales_motion.motion_types,customer_segment.id as customer_segment_id,customer_segment.segment_types,value_of_deal.id as value_of_deal_id ,value_of_deal.deal_types,ms_involvement.id as involvement_id,ms_involvement.involvement_types,expected_closing_date.id as closing_date_id,expected_closing_date.days_types,cities.id as city_id,cities.name as city_name,states.id as state_id,states.name,leads_details.ms_bdm ,microsoft_bdm.id as bdm_id,microsoft_bdm.bdm_name');
        $this->db->from('leads_details');
        $this->db->where('is_deleted',0);
        $this->db->join('sales_motion' ,'sales_motion.id = leads_details.sales_motion');
        $this->db->join('customer_segment' ,'customer_segment.id = leads_details.customer_segment');
        $this->db->join('states' ,'states.id = leads_details.customer_state');
        $this->db->join('cities' ,'cities.id = leads_details.customer_city');
        $this->db->join('value_of_deal' ,'value_of_deal.id = leads_details.value_of_deal');
        $this->db->join('ms_involvement' ,'ms_involvement.id = leads_details.involvement');
        $this->db->join('expected_closing_date' ,'expected_closing_date.id = leads_details.expected_closing_date');
        $this->db->join('microsoft_bdm','microsoft_bdm.id = leads_details.ms_bdm');
        //$this->db->join('lead_current_status' ,'lead_current_status.id = leads_details.current_status_lead');
        $this->db->where('partner_id= '.$partner_id.' AND ( assigned_to_partner=0 OR approval=0)');
        $this->db->order_by("leads_details.id", "desc");
        $query=$this->db->get();

        // echo $this->db->last_query();
        // die();
        return $query->result_array();
    }
    /*count total inactive leads*/
    public function get_total_assigned_leads(){
        $loggedin_data = $this->session->userdata('logged_in'); 
        $this->db->select('COUNT(*) as total');
        $this->db->from('leads_details');
        $this->db->where('assigned_to_partner',$loggedin_data->partner_id);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }
    /*select profile Details*/
     public function get_profile_details(){
         $loggedin_data = $this->session->userdata('logged_in'); 
        $this->db->select('partner_info.*,states.name as states_name,cities.name as city_name');
        $this->db->from('partner_info');
        $this->db->where('user_id',$loggedin_data->id);
        $this->db->join('states','states.id=partner_info.state', 'LEFT');
        $this->db->join('cities','cities.id=partner_info.city', "LEFT");
        $query=$this->db->get();
        return $query->result_array();
    }
    /*Select Banner details*/
     public function get_banner_details(){
        //die('hello');
        //$loggedin_data = $this->session->userdata('logged_in'); 
        $this->db->select('*');
        $this->db->from('banner_content');
        $this->db->where('status',1);
        $query=$this->db->get();
        return $query->result_array();
    }
    /*Select Followup status*/
     public function get_followup_status(){
        $this->db->select('*');
        $this->db->from('followup_status');
         $this->db->where("(id=2 OR id='3' OR id='4' OR id='5' OR id='6' OR id='7')");
        $query=$this->db->get();
        return $query->result_array();
    }

     /*Edit or update assigned leads*/
    public function update_edit_lead($data){
       if($this->db->insert('followup_details', $data)){
        return true;
    }else{
        return false;
    }
    }
    /*Select Assigned status*/
    public function get_assigned_status(){
        $this->db->select('*');
        $this->db->from('followup_details');
        $this->db->join('followup_status','followup_status.id=followup_details.status_id');
        $this->db->order_by("followup_details.modified","desc");
        $query=$this->db->get();
        return $query->result_array();
    }
    /*Select Assigned status details by id */
    public function get_assigned_status_lead_details($id){
    $this->db->select('*');
    $this->db->from('followup_details');
    $this->db->where('lead_id',$id);
    $this->db->join('followup_status','followup_status.id=followup_details.status_id');
     $this->db->order_by("followup_details.modified","desc");
    $query=$this->db->get();
    return $query->result_array();
   }

    /*update assigned leads modified in leads details*/
    public function update_lead_time($id,$data){
        $this->db->where('id',$id);
         if($this->db->update('leads_details',$data)){
            return true;
         }else{
            return false;
        }
       
    }

    /*Show lead status in assigned leads*/
    public function assigned_status_lead_details(){
    $this->db->select('*');
    $this->db->from('followup_details');
   //$this->db->where('lead_id',$id);
    $this->db->join('followup_status','followup_status.id=followup_details.status_id');
    $this->db->order_by("modified","desc");
    //$this->db->limit(10);
    $query=$this->db->get();
    return $query->row_array();
   }

   public function assigned_lead_status_details($lead_id, $partner_id){
        $this->db->select('followup_details.*,followup_status.status,');
        $this->db->from('followup_details');
        $this->db->join('followup_status','followup_status.id=followup_details.status_id');
        $this->db->where(['lead_id'=>$lead_id, 'partner_id'=>$partner_id]);
        $this->db->order_by("modified","desc");
        $query=$this->db->get();
        return $query->row_array();
   }

   public function change_name($id,$data){
        $this->db->where('user_id',$id);
        if ($this->db->update('partner_info',$data)){
            $insert_id = $this->db->insert_id();
            //echo $this->db->last_query();
            //die();
           return $insert_id;
        }else{
            return false;
        }
    }

    public function get_lead_name_by_id($id){
        $this->db->select('customer_name,id');
        $this->db->from('leads_details');
        $this->db->where('id',$id);
        //$this->db->join('followup_status','followup_status.id=followup_details.status_id');
         //$this->db->order_by("modified","desc");
        $query=$this->db->get();
        return $query->row();
    }

     /*Check RSM Password */
    public function checkpassword($id,$password){

        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id',$id);
        $this->db->where('password',$password);
        $query = $this->db->get();
        $data =  $query->row();
        if ($data){
            return true;
        }else{
            return false;
        }   
    }
/*Check Partner Password */

/*Change Partner Password*/
   public function changepassword($id,$data){

        $this->db->where('id',$id);
        $res = $this->db->update('users',$data);
        return $res;
           
    }
/*Change Partner Password*/ 


/*select profile Details*/
     public function get_popup_profile_details(){
        $loggedin_data = $this->session->userdata('logged_in'); 
        $this->db->select('partner_info.*,states.name as states_name,cities.name as city_name');
        $this->db->from('partner_info');
        $this->db->where('user_id',$loggedin_data->id);
        $this->db->join('states','states.id=partner_info.state','left');
        $this->db->join('cities','cities.id=partner_info.city','left');
        $query=$this->db->get();
        return $query->result_array();
    }     
}
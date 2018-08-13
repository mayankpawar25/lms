<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Leads extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Leadmodel');
        $this->load->model('Partnermodel');
    }

    public function index_get($contact, $id=NULL){   
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);
        
        if(isset($parnter_det['id'])){
            
            $partner_id = (int) $parnter_det['id'];

            // If the id parameter doesn't exist return all the users
            $user = array();
            $auser = array();
            if ($id === NULL)
            {
                 // Leads from a data store e.g. database
                $leads = $this->Leadmodel->get_all_created_partner_leads($partner_id);  

                $assigned_leads = $this->Leadmodel->get_all_assigned_partner_leads($partner_id);
            }else{
                
                $leads = $this->Leadmodel->get_all_created_partner_leads($partner_id,$id);
           
                $assigned_leads = $this->Leadmodel->get_all_assigned_partner_leads($partner_id,$id);
            
            }

            /*echo "<pre>";
            print_r($leads);
            die;*/
                
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($leads)
            {
                
                foreach ($leads as $key => $value)
                {   
                    if (isset($value['id']))
                    {
                        if ($id === NULL){
                            $user[$key]['id'] = $value['id'];
                            $user[$key]['lead_date'] = $value['registration_date'];
                            $user[$key]['email'] = $value['lead_email'];
                            $user[$key]['contact'] = $value['lead_mobile'];
                            $user[$key]['lead_id'] = $value['lead_id'];
                            $user[$key]['sales_motion'] = $value['motion_types'];
                            $user[$key]['customer_segment'] = $value['segment_types'];
                            $user[$key]['other_segment'] = $value['other_segment'];
                            $user[$key]['customer_name'] = $value['customer_name'];
                            $user[$key]['customer_state'] = $value['state_name'];
                            $user[$key]['customer_city'] = $value['city_name'];
                            $user[$key]['pincode'] = $value['pin_code'];
                            $user[$key]['value_of_deal'] = $value['deal_types'];
                            $user[$key]['total_deal_value'] = $value['total_deal_value'];
                            $user[$key]['sku'] = $value['sku'];
                            $user[$key]['expected_license'] = $value['expected_license'];
                            $user[$key]['product'] = $value['product'];
                            $user[$key]['deal_size'] = $value['deal_size'];
                            $user[$key]['tender_type'] = $value['tender_type'];
                            $user[$key]['ms_product'] = $value['product_required'];
                            $user[$key]['ms_involvement'] = $value['involvement_types'];
                            $user[$key]['bdm_name'] = $value['bdm_name'];
                            $user[$key]['expected_date_of_closing'] = $value['days_types'];
                            $user[$key]['current_status_of_the_lead'] = $value['status_types'];
                            $user[$key]['current_status_of_the_lead'] = "";
                            $user[$key]['status_description'] = "";
                            $user[$key]['order_lost'] = $value['order_lost'];
                            $user[$key]['cat_id'] = 2;
                            $user[$key]['is_edit'] = true;
                        }else{
                            $user['id'] = $value['id'];
                            $user['lead_date'] = $value['registration_date'];
                            $user['email'] = $value['lead_email'];
                            $user['contact'] = $value['lead_mobile'];
                            $user['lead_id'] = $value['lead_id'];
                            $user['sales_motion'] = $value['motion_types'];
                            $user['customer_segment'] = $value['segment_types'];
                            $user['other_segment'] = $value['other_segment'];
                            $user['customer_name'] = $value['customer_name'];
                            $user['customer_state'] = $value['state_name'];
                            $user['customer_city'] = $value['city_name'];
                            $user['pincode'] = $value['pin_code'];
                            $user['value_of_deal'] = $value['deal_types'];
                            $user['total_deal_value'] = $value['total_deal_value'];
                            $user['sku'] = $value['sku'];
                            $user['expected_license'] = $value['expected_license'];
                            $user['product'] = $value['product'];
                            $user['deal_size'] = $value['deal_size'];
                            $user['tender_type'] = $value['tender_type'];
                            $user['ms_product'] = $value['product_required'];
                            $user['ms_involvement'] = $value['involvement_types'];
                            $user['bdm_name'] = $value['bdm_name'];
                            $user['expected_date_of_closing'] = $value['days_types'];
                            $user['current_status_of_the_lead'] = "";
                            $user['status_description'] = "";
                            $user['order_lost'] = $value['order_lost'];
                            $user['cat_id'] = 2;
                            $user['is_edit'] = true;
                        }
                    }
                }
                
                
            }

            if($assigned_leads){
                foreach ($assigned_leads as $key => $value)
                {
                
                    if (isset($value['id']))
                    {
                        if ($id === NULL){

                            $this->load->model('FollowupDetailsmodel');
                            $followup_dets = $this->FollowupDetailsmodel->get_recent_partner_lead_followup($value['id'], $partner_id);
                            
                            $auser[$key]['id'] = $value['id'];
                            $auser[$key]['lead_date'] = $value['registration_date'];
                            $auser[$key]['lead_id'] = $value['lead_id'];
                            $auser[$key]['email'] = $value['lead_email'];
                            $auser[$key]['contact'] = $value['lead_mobile'];
                            $auser[$key]['sales_motion'] = $value['motion_types'];
                            $auser[$key]['customer_segment'] = $value['segment_types'];
                            $auser[$key]['other_segment'] = $value['other_segment'];
                            $auser[$key]['customer_name'] = $value['customer_name'];
                            $auser[$key]['customer_state'] = $value['state_name'];
                            $auser[$key]['customer_city'] = $value['city_name'];
                            $auser[$key]['pincode'] = $value['pin_code'];
                            $auser[$key]['value_of_deal'] = $value['deal_types'];
                            $auser[$key]['total_deal_value'] = $value['total_deal_value'];
                            $auser[$key]['sku'] = $value['sku'];
                            $auser[$key]['expected_license'] = $value['expected_license'];
                            $auser[$key]['product'] = $value['product'];
                            $auser[$key]['deal_size'] = $value['deal_size'];
                            $auser[$key]['tender_type'] = $value['tender_type'];
                            $auser[$key]['ms_product'] = $value['product_required'];
                            $auser[$key]['ms_involvement'] = $value['involvement_types'];
                            $auser[$key]['bdm_name'] = $value['bdm_name'];
                            $auser[$key]['expected_date_of_closing'] = $value['days_types'];
                            $auser[$key]['current_status_of_the_lead'] = $followup_dets['status'];
                            $auser[$key]['status_description'] = $followup_dets['description'];
                            $auser[$key]['order_lost'] = $value['order_lost'];
                            $auser[$key]['cat_id'] = 1;
                            $auser[$key]['is_edit'] = false;
                        }else{
                            $this->load->model('FollowupDetailsmodel');
                            $followup_dets = $this->FollowupDetailsmodel->get_recent_partner_lead_followup($value['id'], $partner_id);

                            $auser['id'] = $value['id'];
                            $auser['lead_date'] = $value['registration_date'];
                            $auser['email'] = $value['lead_email'];
                            $auser['contact'] = $value['lead_mobile'];
                            $auser['lead_id'] = $value['lead_id'];
                            $auser['sales_motion'] = $value['motion_types'];
                            $auser['customer_segment'] = $value['segment_types'];
                            $auser['other_segment'] = $value['other_segment'];
                            $auser['customer_name'] = $value['customer_name'];
                            $auser['customer_state'] = $value['state_name'];
                            $auser['customer_city'] = $value['city_name'];
                            $auser['pincode'] = $value['pin_code'];
                            $auser['value_of_deal'] = $value['deal_types'];
                            $auser['total_deal_value'] = $value['total_deal_value'];
                            $auser['sku'] = $value['sku'];
                            $auser['expected_license'] = $value['expected_license'];
                            $auser['product'] = $value['product'];
                            $auser['deal_size'] = $value['deal_size'];
                            $auser['tender_type'] = $value['tender_type'];
                            $auser['ms_product'] = $value['product_required'];
                            $auser['ms_involvement'] = $value['involvement_types'];
                            $auser['bdm_name'] = $value['bdm_name'];
                            $auser['expected_date_of_closing'] = $value['days_types'];
                            $auser['current_status_of_the_lead'] = $followup_dets['status'];
                            $auser['status_description'] = $followup_dets['description'];
                            $auser['order_lost'] = $value['order_lost'];
                            $auser['cat_id'] = 1;
                            $auser['is_edit'] = false;
                        }
                    }
                }

            }

            if(empty($user) && empty($auser)){
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No leads were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }else{
                // Set the response and exit
                $data = array_merge($user, $auser);

                $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }

        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Account is Inactive'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }  
    }

    public function leads_post(){
        $contact = $this->post('contact');
        
        /* Get partner id by contact number and its active or not... */
        $partner_det = $this->Partnermodel->get_id_by_contact_number($contact);

        if(isset($partner_det['id'])){
            $json_data = json_decode($this->post('leads'));

            $this->load->model('SalesMotionmodel');
            $this->load->model('CustomerSegmentmodel');
            $this->load->model('Citymodel');
            $this->load->model('ValueDealmodel');
            $this->load->model('MsInvolvementmodel');
            $this->load->model('ExpectedClosingDatemodel');
            $this->load->model('LeadCurrentStatusmodel');
            $this->load->model('Bdmmodel');

            /* Get Sales motion id */
            $sales_motion_det = $this->SalesMotionmodel->get_id_by_name($json_data->sales_motion);

            /* Get Customer Segment id */
            $customer_segment_det = $this->CustomerSegmentmodel->get_id_by_name($json_data->customer_segment);

            /* Get Customer city, state id */
            $city_det = $this->Citymodel->get_id_by_name($json_data->customer_city);


            /* Get Value Deal id */
            $value_of_deal_det = $this->ValueDealmodel->get_id_by_name($json_data->value_of_deal);

            /* Get Ms Invlovement id */
            $ms_involvement_det = $this->MsInvolvementmodel->get_id_by_name($json_data->ms_involvement);

            /* Get Expected Closing Date id */
            $expected_closing_date_det = $this->ExpectedClosingDatemodel->get_id_by_name($json_data->expected_date_of_closing);

            /* Get lead_current_status id */
            $lead_current_status_det = $this->LeadCurrentStatusmodel->get_id_by_name($json_data->current_status_of_the_lead);

            /* Get lead_current_status id */
            $bdm_det = $this->Bdmmodel->get_id_by_name($json_data->bdm_name);

            $json_data->expected_date_of_closing;
           
            $data = [
                        'registration_date'=>$json_data->lead_date,
                        'lead_email'=>$json_data->email,
                        'lead_mobile'=>$json_data->contact,
                        'sales_motion'=>$sales_motion_det['id'],
                        'customer_segment'=>$customer_segment_det['id'],
                        'other_segment'=>$json_data->other_segment,
                        'customer_name'=>$json_data->customer_name,
                        'customer_state'=>$city_det['state_id'],
                        'customer_city'=>$city_det['id'],
                        'pin_code'=>$json_data->pincode,
                        'value_of_deal'=>$value_of_deal_det['id'],
                        'total_deal_value'=>$json_data->total_deal_value,
                        'sku'=>$json_data->sku,
                        'expected_license'=>$json_data->expected_license,
                        'product'=>$json_data->product,
                        'deal_size'=>$json_data->deal_size,
                        'tender_type'=>$json_data->tender_type,
                        'product_required'=>$json_data->ms_product,
                        'involvement'=>$ms_involvement_det['id'],
                        'ms_bdm'=>$bdm_det['id'],
                        'expected_closing_date'=>$expected_closing_date_det['id'],
                        'current_status_lead'=>$lead_current_status_det['id'],
                        'approval'=> 0,
                        'partner_id'=> $partner_det['id'],
                        'order_lost'=>$json_data->order_lost,
                        'created'=> date('d-m-Y H:i:s'),
                        'modified'=> date('d-m-Y H:i:s')
                    ];

            $lead_id = $this->Leadmodel->add_lead($data);
           
            if($lead_id){
            	$partner_dets = $this->Partnermodel->get_det_by_contact_number($contact);
            	$this->send_notifications($lead_id, $partner_dets);


                $this->response([
                    'id' => $lead_id,
                    'message' => 'Added a lead'
                ], REST_Controller::HTTP_CREATED); // NOT_FOUND (404) being the HTTP response code
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Issue inserting Data'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Account is Inactive'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function add_leads_post(){
        $contact = $this->post('contact');
        
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);

        if(isset($parnter_det['id'])){
            $json_data = json_decode($this->post('leads'));

            // $this->load->model('SalesMotionmodel');
            // $this->load->model('CustomerSegmentmodel');
            $this->load->model('Citymodel');
            // $this->load->model('ValueDealmodel');
            // $this->load->model('MsInvolvementmodel');
            // $this->load->model('ExpectedClosingDatemodel');
            // $this->load->model('LeadCurrentStatusmodel');

            /* Get Sales motion id */
            // $sales_motion_det = $this->SalesMotionmodel->get_id_by_name($json_data->sales_motion);

            /* Get Customer Segment id */
            // $customer_segment_det = $this->CustomerSegmentmodel->get_id_by_name($json_data->customer_segment);

            /* Get Customer city, state id */
            $city_det = $this->Citymodel->get_id_by_name($json_data->customer_city);


            /* Get Value Deal id */
            // $value_of_deal_det = $this->ValueDealmodel->get_id_by_name($json_data->value_of_deal);

            /* Get Ms Invlovement id */
            // $ms_involvement_det = $this->MsInvolvementmodel->get_id_by_name($json_data->ms_involvement);

            /* Get Expected Closing Date id */
            // $expected_closing_date_det = $this->ExpectedClosingDatemodel->get_id_by_name($json_data->expected_date_of_closing);

             /* Get lead_current_status id */
            // $lead_current_status_det = $this->LeadCurrentStatusmodel->get_id_by_name($json_data->current_status_of_the_lead);

            $json_data->expected_date_of_closing;
           
            $data = [
                        'registration_date'=>$json_data->lead_date,
                        'lead_email'=>$json_data->email,
                        'lead_mobile'=>$json_data->contact,
                        'sales_motion'=>$json_data->sales_motion,
                        'customer_segment'=>$json_data->customer_segment,
                        'other_segment'=>$json_data->other_segment,
                        'customer_name'=>$json_data->customer_name,
                        'customer_state'=>$city_det['state_id'],
                        'customer_city'=>$city_det['id'],
                        'pin_code'=>$json_data->pincode,
                        'value_of_deal'=>$json_data->value_of_deal,
                        'total_deal_value'=>$json_data->total_deal_value,
                        'sku'=>$json_data->sku,
                        'expected_license'=>$json_data->expected_license,
                        'product'=>$json_data->product,
                        'deal_size'=>$json_data->deal_size,
                        'tender_type'=>$json_data->tender_type,
                        'product_required'=>$json_data->ms_product,
                        'involvement'=>$json_data->ms_involvement,
                        'expected_closing_date'=>$json_data->expected_date_of_closing,
                        'current_status_lead'=>$json_data->current_status_of_the_lead,
                        'approval'=> 0,
                        'partner_id'=> $parnter_det['id'],
                        'order_lost'=>$json_data->order_lost,
                        'created'=> date('d-m-Y H:i:s')
                    ];
            $lead_id = $this->Leadmodel->add_lead($data);
            if($lead_id){
                $this->response([
                    'id' => $lead_id,
                    'message' => 'Added a lead'
                ], REST_Controller::HTTP_CREATED); // NOT_FOUND (404) being the HTTP response code
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Issue inserting Data'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Account is Inactive'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function assigned_leads_post(){
        $contact = $this->post('contact');
        
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);

        if(isset($parnter_det['id'])){
            $this->load->model('FollowupDetailsmodel');

            $json_data = (array)json_decode($this->post('leads'));
            
            if(empty($json_data)){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid followups status'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                exit;
            }

            /* Check lead is assigned to the partner */
            $lead_data = $this->Leadmodel->verify_assigned_leads($parnter_det['id'], $json_data['lead_id']);

            if($lead_data){
                $data['lead_id'] = $json_data['lead_id'];
                $data['partner_id'] = $parnter_det['id'];
                $data['status_id'] = $json_data['status_id'];
                $data['description'] = $json_data['description'];
                $data['created'] = date('Y-m-d H:i:s');
                $data['modified'] = date('Y-m-d H:i:s');
                
                $followup_id = $this->FollowupDetailsmodel->insert_leads_followup($data);

                /* If status is 100% then send job to admin */
                if($json_data['status_id'] == '6'){
                    $partner_dets = $this->Partnermodel->get_det_by_contact_number($contact);
                    $this->job_completion_notification($data['lead_id'], $partner_dets);
                }

                if($followup_id){
                    $this->response([
                        'id' => $followup_id,
                        'message' => 'Added Lead Followups '
                    ], REST_Controller::HTTP_CREATED); // NOT_FOUND (404) being the HTTP response code
                }else{
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Issue inserting Followup'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
                
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Not Authorised to update followups'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Not Authorised to update followups'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function update_leads_post(){
        $contact = $this->post('contact');
        
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);

        if(isset($parnter_det['id'])){
            if(!$this->post('leads')){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Leads Details Required to update'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                exit;
            }

            $json_data = json_decode($this->post('leads'));

            $lead_id = $json_data->id;
            if(!isset($lead_id) || empty($lead_id)){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Lead Id is required'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                exit;
            }
            
            if(isset($json_data->lead_date) && !empty($json_data->lead_date)){
                $data['registration_date'] = $json_data->lead_date;
            }
            if(isset($json_data->email) && !empty($json_data->email)){
                $data['lead_email'] = $json_data->email;
            }
            if(isset($json_data->contact) && !empty($json_data->contact)){
                $data['lead_mobile'] = $json_data->contact;
            }
            if(isset($json_data->sales_motion) && !empty($json_data->sales_motion)){
                /* Get Sales motion id */
                $this->load->model('SalesMotionmodel');
                $sales_motion_det = $this->SalesMotionmodel->get_id_by_name($json_data->sales_motion);
                $data['sales_motion'] = $sales_motion_det['id'];
            }
            if(isset($json_data->customer_segment) && !empty($json_data->customer_segment)){
                $this->load->model('CustomerSegmentmodel');
                /* Get Customer Segment id */
                $customer_segment_det = $this->CustomerSegmentmodel->get_id_by_name($json_data->customer_segment);
                $data['customer_segment'] = $customer_segment_det['id'];
            }
            if(isset($json_data->other_segment) && !empty($json_data->other_segment)){
                $data['other_segment'] = $json_data->other_segment;
            }
            if(isset($json_data->customer_name) && !empty($json_data->customer_name)){
                $data['customer_name'] = $json_data->customer_name;
            }

            if(isset($json_data->customer_city) && !empty($json_data->customer_city)){
                $this->load->model('Citymodel');
                /* Get Customer city, state id */
                $city_det = $this->Citymodel->get_id_by_name($json_data->customer_city);
                $data['customer_city'] = $city_det['id'];
                $data['customer_state'] = $city_det['state_id'];
            }

            if(isset($json_data->pincode) && !empty($json_data->pincode)){
                $data['pin_code'] = $json_data->pincode;
            }
            if(isset($json_data->value_of_deal) && !empty($json_data->value_of_deal)){
                $this->load->model('ValueDealmodel');
                /* Get Value Deal id */
                $value_of_deal_det = $this->ValueDealmodel->get_id_by_name($json_data->value_of_deal);
                $data['value_of_deal'] = $value_of_deal_det['id'];
            }
            if(isset($json_data->total_deal_value) && !empty($json_data->total_deal_value)){
                $data['total_deal_value'] = $json_data->total_deal_value;
            }
            if(isset($json_data->sku) && !empty($json_data->sku)){
                $data['sku'] = $json_data->sku;
            }
            if(isset($json_data->expected_license) && !empty($json_data->expected_license)){
                $data['expected_license'] = $json_data->expected_license;
            }
            if(isset($json_data->product) && !empty($json_data->product)){
                $data['product'] = $json_data->product;
            }
            if(isset($json_data->deal_size) && !empty($json_data->deal_size)){
                $data['deal_size'] = $json_data->deal_size;
            }
            if(isset($json_data->tender_type) && !empty($json_data->tender_type)){
                $data['tender_type'] = $json_data->tender_type;
            }
            if(isset($json_data->ms_product) && !empty($json_data->ms_product)){
                $data['product_required'] = $json_data->ms_product;
            }
            if(isset($json_data->ms_involvement) && !empty($json_data->ms_involvement)){
                $this->load->model('MsInvolvementmodel');
                /* Get Ms Invlovement id */
                $ms_involvement_det = $this->MsInvolvementmodel->get_id_by_name($json_data->ms_involvement);
                $data['involvement'] = $ms_involvement_det['id'];
            }
            if(isset($json_data->expected_date_of_closing) && !empty($json_data->expected_date_of_closing)){
                $this->load->model('ExpectedClosingDatemodel');
                /* Get Expected Closing Date id */
                $expected_closing_date_det = $this->ExpectedClosingDatemodel->get_id_by_name($json_data->expected_date_of_closing);
                $data['expected_closing_date'] = $expected_closing_date_det['id'];
            }
            if(isset($json_data->current_status_of_the_lead) && !empty($json_data->current_status_of_the_lead)){
                $this->load->model('LeadCurrentStatusmodel');
                /* Get lead_current_status id */
                $lead_current_status_det = $this->LeadCurrentStatusmodel->get_id_by_name($json_data->current_status_of_the_lead);
                $data['current_status_lead'] = $lead_current_status_det['id'];
            }
            if(isset($json_data->order_lost) && !empty($json_data->order_lost)){
                $data['order_lost'] = $json_data->order_lost;
            }

            $lead_det = $this->Leadmodel->update_lead($data, $lead_id);
            if($lead_det){
                $this->response([
                    'id' => $lead_id,
                    'message' => 'Lead Details Updated'
                ], REST_Controller::HTTP_CREATED); // NOT_FOUND (404) being the HTTP response code
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Issue inserting Data'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Account is Inactive'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function all_states_get($contact){
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);
        
        if(isset($parnter_det['id'])){   
            $partner_id = (int) $parnter_det['id'];
            $this->load->model('Statemodel');

            // Leads from a data store e.g. database
            $state_dets = $this->Statemodel->state_names();    
            foreach ($state_dets as $key => $state) {
                $s_det[$key] = $state['name'];
            }
                
            if(empty($state_dets)){
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No States were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }else{
                // Set the response and exit
                $data = json_encode($s_det);
                $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }

        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Account is Inactive or not available'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function all_cities_get($contact,$state_id=null){
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);

        if(isset($parnter_det['id'])){   

            $partner_id = (int) $parnter_det['id'];
            $this->load->model('Citymodel');
            if($state_id == null){
                $this->load->model('Statemodel');

                // Leads from a data store e.g. database
                $state_dets = $this->Statemodel->state_details();
                foreach ($state_dets as $key => $state) {
                    $state_id = $state['id'];
                    $c_dets = $this->Citymodel->cities_name_state_id($state_id);
                    
                    foreach ($c_dets as $k => $city) {
                        $city_dets[$state_id][] = $city['name'];
                    }
                }
            }else{
                // Leads from a data store e.g. database
                $city_dets = $this->Citymodel->cities_by_state_id($state_id);  
            }
         
            if(empty($city_dets)){
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No City found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }else{
                // Set the response and exit
                $data = json_encode($city_dets);
                $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Account is Inactive or not available'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function followup_status_get($contact){
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);

        if(isset($parnter_det['id'])){   
            $partner_id = (int) $parnter_det['id'];
            $this->load->model('FollowupDetailsmodel');
            $followup_det = $this->FollowupDetailsmodel->get_lead_followup();

            if(empty($followup_det)){
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No States were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }else{
                // Set the response and exit
                $data = json_encode($followup_det);
                $this->response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }

        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Account is Inactive or not available'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /*public function users_post()
    {
        // $this->some_model->update_user( ... );
        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }*/

    public function send_notifications($lead_id, $partner_det){

        $partner_mobile = '+91'.substr($partner_det['contact_no'], -10);

        $this->load->model('Usermodel');
        $admin_dets = $this->Usermodel->get_admin();


        /*$admin_mobiles[] = '+919584499919';
        $admin_mobiles[] = '+917828642047';*/

        $admin_as_partner_contact = ['+919584499919','+917828642041','+919893948112','+919165754191','+919303331456','+919425954180'];
        if(in_array($partner_mobile, $admin_as_partner_contact)){
            $is_notify_admin = 1;
        }else{
            $is_notify_admin = 0;
        }

        foreach ($admin_dets as $key => $admin_det) {
            $admin_mobiles[] = '+91'.substr($admin_det['phone'], -10);
        }
        if(count($admin_mobiles) > 1){
            $admin_mobile = implode(',', $admin_mobiles);
        }else{
            $admin_mobile = $admin_mobiles[0];
        }

        /* As we are broadcasting job to all admin so we are passing contact number as blank */

        $task_msgs = 'New lead is added by '. ucfirst($partner_det['owner_name']);
        $notify_msgs = ucfirst($partner_det['owner_name']).' has added a lead';

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_PORT => "443",
          CURLOPT_URL => "https://prod-17.centralindia.logic.azure.com:443/workflows/368e8b657e3643cbae3d90e13adb7119/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=cEIQ61qVwu0CDbFNmFepVWDscI8StiSgGD3XKZqNOJk",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n   \"task_mobile_no\": \"\",\n    \"task_mgs\": \"".$task_msgs." \",\n    \"is_task_admin\": \"1\",\n    \"notify_mobile_no\": \"".$partner_mobile."\",\n    \"notify_mgs\": \"".$notify_msgs." \",\n    \"is_notify_admin\": \"".$is_notify_admin."\"\n}",
          CURLOPT_HTTPHEADER => array(
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
            return false;
        } else {
            // echo $response;
            return true;
        }
    }

    public function job_completion_notification($lead_id,$partner_det){

        $partner_mobile = '+91'.substr($partner_det['contact_no'], -10);

        $admin_as_partner_contact = ['+919584499919','+917828642041','+919893948112','+919165754191','+919303331456','+919425954180'];
        if(in_array($partner_mobile, $admin_as_partner_contact)){
            $is_notify_admin = 1;
        }else{
            $is_notify_admin = 0;
        }

        /* As we are broadcasting job to all admin so we are passing contact number as blank */

        $task_msgs = ucfirst($partner_det['owner_name']).' has recently complete the status of Lead Id: '.$lead_id;
        $notify_msgs = 'You have recently complete the status of Lead Id: '. $lead_id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_PORT => "443",
          CURLOPT_URL => "https://prod-17.centralindia.logic.azure.com:443/workflows/368e8b657e3643cbae3d90e13adb7119/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=cEIQ61qVwu0CDbFNmFepVWDscI8StiSgGD3XKZqNOJk",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n   \"task_mobile_no\": \"\",\n    \"task_mgs\": \"".$task_msgs." \",\n    \"is_task_admin\": \"1\",\n    \"notify_mobile_no\": \"".$partner_mobile."\",\n    \"notify_mgs\": \"".$notify_msgs." \",\n    \"is_notify_admin\": \"".$is_notify_admin."\"\n}",
          CURLOPT_HTTPHEADER => array(
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
            return false;
        } else {
            // echo $response;
            return true;
        }
    }

}

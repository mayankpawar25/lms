<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Lead extends MY_Controller {
    function __construct(){
        parent::__construct();
       if (!$this->session->userdata('logged_in')){
            redirect(base_url('partner/auth'));
        }

        $action = $this->router->fetch_method();
        
        if($action != 'view_lead_details' && $action != 'view_assigned_status_details' && $action !='get_leads_name_by_id'){
            $this->output->section('header','partner/header');
            $this->output->section('sidebar','partner/sidebar');
            $this->output->section('footer','partner/footer');
            $this->output->set_title('Partner');
            $this->output->set_template('partner');
             // load Breadcrumbs
            $this->load->library('breadcrumbs');
            $this->load->helper('security');
            //$this->load->model('zones');
            $this->load->model('leads');
            $this->load->model('sales');
            $this->load->model('customer_segment');
            $this->load->model('value_of_deal');
            $this->load->model('closing_dates');
            $this->load->model('invlovement');
            $this->load->model('current_status');
            //$this->load->model('partners');
            $this->load->model('countries');
            $this->load->model('states');
            $this->load->model('cities');
            $this->load->model('bdm');
            $this->load->library('form_validation');
            
            /* Check user types */
            $loggedin_data = $this->session->userdata('logged_in');
            if($loggedin_data->user_role != 4){
                redirect(base_url('partner/auth/logout'));
            }
            $this->output->css('assets/themes/partner/costom-style.css');
             $this->output->css('assets/themes/partner/sweetalert.css'); 
             $this->output->js('assets/themes/partner/sweetalert.js'); 
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        }
    }

    /* Show all Leads */
    function all_leads() { 
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        $this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('Created Leads ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // $data['leads']=$this->leads->get_all_leads();
        $data['leads']=$this->leads->get_all_created_leads();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/partner/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/partner/costom-style.css'); 
            $this->output->js('assets/themes/partner/bower_components/datatables.net/js/jquery.dataTables.min.js');
            $this->output->js('assets/themes/partner/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allleads',$data);
    }
    /*Show Assigned Leads*/
    function assigned_leads() { 
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        $this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('Assigned Leads', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // $data['assigned_leads']=$this->leads->get_assigned_leads();  
        $data['assigned_leads']=$this->leads->get_assigned_leads_of_partner();

        foreach ($data['assigned_leads'] as $key => $assigned_leads) {
            $followup_status=$this->leads->assigned_lead_status_details($assigned_leads['id'], $assigned_leads['assigned_to_partner']);
            $data['assigned_leads'][$key]['followup_status'] = $followup_status['status'];
            $data['assigned_leads'][$key]['followup_status_id'] = $followup_status['status_id'];

           
        }

       

        $data['followup_status']=$this->leads->get_followup_status();
        $data['assigned_status']=$this->leads->get_assigned_status();

        $this->output->append_title('Users');
        $this->output->css('assets/themes/partner/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/partner/costom-style.css'); 
            $this->output->js('assets/themes/partner/bower_components/datatables.net/js/jquery.dataTables.min.js');
            $this->output->js('assets/themes/partner/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('assignedleads',$data);
    }
    /*For Deleted Leads*/
    function deleted_leads() { 
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        $this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('All Deleted Leads  ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // $data['leads']=$this->leads->get_all_leads();
        $data['leads']=$this->leads->get_all_deleted_leads();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/partner/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/partner/costom-style.css'); 
            $this->output->js('assets/themes/partner/bower_components/datatables.net/js/jquery.dataTables.min.js');
            $this->output->js('assets/themes/partner/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('alll_deleted_leads',$data);
    }



    /* Admin profile */
    function profile(){
        $this->load->model('admin');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['admin'] = $this->user->get_admin($username);
       print_r($data);
    }
    /* add Lead*/
    public function add_lead(){ 
       $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        $this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('Add Lead ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();

        $data['states']=$this->states->get_all_states();
        $data['current_status']=$this->current_status->get_current_status_of_leads();
        $data['closing_dates']=$this->closing_dates->get_expected_closing_dates();
        $data['invlovements']=$this->invlovement->get_involvements();
        $data['value_of_deal']=$this->value_of_deal->get_all_values();
        
        $data['segments']=$this->customer_segment->get_segments();
        $data['sales_motions']=$this->sales->get_sales_motions();
        $data['bdms']=$this->bdm->get_all_bdms();

        $this->form_validation->set_rules('registration_date','Registration Date','required');
        //$this->form_validation->set_rules('lead_id','Lead ID','required|is_numeric');
         $this->form_validation->set_rules('lead_mobile','Mobile No','required|xss_clean|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('lead_email','Email','required|xss_clean');
        //$this->form_validation->set_rules('lead_email','lead Email','required');
        //$this->form_validation->set_rules('lead_mobile','Lead Mobile No.','required');
        $this->form_validation->set_rules('sales_motion','Sales Motion','required|xss_clean');
        
        $this->form_validation->set_rules('customer_segment','Customer Segment','required|xss_clean');
       
        $this->form_validation->set_rules('customer_name','Customer Name','required|xss_clean');
        
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('pin_code','Pin Code','required|xss_clean|numeric');
        //$this->form_validation->set_rules('ms_bdm','Microsoft BDM','required');
        $this->form_validation->set_rules('value_of_deal','Value of Deal','required');

        if($this->input->post('value_of_deal')==1){
            $this->form_validation->set_rules('total_deal_value','Total Deal Value','required');
        $this->form_validation->set_rules('sku','SKU','required');    
        }else if($this->input->post('value_of_deal')==2){

        $this->form_validation->set_rules('expected_license','Expected License','required');    
        }else{

        $this->form_validation->set_rules('product','Product','required');
        $this->form_validation->set_rules('deal_size','Deal Size','required');
        $this->form_validation->set_rules('tender_type','Tender Type','required');
        

        }

        $this->form_validation->set_rules('product_required','Product Required');
        
        $this->form_validation->set_rules('expected_closing_date','Expected Closing Date','required');

        // $this->form_validation->set_rules('lead_current_status','Lead Current Status','required');
        // $this->form_validation->set_rules('order_lost','Order Lost');
         $this->form_validation->set_rules('other_segment','Other Segment');
        
        $this->form_validation->set_rules('ms_involvement','Ms Involvement');
       if($this->form_validation->run() == TRUE){ 
            if($this->input->post()){
                $product_required  = $this->input->post('product_required');
                if(count($product_required)<1){
                    $product_required = $this->input->post('product_required');
                }else{
                    $product_required = implode(",", $product_required);
                }   

                    list($date,$month,$year) = explode('/', $this->input->post('registration_date'));
                    $registration_date = $year.'-'.$month.'-'.$date;
                    $logged_partner_data = $this->session->userdata('logged_in');
                    $partner_id = $logged_partner_data->partner_id;
                        $data=array(
                            'registration_date'=>$registration_date,
                            'lead_email'=>$this->input->post('lead_email'),
                            'lead_mobile'=>$this->input->post('lead_mobile'),
                            //'lead_id'=>$this->input->post('lead_id'),
                            'sales_motion'=>$this->input->post('sales_motion'),
                            'customer_segment'=>$this->input->post('customer_segment'),
                            'other_segment'=>$this->input->post('other_segment'),
                            'customer_name'=>$this->input->post('customer_name'),
                            'customer_state'=>$this->input->post('state'),
                            'customer_city'=>$this->input->post('city'),
                            'pin_code'=>$this->input->post('pin_code'),
                            'ms_bdm'=>$this->input->post('ms_bdm'),
                            'value_of_deal'=>$this->input->post('value_of_deal'),
                            'total_deal_value'=>$this->input->post('total_deal_value'),
                            'sku'=>$this->input->post('sku'),
                            'expected_license'=>$this->input->post('expected_license'),
                            'product'=>$this->input->post('product'),
                            'deal_size'=>$this->input->post('deal_size'),
                            'tender_type'=>$this->input->post('tender_type'),
                            'product_required'=>$product_required,
                            'involvement'=>$this->input->post('ms_involvement'),
                            'expected_closing_date'=>$this->input->post('expected_closing_date'),
                            'current_status_lead'=>$this->input->post('lead_current_status'),
                            'order_lost'=>$this->input->post('order_lost'),
                            'partner_id'=>$partner_id,
                            'created' =>date("Y-m-d H:i:s")
                          ) ;

                        if($this->leads->add_new_lead($data)){
                                /* Send Notification */
                                $this->send_notifications($logged_partner_data);

                                $this->session->set_flashdata('success_add_lead','Lead Added Successfully.');
                                $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                                $this->breadcrumbs->push('Manage Leads ', 'partner/');
                                $this->breadcrumbs->push('Add Lead ', 'section/page/page');
                                $this->breadcrumbs->unshift('', '');
                                $data['breadcrumb'] = $this->breadcrumbs->show();
                        }else{
                        $this->session->set_flashdata('error_add_lead','Failed to Add New Lead..!');
                                $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                                $this->breadcrumbs->push('Manage Leads ', 'partner/');
                                $this->breadcrumbs->push('Add Lead ', 'section/page/page');
                                $this->breadcrumbs->unshift('', '');
                                $data['breadcrumb'] = $this->breadcrumbs->show();

                                
                        redirect('partner/lead/add_lead'); 
                    }
                    redirect('partner/lead/add_lead'); 
                }                     
         }else{
            }
       $this->load->view('add_lead',$data);
    }
     /*edit subdistributors*/
   /* public function edit_lead($id=''){
         $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
         $this->breadcrumbs->push('Manage Leads ', 'partner/');
         $this->breadcrumbs->push('Edit Lead ', 'section/page/page');
         $this->breadcrumbs->unshift('', '');
         $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['cities']=$this->cities->get_all_cities();
        $data['states']=$this->states->get_all_states();
        $data['current_status']=$this->current_status->get_current_status_of_leads();
        $data['closing_dates']=$this->closing_dates->get_expected_closing_dates();
        $data['invlovements']=$this->invlovement->get_involvements();
        $data['value_of_deal']=$this->value_of_deal->get_all_values();
        $data['segments']=$this->customer_segment->get_segments();
        $data['sales_motions']=$this->sales->get_sales_motions();
    if (isset($_POST) && ! empty($_POST)) {
           $registration_date  = $this->input->post('registration_date');
            $product_required  = $this->input->post('product_required');
                if(count($product_required)<1){
                    $product_required = $this->input->post('product_required');
                }else{
                    $product_required = implode(",", $product_required);
                } 
            $data=array(
                'registration_date'=>date("Y-m-d H:i:s", strtotime($registration_date)),
                'sales_motion'=>$this->input->post('sales_motion'),
                'customer_segment'=>$this->input->post('customer_segment'),
                'other_segment'=>$this->input->post('other_segment'),
                'customer_name'=>$this->input->post('customer_name'),
                'customer_state'=>$this->input->post('state'),
                'customer_city'=>$this->input->post('city'),
                'pin_code'=>$this->input->post('pin_code'),
                'value_of_deal'=>$this->input->post('value_of_deal'),
                'total_deal_value'=>$this->input->post('total_deal_value'),
                'sku'=>$this->input->post('sku'),
                'expected_license'=>$this->input->post('expected_license'),
                'product'=>$this->input->post('product'),
                'deal_size'=>$this->input->post('deal_size'),
                'tender_type'=>$this->input->post('tender_type'),
                'product_required'=>$product_required,
                'involvement'=>$this->input->post('ms_involvement'),
                'expected_closing_date'=>$this->input->post('expected_closing_date'),
                'current_status_lead'=>$this->input->post('lead_current_status'),
                'order_lost'=>$this->input->post('order_lost'),
                'modified' =>date("Y-m-d H:i:s"),
                );
            if($this->leads->update_lead($id,$data)){
                redirect('partner/lead/all_leads');
            }
    }else{
            $data['lead_detail'] = $this->leads->get_lead_by_id($id);
            $this->load->view('edit_lead' ,$data);
        }
    }*/
        /*Edit Lead*/
     public function edit_lead($id=''){
        if($id != ''){
            $id = base64_decode($id);
        }else{
            redirect('partner/lead/all_leads');
        }


        /* Check the lead is created by partner id */
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        $this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('Edit Lead ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $this->form_validation->set_rules('registration_date','Registration Date','required');
        //$this->form_validation->set_rules('lead_id','Lead ID','required|is_numeric');
        $this->form_validation->set_rules('lead_email','lead Email','required|xss_clean');
        $this->form_validation->set_rules('lead_mobile','Lead Mobile No.','required|xss_clean');
        $this->form_validation->set_rules('sales_motion','Sales Motion','required|xss_clean');
        $this->form_validation->set_rules('customer_segment','Customer Segment','required|xss_clean');
        $this->form_validation->set_rules('customer_name','Customer Name','required|xss_clean');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('pin_code','Pin Code','required|xss_clean');
        //$this->form_validation->set_rules('ms_bdm','Microsoft BDM','required');
        $this->form_validation->set_rules('value_of_deal','Value of Deal','required');
             if($this->input->post('value_of_deal')==1){
                 $this->form_validation->set_rules('total_deal_value','Total Deal Value','required');
                 $this->form_validation->set_rules('sku','SKU','required');    
            }else if($this->input->post('value_of_deal')==2){

                 $this->form_validation->set_rules('expected_license','Expected License','required');    
            }else{
                $this->form_validation->set_rules('product','Product','required');
                $this->form_validation->set_rules('deal_size','Deal Size','required');
                $this->form_validation->set_rules('tender_type','Tender Type','required');
            }
        $this->form_validation->set_rules('product_required','Product Required');
        $this->form_validation->set_rules('expected_closing_date','Expected Closing Date','required');
        // $this->form_validation->set_rules('lead_current_status','Lead Current Status','required');
        // $this->form_validation->set_rules('order_lost','Order Lost');
        $this->form_validation->set_rules('other_segment','Other Segment');
        $this->form_validation->set_rules('ms_involvement','Ms Involvement');
        $data['states']=$this->states->get_all_states();
        $data['current_status']=$this->current_status->get_current_status_of_leads();
        $data['closing_dates']=$this->closing_dates->get_expected_closing_dates();
        $data['invlovements']=$this->invlovement->get_involvements();
        $data['value_of_deal']=$this->value_of_deal->get_all_values();
        $data['segments']=$this->customer_segment->get_segments();
        $data['sales_motions']=$this->sales->get_sales_motions();
        $leads=$this->leads->get_all_created_leads();
        $loggedin_data = $this->session->userdata('logged_in');
        $partner_id = $loggedin_data->id;
        if($this->form_validation->run() == TRUE){ 
        //if (isset($_POST) && ! empty($_POST)) {
               $registration_date  = $this->input->post('registration_date');
                $product_required  = $this->input->post('product_required');
                    if(count($product_required)<1){
                        $product_required = $this->input->post('product_required');
                    }else{
                        $product_required = implode(",", $product_required);
                    } 
                $data=array(
                    'registration_date'=>date("Y-m-d", strtotime($registration_date)),
                    'lead_email'=>$this->input->post('lead_email'),
                    'lead_mobile'=>$this->input->post('lead_mobile'),
                    'sales_motion'=>$this->input->post('sales_motion'),
                    'customer_segment'=>$this->input->post('customer_segment'),
                    'other_segment'=>$this->input->post('other_segment'),
                    'customer_name'=>$this->input->post('customer_name'),
                    'customer_state'=>$this->input->post('state'),
                    'customer_city'=>$this->input->post('city'),
                    'pin_code'=>$this->input->post('pin_code'),
                     'ms_bdm'=>$this->input->post('ms_bdm'),
                    'value_of_deal'=>$this->input->post('value_of_deal'),
                    'total_deal_value'=>$this->input->post('total_deal_value'),
                    'sku'=>$this->input->post('sku'),
                    'expected_license'=>$this->input->post('expected_license'),
                    'product'=>$this->input->post('product'),
                    'deal_size'=>$this->input->post('deal_size'),
                    'tender_type'=>$this->input->post('tender_type'),
                    'product_required'=>$product_required,
                    'involvement'=>$this->input->post('ms_involvement'),
                    'expected_closing_date'=>$this->input->post('expected_closing_date'),
                    'current_status_lead'=>$this->input->post('lead_current_status'),
                    'order_lost'=>$this->input->post('order_lost'),
                    'modified' =>date("Y-m-d H:i:s"),
                    );
               

                //foreach ($leads as $key => $value) {
                    if($this->leads->update_lead($id,$data)){
                       
                     $this->session->set_flashdata('success_edit_lead','Lead Record Updated Successfully .');
                        redirect('partner/lead/all_leads');
                    }else{
                        $this->session->set_flashdata('error_edit_lead','Failed to Update Lead Record..!');
                        redirect('partner/lead/all_leads');
                    }
                //}
        }else{
                    //die('test');
                $data['lead_detail'] = $this->leads->get_lead_by_id($id);
                $lead_detail = $this->leads->get_lead_by_id($id);
                $cities=$this->cities->get_edit_cities($lead_detail[0]['customer_state']);
                $data['cities_list'] =$cities;
                 $data['bdms']=$this->bdm->get_all_bdms();
                $this->load->view('edit_lead' ,$data);
        }
    }

   /* public function edit_assigned_lead($id=''){
         $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
         $this->breadcrumbs->push('Manage Leads ', 'partner/');
         $this->breadcrumbs->push('Edit Lead ', 'section/page/page');
         $this->breadcrumbs->unshift('', '');
         $data['breadcrumb'] = $this->breadcrumbs->show();
            $data['cities']=$this->cities->get_all_cities();
            $data['states']=$this->states->get_all_states();
            $data['current_status']=$this->current_status->get_current_status_of_leads();
            $data['closing_dates']=$this->closing_dates->get_expected_closing_dates();
            $data['invlovements']=$this->invlovement->get_involvements();
            $data['value_of_deal']=$this->value_of_deal->get_all_values();
            $data['segments']=$this->customer_segment->get_segments();
            $data['sales_motions']=$this->sales->get_sales_motions();
        if (isset($_POST) && ! empty($_POST)) {
               $registration_date  = $this->input->post('registration_date');
                $product_required  = $this->input->post('product_required');
                    if(count($product_required)<1){
                        $product_required = $this->input->post('product_required');
                    }else{
                        $product_required = implode(",", $product_required);
                    } 
                $data=array(
                    'registration_date'=>date("Y-m-d H:i:s", strtotime($registration_date)),
                    'sales_motion'=>$this->input->post('sales_motion'),
                    'customer_segment'=>$this->input->post('customer_segment'),
                    'other_segment'=>$this->input->post('other_segment'),
                    'customer_name'=>$this->input->post('customer_name'),
                    'customer_state'=>$this->input->post('state'),
                    'customer_city'=>$this->input->post('city'),
                    'pin_code'=>$this->input->post('pin_code'),
                    'value_of_deal'=>$this->input->post('value_of_deal'),
                    'total_deal_value'=>$this->input->post('total_deal_value'),
                    'sku'=>$this->input->post('sku'),
                    'expected_license'=>$this->input->post('expected_license'),
                    'product'=>$this->input->post('product'),
                    'deal_size'=>$this->input->post('deal_size'),
                    'tender_type'=>$this->input->post('tender_type'),
                    'product_required'=>$product_required,
                    'involvement'=>$this->input->post('ms_involvement'),
                    'expected_closing_date'=>$this->input->post('expected_closing_date'),
                    'current_status_lead'=>$this->input->post('lead_current_status'),
                    'order_lost'=>$this->input->post('order_lost'),
                    'modified' =>date("Y-m-d H:i:s"),
                    );
                if($this->leads->update_lead($id,$data)){
                    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                    $this->breadcrumbs->push('Manage Leads ', 'partner/');
                    $this->breadcrumbs->push('Edit Lead ', 'section/page/page');
                    $this->breadcrumbs->unshift('', '');
                    $data['breadcrumb'] = $this->breadcrumbs->show();
                    redirect('partner/lead/assigned_leads');
                }
        }else{
                $data['lead_detail'] = $this->leads->get_lead_by_id($id);
                $this->load->view('edit_lead' ,$data);
            }
    }*/

    /*Edit Assigned lead*/
    public function edit_assigned_lead($id=''){
        $this->form_validation->set_rules('status','Status', 'Required');
        if($this->form_validation->run() == TRUE){ 
            $data=array(
                'status_id'=>$this->input->post('status'),
                'lead_id'=>$this->input->post('lead_id'),
                'partner_id'=>$this->input->post('partner_id'),
                'description'=>$this->input->post('assgined_description'),
                'modified' =>date("Y-m-d H:i:s"),
            );
            
            $partner_id = $data['partner_id'];
            
            if($this->leads->update_edit_lead($data)){
                //$this->leads->update_lead_time($data);
                //redirect('partner/lead/assigned_leads');
            }
            $data1=array(
                'id' =>$this->input->post('lead_id'),
                'lead_id'=>$this->input->post('lead_id'),
                'modified' =>date("Y-m-d H:i:s"),
            );               
            $id =$this->input->post('lead_id');
            
            if($this->leads->update_lead_time($id,$data1)){

                $this->load->model('Partner');
                $partner_det = $this->Partner->get_partner_det_by_id($partner_id);
                
                if($data['status_id'] == 6){
                    $this->send_closing_notification($id, $partner_det);
                }else{
                    $this->send_status_notifications($id, $partner_det);
                }
                

                //$this->leads->update_lead_time($data);
                redirect('partner/lead/assigned_leads');
            }

        }else{
            $data['lead_detail'] = $this->leads->get_lead_by_id($id);
            $this->load->view('edit_lead' ,$data);
        }
    }

    
    /*delete lead*/
    public function delete_lead(){
        $id = $this->input->post('id');

        $data=array(
            'is_deleted'=>1
        );
        $result = $this->leads->delete_lead($id,$data);
        redirect('partner/lead/allleads');
    }

    /*Restore delete leads*/
    public function restore_delete_lead(){
        $id = $this->input->post('id');

        $data=array(
            'is_deleted'=>0
        );
        $result = $this->leads->restore_delete_lead($id,$data);
        redirect('partner/lead/deleted_leads');
    }
     /*update lead status*/
    public function update_status_lead(){
        $id = $this->input->post('id');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->leads->update_lead_status($id,$data);
    }
    /*Approval by admin to partner*/
    public function approved_disapproved_lead(){
        $id = $this->input->post('id');
        $data=array(
            'approval'=>$this->input->post('approval')
        );
        $this->leads->approval_by_partner($id,$data);
    }
    
    /*Assigned by admin to partner*/
    public function assigned_to_partner(){
        $id = $this->input->post('id');
        $data=array(
            'assigned_to_partner'=>$this->input->post('assigned')
        );
       $this->leads->assigned_to_this_partner($id,$data);
    }

    /*Show Lead Details*/
    public function view_lead_details($id=''){
        //die('test');
        $this->load->model('leads');        
        $id = $this->input->post('id');
        $data = $this->leads->get_lead_details($id);
        $dt['data'] = (array)$data;
        $this->load->view('view_lead', $dt);
    }
    /*view Assigned details status*/
     public function view_assigned_status_details($id=''){
        $this->load->model('leads');        
        $id = $this->input->post('id');
        $data = $this->leads->get_assigned_status_lead_details($id);
        // echo "<pre>";
        // print_r($data);
        $dt['data'] = (array)$data;
        $this->load->view('view_assigned_lead_status', $dt);
    }


     /*City Dropdown function*/
    public function get_city(){
    $id = $this->input->post('id');
     $cities = $this->cities->get_cities($id);   
    ?>
   <select class="form-control" name="city" id="city" autocomplete='off' required>
        <option value="">Select City</option>
        <?php
        if(!empty($cities))
        {
        foreach ($cities as $city) { 
        ?>
        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
        <?php
            }
        }
        ?>
    </select>
    <?php   
    die();
    }

     /*Show Lead name by id*/
    public function get_leads_name_by_id($id=''){
        $this->load->model('leads');        
        $id = $this->input->post('id');
        $data = $this->leads->get_lead_name_by_id($id);
        $dt['data'] = (array)$data;
        $this->load->view('view_lead_name', $dt);
    }

    public function send_notifications($partner_det){

        $partner_mobile = '+91'.substr($partner_det->phone, -10);

        $admin_as_partner_contact = ['+919584499919','+917828642041','+919893948112','+919165754191','+919303331456','+919425954180'];
        if(in_array($partner_mobile, $admin_as_partner_contact)){
            $is_notify_admin = 1;
        }else{
            $is_notify_admin = 0;
        }

        
        /* As we are broadcasting job to all admin so we are passing contact number as blank */

        $task_msgs = 'New lead is added by '. ucfirst($partner_det->full_name);
        $notify_msgs = ucfirst($partner_det->full_name).' has added a lead';

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
    
    public function send_status_notifications($lead_id, $partner_det){

        $partner_mobile = '+91'.substr($partner_det['contact_no'], -10);
        
        $admin_as_partner_contact = ['+919584499919','+917828642041','+919893948112','+919165754191','+919303331456','+919425954180'];
        if(in_array($partner_mobile, $admin_as_partner_contact)){
            $is_notify_admin = 1;
        }else{
            $is_notify_admin = 0;
        }

        
        /* As we are broadcasting job to all admin so we are passing contact number as blank */

        $task_msgs = '';
        $notify_msgs = 'You have recently updated the lead status of Lead Id: '.$lead_id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_PORT => "443",
          CURLOPT_URL => "https://prod-29.centralindia.logic.azure.com:443/workflows/97d986d9cf7647399db7dfbb0a0d7184/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=i_jeuGbj8eSi6hnHPO1-DFxWzPbxbxXSdPG_1ejQiD4",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n    \"is_admin\": \"".$is_notify_admin."\",\n    \"Title\": \"Lead Status Updated\",\n    \"mgs\": \"".$notify_msgs."\",\n    \"mobile_number\": \"".$partner_mobile."\"\n}",
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
            $notify_msgs = ucfirst($partner_det['owner_name']).' have recently updated the lead status of Lead Id: '.$lead_id;
            
            /* Notification to admin */
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_PORT => "443",
              CURLOPT_URL => "https://prod-29.centralindia.logic.azure.com:443/workflows/97d986d9cf7647399db7dfbb0a0d7184/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=i_jeuGbj8eSi6hnHPO1-DFxWzPbxbxXSdPG_1ejQiD4",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\n    \"is_admin\": \"1\",\n    \"Title\": \"Lead Status Updated\",\n    \"mgs\": \"".$notify_msgs."\",\n    \"mobile_number\": \"\"\n}",
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
                return true;
            }
            
        }
    }

    public function send_closing_notification($lead_id, $partner_det){

        $partner_mobile = '+91'.substr($partner_det['contact_no'], -10);
        
        $admin_as_partner_contact = ['+919584499919','+917828642041','+919893948112','+919165754191','+919303331456','+919425954180'];
        if(in_array($partner_mobile, $admin_as_partner_contact)){
            $is_notify_admin = 1;
        }else{
            $is_notify_admin = 0;
        }

        
        /* As we are broadcasting job to all admin so we are passing contact number as blank */

        $task_msgs = '';
        $notify_msgs = 'You have recently closed the lead status of Lead Id: '.$lead_id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_PORT => "443",
          CURLOPT_URL => "https://prod-29.centralindia.logic.azure.com:443/workflows/97d986d9cf7647399db7dfbb0a0d7184/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=i_jeuGbj8eSi6hnHPO1-DFxWzPbxbxXSdPG_1ejQiD4",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n    \"is_admin\": \"".$is_notify_admin."\",\n    \"Title\": \"Lead Status Updated\",\n    \"mgs\": \"".$notify_msgs."\",\n    \"mobile_number\": \"".$partner_mobile."\"\n}",
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
            $notify_msgs = ucfirst($partner_det['owner_name']).' have recently closed the lead status of Lead Id: '.$lead_id;
            
            /* Notification to admin */
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_PORT => "443",
              CURLOPT_URL => "https://prod-29.centralindia.logic.azure.com:443/workflows/97d986d9cf7647399db7dfbb0a0d7184/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=i_jeuGbj8eSi6hnHPO1-DFxWzPbxbxXSdPG_1ejQiD4",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\n    \"is_admin\": \"1\",\n    \"Title\": \"Lead Status Updated\",\n    \"mgs\": \"".$notify_msgs."\",\n    \"mobile_number\": \"\"\n}",
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
                return true;
            }
            
        }
    }
}
/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
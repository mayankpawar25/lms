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
            redirect(base_url('admin/auth'));
        }

        $action = $this->router->fetch_method();
        $ajax_view = ['show_partners_dropdown','view_lead_details','view_deleted_lead_details'];
        if(!in_array($action, $ajax_view)){
            $this->output->section('header','admin/header');
            $this->output->section('sidebar','admin/sidebar');
            $this->output->section('footer','admin/footer');
            $this->output->set_title('Super Admin');
            $this->output->set_template('admin');
            $this->load->model('zones');
            $this->load->model('leads');
            $this->load->model('sales');
            $this->load->model('partners');
            $this->load->model('countries');
            $this->load->model('states');
            $this->load->model('cities');
            $this->load->model('invlovement');
            $this->load->model('current_status');
            $this->load->model('value_of_deal');
            $this->load->model('closing_dates');
            $this->load->model('customer_segment');
            $this->load->model('bdm');
            $this->load->library('breadcrumbs');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        }

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
            
        }
        $this->output->css('assets/themes/admin/sweetalert.css'); 
        $this->output->js('assets/themes/admin/sweetalert.js');
        $this->output->css('assets/themes/partner/costom-style.css'); 
    }
    /* Show all the subdistributors */
    function all_leads() {
    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
    $this->breadcrumbs->push('Manage Users ', 'admin/');
    $this->breadcrumbs->push('Created Leads ', 'section/page/page');
    $this->breadcrumbs->unshift('', '');
     $data['breadcrumb'] = $this->breadcrumbs->show();  
    //$data['leads']=$this->leads->get_all_leads();
    $data['leads']=$this->leads->get_all_leads_data(); 
    // $data['all_partners']=$this->partners->get_all_partners();
   
    $this->output->append_title('Users');
    $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
    // $this->output->css('assets/themes/admin/multi-select.css');
    $this->output->css('assets/themes/admin/costom-style.css');
    // $this->output->js('assets/themes/admin/multi-select-js.js'); 
    $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
    $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
    $this->load->view('allleads',$data);
    }



    function deleted_leads() { 
         $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
    $this->breadcrumbs->push('Deleted Users ', 'admin/');
    $this->breadcrumbs->push('All Deleted Leads  ', 'section/page/page');
    $this->breadcrumbs->unshift('', '');
     $data['breadcrumb'] = $this->breadcrumbs->show();  
        
    //$data['leads']=$this->leads->get_all_leads();
    $data['leads']=$this->leads->get_all_deleted_leads();
    // $data['all_partners']=$this->partners->get_all_partners();
   
    $this->output->append_title('Users');
    $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
    // $this->output->css('assets/themes/admin/multi-select.css');
    $this->output->css('assets/themes/admin/costom-style.css');
    // $this->output->js('assets/themes/admin/multi-select-js.js'); 
    $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
    $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
    $this->load->view('all_deleted_leads',$data);
    }


    /*Assigned Leads*/
    function assigned_leads(){
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
    $this->breadcrumbs->push('Manage Users ', 'admin/');
    $this->breadcrumbs->push('Assigned Leads ', 'section/page/page');
    $this->breadcrumbs->unshift('', '');
     $data['breadcrumb'] = $this->breadcrumbs->show();  
    //$data['leads']=$this->leads->get_all_leads();
    $data['leads']=$this->leads->get_all_assigned_leads();
    // $data['all_partners']=$this->partners->get_all_partners();


    
    foreach ($data['leads'] as $key => $assigned_leads) {
            $followup_status=$this->leads->assigned_lead_status_details($assigned_leads['id'], $assigned_leads['assigned_to_partner']);
            $data['leads'][$key]['followup_status'] = $followup_status['status'];
            $data['leads'][$key]['followup_status_id'] = $followup_status['status_id']; 
        }
    
        $data['followup_status']=$this->leads->get_followup_status();
        $data['assigned_status']=$this->leads->get_assigned_status();
    
   
    $this->output->append_title('Users');
    $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
    // $this->output->css('assets/themes/admin/multi-select.css');
    $this->output->css('assets/themes/admin/costom-style.css');
    // $this->output->js('assets/themes/admin/multi-select-js.js'); 
    $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
    $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
    $this->load->view('assigned_leads',$data);


    }

    /* Admin profile */
    function profile(){
        $this->load->model('admin');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['admin'] = $this->user->get_admin($username);
       print_r($data);
    }
     /* Load add view subdistributors */
    // public function add_newlead(){
    // $this->load->view('add_lead');    
    // }
    public function add_lead(){
        // $data['countries']=$this->countries->get_all_countries();
        // $data['states']=$this->states->get_all_states();
        //$data['cities']=$this->cities->get_all_cities();
        //$data['all_admins']=$this->admin->get_all_admins();
        $this->form_validation->set_rules('registration_date','Registration Date','required');
        $this->form_validation->set_rules('lead_id','lead id','required');
        $this->form_validation->set_rules('sales_motion','sales_motion','required');
        $this->form_validation->set_rules('constomer_segment','required');
        //$this->form_validation->set_rules('other_segment','Address','required');
        $this->form_validation->set_rules('customer_name','Assigned','required');
        $this->form_validation->set_rules('city','City','required');
        // $this->form_validation->set_rules('state','State','required');
        // $this->form_validation->set_rules('country','Country','required');
        $this->form_validation->set_rules('pin_code','Website','required');
        $this->form_validation->set_rules('value_of_deal','required');
        $this->form_validation->set_rules('product_required','required');
        $this->form_validation->set_rules('involvement','required');
        $this->form_validation->set_rules('closing_date','required');
        $this->form_validation->set_rules('lead_status','required');
       if($this->form_validation->run() == true){ 
            if(isset($_POST)){  
                    $product_required  = $this->input->post('product_required');
                    if(count($product_required)<1){
                        echo    $product_required = $this->input->post('product_required');
                    }else{
                        echo  $product_required = implode(",", $product_required);
                    }                
                     $data=array(
                    'registration_date'=>$this->input->post('registration_date'),
                    'lead_id'=>$this->input->post('lead_id'),
                    'sales_motion'=>$this->input->post('sales_motion'),
                    //'account_number'=>$this->input->post('account_number'),
                    'customer_segment'=>$this->input->post('constomer_segment'),
                    'customer_name'=> $this->input->post('customer_name'),
                    'customer_city'=>$this->input->post('city'), 
                    'pin_code'=>$this->input->post('pin_code'),
                    'value_of_deal'=>$this->input->post('value_of_deal'),
                    // 'state'=>$this->input->post('state'),
                    // 'country'=>$this->input->post('country'),
                    'product_required'=>$product_required,
                    'involvement'=>$this->input->post('involvement'),
                    'expected_closing_date'=>$this->input->post('closing_date'),
                    'current_status_lead'=>$this->input->post('lead_status'),
                    // 'status'=>$this->input->post('firm_name'),
                    // 'approval'=>$this->input->post('registration'),
                    'created'=>date("Y-m-d")
                  ) ;
                // echo "<pre>";
                // print_r($data);
                // die();
                if($this->leads->add_new_lead($data)){
                        $this->session->set_flashdata('success','Distributor successfully added.');
                }else{
                       $this->session->set_flashdata('error','Failed to add new Distributor.!');
                       redirect('admin/lead/add_lead'); 
                }
        }else{
            $this->form_validation->set_message('catagory', 'catagory is must');
            $this->form_validation->set_message('first_name', 'first  is must');
            $this->form_validation->set_message('last_name', 'last name  is must');
            $this->form_validation->set_message('email', 'email is must');
            $this->form_validation->set_message('phone', 'phone is must');
        }
      }
       $this->load->view('add_lead');
    }
     /* add subdistributors*/
   /* public function add_lead(){
     if(isset($_POST)){   
      $data=array(
        'zone_name'=>$this->input->post('zone_name'),
        'zone_area'=>$this->input->post('zone_area'),
      ) ; 
      if($this->leads->add_new_lead($data)){
      $this->session->set_flashdata('success','Zone successfully added.');
        }else{
        $this->session->set_flashdata('error','Failed to add new zone.!');
       redirect('admin/partner/add_lead'); 
        }
    }
    $this->load->view('add_lead');
    }*/
     /*edit subdistributors*/
    public function edit_lead($id=''){
         $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
    $this->breadcrumbs->push('All Leads ', 'admin/lead/all_leads');
    $this->breadcrumbs->push('Edit Lead ', 'section/page/page');
    $this->breadcrumbs->unshift('', '');
     $data['breadcrumb'] = $this->breadcrumbs->show();
         if($id != ''){
            $id = base64_decode($id);
        }else{
            redirect('admin/lead/all_leads');
        }
        $this->form_validation->set_rules('registration_date','Registration Date','required');
        //$this->form_validation->set_rules('lead_id','Lead ID','required|is_numeric');
        $this->form_validation->set_rules('lead_email','lead Email','required');
        $this->form_validation->set_rules('lead_mobile','Lead Mobile No.','required');
        $this->form_validation->set_rules('sales_motion','Sales Motion','required');
        $this->form_validation->set_rules('customer_segment','Customer Segment','required');
        $this->form_validation->set_rules('customer_name','Customer Name','required');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('pin_code','Pin Code','required');
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
        //$leads=$this->leads->get_all_created_leads();
        //$loggedin_data = $this->session->userdata('logged_in');
        //$partner_id = $loggedin_data->id;
            
    /*if (isset($_POST) && ! empty($_POST)) {*/
       if($this->form_validation->run() == TRUE){ 
             $registration_date  = $this->input->post('registration_date');
                $product_required  = $this->input->post('product_required');
                    if(count($product_required)<1){
                        $product_required = $this->input->post('product_required');
                    }else{
                        $product_required = implode(",", $product_required);
                    }

        $data=array(
                    'registration_date'=>date("Y-m-d H:i:s", strtotime($registration_date)),
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
               
        if($this->leads->update_lead($id,$data)){
            $this->session->set_flashdata('success_edit_lead','Lead Record Updated Successfully..!');
            redirect('admin/lead/all_leads');
        }
    }else{
            //$this->session->set_flashdata('error_edit_lead','Failed to Updated Lead Record');
           $data['lead_detail'] = $this->leads->get_lead_by_id($id);
                $lead_detail = $this->leads->get_lead_by_id($id);
                $cities=$this->cities->get_edit_cities($lead_detail[0]['customer_state']);
                $data['cities_list'] =$cities;
                $data['bdms']=$this->bdm->get_all_bdms();
                $this->load->view('edit_lead' ,$data);
        }
    }
     /*delete subdistributors*/
    

     public function delete_lead(){
        $id = $this->input->post('id');
        $data=array(
            'is_deleted'=>1
        );

        $result = $this->leads->delete_lead($id,$data);
        redirect('admin/lead/allleads');
    }

     /*update subdistributors status*/
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
            'approval'=>$this->input->post('approval'),
            'status'=>1
        );
        $this->leads->approval_by_partner($id,$data);


        /*Update Default partner id into lead details*/
        $partner_id = $this->leads->partner_id_from_lead($id);
        $data=array(
            'assigned_to_partner'=>$partner_id
        );
        $this->leads->update_default_partner_id($id,$data);

        $data=array(
            'lead_id'=>$this->input->post('id'),
            'partner_id'=>$partner_id,
            'status_id'=>1,
            'modified'=>date("Y-m-d H:i:s")
        );
       $this->leads->insert_record_followup_details($data);
    }



    public function assigned_to_partner(){
        $id = $this->input->post('id');
        $data=array(
            'assigned_to_partner'=>$this->input->post('assigned')
        );
       $this->leads->assigned_to_this_partner($id,$data);

       //$user_id = $this->leads->get_partner_id($this->input->post('assigned'));

       $data=array(
            'lead_id'=>$this->input->post('id'),
            'partner_id'=>$this->input->post('assigned'),
            'status_id'=>1,
            'modified'=>date("Y-m-d H:i:s")
        );
       
       $this->leads->update_followup_details($data);

       $data=array(
            'lead_id'=>$this->input->post('id'),
            'modified'=>date("Y-m-d H:i:s")
        );
       $this->leads->update_lead_details($id,$data); 


    }


    /*Show Deleted lead Details*/
    public function view_deleted_lead_details($id=''){
        $this->load->model('leads');        
        $id = $this->input->post('id');
        $data = $this->leads->get_lead_details($id);
        $dt['data'] = (array)$data;
        $this->load->view('view_deleted_lead_details', $dt);
    }

    public function restore_lead(){   
        $id = $this->input->post('id');
        $data=array(
            'is_deleted'=>0
        );
        $this->leads->restore_this_lead($id,$data);
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

    public function show_partners_dropdown(){
        $data['lead_id'] = $this->input->post('lead_id');
        $data['partner_id'] = $this->input->post('partner_id');
        $this->load->model('partners');
        $data['all_partners']=$this->partners->get_all_partners();
        $this->load->view('partners_dropdown',$data);
    }


     public function view_assigned_status_details($id=''){
        $this->load->model('leads');        
        $id = $this->input->post('id');
        $data = $this->leads->get_assigned_status_lead_details($id);
        $dt['data'] = (array)$data;
        $this->load->view('view_history', $dt);
    }

    public function view_lead_details(){
        $this->load->model('leads');        
        $id = $this->input->post('id');
        $data = $this->leads->get_lead_details($id);
        $dt['data'] = (array)$data;
        $this->load->view('view_lead', $dt);
    }
}
/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
<?php
    (defined('BASEPATH')) OR exit('No direct script access allowed');
    /**
    * Description of users
    *
    * @author Uji Baba
    *
    */
    class Partner extends MY_Controller {
    function __construct(){
        parent::__construct();
        

        $action = $this->router->fetch_method();
        $ajax_action = ['add_partner_to_card'];

        if(!in_array($action, $ajax_action)){
            if (!$this->session->userdata('logged_in')){    
                redirect(base_url('rsm/auth'));
            }

            $this->output->section('header','rsm/header');
            $this->output->section('sidebar','rsm/sidebar');
            $this->output->section('footer','rsm/footer');
            $this->output->set_title('RSM');
            $this->output->set_template('rsm');
            $this->load->model('zones');
            $this->load->model('partners');
            $this->load->model('countries');
            $this->load->model('states');
            $this->load->model('cities');
            $this->load->model('rsm');
            $this->load->library('form_validation');
            $this->load->library('breadcrumbs');
            /*jQuery Validation*/
            $this->output->js('assets/themes/admin/additional-methods.min.js');
            $this->output->js('assets/themes/admin/jquery.validate.min.js');
			
			
			$this->output->css('assets/themes/rsm/waves.css'); 
		  $this->output->css('assets/themes/rsm/animate.css'); 
		    $this->output->css('assets/themes/rsm/morris.css'); 
			  $this->output->css('assets/themes/rsm/style.css'); 
			    $this->output->css('assets/themes/rsm/all-themes.css'); 
			
			
            /* Check user types */
            $loggedin_data = $this->session->userdata('logged_in');
            if($loggedin_data->user_role != 5){
                redirect(base_url('rsm/auth/logout'));
            }
        }
    }
    /*Index Function*/
    function index() {
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('home');
    }
    /* Show all the Partners */
    function all_partners() {
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'rsm');
        $this->breadcrumbs->push('Manage Partners ', 'rsm/');
        $this->breadcrumbs->push('All Partners ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['partners'] = $this->partners->get_all_partners();
        $data['partner_by_id'] = $this->partners->get_partner_by_id_from_rsm_details();
        
        // $data['all_admins']=$this->admin->get_all_admins();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allpartners',$data);
    }

    /*Deleted Partners*/
    function deleted_partners() {
         $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
        $this->breadcrumbs->push('Deleted Users ', 'admin/');
        $this->breadcrumbs->push('All Deleted Partners ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
         $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['partners'] = $this->partners->get_all_deleted_partners();
        // $data['all_admins']=$this->admin->get_all_admins();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('all_deleted_partners',$data);
    }

    
    /* add Partner*/
    public function add_partner(){
        $data['countries']=$this->countries->get_all_countries();
        $data['states']=$this->states->get_all_states();
        $data['cities']=$this->cities->get_all_cities();
        $data['all_admins']=$this->admin->get_all_admins();
        $this->form_validation->set_rules('catagory','Select','required');
        $this->form_validation->set_rules('first_name','First Name','required|alpha');
        $this->form_validation->set_rules('last_name','Last Name','required|alpha');
        //$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
        //$this->form_validation->set_rules('phone','Phone','required|max_length[10]|numeric');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('address','Address','required');
        $this->form_validation->set_rules('assigned','Assigned','required');
        //$this->form_validation->set_rules('file_add','Profile Picture','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('country','Country','required');
        $this->form_validation->set_rules('website','Website','required');
        $this->form_validation->set_rules('source','Source','required');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('firm_name','Firm Name','required|alpha');
        $this->form_validation->set_rules('registration','Registration No','required');
        $this->form_validation->set_rules('firm_address','Firm Address','required');
        $this->form_validation->set_rules('firm_city','Firm City','required');
        $this->form_validation->set_rules('firm_state','Firm State','required');
        $this->form_validation->set_rules('firm_country','Firm Country','required');
       if($this->form_validation->run() == true){ 
            if(isset($_POST)){  
                if(!empty($_FILES['profile_pic']['name'])){
                    $config['upload_path'] = 'uploads/distributors/images/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $new_name = time().$_FILES['profile_pic']['name'];
                    $config['file_name'] = $new_name;
                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                        if($this->upload->do_upload('profile_pic')){
                            $uploadData = $this->upload->data();
                            $picture = $config['upload_path'].$uploadData['file_name'];
                        }else{
                            $picture = '';
                        }
                }else{
                    $picture = '';
                }
                   $email  = $this->input->post('email');
                   $phone = $this->input->post('phone');
                    if(count($email)<1){
                        echo    $emails = $this->input->post('email');
                    }else{
                        echo  $emails = implode(",", $email);
                    }                
                    if(count($phone)<1){
                     echo    $phones = $this->input->post('phone');
                    }else{
                     echo    $phones = implode(",", $phone);
                    }
                        $data=array(
                            'name'=>$this->input->post('catagory'),
                            'first_name'=>$this->input->post('first_name'),
                            'last_name'=>$this->input->post('last_name'),
                            //'account_number'=>$this->input->post('account_number'),
                            'status'=>$this->input->post('status'),
                            'email'=>$emails,
                            'phone'=>$phones,
                            'address'=>$this->input->post('address'),
                            'city'=>$this->input->post('city'),
                            'state'=>$this->input->post('state'),
                            'country'=>$this->input->post('country'),
                            'website'=>$this->input->post('website'),
                            'assigned_to'=>$this->input->post('assigned'),
                            'profile_pic'=>$this->input->post('file_add'),
                            'source'=>$this->input->post('source'),
                            'firm_name'=>$this->input->post('firm_name'),
                            'registration'=>$this->input->post('registration'),
                            'firm_address'=>$this->input->post('firm_address'),
                            'firm_city'=>$this->input->post('firm_city'),
                            'firm_state'=>$this->input->post('firm_state'),
                            'firm_country'=>$this->input->post('firm_country'),
                            'username'=>$this->input->post('username'),
                            'password'=>$this->input->post('password'),
                            'created' =>date("Y-m-d H:i:s"),  
                            'profile_pic'=>$picture
                      ) ;
                if($this->partners->add_new_partner($data)){
                        $this->session->set_flashdata('success','Distributor successfully added.');
                }else{
                       $this->session->set_flashdata('error','Failed to add new Distributor.!');
                       redirect('admin/distributor/add_distributor'); 
                }
        }else{
            $this->form_validation->set_message('catagory', 'catagory is must');
            $this->form_validation->set_message('first_name', 'first  is must');
            $this->form_validation->set_message('last_name', 'last name  is must');
            $this->form_validation->set_message('email', 'email is must');
            $this->form_validation->set_message('phone', 'phone is must');
        }
      }
       $this->load->view('add_distributor',$data);
    }
    /*Send email to partner with his login ID and Password*/
    public function send_email(){
        $id = $this->input->post('id');
        $data['partner'] = $this->partners->get_partner_by_id_from_users($id);
         if(isset($data['partner'][0]['username'])){
         $email = $data['partner'][0]['username'];
        }
        if(isset($data['partner'][0]['password'])){
         $password = $data['partner'][0]['password'];    
        }
                $from = 'lms@gmail.com';
                $name = 'LMS';
                $to = $email;
                $subject = "LMS: System Gerated Username And Password";
                $message = '<p>Hello </p><br> <br><p>You can login with thease credential<br>Username:&nbsp;&nbsp;'.$email.'<br>Password:&nbsp;&nbsp;'.$password.'</p> <br><br> <p></p>';
                $this->load->library('email');
                $this->email->from($from, $name); 
                $this->email->to($to);
                $this->email->subject($subject); 
                $this->email->message($message);
                $this->email->set_mailtype("html");      
                $mail_res=$this->email->send();
    }

    /*edit Partner*/ /*added by 001*/ 
    public function edit_partner($id=''){
         $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
        $this->breadcrumbs->push('View Partners ', 'admin/partner/all_partners/');
        $this->breadcrumbs->push('Edit Partner ', 'admin/partner/all_partners');
        $this->breadcrumbs->unshift('', '');
         $data['breadcrumb'] = $this->breadcrumbs->show();
        if (isset($_POST) && ! empty($_POST)) {

            $product_dealing  = $this->input->post('product_dealing');
            if(count($product_dealing)<1){
                $product_dealing = $this->input->post('product_dealing');
            }else{
                $product_dealing = implode(",", $product_dealing);
            } 

            $product_promoted_past  = $this->input->post('product_promoted_past');
            if(count($product_promoted_past)<1){
                $product_promoted_past = $this->input->post('product_promoted_past');
            }else{
                $product_promoted_past = implode(",", $product_promoted_past);
            }

            $data['firm_name'] = $this->input->post('firm_name');
            $data['owner_name'] = $this->input->post('owner_name');
            $data['contact_no'] = $this->input->post('contact_no');
            $data['email'] = $this->input->post('email');
            $data['firm_incorporation_date'] = $this->input->post('firm_incorporation_date');
            $data['product_dealing_in'] = $product_dealing;
            $data['turn_over'] = $this->input->post('turn_over');
            $data['current_ms_perc_overall_business'] = $this->input->post('percentage_overall_business');
            $data['product_percentage_share_terms_value'] = $this->input->post('percentage_terms_value');
            $data['product_promoted_past'] = $product_promoted_past;

            if($this->partners->update_partner($id,$data)){
                redirect(base_url('admin/partner/all_partners'));
            }
        }else{
            $data['partner_detail'] = $this->partners->get_partner_by_id($id);
            $this->load->view('edit_partner' ,$data);
        }
    }
    /*Delete Partner*/
    public function delete_partner(){

        $id = $this->input->post('id');
        $data=array(
        'is_deleted'=>1
        );

        $result = $this->partners->delete_partner($id,$data);
        //redirect('admin/alldistributors');
    }
    /*update Partner status*/
    public function update_status_partner(){
        $id = $this->input->post('id');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->partners->update_partner_status($id,$data);
        /*update status in users table*/
        $user_id = $this->partners->get_partner_userid($id);
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->partners->update_status_user_table($user_id,$data);

        
    }
    /*Restore Partner*/
    public function restore_partner(){   
        $id = $this->input->post('id');
        $data=array(
            'is_deleted'=>0
        );
        $this->partners->restore_this_partner($id,$data);
    }

   
    /*Approval to partner by admin */
    public function approved_disapproved_partner(){
        $id = $this->input->post('id');
        $partner['details']  = $this->partners->get_partner_by_id($id);
        $genrated_password  = $this->partners->randomPassword();
        $data=array(
            'approval'=>$this->input->post('approval'),
            'status'=>1
        );
        $this->partners->approval_by_admin($id,$data);
        /*For update approval status in users table*/
        $user_id = $this->partners->get_partner_userid($id);
        $data=array(
            'approval'=>$this->input->post('approval'),
        );
        $this->partners->update_approval_user_table($user_id,$data);
        /*For update status in users table*/
        $user_id = $this->partners->get_partner_userid($id);
        $data=array(
            'status'=>1
        );
        $this->partners->update_status_user_table($user_id,$data);

        /* Get Partner details */
        if($this->input->post('approval') == 1){
            $contact_no = substr($partner['details'][0]['contact_no'], -10);
            $this->add_partner_to_card($contact_no);
        }
    }
   
    public function assigned_to_admin(){
        $id = $this->input->post('id');
        $data=array(
            'assigned_to'=>$this->input->post('assigned')
        );
       $this->partners->assigned_to_this_admin($id,$data);
    }

    public function add_partner_to_card($contact_no){
        $contact = '+91'.$contact_no;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_PORT => "443",
          CURLOPT_URL => "https://prod-25.centralindia.logic.azure.com:443/workflows/28c08f25c3e84589ba7201eea2dd572b/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=ML6WJy_lTnx2YnSVZ9Y-947wq98ZsTOZAkv7LDwkARU",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n    \"mobile\": \"".$contact."\"\n}",
          CURLOPT_HTTPHEADER => array(
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            print_r($err);
          return false;
        } else {
          return true;
        }
    }
}
    
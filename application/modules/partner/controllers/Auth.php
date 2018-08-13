<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author Sunil
 *
 */
class Auth extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->output->set_template('login');
        //$this->output->set_title('Partner');
        $this->load->model('partner');
        $this->load->model('authmodel');
        $this->load->model('states');
        $this->load->model('cities');
        $this->load->helper('security');
        $this->load->library('form_validation');
        /*jQuery Validation*/
        $this->output->js('assets/themes/admin/additional-methods.min.js');
        $this->output->js('assets/themes/admin/jquery.validate.min.js');
        $this->output->css('assets/themes/partner/costom-style.css');
        $this->output->css('assets/themes/partner/sweetalert.css'); 
        $this->output->js('assets/themes/partner/sweetalert.js'); 
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    }

    function index() {

        if ($this->session->userdata('logged_in')){
            redirect(base_url('partner'));
        }
        
        $this->load->library('user_agent');
        if ($this->agent->referrer()){
           
            if($this->agent->referrer() == base_url('partner/auth/register') || $this->agent->referrer() == base_url('partner/auth/forget_password')){

            }else{
                $data['referrer'] = base64_encode($this->agent->referrer());
            }
        }

        $error = '';
        if ($this->input->method(TRUE) === 'POST'){
            if ($this->authmodel->verify_validation()){
                $username = $this->input->post('username',true);
                $password = md5($this->input->post('password'));
                if ($this->authmodel->check_login($username,$password)){
                    $user_data = $this->partner->get_partner($username);
                    //echo "<pre>";print_r($user_data);die('dfgj');
                    if ($user_data != false) {
                        /* Get partner ID */
                        $partner_det = $this->partner->get_partner_id($user_data->id);
                        $user_data->partner_id = $partner_det->id;
                        $this->session->set_userdata('logged_in', $user_data);
                        $this->session->set_flashdata('success', 'You have successfully logged in.');
                        //Store Login Info
                        $this->authmodel->store_login_info($username);
                        //Redirect
                        $ref_url = base64_decode($this->input->post('referrer'));
                        if ($ref_url){
                            redirect($ref_url);
                        }else{
                            redirect(base_url('partner'));
                        }

                    }else{
                        $error = 'Error';
                    }
                }else{
                    $error = 'Invalid Username or Password';
                }
            }else{
                $error = validation_errors();
            }
        }
        $data['error'] = $error;

        $this->load->view('login',$data);
    }

/*For Forget Password Mail*/
    public function forget_password(){
        if($this->input->post('email')){
        if($this->input->post('email')){
            if($this->input->post('email')!='')
            {
         
            $email = $this->input->post('email');
            // check user email and update token 
            $token = $this->partner->get_forgot_password($email);
         
            if($token){
               
                $from = 'lms@gmail.com';
                $name = 'LMS';
                $to = $email;

                $subject = "LMS: Forgot Password Verification";
             $message = '<p>Hello </p><br> <br><p>Please <a href="'.base_url('partner/auth/reset_password/'.$token).'">click here</a> to reset your password </p> <br><br> <p></p>';
               

                $this->load->library('email');
               
                $this->email->from($from, $name); 
                $this->email->to($to);
                $this->email->subject($subject); 
                $this->email->message($message);
                $this->email->set_mailtype("html");      
               
                $mail_res=$this->email->send();
               
                if($mail_res)
                {
                    $this->session->set_flashdata('success_message', 'Forgot password verification link is send. Please check your inbox!');
                    redirect('partner/auth/forget_password');         
                }
               
            }else{
                $this->session->set_flashdata('error_message', 'No Email Id Found!');
                
                redirect('partner/auth/forget_password'); 
               
            }
        
            }
            else{
            redirect(base_url(''));
            }
            
            }else{
            redirect(base_url(''));
        }

    }else{
        $this->load->view('forget_password');

       
    }


}

/*For Reset Password*/
public function reset_password($token){

        if($token){
            $response = $this->partner->check_token($token);
            if($response){
                $data['token'] = $token;
            }else{
                $this->session->set_flashdata('error_message', 'Invalid Token!');
                redirect(base_url());

            }

            if($this->input->post()){

                $this->form_validation->set_rules("new_password","New Password","required");
                $this->form_validation->set_rules("confirm_password","Confirm Password","required|matches[new_password]");
                if($this->form_validation->run()){
                    // update password
                    $dt['password'] = md5($this->input->post('new_password'));
                    $dt['reset_pass_token'] = '';
                    $dt['modified'] = date("Y-m-d H:i:s");
                    $where['reset_pass_token'] = $token;
                    $update = $this->partner->change_userdata($dt, $where);


                    if($update){
                    $this->session->set_flashdata('success_msg', 'Password updated! Please login...');
                    redirect(base_url('partner/auth/reset_password'));
                    }
                }
            }
            $this->load->view('reset_password',$data);
        }else{
            $this->session->set_flashdata('error_msg', 'Invalid Token!');
            redirect(base_url('partner/auth/reset_password'));
            //redirect(base_url());
        }
        
    }


    /*For Partner Logout*/
    public function logout(){
        $sess_array = array(
            'id' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->set_flashdata('success', 'Successfully Logout');
        redirect(base_url('partner/auth'));
    }
     public function register()
    {
        $error = '';
         $data['states']=$this->states->get_all_states(); 
        $this->load->model('partner');
        //$data['users'] = $this->user->get_users();
         //$this->output->append_title('Registration');
        $this->output->css('assets/themes/partner/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/partner/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/partner/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('register',$data);
    }

    /*For Partner Register*/
     function do_register(){
        $data['states']=$this->states->get_all_states();
         //$this->output->append_title('Registration'); 
        $this->form_validation->set_rules('firm_name','Firm Name','required|xss_clean');
        $this->form_validation->set_rules('owner_name','Owner Name','required|xss_clean');
        $this->form_validation->set_rules('contact_name','Contact No','required|xss_clean|min_length[10]|max_length[10]|numeric|is_unique[partner_info.contact_no]',array('is_unique' => 'This %s is already exist'));
        $this->form_validation->set_rules('email','Email','required|xss_clean|is_unique[partner_info.email]',array('is_unique' => 'This %s is already exist'));
        $this->form_validation->set_rules('address','Address','required|xss_clean');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('firm_incorporation_date','Date','required');
        //$this->form_validation->set_rules('product_dealing','Product Dealing In','required');
        $this->form_validation->set_rules('turn_over','Turn Over','required|numeric|xss_clean');
        $this->form_validation->set_rules('percentage_overall_business','Current MS % to the overall Business','numeric|xss_clean');
        $this->form_validation->set_rules('percentage_terms_value','Current MS % to the overall Business','required|xss_clean|numeric');

        $genrated_password  = $this->partner->randomPassword();       
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
          $incorporation_date  = $this->input->post('firm_incorporation_date');
       $data="";
        if($this->form_validation->run() == TRUE){
            $data=array(
                'full_name'=>$this->input->post('owner_name'),
                'username'=>$this->input->post('email'),
                'password'=>md5($genrated_password),
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('contact_name'),
                'image'=>'',
                'user_role'=>4,
                'last_login_time'=>'',
                'last_login_ip'=>'',
                'created'=>date("Y-m-d H:i:s")
            );
     
            $user_id = $this->partner->add_partner_users($data);

            if($user_id){
                $this->session->set_flashdata('success','Partner Register Successfully !.');

                $data=array(
                    'firm_name'=>$this->input->post('firm_name'),
                    'owner_name'=>$this->input->post('owner_name'),
                    'contact_no'=>$this->input->post('contact_name'),
                    'email'=>$this->input->post('email'),
                    'address'=>$this->input->post('address'),
                    'username'=>$this->input->post('email'),
                    'state'=>$this->input->post('state'),
                    'city'=>$this->input->post('city'),
                    'password'=>$genrated_password,
                    'firm_incorporation_date'=>date("Y-m-d H:i:s", strtotime($incorporation_date)),
                    'product_dealing_in'=>$product_dealing,
                    'turn_over'=>$this->input->post('turn_over'),
                    'current_ms_perc_overall_business'=>$this->input->post('percentage_overall_business'),
                    'product_percentage_share_terms_value'=>$this->input->post('percentage_terms_value'),
                    'product_promoted_past '=>$product_promoted_past,
                    'created' =>date("Y-m-d H:i:s"),  
                ) ;

                $partner_id = $this->partner->add_partner($data);

                $this->partner->update_user_id($user_id, $partner_id);

                if (isset($user_id) && isset($partner_id)) {

                    /* Send notification to Admin */
                    $this->send_notifications($data);

                    $id = $this->input->post('state');
                    if(isset($data['owner_name'])){
                         $owner_fullname = $data['owner_name'];
                          $partner_fullname = $data['owner_name'];
                    }
                    if(isset($data['email'])){
                     $partner_email = $data['email'];    
                    }
                    $rsm = $this->authmodel->get_rsm_mail();
                    foreach ($rsm  as $key => $value) {
                        $exp = explode(",",$rsm[$key]['states']);
                        for($i=0; $i<=count($exp); $i++){
                             if (!empty($exp[$i])) {
                                if ($id ==$exp[$i] ) {
                                    $rsm_email = $this->authmodel->get_rsm_mail_byid($exp[$i]);
                                    if (!empty($rsm_email[0]['email'])) {
                                        $rsmemail = $rsm_email[0]['email'];                                          
                                    }
                                    $email = $rsmemail;
                                    $from = 'lms@gmail.com';
                                    $name = 'LMS';
                                    $to = $email;
                                    $subject = "CDS LMS: New Partner Registered ";
                                    $data=array(
                                        'full_name'=>$owner_fullname,
                                         'partner_email'=> $partner_email
                                    );
                                    $this->load->library('email');
                                    $this->email->from($from, $name); 
                                    $this->email->to($to);
                                    $this->email->subject($subject); 
                                    $message = $this->load->view('lms_mailer_rsm',$data,TRUE);
                                    $this->email->message($message);
                                    $this->email->set_mailtype("html");      
                                    $mail_resu=$this->email->send();
                                }
                            }
                        }
                    }
                    
                    /* if(!empty($data['owner_name'])){
                         $partner_fullname = $data['owner_name'];
                    }
                    if(!empty($data['email'])){
                     $partner_email = $data['email'];    
                    }*/

                    $admin_email = $this->authmodel->get_admin_email();
                    $email   = $admin_email->email;

                    $from = 'lms@gmail.com';
                    $name = 'LMS';
                    $to = $email;

                    $subject = "CDS LMS: New Partner Registered ";
                                           
                    $data=array(
                        'full_name'=>$partner_fullname,
                        'partner_email'=> $partner_email
                    );

                    $this->load->library('email');
                   
                    $this->email->from($from, $name); 
                    $this->email->to($to);
                    $this->email->subject($subject); 
                    $message = $this->load->view('lms_mailer',$data,TRUE);
                    $this->email->message($message);
                    $this->email->set_mailtype("html");      
                   
                    $mail_res=$this->email->send();
                       
                    if($mail_res){
                        $this->session->set_flashdata('success_message', 'Forgot password verification link is send. Please check your inbox!');
                        redirect('partner/auth/register');         
                    }
                }else{
                    $this->session->set_flashdata('error_message', 'No Email Id Found!');
                    redirect('partner/auth/register'); 
                }
                redirect('partner/auth/register');
            }else{
                $this->session->set_flashdata('error','Failed to Register New Partner.!');
                redirect('partner/auth/register'); 
            }
        }else{
            $data['states']=$this->states->get_all_states(); 
            //die('end');
            $this->form_validation->set_message('firm_name', 'first  is must');
            $this->form_validation->set_message('last_name', 'last name  is must');
            $this->form_validation->set_message('email', 'email is must');
            $this->form_validation->set_message('phone', 'phone is must');
           /* $this->load->view('register',$data);*/
        }
     	
        $this->load->view('register',$data);
    }

     function get_email(){

        $email=$_GET['email'];
       //die('ddjdjdj');
        /*echo $email;*/
         $this->load->model('authmodel');
         $res = $this->authmodel->get_all_email($email);
         //echo $res;
         if ($res==1) {
            echo "allowed";
         }else{
            echo "string";
         }
        
         //$this->load->view('register',$data);
        /*print_r($data);
         die();*/

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
    

    public function send_notifications($partner_det){

        // $partner_mobile = '+91'.substr($partner_det['contact_no'], -10);

        /*$this->load->model('Usermodel');
        $admin_dets = $this->Usermodel->get_admin();*/


        /*$admin_mobiles[] = '+919584499919';
        $admin_mobiles[] = '+917828642047';*/

        /*$admin_as_partner_contact = ['+919584499919','+917828642041','+919893948112','+919165754191','+919303331456','+919425954180'];
        if(in_array($partner_mobile, $admin_as_partner_contact)){
            $is_notify_admin = 1;
        }else{
            $is_notify_admin = 0;
        }*/

        /*foreach ($admin_dets as $key => $admin_det) {
            $admin_mobiles[] = '+91'.substr($admin_det['phone'], -10);
        }
        if(count($admin_mobiles) > 1){
            $admin_mobile = implode(',', $admin_mobiles);
        }else{
            $admin_mobile = $admin_mobiles[0];
        }*/

        /* As we are broadcasting job to all admin so we are passing contact number as blank */

        $task_msgs = ucfirst($partner_det['owner_name']).' has Recently Registered as a Partner. Please Verify the account.';
        $notify_msgs = '';

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
          CURLOPT_POSTFIELDS => "{\n   \"task_mobile_no\": \"\",\n    \"task_mgs\": \"".$task_msgs." \",\n    \"is_task_admin\": \"1\",\n    \"notify_mobile_no\": \"\",\n    \"notify_mgs\": \"\",\n    \"is_notify_admin\": \"0\"\n}",
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

/* End of file AuthModel_model.php */
/* Location: ./application/modules/users/controllers/AuthModel_model.php */
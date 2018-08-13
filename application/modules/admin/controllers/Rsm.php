<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of users
 *
 * @author 
 *
 */
class Rsm extends MY_Controller {
    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('admin/auth'));
        }
        $action = $this->router->fetch_method();
        //$ajax_action = ['view_rsm_details'];
        if($action !='view_rsm_details' && $action !='view_deleted_rsm_details'){
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
            $this->load->model('rsms');
            //$this->load->model('admin');
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

    /* Show all the RSM */
    function all_rsm() {
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
        $this->breadcrumbs->push('Manage RSM', 'admin/');
        $this->breadcrumbs->push('All RSM ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();  
        $data['rsm']=$this->rsms->get_all_rsm_data();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allrsm',$data);
    }

    /*Show All Deleted RSM*/
    function deleted_rsm() { 
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
        $this->breadcrumbs->push('Manage RSM', 'admin/');
        $this->breadcrumbs->push('All Deleted RSM  ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();    
        $data['rsm']=$this->rsms->get_all_deleted_rsm();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('all_deleted_rsm',$data);
    }
    /* Admin profile */
    function profile(){
        $this->load->model('admin');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['admin'] = $this->user->get_admin($username);
        print_r($data);
    }

    /*Add New RSM*/
    public function add_rsm(){
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
        $this->breadcrumbs->push('Manage RSM ', 'admin/');
        $this->breadcrumbs->push('Add RSM', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // $data['countries']=$this->countries->get_all_countries();
        $data['states']=$this->states->get_all_rsm_states();
        //$data['cities']=$this->cities->get_all_cities();
        $this->form_validation->set_rules('name','RSM Name','required');
        $this->form_validation->set_rules('registration_date','Registration Date','required');
        $this->form_validation->set_rules('rsm_email','Email','required|is_unique[rsm_details.email]',array('is_unique' => 'This %s is already exist'));
        $this->form_validation->set_rules('rsm_mobile','Mobile No.','required|is_unique[rsm_details.mobile]',array('is_unique' => 'This %s is already exist'));
        $this->form_validation->set_rules('zone_name','Zone Name','required');
        $this->form_validation->set_rules('state','State');
        if($this->form_validation->run() == true){ 
            if(isset($_POST)){  
                $genrated_password  = $this->rsms->randomPassword();
                $state  = $this->input->post('state');
                if(count($state)<1){
                    $state = $this->input->post('state');
                }else{
                    $state = implode(",", $state);
                }      
                list($date,$month,$year) = explode('/', $this->input->post('registration_date'));
                $registration_date = $year.'-'.$month.'-'.$date;
                $data=array(
                    'name'=>$this->input->post('name'),
                    'registration_date'=>$registration_date,
                    'email'=>$this->input->post('rsm_email'),
                    'password'=>$genrated_password,
                    'mobile'=>$this->input->post('rsm_mobile'),
                    'zone_name'=>$this->input->post('zone_name'),
                    'states'=>$state
                    );
                $rsm_id = $this->rsms->add_new_rsm($data);
                if($rsm_id){
                    $this->session->set_flashdata('success_add_rsm','RSM Successfully Added.');
                    $data=array(
                        'full_name'=>$this->input->post('name'),
                        'username'=>$this->input->post('rsm_email'),
                        'password'=>md5($genrated_password),
                        'email'=>$this->input->post('rsm_email'),
                        'phone'=>$this->input->post('rsm_mobile'),
                        'image'=>'',
                        'user_role'=>5,
                        'last_login_time'=>'',
                        'last_login_ip'=>'',
                        'created'=>date("Y-m-d H:i:s")
                    );
                    $user_id = $this->rsms->add_rsm_users($data);
                    $this->rsms->update_user_id($user_id, $rsm_id);
                }else{
                 $this->session->set_flashdata('error_add_rsm','Failed to add new RSM.!');
                 redirect('admin/rsm/add_rsm'); 
             }
         }else{
            $this->form_validation->set_message('catagory', 'catagory is must');
            $this->form_validation->set_message('first_name', 'first  is must');
            $this->form_validation->set_message('last_name', 'last name  is must');
            $this->form_validation->set_message('email', 'email is must');
            $this->form_validation->set_message('phone', 'phone is must');
        }
    }
    $data['breadcrumb'] = $this->breadcrumbs->show();
    $this->load->view('add_rsm',$data);
}

/*Send email to RSM with there login ID and Password*/
public function send_email(){
    $id = $this->input->post('id');
    $data['rsm'] = $this->rsms->get_rsm_by_id_rsm_details($id);

    if(isset($data['rsm'][0]['name'])){
       $rsm_name = $data['rsm'][0]['name'];
   } 
    if(isset($data['rsm'][0]['email'])){
       $email = $data['rsm'][0]['email'];
   }
   if(isset($data['rsm'][0]['password'])){
       $password = $data['rsm'][0]['password'];    
   }
   $from = 'lms@gmail.com';
   $name = 'LMS';
   $to = $email;
   $subject = "LMS: System Gerated Username And Password";
   $data=array(
                    'name'=>$rsm_name, 
                    'username'=>$email,
                    'password'=>$password
                );
   $this->load->library('email');
   $this->email->from($from, $name); 
   $this->email->to($to);
   $this->email->subject($subject);
   $message = $this->load->view('rsm_mailer',$data,TRUE); 
   $this->email->message($message);
   $this->email->set_mailtype("html");      
   $mail_res=$this->email->send();
}
/*edit RSM*/
public function edit_rsm($id=''){
   $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
   $this->breadcrumbs->push('All Leads ', 'admin/lead/all_leads');
   $this->breadcrumbs->push('Edit Lead ', 'section/page/page');
   $this->breadcrumbs->unshift('', '');
   $data['breadcrumb'] = $this->breadcrumbs->show();
   if($id != ''){
    $id = base64_decode($id);
}else{
    redirect('admin/rsm/all_rsm');
}
$this->form_validation->set_rules('name','RSM Name','required');
$this->form_validation->set_rules('registration_date','Registration Date','required');
// $this->form_validation->set_rules('rsm_email','Email','required|is_unique[rsm_details.email]');
// $this->form_validation->set_rules('rsm_mobile','Mobile No.','required|is_unique[rsm_details.mobile]');
$this->form_validation->set_rules('rsm_email','Email','required');
$this->form_validation->set_rules('rsm_mobile','Mobile No.','required');

$this->form_validation->set_rules('zone_name','Zone Name','required');
$this->form_validation->set_rules('state','State');
/*if (isset($_POST) && ! empty($_POST)) {*/
 if($this->form_validation->run() == TRUE){ 
    $genrated_password  = $this->rsms->randomPassword();
  $state  = $this->input->post('state');
  if(count($state)<1){
    $state = $this->input->post('state');
}else{
    $state = implode(",", $state);
}      
 /*list($date,$month,$year) = explode('/', $this->input->post('registration_date'));
 $registration_date = $year.'-'.$month.'-'.$date;*/
 $registration_date = $this->input->post('registration_date');
$data=array(
    'name'=>$this->input->post('name'),
    'registration_date'=> date("Y-m-d", strtotime($registration_date)),
    'email'=>$this->input->post('rsm_email'),
    'password'=>$genrated_password,
    'mobile'=>$this->input->post('rsm_mobile'),
    'zone_name'=>$this->input->post('zone_name'),
    'states'=>$state  
) ;

if($this->rsms->update_rsm($id,$data)){
    $this->session->set_flashdata('success','RSM Record Updated Successfully..!');
    redirect('admin/rsm/all_rsm');
}
}else{
    $data['rsm_detail'] = $this->rsms->get_rsm_by_id($id);
    $data['states']=$this->states->get_all_states();
    $this->load->view('edit_rsm' ,$data);
}
}

/*delete RSM*/
public function delete_rsm(){
    $id = $this->input->post('id');
    $data=array(
        'is_deleted'=>1
    );
    $result = $this->rsms->delete_rsm($id,$data);
    redirect('admin/rsm/allrsm');
}

/*update RSM status*/
public function update_status_rsm(){
    $id = $this->input->post('id');
    $data=array(
        'status'=>$this->input->post('status')
    );
    $this->rsms->update_rsm_status($id,$data);
    $rsm_id = $this->rsms->get_rsm($id);
    $data=array(
        'status'=>$this->input->post('status')
    );
    $this->rsms->update_rsm_status_users($rsm_id,$data);
}

/*Restore Any Deleted RSM*/
public function restore_rsm(){   
    $id = $this->input->post('id');
    $data=array(
        'is_deleted'=>0
    );
    $this->rsms->restore_this_rsm($id,$data);
}

/*View RSM details*/
public function view_rsm_details(){
    $this->load->model('rsms');        
    $id = $this->input->post('id');
    $data = $this->rsms->get_rsm_details($id);
    $dt['data'] = (array)$data;
    $this->load->view('view_rsm', $dt);
}

/*Show Deleted RSM Details*/
    public function view_deleted_rsm_details($id=''){
        $this->load->model('rsms');        
        $id = $this->input->post('id');
        $data = $this->rsms->get_deleted_rsm($id);
        $dt['data'] = (array)$data;
        $this->load->view('view_deleted_rsm', $dt);
    }
}
/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
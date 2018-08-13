<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 
 *
 */
class Partner extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('partner/auth'));
        }
        $action = $this->router->fetch_method();
        $ajax_view = ['popup_partner_details'];
        if(!in_array($action, $ajax_view)){
            $this->output->section('header','partner/header');
            $this->output->section('sidebar','partner/sidebar');
            $this->output->section('footer','partner/footer');
            $this->output->set_title('Partner');
              // load Breadcrumbs
            $this->load->library('breadcrumbs');
            $this->output->set_template('partner');
            $this->load->helper('security');
            $this->load->model('leads');
        }
        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 4){
            redirect(base_url('partner/auth/logout'));
        }
        $this->output->css('assets/themes/partner/sweetalert.css'); 
        $this->output->js('assets/themes/partner/sweetalert.js'); 
    }
    /*Index function*/
    function index() {
    	$this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        //$this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('Dashboard ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $this->load->model('partner');
        // $data['total_partners'] = $this->partners->get_total_partners();
        // $data['total_approved_partners'] = $this->partners->get_total_approved_partners();
        // $data['total_inactive_partners'] = $this->partners->get_total_inactive_partners();
        $data['total_leads'] = $this->leads->get_total_leads();
        $data['total_unassigned_leads'] = $this->leads->get_total_unassigned_leads();
        $data['total_assigned_leads'] = $this->leads->get_total_assigned_leads();
        $data['banners'] = $this->leads->get_banner_details();
        //$data['users'] = $this->user->get_users();
        //$this->output->append_title('Users');


        $this->output->css('assets/themes/partner/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/partner/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/partner/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('home',$data);
    }

    /*Edit Partner profile*/
    public function edit_profile(){  
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
        $this->breadcrumbs->push('Profile', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show(); 
        //$this->load->model('partner');
        $id = $this->session->logged_in->id;
        $data['profiles_detail'] = $this->leads->get_profile_details();
            if($this->input->post('up_image')){
                if(!empty($_FILES['profile_pic']['name'])){
                            $config['upload_path'] = 'uploads/partners/images/';
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

                 $data=array(
                    'image'=>$picture,
                    'modified'=>date("Y-m-d H:i:s")
                 );


                 /*Change Partner Profile image*/
                 if($picture!=null && $this->leads->change_profile_pic($id,$data)){

                            $session_data = $this->session->userdata('logged_in');
                            $session_data->image = $picture;
                            $this->session->set_userdata('logged_in', $session_data);
                            $this->session->set_userdata('logged_in', $session_data);
                            $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                            /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                            $this->breadcrumbs->push('Profile', 'section/page/page');
                            $this->breadcrumbs->unshift('', '');
                            $data['breadcrumb'] = $this->breadcrumbs->show();
                            $this->session->set_flashdata('success_profile','Your Profile Picture Successfully Updated..!');
                            redirect('partner/partner/edit_profile');
               
                 }else if($this->input->post('up_image')){
                    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                            /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                            $this->breadcrumbs->push('Profile', 'section/page/page');
                            $this->breadcrumbs->unshift('', '');
                            $data['breadcrumb'] = $this->breadcrumbs->show();
                        $this->session->set_flashdata('error_profile','Failed To Upload Your Profile Picture!');
                 }      
            } 
            /*Change Partner Password*/
            if($this->input->post('change_password')){

              
                $data=array(
                    'password'=>md5($this->input->post('password')),
                    'modified'=>date("Y-m-d H:i:s")
                );

                $inserted_id = $this->leads->change_password($id,$data);

                if($inserted_id){
                      $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                            /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                            $this->breadcrumbs->push('Profile', 'section/page/page');
                            $this->breadcrumbs->unshift('', '');
                            $data['breadcrumb'] = $this->breadcrumbs->show();
                           $this->session->set_flashdata('success','Your Password has been changed..!');

                   

                }else{

                    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                            /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                            $this->breadcrumbs->push('Profile', 'section/page/page');
                            $this->breadcrumbs->unshift('', '');
                            $data['breadcrumb'] = $this->breadcrumbs->show();
                        $this->session->set_flashdata('error','Failed to change your password..!');

                }



            }


            /*Edit Profile details*/
            if($this->input->post('profile')){
                $data=array(
                    'firm_name'=>$this->input->post('firm_name'),
                    'owner_name'=>$this->input->post('owner_name'),
                    'modified'=>date("Y-m-d H:i:s")
                );
               
                if(!$this->leads->change_name($id,$data)){
                       $this->session->set_flashdata('success_profile','Your Profile Details Has Been Changed..!');
                       $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                        /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                       $this->breadcrumbs->push('Profile', 'section/page/page');
                       $this->breadcrumbs->unshift('', '');
                       $data['breadcrumb'] = $this->breadcrumbs->show();
                       redirect('partner/partner/edit_profile'); 
                }else{
                    
                    $this->session->set_flashdata('error_profile','Failed To Update Your Profile Details..!');
                    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                    /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                    $this->breadcrumbs->push('Profile', 'section/page/page');
                    $this->breadcrumbs->unshift('', '');
                    $data['breadcrumb'] = $this->breadcrumbs->show();
                    $data['profiles_detail'] = $this->leads->get_profile_details();
                        
                }
            }

                $this->load->view('edit_profile',$data);
            }



        /*This function not in use start*/
        public function edit_profile_data(){   
        $id = $this->session->logged_in->id;
        if(isset($_POST)){
            if(!empty($_FILES['profile_pic']['name'])){
                        $config['upload_path'] = 'uploads/partners/images/';
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

             $data=array(
                'image'=>$picture,
                'modified'=>date("Y-m-d H:i:s")
             );

             if($picture!=null && $this->leads->change_profile_pic($id,$data)){

                $session_data = $this->session->userdata('logged_in');
                $session_data->image = $picture;
                $this->session->set_userdata('logged_in', $session_data);



                $this->session->set_flashdata('success','Your profile Picture Successfully Updated..!');
             }else if(isset($_POST['submit'])){
                $this->session->set_flashdata('error','Failed To Upload your Profile Picture!');
             }      
        }

            $this->load->view('edit_profile');
        }

    /*This function not in use end*/

    /*Show Profile*/
    function profile(){
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        $this->breadcrumbs->push('Accounts Details ', 'partner/');
        $this->breadcrumbs->push('My Profile ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['profiles'] = $this->leads->get_profile_details();
        $this->load->view('profile_details',$data);
      
    }

    public function changepassword(){
       if($this->input->post('password')){
           $id = $this->session->logged_in->id;
           $password = md5($this->input->post('password'));
           $inserted_id = $this->leads->checkpassword($id,$password);
           if($inserted_id == true){
                $newpassdata=array(
                    'password'=>md5($this->input->post('newPassword')),
                    'modified'=>date("Y-m-d H:i:s")
                );
                $changepassword = $this->leads->changepassword($id,$newpassdata);
                if($changepassword){
                    echo "passwordchanged";
                    exit;
                }else{
                    echo "passwordnotchanged";
                    exit;
                }
           }else{
            echo "wrongpassword";
            exit;
           }
       }
    }

 public function popup_partner_details(){
    $this->load->model('leads');
    $data = $this->leads->get_popup_profile_details();
    $dt['data'] = (array)$data;
    $this->load->view('view_profile_details',$dt);  
}

}

/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Profile extends MY_Controller {
    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('admin/auth'));
        }

        $action = $this->router->fetch_method();
        $ajax_view = ['profile_details'];
        if(!in_array($action, $ajax_view)){
        $this->output->section('header','admin/header');
        $this->output->section('sidebar','admin/sidebar');
        $this->output->section('footer','admin/footer');
        $this->output->set_title('Admin');
        $this->output->set_template('admin');
        $this->load->model('zones');
        $this->load->model('leads');
        $this->load->model('partners');
        $this->load->model('countries');
        $this->load->model('states');
        $this->load->model('cities');
        $this->load->model('profiles');
        $this->load->library('breadcrumbs');
        //$this->load->model('admin');
        }
        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
        }
        $this->output->css('assets/themes/partner/sweetalert.css'); 
        $this->output->js('assets/themes/partner/sweetalert.js');
    }
    
    /*view profile details*/
    function profile_details(){
         $this->load->model('profiles');
         $data = $this->profiles->get_profile_details();
         $dt['data'] = (array)$data;
        $this->load->view('profile_details',$dt);  
    }  


    // /*view profile details*/
    // function profile_details(){
    //      $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
    // $this->breadcrumbs->push('Account Details ', 'admin/');
    // $this->breadcrumbs->push('View Profile ', 'section/page/page');
    // $this->breadcrumbs->unshift('', '');
    //  $data['breadcrumb'] = $this->breadcrumbs->show(); 
    //      $data['profiles_detail'] = $this->profiles->get_profile_details();
    //     $this->load->view('profile_details',$data);  
    // }

    /*Edit profile details*/
    public function edit_profile(){ 
        $this->output->css('assets/themes/admin/costom-style.css');
    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
    $this->breadcrumbs->push('Account Details ', 'admin/');
    $this->breadcrumbs->push('Edit Profile ', 'section/page/page');
    $this->breadcrumbs->unshift('', '');
     $data['breadcrumb'] = $this->breadcrumbs->show(); 
      //$this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
        /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
         // $this->breadcrumbs->push('Profile', 'section/page/page');
         // $this->breadcrumbs->unshift('', '');
         // $data['breadcrumb'] = $this->breadcrumbs->show(); 
    $id = $this->session->logged_in->id;
    $data['profiles_detail'] = $this->profiles->get_profile_details();
    if($this->input->post('up_image')){
        if(!empty($_FILES['profile_pic']['name'])){
                    $config['upload_path'] = 'uploads/admins/images/';
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

         if($picture!=null && $this->profiles->change_profile_pic($id,$data)){
            $session_data = $this->session->userdata('logged_in');
            $session_data->image = $picture;
            $this->session->set_userdata('logged_in', $session_data);
             $this->session->set_userdata('logged_in', $session_data);
                    // $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                    /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                    // $this->breadcrumbs->push('Profile', 'section/page/page');
                    // $this->breadcrumbs->unshift('', '');
                    // $data['breadcrumb'] = $this->breadcrumbs->show();
                   $this->session->set_flashdata('success_profile','Your Profile Picture Updated Successfully..!');
                redirect('admin/profile/edit_profile'); 
         }else if($this->input->post('up_image')){
            // $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'partner');
                    /* $this->breadcrumbs->push('Manage Leads ', 'partner/');*/
                    // $this->breadcrumbs->push('Profile', 'section/page/page');
                    // $this->breadcrumbs->unshift('', '');
                    // $data['breadcrumb'] = $this->breadcrumbs->show();
                $this->session->set_flashdata('error_profile','Failed to Upload Your Profile Picture!');
         }      
    } 
    
    if($this->input->post('profile')){
        $data=array(
            'full_name'=>$this->input->post('name'),
            'modified'=>date("Y-m-d H:i:s")
        );
        $inserted_id = $this->profiles->change_name($id,$data);
        if(!$this->profiles->change_name($id,$data)){
                $this->session->set_flashdata('success_profile','Your Name has been changed..!');
                $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
                $this->breadcrumbs->push('Account Details ', 'admin/');
                $this->breadcrumbs->push('Edit Profile ', 'section/page/page');
                $this->breadcrumbs->unshift('', '');
                $data['breadcrumb'] = $this->breadcrumbs->show(); 
                
        }else{

                $this->session->set_flashdata('error_profile','Failed to Change Your Name..!');
                $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
                $this->breadcrumbs->push('Account Details ', 'admin/');
                $this->breadcrumbs->push('Edit Profile ', 'section/page/page');
                $this->breadcrumbs->unshift('', '');
                $data['breadcrumb'] = $this->breadcrumbs->show(); 
                

                $data['profiles_detail'] = $this->profiles->get_profile_details();
                //$this->load->view('edit_profile',$data);
        }
    }


        $this->load->view('edit_profile',$data);
    } 

    public function changepassword(){

           if($this->input->post('password')){
                    
               $id = $this->session->logged_in->id;
               $password = md5($this->input->post('password'));
               $inserted_id = $this->profiles->checkpassword($id,$password);
               
               if($inserted_id == true){
                    $newpassdata=array(
                            'password'=>md5($this->input->post('newPassword')),
                            'modified'=>date("Y-m-d H:i:s")
                    );

                    $changepassword = $this->profiles->changepassword($id,$newpassdata);
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


    
}
/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
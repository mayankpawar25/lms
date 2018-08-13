<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Banner extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('admin/auth'));
        }
        $this->output->section('header','admin/header');
        $this->output->section('sidebar','admin/sidebar');
        $this->output->section('footer','admin/footer');
        $this->output->set_title('Super Admin');
        $this->output->set_template('admin');
        $this->load->model('zones');
        $this->load->model('leads');
        $this->load->model('partners');
        $this->load->model('countries');
        $this->load->model('states');
        $this->load->model('cities');
        $this->load->model('banners');
        $this->load->library('breadcrumbs');
        //$this->load->model('admin');

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
        }
        $this->output->css('assets/themes/admin/sweetalert.css'); 
        $this->output->js('assets/themes/admin/sweetalert.js');

    }

   
    /* Show all the subdistributors */


    function add_banner(){
    $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
    $this->breadcrumbs->push('Manage Banners ', 'admin/');
    $this->breadcrumbs->push('Add Banner ', 'section/page/page');
    $this->breadcrumbs->unshift('', '');
    $data['breadcrumb'] = $this->breadcrumbs->show(); 
       if($this->input->post()){
        if(!empty($_FILES['profile_pic']['name'])){
                    $config['upload_path'] = 'uploads/banner/';
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
            'banner_text'=>$this->input->post('banner_content'),
            'button_link'=>$this->input->post('link'),
            'button_text'=>$this->input->post('button_text')
            //'modified'=>date("Y-m-d H:i:s")
         );
         if($this->banners->update_banner_content($data)){
            
            $this->session->set_flashdata('success','Banner Added Successfully..!');
            $data['breadcrumb'] = $this->breadcrumbs->show(); 

         }else if($this->input->post()){
            $this->session->set_flashdata('error','Failed to update banner content!');
            $data['breadcrumb'] = $this->breadcrumbs->show(); 
         }      
    }
    $this->load->view('add_banner',$data);

    }
    
    
    function view_banner(){
         $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
        $this->breadcrumbs->push('Manage Banners ', 'admin/');
        $this->breadcrumbs->push('All Banners ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $this->output->css('assets/themes/admin/costom-style.css');
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $data['all_banners'] = $this->banners->get_all_banners_details();

        $this->load->view('allbanners',$data);

    }


    /* Admin profile */
   
    function profile(){
        $this->load->model('admin');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['admin'] = $this->user->get_admin($username);
       print_r($data);

    }

    

     /*edit subdistributors*/

    public function edit_banner($id=''){
      
    if (isset($_POST) && ! empty($_POST)) {


        if(!empty($_FILES['profile_pic']['name'])){
                    $config['upload_path'] = 'uploads/banner/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $new_name = time().$_FILES['profile_pic']['name'];
                    $config['file_name'] = $new_name;
                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                        if($this->upload->do_upload('profile_pic')){
                            $uploadData = $this->upload->data();
                            $data['image'] = $config['upload_path'].$uploadData['file_name'];
                        }
                }else{
                    // $picture = '';
                    // $data['image'] = "";
                }


        $data['banner_text'] = $this->input->post('banner_content');
        $data['button_text'] = $this->input->post('button_text');
        $data['button_link'] = $this->input->post('link');
            if($this->banners->update_banner_data($id,$data)){
                $this->session->set_flashdata('success','Banner Content Updated Successfully..!');
                redirect('admin/banner/view_banner');
            }
    }else{
            $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
            $this->breadcrumbs->push('Manage Banners ', 'admin/');
            $this->breadcrumbs->push('Edit Banner ', 'section/page/page');
            $this->breadcrumbs->unshift('', '');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            $data['bannner_detail'] = $this->banners->get_banner_by_id($id);
            $this->load->view('edit_banner',$data);
        }
    }

   
     /*delete banner*/
    public function delete_banner(){
        $id = $this->input->post('id');
        $result = $this->banners->delete_banner($id);
        redirect('admin/banner/allbanners');
    }

    

     /*update banner status*/
    public function update_status_banner(){
        $id = $this->input->post('id');
        // print_r($_POST);
        // die();
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->banners->update_banner_status($id,$data);
    }


    /*Approval by admin to partner*/
    public function approved_disapproved_lead(){

        $id = $this->input->post('id');

        $data=array(
            'approval'=>$this->input->post('approval'),
            'status'=>1
        );


        $this->leads->approval_by_partner($id,$data);
    }

    public function assigned_to_partner(){
        $id = $this->input->post('id');
        $data=array(
            'assigned_to_partner'=>$this->input->post('assigned')
        );
       $this->leads->assigned_to_this_partner($id,$data);
       
    }


}





/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
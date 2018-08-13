<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author 
 *
 */
class Distributor extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('distributor/auth'));
        }
        //$this->output->section('headerd','welcome/headerd');
        $this->output->section('header','distributor/header');
        $this->output->section('sidebar','distributor/sidebar');
        $this->output->section('footer','distributor/footer');
        $this->output->set_title('Distributor');
        $this->output->set_template('distributor');

         /* Load Breadcrumbs */
        $this->load->library('breadcrumbs');
        $this->load->model('subdistributor');

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 2){
            redirect(base_url('distributor/auth/logout'));
        }
    }

    function index() {
        
        $this->breadcrumbs->push('Home', 'distributor');
        $this->breadcrumbs->push('User', 'section/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
    	$this->load->model('distributor');
    	//$data['distributors'] = $this->distributor->get_users();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/distributor/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/distributor/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/distributor/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('home',$data);
    }

    function profile(){
        $this->load->model('distributor');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['distributor'] = $this->distributor->get_distributor($username);
       print_r($data);

    }

     public function ShowSubDistributorForm(){
       $this->load->view('edit_subdistributor');
     }

    

    function all_sub_distributor() {
        $this->breadcrumbs->push('Home', 'distributor');
        $this->breadcrumbs->push('All Sub Distributor ', 'section/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();

        $data['all_sub_distributor'] = $this->subdistributor->get_all_subdistributor();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allsubdistributor',$data);
    }

    public function add_newsubdistributor(){
    $this->load->view('add_zone');    
    }

    
    public function add_subdistributor(){

     if(isset($_POST)){   
      $data=array(
        'zone_name'=>$this->input->post('zone_name'),
        'zone_area'=>$this->input->post('zone_area'),
        
      ) ; 

      if($this->subdistributor->add_new_subdistributor($data)){

      $this->session->set_flashdata('success','Zone successfully added.');
        }else{

        $this->session->set_flashdata('error','Failed to add new zone.!');
        
       redirect('admin/add_zone'); 
        }

    }

    $this->load->view('add_zone');

    }

    public function edit_subdistributor($id=''){
    if (isset($_POST) && ! empty($_POST)) {
        $data['zone_name'] = $this->input->post('zone_name');
        $data['zone_area'] = $this->input->post('zone_area');
            if($this->subdistributor->update_zone($id,$data)){
                $this->session->set_flashdata('success','updated successfully');
                redirect('distributor/all_sub_distributor');
            }
    }else{
             
            $data['zone_detail'] = $this->subdistributor->get_subdistributor_by_id($id);
            $this->load->view('edit_zone' ,$data);
        }
    }


    public function delete_subdistributor(){
       $id = $this->input->post('id');
        $result = $this->subdistributor->delete_subdistributor($id);
        redirect('distributor/all_sub_distributor');
    }

    public function update_status(){

        $id = $this->input->post('id');
        //$status = $this->input->post('status');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->subdistributor->update_subdistributor_status($id,$data);
    }

}
/*Distributor controllers End */

/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
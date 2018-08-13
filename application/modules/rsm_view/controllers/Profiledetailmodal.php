<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Profiledetailmodal extends MY_Controller {
    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('rsm/auth'));
        }
         $action = $this->router->fetch_method();
        $ajax_view = ['profile_details'];
        if(!in_array($action, $ajax_view)){
        $this->output->set_title('RSM');
        $this->load->model('zones');
        $this->load->model('leads');
        $this->load->model('partners');
        $this->load->model('countries');
        $this->load->model('states');
        $this->load->model('cities');
        $this->load->model('profiles');
        $this->load->library('breadcrumbs');
    }
        //$this->load->model('admin');
        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 5){
            redirect(base_url('rsm/auth/logout'));
        }
    }
	public function profile_details(){
       /* $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'rsm');
        $this->breadcrumbs->push('Account Details ', 'rsm/');
        $this->breadcrumbs->push('View Profile ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show(); */
        $this->load->model('profiles');
        $data['profiles_detail'] = $this->profiles->get_profile_details();
        $this->load->view('profiledetailmodal',$data);
    }
}
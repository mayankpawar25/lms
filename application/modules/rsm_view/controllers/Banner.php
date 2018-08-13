<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
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


    }
      
    /*Show Banner*/
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

    /*Approval by admin to partner*/
    public function approved_disapproved_lead(){

        $id = $this->input->post('id');

        $data=array(
            'approval'=>$this->input->post('approval'),
            'status'=>1
        );


        $this->leads->approval_by_partner($id,$data);
    }
    


}





/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
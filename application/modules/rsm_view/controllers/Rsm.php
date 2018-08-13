<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Rsm extends MY_Controller {
    function __construct(){
        parent::__construct();

        if (!$this->session->userdata('logged_in')){
            redirect(base_url('rsm/auth'));
        }
        $this->output->section('header','rsm/header');
        $this->output->section('sidebar','rsm/sidebar');
        $this->output->section('footer','rsm/footer');
        $this->output->set_title('Regional Sales Manager ');
        $this->output->set_template('rsm');
        $this->load->model('zones');
        $this->load->model('distributors');
        $this->load->model('partners');
        $this->load->model('leads');
         $this->load->library('breadcrumbs');
        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 5){
            redirect(base_url('rsm/auth/logout'));
        }
		 $this->output->css('assets/themes/rsm/costom-style.css'); 
		 $this->output->css('assets/themes/rsm/waves.css'); 
		  $this->output->css('assets/themes/rsm/animate.css'); 
		    $this->output->css('assets/themes/rsm/morris.css'); 
			  $this->output->css('assets/themes/rsm/style.css'); 
			    $this->output->css('assets/themes/rsm/all-themes.css'); 
    }
    /*RSM Index*/
    function index() {
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'rsm');
        //$this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('Dashboard ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['total_partners'] = $this->partners->get_total_partners();
        $data['partner_by_id'] = $this->partners->get_partner_by_id_from_rsm_details();
        //$data['total_approved_partners'] = $this->partners->get_total_approved_partners();
        //$data['total_inactive_partners'] = $this->partners->get_total_inactive_partners();
        $data['total_leads'] = $this->leads->get_total_leads();
        $data['total_approved_leads'] = $this->leads->get_total_approved_leads();
        $data['total_inactive_leads'] = $this->leads->get_total_inactive_leads();
        $data['banners'] = $this->leads->get_banner_details();
        // $this->load->model('admin');
        //$data['users'] = $this->user->get_users();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->output->js('assets/themes/rsm/bower_components/datatables.net-bs/js/waves.js');
		$this->output->js('assets/themes/rsm/bower_components/datatables.net-bs/js/morris.js');
        $this->load->view('home',$data);
        // die('asasaasas');
    }
   
    
   
    /*update zone status*/
    public function update_status(){
        $id = $this->input->post('id');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->zones->update_zone_status($id,$data);
    }
   
}
/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Admin extends MY_Controller {
    function __construct(){
        parent::__construct();

        /*echo "<pre>";
        print_r($this->session->userdata('logged_in'));
        die('123123');*/

        if (!$this->session->userdata('logged_in')){
            redirect(base_url('admin/auth'));
        }
        $this->output->section('header','admin/header');
        $this->output->section('sidebar','admin/sidebar');
        $this->output->section('footer','admin/footer');
        $this->output->set_title('Admin');
        $this->output->set_template('admin');
        $this->load->model('zones');
        $this->load->model('distributors');
        $this->load->model('partners');
        $this->load->model('banners');
        $this->load->model('leads');
         $this->load->library('breadcrumbs');
        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
        }
    }
    function index() {
        $this->breadcrumbs->push('<i class="fa fa-dashboard"></i>&nbsp;Home', 'admin');
        //$this->breadcrumbs->push('Manage Leads ', 'partner/');
        $this->breadcrumbs->push('Dashboard ', 'section/page/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();

        //$data['total_partners'] = $this->partners->get_all_partners_total();
        $data['total_partners'] = $this->partners->get_total_partners();
        $data['total_approved_partners'] = $this->partners->get_total_approved_partners();
        $data['total_inactive_partners'] = $this->partners->get_total_inactive_partners();
        $data['total_leads'] = $this->leads->get_total_leads();
        $data['total_approved_leads'] = $this->leads->get_total_approved_leads();
        $data['total_inactive_leads'] = $this->leads->get_total_inactive_leads();
        $data['banners'] = $this->banners->get_all_active_banners_details();
        // $this->load->model('admin');
        //$data['users'] = $this->user->get_users();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        /*echo "<pre>";
        print_r($data['banners']);
        die;*/
        $this->load->view('home',$data);
        // die('asasaasas');
    }
    /* Show all the zones */
    function all_zones() {
        $data['zones'] = $this->zones->get_all_zones();
        $this->output->append_title('Users');
    $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
    $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allzones',$data);
    }
    /* Show all the distributors */
    function all_distributors() {
        $data['distributors'] = $this->distributors->get_all_distributors();
        $this->output->append_title('Users');
    $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
    $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('alldistributors',$data);
    }
    /* Admin profile */
    function profile(){
        $this->load->model('admin');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['admin'] = $this->user->get_admin($username);
       print_r($data);
    }
    /* Load add view zone  */
    public function add_newzone(){
    $this->load->view('add_zone');    
    }
    /* Load add view distributor */
    public function add_newdistributor(){
    $this->load->view('add_distributor');    
    }
    /* add zone  */
    public function add_zone(){
     if(isset($_POST)){   
      $data=array(
        'zone_name'=>$this->input->post('zone_name'),
        'zone_area'=>$this->input->post('zone_area'),
      ) ; 
      if($this->zones->add_new_zone($data)){
      $this->session->set_flashdata('success','Zone successfully added.');
        }else{
        $this->session->set_flashdata('error','Failed to add new zone.!');
       redirect('admin/add_zone'); 
            }
        }
    }
    /* add distributor*/
    public function add_distributor(){
     if(isset($_POST)){   
      $data=array(
        'zone_name'=>$this->input->post('zone_name'),
        'zone_area'=>$this->input->post('zone_area'),
      ) ; 
      if($this->distributors->add_new_distributor($data)){
      $this->session->set_flashdata('success','Zone successfully added.');
        }else{
        $this->session->set_flashdata('error','Failed to add new zone.!');
       redirect('admin/add_distributor'); 
        }
    }
    $this->load->view('add_distributor');
    }
    /*edit zone*/
    public function edit_zone($id=''){
    if (isset($_POST) && ! empty($_POST)) {
        $data['zone_name'] = $this->input->post('zone_name');
        $data['zone_area'] = $this->input->post('zone_area');
            if($this->zones->update_zone($id,$data)){
                //$this->session->set_flashdata('success','updated successfully');
                redirect('admin/all_zones');
            }
    }else{
            $data['zone_detail'] = $this->zones->get_zone_by_id($id);
            $this->load->view('edit_zone' ,$data);
        }
    }
    /*edit distributor*/
    public function edit_distributor($id=''){
    if (isset($_POST) && ! empty($_POST)) {
        $data['zone_name'] = $this->input->post('zone_name');
        $data['zone_area'] = $this->input->post('zone_area');
            if($this->distributors->update_distributor_status($id,$data)){
                //$this->session->set_flashdata('success','updated successfully');
                redirect('admin/alldistributors');
            }
    }else{
            $data['distributor_detail'] = $this->distributors->get_distributor_by_id($id);
            $this->load->view('edit_distributor' ,$data);
        }
    }
    /*delete zone*/
    public function delete_zone(){
       $id = $this->input->post('id');
        $result = $this->zones->delet_zone($id);
        redirect('admin/all_zones');
    }
    /*delete distributor*/
    public function delete_distributor(){
        $id = $this->input->post('id');
        $result = $this->distributors->delete_distributor($id);
        redirect('admin/alldistributors');
    }
    /*update zone status*/
    public function update_status(){
        $id = $this->input->post('id');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->zones->update_zone_status($id,$data);
    }
    /*update distributor status*/
    public function update_status_distributor(){
        $id = $this->input->post('id');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->distributors->update_distributor_status($id,$data);
    }
}
/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
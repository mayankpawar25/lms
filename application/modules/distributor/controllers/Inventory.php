<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends MY_Controller {

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
        // load Breadcrumbs
        $this->load->library('breadcrumbs');
        //$this->load->model('inventory');

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 2){
            redirect(base_url('distributor/auth/logout'));
        }
    }


	function all_inventory() {
		$this->breadcrumbs->push('Home', 'distributor');
        $this->breadcrumbs->push('View Inventory ', 'section/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
		$this->load->model('inventorys');
        $data['all_inventory'] = $this->inventorys->get_all_inventory();
		$this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allinventory',$data);
    }

   /* public function add_newsubdistributor(){
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

    public function edit_partner($id=''){
    if (isset($_POST) && ! empty($_POST)) {
        $data['zone_name'] = $this->input->post('zone_name');
        $data['zone_area'] = $this->input->post('zone_area');
            if($this->subdistributor->update_zone($id,$data)){
                //$this->session->set_flashdata('success','updated successfully');
                redirect('distributor/partner/all_partner');
            }
    }else{
             
            $data['zone_detail'] = $this->subdistributor->get_subdistributor_by_id($id);
            $this->load->view('edit_zone' ,$data);
        }
    }


    public function delete_partner(){
       $id = $this->input->post('id');
        $result = $this->partners->delete_partner($id);
        redirect('distributor/partner/all_partner');
    }

    public function update_status(){

        $id = $this->input->post('id');
        //$status = $this->input->post('status');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->partners->update_partner_status($id,$data);
    }*/
}

/* End of file Partner.php */
/* Location: ./application/modules/distributor/controllers/Partner.php */

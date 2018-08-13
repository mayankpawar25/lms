<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends MY_Controller {

	function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('admin/auth'));
        }
        //$this->output->section('headerd','welcome/headerd');
        $this->output->section('header','admin/header');
        $this->output->section('sidebar','admin/sidebar');
        $this->output->section('footer','admin/footer');
        $this->output->set_title('Super Admin');
        $this->output->set_template('admin');
        $this->load->model('partners');
        $this->load->model('distributors');
        $this->load->model('subdistributors');
        $this->load->model('zones');


        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
        }
    }


	function all_partners() {
		
        $data['partners'] = $this->partners->get_all_partners();
		$this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allpartners',$data);
    }

    public function add_newpartner(){
    $this->load->view('add_partner');    
    }

    
    public function add_partner(){

     if(isset($_POST)){   
      $data=array(
        'zone_name'=>$this->input->post('zone_name'),
        'zone_area'=>$this->input->post('zone_area'),
        
      ) ; 

      if($this->partners->add_new_partner($data)){

      $this->session->set_flashdata('success','Zone successfully added.');
        }else{

        $this->session->set_flashdata('error','Failed to add new zone.!');
        
       redirect('admin/partner/add_partner'); 
        }

    }

    $this->load->view('add_partner');

    }

    public function edit_partner($id=''){
    if (isset($_POST) && ! empty($_POST)) {
        $data['zone_name'] = $this->input->post('zone_name');
        $data['zone_area'] = $this->input->post('zone_area');
            if($this->partners->update_partner($id,$data)){
                
                redirect('admin/partner/allpartners');
            }
    }else{
             
            $data['zone_detail'] = $this->partners->get_partner_by_id($id);
            $this->load->view('edit_partner' ,$data);
        }
    }


    public function delete_partner(){
       $id = $this->input->post('id');
        $result = $this->partners->delete_partner($id);
        redirect('admin/partner/allpartners');
    }

    public function update_status(){

        $id = $this->input->post('id');
        
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->partners->update_partner_status($id,$data);
    }
}

/* End of file Partner.php */
/* Location: ./application/modules/distributor/controllers/Partner.php */

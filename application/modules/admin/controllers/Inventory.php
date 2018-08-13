<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends MY_Controller {

	function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('distributor/auth'));
        }
        //$this->output->section('headerd','welcome/headerd');
        $this->output->section('header','admin/header');
        $this->output->section('sidebar','admin/sidebar');
        $this->output->section('footer','admin/footer');
        $this->output->set_title('Admin');
        $this->output->set_template('admin');
        // load Breadcrumbs
        $this->load->library('breadcrumbs');
        $this->load->model('inventorys');
        $this->load->helper(array('form', 'url'));

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('distributor/auth/logout'));
        }
    }


	function all_inventory() {
		$this->breadcrumbs->push('Home', 'distributor');
        $this->breadcrumbs->push('View Inventory ', 'section/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
		//$this->load->model('inventorys');
        $data['all_inventory'] = $this->inventorys->get_all_inventory();
		$this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('allinventory',$data);
    }
    public function show_inventory_form(){
        //$data['form'] =$this->session->userdata('logged_in');
        $this->breadcrumbs->push('Home', 'distributor');
        $this->breadcrumbs->push('Add Inventory ', 'section/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //$this->load->model('inventorys');
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('add_inventory',$data);
    }
    public function add_inventory(){
        $this->breadcrumbs->push('Home', 'distributor');
        $this->breadcrumbs->push('Add Inventory ', 'section/page');
        $this->breadcrumbs->unshift('', '');
        $data['breadcrumb'] = $this->breadcrumbs->show();

         if($this->input->post('submit')){ 
                //Check whether user upload picture
                if(!empty($_FILES['product_image']['name'])){
                    $config['upload_path'] = 'uploads/products/images/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $new_name = time().$_FILES['product_image']['name'];
                    $config['file_name'] = $new_name;
                
                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('product_image')){
                        $uploadData = $this->upload->data();
                        $picture = $config['upload_path'].$uploadData['file_name'];
                    }else{
                        $picture = '';
                    }
                }else{
                    $picture = '';
                }
                  $data=array(
                    'product_name'=>$this->input->post('product_name'),
                    'product_description'=>$this->input->post('product_description'),
                    'product_price'=>$this->input->post('product_price'),
                    'stock_quantity'=>$this->input->post('stock_quantity'),
                    'product_image'=>$picture
                   ); 
                 
           if($this->inventorys->add_inventory($data)){
                 $data['all_inventory'] = $this->inventorys->get_all_inventory();
                $this->session->set_flashdata('success','Inventory successfully added.');
            }else{
                $this->session->set_flashdata('error','Failed to add new Inventory.!');
                redirect('admin/inventory/add_inventory',$data); 
            }
        }

            $this->load->view('add_inventory',$data);

    }

       
   

    public function edit_inventory($id=''){
    if (isset($_POST) && ! empty($_POST)) {
        $data['zone_name'] = $this->input->post('zone_name');
        $data['zone_area'] = $this->input->post('zone_area');
            if($this->inventorys->update_inventory($id,$data)){
                //$this->session->set_flashdata('success','updated successfully');
                redirect('admin/inventory/all_inventory');
            }
    }else{
             
            $data['zone_detail'] = $this->inventorys->get_inventory_by_id($id);
            $this->load->view('edit_zone' ,$data);
        }
    }


    public function delete_inventory(){
       $id = $this->input->post('id');
        $result = $this->inventorys->delete_inventory($id);
        redirect('admin/inventory/all_inventory');
    }

    public function update_status(){

        $id = $this->input->post('id');
        //$status = $this->input->post('status');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->inventorys->update_inventory_status($id,$data);
    }
}

/* End of file Partner.php */
/* Location: ./application/modules/distributor/controllers/Partner.php */

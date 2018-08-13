<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Subdistributor extends MY_Controller {

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
        $this->load->model('subdistributors');

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
        }


    }

   
    /* Show all the subdistributors */
    
    function all_subdistributors() { 

    $data['subdistributors']=$this->subdistributors->get_all_subdistributors();  

    $this->output->append_title('Users');
    $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
    $this->output->css('assets/themes/admin/costom-style.css'); 
    $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
    $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');

    $this->load->view('allsubdistributors',$data);
    }

    /* Admin profile */
   
    function profile(){
        $this->load->model('admin');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['admin'] = $this->user->get_admin($username);
       print_r($data);

    }

     /* Load add view subdistributors */
    public function add_newsubdistributor(){
    $this->load->view('add_subdistributor');    
    }
    

   

     /* add subdistributors*/
    public function add_subdistributor(){

     if(isset($_POST)){   
      $data=array(
        'zone_name'=>$this->input->post('zone_name'),
        'zone_area'=>$this->input->post('zone_area'),
        
      ) ; 

      if($this->subdistributors->add_new_subdistributor($data)){

      $this->session->set_flashdata('success','Zone successfully added.');
        }else{

        $this->session->set_flashdata('error','Failed to add new zone.!');
        
       redirect('admin/add_subdistributor'); 
        }

    }

    $this->load->view('add_subdistributor');

    }


     /*edit subdistributors*/

    public function edit_subdistributor($id=''){
    if (isset($_POST) && ! empty($_POST)) {
        $data['zone_name'] = $this->input->post('zone_name');
        $data['zone_area'] = $this->input->post('zone_area');
            if($this->subdistributors->update_subdistributor_status($id,$data)){
                //$this->session->set_flashdata('success','updated successfully');
                redirect('admin/allsubdistributors');
            }
    }else{
             
            $data['distributor_detail'] = $this->subdistributors->get_subdistributor_by_id($id);
            $this->load->view('edit_subdistributor' ,$data);
        }
    }

   
     /*delete subdistributors*/
    public function delete_subdistributor(){
        $id = $this->input->post('id');
        $result = $this->subdistributors->delete_subdistributor($id);
        redirect('admin/allsubdistributors');
    }

    

     /*update subdistributors status*/
    public function update_status_subdistributor(){
        $id = $this->input->post('id');
        $data=array(
            'status'=>$this->input->post('status')
        );
        $this->subdistributors->update_subdistributor_status($id,$data);
    }



}





/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
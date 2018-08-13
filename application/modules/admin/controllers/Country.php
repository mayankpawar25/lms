<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Country extends MY_Controller {

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
        $this->load->model('country');

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
        }


    }

   
    /* Show all the subdistributors */
    
    function all_countries() { 
    $data['countries']=$this->country->get_all_countries();  
    $this->load->view('add_distributor',$data);
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
    


}





/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
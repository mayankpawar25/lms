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
            redirect(base_url('subdistributor/auth'));
        }
        $this->output->section('header','subdistributor/header');
        $this->output->section('sidebar','subdistributor/sidebar');
        $this->output->section('footer','subdistributor/footer');
        $this->output->set_title('Sub - Distributor');
        $this->output->set_template('subdistributor');

        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 3){
            redirect(base_url('subdistributor/auth/logout'));
        }



    }

    function index() {
    	$this->load->model('subdistributor');
    	//$data['users'] = $this->user->get_users();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/subdistributor/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/subdistributor/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/subdistributor/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('home');
    }

    function profile(){
        $this->load->model('subdistributor');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['subdistributor'] = $this->user->get_subdistributor($username);
       print_r($data);

    }

}

/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */
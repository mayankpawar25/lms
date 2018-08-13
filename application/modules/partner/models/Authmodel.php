<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 *
 * @extends CI_Model
 */
class Authmodel extends CI_Model {

    private $table = 'users';
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
    }

    public function get_users(){
        $users[] = array(
            'name'  =>  'test 1',
            'email' =>  'test1@gmail.com'
        );
        $users[] = array(
            'name'  =>  'test 2',
            'email' =>  'test2@gmail.com'
        );
        return $users;
    }

    public function image_upload(){
        $config['upload_path']          = './uploads/profile_pictures/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        $config['file_name']            = time();
        if(!is_writable($config['upload_path'])){
            chmod($config['upload_path'], 777);
        }

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image')){
            $ret['status'] = false;
            $ret['error'] = $this->upload->display_errors();
        }
        else{
            $data =  $this->upload->data();
            $ret['status'] = true;
            $ret['file_name'] = $data['file_name'];
        }
        return $ret;
    }


    //Backend Validation
    public function verify_validation(){

        $action =  $this->router->method;
        if ($action == 'index'){
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }

    /*Partner login check*/
    public function check_login($username,$password){
        //die('fng');
        $data['username'] = $username;
        $data['user_role'] = 4;
        $query = $this->db->get_where($this->table,$data);
        $userData = $query->row();
        if ($userData){
            if ($password==$userData->password && $userData->status == 1 && $userData->approval == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    /*Store Partner login info*/
    public function store_login_info($username){
        $ip = $this->input->ip_address();
        $time = date("Y-m-d H:i:s");
        $data['last_login_ip'] = $ip;
        $data['last_login_time'] = $time;
        $this->db->where('username', $username);
        $this->db->update($this->table, $data);
    }

    public function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function get_admin_email(){
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('user_role',1);

        $query = $this->db->get();
        $result = $query->row();
        
        if ($result){
            return $result;
        }
        return false;

    }

     public function get_rsm_mail(){
            $this->db->select('*');
            //$this->db->select('partner_info.*,states.name as states_name');
            $this->db->from('rsm_details');
            //$this->db->where('states',$id);
            $this->db->join('states','states.id=rsm_details.states');
            $query=$this->db->get();
           
            return $query->result_array();
       }

        public function get_rsm_mail_byid($id){


            $this->db->select('email');
            //$this->db->select('partner_info.*,states.name as states_name');
            $this->db->from('rsm_details');
            $this->db->like('states',$id);
            //$this->db->join('states','states.id=rsm_details.states');
            $query=$this->db->get();

            /*echo $this->db->last_query();
            die();*/
            return $query->result_array();
       }

     

}
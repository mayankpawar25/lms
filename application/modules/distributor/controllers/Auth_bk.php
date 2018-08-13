<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author Sunil
 *
 */
class Auth extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->output->set_template('login');
        $this->output->set_title('Distributor');

    }

    function index() {
        if ($this->session->userdata('logged_in')){
            redirect(base_url('distributor'));
        }
        $this->load->model('distributor');
        $this->load->model('authmodel');
        $this->load->library('user_agent');
        if ($this->agent->referrer()){
            $data['referrer'] = base64_encode($this->agent->referrer());
        }

        $error = '';
        if ($this->input->method(TRUE) === 'POST'){
            if ($this->authmodel->verify_validation()){
                $username = $this->input->post('username',true);
                $password = $this->input->post('password');
                if ($this->authmodel->check_login($username,$password)){
                    $user_data = $this->distributor->get_distributor($username);
                    //print_r($user_data);die('dfgj');
                    if ($user_data != false) {
                        $this->session->set_userdata('logged_in', $user_data);
                        $this->session->set_flashdata('success', 'You have successfully logged in.');
                        //Store Login Info
                        $this->authmodel->store_login_info($username);
                        //Redirect
                        $ref_url = base64_decode($this->input->post('referrer'));
                        if ($ref_url){
                            redirect($ref_url);
                        }else{
                            redirect(base_url('distributor'));
                        }

                    }else{
                        $error = 'Error';
                    }
                }else{
                    $error = 'Invalid Username or Password';
                }
            }else{
                $error = validation_errors();
            }
        }
        $data['error'] = $error;

        $this->load->view('login',$data);
    }





    public function logout(){
        $sess_array = array(
            'id' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->set_flashdata('success', 'Successfully Logout');
        redirect(base_url('distributor/auth'));
    }

    public function register(){
        echo "string";
    }
   /*function ForgotPassword() {
       // echo "string";
        $error = '';
       $this->load->library('form_validation');
       $this->form_validation->set_rules('useremail', 'Email', 'trim|required|xss_clean');
       //$this->form_validation->set_rules('user[]', 'User Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('forgotpassword');
        } else {
            $email = $this->input->post('username');
            //$usertype = $this->input->post('user[]');
            $result = $this->user_model->forgotPassword($usertype[0], $email);
            if ($result && $result->email != "") {
                $verification_code = $this->enc_lib->encrypt(uniqid(mt_rand()));
                $update_record = array('id' => $result->user_tbl_id, 'verification_code' => $verification_code);
                $this->user_model->updateVerCode($update_record);
                if ($usertype[0] == "student") {
                    $name = $result->firstname . " " . $result->lastname;
                } else {
                    $name = $result->name;
                }
                $resetPassLink = site_url('user/resetpassword') . '/' . $usertype[0] . "/" . $verification_code;
                $body = $this->forgotPasswordBody($name, $resetPassLink);
                $body_array = json_decode($body);
                if (!empty($this->mail_config)) {
                    $result = $this->mailer->send_mail($result->email, $body_array->subject, $body_array->body);
                }
                $this->session->set_flashdata('message', "Please check your email to recover your password");
                redirect('site/userlogin', 'refresh');
            } else {
                $data = array(
                    'error_message' => 'Invalid Email or User Type'
                );
            }
            $this->load->view('ufpassword', $data);
        }

    }*/

}

/* End of file AuthModel_model.php */
/* Location: ./application/modules/users/controllers/AuthModel_model.php */
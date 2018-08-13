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
        $this->load->model('distributor');
        $this->load->model('authmodel');

    }

    function index() {
        if ($this->session->userdata('logged_in')){
            redirect(base_url('distributor'));
        }
        
        $this->load->library('user_agent');
        if ($this->agent->referrer()){
            $data['referrer'] = base64_encode($this->agent->referrer());
        }

        $error = '';
        if ($this->input->method(TRUE) === 'POST'){
            if ($this->authmodel->verify_validation()){
                $username = $this->input->post('username',true);
                $password = md5($this->input->post('password'));
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


    public function forget_password(){

        if($this->input->post('email')){

        if($this->input->post('email')){
            if($this->input->post('email')!='')
            {
              
            $email = $this->input->post('email');

            // check user email and update token 
            $token = $this->distributor->get_forgot_password($email);
         
            if($token){
               
                $from = 'lms@gmail.com';
                $name = 'LMS';
                $to = $email;

                $subject = "LMS: Forgot Password Verification";
             $message = '<p>Hello </p><br> <br><p>Please <a href="'.base_url('distributor/auth/reset_password/'.$token).'">click here</a> to reset your password </p> <br><br> <p></p>';
               

                $this->load->library('email');
               
                $this->email->from($from, $name); 
                $this->email->to($to);
                $this->email->subject($subject); 
                $this->email->message($message);
                $this->email->set_mailtype("html");      
               
                $mail_res=$this->email->send();
               
                if($mail_res)
                {
                    $this->session->set_flashdata('success_message', 'Forgot password verification link is send. Please check your inbox!');
                    redirect('distributor/auth/forget_password');         
                }
               
            }else{
                $this->session->set_flashdata('error_message', 'No Email Id Found!');
                
                redirect('distributor/auth/forget_password'); 
               
            }
        
            }
            else{
            redirect(base_url(''));
            }
            
            }else{
            redirect(base_url(''));
        }

    }else{
        $this->load->view('forget_password');

       
    }


}


public function reset_password($token){

        if($token){
            $response = $this->distributor->check_token($token);
            if($response){
                $data['token'] = $token;
            }else{
                $this->session->set_flashdata('error_message', 'Invalid Token!');
                redirect(base_url());

            }

            if($this->input->post()){

                $this->form_validation->set_rules("new_password","New Password","required");
                $this->form_validation->set_rules("confirm_password","Confirm Password","required|matches[new_password]");
                if($this->form_validation->run()){
                    // update password
                    $dt['password'] = md5($this->input->post('new_password'));
                    $dt['reset_pass_token'] = '';
                    $dt['modified'] = date("Y-m-d H:i:s");
                    $where['reset_pass_token'] = $token;
                    $update = $this->distributor->change_userdata($dt, $where);


                    if($update){
                    $this->session->set_flashdata('success_msg', 'Password updated! Please login...');
                    redirect(base_url('distributor/auth/reset_password'));
                    }
                }
            }
            $this->load->view('reset_password',$data);
        }else{
            $this->session->set_flashdata('error_msg', 'Invalid Token!');
            redirect(base_url('distributor/auth/reset_password'));
            
        }
        
    }




    public function logout(){
        $sess_array = array(
            'id' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->set_flashdata('success', 'Successfully Logout');
        redirect(base_url('distributor/auth'));
    }

     public function register()
    {
       
        echo "string";
    }

}

/* End of file AuthModel_model.php */
/* Location: ./application/modules/users/controllers/AuthModel_model.php */
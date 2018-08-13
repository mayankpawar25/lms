    <?php
    (defined('BASEPATH')) OR exit('No direct script access allowed');
    /**
    * Description of users
    *
    * @author Uji Baba
    *
    */
    class Distributor extends MY_Controller {
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
        $this->load->model('distributors');
        $this->load->model('countries');
        $this->load->model('states');
        $this->load->model('cities');
        $this->load->model('admin');
        $this->load->library('form_validation');
        /*jQuery Validation*/
        $this->output->js('assets/themes/admin/additional-methods.min.js');
        $this->output->js('assets/themes/admin/jquery.validate.min.js');
        /* Check user types */
        $loggedin_data = $this->session->userdata('logged_in');
        if($loggedin_data->user_role != 1){
            redirect(base_url('admin/auth/logout'));
        }
    }
    function index() {
        //$this->load->model('admin');
        //$data['users'] = $this->user->get_users();
        $this->output->append_title('Users');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('home');
    }
    /* Show all the distributors */
    function all_distributors() {
        $data['distributors'] = $this->distributors->get_all_distributors();
        $this->output->append_title('Users');
    $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
    $this->output->css('assets/themes/admin/costom-style.css'); 
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('alldistributor',$data);
    }
    /* Admin profile */
    function profile(){
        $this->load->model('admin');
        $this->output->append_title('My Profile');
        $username = $this->session->userdata('logged_in')->username;
        $data['admin'] = $this->user->get_admin($username);
       print_r($data);
    }
    
    /* add distributor*/
    // public function add_distributor(){
    //     $data['countries']=$this->countries->get_all_countries();
    //     $data['states']=$this->states->get_all_states();
    //     $data['cities']=$this->cities->get_all_cities();
    //     $data['all_admins']=$this->admin->get_all_admins();
       
    //     $this->form_validation->set_rules('catagory','Select','required');
    //     $this->form_validation->set_rules('first_name','First Name','required|alpha');
    //     $this->form_validation->set_rules('last_name','Last Name','required|alpha');
    //     //$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
    //     //$this->form_validation->set_rules('phone','Phone','required|max_length[10]|numeric');
    //     $this->form_validation->set_rules('status','Status','required');
    //     $this->form_validation->set_rules('address','Address','required');
    //     $this->form_validation->set_rules('assigned','Assigned','required');
    //     //$this->form_validation->set_rules('file_add','Profile Picture','required');
    //     $this->form_validation->set_rules('city','City','required');
    //     $this->form_validation->set_rules('state','State','required');
    //     $this->form_validation->set_rules('country','Country','required');
    //     $this->form_validation->set_rules('website','Website','required');
    //     $this->form_validation->set_rules('source','Source','required');
    //     $this->form_validation->set_rules('username','Username','required');
    //     $this->form_validation->set_rules('password','Password','required');
    //     $this->form_validation->set_rules('firm_name','Firm Name','required|alpha');
    //     $this->form_validation->set_rules('registration','Registration No','required');
    //     $this->form_validation->set_rules('firm_address','Firm Address','required');
    //     $this->form_validation->set_rules('firm_city','Firm City','required');
    //     $this->form_validation->set_rules('firm_state','Firm State','required');
    //     $this->form_validation->set_rules('firm_country','Firm Country','required');
    //    if($this->form_validation->run() == true){ 
    //         if(isset($_POST)){  
    //             if(!empty($_FILES['profile_pic']['name'])){
    //                 $config['upload_path'] = 'uploads/distributors/images/';
    //                 $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //                 $new_name = time().$_FILES['profile_pic']['name'];
    //                 $config['file_name'] = $new_name;
    //                 //Load upload library and initialize configuration
    //                 $this->load->library('upload',$config);
    //                 $this->upload->initialize($config);
    //                     if($this->upload->do_upload('profile_pic')){
    //                         $uploadData = $this->upload->data();
    //                         $picture = $config['upload_path'].$uploadData['file_name'];
    //                     }else{
    //                         $picture = '';
    //                     }
    //             }else{
    //                 $picture = '';
    //             }
    //                $email  = $this->input->post('email');
    //                $phone = $this->input->post('phone');
    //                 if(count($email)<1){
    //                     echo    $emails = $this->input->post('email');
    //                 }else{
    //                     echo  $emails = implode(",", $email);
    //                 }                
    //                 if(count($phone)<1){
    //                  echo    $phones = $this->input->post('phone');
    //                 }else{
    //                  echo    $phones = implode(",", $phone);
    //                 }
    //                 $data=array(
    //                 'name'=>$this->input->post('catagory'),
    //                 'first_name'=>$this->input->post('first_name'),
    //                 'last_name'=>$this->input->post('last_name'),
    //                 //'account_number'=>$this->input->post('account_number'),
    //                 'status'=>$this->input->post('status'),
    //                 'email'=>$emails,
    //                 'phone'=>$phones,
    //                 'address'=>$this->input->post('address'),
    //                 'city'=>$this->input->post('city'),
    //                 'state'=>$this->input->post('state'),
    //                 'country'=>$this->input->post('country'),
    //                 'website'=>$this->input->post('website'),
    //                 'assigned_to'=>$this->input->post('assigned'),
    //                 'profile_pic'=>$this->input->post('file_add'),
    //                 'source'=>$this->input->post('source'),
    //                 'firm_name'=>$this->input->post('firm_name'),
    //                 'registration'=>$this->input->post('registration'),
    //                 'firm_address'=>$this->input->post('firm_address'),
    //                 'firm_city'=>$this->input->post('firm_city'),
    //                 'firm_state'=>$this->input->post('firm_state'),
    //                 'firm_country'=>$this->input->post('firm_country'),
    //                 'username'=>$this->input->post('username'),
    //                 'password'=>$this->input->post('password'),
    //                 'created' =>date("Y-m-d H:i:s"),  
    //                 'profile_pic'=>$picture
    //               ) ;
    //             if($this->distributors->add_new_distributor($data)){
    //                     $this->session->set_flashdata('success','Distributor successfully added.');
    //             }else{
    //                    $this->session->set_flashdata('error','Failed to add new Distributor.!');
    //                    redirect('admin/distributor/add_distributor'); 
    //             }
    //     }else{
    //         $this->form_validation->set_message('catagory', 'catagory is must');
    //         $this->form_validation->set_message('first_name', 'first  is must');
    //         $this->form_validation->set_message('last_name', 'last name  is must');
    //         $this->form_validation->set_message('email', 'email is must');
    //         $this->form_validation->set_message('phone', 'phone is must');
    //     }
    //   }
    //    $this->load->view('add_distributor',$data);
    // }
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
    /*delete distributor*/
    public function delete_distributor(){
        $id = $this->input->post('id');
        $result = $this->distributors->delete_distributor($id);
        redirect('admin/alldistributors');
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
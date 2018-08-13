<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Bdm extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Leadmodel');
        $this->load->model('Bdmmodel');
        $this->load->model('Partnermodel');
    }

    public function index_get($contact, $id=NULL)
    {   
        /* Get partner id by contact number and its active or not... */
        $parnter_det = $this->Partnermodel->get_id_by_contact_number($contact);
        
        if(isset($parnter_det['id'])){
            
            $partner_id = (int) $parnter_det['id'];

            // If the id parameter doesn't exist return all the users
            $user = array();
            $auser = array();
            if ($id === NULL)
            {
                 // Leads from a data store e.g. database
                $bdms = $this->Bdmmodel->get_all_bdm();  

            }else{
                
                $bdms = $this->Bdmmodel->get_all_bdm($id);
           
            }

            if($bdms){
                // Set the response and exit
                $this->response($bdms, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

            }else{

                $this->response([
                    'status' => FALSE,
                    'message' => 'No BDM Found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code    
            
            }

        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Permission to access this URL / Account is Inactive'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        
    }

}

?>
<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Test extends CI_Model
	{
		 public function __construct() {
        parent::__construct();
//die("kjsadhvgi");
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }
		public function user()
		{
			echo "This is model";
		}
	}
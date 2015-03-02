<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************************************************************************

	Visitor
	방문객 정보를 남긴다.

**************************************************************************************************/
class Visitor {
	/********************************
		선언
	********************************/
		var $ci;

	/********************************
		생성자
	********************************/
		public function __construct()
		{
			$this->ci =& get_instance();
			//$this->ci->load->library('session');
			//$this->ci->load->helper('n');
			//$this->ci->load->model('memberm');
		}
	/********************************
		작성
	********************************/
		public function write()
		{
			$server = print_r($this->ci->input->ip_address(), true);

			log_message('error', $server);


		}
}

/* End of file */
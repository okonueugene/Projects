<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('instamojo');
		$this->load->helper('url');
	}

	// public function get_data()
	// {
	// 	$result=$this->db->get('rounds')->result();
	// 	print_r($result);
	// 	exit();
	// }


	public function index()
	{
	    
	     $this->load->library('session');
	    $name = $this->session->userdata();
	    
		$pay = $this->instamojo->pay_request( 

						$amount =  $this->session->userdata('amount'), 
						$purpose = "TEST" , 
						$buyer_name =$this->session->userdata('name') , 
						$email = "dummy@gmail.com" , 
						$phone = $this->session->userdata('mobile') ,
		     			$send_email = 'FALSE' , 
		     			$send_sms = 'TRUE' , 
		     			$repeated = 'FALSE'

		     		);

		$redirect_url = $pay['longurl']   ;


		redirect($redirect_url,'refresh') ;

	}

	public function get_all()
	{
		$result = $this->instamojo->all_payment_request();

		print_r($result);
	}


	public function pay_request()
	{
	     
		
		$pay = $this->instamojo->pay_request( 

						$amount = "200" , 
						$purpose = "TEST" , 
						$buyer_name = "yudhi" , 
						$email = "demo@g.com" , 
						$phone = "7588255657" ,
		     			$send_email = 'TRUE' , 
		     			$send_sms = 'TRUE' , 
		     			$repeated = 'FALSE'

		     		);


		$payment_id = $pay['id'];  // <= Payment Id
							      // print_r($pay) ; <=  Prints all the data from the request
							      
							     
							      

	}


	public function status()
	{
		$requestId  = '547908df8a814b268fb2b0eebe4fb9b4'  ; // $reqid generated using pay_request()
		$status     = $this->instamojo->status($requestId);

		echo json_encode($status);
	}


	public function payment_status()
	{
		$requestId = '547908df8a814b268fb2b0eebe4fb9b4'  ;
		$status    = $this->instamojo->status($requestId);

		print_r($status) ;
	}


	public function show()
	{
		$data['request_id'] = '84c04c212ccb4a8ba8c87e35ec4a2511' ;
		$this->load->view('instamojo' ,$data);
	}

}

/* End of file example.php */
/* Location: ./application/controllers/example.php */
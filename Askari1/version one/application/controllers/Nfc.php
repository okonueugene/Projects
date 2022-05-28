<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Aug 2018 05:00:00 GMT"); // Date in the past
header("Cache-Control: max-age=2592000, must-revalidate");
header("Cache-Control: public, max-age=2592000");
header("Content-Type: application/json");

class Nfc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
        // $this->load->model('product_model');

        //date_default_timezone_set('Asia/Kolkata');
        date_default_timezone_set('Europe/London');
        error_reporting(0);

        //checking key
        $key = $this->input->get_request_header('apikey', TRUE);
        if ($key == 'd29985af97d29a80e40cd81016d939af') {
            $x = "0";
        } else {
            $x = "1";
        }



        if ($x == "1") {
            $obj['status'] = "0";
            $obj['message'] = "invalid api key ";
            echo json_encode($obj);
            exit();
        }
    }

    function nfc_config(){
        $guard_id = ($_POST['guard_id']);
        $nfccode = ($_POST['nfccode']);
        $lati = ($_POST['lati']);
        $longi = ($_POST['longi']);
        $pointname = ($_POST['pointname']);
        $location = ($_POST['location']);
       
       
        
        if ($guard_id != null){
            $din = array('personel' => $guard_id, 'nfc' => $nfccode,'longi' => $longi,'lat' => $lati,'pointname' => $pointname,'location' => $location);
            $this->db->insert('nfc', $din);
            $din = null;
            
            $d['status'] = '200';
            $d['msg'] = 'success';
            
            echo json_encode($d);
            exit;
        }
        $d['status'] = '500';
        $d['msg'] = 'nfc tag has not been submitted';
        echo json_encode($d);
    }

}
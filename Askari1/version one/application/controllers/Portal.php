<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Aug 2018 05:00:00 GMT"); // Date in the past
header("Cache-Control: max-age=2592000, must-revalidate");
header("Cache-Control: public, max-age=2592000");
header("Content-Type: application/json");

class Portal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
        // $this->load->model('product_model');

        //date_default_timezone_set('Asia/Kolkata');
        date_default_timezone_set('Africa/Nairobi');
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
    
    function devices(){
         $d['data']= $this->db->query('select * from devicesinfo ')->result();
        echo json_encode($d);
    }
    
   function guards(){
        $d['data']= $this->db->query('select * from guards ')->result();
        echo json_encode($d);
    }
    
    function rounds(){
         $d['data']= $this->db->query('select * from rounds ')->result();
         
        echo json_encode($d);
    }
    
    function checkpoints(){
         $d['data']= $this->db->query('select * from locations ')->result();
        echo json_encode($d);
    }
    
    function history(){
         $d['data']= $this->db->query('select * from history ')->result();
        echo json_encode($d);
    }
    
    function attendance(){
        $d['data']= $this->db->query('select * from attendance ')->result();
        echo json_encode($d);
    }
    function policy(){
         $d['data']= $this->db->query('select * from policy ')->result();
        echo json_encode($d);
    }
    function totalpatrols(){
        $q = $this->db->query('SELECT * from  history GROUP BY created_at')->result();
        $d=Count($q);
        echo json_encode($d);
    }
    function totalguards(){
        $q = $this->db->query('SELECT * from  history GROUP BY created_at')->result();
        $d=Count($q);
        echo json_encode($d);
    }
    function roundsdash(){
    $query = "select * from rounds";
    $this->load->model('Common_model');
    $dx = $this->Common_model->get($query);
    $data["data"]  = $dx;
    echo json_encode ($data);
    
    }
    
    function guardname(){
    $id=$_GET['guard_id'];
       $q = $this->db->query("select * from guards  where id = ' $id '")->result();
        echo json_encode($q);
    }
    function guardpic(){
    $id=$_GET['guard_id'];
       $q['data'] = $this->db->query("select profilepic,name from guards  where id = ' $id '")->result();
        echo json_encode($q);
    }
    
    function guardspresent(){
        $today = date('Y-m-d') ;
        $q['data'] = $this->db->query("select * from attendance where created_at = '$today' ORDER BY id DESC")->result();
        // $d = Count($q);
        echo json_encode($q);
    }
    
    function patrollist(){
        
      
         $q = $this->db->query("SELECT * FROM history Group By created_at ")->result();
            foreach($q as $row){
                $guardid = $row->guard_id;
                $d = $row->round_name;
                $point = $row->loc_name;
                $status = $row->status;
                $scanat = $row->time;
                $location = $row->location;
                $date = $row->created_at;
                $pl['date']= $date;
                $scanattt == null;
                                                        
                $b =$this->db->query("SELECT * FROM guards WHERE id ='$guardid'")->result();
                                                        
                foreach($b as $row1){
                    $guardname = $row1->name;
                    $start=$row1->start;
                    $end= $row1->end;
                
                    $s =$this->db->query("SELECT * from history WHERE created_at='$date' GROUP BY round_name ORDER BY created_at desc")->result();
                    $total_rounds=Count($s);
                    $pl['total_rounds']=$total_rounds;
         
                    $w =$this->db->query("SELECT * from  history where time IS NULL AND created_at='$date'")->result();
                    $totalmissed = Count($w);
                    $pl['totalmissed']=$totalmissed;
    
                    
                    $e =$this->db->query("SELECT * from  history where time IS NOT NULL AND created_at='$date'")->result();
                    $totalchecked =Count($e);
                    $pl['totalchecked']=$totalchecked;
                    
                }
              
            }
            echo json_encode($pl);
    }
    
    function database(){
       $q = $this->db->database;
       echo json_encode($q);
    }
    function hostname(){
      $q = $this->db->hostname;
       echo json_encode($q);
    }
    function username(){
      $q = $this->db->username;
       echo json_encode($q);
    }
    function password(){
      $q = $this->db->password;
       echo json_encode($q);
    }
    function daystotalmissedpoints(){
        $today = date('Y-m-d') ;
        $q = $this->db->query("select * from  history where time IS NULL AND created_at = '$today'")->result();
        $d = Count($q);
        echo json_encode($d);
        
    }
   public function daystotalscannedpoints(){
        $today = date('Y-m-d') ;
        $q = $this->db->query("select * from  history where time IS NOT NULL AND created_at = '$today'")->result();
        $d = Count($q);
        echo json_encode($d);
       
        
    }
    function daystotalmissedpointsperguard(){
        $id=$_GET['guard_id']; 
        $today = date('Y-m-d') ;
        $q = $this->db->query("select * from  history where time IS NULL AND created_at = '$today' AND guard_id = '$id'")->result();
        $d = Count($q);
        echo json_encode($d);
        
    } 
    function daystotalcheckedpointsperguard(){
        $id=$_GET['guard_id']; 
        $today = date('Y-m-d') ;
        $q = $this->db->query("select * from  history where time IS NOT NULL AND created_at = '$today' AND guard_id = '$id'")->result();
        $d = Count($q);
        echo json_encode($d);
    }
    
    function guardsgraph(){
        $today = date('Y-m-d') ;
        $q['data'] = $this->db->query("select * from history where created_at = '$today' Group by guard_id")->result();
        // $d = Count($q);
        echo json_encode($q);
    }
    function livefeed(){
        $today = date('Y-m-d') ;
        $q['data']= $this->db->query("select * from  history where time IS NOT NULL AND created_at = '$today' ")->result();
        echo json_encode($q);
    }
    
    // STATS WEEK
    function statsweekattendance(){
        
        $date = new DateTime(date('Y-m-d'));
        $week = $date->format("W");
        $year = date("Y");
        $date->setISODate($year,$week,0);
        $dt= $date->format('Y-m-d'); 
        
        $q = $this->db->query("select * from attendance  where created_at >= ' $dt '")->result();
        $d = Count($q);
        echo json_encode($d);


    }
    
    function statsweekpatrol(){
        
        $date = new DateTime(date('Y-m-d'));
        $week = $date->format("W");
        $year = date("Y");
        $date->setISODate($year,$week,0);
        $dt= $date->format('Y-m-d'); 
        
        $q = $this->db->query("select * from history  where created_at >= ' $dt ' ")->result();
         $d = Count($q);
        echo json_encode($d);


    }
    
    // PATROL DASHBOARD
     function guardspresentQ(){
         
        $today = $_GET['qdate'];
        $q['data'] = $this->db->query("select * from attendance where created_at = '$today' ORDER BY id DESC")->result();
        // $d = Count($q);
        echo json_encode($q);
    }
    function daystotalmissedpointsQ(){
       $today = $_GET['qdate'];
        $q = $this->db->query("select * from  history where time IS NULL AND created_at = '$today'")->result();
        $d = Count($q);
        echo json_encode($d);
        
    }
   public function daystotalscannedpointsQ(){
        $today = $_GET['qdate'];
        $q = $this->db->query("select * from  history where time IS NOT NULL AND created_at = '$today'")->result();
        $d = Count($q);
        echo json_encode($d);
       
        
    }
     function guardsgraphQ(){
        $today = $_GET['qdate'];
        $q['data'] = $this->db->query("select * from history where created_at = '$today' Group by guard_id")->result();
        // $d = Count($q);
        echo json_encode($q);
    }
    function livefeedQ(){
        $today = $_GET['qdate'];
        $q['data']= $this->db->query("select * from  history where time IS NOT NULL AND created_at = '$today' ")->result();
        echo json_encode($q);
    }
    
    // STATS MONTHLY
    
    function statsmonthattendance(){
        
        $date = date('Y-m-d');
        $dt= date("Y-m-01", strtotime($date)); 
        
        $q = $this->db->query("select * from attendance  where created_at >= ' $dt '")->result();
        $d = Count($q);
        echo json_encode($d);


    }
    
    function statsmonthpatrol(){
        
         
        $date = date('Y-m-d');
        $dt= date("Y-m-01", strtotime($date)); 
        
        $q = $this->db->query("select * from history  where created_at >= ' $dt ' ")->result();
         $d = Count($q);
        echo json_encode($d);


    }
    
}
<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Aug 2018 05:00:00 GMT"); // Date in the past
header("Cache-Control: max-age=2592000, must-revalidate");
header("Cache-Control: public, max-age=2592000");
header("Content-Type: application/json");

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        // $this->other_db = $this->load->database('haringey', TRUE);
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

    function index()
    {
        // $this->load->view('Horizontal/user_list');
    }


    //guard work starts


    function calculateMissed($guard_id)
    {
        try {
            $rounds = $this->db->where('guard_id', $guard_id)->get('rounds')->result();
            
            
            foreach ($rounds as $r) {
                
                if($r->type =="nfc"){
                        foreach (explode(',', $r->checkpoints) as $chk_id) {
    
                        $check = $this->db
                            ->where('DATE(created_at)', date('Y-m-d'))
                            ->where('guard_id', $guard_id)
                            ->where('round_id', $r->id)
                            ->where('loc_id', $chk_id)
                            ->get('history');
                        if ($check->num_rows() == 0) {
                    
                                $checkpoints = $this->db->where('id', $chk_id)->get('nfc');
                             
                            if ($checkpoints->num_rows() > 0) {
                                $loc = $checkpoints->row();
                                $data = array('guard_id' => $guard_id, 'loc_id' => $loc->id, 'loc_name' => $loc->name, 'created_at' => date('Y-m-d H:i:s'), 'srno' => '1', 'round_id' => $r->id, 'round_name' => $r->round_name, 'location' => $loc->location, 'start' => $r->start, 'end' => $r->end, 'code' => $loc->nfc);
                                $this->db->insert('history', $data);
                            }
                        }
                    }
                }else{
                        foreach (explode(',', $r->checkpoints) as $chk_id) {
    
                        $check = $this->db
                            ->where('DATE(created_at)', date('Y-m-d'))
                            ->where('guard_id', $guard_id)
                            ->where('round_id', $r->id)
                            ->where('loc_id', $chk_id)
                            ->get('history');
                        if ($check->num_rows() == 0) {
                    
                                $checkpoints = $this->db->where('id', $chk_id)->get('locations');
                             
                            if ($checkpoints->num_rows() > 0) {
                                $loc = $checkpoints->row();
                                $data = array('guard_id' => $guard_id, 'loc_id' => $loc->id, 'loc_name' => $loc->name, 'created_at' => date('Y-m-d H:i:s'), 'srno' => '1', 'round_id' => $r->id, 'round_name' => $r->round_name, 'location' => $loc->location, 'start' => $r->start, 'end' => $r->end, 'code' => $loc->code);
                                $this->db->insert('history', $data);
                            }
                        }
                    }
                }
                
            }
        } catch (Exception $e) {
            echo "error";
        }
    }


    function login()
    {
        $mobile = $this->input->post('mobile');
        $pass = md5($this->input->post('password'));
        $code = $this->input->post('code');
        $qx = $this->db->get_where('guards', array('mobile' => $mobile, 'password' => $pass, 'status' => '2'));
        if ($qx->num_rows() > 0) {
            $d['status'] = '400';
            $d['msg'] = 'failed your account has been suspended';
            $d['id'] = "";
            $d['name'] = "";
            $d['agency'] = "";
            $d['mobile'] = "";
            $d['email'] = "";
            $d['guard_id'] = "";
            $d['profilepic']="";

            echo json_encode($d);
            exit;
        }

        $q = $this->db->get_where('guards', array('mobile' => $mobile, 'password' => $pass));
        if ($q->num_rows() == 1) {

            $d['status'] = '200';
            $d['msg'] = 'success';
            $d['id'] = $q->row()->id;
            $d['name'] = $q->row()->name;
            $d['agency'] = $q->row()->agency;
            $d['mobile'] = $q->row()->mobile;
            $d['email'] = $q->row()->email;
            $d['guard_id'] = $q->row()->guard_id;
            $d['profilepic']=$q->row()->profilepic;
            $accesscode = $q->row()->accesscode;
            $today = date('Y-m-d') ;
            $check = $this->db->where('guard_id', $d['id'])->where('date(intime)', date('Y-m-d'))->get('attendance')->num_rows();
            if ($check == 0) {
                $din = array('guard_id' => $d['id'], 'intime' => date('Y-m-d H:i:s'),'created_at' => $today);
                $this->db->insert('attendance', $din);
                $din = null;
            }

            $this->calculateMissed($d['id']);

            $this->db->query("update guards set login_status='1',loggedin_at='" . date('Y-m-d H:i:s') . "' where id=" . $q->row()->id . "");
            
            if($accesscode == $code){
                $d['status'] = '200';
            $d['msg'] = 'success';
            $d['id'] = $q->row()->id;
            $d['name'] = $q->row()->name;
            $d['agency'] = $q->row()->agency;
            $d['mobile'] = $q->row()->mobile;
            $d['email'] = $q->row()->email;
            $d['guard_id'] = $q->row()->guard_id;
            $d['profilepic']=$q->row()->profilepic;
            $accesscode = $q->row()->accesscode;
            
             $this->db->query("update guards set accesscode=''  where id=" . $q->row()->id . "");
            
             //  code to automate generation of BOOK OFF OTP for the next day's login
            function generateRandomStrings($length = 6) {
                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            
            $generateRandomString = generateRandomStrings();
            
            $this->db->where('id', $q->row()->id);
            $din = array('bookoff' =>$generateRandomString);
            $this->db->update('guards', $din);
            $din = null;
            
            }else{
                 $d['status'] = '400';
            $d['msg'] = 'you entered wrong passcode';
            $d['id'] = "";
            $d['name'] = "";
            $d['agency'] = "";
            $d['mobile'] = "";
            $d['email'] = "";
            $d['guard_id'] = "";
            }
        } else {
            $d['status'] = '400';
            $d['msg'] = 'no data found/ Invalid mobile/password';
            $d['id'] = "";
            $d['name'] = "";
            $d['agency'] = "";
            $d['mobile'] = "";
            $d['email'] = "";
            $d['guard_id'] = "";
        }

        echo json_encode($d);
    }



    function sign_out()
    {
        $this->db->query("update guards set login_status=0 where id=" . $_POST['guard_id'] . "");

        $q = $this->db->get_where('attendance', array('guard_id' => $_POST['guard_id'], 'date(intime)' => date('Y-m-d')));
        if ($q->num_rows() == 1) {

            $d['status'] = '200';
            $d['msg'] = 'success';
            $check = $this->db->where('guard_id', $_POST['guard_id'])->where('date(intime)', date('Y-m-d'))->get('attendance')->num_rows();
            if ($check == 1) {
                $this->db->where('guard_id', $_POST['guard_id'])->where('date(intime)', date('Y-m-d'));
                $din = array('outtime' => date('Y-m-d H:i:s'));
                $this->db->update('attendance', $din);
                $din = null;
            }
        }


        $this->calculateMissed($_POST['guard_id']);
        $d['status'] = "200";
        $d['msg'] = "success";
        echo json_encode($d);
    }




    function get_guards()
    {
        $q = $this->db->query("SELECT id,name,agency,mobile,email,guard_id FROM guards WHERE id=" . $_POST['id'] . " AND status='1'");
        if ($q->num_rows() == 1) {
            $d['status'] = '200';
            $d['msg'] = 'success';
            $d['id'] = $q->row()->id;
            $d['name'] = $q->row()->name;
            $d['agency'] = $q->row()->agency;
            $d['mobile'] = $q->row()->mobile;
            $d['email'] = $q->row()->email;
            $d['guard_id'] = $q->row()->guard_id;
        } else {
            $d['status'] = '400';
            $d['msg'] = 'no data found/ Invalid guard id OR Account is supended';
            $d['id'] = "";
            $d['name'] = "";
            $d['agency'] = "";
            $d['mobile'] = "";
            $d['email'] = "";
        }

        echo json_encode($d);
    }



    function get_rounds()
    {
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }
        $q = $this->db->query("SELECT round_name,start,end FROM rounds  WHERE guard_id=" . $_POST['guard_id'] . " ORDER BY id ASC ");
        if ($q->num_rows() > 0) {
            $d['status'] = '200';
            $d['msg'] = 'success';
            foreach ($q->result() as $r) {
                $d['data'][] = array('round_name' => $r->round_name, 'duration' => date('h:i A', strtotime($r->start)) . " - " . date('h:i A', strtotime($r->end)));
            }
        } else {
            $d['status'] = '400';
            $d['msg'] = 'no data found/ Invalid guard id OR Account is supended';
            $d['data'] = "";
        }

        echo json_encode($d);
    }

    function scan_checkpoint()
    {
        if ($_POST['qrcode'] == '0') {
            $d['status'] = '400';
            $d['msg'] = 'Scan Checkpoints !';
            echo json_encode($d);
            exit;
        }
        $guard_id = $_POST['guard_id'];
        $code = $_POST['qrcode'];
        $d['data'] = array();
        $d['recode'] = "";
        $guard = $this->db->where('id', $guard_id)->where('login_status', '0')->get('guards');
        if ($guard->num_rows() > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }
        $guard = $this->db->where('id', $guard_id)->get('guards');
        // getting round id
        $rounds = $this->db->where('guard_id', $guard_id)->get('rounds');
        if ($rounds->num_rows() == 0) {
            $d['status'] = '400';
            $d['msg'] = 'No rounds assigned to you';
            echo json_encode($d);
            exit;
        }

        foreach ($rounds->result() as $r) {


            if (strtotime($r->start) <= strtotime(date('H:i:s')) && strtotime($r->end) > strtotime(date('H:i:s'))) {
                $round_id = $r->id;
                $round_row = $r;
                break;
            }
        }

        if (!isset($round_id)) {
            $d['status'] = '400';
            $d['msg'] = 'you dont have any round in this time period !';
            echo json_encode($d);
            exit;
        }

        // checking code
        
        // add nfc checking
        $checkpoints = $this->db->where('code', $code)->get('locations');
        if ($checkpoints->num_rows() == 0) {
             
             $checkpoints = $this->db->where('nfc', $code)->get('nfc');
             
             if ($checkpoints->num_rows() == 0) {
                     
                    $d['status'] = '400';
                    $d['msg'] = 'Invalid Code !!Code:' . $code;
                    echo json_encode($d);
                    exit;
                }
            
        }

        $checkpoints_array = explode(',', $round_row->checkpoints);
        $checkpoint_id = $checkpoints->row()->id;
        //
        // if(!in_array($checkpoint_id,$checkpoints_array))
        // {
        //         $d['status']='600';
        //         $d['msg']='This checkpoint is  not assigned to this round do you want to submit it ?';
        //         $d['recode']=$code;
        //         echo json_encode($d);
        //         exit;
        // }

        if (!in_array($checkpoint_id, $checkpoints_array)) {
            $d['status'] = '400';
            $d['msg'] = 'This checkpoint is  not assigned to this round !!';
            $d['recode'] = $code;
            echo json_encode($d);
            exit;
        }


        if ($guard_id != $round_row->guard_id) {
            $d['status'] = '400';
            $d['msg'] = 'This Round is  not assigned to you!';
            echo json_encode($d);
            exit;
        }
        // $round_id=$assigned_rounds_parent->row()->round_id;
        // $round_master=$this->db->where('id',$round_id)->get('round_master');
        // if($round_master->num_rows()==0)
        // {
        //         $d['status']='400';
        //         $d['msg']='This Round is  invalid!';
        //         echo json_encode($d);
        //         exit;
        // }
        if (strtotime($round_row->start) <= strtotime(date('H:i:s')) && strtotime($round_row->end) > strtotime(date('H:i:s'))) {
            $loc = $checkpoints->row();
            $check = $this->db
                ->where('DATE(created_at)', date('Y-m-d'))
                ->where('guard_id', $guard_id)
                ->where('round_id', $round_id)
                ->where('loc_id', $loc->id)
                ->get('history');



            if ($check->num_rows() > 0) {
                if (empty($check->row()->time)) {
                    $data = array(
                        'guard_id' => $guard_id,
                        'loc_id' => $loc->id,
                        'loc_name' => $loc->name,
                        'time' => date('Y-m-d H:i:s'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'srno' => '1',
                        'round_id' => $round_id,
                        'round_name' => $round_row->round_name,
                        'location' => $loc->location,
                        'start' => $round_row->start,
                        'end' => $round_row->end,
                        'code' => $code
                    );
                    $updateid = $check->row()->id;
                    $this->db->update('history', $data, "id=$updateid");
                    $d['status'] = '200';
                    $d['history_id'] = $updateid;
                    $d['msg'] = 'Checkpoint scanned successfully';
                } else {
                    $d['status'] = '400';
                    $d['msg'] = 'This checkpoint is  Already Scanned !!';
                }
            } else {
                $data = array(
                    'guard_id' => $guard_id,
                    'loc_id' => $loc->id,
                    'loc_name' => $loc->name,
                    'time' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'srno' => '1',
                    'round_id' => $round_id,
                    'round_name' => $round_row->round_name,
                    'location' => $loc->location,
                    'start' => $round_row->start,
                    'end' => $round_row->end,
                    'code' => $code
                );
                $this->db->insert('history', $data);
                $d['history_id'] = $this->db->insert_id();
                $d['status'] = '200';
                $d['msg'] = 'Checkpoint scanned successfully';
            }


            $this->db->update('rounds', ['updated_at' => date('Y-m-d')], "id=$round_id");
            $d['status'] = '200';
            $d['msg'] = 'Checkpoint scanned successfully';
            $history = $this->db->where('guard_id', $guard_id)->where('date(created_at)', date('Y-m-d'))->where('round_id', $round_id)->get('history')->result();
            foreach ($history as $r) {
                if (!empty($r->time)) {
                    $d['data'][] = array('id' => $r->id, 'name' => $r->loc_name, 'location' => $r->location, 'time' => date('h:i:s A', strtotime($r->time)), 'date' => date('d/m/Y', strtotime($r->created_at)));
                }
            }

            $this->calculateMissed($guard_id);
            echo json_encode($d);
            exit;
        } else {
            $d['status'] = '400';
            $d['msg'] = 'This Round is  out of time!';
            echo json_encode($d);
            exit;
        }
    }
    function scan_checkpoint_old()
    {
        $id = $_POST['guard_id'];
        $qrcode = $_POST['qrcode'];
        $srno = 0;
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }
        $check = $this->db->where('code', $qrcode)->where('guard_id', $id)->where('DATE(created_at)', date('Y-m-d'))->where('start<=', date('H:i:s'))->where('end>', date('H:i:s'))->get('history');

        if ($check->num_rows() > 0) {
            $round_id = $check->row()->round_id;



            $q = $this->db->where('code', $qrcode)->where('DATE(created_at)', date('Y-m-d'))->get('history');
            if ($q->num_rows() == 1) {
                $q = $q->row();

                // getting sr no
                $var = $this->db->where('guard_id', $id)->where('round_id', $round_id)->where('DATE(created_at)', date('Y-m-d'))->get('history');
                //echo json_encode($var->row()); exit;

                // $dx=explode(',', $var->row()->checkpoints);
                // $i=count($dx);
                // $j=0;
                // $srno="0";
                // for(;$i>0;$i--)
                // {$x=$j+1;
                // if($dx[$j]==$q->round_id)
                // {
                //   $srno= $x;
                // }

                //                 $j++;
                // }

                //   print_r($check->result()); exit;
                if ($check->row()->code != $qrcode) {
                    $d['status'] = '200';
                    $d['msg'] = 'Invalid Guard/Invalid Qr Code';
                    $h = $this->db->where('guard_id', $id)->where('round_id', $round_id)->where('time<>', null)->where('date(time)', date('Y-m-d'))->get('history')->result();
                    foreach ($h as $r) {
                        //$l=$this->db->where('id',$r->loc_id)->get('locations')->row();
                        $d['data'][] = array('id' => $id, 'name' => $r->loc_name, 'location' => $r->location, 'time' => date('h:i:s A', strtotime($r->time)), 'date' => date('d/m/Y', strtotime($r->created_at)));
                    }
                    echo json_encode($d);
                    exit;
                }


                //got sr no
                $data = array('time' => date('Y-m-d H:i:s'), 'guard_id' => $id, 'loc_id' => $q->loc_id, 'round_id' => $round_id, 'srno' => $srno);
                $check2 = $this->db->where('guard_id', $id)->where('loc_id', $q->loc_id)->where('round_id', $round_id)->where('date(time)', date('Y-m-d'))->get('history')->num_rows();
                if ($check2 == 1) {

                    $d['status'] = '200';
                    $d['msg'] = 'Already Scanned !!';
                    $date = date('d/m/Y');
                    $h = $this->db->where('guard_id', $id)->where('round_id', $round_id)->where('time<>', null)->where('date(time)', date('Y-m-d'))->order_by('time', 'ASC')->get('history')->result();
                    foreach ($h as $r) {
                        //$l=$this->db->where('id',$r->loc_id)->get('locations')->row();
                        $d['data'][] = array('id' => $id, 'name' => $r->loc_name, 'location' => $r->location, 'time' => date('h:i:s A', strtotime($r->time)), 'date' => date('d/m/Y', strtotime($r->created_at)));
                    }
                    //$d['data']=$this->db->query("select *,'".$date."' as date,DATE_FORMAT(h.time,'%h:%i:%s %p') as time from locations,rounds,history as h where h.guard_id=".$id." AND round_id=".$round_id." AND locations.id=h.loc_id AND DATE(h.time)='".date('Y-m-d')."' ORDER BY h.time ASC")->result();
                    echo json_encode($d);
                    exit;
                }
                $this->db->where('guard_id', $id)->where('loc_id', $q->loc_id)->where('round_id', $round_id)->where('date(created_at)', date('Y-m-d'));
                if ($this->db->update('history', $data)) {
                    $date = date('d/m/Y');
                    $d['status'] = '200';
                    $d['msg'] = 'success';
                    $h = $this->db->where('guard_id', $id)->where('round_id', $round_id)->where('time<>', null)->where('date(time)', date('Y-m-d'))->order_by('time', 'ASC')->get('history')->result();
                    foreach ($h as $r) {
                        // $l=$this->db->where('id',$r->loc_id)->get('locations')->row();
                        $d['data'][] = array('id' => $id, 'name' => $r->loc_name, 'location' => $r->location, 'time' => date('h:i:s A', strtotime($r->time)), 'date' => date('d/m/Y', strtotime($r->created_at)));
                    }
                    // //$d['data']=$this->db->query("select *,'".$date."' as date,DATE_FORMAT(h.time,'%h:%i:%s %p') as time from locations as locations,rounds as rounds,history as h where h.guard_id=".$id." AND round_id=".$round_id." AND locations.id=h.loc_id AND DATE(h.time)='".date('Y-m-d')."' ORDER BY h.time ASC")->result();


                }
            } else {
                //  error_reporting(0);
                $date = date('d/m/Y');
                $d['status'] = '200';
                $h = $this->db->where('guard_id', $id)->where('round_id', $round_id)->where('time<>', null)->where('date(time)', date('Y-m-d'))->order_by('time', 'ASC')->get('history')->result();
                foreach ($h as $r) {
                    // $l=$this->db->where('id',$r->loc_id)->get('locations')->row();
                    $d['data'][] = array('id' => $id, 'name' => $r->loc_name, 'location' => $r->location, 'time' => date('h:i:s A', strtotime($r->time)), 'date' => date('d/m/Y', strtotime($r->created_at)));
                }
                //echo json_encode($d);exit;
                //$array=$this->db->query("select *,'".$date."' as date,DATE_FORMAT(h.time,'%h:%i:%s %p') as time from locations,rounds,history as h where h.guard_id=".$id." AND round_id=".$round_id." AND locations.id=h.loc_id AND DATE(h.time)='".date('Y-m-d')."' ORDER BY h.time ASC")->result_array();
                //$array=array_unique($array);
                //$d['data']=$array;

                if ($qrcode == '0' && !empty($d['data'])) {
                    $d['msg'] = 'Success';
                } else if ($qrcode == '0' && empty($d['data'])) {
                    $d['msg'] = 'no data found !';
                } else {
                    $d['msg'] = 'Invalid QR Code';
                }
            }

            // }
        } else {
            $d['status'] = '400';
            $d['msg'] = 'No data found/ Invalid Round/ Invalid Request';
            $d['data'] = "";
        }

        echo json_encode($d);
    }


    function about_us()
    {
        $this->calculateMissed($_POST['guard_id']);
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }

        $d['status'] = '200';
        $qx = $this->db->get_where('guards', array('id' => $_POST['guard_id']));
        $q = $this->db->query('select * from about_us where id=1')->row();
        $d['title'] = $q->title;
        $d['description'] = $q->description;
        $d['shift'] = date('h:i A', strtotime($qx->row()->start)) . "-" . date('h:i A', strtotime($qx->row()->end));
        $d['end'] = date('h:i a', strtotime($qx->row()->end));

        $intime = $this->db->where('guard_id', $_POST['guard_id'])->where('date(intime)', date('Y-m-d'))->get('attendance')->row()->intime;
        $d['intime'] = date('h:i A', strtotime($intime));

        $d['total_rounds'] = $this->db->where('guard_id', $_POST['guard_id'])->get('rounds')->num_rows();
        $d['completed_rounds'] = $this->db->where('guard_id', $_POST['guard_id'])->where('end<', date('H:i:s'))->get('rounds')->num_rows();
        $d['missed_checkpoints'] = $this->db->where('guard_id', $_POST['guard_id'])->where('time', null)->where('date(created_at)', date('Y-m-d'))->get('history')->num_rows();

        echo json_encode($d);
    }

    function get_attendance()
    {
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }

        $d['status'] = '200';
        $d['data'] = $this->db->query("SELECT *,TIMEDIFF(outtime,intime) as duration,DATE_FORMAT(intime,'%h:%i %p') as intime,DATE_FORMAT(outtime,'%h:%i %p') as outtime,DATE_FORMAT(intime,'%d/%m/%Y') as date FROM attendance WHERE guard_id=" . $_POST['guard_id'] . " ORDER BY id DESC LIMIT 30")->result();

        echo json_encode($d);
    }

    function get_missed()
    
    // get correct point name
    {
        $this->calculateMissed($_POST['guard_id']);
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }

        $data = array();
        $id = $_POST['guard_id'];
        $d['status'] = '200';
        $rounds = $this->db->where('guard_id', $id)->order_by('id', 'asc')->get('rounds')->result();
        $i = 0;
        foreach ($rounds as $r) {
            $i++;
            $round = $r->round_name;
            $type =  $r->type;
            
            if($type == "nfc"){
                $data = array_merge($data, $this->db->query("SELECT *,'" . $round . "' as round FROM nfc as l,history as h WHERE h.round_id=" . $r->id . " AND h.guard_id=" . $id . " AND DATE(h.created_at)='" . date('Y-m-d') . "'  AND h.time IS NULL AND h.loc_id=l.id")->result_array());

            }else{
               $data = array_merge($data, $this->db->query("SELECT *,'" . $round . "' as round FROM locations as l,history as h WHERE h.round_id=" . $r->id . " AND h.guard_id=" . $id . " AND DATE(h.created_at)='" . date('Y-m-d') . "'  AND h.time IS NULL AND h.loc_id=l.id")->result_array());

            }
            
           
            
            //    $data=$this->db->where('guard_id',$id)->where('round_id',$r->id)->where('time',null)->where('created_at',$r->created_at)->get('history')->result();
            $d['data'] = $data;
        }
        if ($d['data']) {

            echo json_encode($d);
        } else {
            $d['status'] = '400';
            $d['data'] = "";
            $d['msg'] = "No data Found";
            echo json_encode($d);
        }
    }

    function r_historyx()
    {
        $id = $_POST['guard_id'];
        $d['status'] = "200";
        $d['msg'] = "success";
        $date = $this->db->query("SELECT date(created_at)as date FROM history where guard_id=" . $id . " GROUP BY date")->result();
        foreach ($date as $r) {
            $roundsx = $this->db->query("SELECT round_id FROM history WHERE date(created_at)='" . $r->date . "' AND guard_id=" . $id . " GROUP BY round_id")->result();
            foreach ($roundsx as $rx) {


                $rounds = $this->db->where('DATE(created_at)', $r->date)->where('round_id', $rx->round_id)->get('history')->result();
                foreach ($rounds as $r2) {
                    $rxx = $this->db->where('id', $r2->round_id)->get('rounds')->row();
                    if ($r2->time == null) {
                        $time = "00:00";
                    } else {
                        $time = date('h:i: A', strtotime($r2->time));
                    }
                    $checkpoints[] = array('name' => $this->db->where('id', $r2->loc_id)->get('locations')->row()->name, 'location' => $this->db->where('id', $r2->loc_id)->get('locations')->row()->location, 'time' => $time);
                }
                //$round_name=$this->db->where('id',$rx->round_id)->get('rounds')->row()->round_name;
                $d['data'][] = array('date' => date('d/m/Y', strtotime($r->date)), 'round_name' => $r->round_name, 'checkpoints' => $checkpoints);
                $checkpoints = null;
            }
        }
        echo json_encode($d);
    }


    function r_history()
    {
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }

        $id = $_POST['guard_id'];
        $d['status'] = "200";
        $d['msg'] = "success";
        $date = $this->db->query("SELECT date(created_at)as date FROM history where guard_id=" . $id . " GROUP BY date")->result();
        foreach ($date as $r) {
            $roundsx = $this->db->query("SELECT round_id FROM history WHERE date(created_at)='" . $r->date . "' AND guard_id=" . $id . " GROUP BY round_id")->result();
            foreach ($roundsx as $rx) {



                //$round_name=$this->db->where('id',$rx->round_id)->get('rounds')->row()->round_name;
                $d['data'][] = array('date' => date('d/m/Y', strtotime($r->date)), 'round_name' => $this->db->where('round_id', $rx->round_id)->order_by('id', 'desc')->get('history')->row()->round_name, 'round_id' => $rx->round_id);
            }
        }
        echo json_encode($d);
    }



    function r_history_detailed()
    {
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }
        $id = $_POST['guard_id'];
        $date = str_replace('/', '-', $_POST['date']);
        $date = date('Y-m-d', strtotime($date));
        $round_id = $_POST['round_id'];

        $d['status'] = "200";
        $d['msg'] = "success";
        //$date=$this->db->query("SELECT date(created_at)as date FROM history where guard_id=".$id." GROUP BY date")->result();


        $rounds = $this->db->where('DATE(created_at)', $date)->where('round_id', $round_id)->where('guard_id', $id)->get('history')->result();
        foreach ($rounds as $r2) {
            $rxx = $this->db->where('id', $r2->round_id)->get('rounds')->row();
            if ($r2->time == null) {
                $time = "00:00";
            } else {
                $time = date('h:i: A', strtotime($r2->time));
            }
            $d['data'][] = array('name' => $r2->loc_name, 'location' => $r2->location, 'time' => $time);
        }

        echo json_encode($d);
    }


    function history_by_date()
    {

        $from = str_replace('/', '-', $_POST['from']);
        $from = date('Y-m-d', strtotime($from));

        $to = str_replace('/', '-', $_POST['to']);
        $to = date('Y-m-d', strtotime($to));

        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }

        $id = $_POST['guard_id'];

        $date = $this->db->query("SELECT date(created_at)as date FROM history where guard_id=" . $id . " AND DATE(created_at)>='" . $from . "' AND DATE(created_at)<='" . $to . "'  GROUP BY date")->result();
        foreach ($date as $r) {
            $roundsx = $this->db->query("SELECT round_id FROM history WHERE date(created_at)='" . $r->date . "' AND guard_id=" . $id . " GROUP BY round_id")->result();
            foreach ($roundsx as $rx) {



                //$round_name=$this->db->where('id',$rx->round_id)->get('rounds')->row()->round_name;
                $d['data'][] = array('date' => date('d/m/Y', strtotime($r->date)), 'round_name' => $this->db->where('round_id', $rx->round_id)->order_by('id', 'desc')->get('history')->row()->round_name, 'round_id' => $rx->round_id);
            }
        }  //echo json_encode($d);



        // $q=$this->db->where('DATE(created_at)>=',$from)->where('DATE(created_at)>=',$to)->get('history')->result();
        if (!empty($d['data'])) {
            $d['status'] = '200';
            $d['msg'] = 'success';

            echo json_encode($d);
        } else {
            $d['status'] = '400';
            $d['msg'] = 'No Data Found !!';
            $d['data'] = "";
            echo json_encode($d);
        }
    }

    function forget_password()
    {

        $email = $this->db->get_where('guards', array('email' => $this->input->post('mail')))->num_rows();
        if ($email == 1) {
            $uid = time();
            $dup = array('re_id' => $uid);
            $this->db->where('email', $this->input->post('mail'));
            $this->db->update('guards', $dup);

            $body = "<a href='http://askaritechnologies.com/guardadmin/admin/modify_password1/" . $uid . "'>Click here for reset your password</a>";






            $to = $this->input->post('mail');
            $subject = 'RESET PASSWORD FOR Guard.';
            $headers = "From:support@guard.com\r\n";
            $headers .= "Reply-To:support@guard.com\r\n"; // . strip_tags($_POST['req-email']) .
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to, $subject, $body, $headers);




            $d['status'] = '200';
            $d['msg'] = 'Password reset link sent to your email address, please check your mail inbox !';
        } else {
            $d['status'] = '400';
            $d['msg'] = 'Invalid email id / email id not found';
        }

        echo json_encode($d);
    }
 //guard work ends
    
    function phone_info(){
         $imei = ($_POST['imei']);
         $longitude=($_POST['longitude']);
         $latitude = ($_POST['latitude']);
         $bat = ($_POST['bat']);
         $guard = ($_POST['guard_id']);
         
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }
        
        $data = array('imei' => $imei, 'longitude' => $longitude,'latitude' => $latitude,  'battery' => $bat, 'guard' => $guard);
        $this->load->model('Common_model');
        $d = $this->Common_model->data_insert2('devicesinfo', $data);

        $d['status'] = '200';
        $d['msg'] = 'success';
        
        
        

        echo json_encode($d);
    }
    
    function policy()
    {
        // $this->calculateMissed($_POST['guard_id']);
        $d['status'] = '200';
        $q = $this->db->query('select * from policy where id=1')->row();
        $d['title'] = $q->title;
        $d['description'] = $q->description;

        echo json_encode($d);
    }
    
    
    function access_code(){
         $code = ($_POST['accesscode']);
         
        $chk = $this->db->where('code', $_POST['accesscode'])->get('access')->num_rows();
        if ($chk > 0) {
             $d['status'] = '200';
             $d['msg'] = 'success';
            echo json_encode($d);
            exit;
        }
        
        $d['status'] = '500';
        $d['msg'] = 'Wrong access code';
         
        echo json_encode($d);
    }
    function Book_off(){
         $code = ($_POST['accesscode']);
         
        $chk = $this->db->where('code', $_POST['accesscode'])->get('bookoff')->num_rows();
        if ($chk > 0) {
             $d['status'] = '200';
             $d['msg'] = 'success';
            echo json_encode($d);
            exit;
        }
        
        $d['status'] = '500';
        $d['msg'] = 'Wrong access code';
         
        echo json_encode($d);
    }

     function Book_off1(){
         $code = ($_POST['accesscode']);
         
        $chk = $this->db->where('bookoff', $_POST['accesscode'])->where('id', $_POST['gid'])->get('guards')->num_rows();
        if ($chk > 0) {
             
             
            //  code to automate generation of BOOK ON OTP for the next day's login
            function generateRandomString($length = 6) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            
            $generateRandomString = generateRandomString();
            
            $this->db->where('id', $_POST['gid']);
            $din = array('accesscode' =>$generateRandomString);
            $this->db->update('guards', $din);
            $din = null;
             
            //   $this->db->query("update guards set accesscode=''  where id=" . $q->row()->id . "");
            $q = $this->db->get_where('attendance', array('guard_id' => $_POST['gid'], 'date(intime)' => date('Y-m-d')));
                if ($q->num_rows() == 1) {
        
                    $d['status'] = '200';
                    $d['msg'] = 'success';
                    $check = $this->db->where('guard_id', $_POST['gid'])->where('date(intime)', date('Y-m-d'))->get('attendance')->num_rows();
                    if ($check == 1) {
                        $this->db->where('guard_id', $_POST['gid'])->where('date(intime)', date('Y-m-d'));
                        $din = array('bookofftime' => date('Y-m-d H:i:s'));
                        $this->db->update('attendance', $din);
                        $din = null;
                    }
                }
                
            $d['status'] = '200';
             $d['msg'] = 'success';
              
            echo json_encode($d);
            exit;
        }
        
        $d['status'] = '500';
        $d['msg'] = 'Wrong access code';
         
        echo json_encode($d);
    }
    
    function ddob(){
        $guard_id = ($_POST['guard_id']);
        $date = date('Y-m-d');
        $time = date("h:i:sa"); 
        $occurrence = ($_POST['occurrence']);
        $remarks = ($_POST['remarks']);
       
       
        
        if ($guard_id != null){
            $din = array('submitted_by' => $guard_id, 'date' => $date,'time' => $time,'nature' => $occurrence,'remarks' => $remarks);
            $this->db->insert('daily_occurence', $din);
            $din = null;
            
            $d['status'] = '200';
            $d['msg'] = 'success';
            
            echo json_encode($d);
            exit;
        }
        $d['status'] = '500';
        $d['msg'] = 'Occurence has not been submitted';
        echo json_encode($d);
    }
    
    function incident(){
        
        
    }
    
    function leave_request(){
        $startdate = ($_POST['startdate']);
        $enddate = ($_POST['enddate']);
        $reason = ($_POST['reason']);
        $guard_id = ($_POST['guard_id']);
        
        if ($guard_id != null){
            
            $din = array('guard_id' => $guard_id, 'start' => $startdate,'end' => $enddate,'reason' => $reason);
            $this->db->insert('leaves', $din);
            $din = null;
            
            $d['status'] = '200';
            $d['msg'] = 'success';
            
            echo json_encode($d);
            exit;
        }
        $d['status'] = '500';
        $d['msg'] = 'Leave not submitted';
        echo json_encode($d);
        
    }
    
    function leave_history(){
        $chk = $this->db->where('id', $_POST['guard_id'])->where('login_status', '0')->get('guards')->num_rows();
        if ($chk > 0) {
            $d['status'] = '500';
            $d['msg'] = 'Please Login first !!';
            echo json_encode($d);
            exit;
        }

        $id = $_POST['guard_id'];
        $d['status'] = "200";
        $d['msg'] = "success";
        $date = $this->db->query("SELECT * FROM leaves where guard_id=" . $id . " ")->result();
        foreach ($date as $r) {
            



                //$round_name=$this->db->where('id',$rx->round_id)->get('rounds')->row()->round_name;
                $d['data'][] = array('date' => date('d/m/Y', strtotime($r->created_at)), 'round_name' => $r->reason, 'round_id' => $r->id);
            
        }
        echo json_encode($d);
        
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

<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cron extends CI_Controller
{
    function logout()
    {
          date_default_timezone_set('Asia/Calcutta');
        $this->db->query("update guards set login_status='0'");
          $this->db->query("update attendance set outtime='".date('Y-m-d H:i:s')."' where status='0' AND DATE(intime)='".date('Y-m-d')."'");
    }
    
     function missed()
    {
          date_default_timezone_set('Asia/Calcutta');
        $this->db->query("update guards set login_status='0'");
        $q=$this->db->get('guards')->result();
        foreach($q as $r)
        {
            
         if(date('Y-m-d',strtotime($r->loggedin_at))!=date('Y-m-d'))
         {
        $din=array('guard_id'=>$r->id,'status'=>'1');
        $this->db->insert('attendance',$din);     
         $din=null;
             
         }
        $this->logout();
        }
    }
}
?>
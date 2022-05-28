<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
                $this->load->helper('sms_helper');
              date_default_timezone_set('Asia/Calcutta');
    }
    function signout(){
        $this->session->sess_destroy();
        redirect("admin");
    }
	public function index()
	{$this->load->library('user_agent');
//	$this->agent->browser();echo "<br>";
// $this->agent->agent_string();echo "<br>";
$ip=  $this->input->ip_address(); //echo "<br>";echo "<br>";

if ($this->agent->is_browser())
{
        $agent = $this->agent->browser().' '.$this->agent->version();
}
elseif ($this->agent->is_robot())
{
        $agent = $this->agent->robot();
}
elseif ($this->agent->is_mobile())
{
        $agent = $this->agent->mobile();
}
else
{
        $agent = 'Unidentified User Agent';
}

$type= $agent;

$platform= $this->agent->platform(); 
    //exit;      
            $data = array("error"=>"");       
            if(isset($_POST))
            {
                
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                if ($this->form_validation->run() == FALSE) 
        		{
        		   if($this->form_validation->error_string()!=""){
        			$data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                </div>';
                    }
        		}else
                {
                   
                    $q = $this->db->query("Select * from `users` where (`user_email`='".$this->input->post("email")."') and user_password='".md5($this->input->post("password"))."'  Limit 1");
                    
                   // print_r($q) ; 
                    if ($q->num_rows() > 0)
                    {
                        $row = $q->row(); 
                        if($row->user_status == "0")
                        {
                            $data["error"] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> Your account currently inactive.</div>';
                        }
                        else
                        {
                            $newdata = array(
                                                   'user_name'  => $row->user_fullname,
                                                   'user_email'     => $row->user_email,
                                                   'logged_in' => TRUE,
                                                   'user_id'=>$row->user_id,
                                                   'user_type_id'=>$row->user_type_id
                                                  );
                            $this->session->set_userdata($newdata);
                            
                             $userid=$this->db->get_where('users',array('user_email'=>$this->input->post("email")));
                                  if($userid->num_rows()>0)
                                  {
                                      $userid=$userid->row()->user_id;
                                  }else{
                                      $userid=null;
                                  }
                                  $din=array('user_id'=>$userid,'ip_address'=>$ip,'status'=>1,'agent_type'=>$type,'platform'=>$platform);
                                  $this->db->insert('logs',$din);
                                  
                            redirect(_get_user_redirect($this));
                         
                        }
                    }
                    else
                    {
                        $data["error"] = '<div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> Invalid User and password. </div>';
                                  $userid=$this->db->get_where('users',array('user_email'=>$this->input->post("email")));
                                  if($userid->num_rows()>0)
                                  {
                                      $userid=$userid->row()->user_id;
                                  }else{
                                      $userid=null;
                                  }
                                  $din=array('user_id'=>$userid,'ip_address'=>$ip,'status'=>2,'agent_type'=>$type,'platform'=>$platform);
                                  $this->db->insert('logs',$din);
                    }
                   
                    
                }
            }
            $data["active"] = "login";
            
            $this->load->view("admin/login",$data);
        }
	


public function sendmail()
{
    if(isset($_POST['submit']))
    {
        $email=$this->db->get_where('users',array('user_email'=>$this->input->post('mail')))->num_rows();
        if($email==1)
        {
            $uid=time();
            $dup=array('re_id'=>$uid);
            $this->db->where('user_email',$this->input->post('mail'));
            $this->db->update('users',$dup);
            
            $body="<a href='http://sagarfoundation.org.in/guardadmin/admin/modify_password/".$uid."'>Click here for reset your password</a>";
                
                




                $to = $this->input->post('mail');
                $subject = 'RESET PASSWORD Guard Dashboard.';
                $headers = "From:support@guard.com\r\n";
                $headers .= "Reply-To:support@guard.com\r\n"; // . strip_tags($_POST['req-email']) .
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($to, $subject, $body, $headers);
                   
                    $this->session->set_flashdata('success', 'Registration Done!');
                   
                    echo "<script language='javascript'>alert('Go to your email inbox and click on confirmation link')</script>";
   
        }else{
              echo "<script language='javascript'>alert('Invalid Email')</script>";
           $this->load->view('users/send_mail');
        }
    }else{
         
        $this->load->view('users/send_mail');
    }
}




public function modify_password()
{
    if(isset($_POST['submit']))
    {
        if($_POST["pass"]!=$_POST["r_password"])
        {
             $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> passwords are not matching !!
                                    </div>');
                                   
            $this->load->view("users/modify_password");
        }else if($_POST["pass"]==$_POST["r_password"]){
            
            $q=$this->db->get_where('users',array('re_id'=>$this->input->post('re_id')))->num_rows();
            
              if($q!=1)
              {
                  $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> Invalid Link !!
                                    </div>');
                                    
                                  $this->load->view('users/modify_password');    
              }else{
              
            $dup=array('user_password'=>md5($this->input->post('pass')),'re_id'=>'0');
            $this->db->where('re_id',$this->input->post('re_id'));
          if(  $this->db->update('users',$dup))
            {
                 $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Success!</strong> Password changed successfully !! <a href="'.base_url().'">click here to the login </a> OR go to app
                                    </div>');
                                    
                                       
        $this->load->view('users/modify_password');
            }
            }
           
        }
       
    }else{
        
        
        $this->load->view('users/modify_password');
    }
}




public function modify_password1()
{
    if(isset($_POST['submit']))
    {
        if($_POST["pass"]!=$_POST["r_password"])
        {
             $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> passwords are not matching !!
                                    </div>');
                                   
            $this->load->view("users/modify_password1");
        }else if($_POST["pass"]==$_POST["r_password"]){
            
            $q=$this->db->get_where('guards',array('re_id'=>$this->input->post('re_id')))->num_rows();
            
              if($q!=1)
              {
                  $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> Invalid Link !!
                                    </div>');
                                    
                                  $this->load->view('users/modify_password1');    
              }else{
              
            $dup=array('password'=>md5($this->input->post('pass')),'re_id'=>'0');
            $this->db->where('re_id',$this->input->post('re_id'));
          if(  $this->db->update('guards',$dup))
            {
                 $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Success!</strong> Password changed successfully !! <a href="'.base_url().'">click here to the login </a> OR go to app
                                    </div>');
                                    
                                       
        $this->load->view('users/modify_password1');
            }
            }
           
        }
       
    }else{
        
        
        $this->load->view('users/modify_password1');
    }
}






    
    public function dashboard(){
       
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
            $this->load->view("admin/dashboard");
        
    }

    
       public function logs(){
         if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
           
    
            $this->load->view("admin/logs");
        
    }

    
  function add_users()
{
    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
                $this->form_validation->set_rules('address', 'address', 'trim|required');
               $this->form_validation->set_rules('password', 'password', 'trim|required');
               $this->form_validation->set_rules('email', 'email', 'trim|required');
               

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                    
                    $name=$_POST['name'];
                    $mobile=$_POST['mobile'];
                    $address=$_POST['address'];
                    $email=$_POST['email'];
                    $password=md5($_POST['password']);
                    $data=array('user_name'=>$name,'user_phone'=>$mobile,'address'=>$address,'user_type_id'=>1,'user_password'=>$password);
                    $this->load->model('Common_model');
                   $d= $this->Common_model->addusers('users',$data,$mobile);
                   
if($d["status"]==400){$alert="alert-danger";}else{$alert="alert-success";}
                    $this->session->set_flashdata("message",'<div class="alert '.$alert.' alert-dismissible" role="alert">
                    
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');
                    
                }
            }
                $this->load->view("admin/users");
}



function edit_user()
{
    
    if($this->uri->segment('3'))
    {
        $id=$this->uri->segment('3');
        $data['inv']=$this->db->query('select * from users where user_id='.$id)->row();
        $this->load->view('admin/edit_user',$data);
    }  

    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
                $this->form_validation->set_rules('address', 'address', 'trim|required');
                $this->form_validation->set_rules('email', 'email', 'trim|required');
                $this->form_validation->set_rules('password', 'password', 'trim|required');

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                     
                    $id=$_POST['id'];
                    $name=$_POST['name'];
                    $mobile=$_POST['mobile'];
                    $address=$_POST['address'];
                     $email=$_POST['email'];
                    $password=md5($_POST['password']);
                    $data=array('user_name'=>$name,'user_phone'=>$mobile,'address'=>$address,'user_type_id'=>1,'user_password'=>$password);
                    
                    $this->load->model('Common_model');
                   $d= $this->Common_model->edit1('users',$data,$id);

                    $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                    <i class="fa fa-check"></i>
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');
               redirect('admin/users');
                }
            }
               
}





function add_guards()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('start', 'start', 'trim|required');
    $this->form_validation->set_rules('end', 'end', 'trim|required');
  $this->form_validation->set_rules('guard_id', 'guard_id', 'trim|required');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                 $this->form_validation->set_rules('email', 'email', 'trim|required');
                $this->form_validation->set_rules('mobile', 'mobile number', 'required|regex_match[/^[0-9]{10}$/]');
                $this->form_validation->set_rules('agency', 'Agency name', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                 $this->form_validation->set_rules('conf_password', 'confirm Password', 'trim|required');
               

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                    if($_POST['password']!=$_POST['conf_password'])
                    {
                           $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> Passwords Not Matching !!
                                    </div>');
                                    redirect('admin/add_guards');
                    }

                    $name=$_POST['name'];
                    $mobile=$_POST['mobile'];
                    $email=$_POST['email'];
                    $agency=$_POST['agency'];
                    $password=md5($_POST['password']);
                    $data=array('name'=>$name,'mobile'=>$mobile,'agency'=>$agency,'password'=>$password,'email'=>$email,'status'=>1,'start'=>$_POST['start'],'end'=>$_POST['end'],'guard_id'=>$_POST['guard_id']);
                    $this->load->model('Common_model');
                   $d= $this->Common_model->add('guards',$data,$mobile);

if($d["status"]==400){$alert="alert-danger";}else{$alert="alert-success";} 
                    $this->session->set_flashdata("message",'<div class="alert   '.$alert.' alert-dismissible" role="alert">
                   
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');
                
                 redirect('admin/add_guards');
                }
            }
                $this->load->view("admin/add_guards");
}




function add_rounds()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
                $this->form_validation->set_rules('guard_id', 'guard_id', 'trim|required');
                 $this->form_validation->set_rules('start', 'start time', 'trim|required');
                $this->form_validation->set_rules('end', 'End Time', 'trim|required');
                  $this->form_validation->set_rules('round_name', 'Round Name', 'trim|required');
                
               

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                    if(!isset($_SESSION['ids'])||empty($_SESSION['ids']))
                    {
                        $this->session->set_flashdata("message",'<div class="alert alert-danger alert-dismissible" role="alert">
                   
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Please Select Checkpoints !!</strong>
                </div>');
                  redirect('admin/add_rounds');
                    }
                   
                    $guard_id=$_POST['guard_id'];
                    $start=$_POST['start'];
                    $end=$_POST['end'];
                    
                   
                    $data=array('start'=>$start,'end'=>$end,'checkpoints'=>implode (",",$_SESSION['ids']),'guard_id'=>$guard_id,'round_name'=>$_POST['round_name']);
                    $this->load->model('Common_model');
                   $d= $this->Common_model->data_insert2('rounds',$data);
                    $round_id=$this->db->insert_id();
    //                 $dx=$_SESSION['ids'];
    // $i=count($dx);
    // $j=0;
    // for(;$i>0;$i--)
    // {$x=$j+1;
    //                 $din=array('guard_id'=>0,'round_id'=>$round_id,'loc_id'=>$dx[$j],'srno'=>$x);
    //                 $this->db->insert('history',$din);
    //                 $din=null;
    //                 $j++;
    // }
if($d["status"]==400){$alert="alert-danger";}else{$alert="alert-success";} 
                    $this->session->set_flashdata("message",'<div class="alert   '.$alert.' alert-dismissible" role="alert">
                   
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');
                
                 redirect('admin/add_rounds');
                }
            }
                $this->load->view("admin/add_rounds");
}


function edit_rounds()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}

    if($this->uri->segment('3'))
    {
        $var=$this->db->where('id',$this->uri->segment('3'))->get('rounds');
        $_SESSION['ids']=explode(',', $var->row()->checkpoints);

        $id=$this->uri->segment('3');
        $data['inv']=$this->db->query('select * from rounds where id='.$id)->row();
        $this->load->view('admin/edit_round',$data);
    }  

    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
     $this->form_validation->set_rules('guard_id', 'guard_id', 'trim|required');
                 $this->form_validation->set_rules('start', 'start time', 'trim|required');
                $this->form_validation->set_rules('end', 'End Time', 'trim|required');
                 $this->form_validation->set_rules('round_name', 'Round Name', 'trim|required');
                

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                    if(!isset($_SESSION['ids'])||empty($_SESSION['ids']))
                    {
                        $this->session->set_flashdata("message",'<div class="alert alert-danger alert-dismissible" role="alert">
                   
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Please Select Checkpoints !!</strong>
                </div>');
                  redirect('admin/add_rounds');
                    }
                   
                    $guard_id=$_POST['guard_id'];
                    $start=$_POST['start'];
                    $end=$_POST['end'];
                    $data=array('start'=>$start,'end'=>$end,'checkpoints'=>implode (",",$_SESSION['ids']),'guard_id'=>$guard_id,'round_name'=>$_POST['round_name']);
                    $this->db->where('id',$_POST['round_id']);
                     $this->db->update('rounds',$data);
                   
      $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                    <i class="fa fa-check"></i>
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>Updated Successfully !
                </div>');

                
               redirect('admin/rounds');
                }
            }
                
}


function view_rounds()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}

    if($this->uri->segment('3'))
    {
        $var=$this->db->where('id',$this->uri->segment('3'))->get('rounds');
        $_SESSION['ids']=explode(',', $var->row()->checkpoints);

        $id=$this->uri->segment('3');
        $data['inv']=$this->db->query('select * from rounds where id='.$id)->row();
        $this->load->view('admin/view_round',$data);
    }  
}


function edit_guard()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}

    if($this->uri->segment('3'))
    {
        $id=$this->uri->segment('3');
        $data['inv']=$this->db->query('select * from guards where id='.$id)->row();
        $this->load->view('admin/edit_guard',$data);
    }  

    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('start', 'start', 'trim|required');
    $this->form_validation->set_rules('end', 'end', 'trim|required');
  $this->form_validation->set_rules('guard_id', 'guard_id', 'trim|required');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                 $this->form_validation->set_rules('email', 'email', 'trim|required');
                $this->form_validation->set_rules('mobile', 'mobile number', 'required|regex_match[/^[0-9]{10}$/]');
                $this->form_validation->set_rules('agency', 'Agency name', 'trim|required');
                // $this->form_validation->set_rules('password', 'Password', 'trim|required');
                //  $this->form_validation->set_rules('conf_password', 'confirm Password', 'trim|required');
               

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                    $id=$_POST['id'];
                    $name=$_POST['name'];
                    $mobile=$_POST['mobile'];
                    $email=$_POST['email'];
                    $agency=$_POST['agency'];
                    //$password=md5($_POST['password']);
                    $data=array('name'=>$name,'mobile'=>$mobile,'agency'=>$agency,'email'=>$email,'start'=>$_POST['start'],'end'=>$_POST['end'],'guard_id'=>$_POST['guard_id']);
                    $this->load->model('Common_model');
                   $d= $this->Common_model->edit('guards',$data,$id);

                    $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                    <i class="fa fa-check"></i>
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');

                
               redirect('admin/guards');
                }
            }
                
}

function daily_reports()
{
      if(_is_user_login($this)){
            $data = array();
            $this->load->model("product_model");
            $fromdate = date("Y-m-d");
            $todate = date("Y-m-d");
            $data['date_range_lable'] = $this->input->post('date_range_lable');
           $filter="";
        if(isset($_POST['guard_id'])&&$_POST['guard_id']!='all')
           {          
            if($this->input->post("date_range")!=""){
				$filter = $this->input->post("date_range");
			    $dates = explode(",",$filter);                
                $fromdate =  date("Y-m-d", strtotime($dates[0]));
                $todate =  date("Y-m-d", strtotime($dates[1])); 
                $filter =" and guard_id=".$_POST['guard_id']." and date(history.created_at) >= '".$fromdate."' and date(history.created_at) <= '".$todate."' ";
            }
           }else{
               if($this->input->post("date_range")!=""){
				$filter = $this->input->post("date_range");
			    $dates = explode(",",$filter);                
                $fromdate =  date("Y-m-d", strtotime($dates[0]));
                $todate =  date("Y-m-d", strtotime($dates[1])); 
                $filter =" and date(history.created_at) >= '".$fromdate."' and date(history.created_at) <= '".$todate."' ";
            }
           }
            $data["products"] = $this->product_model->get_history($filter);
            
            
    $this->load->view("admin/daily_reports",$data);
        }
        
        
    
}



function attendance()
{
      if(_is_user_login($this)){
            $data = array();
            $this->load->model("product_model");
            $fromdate = date("Y-m-d");
            $todate = date("Y-m-d");
            $data['date_range_lable'] = $this->input->post('date_range_lable');
           $filter="";
           if(isset($_POST['guard_id'])&&$_POST['guard_id']!='all')
           {
            if($this->input->post("date_range")!=""){
				$filter = $this->input->post("date_range");
			    $dates = explode(",",$filter);                
                $fromdate =  date("Y-m-d", strtotime($dates[0]));
                $todate =  date("Y-m-d", strtotime($dates[1])); 
                $filter =" and guard_id=".$_POST['guard_id']." and date(attendance.created_at) >= '".$fromdate."' and date(attendance.created_at) <= '".$todate."' ";
            }   
           }else{
               if($this->input->post("date_range")!=""){
				$filter = $this->input->post("date_range");
			    $dates = explode(",",$filter);                
                $fromdate =  date("Y-m-d", strtotime($dates[0]));
                $todate =  date("Y-m-d", strtotime($dates[1])); 
                $filter =" and date(attendance.created_at) >= '".$fromdate."' and date(attendance.created_at) <= '".$todate."' ";
            }
           }
            
            $data["products"] = $this->product_model->get_attendance($filter);
            
            
    $this->load->view("admin/attendance",$data);
        }
        
        
    
}


function about_us()
{
if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
      

    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Title', 'trim|required');
                 $this->form_validation->set_rules('description', 'Description', 'trim|required');
                
               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                    $data=array('title'=>$_POST['title'],'description'=>$_POST['description']);
                    $this->load->model('Common_model');
                   $d= $this->Common_model->edit('about_us',$data,1);

                    $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                    <i class="fa fa-check"></i>
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');

                
               redirect('admin/about_us');
                }
            }
       $id=$this->uri->segment('3');
        $data['inv']=$this->db->query('select * from about_us where id=1')->row();
        $this->load->view('admin/about_us',$data);         
}






function add_checkpoint()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                 $this->form_validation->set_rules('location', 'location', 'trim|required');
                $this->form_validation->set_rules('code', 'code', 'trim|required');
               
               

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {

                    $name=$_POST['name'];
                    $location=$_POST['location'];
                    $code=$_POST['code'];
                    
                    
//                     $image_url=$_POST['image'];
//  $data = file_get_contents($image_url);
//  $n=time();
//  $new = './uploads/qrcodes/'.$n.'.png';
//  $upload =file_put_contents($new, $data);
//  if($upload) {
//     //  echo "<img src='images/myimage.jpg'>";
//  }else{
//     // echo "Please upload only image files";
//  } 
 
 
                  
                    $data=array('name'=>$name,'code'=>$code,'location'=>$location);
                    $this->load->model('Common_model');
                   $d= $this->Common_model->data_insert2('locations',$data);

if($d["status"]==400){$alert="alert-danger";}else{$alert="alert-success";} 
                    $this->session->set_flashdata("message",'<div class="alert   '.$alert.' alert-dismissible" role="alert">
                   
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');
                
                redirect('admin/add_checkpoint');
                }
            }
                $this->load->view("admin/add_checkpoint");
}





function edit_checkpoint()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if($this->uri->segment('3'))
    {
        $id=$this->uri->segment('3');
        $data['inv']=$this->db->query('select * from locations where id='.$id)->row();
        $this->load->view('admin/edit_checkpoint',$data);
    }
    
    
    if(isset($_POST['submit']))
    {
    $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                 $this->form_validation->set_rules('location', 'location', 'trim|required');
                $this->form_validation->set_rules('code', 'code', 'trim|required');
               
               

               

                if ($this->form_validation->run() == FALSE)
                {
                  if($this->form_validation->error_string()!="")
                      $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-warning"></i>
                                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <strong>Warning!</strong> '.$this->form_validation->error_string().'
                                    </div>');
                }
                else
                {
                    $id=$_POST['id'];
                
                    $name=$_POST['name'];
                    $location=$_POST['location'];
                    $code=$_POST['code'];
                    
                    
//                     $image_url=$_POST['image'];
//  $data = file_get_contents($image_url);
//  $n=time();
//  $new = './uploads/qrcodes/'.$n.'.png';
//  $upload =file_put_contents($new, $data);
//  if($upload) {
//     //  echo "<img src='images/myimage.jpg'>";
//  }else{
//     // echo "Please upload only image files";
//  } 
 
 
                  
                    $data=array('name'=>$name,'code'=>$code,'location'=>$location);
                    $this->load->model('Common_model');
                   $d= $this->Common_model->edit('locations',$data,$id);

if($d["status"]==400){$alert="alert-danger";}else{$alert="alert-success";} 
                    $this->session->set_flashdata("message",'<div class="alert   '.$alert.' alert-dismissible" role="alert">
                   
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong></strong>'.$d["msg"].'
                </div>');
                
                redirect('admin/checkpoints');
                }
            }
               


}






function users(){
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    $query="select * from users where user_type_id!=0";
    $this->load->model('Common_model');
    $dx=$this->Common_model->get($query);
    $data["products"]  =$dx;
    $this->load->view("admin/product/list4",$data);    
}



function guards(){
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    $query="select * from guards";
    $this->load->model('Common_model');
    $dx=$this->Common_model->get($query);
    $data["products"]  =$dx;
    $this->load->view("admin/guards",$data);    
}

function rounds(){
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    $query="select * from rounds";
    $this->load->model('Common_model');
    $dx=$this->Common_model->get($query);
    $data["products"]  =$dx;
    $this->load->view("admin/rounds",$data);    
}

function checkpoints(){
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    $query="select * from locations";
    $this->load->model('Common_model');
    $dx=$this->Common_model->get($query);
    $data["products"]  =$dx;
    $this->load->view("admin/checkpoints",$data);    
}








function delete_user($id){
        if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
            $this->db->query("Delete from users where user_id = '".$id."'");
            redirect("admin/users");
        
}


function suspend_guard($id){
       if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
            $this->db->query("update guards set status='2' where id = '".$id."'");
            
            $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                        <i class="fa fa-check"></i>
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong></strong>Successfully Suspended !!
                    </div>');
                    redirect('admin/guards');
        
}



function delete_checkpoint($id){
       if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
		$q=$this->db->get('rounds');
		foreach($q->result() as $r)
		{
		    $chk=explode(',', $r->checkpoints);
    $i=count($chk);
    $j=0;
   
    for(;$i>0;$i--)
    {
        $lid=$chk[$j];
        if($lid==$id)
        {
        unset($chk[$j]);
        $dup=array('checkpoints'=>implode(',', $chk));
        $this->db->where('id',$r->id);
        $this->db->update('rounds',$dup);
        $dup=null;
       // echo "success"; exit;
        }
       
        
    $j++;
        
    }
		}
    //   $image='./uploads/qrcodes/'.$this->db->where('id',$id)->get('locations')->row()->image;
            $this->db->query("delete from locations where id = '".$id."'");
            
            //  unlink($image);
            $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                        <i class="fa fa-check"></i>
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong></strong>Successfully Deleted !!
                    </div>');
                    redirect('admin/checkpoints');
        
}


function delete_rounds($id){
       
      if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
            $this->db->query("delete from rounds where id = '".$id."'");
            
            
            $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                        <i class="fa fa-check"></i>
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong></strong>Successfully Deleted !!
                    </div>');
                    redirect('admin/rounds');
        
}

function active_guard($id){
       if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
            $this->db->query("update guards set status='1' where id = '".$id."'");
            
            $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                        <i class="fa fa-check"></i>
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong></strong>Successfully Activated !!
                    </div>');
                    redirect('admin/guards');
        
}



function delete_product($id){
        if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
            $this->db->query("Delete from products where id = '".$id."'");
            redirect("admin/products");
        
}

function delete_quality($id){

            $this->db->query("Delete from milk_quality where id = '".$id."'");
            redirect("admin/add_quality");
       
}


function get_sub_data()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
   //error_reporting(0);
    $data=$_SESSION['ids'];
    
   
    $i=count($data);
    $j=0;
    for(;$i>0;$i--)
    {
        $n=$j+1;
        if(!empty($data[$j]))
        {
    $rx=$this->db->get_where('locations',array('id'=>$data[$j]))->row();
        echo "<tr><td>".$n."</td><td>".$rx->name."</td><td>".$rx->location."</td> <td><a href='#' style='color:red; font-weight:bold'  onclick='del(".$j.")'>DELETE</a></td></tr>";
        }
    $j++;
        
    }
}


function get_sub_data2()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
   //error_reporting(0);
    $data=$_SESSION['ids'];
    
   
    $i=count($data);
    $j=0;
    for(;$i>0;$i--)
    {
        $n=$j+1;
        if(!empty($data[$j]))
        {
    $rx=$this->db->get_where('locations',array('id'=>$data[$j]))->row();
        echo "<tr><td>".$n."</td><td>".$rx->name."</td><td>".$rx->location."</td></tr>";
        }
    $j++;
        
    }
}


function get_list_data()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
   //error_reporting(0);
    $data=$_SESSION['ids'];
    $i=count($data);
    $j=0;
    $w="WHERE id<>0 ";
    for(;$i>0;$i--)
    {
        $lid=$data[$j];
        $w=$w." AND id<>".$lid."";
        
    $j++;
        
    }
$q="SELECT * FROM locations ".$w." ";
   $q=$this->db->query($q)->result();
   print_r( $q);
    foreach($q as $r)
    {
        
        echo "<option value='".$r->id."' >".$r->location."</option>";
            
    }
}


function get_sub_data_by_id()
{if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    $this->db->where('user_id',$this->uri->segment('3'));
    $data=$this->db->get('subcription')->result();
    foreach($data as $r)
    {
        echo "<tr><td>".$r->milk_type."</td><td>".$r->qty."</td></tr>";
    }
}

function add_sub()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if(!isset($_SESSION['ids']))
    {
        $_SESSION['ids'] = array();
    }
  // $_SESSION['ids'] = array();
    $loc_id=$_POST['location'];
    //$qty=$_POST['qty'];
    
   
    // $_SESSION['ids'] = array();
	array_push($_SESSION['ids'],$loc_id);
   
    return true;
}


function update_rate()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if(isset($_POST['submit']))
    {
    $q=$this->db->get_where('milk_stock',array('milk_type'=>$_POST['milk_type']))->num_rows();
   
    $milk_type=$_POST['milk_type'];
    $rate=$_POST['rate'];
    
    $data=array('rate'=>$rate);
    if($q>0)
    {
        
        $this->db->where('milk_type',$_POST['milk_type']);
        $this->db->update('milk_stock',$data);
    }
    $this->session->set_flashdata("message",'<div class="alert alert-success alert-dismissible" role="alert">
                        <i class="fa fa-check"></i>
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong></strong>Successfully Updated !!
                    </div>');
                    redirect('admin/update_rate');
}
$this->load->view('admin/update_rate');
}



function check()
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if(isset($_SESSION['ids']))
    {
        $_SESSION['ids']=array();
    }
}

function del($id)
{
    if(!isset($_SESSION['user_id']))
		{
		   redirect(base_url());
		}
    if(isset($_SESSION['ids']))
    {
    $data=$_SESSION['ids'];
        unset($data[$id]);
        $data = array_values($data);
        $_SESSION['ids']=$data;
    }
    
}



}

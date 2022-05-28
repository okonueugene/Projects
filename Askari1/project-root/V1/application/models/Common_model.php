<?php
class Common_model extends CI_Model{
    function data_insert($table,$insert_array){
        $this->db->insert($table,$insert_array);
        return $this->db->insert_id();
    }

    function data_insert2($table,$insert_array){
      $q=  $this->db->insert($table,$insert_array);
        if($q==FALSE)
        {
            $d['status']='400';
            $d['msg']='error!!';
         
        }else{
             $d['status']='200';
             $d['msg']='successfully added !!';
            
        }
       return $d;
    }

    function data_update($table,$set_array,$condition){
        $this->db->update($table,$set_array,$condition);
        return $this->db->affected_rows();
    }
    function data_remove($table,$condition){
        $this->db->delete($table,$condition);
    }


    function add($table,$data,$mobile)
    {
       $q= $this->db->get_where($table,array('mobile'=>$mobile))->num_rows();
        $q1= $this->db->get_where($table,array('email'=>$data['email']))->num_rows();
       
       if($q==1)
       {
           $d['status']='400';
           $d['msg']='This mobile is already registered';
        
       }else if($q1==1){
     $d['status']='400';
           $d['msg']='This  email is already registered';
           
       }
       else{
           if($this->db->insert($table,$data))
           {
            $d['status']='200';
            $d['msg']='successfully added !!';
           }
       }
      return $d;

    }
    
    
    
    function addusers($table,$data,$mobile)
    {
       $q= $this->db->get_where($table,array('user_phone'=>$mobile))->num_rows();
       if($q==1)
       {
           $d['status']='400';
           $d['msg']='this mobile is already registered';
        
       }else{
           if($this->db->insert($table,$data))
           {
            $d['status']='200';
            $d['msg']='successfully added !!';
           }
       }
      return $d;

    }

    function edit($table,$data,$id)
    {
       $q= $this->db->get_where($table,array('id'=>$id))->num_rows();
       if($q==1)
       {
        $this->db->where('id',$id);
        if($this->db->update($table,$data))
        {
         $d['status']='200';
         $d['msg']='successfully updated !!';
        }
        
       }
      return $d;

    }
    
    
     function edit1($table,$data,$id)
    {
       $q= $this->db->get_where($table,array('user_id'=>$id))->num_rows();
       if($q==1)
       {
        $this->db->where('user_id',$id);
        if($this->db->update($table,$data))
        {
         $d['status']='200';
         $d['msg']='successfully updated !!';
        }
        
       }
      return $d;

    }

function get($query)
{
return $this->db->query($query)->result();
}



function get_sort($filter="",$table){
         $sql = "Select *,DATE_FORMAT(date,'%d/%m/%Y') as date from ".$table." 
            where 1 ".$filter." ORDER BY id DESC";
            $q = $this->db->query($sql);
            return $q->result();
      }
      
function get_sort1($filter="",$table){
         $sql = "Select sum(amount) as amt,DATE_FORMAT(date,'%d/%m/%Y') as date from ".$table." 
            where 1 ".$filter." ORDER BY id DESC";
            $q = $this->db->query($sql);
            return $q->result();
      }
      
      
}
?>
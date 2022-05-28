<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
    }

    public function index()
    {
        $dobs = $this->db->get('daily_occurence')->result();
        $guards = $this->db->get('guards')->result();

        $this->load->view('admin/dobs/index', ['dobs' => $dobs, 'guards' => $guards]);
    }

    public function create()
    {

        $this->load->view('admin/dobs/create');
    }

    public function edit($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');
            $incident = $this->db->where(['id' => $id])->get('incidents')->row();
            $this->load->view('admin/incidents/edit', ['incident' => $incident]);
        }
    }
    
    public function show($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');
            $dob = $this->db->where(['id' => $id])->get('daily_occurence')->row();
            $this->load->view('admin/dobs/show', ['dob' => $dob]);
        }

    }

    public function store()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('submitted_by', 'submitted_by', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('time', 'time', 'required');
        $this->form_validation->set_rules('nature', 'nature', 'required');

        if ($this->form_validation->run()) {
            $confirmed = 0;
            $dob = array(
                'submitted_by' => $this->input->post('submitted_by'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
                'confirmed' => $confirmed,
                'nature' => $this->input->post('nature')
            );
            $this->session->set_flashdata('success', 'DOB successfully added');
            $this->db->insert('daily_occurence', $dob);
        } else {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url('admin/dobs'));
        }

        redirect('/admin/dobs/');
    }

    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('time', 'time', 'required');
        $this->form_validation->set_rules('reported_by', 'reported_by', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('actions', 'actions', 'required');

        if ($this->form_validation->run()) {
            $incident = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
                'reported_by' => $this->input->post('reported_by'),
                'actions' => $this->input->post('actions'),
            );
            $this->session->set_flashdata('success', 'Report successfully updated');
            $this->db->where(['id' => $id])->update('incidents', $incident);
        } else {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url('admin/incident/create'));
        }

        redirect('/admin/incidents');
    }

    public function getdetails($id)
    {
        // if ($this->uri->segment('3')) {

        //     $id = $this->uri->segment('3');
        //     $incident = $this->db->where(['id' => $id])->get('incidents')->row();
        //     // $this->load->view('task/show',['incident' => $incident]);
        //     $this->load->view('admin/incidents/show', ['incident' => $incident]);
        // }

        $id   = $_POST['id'];
        $data['entity']  = $this->db->where(['id' => $id])->get('daily_occurence')->row();
        $this->load->view("admin/dobs/modal", $data);
    }

    public function delete($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');
            $this->session->set_flashdata('success', 'DOB successfully deleted');
            $this->db->where(['id' => $id])->delete('daily_occurence');

            redirect('/admin/dobs');
        }

    }

    public function confirm($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');

            $data = array(
                'confirmed' => 1
            );
            
            $this->db->where('id', $id);
            $this->db->update('daily_occurence', $data);

            $this->session->set_flashdata('success', 'DOB approved successfully ');

            redirect('/admin/dobs');
        }else
        {
            $this->session->set_flashdata('errors', 'Dob does not exist in the database ');
            redirect('/admin/dobs');
        }
    }
    
    public function remarks($id)
    {
        if ($this->uri->segment('3'))
        {
            $id = $this->uri->segment('3');
            
            $data = array(
                'remarks' => $this->input->post('remarks')
            );
            
            $this->db->where('id', $id);
            $this->db->update('daily_occurence', $data);
            
            $this->session->set_flashdata('success', 'DOB updated successfully ');
            
            redirect('/admin/dobs');
        }else
        {
            $this->session->set_flashdata('errors', 'Dob does not exist in the database ');
            redirect('/admin/dobs');
        }
    }

}

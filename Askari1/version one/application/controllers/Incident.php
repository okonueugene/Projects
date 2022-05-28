<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Incident extends CI_Controller
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
        $incidents = $this->db->get('incidents')->result();
        $this->load->view('admin/incidents/index', ['incidents' => $incidents]);
    }

    public function create()
    {
        $guards = $this->db->get('guards')->result();

        $this->load->view('admin/incidents/create', ['guards' => $guards]);
    }

    public function edit($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');
            $incident = $this->db->where(['id' => $id])->get('incidents')->row();
            $this->load->view('admin/incidents/edit', ['incident' => $incident]);
        }
    }

    public function store()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('time', 'time', 'required');
        $this->form_validation->set_rules('refno', 'refno', 'required');
        $this->form_validation->set_rules('reported_to', 'reported_to', 'required');
        $this->form_validation->set_rules('reported_by', 'reported_by', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('actions', 'actions', 'required');

        if ($this->form_validation->run()) {
            $incident = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
                'reported_to' => $this->input->post('reported_to'),
                'refno' => $this->input->post('refno'),
                'reported_by' => $this->input->post('reported_by'),
                'actions' => $this->input->post('actions'),
            );
            $this->session->set_flashdata('success', 'Report successfully added');
            $this->db->insert('incidents', $incident);
        } else {
            $errors = $this->form_validation->error_string();
            $this->session->set_flashdata('errors', $errors);
            
            redirect(base_url('admin/incident/create'));
        }

        redirect('/admin/incidents');
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

    public function show($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');
            $incident = $this->db->where(['id' => $id])->get('incidents')->row();
            // $this->load->view('task/show',['incident' => $incident]);
            $this->load->view('admin/incidents/show', ['incident' => $incident]);
        }

    }

    public function delete($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');
            $this->session->set_flashdata('success', 'Report successfully deleted');
            $this->db->where(['id' => $id])->delete('incidents');

            redirect('/admin/incidents');
        }

    }

}

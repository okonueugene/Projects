<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
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
        $leaves = $this->db->get('leaves')->result();
        $guards = $this->db->get('guards')->result();

        $this->load->view('admin/leaves/index', ['leaves' => $leaves, 'guards' => $guards]);
    }

    public function create()
    {

        $this->load->view('admin/incidents/create');
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
        $this->form_validation->set_rules('guard_id', 'guard_id', 'required');
        $this->form_validation->set_rules('start', 'start', 'required');
        $this->form_validation->set_rules('end', 'end', 'required');

        if ($this->form_validation->run()) {
            $status = '0';
            $leave = array(
                'guard_id' => $this->input->post('guard_id'),
                'start' => $this->input->post('start'),
                'end' => $this->input->post('end'),
                'status' => $status,
                'reason' => $this->input->post('reason')
            );
            $this->session->set_flashdata('success', 'Report successfully added');
            $this->db->insert('leaves', $leave);
        } else {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            redirect(base_url('admin/leaves'));
        }

        redirect('/admin/leaves/');
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
            $this->session->set_flashdata('success', 'Leave successfully deleted');
            $this->db->where(['id' => $id])->delete('leaves');

            redirect('/admin/leaves');
        }

    }

    public function approve($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');

            $approved_at = date('Y-m-d H:i:s');
            $data = array(
                'status' => 1,
                'approved_by' => $this->input->post('approved_by'),
                'approved_at' => $approved_at
            );
            
            $this->db->where('id', $id);
            $this->db->update('leaves', $data);

            $this->session->set_flashdata('success', 'Leave approved successfully ');

            redirect('/admin/leaves');
        }
    }

    public function reject($id)
    {
        if ($this->uri->segment('3')) {

            $id = $this->uri->segment('3');

            $data = array(
                'status' => 2
            );
            
            $this->db->where('id', $id);
            $this->db->update('leaves', $data);

            $this->session->set_flashdata('success', 'Leave rejected successfully ');

            redirect('/admin/leaves');
        }
    }

}

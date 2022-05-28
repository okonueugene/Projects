<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Timesheet extends CI_Controller
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
        $data = array();
        $this->load->model("product_model");
        $fromdate = date("Y-m-d");
        $todate = date("Y-m-d");
        $data['date_range_lable'] = $this->input->post('date_range_lable');
        $filter = "";
        if (isset($_POST['guard_id']) && $_POST['guard_id'] != 'all') {
            if ($this->input->post("date_range") != "") {
                $filter = $this->input->post("date_range");
                $dates = explode(",", $filter);
                $fromdate = date("Y-m-d", strtotime($dates[0]));
                $todate = date("Y-m-d", strtotime($dates[1]));
                $filter = " and guard_id=" . $_POST['guard_id'] . " and date(attendance.created_at) >= '" . $fromdate . "' and date(attendance.created_at) <= '" . $todate . "' ";
            }
        } else {
            if ($this->input->post("date_range") != "") {
                $filter = $this->input->post("date_range");
                $dates = explode(",", $filter);
                $fromdate = date("Y-m-d", strtotime($dates[0]));
                $todate = date("Y-m-d", strtotime($dates[1]));
                $filter = " and date(attendance.created_at) >= '" . $fromdate . "' and date(attendance.created_at) <= '" . $todate . "' ";
            }
        }

        $data["products"] = $this->product_model->get_attendance($filter);

        $this->load->view("admin/timesheets/index", $data);
    }
}

<?php
require_once __DIR__ . '/../model/JobModel.php'; 

class JobController {
    private $jobModel;

    public function __construct() {
        $this->jobModel = new JobModel();
    }

    public function index() {
        $jobs = $this->jobModel->getAllJobs();
        include __DIR__ . '/../view/homepage.php'; 
    }

    public function detail($id) {
        $job = $this->jobModel->getJobById($id);
        if ($job) {
            include __DIR__ . '/../view/job_detail.php'; 
        } else {
            echo "Lowongan tidak ditemukan.";
        }
    }
}
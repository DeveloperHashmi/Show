<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
require_once(APPPATH.'libraries/vuforiaclient.php');
class Ar extends BaseController {
    public function __construct() {
            parent::__construct();
            $this->load->library(array('form_validation','session','image_lib','zip')); // load form lidation libaray & session library
            $this->load->helper(array('url','html','form','file'));  // load url,html,form helpers optional
            $this->load->model('Usermodel');
             $this->load->model('user_model');
            $this->load->helper('cias_helper');
            $this->isLoggedIn();
            date_default_timezone_set('Asia/Kolkata');
    }
    public function index()
    {
        $role = $this->session->userdata('role');
        if($role == '2')
        {
            $this->load->model('user_model');
            $loginUser = $this->session->userdata('userId');
            $rdata = array();
            $data = $this->user_model->getArList($loginUser);
            // echo "<pre>"; print_r($data);
            $checkTour = $this->Usermodel->checkTour($loginUser);
            
            $rdata = array('arData'=>$data,'tour'=>$checkTour);
            $rdata['nestedView']['otherData'] = 'yes';
            //    $this->global['pageTitle'] = 'Liveorbis : Add AR'; 
            $this->load->view('pages/merchant/ar-listing',$rdata);
        }
        else
        {
            redirect('/dashboard');
        }
    }
    ?>

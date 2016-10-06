<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends CI_Controller {

	function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $this->load->model('Staffmodel');
        $this->load->library('image_lib');
        $this->load->helper(array('form', 'url'));

    }

    public function index()
    {
      $this->load->view('staff/login');
    }
    
    public function login()
    {
    	$this->load->view('staff/login');
    }

    public function submitlogin()
    {
        $email = $this->input->post('username');
        $usertype = $this->input->post('usertype');
        $password = hash('sha512', $this->input->post('password'));
        $vendorid = $this->db->get_where('tblusers' , array('email' => $email, 'password' => $password, 'usertype' => $usertype, 'status' => 1 ))->row()->vendorid; 
        //echo $vendorid;
        $numberOfRows=$this->Staffmodel->checkLoginCredentials($email,$password,$usertype,$vendorid);
        if ($numberOfRows<1) {
            $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The Username & Password doesnt match. Try again!!!</div>');
            $this->load->view('staff/login');
        }else{
            $this->session->set_userdata('usertype',$usertype);
            $this->session->set_userdata('email',$email);
            $this->session->set_userdata('vendorid',$vendorid);
            if ($usertype=="booking") {
                redirect('staff/dashboard');
            }else{
                redirect('staff/securitydashboard');
            }
            
        }
    } 

    public function dashboard()
    {
        $vendorid = $this->session->userdata('vendorid');
        $this->load->view('staff/dashboard');
    }

    public function securitydashboard()
    {
        $vendorid = $this->session->userdata('vendorid');
        $this->load->view('staff/securitydashboard');
    }

    public function logout()
    {
      if (!$this->session->userdata('email')) 
              redirect('staff/login');
        $this->load->view('staff/logout');
    }

 
    /*
    public function updtticketupdateticket()
    {
        $tckno=$this->input->post('tkno');
        $dt = date('Y-m-d');
        $vendorid = $this->db->get_where('tblusers' , array('email' => $email, 'password' => $password, 'usertype' => $usertype, 'status' => 1 ))->row()->vendorid; 
        //$query = "SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND dateofvisit='date(now())' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'";
        $getflag = $this->db->query("SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND vendorid='$vendorid' AND dateofvisit='$dt' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'");
       
        
        if($getflag->num_rows()>0)
        {
            $vdata = array(
              'visitorstatus'=>'visited',
              'flag' => '1'
            );
            $this->db->update('tblbookings', $vdata, array('ticketnumber' => $tckno));
            echo "true";
        }else{
            echo "false";
        } 
    } */

    public function updateticket()
    {
        $tckno=$this->input->post('tkno');
        $dt = date('Y-m-d');
        $vendorid = $this->session->userdata('vendorid');
        
        //$query = "SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND dateofvisit='date(now())' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'";
        $getflag = $this->db->query("SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND vendorid='$vendorid' AND dateofvisit='$dt' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'");
       
        
        if($getflag->num_rows()>0)
        {
            $vdata = array(
              'visitorstatus'=>'visited',
              'flag' => '1'
            );
            $this->db->update('tblbookings', $vdata, array('ticketnumber' => $tckno));
            //echo "true";
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">Ticket Valid</div>');
            redirect('staff/dashboard');
        }else{
            //echo "false";
            $this->session->set_flashdata('success','<div class="alert alert-danger text-center">Ticket Invalid</div>');
            redirect('staff/dashboard');
        } 
    }
    

}

?>
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
            redirect('staff/dashboard');
        }
    } 

    public function dashboard()
    {
        $vendorid = $this->session->userdata('vendorid');
        $this->load->view('staff/dashboard');
    }

    public function logout()
    {
      if (!$this->session->userdata('email')) 
              redirect('staff/login');
        $this->load->view('staff/logout');
    }

 

    public function updateticket()
    {
        $tckno=$this->input->post('ticketno');
        $dt = date('Y-m-d');
        //$query = "SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND dateofvisit='date(now())' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'";
        $getflag = $this->db->query("SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND dateofvisit='$dt' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'");
       
        
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
    }
    

}

?>
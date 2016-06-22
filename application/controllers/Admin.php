<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public $imagename="";
  public $filepath="";

	 /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    function __construct(){
        parent::__construct();
	      date_default_timezone_set('Asia/Calcutta');
        $this->load->model('Adminmodel');
		    $this->load->library('image_lib');
        $this->load->helper(array('form', 'url'));

    }
    
    public function index()
    {
      error_reporting(0);
      $this->load->view('admin/login');
    }
    
	public function login()
	{
    error_reporting(0);
		$this->load->view('admin/login');
	}

  public function outstandingreports($vendorid=''){


    
     if (!$this->session->userdata('username')) 
       redirect('admin/login');
      //echo $vendorid."<br>";
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName(); 
        $data['vendorb']=$this->Adminmodel->getVendorsBooking($vendorid);
        //$this->load->view('admin/vbookings',$data);

        if ($vendorid=="all") {
         $data['transactions']=$this->Adminmodel->getVendorOutStandingTransactions();
        }else{

          $data['transactions']=$this->Adminmodel->getVendorOutStandingTransactionsOnVendorId($vendorid);

        }

      

      
      $this->load->view('admin/outstandingreports',$data);

    }


    public function deletesliderid()
    {
      $id = $this->input->post('uid');
      $query = $this->db->query("SELECT * FROM tblsliders WHERE sid='$id'");
        foreach ($query->result() as $k) 
        {
          $photoname = $k->image;
          // unlink photo //
          $file = "assets/sliderimages/".$photoname."";
          
          if (is_readable($file) && unlink($file)) {
              $this->db->delete('tblsliders', array('sid' => $id));
              $this->session->set_flashdata('success','<div class="alert alert-success text-center">The file has been deleted</div>');
          } else {
              $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The file was not found or not readable and could not be deleted</div>');
          }

          // unlink photo //
        }
    }



    public function vendorcomissionreports($vendorid='',$fromdate='',$todate=''){


    
     if (!$this->session->userdata('username')) 
       redirect('admin/login');
      //echo $vendorid."<br>";
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName(); 
        $data['vendorb']=$this->Adminmodel->getVendorsBooking($vendorid);
        //$this->load->view('admin/vbookings',$data);

        if ($vendorid=="all") {
         $data['transactions']=$this->Adminmodel->getVendorCommissionReportAll($fromdate,$todate);
        }else{

          $data['transactions']=$this->Adminmodel->getVendorCommissionReportOnVendorId($vendorid,$fromdate,$todate);

        }

      

      
      $this->load->view('admin/vendorcomissionreports',$data);

    }



	public function submitlogin()
  {
    error_reporting(0);
    $username = $this->input->post('username');
    //echo $username."<br>";
    $password = $this->input->post('password');
    $usertype = $this->input->post('usertype');
    $numberOfRows=$this->Adminmodel->checkLoginCredentials($username,$password,$usertype);

    if ($usertype=="admin") {
      //echo "Number of Rows".$numberOfRows;
      if ($numberOfRows<1) {
          $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The Username & Password doesnt match. Try again!!!</div>');
          $this->load->view('admin/login');
      }else{
           $this->session->set_userdata('username',$username);
           redirect('admin/dashboard');
      }   
    } else {
      $vendorlogin=$this->Adminmodel->checkVendorLoginCredentials($username,$password);
      // echo "Number of Rows".$numberOfRows;
      if ($vendorlogin<1) {
          $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The Username & Password doesnt match. Try again!!!</div>');
          $this->load->view('admin/login');
      }else{
           $this->session->set_userdata('username',$username);
           redirect('vendor/dashboard');
      }
    }
  }


	public function dashboard()
	{
    error_reporting(0);
    if (!$this->session->userdata('username')) 
       redirect('admin/login');
 
      $this->load->view('admin/dashboard');
    		
	}

    public function staff()
    {
      error_reporting(0);
      if (!$this->session->userdata('username')) 
       redirect('admin/login');

        $this->load->view('admin/createstaff');
    }

    public function submitstaff()
    {
      error_reporting(0);
      if (!$this->session->userdata('username')) 
       redirect('admin/login');

        if (isset($_POST["username"])!="")
        {
            $name = $this->input->post('name');
            //echo '<h3>name is :</h3>'.$name;
            $username = $this->input->post('username');
            //echo '<h3>username is :</h3>'.$username;
            $password = $this->input->post('password');
            //echo '<h3>password is :</h3>'.$password;
            $mobile = $this->input->post('mobile');
            //echo '<h3>mobile is :</h3>'.$mobile;

            $usertype = "member";

            $ip = $_SERVER['REMOTE_ADDR'];

            $data = array(
                 'name'=> $name,
                 'username'=> $username,
                 'password' => $password,
                 'mobile' => $mobile,
                 'ip'=> $ip,
                 'usertype'=> $usertype
                 
            );

            $this->db->insert('staff_login', $data);
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">created Member Successfully.</div>');
            redirect('admin/staff'); 
        }
        
    }

    public function validate_image() {
      error_reporting(0);
      $config['upload_path']   = './assets/package';
      $config['allowed_types'] = 'gif|jpg|png';
  
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('userfile'))
    {
        $this->form_validation->set_message('validate_image',$this->upload->display_errors());
        return false;
    } else {
        $imageInformation = $this->upload->data();
        $this->imagename = $imageInformation['file_name'];
        $this->filepath = $imageInformation['file_path'];
        return true;

    }
}
    

    public function submitPackages(){
      
         if (!$this->session->userdata('username')) 
              redirect('admin/login');

             //$this->form_validation->set_rules("resortname", "Resortname", "trim|required");
             //$this->form_validation->set_rules("vendorname", "Vendorname", "trim|required");
             $this->form_validation->set_rules("packagename", "packagename", "trim|required");
             //$this->form_validation->set_rules("description", "description", "trim|required");
             //$this->form_validation->set_rules("amount", "amount", "trim|required");
             //$this->form_validation->set_rules("servicetax", "servicetax", "trim|required");
             //$this->form_validation->set_rules("packagetype", "packagetype", "trim|required");
             $this->form_validation->set_rules('userfile','Product Image','callback_validate_image');


             if ($this->form_validation->run() == FALSE)
                    {  

                        $data['resortData'] = $this->Adminmodel->getCompleteResortsData();
                        $data['eventsData'] = $this->Adminmodel->getCompleteEventsData();
                        $vendorsdata = $this->Adminmodel->getVendorsData();
                        $data['vendorData'] = $vendorsdata->result();                       
                        $this->load->view('admin/addpackages',$data);
                        //redirect('admin/addpackages');
                        //validation fails

                    }else{
                            //all validations correct
                        //echo "true ".$this->filepath."<br>";
                        $resortname = $this->input->post('resortname');
                        $vendorname = $this->input->post('vendorname');
                        $packagename = $this->input->post('packagename');
                        $description = $this->input->post('description');
                        $adultprice = $this->input->post('aprice');
                        $childprice = $this->input->post('cprice');
                        $expirydate = $this->input->post('expirydate');
                        $tags = $this->input->post('tags');
                        $packagetype = $this->input->post('packagetype');
                        $eventname = $this->input->post('eventname');
                       

                        $data = array(
                           'resortid' => $resortname,
                           'vendorid' => $vendorname,
                           'packagename' => $packagename,
                           'description' => $description,
                           'adultprice' => $adultprice,
                           'childprice' => $childprice,
                           'status' => '1',
                           'createdby' => '1',
                           'createdon' => date('Y-m-d h:i:s'),
                           'updatedby' => 'admin',
                           'updatedon' => date('Y-m-d h:i:s'),
                           'expirydate' => $expirydate,
                           'packageimage' => $this->imagename,
                           'packagetags' => $tags,
                           'packagetype' => $packagetype,
                           'eventid'    =>  $eventname
                        );

                            $this->db->insert('tblpackages', $data); 

                            $this->session->set_flashdata('success','<div class="alert alert-success text-center">Package Created</div>');

                            redirect('admin/addpackages');


                        }


    }


    public function updatePackageData(){
      error_reporting(0);
      if (!$this->session->userdata('username')) 
      redirect('admin/login');

      //$this->form_validation->set_rules("resortname", "Resortname", "trim|required");
      //$this->form_validation->set_rules("vendorname", "Vendorname", "trim|required");
      //$this->form_validation->set_rules("packagename", "packagename", "trim|required");
      //$this->form_validation->set_rules("description", "description", "trim|required");
      //$this->form_validation->set_rules("amount", "amount", "trim|required");
      //$this->form_validation->set_rules("servicetax", "servicetax", "trim|required");
      //$this->form_validation->set_rules("packagetype", "packagetype", "trim|required");
      $this->form_validation->set_rules('userfile','Product Image','callback_validate_image');


      if ($this->form_validation->run() == FALSE)
      {  

            $data['packageid'] = $this->input->post('packageid');
           $data['packageData'] = $this->Adminmodel->getSpecificPackageData( $this->input->post('packageid'));
           $data['resortData'] = $this->Adminmodel->getCompleteResortsData();
           $data['eventsData'] = $this->Adminmodel->getCompleteEventsData();
          $vendorsdata = $this->Adminmodel->getVendorsData();
          $data['vendorData'] = $vendorsdata->result();
          $this->load->view('admin/editpackagedata',$data);
          //validation fails

      }else{
        
              //all validations correct
          //echo "true ".$this->filepath."<br>";
          $packageid = $this->input->post('packageid');
          //echo $packageid."<br>";
          $resortname = $this->input->post('resortname');
          //echo $resortname."<br>";
          $vendorname = $this->input->post('vendorname');
          //echo $vendorname."<br>";
          $packagename = $this->input->post('packagename');
          //echo $packagename."<br>";
          $description = $this->input->post('description');
          //echo $description."<br>";
          $adultprice = $this->input->post('aprice');
          //echo $adultprice."<br>";
          $childprice = $this->input->post('cprice');
          //echo $childprice."<br>";
          $servicetax = $this->input->post('servicetax');
          //echo $servicetax."<br>";
          $tags = $this->input->post('tags');
          //echo $tags."<br>";
          $packagetype = $this->input->post('packagetype');
          //echo $packagetype."<br>";
          $eventname = $this->input->post('eventname');
          //echo $eventname."<br>";

         

          $data = array(
                 'resortid' => $resortname ,
                 'vendorid' => $vendorname ,
                 'packagename' => $packagename ,
                 'description' => $description ,
                 'adultprice' => $adultprice,
                 'childprice' => $childprice,
                 'status' => '1' ,
                 'createdby' => '1' ,
                 'createdon' => date('Y-m-d h:i:s') ,
                 'updatedby' => 'admin' ,
                 'updatedon' => date('Y-m-d h:i:s') ,
                 'servicetax' => $servicetax ,
                 'packageimage' => $this->imagename ,
                 'packagetags' => $tags ,
                 'packagetype' => $packagetype ,
                 'eventid'    =>  $eventname
              );

              $this->db->where('packageid', $this->input->post('packageid'));
              $this->db->update('tblpackages', $data); 

              $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');

              $redirectUrL = 'admin/addpackages';

              redirect($redirectUrL);
             

          }


    }

	public function addvendors()
	{
    error_reporting(0);
    if (!$this->session->userdata('username')) 
       redirect('admin/login');

    $data['results'] = $this->Adminmodel->getVendorsData();
		
		$this->load->view('admin/addvendors',$data);
	}


  public function vbookings($vendorid='')
  {
    error_reporting(0);
     if (!$this->session->userdata('username')) 
       redirect('admin/login');
      //echo $vendorid."<br>";
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName(); 
        $data['vendorb']=$this->Adminmodel->getVendorsBooking($vendorid);
        $this->load->view('admin/vbookings',$data);

  }

  

  public function addpackages()
  {
    error_reporting(0);
    if (!$this->session->userdata('username')) 
       redirect('admin/login');

    $data['resortData'] = $this->Adminmodel->getCompleteResortsData();
    $data['eventsData'] = $this->Adminmodel->getCompleteEventsData();
    $vendorsdata = $this->Adminmodel->getVendorsData();
    $data['vendorData'] = $vendorsdata->result();
    $data['packages'] = $this->Adminmodel->getCompletePackagesData();
    $this->load->view('admin/addpackages',$data);
  }


  public function editpackagedata($packageid='')
  {
    error_reporting(0);
    if (!$this->session->userdata('username')) 
       redirect('admin/login');

    $data['packageid'] = $packageid;
    $data['packageData'] = $this->Adminmodel->getSpecificPackageData($packageid);
    $data['resortData'] = $this->Adminmodel->getCompleteResortsData();
    $data['eventsData'] = $this->Adminmodel->getCompleteEventsData();
    $vendorsdata = $this->Adminmodel->getVendorsData();
    $data['vendorData'] = $vendorsdata->result();
    $this->load->view('admin/editpackagedata',$data);
  }

    public function addevents()
    {
      
      if (!$this->session->userdata('username')) 
       redirect('admin/login');
        //get vendors data
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
        $data['events'] = $this->Adminmodel->getEventsData();
        $this->load->view('admin/addevents',$data);
    }

    public function addresorts()
    {
      error_reporting(0);
      if (!$this->session->userdata('username')) 
       redirect('admin/login');
        //get vendors data
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
        $data['results'] = $this->Adminmodel->getResortData();
        $this->load->view('admin/addresorts',$data);
    }

    public function updateresorts($resortid='')
    {
      error_reporting(0);
      if (!$this->session->userdata('username')) 
       redirect('admin/login');
      $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
      $data['resortid']=$resortid;
      $this->load->view('admin/updateresorts',$data);
    }

    public function submitupdateresorts()
    {
      error_reporting(0);
      $resortid = $this->input->post('resortid');
      $vendorid = $this->input->post('vendorid');
      $resortname = $this->input->post('resortname');
      $location = $this->input->post('location');
      $description = $this->input->post('description');
      $latitude = $this->input->post('latitude');
      $longitude = $this->input->post('longitude');
      
      $data = array(

         'vendorid'=> $vendorid,
         'resortname'=> $resortname,
         'location' => $location,
         'description' => $description,
         'updatedby' =>'admin',
         'latitude' => $latitude,
         'longitude' => $longitude,
         'updatedon' => date('Y-m-d h:i:s')
           
      );
      $this->db->where('resortid', $resortid);
      $this->db->update('tblresorts', $data);
      $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');
      redirect('admin/addresorts');
      

    }

    public function submitvendordata(){
        if (!$this->session->userdata('username')) 
       redirect('admin/login');
        //set rules for vendor form data
        $this->form_validation->set_rules('vname', 'Vendor Name', 'required');
        $this->form_validation->set_rules('cperson', 'Contact Person', 'required');
        $this->form_validation->set_rules('address1', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        //$this->form_validation->set_rules('latitude', 'latitude', 'required');
        //$this->form_validation->set_rules('longitude', 'longitude', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        


        if ($this->form_validation->run() == FALSE)
        {   
            $this->load->view('admin/addvendors');

        }else{
            $vname = $this->input->post('vname');
            $cperson = $this->input->post('cperson');
            $address1 = $this->input->post('address1');
            $address2 = $this->input->post('address2');
            $city = $this->input->post('city');
            $pincode = $this->input->post('pincode');
            $landline = $this->input->post('landline');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $description = $this->input->post('description');
            $websitelink = $this->input->post('websitelink');
            $vname = $this->input->post('vname');
            $vname = $this->input->post('vname');

            //check if email and mobile exists before inserting
            $numberOfRows = $this->Adminmodel->checkIfEmailOrPhoneExistsInVendorTable($email,$mobile);
            if($numberOfRows>=1){
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Email Id or Phone Already exists. Please choose another</div>');
                $this->load->view('admin/addvendors');
            }else{
                //insert data into database


                $data = array(
                   'vendorname' => $vname,
                   'contact_person' => $cperson,
                   'Address1' => $address1,
                   'Address2' => $address2,
                   'city' => $city,
                   'pincode' => $pincode,
                   'landline' => $landline,
                   'mobile' => $mobile,
                   'email' => $email,
                   'password' => $password,
                   'latitude' => $latitude,
                   'longitude' => $longitude,
                   'description' => $description,
                   'website' => $websitelink,
                   'createdon' => date('Y-m-d h:i:s'),
                   'updateon' => date('Y-m-d h:i:s'),
                   'status' => 1

                );

                $this->db->insert('tblvendors', $data);
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Inserted Successfully</div>');
                redirect('admin/addvendors');
            }
            

        }


    }

    public function submiteventdata(){
      if (!$this->session->userdata('username')) 
       redirect('admin/login');

        //set rules for vendor form data
        $this->form_validation->set_rules('vendorid', 'Vendor Name', 'required');
        //$this->form_validation->set_rules('eventdate', 'Event Date', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        //$this->form_validation->set_rules('time', 'Time', 'required');
        //$this->form_validation->set_rules('eventname', 'Event Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        
        $data2['vendors']=$this->Adminmodel->getVendorsIdAndName();

        if ($this->form_validation->run() == FALSE)
        {   
            
            $this->load->view('admin/addevents',$data2);

        }else{
            $vendorid = $this->input->post('vendorid');
            $eventodate = $this->input->post('eventodate');
            $evenfromdate = $this->input->post('evenfromdate');
            $location = $this->input->post('location');
            $totime = $this->input->post('totime');
            $fromtime = $this->input->post('fromtime');
            $eventname = $this->input->post('eventname');
            $description = $this->input->post('description');
            $eventtype = $this->input->post('eventtype');
            $cost = $this->input->post('cost');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            

            //check if email and mobile exists before inserting
            //$numberOfRows = $this->Adminmodel->checkIfEmailOrPhoneExistsInVendorTable($email,$mobile);
            
                
               
                $data = array(
                   'vendorid' => $vendorid,
                   'todate' => $eventodate,
                   'fromdate' => $evenfromdate,
                   'location' => $location,
                   'totime' => $totime,
                   'fromtime' => $fromtime,
                   'eventname' => $eventname,
                   'description' => $description,
                   'eventtype' => $eventtype,
                   
                   'latitude' => $latitude,
                   'longitude' => $longitude,
                   'status' => 1

                );

                $this->db->insert('tblevents', $data);
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Inserted Successfully</div>');
                redirect('admin/addevents',$data2);
            }
            

        }



      public function submitresortsdata(){

        if (!$this->session->userdata('username')) 
       redirect('admin/login');

                //set rules for vendor form data
        $this->form_validation->set_rules('resortname', 'Resort Name', 'required');
        
        $this->form_validation->set_rules('location', 'Location', 'required');
        
        $this->form_validation->set_rules('description', 'Description', 'required');

        
        $data2['vendors']=$this->Adminmodel->getVendorsIdAndName();

        if ($this->form_validation->run() == FALSE)
        {   
            
            $this->load->view('admin/addresorts',$data2);

        }else{
            $vendorid = $this->input->post('vendorid');
            $resortname = $this->input->post('resortname');
            $location = $this->input->post('location');
            $description = $this->input->post('description');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');

            

            //check if email and mobile exists before inserting
            //$numberOfRows = $this->Adminmodel->checkIfEmailOrPhoneExistsInVendorTable($email,$mobile);
            
                //$time = $eventdate." ".$time;
               
                $data = array(
                   'vendorid' => $vendorid,
                   'resortname' => $resortname,
                   'location' => $location,
                   'description' => $description,
                   'createdby' =>'admin',
                   'createdon' => date('Y-m-d h:i:s'),
                   'latitude' => $latitude,
                   'longitude' => $longitude,
                   'status' => 1

                );

                $this->db->insert('tblresorts', $data);
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Resort Inserted Successfully</div>');
                redirect('admin/addresorts',$data2);
            }



      }

    


     public function updateVendorsData()
    {
          if (!$this->session->userdata('username')) 
              redirect('admin/login');

            $vendorid = $this->input->post('vendorid');
            $vname = $this->input->post('vname');
            $cperson = $this->input->post('cperson');
            $address1 = $this->input->post('address1');
            $address2 = $this->input->post('address2');
            $city = $this->input->post('city');
            $pincode = $this->input->post('pincode');
            $landline = $this->input->post('landline');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $websitelink = $this->input->post('websitelink');
            $vname = $this->input->post('vname');
            $vname = $this->input->post('vname');

            //check if email and mobile exists before inserting
            $numberOfRows = $this->Adminmodel->checkIfEmailOrPhoneExistsInVendorTable($email,$mobile);
            if($numberOfRows>=1){
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Email Id or Phone Already exists. Please choose another</div>');
                redirect('admin/vendorsdata');
            }else{
                //insert data into database
                $data = array(
                   'vendorname' => $vname,
                   'contact_person' => $cperson,
                   'Address1' => $address1,
                   'Address2' => $address2,
                   'city' => $city,
                   'pincode' => $pincode,
                   'landline' => $landline,
                   'website' => $websitelink,
                   'createdon' => date('Y-m-d h:i:s'),
                   'updateon' => date('Y-m-d h:i:s'),
                   'status' => 1,
                   'updateon' => date('Y-m-d h:i:s')

                );

                $this->db->where('vendorid', $vendorid);
                $this->db->update('tblvendors', $data);
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');
                //echo "true";
                redirect('admin/addvendors');
            }
           
       
    }

     public function updateEventsData($eventid='')
    {

      if (!$this->session->userdata('username')) 
              redirect('admin/login');

            $vendorid = $this->input->post('vendorid');
            $eventodate = $this->input->post('eventodate');
            $evenfromdate = $this->input->post('evenfromdate');
            $location = $this->input->post('location');
            $totime = $this->input->post('totime');
            $fromtime = $this->input->post('fromtime');
            $eventname = $this->input->post('eventname');
            $description = $this->input->post('description');
            $eventtype = $this->input->post('eventtype');
            $cost = $this->input->post('cost');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');


            
            
          
                $time = $eventdate." ".$time;
               
                $data = array(
                   'vendorid' => $vendorid,
                   'todate' => $eventodate,
                   'fromdate' => $evenfromdate,
                   'location' => $location,
                   'totime' => $totime,
                   'fromtime' => $fromtime,
                   'eventname' => $eventname,
                   'description' => $description,
                   'eventtype' => $eventtype,
                   
                   'latitude' => $latitude,
                   'longitude' => $longitude,
                   'status' => 1

                );

                $this->db->where('eventid', $vendorid);
                $this->db->update('tblevents', $data);
                $data['results'] = $this->Adminmodel->getEventsData();
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');
                redirect('admin/addevents',$data);
        
        //$this->load->view('admin/vendorsdata',$data);
    }


    public function vendorsdata()
    {
        if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['results'] = $this->Adminmodel->getVendorsData();
        
        $this->load->view('admin/vendorsdata',$data);
    }

    public function packagesdata()
    {
        if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['packages'] = $this->Adminmodel->getCompletePackagesData();
        
        $this->load->view('admin/packagesdata',$data);
    }

    public function eventsdata()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['results'] = $this->Adminmodel->getEventsData();
        
        $this->load->view('admin/eventsdata',$data);
    }

    

    public function paymentsdata()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['results'] = $this->Adminmodel->getPaymentsData();
        
        $this->load->view('admin/paymentsdata',$data);
    }

    public function resortsdata()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['results'] = $this->Adminmodel->getResortData();
        
        $this->load->view('admin/resortsdata',$data);
    }

    public function addsliders()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
      
      $data['results'] = $this->Adminmodel->getSlidersData();
      $this->load->view('admin/addsliders',$data);
    }

    public function submiteditaddslider()
    {
      $name = $this->input->post('name');
      $title = $this->input->post('title');
      $subtitle = $this->input->post('subtitle');
      $link = $this->input->post('link');
      $expirydate = $this->input->post('expirydate');
      $sid = $this->input->post('sid');
      $data = array(
         'name' => $name ,
         'title' => $title ,
         'subtitle' => $subtitle,
         'link' => $link,
         'expirydate' => $expirydate,
         'updatedby' => 'admin',
         'updatedon' => date('Y-m-d h:i:s'),
         
      );
      $this->db->where('sid', $sid);
      $this->db->update('tblsliders', $data); 

      $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');

      redirect('admin/addsliders');

    }

    

    public function editaddslider()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
      
      $this->load->view('admin/editaddslider');
    }

    

    public function addplaces()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
      
      $data['results'] = $this->Adminmodel->getPlacesData();
      $this->load->view('admin/addplaces',$data);
    }

    public function submitplaces()
    {
      $pname = $this->input->post('pname');
      $longitude = $this->input->post('longitude');
      $latitude = $this->input->post('latitude');
      $description = $this->input->post('description');
      $city = $this->input->post('city');
      $address = $this->input->post('address');
      $oinfo = $this->input->post('oinfo');
      
      /*
      // multiple image upload  starts //
                
        $this->load->helper('form');
        $data = array();
        $data['title'] = 'Multiple file upload';
        if($this->input->post())
        {
            // retrieve the number of images uploaded;
            $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
            // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
            $files = $_FILES['uploadedimages'];
            $errors = array();
            // first make sure that there is no error in uploading the files
            for($i=0;$i<$number_of_files;$i++)
            {
              if($_FILES['uploadedimages']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['uploadedimages']['name'][$i];
            }
            if(sizeof($errors)==0)
            {
              // now, taking into account that there can be more than one file, for each file we will have to do the upload
              // we first load the upload library
              $this->load->library('upload');
              // next we pass the upload path for the images
              
              $config['upload_path'] = './assets/places';
              // also, we make sure we allow only certain type of images
              $config['allowed_types'] = 'gif|jpg|png';
              for ($i = 0; $i < $number_of_files; $i++) {
                $_FILES['uploadedimage']['name'] = $files['name'][$i];
                $_FILES['uploadedimage']['type'] = $files['type'][$i];
                $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['uploadedimage']['error'] = $files['error'][$i];
                $_FILES['uploadedimage']['size'] = $files['size'][$i];
                //now we initialize the upload library
                $this->upload->initialize($config);
                // we retrieve the number of files that were uploaded
                if ($this->upload->do_upload('uploadedimage'))
                {

                  $data['uploads'][$i] = $this->upload->data();
                  $filename = $data['uploads'][$i]['file_name'];
                  //echo "filename"." ".$filename."<br>";
                  $insertedon = date("Y-m-d");
                  //echo '<h3>insertedon is :</h3>'.$insertedon;
                  $placename = $this->input->post('pname');
                  //echo '<h3>profileid is :</h3>'.$profileid;
                  
                          
                          
                  $data = array(
                     'place'=> $placename,
                     'photoname' => $filename,
                     'path' => base_url().'assets/places/'.$filename,
                     'status'=> 1
                     
                  );
                                          
                  $this->session->set_userdata($data);

                  $this->db->insert('tblplacesphotos', $data);
                  

                }
                else
                {
                  $data['upload_errors'][$i] = $this->upload->display_errors();
                }
              }
            }
            else
            {
              print_r($errors);
            }
            
        }*/
        

        // multiple image upload ends // 

          $data = array(
             'place' => $pname ,
             'longitude' => $longitude ,
             'latitude' => $latitude,
             'city' => $city,
             'address' => $address,
             'otherinfo' => $oinfo,
             'createdby' => 'admin',
             'createdon' => date('Y-m-d h:i:s'),
             'status' =>1,
             'description' => $description
          );

          $this->db->insert('tblplaces', $data); 
          $this->session->set_flashdata('success','<div class="alert alert-success text-center">Places Created</div>');
          redirect('admin/addplaces');

    }

    public function editaddplaces()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
      
      $this->load->view('admin/editaddplaces');
    }

    public function submiteditaddplaces()
    {
      $plid = $this->input->post('plid');
      $pname = $this->input->post('pname');
      $longitude = $this->input->post('longitude');
      $latitude = $this->input->post('latitude');
      $description = $this->input->post('description');
      $city = $this->input->post('city');
      $address = $this->input->post('address');
      $oinfo = $this->input->post('oinfo');
      $data = array(
         'place' => $pname ,
         'longitude' => $longitude ,
         'latitude' => $latitude,
         'city' => $city,
         'address' => $address,
         'otherinfo' => $oinfo,
         'updatedby' => 'admin',
         'updatedon' => date('Y-m-d h:i:s'),
         'description' => $description
      );
      $this->db->where('plid', $plid);
      $this->db->update('tblplaces', $data); 

      $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');

      redirect('admin/addplaces');
    }

    public function deleteplacesid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $id = $this->input->post('uid');
        $this->db->delete('tblplaces', array('plid' => $id));
        $this->session->set_flashdata('success','<div class="alert alert-success text-center">Deleted Record Successfully</div>');
        redirect('admin/addplaces');
    }

    public function addplacesphotos()
    {
       if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $this->load->view('admin/addplacesphotos');
    }

    public function uploadplacespics()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        
        $plid = $this->input->post('plid');
        //echo $_FILES['userfile']['name'];
        //$count = count($_FILES['userfile']['name']);
        //echo "<br>".$count;
        //echo FCPATH."<br>";
        $config = array(
            'upload_path'   => FCPATH.'/assets/places',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'  => 1,
        );

        $this->load->library('upload', $config);
        //echo "<pre>";
        //print_r( $_FILES);
        foreach ($_FILES as $key => $value) {
            
            for ($i=0; $i < count($value['name']); $i++) { 
                //echo $value['name'][$i]."<br>";
                $_FILES['file']['name']     = $value['name'][$i];
                $_FILES['file']['type']     = $value['type'][$i];
                $_FILES['file']['tmp_name'] = $value['tmp_name'][$i];
                $_FILES['file']['error']    = $value['error'][$i];
                $_FILES['file']['size']     = $value['size'][$i]; 

               if ($this->upload->do_upload('file')) {
                /*
                   print "<hr>";
            print '<h3>Rewritten $_FILES array number #'.$i.':</h3>';
            print "<pre>" . print_r($_FILES, true) . "</pre>";
            print "<h3>Upload data:</h3>";
            print "<pre>" . print_r($this->upload->data(), true) . "</pre>";
            print "<h3>Errors:</h3>";
            print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
            */
                //insert image names in database
            $data2 = array(
                       'plid' => $plid ,
                       'photoname' => $value['name'][$i] ,
                       'path' => base_url().'assets/places/'.$value['name'][$i],
                       'status' => 1
                    );

                    $this->db->insert('tblplacesphotos', $data2); 
                    
                    
                 } else {
                    //print "<h3>Errors:</h3>";
                    //print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
                 }
                   

            }

        }//end of for each loop
        //get vendors data
        $this->session->set_flashdata('success','<div class="alert alert-success text-center">The image has been Uploaded</div>');
        
        redirect('admin/addplacesphotos/'.$plid.'',$data);
    }
    

    public function deleteplaceimages()
    {
      $id = $this->input->post('uid');


      $query = $this->db->query("SELECT * FROM tblplacesphotos WHERE pphotoid='$id'");
      foreach ($query->result() as $k) 
      {
        $photoname = $k->photoname;
        // unlink photo //
        $file = "assets/places/".$photoname."";
        
        if (is_readable($file) && unlink($file)) {
            $this->db->delete('tblplacesphotos', array('pphotoid' => $id));
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">The image has been deleted</div>');
        } else {
            $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The image was not found or not readable and could not be deleted</div>');
        }

        // unlink photo //
      }
      
    }



    public function addvendorphotos($vendorid='')
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['vendorid']=$vendorid;
        $this->load->view('admin/addvendorphotos',$data);
    }

    public function addeventphotos($eventid='')
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['eventid']=$eventid;
        $this->load->view('admin/addeventphotos',$data);
    }
    
    public function deleteeventimages()
    {
      $id = $this->input->post('uid');


      $query = $this->db->query("SELECT * FROM tbleventphotos WHERE photoid='$id'");
      foreach ($query->result() as $k) 
      {
        $photoname = $k->photoname;
        // unlink photo //
        $file = "assets/eventimages/".$photoname."";
        
        if (is_readable($file) && unlink($file)) {
            $this->db->delete('tbleventphotos', array('photoid' => $id));
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">The file has been deleted</div>');
        } else {
            $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The file was not found or not readable and could not be deleted</div>');
        }

        // unlink photo //
      }
      
    }


    public function addresortphotos($resortid='')
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $data['resortid']=$resortid;
        $this->load->view('admin/addresortphotos',$data);
    }


    public function deleteresortimages()
    {
      $id = $this->input->post('uid');
      


      $query = $this->db->query("SELECT * FROM tblresorphotos WHERE rphotoid='$id'");
      foreach ($query->result() as $k) 
      {
        $photoname = $k->photoname;
        // unlink photo //
        $file = "assets/resortimages/".$photoname."";
        
        if (is_readable($file) && unlink($file)) {
            $this->db->delete('tblresorphotos', array('rphotoid' => $id));
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">The file has been deleted</div>');
        } else {
            $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The file was not found or not readable and could not be deleted</div>');
        }

        // unlink photo //
      }
      
    }

    public function uploadvendorpics($vendorid='')
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        //echo $_FILES['userfile']['name'];
        //$count = count($_FILES['userfile']['name']);
        //echo "<br>".$count;
        //echo FCPATH."<br>";
        $config = array(
            'upload_path'   => FCPATH.'/assets/uploads',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'  => 1,
        );

        $this->load->library('upload', $config);
        //echo "<pre>";
        //print_r( $_FILES);
        foreach ($_FILES as $key => $value) {
            
            for ($i=0; $i < count($value['name']); $i++) { 
                //echo $value['name'][$i]."<br>";
                $_FILES['file']['name']     = $value['name'][$i];
                $_FILES['file']['type']     = $value['type'][$i];
                $_FILES['file']['tmp_name'] = $value['tmp_name'][$i];
                $_FILES['file']['error']    = $value['error'][$i];
                $_FILES['file']['size']     = $value['size'][$i]; 

               if ($this->upload->do_upload('file')) {
                /*
                   print "<hr>";
            print '<h3>Rewritten $_FILES array number #'.$i.':</h3>';
            print "<pre>" . print_r($_FILES, true) . "</pre>";
            print "<h3>Upload data:</h3>";
            print "<pre>" . print_r($this->upload->data(), true) . "</pre>";
            print "<h3>Errors:</h3>";
            print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
            */
                //insert image names in database
            $data2 = array(
                       'vendorid' => $vendorid ,
                       'photoname' => $value['name'][$i] ,
                       'path' => base_url().'assets/vendorimages/'.$value['name'][$i],
                       'status' => 1
                    );

                    $this->db->insert('tblvendorphotos', $data2); 
                    
                    
                 } else {
                    //print "<h3>Errors:</h3>";
                    //print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
                 }
                   ;

            }

        }//end of for each loop
        $data['vendorid']=$vendorid;
        $this->load->view('admin/addvendorphotos',$data);
    }

    
    public function deletevendorimages()
    {
      $id = $this->input->post('uid');


      $query = $this->db->query("SELECT * FROM tblvendorphotos WHERE vphotoid='$id'");
      foreach ($query->result() as $k) 
      {
        $photoname = $k->photoname;
        // unlink photo //
        $file = "assets/vendorimages/".$photoname."";
        
        if (is_readable($file) && unlink($file)) {
            $this->db->delete('tblvendorphotos', array('vphotoid' => $id));
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">The file has been deleted</div>');
        } else {
            $this->session->set_flashdata('success','<div class="alert alert-danger text-center">The file was not found or not readable and could not be deleted</div>');
        }

        // unlink photo //
      }
      
    }

    public function uploadresortpics($resortid='')
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        //echo $_FILES['userfile']['name'];
        //$count = count($_FILES['userfile']['name']);
        //echo "<br>".$count;
        //echo FCPATH."<br>";
        $config = array(
            'upload_path'   => FCPATH.'/assets/resortimages',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'  => 1,
        );

        $this->load->library('upload', $config);
        //echo "<pre>";
        //print_r( $_FILES);
        foreach ($_FILES as $key => $value) {
            
            for ($i=0; $i < count($value['name']); $i++) { 
                //echo $value['name'][$i]."<br>";
                $_FILES['file']['name']     = $value['name'][$i];
                $_FILES['file']['type']     = $value['type'][$i];
                $_FILES['file']['tmp_name'] = $value['tmp_name'][$i];
                $_FILES['file']['error']    = $value['error'][$i];
                $_FILES['file']['size']     = $value['size'][$i]; 

               if ($this->upload->do_upload('file')) {
                /*
                   print "<hr>";
            print '<h3>Rewritten $_FILES array number #'.$i.':</h3>';
            print "<pre>" . print_r($_FILES, true) . "</pre>";
            print "<h3>Upload data:</h3>";
            print "<pre>" . print_r($this->upload->data(), true) . "</pre>";
            print "<h3>Errors:</h3>";
            print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
            */
                //insert image names in database
            $data2 = array(
                       'resortid' => $resortid ,
                       'photoname' => $value['name'][$i] ,
                       'path' => base_url().'assets/resortimages/'.$value['name'][$i],
                       'status' => 1
                    );

                    $this->db->insert('tblresorphotos', $data2); 
                    
                    
                 } else {
                    //print "<h3>Errors:</h3>";
                    //print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
                 }
                   ;

            }

        }//end of for each loop
        //get vendors data
        //$data['vendors']=$this->Adminmodel->getVendorsIdAndName();
        $data['resortid']=$resortid;
        $this->load->view('admin/addresortphotos',$data);
    }

    

    public function uploadeventpics($eventid='')
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        //echo $_FILES['userfile']['name'];
        //$count = count($_FILES['userfile']['name']);
        //echo "<br>".$count;
        //echo FCPATH."<br>";
        $config = array(
            'upload_path'   => FCPATH.'/assets/eventimages',
            'allowed_types' => 'jpg|gif|png',
            'overwrite'  => 1,
        );

        $this->load->library('upload', $config);
        //echo "<pre>";
        //print_r( $_FILES);
        foreach ($_FILES as $key => $value) {
            
            for ($i=0; $i < count($value['name']); $i++) { 
                //echo $value['name'][$i]."<br>";
                $_FILES['file']['name']     = $value['name'][$i];
                $_FILES['file']['type']     = $value['type'][$i];
                $_FILES['file']['tmp_name'] = $value['tmp_name'][$i];
                $_FILES['file']['error']    = $value['error'][$i];
                $_FILES['file']['size']     = $value['size'][$i]; 

               if ($this->upload->do_upload('file')) {
                /*
                   print "<hr>";
            print '<h3>Rewritten $_FILES array number #'.$i.':</h3>';
            print "<pre>" . print_r($_FILES, true) . "</pre>";
            print "<h3>Upload data:</h3>";
            print "<pre>" . print_r($this->upload->data(), true) . "</pre>";
            print "<h3>Errors:</h3>";
            print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
            */
                //insert image names in database
            $data2 = array(
                       'eventid' => $eventid ,
                       'photoname' => $value['name'][$i] ,
                       'path' => base_url().'assets/eventimages/'.$value['name'][$i],
                       'status' => 1
                    );

                    $this->db->insert('tbleventphotos', $data2); 
                    
                    
                 } else {
                    //print "<h3>Errors:</h3>";
                    //print "<pre>" . print_r($this->upload->display_errors(), true) . "</pre>";
                 }
                   

            }

        }//end of for each loop
        //get vendors data
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
        $data['eventid']=$eventid;
        $this->load->view('admin/addeventphotos',$data);
    }

    public function orderdetails()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        //pull order details
        $dt['query'] = $this->db->query("SELECT o.oid,o.id,d.id,d.name,d.phone,o.amount,o.totalitems,o.address,o.dt,o.status,o.items,o.orderid FROM orderdetails o left join delivery d ON o.id=d.id ORDER BY o.oid");

        
        $this->load->view('admin/orderdetails',$dt);
    }

    public function updateOrderStatusToDelivered()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
       
       $orderIds = $this->input->post('orderids');
       //print_r($orderIds);

           foreach ($orderIds as $key => $value) {
               //echo $value."<br>";
                $data = array(
                               'status' => 'delivered'
                            );

                $this->db->where('oid', $value);
                $this->db->update('orderdetails', $data); 
           }
           redirect('admin/orderdetails');
    }

	// populating states //

	public function ajaxcountry()
	{
    if (!$this->session->userdata('username')) 
              redirect('admin/login');
        
		$countryid = $this->input->post('country');
		//echo $countryid;

        $id = $this->input->post('uid');
        $query = $this->db->query("SELECT * FROM register WHERE ID='$id'");
        $row = $query->row(); 
        $state = $row->residing_state;
		$states = $this->db->get_where('state' , array('country' => $countryid ));
		//$states = $this->db->get('state_new');
		foreach ($states->result() as $st)
        {   
            if ($st->name==$state) 
            {
                echo '<option selected="selected" style="padding: 3px;border-bottom: solid 1px silver;" value="'.$st->name.'"style="padding: 3px;border-bottom: solid 1px silver;">'.$st->name.'</option>';
            }else{        
                //echo $st->name;
                echo '<option style="padding: 3px;border-bottom: solid 1px silver;" value="'.$st->name.'"style="padding: 3px;border-bottom: solid 1px silver;">'.$st->name.'</option>';
            }
        }
		
	}

	// populating states //

	// populating cities or districts //

	public function ajaxstates()
	{
    if (!$this->session->userdata('username')) 
              redirect('admin/login');
        
		$stateid = $this->input->post('state');
		//echo $stateid;

        $id = $this->input->post('uid');
        $query = $this->db->query("SELECT * FROM register WHERE ID='$id'");
        $row = $query->row(); 
        $district = $row->native_district;

		$districts = $this->db->get_where('cities' , array('state' => $stateid ));
		foreach ($districts->result() as $dt)
        {   
            if ($dt->name==$district) {
               echo '<option selected="selected" style="padding: 3px;border-bottom: solid 1px silver;" value="'.$dt->name.'"style="padding: 3px;border-bottom: solid 1px silver;">'.$dt->name.'</option>';
            }else {      
                //echo $dt->district;
                echo '<option style="padding: 3px;border-bottom: solid 1px silver;" value="'.$dt->name.'"style="padding: 3px;border-bottom: solid 1px silver;">'.$dt->name.'</option>';
            }
        }
		
	}

	// populating cities or districts //

	// populating mandals //
    
    public function ajaxmandals()
	{
        
		$districtid = $this->input->post('district');
		//echo $districtid;

        $id = $this->input->post('uid');
        $query = $this->db->query("SELECT * FROM register WHERE ID='$id'");
        $row = $query->row(); 
        $mandal = $row->mandal;

		$mandals = $this->db->get_where('mandal' , array('district' => $districtid ));
		foreach ($mandals->result() as $md)
        {   
            if ($md->mandalname==$mandal) 
            {
                echo '<option selected="selected" style="padding: 3px;border-bottom: solid 1px silver;" value="'.$md->mandalname.'"style="padding: 3px;border-bottom: solid 1px silver;">'.$md->mandalname.'</option>';
            }else {        
                //echo $dt->district;
                echo '<option style="padding: 3px;border-bottom: solid 1px silver;" value="'.$md->mandalname.'"style="padding: 3px;border-bottom: solid 1px silver;">'.$md->mandalname.'</option>';
            }   
        }
		
	}

	// populating mandals //

	// populating raasi //

	public function ajax_get_raasi1(){
      $birth_star_id=$_REQUEST['birth_star_id'];
      $res=$this->Adminmodel->get_raasi_code('birth_star',$birth_star_id);
      $output=explode(',',$res);
      echo $output['0'];
    }

	// populating raasi //

	// populating education //

	public function ajaxeducation()
    { 
        $edtypeid = $this->input->post('edtype');
        //echo $edtypeid;
        
        $id = $this->input->post('uid');
        $query = $this->db->query("SELECT * FROM register WHERE ID='$id'");
        $row = $query->row(); 
        $education = $row->education;


        $education = $this->db->get_where('education_table' , array('parent_id' => $edtypeid ));
        //$states = $this->db->get('state_new');
        foreach ($education->result() as $ed)
        {    
            if ($ed->education_table_id==$education) {
                echo '<option selected="selected" value="'.$ed->education_table_id.'" style="padding: 3px;border-bottom: solid 1px silver;">'.$ed->education_name.'</option>';
            }else {        
                //echo $st->name;
                echo '<option value="'.$ed->education_table_id.'" style="padding: 3px;border-bottom: solid 1px silver;">'.$ed->education_name.'</option>';
            }
        }
    }

    

	// populating education //

	// check email starts //

	public function checkemail()
	{
		$lemail = $this->input->post('lemail');
        //echo $lemail;
		$email=$this->db->query("select lemail from register where lemail='$lemail'");
        //echo $email->num_rows();
		if($email->num_rows()>0){
			echo '<div style="color:red;">Email ID Already exists.</div>';
		}else{
			echo '<div style="color:green;">Email ID Available.</div>';
		}

	}

	// check email ends //

    

    public function submitregister()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        
    	$this->form_validation->set_rules('itemname', 'Item name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Item description', 'required');
        //$this->form_validation->set_rules('uploadedimages', 'Document', 'required');
    	

    	if ($this->form_validation->run() == FALSE)
        {   ////validation fails
        	//$data['countries'] = $this->db->query("SELECT name FROM country order by id asc");
			//$data['religion'] = $this->db->query("SELECT religion_name FROM religion_table order by religion_table_id asc");
			//$data['birthstar'] = $this->db->query("SELECT s_birth_star FROM birth_star order by s_birth_star");
			//$data['edtype'] =$this->db->query("SELECT *  FROM education_table WHERE parent_id IS NULL");
			//$data['raasi'] = $this->db->get('raasi');
			//$data['occtype'] = $this->db->get('occupation_table');
			$this->load->view('admin/register');

        }else{
            //echo "true";
            $itemname = $this->input->post('itemname');
            $price = $this->input->post('price');
            $description = $this->input->post('description');

            $this->load->library('upload');


            if (!empty($_FILES['uploadedimages']['name']))
            {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';     

                $this->upload->initialize($config);

                if ($this->upload->do_upload('uploadedimages'))
                {
                    $img = $this->upload->data();
                    $file_name = $img['file_name'];

                 
                    $tiffinsData = array(
                       'itemname' => $itemname ,
                       'description' => $description ,
                       'price' => $price,
                       'imagename' => $file_name
                    );

                    $this->db->insert('tiffinitems', $tiffinsData); 
                  

                   
                    $this->load->view('Admin/tiffinitems');
                }
                else
                {
                    echo $this->upload->display_errors();

                }
            }




        }
        
        

    }

    
    
	

    


    public function printdata()
    {
        $this->load->view('admin/printdata');
    }


    public function forgotpassword()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $this->load->view('admin/forgotpassword');
    }

    public function sendotp()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $mobile = $this->input->post('mobile');
        //echo '<h3>mobile is :</h3>'.$mobile."<br>";

        $this->session->set_userdata('mobile',$mobile);

        $otp=rand(10000,100000);
        //echo "OTP is :".$otp."<br>";

        $data = array(
            'otp' => $otp
        );

        $this->db->update('staff_login', $data, array('mobile' => $mobile));
        
        // SMS REQUEST SENT START //
            $username="adoptplant@gmail.com";
            $password="12345678";
            $phone= $this->input->post('mobile');
            $sender='HLMTY';
            $text1="Your OTP is: $otp. From HEALTHY MATRIMONIAL";
            $text=str_replace(" ","%20",$text1);
            $qry_str = "http://174.143.34.193/SendSMS/SingleSMS.aspx?usr=".$username."&pass=".$password."&msisdn=".$phone."&msg=".$text."&sid=".$sender."&mt=0";
           //echo $qry_str;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$qry_str);
            //echo $ch."<br>"; 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, '5');
            $content = trim(curl_exec($ch));
            curl_close($ch);
        // SMS REQUEST SENT END //
        

        redirect('admin/otp'); 

    }

    public function otp()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $this->load->view('admin/enterotp');
    }

    public function getotp()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $mobile = $this->input->post('mobile');
        //echo '<h3>mobile is :</h3>'.$mobile."<br>";

        $otp = $this->input->post('otp');
        //echo "OTP is :".$otp."<br>";
        
        $getotp = $this->db->query("select * from staff_login where mobile='$mobile'");
        $gotp = $getotp->row(); 
        $otpg = $gotp->otp;

        if ($otp == $otpg) {

            
            redirect('admin/createpwd'); 

        }else{

            $this->session->set_flashdata('success','<div class="alert alert-success text-center">Please Enter OTP Correctly.</div>');
            $this->load->view('admin/otp'); 
        }
    }

    public function createpwd()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $this->load->view('admin/createpwd');
    }

    public function submitforgotpwd()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $mobile = $this->input->post('mobile');
        //echo '<h3>mobile is :</h3>'.$mobile."<br>";

        $newpassword = $this->input->post('npassword');
        //echo '<h3>newpassword is :</h3>'.$newpassword;

        $rpassword = $this->input->post('rpassword');
        //echo '<h3>rpassword is :</h3>'.$rpassword;

        if ($newpassword == $rpassword) {

            $data = array(
            'password' => $newpassword
            );

            $this->db->update('staff_login', $data, array('mobile' => $mobile));
            redirect('admin/login'); 

        }else{

            $this->session->set_flashdata('success','<div class="alert alert-success text-center">Your Password & Retype Password Doesnt Match!!!.</div>');
            $this->load->view('admin/createpwd'); 
        }

    }

    public function editvendorsdata()
    {   
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        
        $this->load->view('admin/editvendorsdata');
    }

    public function editeventdata($eventid='')
    {   
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $data['eventid']=$eventid;
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
        
        $this->load->view('admin/editeventdata',$data);
    }


    public function deletevendorid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $id = $this->input->post('uid');
        $this->db->delete('tblvendors', array('vendorid' => $id));
        redirect('admin/addvendors');
    }

    

    public function deleteeventid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $id = $this->input->post('uid');
        $this->db->delete('tblevents', array('eventid' => $id));
        redirect('admin/addevents');
    }

    public function deleteresortid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $id = $this->input->post('uid');
        $this->db->delete('tblresorts', array('resortid' => $id));
        redirect('admin/addresorts');
    }

    

    public function deletepackageid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
      $id = $this->input->post('uid');
      $this->db->delete('tblpackages', array('packageid' => $id));
      redirect('admin/addpackages');
    }


    public function memberstatus()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $this->load->view('admin/memberstatus');
    }

    public function submitmemberstatus()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $email = $this->input->post('email');
        //echo $email;
        $mstatus = $this->input->post('mstatus');
        //echo $mstatus;
        $updatetime = date("Y-m-d H:i:s");
        $data = array(
            'user_status' => $mstatus,
            'updated_date' => $updatetime
        );
        $this->db->update('register', $data, array('lemail' => $email));
        redirect('admin/memberstatus');

    }

    public function logout()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $this->load->view('admin/logout');
    }


    public function vendorpayments()
    {
      if (!$this->session->userdata('username')) 
         redirect('admin/login');
      $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
      $data['vpayments']=$this->Adminmodel->getVendorPayments();
      $this->load->view('admin/vendorpayments',$data);

    }

  public function submitvendorpayments()
  {
    $pdate = $this->input->post('pdate');
    //echo $pdate."<br>";
    $paymenttype = $this->input->post('paymenttype');
    //echo $paymenttype."<br>";
    $ctdate = $this->input->post('ctdate');
    //echo $ctdate."<br>";
    $vendorid = $this->input->post('vendorid');
    //echo $vendorid."<br>";
    $amount = $this->input->post('amount');
    //echo $amount."<br>";
    $ctno = $this->input->post('ctno');
    //echo $ctno."<br>";


    $data = array(
     'paymentdate' => $pdate,
     'vendorid' => $vendorid,
     'paymenttype' => $paymenttype,
     'transactionnumber' => $ctno,
     'transactiondate' => $ctdate,
     'amount' => $amount,
     'insertedby' =>'admin',
     'insertedon' => date('Y-m-d h:i:s'),
    );

    $this->db->insert('tblvendorpayments', $data);
    $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Inserted Successfully</div>');
    redirect('admin/vendorpayments');


  }

  public function editvendorpayment()
  {
    if (!$this->session->userdata('username')) 
            redirect('admin/login');

    $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
    $this->load->view('admin/editvendorpayment',$data);
  }

  public function updateVendorPayments()
  {
    $vpid = $this->input->post('vpid');
    //echo $vpid."<br>";
    $pdate = $this->input->post('paymentdate');
    //echo $pdate."<br>";
    $paymenttype = $this->input->post('paymenttype');
    //echo $paymenttype."<br>";
    $ctdate = $this->input->post('ctdate');
    //echo $ctdate."<br>";
    $vendorid = $this->input->post('vendorid');
    //echo $vendorid."<br>";
    $amount = $this->input->post('amount');
    //echo $amount."<br>";
    $ctno = $this->input->post('ctno');
    //echo $ctno."<br>";

    $data = array(
     'paymentdate' => $pdate,
     'vendorid' => $vendorid,
     'paymenttype' => $paymenttype,
     'transactionnumber' => $ctno,
     'transactiondate' => $ctdate,
     'amount' => $amount,
     'updatedby' =>'admin',
     'updatedon' => date('Y-m-d h:i:s'),
    );

    $this->db->where('vpid', $vpid);
    $this->db->update('tblvendorpayments', $data);
    $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');
    redirect('admin/vendorpayments');


  }

  public function deletevendorpayment()
  {
    if (!$this->session->userdata('username')) 
            redirect('admin/login');

      $id = $this->input->post('uid');
      $this->db->delete('tblvendorpayments', array('vpid' => $id));
      redirect('admin/vendorpayments');
  }



	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public $imagename;
	public $filepath;

	function __construct(){
        parent::__construct();
	    date_default_timezone_set('Asia/Calcutta');
        $this->load->model('VendorModel');
        $this->load->model('Adminmodel');
		$this->load->library('image_lib');
        $this->load->helper(array('form', 'url'));
    }
    
    public function index()
    {
        $this->load->view('vendor/index');
    }

    public function login()
	{
		$this->load->view('admin/login');
	}

    public function dashboard()
	{

    if (!$this->session->userdata('username')) 
       redirect('admin/login');

   		//get vendor id and store it in session
   			$this->session->set_userdata('vendorid',$this->VendorModel->getVendorId($this->session->userdata('username')));
   		
 	
      $this->load->view('vendor/dashboard');
    		
	}

  public function vbookings()
  {
     if (!$this->session->userdata('username')) 
       redirect('admin/login');

      $this->load->view('vendor/vbookings');
        
  }
  public function updateticket()
  {
    $tckno=$this->input->post('ticketno');
    $vdata = array(
          'visitorstatus'=>'visited'
          
      );

    $this->db->where('ticketnumber', $tckno);
    $this->db->update('tblbookings', $vdata); 
    echo "true";
  }

	public function addevents()
  {
    if (!$this->session->userdata('username')) 
     redirect('admin/login');
      //get vendors data
      $vendorid = $this->session->userdata('vendorid');
      $data['results'] = $this->VendorModel->getEventsData($vendorid);
      $this->load->view('vendor/addevents',$data);
  }

  public function validate_bannerimageEvent() 
      {
        $config['upload_path']   = './assets/eventimages';
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

     public function submiteventdata(){
      if (!$this->session->userdata('username')) 
       redirect('admin/login');

        //set rules for vendor form data
        
        
        $this->form_validation->set_rules('location', 'Location', 'required');
        
        $this->form_validation->set_rules('eventname', 'Event Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('userfile','Product Image','callback_validate_bannerimageEvent');
        $vendorid = $this->session->userdata('vendorid');
        
        

        if ($this->form_validation->run() == FALSE)
        {   
            
          $data['results'] = $this->VendorModel->getEventsData($vendorid);
          $this->load->view('vendor/addevents',$data);

        }else{
           
            $vendorid = $this->session->userdata('vendorid');
            //echo $vendorid."<br>";
            $eventodate = $this->input->post('eventodate');
            //echo $eventodate."<br>";
            $evenfromdate = $this->input->post('evenfromdate');
            //echo $evenfromdate."<br>";
            $location = $this->input->post('location');
            //echo $location."<br>";
            $totime = $this->input->post('totime');
            //echo $totime."<br>";
            $fromtime = $this->input->post('fromtime');
            //echo $fromtime."<br>";
            $eventname = $this->input->post('eventname');
            //echo $eventname."<br>";
            $description = $this->input->post('description');
            //echo $description."<br>";
            $eventtype = $this->input->post('eventtype');
            //echo $eventtype."<br>";
            $cost = $this->input->post('cost');
            //echo $cost."<br>";
            $latitude = $this->input->post('latitude');
            //echo $latitude."<br>";
            $longitude = $this->input->post('longitude');
            //echo $longitude."<br>";
            //print_r($this->imagename)."<br>";
            //print_r($this->filepath)."<br>";
            

            
            
               
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
                   'bannerimage' => $this->imagename,
                   'bannerimagepath' => $this->filepath,
                   'latitude' => $latitude,
                   'longitude' => $longitude,
                   'status' => 1


                );

                $this->db->insert('tblevents', $data);
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Inserted Successfully</div>');
                redirect('vendor/addevents');
                
            }
            

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
	        
	        $data['eventid']=$eventid;
	        $this->load->view('vendor/addeventphotos',$data);
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

	    public function updateEventsData($eventid='')
      {

      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        	$vendorid = $this->session->userdata('vendorid');
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
                $this->load->view('vendor/addevents',$data);
        
        //$this->load->view('admin/vendorsdata',$data);
    }

    public function deleteeventid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $id = $this->input->post('uid');
        $this->db->delete('tblevents', array('eventid' => $id));
        redirect('vendor/addevents');
    }

    public function addresorts()
    {
      if (!$this->session->userdata('username')) 
       redirect('admin/login');
        //get vendors data
      
      $this->load->view('vendor/addresorts');
    }

    public function validate_bannerimageResort() 
      {
        $config['upload_path']   = './assets/resortimages';
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


    public function submitresortsdata(){

        if (!$this->session->userdata('username')) 
       redirect('admin/login');

                //set rules for vendor form data
        $this->form_validation->set_rules('resortname', 'Resort Name', 'required');
        
        $this->form_validation->set_rules('location', 'Location', 'required');
        
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('userfile','Product Image','callback_validate_bannerimageResort');

        if ($this->form_validation->run() == FALSE)
        {   
            
            $this->load->view('vendor/addresorts');

        }else{
            $vendorid = $this->input->post('vendorid');
            $resortname = $this->input->post('resortname');
            $location = $this->input->post('location');
            $description = $this->input->post('description');
            
            

            //check if email and mobile exists before inserting
            //$numberOfRows = $this->Adminmodel->checkIfEmailOrPhoneExistsInVendorTable($email,$mobile);
            
                //$time = $eventdate." ".$time;
               
                $data = array(
                   'vendorid' => $this->session->userdata('vendorid'),
                   'resortname' => $resortname,
                   'location' => $location,
                   'description' => $description,
                   'bannerimage' => $this->imagename,
                   'bannerimagepath' => $this->filepath,
                   'createdby' => $this->session->userdata('username'),
                   'createdon' => date('Y-m-d h:i:s'),
                   'status' => 1

                );

                $this->db->insert('tblresorts', $data);
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Resort Inserted Successfully</div>');
                redirect('vendor/addresorts');
            }



      }
      

      public function editresortdata()
      {
        
        $data['vendors'] = $this->VendorModel->getVendordetails();
        $this->load->view('vendor/editresortdata',$data);
      }

      public function submiteditresorts()
      {
        $resortid = $this->input->post('resortid');
        $vendorid = $this->input->post('vendorid');
        $resortname = $this->input->post('resortname');
        $location = $this->input->post('location');
        $description = $this->input->post('description');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');

        $data = array(
           'vendorid' => $vendorid ,
           'resortname' => $resortname ,
           'location' => $location ,
           'description' => $description ,
           'status' => '1' ,
           'updatedby' => 'vendor' ,
           'latitude' => $latitude,
           'longitude' => $longitude,
           'updatedon' => date('Y-m-d h:i:s')                             
        );
        $this->db->update('tblresorts', $data, array('resortid' => $resortid));
        redirect('vendor/addresorts');

      }

      public function deleteresortid()
      {
        if (!$this->session->userdata('username')) 
                redirect('admin/login');
          $id = $this->input->post('uid');
          $this->db->delete('tblresorts', array('resortid' => $id));
          redirect('vendor/addresorts');
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

      public function addpackages()
      {
      	if (!$this->session->userdata('username')) 
              redirect('admin/login');

        $vendorid = $this->session->userdata('vendorid');

        $data['results'] = $this->VendorModel->getEventsData($vendorid);
        $data['vendors'] = $this->VendorModel->getVendorsResorts($vendorid);
        $data['events'] = $this->VendorModel->getVendorsEvents($vendorid);
        $vendorid = $this->session->userdata('vendorid');
        $data['result'] = $this->VendorModel->getVendorsPackages($vendorid);
      	$this->load->view('vendor/addpackages',$data);
      }
        
      public function validate_image() 
      {
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

        public function submitaddpackages()
        {
            if (!$this->session->userdata('username')) 
              redirect('admin/login');

             //$this->form_validation->set_rules("resortname", "Resortname", "trim|required");
             
             $this->form_validation->set_rules("packagename", "packagename", "trim|required");
             $this->form_validation->set_rules("description", "description", "trim|required");
             $this->form_validation->set_rules("amount", "amount", "trim|required");
             $this->form_validation->set_rules("servicetax", "servicetax", "trim|required");
             $this->form_validation->set_rules("packagetype", "packagetype", "trim|required");
             $this->form_validation->set_rules('userfile','Product Image','callback_validate_image');


              if ($this->form_validation->run() == FALSE)
              {  
                $vendorid = $this->session->userdata('vendorid');
                $data['results'] = $this->VendorModel->getEventsData($vendorid);
                $data['vendors'] = $this->VendorModel->getVendorsResorts($vendorid);
                $data['events'] = $this->VendorModel->getVendorsEvents($vendorid);                       
                $this->load->view('vendor/addpackages',$data);
                //redirect('admin/addpackages');
                  //validation fails

              }else{
                      //all validations correct
                  //echo "true ".$this->filepath."<br>";
                  $resortname = $this->input->post('resortname');
                  $vendorid = $this->session->userdata('vendorid');
                  $packagename = $this->input->post('packagename');
                  $description = $this->input->post('description');
                  $adultprice = $this->input->post('aprice');
                  $childprice = $this->input->post('cprice');
                  $expirydate = $this->input->post('expirydate');
                  $tags = $this->input->post('tags');
                  $packagetype = $this->input->post('packagetype');
                  $events = $this->input->post('events');
                  
                  
                 
                  $data = array(
                   'resortid' => $resortname ,
                   'vendorid' => $vendorid ,
                   'packagename' => $packagename ,
                   'description' => $description ,
                   'adultprice' => $adultprice,
                   'childprice' => $childprice,
                   'status' => '1' ,
                   'createdby' => $vendorid,
                   'createdon' => date('Y-m-d h:i:s') ,
                   'updatedby' => 'vendor' ,
                   'updatedon' => date('Y-m-d h:i:s') ,
                   'expirydate' => $expirydate,
                   'packageimage' => $this->imagename ,
                   'packagetags' => $tags ,
                   'packagetype' => $packagetype,
                   'eventid' => $events                              
                  );

                    $this->db->insert('tblpackages', $data); 

                    $this->session->set_flashdata('success','<div class="alert alert-success text-center">Package Created</div>');
                    redirect('vendor/addpackages');
              }
            
        }


      public function packagesdata()
      {
        if (!$this->session->userdata('username')) 
                redirect('admin/login');

        $vendorid = $this->session->userdata('vendorid');
        $data['results'] = $this->VendorModel->getVendorsPackages($vendorid);
          
         $this->load->view('vendor/packagesdata',$data);
      }

	    public function editpackagedata()
	    {
    	   if (!$this->session->userdata('username')) 
                redirect('admin/login');

        $vendorid = $this->session->userdata('vendorid');
        $data['result'] = $this->VendorModel->getVendorsPackages($vendorid);
        $data['results'] = $this->VendorModel->getEventsData($vendorid);
        $data['vendors'] = $this->VendorModel->getVendorsResorts($vendorid);
        $data['events'] = $this->VendorModel->getVendorsEvents($vendorid); 
        $this->load->view('vendor/editpackagedata',$data);
	    }

      public function submiteditpackages()
      {
        $pacakgeid = $this->input->post('packageid');
        $resortname = $this->input->post('resortname');
        $vendorid = $this->session->userdata('vendorid');
        $packagename = $this->input->post('packagename');
        $description = $this->input->post('description');
        $adultprice = $this->input->post('aprice');
        $childprice = $this->input->post('cprice');
        $tags = $this->input->post('tags');
        $packagetype = $this->input->post('packagetype');
        $events = $this->input->post('events');
        
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
            
            $data = array(
           'resortid' => $resortname ,
           'vendorid' => $vendorid ,
           'packagename' => $packagename ,
           'description' => $description ,
           'adultprice' => $adultprice,
           'childprice' => $childprice,
           'status' => '1' ,
           'updatedby' => 'vendor' ,
           'updatedon' => date('Y-m-d h:i:s'),
           
           'packageimage' => $this->imagename,
           'packagetags' => $tags,
           'packagetype' => $packagetype,
           'eventid' => $events                               
          );
          $this->db->update('tblpackages', $data, array('packageid' => $pacakgeid));
          redirect('vendor/addpackages');

        }


        
        
      }

      
      public function deletepackageid()
      {
        $id = $this->input->post('uid');
        $this->db->delete('tblpackages', array('packageid' => $id));
        redirect('vendor/addpackages');
      }


      public function eventsdata()
	    {
	        if (!$this->session->userdata('username')) 
	              redirect('admin/login');

	        $vendorid = $this->session->userdata('vendorid');
	        $data['results'] = $this->VendorModel->getEventsData($vendorid);
	        
	        $this->load->view('vendor/eventsdata',$data);
	    }

	    public function addeventphotos($eventid='')
	    {
	      if (!$this->session->userdata('username')) 
	              redirect('admin/login');

	        $data['eventid']=$eventid;
	        $this->load->view('vendor/addeventphotos',$data);
	    }

	    public function editeventdata($eventid='')
	    {   
	      if (!$this->session->userdata('username')) 
	              redirect('admin/login');
	        $data['eventid']=$eventid;
	        
	        
	        $this->load->view('vendor/editeventdata',$data);
	    }

	    public function resortsdata()
	    {
	      if (!$this->session->userdata('username')) 
	              redirect('admin/login');


	        $data['results'] = $this->Adminmodel->getResortData($this->session->userdata('vendorid'));
	        
	        $this->load->view('vendor/resortsdata',$data);
	    }

	    public function addresortphotos($resortid='')
	    {
	      if (!$this->session->userdata('username')) 
	              redirect('admin/login');

	        $data['resortid']=$resortid;
	        $this->load->view('vendor/addresortphotos',$data);
	    }

	    public function uploadresortpics($resortid='')
	    {
	      if (!$this->session->userdata('username')) 
	              redirect('admin/login');

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
	                   

	            }

	        }//end of for each loop
	        //get vendors data
	        //$data['vendors']=$this->Adminmodel->getVendorsIdAndName();
	        $data['resortid']=$resortid;
	        $this->load->view('vendor/addresortphotos',$data);
	    }


	    public function logout()
	    {
	      
	        $this->session->sess_destroy();
	        redirect('admin/login');
	    }


}

?>
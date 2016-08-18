<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public $imagename="";
  public $filepath="";

   /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
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

    public function ledgerreport($vendorid='')
    {
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

      

      
      $this->load->view('admin/ledgerreport',$data);
    }

    public function getledger()
    {
      $fromdate = $this->input->post('fromdate');
      $todate = $this->input->post('todate');
      $vendorid = $this->input->post('vendorid');
      
        if($vendorid){
          $selectvendors=$this->db->query("select * from tblvendors where vendorid='$vendorid'");
          foreach ($selectvendors -> result() as $resv) {
          $getledger=$this->db->query("SELECT * FROM tbltransactions where vendorid='$vendorid' and transactiondate between ('$fromdate') and ('$todate');");
          echo '<tr><td colspan="5" align="center" style="background:yellow;"><b>'.$resv->vendorname.'</b></td></tr>';
          foreach ($getledger -> result() as $gl) {
             echo '<tr>
             <td>'.$gl->transactiondate.'</td>
                <td>'.$gl->amountrecieved.'</td>
                <td>'.$gl->amountpaid.'</td>
                <td>'.$gl->balance.'</td>
                
                </tr>
        ';
      }
        }
        }else{
          $selectvendors=$this->db->query("select * from tblvendors");
        foreach ($selectvendors -> result() as $resv) {
        $getledger=$this->db->query("SELECT * FROM tbltransactions where vendorid='$resv->vendorid' and transactiondate between ('$fromdate') and ('$todate');");
        echo '<tr><td colspan="5" align="center" style="background:yellow;"><b>'.$resv->vendorname.'</b></td></tr>';
          foreach ($getledger -> result() as $gl) {
             echo '<tr>
             <td>'.$gl->transactiondate.'</td>
                <td>'.$gl->amountrecieved.'</td>
                 <td>'.$gl->amountpaid.'</td>
                <td>'.$gl->balance.'</td>
                
                </tr>
        ';
        }
      }
        
      }
     
      
       
      
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



    public function vendorcomissionreports($vendorid='',$fromdate='',$todate='')
    {
      error_reporting(0);
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

  public function loadvendorcommissionreport()
  {
    $vcommission=$this->db->query("select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid");
    foreach ($vcommission->result() as $k) {
      echo '<tr>
              <td>'.$k->vendorname.'</td>
              <td>'.$k->transactiondate.'</td>
              <td>'.$k->amountrecieved.'</td>
              <td>'.$k->servicecharges.'</td>
            </tr>
      ';
    }
  }

  public function getvendorcommissionreport()
  {
      $fromdate = $this->input->post('fromdate');
      $todate = $this->input->post('todate');
      $vendorid = $this->input->post('vendorid');
      if($vendorid!='' && $fromdate=='' && $todate==''){
          $vcommission=$this->db->query("select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.vendorid='$vendorid' ORDER BY t.tid desc");
          foreach ($vcommission -> result() as $k) {
             echo '<tr>
                    <td>'.$k->vendorname.'</td>
                    <td>'.$k->transactiondate.'</td>
                    <td>'.$k->amountreceived.'</td>
                    <td>'.$k->servicecharges.'</td>
                  </tr>
              ';
          }
        }else if($vendorid=='' && $fromdate!='' && $todate!=''){
          $vcommission=$this->db->query("select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.transactiondate BETWEEN '$fromdate' AND '$todate' GROUP BY t.vendorid ORDER BY t.tid desc");
          foreach ($vcommission -> result() as $k) {
             echo '<tr>
                      <td>'.$k->vendorname.'</td>
                      <td>'.$k->transactiondate.'</td>
                      <td>'.$k->amountreceived.'</td>
                      <td>'.$k->servicecharges.'</td>
                  </tr>
              ';
          }
        }else {
          $vcommission=$this->db->query("select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.vendorid='$vendorid' AND t.transactiondate BETWEEN '$fromdate' AND '$todate' ORDER BY t.tid desc");
          foreach ($vcommission -> result() as $k) {
             echo '<tr>
                    <td>'.$k->vendorname.'</td>
                    <td>'.$k->transactiondate.'</td>
                    <td>'.$k->amountreceived.'</td>
                    <td>'.$k->servicecharges.'</td>
                  </tr>
              ';
          }
        }
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

         $this->form_validation->set_rules("resortname", "Resortname", "trim|required");
         $this->form_validation->set_rules("vendorname", "Vendorname", "trim|required");
         $this->form_validation->set_rules("packagename", "packagename", "trim|required");
         $this->form_validation->set_rules("description", "description", "trim|required");
         $this->form_validation->set_rules("aprice", "Adult Price", "trim|required");
         $this->form_validation->set_rules("cprice", "Child Price", "trim|required");
         $this->form_validation->set_rules("packagetype", "packagetype", "trim|required");
         $this->form_validation->set_rules("servicetax", "Internet & Handling Charges", "trim|required");
         $this->form_validation->set_rules("tags", "Tags", "trim|required");
         //$this->form_validation->set_rules('userfile','Product Image','callback_validate_image');


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

           $this->validate_bannerimagePackages();
                //all validations correct
            //echo "true ".$this->filepath."<br>";
            $resortname = $this->input->post('resortname');
            //echo "resortname : ".$resortname."<br>";
            $vendorname = $this->input->post('vendorname');
            //echo "vendorname : ".$vendorname."<br>";
            $packagename = $this->input->post('packagename');
            //echo "packagename : ".$packagename."<br>";
            $description = $this->input->post('description');
            //echo "description : ".$description."<br>";
            $adultprice = $this->input->post('aprice');
            //echo "adultprice : ".$adultprice."<br>";
            $childprice = $this->input->post('cprice');
            //echo "childprice : ".$childprice."<br>";
            $servicetax = $this->input->post('servicetax');
            //echo "servicetax : ".$servicetax."<br>";
            $expirydate = $this->input->post('expirydate');
            //echo "expirydate : ".$expirydate."<br>";
            $tags = $this->input->post('tags');
            //echo "tags : ".$tags."<br>";
            $packagetype = $this->input->post('packagetype');
            //echo "packagetype : ".$packagetype."<br>";
            $eventname = $this->input->post('eventname');
            //echo "eventname : ".$eventname."<br>";
            $kprice = $this->input->post('kprice');
            //echo "kprice : ".$kprice."<br>";
            $createdon = date('Y-m-d h:i:s');
            $updatedon = date('Y-m-d h:i:s');
            $packageimage = $this->imagename;

      
            $data = array(
             'resortid' => $resortname,
             'vendorid' => $vendorname,
             'packagename' => $packagename,
             'description' => $description,
             'adultprice' => $adultprice,
             'childprice' => $childprice,
             'status' => '1',
             'createdby' => 'admin',
             'createdon' => date('Y-m-d h:i:s'),
             'updatedby' => 'admin',
             'updatedon' => date('Y-m-d h:i:s'),
             'expirydate' => $expirydate,
             'packageimage' => $this->imagename,
             'packagetags' => $tags,
             'packagetype' => $packagetype,
             'servicetax' => $servicetax,
             'kidsmealprice' => $kprice,
             'mobileadultqty' => 0,
             'mobilechildqty' => 0,
             'eventid'    =>  $eventname
            );
            
            
            $this->db->insert('tblpackages', $data);
            
            
            //$this->output->enable_profiler(TRUE);
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">Package Created</div>');
            
            redirect('admin/addpackages');
            
            
        }


    }

      public function validate_bannerimagePackages() 
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


    public function updatePackageData(){
      error_reporting(0);
      if (!$this->session->userdata('username')) 
      redirect('admin/login');
       $data['packageid'] = $this->input->post('packageid');
           $data['packageData'] = $this->Adminmodel->getSpecificPackageData( $this->input->post('packageid'));
           $data['resortData'] = $this->Adminmodel->getCompleteResortsData();
           $data['eventsData'] = $this->Adminmodel->getCompleteEventsData();
          $vendorsdata = $this->Adminmodel->getVendorsData();
          $data['vendorData'] = $vendorsdata->result();
           //validation fails


        $this->validate_bannerimagePackages();
        
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
          $kprice = $this->input->post('kprice');
          //echo $kprice."<br>";
          $bannerimage =  $this->input->post('bannerimage');
          //echo "bannerimage is :".$bannerimage."<br>";
          
          if (!$this->upload->do_upload('userfile'))
          {
             

          $data = array(
                 'resortid' => $resortname ,
                 'vendorid' => $vendorname ,
                 'packagename' => $packagename ,
                 'description' => $description ,
                 'adultprice' => $adultprice,
                 'childprice' => $childprice,
                 'status' => '1' ,
                 'createdby' => 'admin' ,
                 'createdon' => date('Y-m-d h:i:s') ,
                 'updatedby' => 'admin' ,
                 'updatedon' => date('Y-m-d h:i:s') ,
                 'servicetax' => $servicetax ,
                 'kidsmealprice' => $kprice ,
                 'packageimage' => $bannerimage ,
                 'packagetags' => $tags ,
                 'packagetype' => $packagetype ,
                 'eventid'    =>  $eventname
              );

              $this->db->where('packageid', $this->input->post('packageid'));
              $this->db->update('tblpackages', $data); 
          }else{

            $file = "assets/package/".$bannerimage."";
            if (is_readable($file) && unlink($file)) {

               $data = array(
                 'resortid' => $resortname ,
                 'vendorid' => $vendorname ,
                 'packagename' => $packagename ,
                 'description' => $description ,
                 'adultprice' => $adultprice,
                 'childprice' => $childprice,
                 'status' => '1' ,
                 'createdby' => 'admin' ,
                 'createdon' => date('Y-m-d h:i:s') ,
                 'updatedby' => 'admin' ,
                 'updatedon' => date('Y-m-d h:i:s') ,
                 'servicetax' => $servicetax ,
                 'kidsmealprice' => $kprice ,
                 'packageimage' => $this->imagename ,
                 'packagetags' => $tags ,
                 'packagetype' => $packagetype ,
                 'eventid'    =>  $eventname
              );

              $this->db->where('packageid', $this->input->post('packageid'));
              $this->db->update('tblpackages', $data); 

            }else{

                $data = array(
                   'resortid' => $resortname ,
                   'vendorid' => $vendorname ,
                   'packagename' => $packagename ,
                   'description' => $description ,
                   'adultprice' => $adultprice,
                   'childprice' => $childprice,
                   'status' => '1' ,
                   'createdby' => 'admin' ,
                   'createdon' => date('Y-m-d h:i:s') ,
                   'updatedby' => 'admin' ,
                   'updatedon' => date('Y-m-d h:i:s') ,
                   'servicetax' => $servicetax ,
                   'kidsmealprice' => $kprice ,
                   'packageimage' => $this->imagename ,
                   'packagetags' => $tags ,
                   'packagetype' => $packagetype ,
                   'eventid'    =>  $eventname
                );

                $this->db->where('packageid', $this->input->post('packageid'));
                $this->db->update('tblpackages', $data); 

            }

              
              
          }

         


              $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');

              //$redirectUrL = ;

              redirect('admin/addpackages');
             

    }

  public function addvendors()
  {
   
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

  public function getvbookings()
  {
    error_reporting(0);
    $vendorid = $this->input->post('vendorid');
    $fromdate = $this->input->post('fromdate');
    $todate = $this->input->post('todate');

    if($vendorid!='' && $fromdate=='' && $todate==''){

      $vendorb=$this->db->query("SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid left join tblcustomers c ON p.customerid=c.customer_id left join tblvendors v ON b.vendorid=v.vendorid WHERE v.vendorid='$vendorid'  ORDER BY b.bookingid desc ");
      foreach ($vendorb->result() as $k) {
        echo '<tr>
                <td>'.$k->ticketnumber.'</td>
                <td>'.$k->date.'</td>
                <td>
                    
                  '.$this->db->get_where("tblpackages" , array("packageid" =>$k->packageid))->row()->packagename.'
                     
                </td>
                <td>'.$k->name.'</td>
                <td>'.$k->quantity.'</td>
                <td>'.$k->childqty.'</td>
                <td>'.$k->totalcost.'</td>
              </tr>
        ';
      }
          
    }else if($vendorid=='' && $fromdate!='' && $todate!=''){
      $vendorb=$this->db->query("SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid left join tblcustomers c ON p.customerid=c.customer_id left join tblvendors v ON b.vendorid=v.vendorid WHERE b.date BETWEEN '$fromdate' AND '$todate' ORDER BY b.bookingid desc ");
      foreach ($vendorb->result() as $k) {
        echo '<tr>
                <td>'.$k->ticketnumber.'</td>
                <td>'.$k->date.'</td>
                <td>
                    
                  '.$this->db->get_where("tblpackages" , array("packageid" =>$k->packageid))->row()->packagename.'
                     
                </td>
                <td>'.$k->name.'</td>
                <td>'.$k->quantity.'</td>
                <td>'.$k->childqty.'</td>
                <td>'.$k->totalcost.'</td>
              </tr>
        ';
      }  
        
    }else{
      $vendorb=$this->db->query("SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid left join tblcustomers c ON p.customerid=c.customer_id  left join tblvendors v ON b.vendorid=v.vendorid WHERE v.vendorid='$vendorid'  AND b.date BETWEEN '$fromdate' AND '$todate' ORDER BY b.bookingid desc ");
      foreach ($vendorb->result() as $k) {
        echo '<tr>
                <td>'.$k->ticketnumber.'</td>
                <td>'.$k->date.'</td>
                <td>
                    
                  '.$this->db->get_where("tblpackages" , array("packageid" =>$k->packageid))->row()->packagename.'
                     
                </td>
                <td>'.$k->name.'</td>
                <td>'.$k->quantity.'</td>
                <td>'.$k->childqty.'</td>
                <td>'.$k->totalcost.'</td>
              </tr>
        ';
      }
    }
  }

  public function onloadvbookings()
  {
    error_reporting(0);
    $vendorb=$this->db->query("SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid left join tblcustomers c ON p.customerid=c.customer_id");
    foreach ($vendorb->result() as $k) {
      echo '<tr>

          <td>'.$k->ticketnumber.'</td>
          <td>'.$k->date.'</td>
              <td>
                
        '.$this->db->get_where("tblpackages" , array("packageid" =>$k->packageid))->row()->packagename.'
                 
              </td>
              <td>'.$k->name.'</td>
              <td>'.$k->quantity.'</td>
              <td>'.$k->childqty.'</td>
              <td>'.$k->totalcost.'</td>
              </tr>
      ';
    }
  }

  public function dailybookings()
  {
    error_reporting(0);
    $this->load->view('admin/dailybookings');
  }

  public function kidmealbookings($fromdate='', $todate='')
  {
    error_reporting(0);
     if (!$this->session->userdata('username')) 
       redirect('admin/login');
      //echo $vendorid."<br>";
       $fromdate = str_replace(" ", '-', $fromdate);
       //echo $fromdate;
       $todate = str_replace(" ", '-', $todate);
     
    //echo "SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid WHERE date BETWEEN '$fromdate' AND '$todate'";
    $getdata = $this->db->query("SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid WHERE date BETWEEN '$fromdate' AND '$todate'");
    $data['k'] = $getdata->row();
    $this->load->view('admin/kidmealbookings',$data);

  }


  public function datewisebookings($fromdate='', $todate='')
  {
    error_reporting(0);
    if (!$this->session->userdata('username')) 
       redirect('admin/login');
     $fromdate = str_replace(" ", '-', $fromdate);
     $todate = str_replace(" ", '-', $todate);
     
    //echo "SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid WHERE date BETWEEN '$fromdate' AND '$todate'";
    $getdata = $this->db->query("SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid WHERE date BETWEEN '$fromdate' AND '$todate'");
    $data['k'] = $getdata->row();
    $this->load->view('admin/datewisebookings',$data);
  }

  

  public function addpackages()
  {
    //error_reporting(0);
    if (!$this->session->userdata('username')) 
       redirect('admin/login');

    $data['resortData'] = $this->Adminmodel->getCompleteResortsData();
    $data['eventsData'] = $this->Adminmodel->getCompleteEventsData();
    $vendorsdata = $this->Adminmodel->getVendorsData();
    $data['vendorData'] = $vendorsdata->result();
    $data['packages'] = $this->Adminmodel->getCompletePackagesData();
    $this->load->view('admin/addpackages',$data);
  }

  public function getResort()
  {
    $vendorid = $this->input->post('vid');
    //echo $vendorid;
    echo "<option value=''>Select Resort Name</option>";
    $getResort = $this->db->query("SELECT * FROM tblresorts WHERE vendorid='$vendorid'");
    foreach ($getResort->result() as $k) {
      echo "<option value='$k->resortid'>$k->resortname</option>";
    }
  }

  public function getEvent()
  {
    $vendorid = $this->input->post('vid');
    //echo $vendorid;
    echo "<option value=''>Select Event Name</option>";
    $getEvent = $this->db->query("SELECT * FROM tblevents WHERE vendorid='$vendorid'");
    foreach ($getEvent->result() as $k) {
      echo "<option value='$k->eventid'>$k->eventname</option>";
    }
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
		$data['vendors']=$this->Adminmodel->getVendorsIdAndName();
        $data['results'] = $this->Adminmodel->getResortData();
		$this->validate_bannerimageResort();
		$resortid = $this->input->post('resortid');
        $vendorid = $this->input->post('vendorid');
        $resortname = $this->input->post('resortname');
        $location = $this->input->post('location');
        $description = $this->input->post('description');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $bannerimage = $this->input->post('banenrimage');

        
        if(!$this->upload->do_upload('userfile'))
        {
          $data = array(

             'vendorid'=> $vendorid,
             'resortname'=> $resortname,
             'location' => $location,
             'description' => $description,
             'updatedby' =>'admin',
             'latitude' => $latitude,
             'longitude' => $longitude,
             'bannerimage' => $bannerimage,
             'updatedon' => date('Y-m-d h:i:s')
          );
          $this->db->where('resortid', $resortid);
          $this->db->update('tblresorts', $data);

        }else{
          
          $file = "assets/resortimages/".$bannerimage."";
          if (is_readable($file) && unlink($file)) {
              
            $data = array(

               'vendorid'=> $vendorid,
               'resortname'=> $resortname,
               'location' => $location,
               'description' => $description,
               'updatedby' =>'admin',
               'latitude' => $latitude,
               'longitude' => $longitude,
               'bannerimage' => $this->imagename,
               'bannerimagepath' => $this->filepath,
               'bannerimagepath' => '',
               'updatedon' => date('Y-m-d h:i:s')
                 
            );
            $this->db->where('resortid', $resortid);
            $this->db->update('tblresorts', $data);

          }else{

            $data = array(

               'vendorid'=> $vendorid,
               'resortname'=> $resortname,
               'location' => $location,
               'description' => $description,
               'updatedby' =>'admin',
               'latitude' => $latitude,
               'longitude' => $longitude,
               'bannerimage' => $this->imagename,
               'bannerimagepath' => $this->filepath,
               'bannerimagepath' => '',
               'updatedon' => date('Y-m-d h:i:s')
                 
            );
            $this->db->where('resortid', $resortid);
            $this->db->update('tblresorts', $data);

          }

           
        }        
         
      

     
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
        $this->form_validation->set_rules('btype', 'Booking Type', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE)
        {   
          $data['results'] = $this->Adminmodel->getVendorsData();
          $this->load->view('admin/addvendors',$data);
        }else{

            $vname = $this->input->post('vname');
            //echo "vname : ".$vname."<br>";
            $cperson = $this->input->post('cperson');
            //echo "cperson : ".$cperson."<br>";
            $address1 = $this->input->post('address1');
            //echo "address1 : ".$address1."<br>";
            $address2 = $this->input->post('address2');
            //echo "address2 : ".$address2."<br>";
            $city = $this->input->post('city');
            //echo "city : ".$city."<br>";
            $pincode = $this->input->post('pincode');
            //echo "pincode : ".$pincode."<br>";
            $landline = $this->input->post('landline');
            //echo "landline : ".$landline."<br>";
            $mobile = $this->input->post('mobile');
            //echo "mobile : ".$mobile."<br>";
            $email = $this->input->post('email');
            //echo "email : ".$email."<br>";
            $password = $this->input->post('password');
            //echo "password : ".$password."<br>";
            //$latitude = $this->input->post('latitude');
            ////echo "latitude : ".$latitude."<br>";
            //$longitude = $this->input->post('longitude');
            ////echo "longitude : ".$longitude."<br>";
            $description = $this->input->post('description');
            //echo "description : ".$description."<br>";
            $websitelink = $this->input->post('websitelink');
            //echo "websitelink : ".$websitelink."<br>";
            $kidsmealprice = $this->input->post('kidsmealprice');
            //echo "kidsmealprice : ".$kidsmealprice."<br>";
            $btype = $this->input->post('btype');
            //echo "btype : ".$btype."<br>";
           

            
            //check if email and mobile exists before inserting
            $numberOfRows = $this->Adminmodel->checkIfEmailOrPhoneExistsInVendorTable($email,$mobile);
            if($numberOfRows>=1){
                $this->session->set_flashdata('success','<div class="alert alert-danger text-center">Email Id or Phone Already exists. Please choose another</div>');
                $data['results'] = $this->Adminmodel->getVendorsData();
          $this->load->view('admin/addvendors',$data);
            }else{
                //insert data into database

              if($btype=='singlechekout')
              {
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
                   'latitude' => 0,
                   'longitude' => 0,
                   'description' => $description,
                   'website' => $websitelink,
                   'bookingtype' => $btype,
                   'kidsmealprice' => 0,
                   'createdon' => date('Y-m-d h:i:s'),
                   'updateon' => date('Y-m-d h:i:s'),
                   'status' => 1
                );

                $this->db->insert('tblvendors', $data);
              }else{

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
                   'latitude' => 0,
                   'longitude' => 0,
                   'description' => $description,
                   'website' => $websitelink,
                   'bookingtype' => $btype,
                   'kidsmealprice' => $kidsmealprice,
                   'createdon' => date('Y-m-d h:i:s'),
                   'updateon' => date('Y-m-d h:i:s'),
                   'status' => 1
                );

                $this->db->insert('tblvendors', $data);

              }


                
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Inserted Successfully</div>');
                redirect('admin/addvendors');

            } 
        }
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
        $this->form_validation->set_rules('vendorid', 'Vendor Name', 'required');
        //$this->form_validation->set_rules('eventdate', 'Event Date', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        //$this->form_validation->set_rules('time', 'Time', 'required');
        //$this->form_validation->set_rules('eventname', 'Event Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
       // $this->form_validation->set_rules('evenfromdate', 'evenfromdate', 'greater');

        
        $data2['vendors']=$this->Adminmodel->getVendorsIdAndName();

        if ($this->form_validation->run() == FALSE)
        {   
            $this->session->set_flashdata('error-msg','<div class="alert alert-danger text-center">Event FROM DATE Should Not be greater than TO DATE</div>');
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
                   'bannerimage' => '',
                   'bannerimagepath' => '',
                   'status' => 1

                );

                $this->db->insert('tblevents', $data);
				//echo "test";
                $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Inserted Successfully</div>');
                redirect('admin/addevents',$data2);
            }
            

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

        $this->form_validation->set_rules('vendorid', 'Vendor Name', 'required');
        $this->form_validation->set_rules('resortname', 'Resort Name', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        //$this->form_validation->set_rules('userfile','Product Image','callback_validate_bannerimageResort');
        
        $data['vendors']=$this->Adminmodel->getVendorsIdAndName();

        if ($this->form_validation->run() == FALSE)
        {   
            
          $data['vendors']=$this->Adminmodel->getVendorsIdAndName();
          $data['results'] = $this->Adminmodel->getResortData();
          $this->load->view('admin/addresorts',$data);
            

        }else{

            $this->validate_bannerimageResort();
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
                   'bannerimage' => $this->imagename,
                   'bannerimagepath' => $this->filepath,
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
          $bookingtype = $this->input->post('btype');
          $kidsmealprice = $this->input->post('kidsmeal');

          //check if email and mobile exists before inserting
          $numberOfRows = $this->Adminmodel->checkIfEmailOrPhoneExistsInVendorTable($email,$mobile);
          if($numberOfRows>=1){
              $this->session->set_flashdata('success','<div class="alert alert-danger text-center">Email Id or Phone Already exists. Please choose another</div>');
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
                 'bookingtype' => $bookingtype,
                 'kidsmealprice' => $kidsmealprice,
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

      $this->form_validation->set_rules('vendorid', 'Vendor Name', 'required');
        $this->form_validation->set_rules('evenfromdate', 'Event From Date', 'required');
        $this->form_validation->set_rules('eventodate', 'Event To Date', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('eventname', 'Event Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

      if ($this->form_validation->run() == FALSE)
        {   
            
          $data['results'] = $this->VendorModel->getEventsData($vendorid);
          $this->load->view('vendor/addevents',$data);

        }else{

          $this->validate_bannerimageEvent();


            $vendorid = $this->input->post('vendorid');
            //echo "vendorid : ".$vendorid."<br>";
            $eventodate = $this->input->post('eventodate');
            //echo "eventodate : ".$eventodate."<br>";
            $evenfromdate = $this->input->post('evenfromdate');
            //echo "evenfromdate : ".$evenfromdate."<br>";
            $location = $this->input->post('location');
            //echo "location : ".$location."<br>";
            $totime = $this->input->post('totime');
            //echo "totime : ".$totime."<br>";
            $fromtime = $this->input->post('fromtime');
            //echo "fromtime : ".$fromtime."<br>";
            $eventname = $this->input->post('eventname');
            //echo "eventname : ".$eventname."<br>";
            $description = $this->input->post('description');
            //echo "description : ".$description."<br>";
            $eventtype = $this->input->post('eventtype');
            //echo "eventtype : ".$eventtype."<br>";
            $cost = $this->input->post('cost');
            //echo "cost : ".$cost."<br>";
            $latitude = $this->input->post('latitude');
            //echo "latitude : ".$latitude."<br>";
            $longitude = $this->input->post('longitude');
            //echo "longitude : ".$longitude."<br>";

            $bannerimage = $this->input->post('bannerimage');

            if (!$this->upload->do_upload('userfile'))
            {
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
                 'bannerimage' => $bannerimage,
                 'bannerimagepath' => '',
                 'status' => 1

              );

              $this->db->where('eventid', $eventid);
              $this->db->update('tblevents', $data);
            }else{

              $file = "assets/eventimages/".$bannerimage."";
              if (is_readable($file) && unlink($file)) 
              {
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
                   'bannerimage' => $this->imagename,
                   'bannerimagepath' => $this->filepath,
                   'status' => 1

                );

                $this->db->where('eventid', $eventid);
                $this->db->update('tblevents', $data);
              }else{

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
                   'bannerimage' => $this->imagename,
                   'bannerimagepath' => $this->filepath,
                   'status' => 1

                  );

                  $this->db->where('eventid', $eventid);
                  $this->db->update('tblevents', $data);

              }
            }

            $data['results'] = $this->Adminmodel->getEventsData();
            $this->session->set_flashdata('success','<div class="alert alert-success text-center">Record Updated Successfully</div>');
            redirect('admin/addevents',$data);
        }    
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

    public function submitsliders()
    {
      $sname = $this->input->post('sname');
      $subtitle = $this->input->post('subtitle');
      $link = $this->input->post('link');
      $title = $this->input->post('title');
      $edate = $this->input->post('edate');

      $config['upload_path']   = './assets/sliderimages';
      $config['allowed_types'] = 'gif|jpg|png';
      
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('userfile'))
      {
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('success',$error);
      } else {
        $imageInformation = $this->upload->data();
        $this->imagename = $imageInformation['file_name'];
        $this->filepath = $imageInformation['file_path'];
        $data = array(
           'name' => $sname ,
           'title' => $title ,
           'subtitle' => $subtitle,
           'link' => $link,
           'expirydate' => $edate,
           'createdby' => 'admin',
           'createdon' => date('Y-m-d h:i:s'),
           'image' => $this->imagename,
           'status' =>1
        );
        $this->db->insert('tblsliders', $data); 
      }
      
      $this->session->set_flashdata('success','<div class="alert alert-success text-center">Slider Created</div>');
      redirect('admin/addsliders');
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
      $this->form_validation->set_rules('pname', 'Place Name', 'required');
      $this->form_validation->set_rules('description', 'Description', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('address', 'Address', 'required');
      $this->form_validation->set_rules('oinfo', 'Other Info', 'required');

      if ($this->form_validation->run() == FALSE)
      {   
          
        $data['results'] = $this->Adminmodel->getPlacesData();
        $this->load->view('admin/addplaces',$data);

      }else{
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
           'createdby' => 'admin',
           'createdon' => date('Y-m-d h:i:s'),
           'status' =>1,
           'description' => $description
        );

        $this->db->insert('tblplaces', $data); 
        $this->session->set_flashdata('success','<div class="alert alert-success text-center">Places Created</div>');
        redirect('admin/addplaces');
      }
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
            $data = array(
               
               'bannerimage' => '',
               'bannerimagepath' => ''                              
            );
            $this->db->update('tblresorts', $data, array('resortid' => $id));
            
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

       /*
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
            
            $data = array(
           'bannerimage' => $this->imagename,
           'bannerimagepath' => $this->filepath
                                     
            );
            $this->db->update('tblresorts', $data, array('resortid' => $resortid));
            
            }

     
      
        $data['resortid']=$resortid;
        $this->load->view('admin/addresortphotos',$data);
        */
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
		$upvendors = $this->db->query("update tblvendors set status=0 where vendorid='$id'");
		$upevents = $this->db->query("update tblevents set status=0 where vendorid='$id'");
		$upresorts = $this->db->query("update tblresorts set status=0 where vendorid='$id'");
        redirect('admin/addvendors');
    }

    

    public function deleteeventid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');

      $id = $this->input->post('uid');
      $query = $this->db->query("SELECT * FROM tblevents WHERE eventid='$id'");
      $row = $query->row();
      $bannerimage = $row->bannerimage;
      $file = "assets/eventimages/".$bannerimage."";
      if (is_readable($file) && unlink($file)) 
      { 
        $this->db->delete('tblevents', array('eventid' => $id)); 
      }else{
        $this->db->delete('tblevents', array('eventid' => $id));
      }
      
      redirect('admin/addevents');
    }

    public function deleteresortid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
        $id = $this->input->post('uid');
        $query = $this->db->query("SELECT * FROM tblresorts WHERE resortid='$id'");
        $row = $query->row();
        $bannerimage = $row->bannerimage;
        $file = "assets/resortimages/".$bannerimage."";
        if (is_readable($file) && unlink($file)) 
        { 
          $this->db->delete('tblresorts', array('resortid' => $id));  
        }else{
          $this->db->delete('tblresorts', array('resortid' => $id)); 
        }
        
        redirect('admin/addresorts');
    }

    

    public function deletepackageid()
    {
      if (!$this->session->userdata('username')) 
              redirect('admin/login');
      $id = $this->input->post('uid');
      $query = $this->db->query("SELECT * FROM tblpackages WHERE packageid='$id'");
      $row = $query->row();
      $bannerimage = $row->packageimage;
      $file = "assets/package/".$bannerimage."";
      if (is_readable($file) && unlink($file)) 
      { 
        $this->db->delete('tblpackages', array('packageid' => $id));  
      }else{
         $this->db->delete('tblpackages', array('packageid' => $id));
      }
      
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
    //$ctdate = date("Y-m-d 00:00:00", strtotime($ctdate));
    echo $ctdate."<br>";
	
    $vendorid = $this->input->post('vendorid');
	$vendorid = trim($vendorid);
    //echo $vendorid."<br>";
    $amount = $this->input->post('amount');
    //echo $amount."<br>";
    $ctno = $this->input->post('ctno');
    //echo $ctno."<br>";
    
    $getbalance = $this->db->query("SELECT balance FROM tbltransactions  where vendorid='$vendorid' order by tid desc limit 1");
    $gb = $getbalance->row();
    $balance = $gb->balance;
    $totalbalance = $balance - $amount;
    
     if($paymenttype=="cash")
    {
        $data = array(
       
       'vendorid' => 1,
       'paymenttype' => $paymenttype,
       'amount' => $amount,
       'insertedby' =>'admin',
       'insertedon' => date('Y-m-d h:i:s'),
      );

     $this->db->insert('tblvendorpayments', $data);

      $tdata = array(
       'transactiondate' => $pdate,
       'vendorid' => 1,
       'amountreceived' => 0,
       'servicecharges' => 0,
       'amountpaid' => $amount,
       'balance' => $totalbalance
      );

      $this->db->insert('tbltransactions', $tdata);



    }else {
        
      $data = array(
       'transactiondate' => $ctdate,
       'vendorid' => $vendorid,
       'amountreceived' => 0,
       'servicecharges' => 0,
       'amountpaid' => $amount,
       'balance' => $totalbalance
      );

      $this->db->insert('tbltransactions', $data);

      $tdata = array(
       'paymentdate' => $pdate,
       'vendorid' => $vendorid,
       'paymenttype' => $paymenttype,
       'transactionnumber' => $ctno,
       'transactiondate' => $ctdate,
       'amount' => $amount,
       'insertedby' =>'admin',
       'insertedon' => date('Y-m-d h:i:s'),
      );

      $this->db->insert('tblvendorpayments', $tdata);
    }

    
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

  public function edittaxmaster()
  {
    $this->load->view('admin/edittaxmaster');
  }

  public function submitedittaxmaster()
  {
    $servicetax = $this->input->post('servicetax');
    //echo $servicetax;
    $sbcess = $this->input->post('sbcess');
    //echo $sbcess;
    $kkcess = $this->input->post('kkcess');
    //echo $kkcess;
    $kmtax = $this->input->post('kmtax');
    //echo $kmtax;
    $taxid = $this->input->post('taxid');
    //echo $taxid;
    
    $data = array(
       'servicetax'=> $servicetax,
       'krishicess'=> $kkcess,
       'swachcess' => $sbcess,
       'kidsmealtax' => $kmtax
    );

    $this->db->update('taxmaster', $data, array('taxid' => $taxid));
    redirect('admin/edittaxmaster');
    
  }


  public function editusers()
  {
    $adminname = $this->session->userdata('username');
    $this->load->view('admin/editusers');
  }

  public function submiteditusers()
  {
    $username = $this->input->post('username');
    //echo $username;
    $department = $this->input->post('department');
    //echo $department;
    $email = $this->input->post('email');
    //echo $email;
    $password = $this->input->post('password');
    //echo $password;
    $designation = $this->input->post('designation');
    //echo $designation;
    $mobile = $this->input->post('mobile');
    //echo $mobile;
    $userid = $this->input->post('userid');
    //echo $userid;

    
    $data = array(
       'username'=> $username,
       'department'=> $department,
       'email' => $email,
       'password' => $password,
       'mobile' => $mobile,
       'designation' => $designation,
    );

    $this->db->update('tblusers', $data, array('userid' => $userid));
    redirect('admin/editusers');
    
  }

  
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

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
  var $bookingsIdArray = array();
  var $paymentsIdArray = array();

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Calcutta');
        $this->load->model('Adminmodel');
        $this->load->model('FrontEndModel');
        $this->load->library('image_lib');
    }

  public function index()
    {
      //get latest 6 events to load on index page
      $data['events']= $this->FrontEndModel->getLatestSixEvents();

        $this->load->view('frontend/header');
        $this->load->view('frontend/index',$data);
    }

    public function placesdetails()
    {
      $this->load->view('frontend/header');
      $this->load->view('frontend/placesdetails');
    }

    public function autofillsearch(){
      $searchtype = $this->input->post('searchtype');
      $searchdate = $this->input->post('searchdate');
      $searchterm = $this->input->post('searchterm');
      $data = array();
      //echo $searchtype."\n";
      //echo $searchdate."\n";
      //echo $searchterm." :search term\n";
      if($searchtype=='resortname'){
        //echo "amaer";
       //resorts
        $searchResultResort =  $this->FrontEndModel->getAutoFillSearchDataResorts($searchterm);

       if(count($searchResultResort->result())>0){
            
            foreach ($searchResultResort->result() as $k) {
              
              
              array_push($data, $k->resortname);
            }
            
        }



  }else if($searchtype=='eventname' && $searchdate!=''){

    $searchResult =  $this->FrontEndModel->getAutoFillSearchDataEventsWithDates($searchterm,$searchdate);

    //echo "search date is: ".$searchdate."\n"; WHERE status=1 AND (
       
       if(count($searchResult->result())>0){
            
            foreach ($searchResult->result() as $k) {
             
              array_push($data, $k->eventname);
            }
           
        }



  }else if($searchtype=='places'){

    //places
        $searchResultPlaces =  $this->FrontEndModel->getAutoFillSearchDataPlaces($searchterm);

       if(count($searchResultPlaces->result())>0){
            
            foreach ($searchResultPlaces->result() as $k) {
              
              array_push($data, $k->place);
            }
        }

    
  }else{
          /*
       $searchResult =  $this->FrontEndModel->getAutoFillSearchDataEvents($searchterm);
       
       if(count($searchResult->result())>0){
            //echo '<div><div class="category-headings">Events</div><div>';
            foreach ($searchResult->result() as $k) {
              //$evename = str_replace(' ','-',$k->eventname);
               //echo '<div class="list-items"><a href="'.site_url().'eventdetails/'.$evename.'/'.$k->eventid.'">'.$k->eventname.'</a></div>';
              array_push($data, $k->eventname);
            }
            //echo '</div>';
            //echo '</div>';
        }
        

        //resorts
        $searchResultResort =  $this->FrontEndModel->getAutoFillSearchDataResorts($searchterm);

       if(count($searchResultResort->result())>0){
            //echo '<div ><div class="category-headings">Resorts</div><div>';
            foreach ($searchResultResort->result() as $k) {
              //$resortname = str_replace(' ','-',$k->resortname);
               //echo '<div class="list-items"><a href="'.site_url().'resorts/'.$resortname.'/'.$k->resortid.'">'.$k->resortname.'</a></div>';
              array_push($data, $k->resortname);
            }
            //echo '</div>';
            //echo '</div>';
        }

        //places
        $searchResultPlaces =  $this->FrontEndModel->getAutoFillSearchDataPlaces($searchterm);

       if(count($searchResultPlaces->result())>0){
            
            foreach ($searchResultPlaces->result() as $k) {
              
              array_push($data, $k->place);
            }
        }

        $placescount = count($searchResultPlaces->result());
        $eventscount = count($searchResult->result());
        $resortcount = count($searchResultResort->result());
        if($eventscount==0 && $resortcount==0 && $placescount==0){
          //echo '<div ><div class="category-headings">No Results found</div>';
          array_push($data, 'no results found');
        }

       */

      }

       echo json_encode($data);
    }

    public function submitresortreview(){
        $resortid = $this->input->post('resortid');

        $resortname = $this->input->post('resortname');
        $pricerating = $this->input->post('pricerating');
        //$qualityrating = $this->input->post('qualityrating');
        $reviewtext = $this->input->post('reviewtext');
        $subject = $this->input->post('subject');

        //echo "price rating".$pricerating."<br>";
         if($pricerating==''){
         $pricerating=0;
        }

        $data = array(
          'pricereview' => $pricerating,
          'subject' => $subject,
          'review' => $reviewtext,
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'resortname' => $resortid,
          'status' => 1
          );


        $this->db->insert('resortreviews', $data);
        $resortname = str_replace("%20",'-',$resortname);
        $resortname = str_replace(" ",'-',$resortname);
        $url = 'resorts/'.$resortname.'/'.$resortid;
       // echo $url;
       
       redirect($url);

    }


    public function submitresortreviewmulticheckout(){
      $resortid = $this->input->post('resortid');

        $resortname = $this->input->post('resortname');
        $pricerating = $this->input->post('pricerating');
        //$qualityrating = $this->input->post('qualityrating');
        $reviewtext = $this->input->post('reviewtext');
        $subject = $this->input->post('subject');

        //echo "price rating".$pricerating."<br>";
         if($pricerating==''){
         $pricerating=0;
        }

        $data = array(
          'pricereview' => $pricerating,
          'subject' => $subject,
          'review' => $reviewtext,
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'resortname' => $resortid,
          'status' => 1
          );


        $this->db->insert('resortreviews', $data);
        $resortname = str_replace("%20",'-',$resortname);
        $resortname = str_replace(" ",'-',$resortname);
        $url = 'resorts-multicheckout/'.$resortname.'/'.$resortid;
        //echo $url;
       
       redirect($url);

    }



    public function submiteventreview()
    {
        $eventid = $this->input->post('eventid');
        
        $eventname = $this->input->post('eventname');
       
        $pricerating = $this->input->post('pricerating');
        
        //$qualityrating = $this->input->post('qualityrating');
        $subject = $this->input->post('subject');
        
        $reviewtext = $this->input->post('reviewtext');
        
        if($pricerating==''){
         $pricerating=0;
        }

        $data = array(
          'pricereview' => $pricerating,
          'subject' => $subject,
          'review' => $reviewtext,
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'resortoreventname' => $eventid,
          'status'=>1
          );

        $this->db->insert('eventreviews', $data);
        $eventname = str_replace(" ","-",$eventname);
        $url = 'eventdetails/'.$eventname.'/'.$eventid;
       ?>
        

        <?php
       redirect($url);
       

    }


    

    public function submitplacereview(){
      $placeid = $this->input->post('placeid');

        $placename = $this->input->post('placename');
        $pricerating = $this->input->post('pricerating');
        $qualityrating = $this->input->post('qualityrating');
        $reviewtext = $this->input->post('reviewtext');
        $subject = $this->input->post('subject');

         if($pricerating==''){
         $pricerating=0;
        }

        $data = array(
          'pricereview' => $pricerating,
          'subject' => $subject,
          'review' => $reviewtext,
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'placeid' => $placeid,
      'status' => 1
          );

        $this->db->insert('placereviews', $data);
        $url = 'frontend/placesdetails/'.$placeid;
       ?>
        <script>
          alert("Thank you for the review");
        </script>

        <?php
       redirect($url);

    }


    public function validate_date(){

                          $searchtype = $this->input->post('searchtype');
                          $searchterm = $this->input->post('searchterm');
                          $date = $this->input->post('date');
     
      if ($searchtype=="eventname") {

          if ($date=='') {
             $this->form_validation->set_message('validate_date', 'Please select the date');
             return FALSE;
          }else{
            return TRUE;
          }
        
      }else{
        return TRUE;
      }
    }

    public function indexsearch(){
      
      
                        $searchtype = $this->input->post('searchtype');
                        $searchterm = addslashes($this->input->post('searchterm'));
                        $searchdate = $this->input->post('date');

                         $searchterm =  str_replace(" ","-",$searchterm);
                         $searchdate =  str_replace(" ","-",$searchdate);
                        
                        if($searchtype=='eventname'){
                        $searchQuery = 'searchevents/'.$searchtype.'/'.$searchterm.'/'.$searchdate;
                        redirect($searchQuery);
                       }else if($searchtype=='places'){

                       
                       $searchterm =  str_replace("-"," ",$searchterm);
                       //echo "search term ISasdsfas".$searchterm;
                        $this->session->set_userdata('searchtype',$searchtype);
                        $this->session->set_userdata('searchterm',$searchterm);
                        $this->placesGridView();

                       }else{
                        $searchQuery = 'searchquery/'.$searchtype.'/'.$searchterm;
                        redirect($searchQuery);
                       }
          // echo $searchQuery."<br>";


          //redirect($searchQuery);
   

    }

    public function squery2($searchtype='',$searchterm='',$searchdate=''){

      $searchdate =  str_replace(" ","-",$searchdate);
      
        $searchQuery = 'searchevents/'.$searchtype.'/'.$searchterm.'/'.$searchdate;
        //echo $searchQuery."<br>";

            $this->session->set_userdata('eventssearchquery',$searchQuery);

            $searchterm =  str_replace("-"," ",$searchterm);
            $this->session->set_userdata('searchtype',$searchtype);
            $this->session->set_userdata('searchterm',$searchterm);
            if ($searchdate!='') {
             $searchdate = date('Y-m-d', strtotime($searchdate));
            }
            $this->session->set_userdata('searchdate',$searchdate);
            $this->eventsGridView();
    }



    public function squery($searchtype='',$searchterm=''){

            $searchQuery = 'searchquery/'.$searchtype.'/'.$searchterm;

            $searchterm =  str_replace("%20"," ",$searchterm);
            //echo "searchterm".$searchterm."<br>";
            $this->session->set_userdata('searchtype',$searchtype);
            $this->session->set_userdata('searchterm',$searchterm);
             if($searchdate!=''){
              $searchdate = date('Y-m-d', strtotime($searchdate));
              $this->session->set_userdata('searchdate',$searchdate);
             }

//echo "search term IS".$searchterm;
             switch ($searchtype) {
                case "resortname":
                $this->session->set_userdata('resortsearchquery',$searchQuery);
                    $this->resortsGridView();
                    break;
                case "places":
                $this->session->set_userdata('placessearchquery',$searchQuery);
                //echo "this is palces";

                    $this->placesGridView();
                    break;
                default:
                    echo "no match";
            }


    }

    public function indexsearch2(){
      
                    
                        $searchtype = $this->input->post('searchtype2');
                        $searchterm = addslashes($this->input->post('searchterm2'));
                        $searchdate = $this->input->post('date2');

                         $searchterm =  str_replace(" ","-",$searchterm);
                         $searchdate =  str_replace(" ","-",$searchdate);
                        
                        if($searchtype=='eventname'){
                        $searchQuery = 'searchevents/'.$searchtype.'/'.$searchterm.'/'.$searchdate;
                        redirect($searchQuery);
                       }else if($searchtype=='places'){

                       
                       $searchterm =  str_replace("-"," ",$searchterm);
                       //echo "search term ISasdsfas".$searchterm;
                        $this->session->set_userdata('searchtype',$searchtype);
                        $this->session->set_userdata('searchterm',$searchterm);
                        $this->placesGridView();

                       }else{
                        $searchQuery = 'searchquery/'.$searchtype.'/'.$searchterm;
                        redirect($searchQuery);
                       }

    }


    public function nosessionhandlerOTPCheckResorts(){

      $name = $this->input->post('name');
      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');

      //send sms
      $randNumber = rand(9999,99999);
      $msg = $randNumber." is OTP for transaction at Book4Holiday. This OTP is valid for only 10 mins. Please do not share with anyone.";
      $this->sendsms($mobile,$msg);
      $this->session->set_userdata( 'otp-resort-booking' ,$randNumber);

      echo "true";
      //echo "Message is: ".$msg;

    }

    public function resendSMS(){

      $mobile = $this->input->post('mobile');

       $randNumber = rand(9999,99999);
      $msg = $randNumber." is OTP for transaction at Book4Holiday. This OTP is valid for only 10 mins. Please do not share with anyone.";
      $this->sendsms($mobile,$msg);
      $this->session->unset_userdata('otp-resort-booking');
      $this->session->set_userdata( 'otp-resort-booking' ,$randNumber);

    }

    public function resendSMSEvents(){

      $mobile = $this->input->post('mobile');

       $randNumber = rand(9999,99999);
      $msg = $randNumber." is OTP for transaction at Book4Holiday. This OTP is valid for only 10 mins. Please do not share with anyone.";
      $this->sendsms($mobile,$msg);
      $this->session->unset_userdata('otp-event-booking');
      $this->session->set_userdata( 'otp-event-booking' ,$randNumber);

    }

    public function nosessionhandler(){
      $name = $this->input->post('name');
      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');
      $otp = $this->input->post('otp');
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);

      //check otp correct or not through session
      
      $OTP_CHECK = $this->session->userdata('otp-resort-booking');

      if($OTP_CHECK==$otp){

                         $customerData = array(

                        'name' => $name,
                        'username' => $email,
                        'password' => hash('sha512',rand(9999,99999)),
                        'number' => $mobile,
                        'dateofcreation' => date('Y-m-d'),
                        'regtype' => 'Guest'


                        );

                      $this->db->insert('tblcustomers',$customerData);
                      $customerid = $this->db->insert_id();

                    $m = microtime(true);
                    $m = str_replace(".","",$m);

                    if($m==null || $m=='undefined' || $m==''){
                      $ticketnumber = date('Ymdhis');
                    }else{
                      $ticketnumber = $m;
                    }
                     $this->session->set_userdata('ticketnumber',$ticketnumber);

                    $bookingsdata = array(
                        'dateofvisit' => $this->session->userdata('dateofvisit'),
                        'date'=>date('Y-m-d'),
                        'userid' => $customerid,
                        'quantity' => $this->session->userdata('numberofadults'),
                        'booking_status' => 'pending',
                        'packageid'=>$this->session->userdata('packageid'),
                        'amount'=>$this->session->userdata('totalcost'),
                        'payment_status'=>'pending',
                        'ticketnumber' => $ticketnumber,
                        'visitorstatus' => 'absent',
                        'vendorid' => $this->session->userdata('vendorid'),
                        'childqty' => $this->session->userdata('numberofchildren'),
                        'kidsmealqty' => $this->session->userdata('kidsmealqty'),
                        'ipaddress' => $ipaddress
   );

                    $this->db->insert('tblbookings',$bookingsdata);
                    $this->session->set_userdata('bookingsid',$this->db->insert_id());

                      $paymentsdata = array(
                        'packageid'=> $this->session->userdata('packageid'),
                        'totalcost'=> $this->session->userdata('totalcost'),
                        'adultpriceperticket'=> $this->session->userdata('adultpriceperticket'),
                        'childpriceperticket'=> $this->session->userdata('childpriceperticket'),
                        'numberofadults'=> $this->session->userdata('numberofadults'),
                        'numberofchildren'=> $this->session->userdata('numberofchildren'),
                        'servicetax'=> $this->session->userdata('servicetax'),
                        'customerid' => $customerid,
                        'status' => 'unpaid',
                        'bookingid' => $this->session->userdata('bookingsid'),
                        'noofkidsmeal' => $this->session->userdata('kidsmealqty'),
                        'kidsmealprice' => $this->session->userdata('kidsmealprice'),
                        'ticketnumber' => $ticketnumber,
                        'internetcharges'=> $this->session->userdata('internetcharges'),
                        'swachhbharath'=> $this->session->userdata('swachhbharath'),
                        'krishkalyancess'=>$this->session->userdata('kkcess')


                    );

                       $this->db->insert('tblpayments',$paymentsdata); 
                      $this->session->set_userdata('paytmentsid',$this->db->insert_id());
                    
                    echo "true";

      }else{
        echo "false";
      }

    }


    public function nosessionhandlermulticheckout(){

      $name = $this->input->post('name');
      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');
      $otp = $this->input->post('otp');
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);

      //check otp correct or not through session
    //echo "otp is: ".$OTP_CHECK."<BR>";
      
      $OTP_CHECK = $this->session->userdata('otp-resort-booking');
    
    

      if($OTP_CHECK==$otp){

        //insert into database
        $customerData = array(

                        'name' => $name,
                        'username' => $email,
                        'password' => hash('sha512',rand(9999,99999)),
                        'number' => $mobile,
                        'dateofcreation' => date('Y-m-d'),
                        'regtype' => 'Guest'
                        );

                      $this->db->insert('tblcustomers',$customerData);
                      $customerid = $this->db->insert_id();

              $this->session->set_userdata('customerid',$customerid);
              $packageIdArray = $this->session->userdata('packageIdArray');
              $numberofadults = $this->session->userdata('numberofadultsArray');
              $numberofchildren = $this->session->userdata('numberofchildrenArray');
              $kidsmealqty = $this->session->userdata('kidsmealqty');
              $dateofvisit = $this->session->userdata('dateofvisit');
              $vendorid = $this->session->userdata('vendorid');

                    $m = microtime(true);
                    $m = str_replace(".","",$m);

                    if($m==null || $m=='undefined' || $m==''){
                      $ticketnumber = date('Ymdhis');
                    }else{
                      $ticketnumber = $m;
                    }
              $this->session->set_userdata('ticketnumber',$ticketnumber);
              $calculatedinternetcharges = 0;
              $calculatedadultprice=0;
              $calculatedchildprice=0;
              $totalAdultTickets=0;
              $totalChildTickets=0;
            for ($i = 0; $i < count($packageIdArray); $i++) {

                        $packageid = $packageIdArray[$i];

                        $calculatedindividualadultprice=0;
                        $calculatedindividualchildprice=0;
                        //echo "package id is: ".$packageIdArray[$i]."<br>";


                        $packageid = $packageIdArray[$i];
                        $kidsmealprice = $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->kidsmealprice;
                        $kidsmealqty=0;
                        if($kidsmealprice!=0){

                          $kidsmealpricefromdb=$kidsmealprice;
                          $kidsmealqty = $this->session->userdata('kidsmealqty');
                        }
                        $totalAdultTickets +=  $numberofadults[$i];
                        $totalChildTickets +=  $numberofchildren[$i];
                        $noofadults = $numberofadults[$i];
                        $noofchildren = $numberofchildren[$i];
                        //calculate adult price
                        $calculatedadultprice += $noofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice;
                        //calculate individual adult price
                        $calculatedindividualadultprice += $noofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice;
                        //calculate tax
                        $calculatedinternetcharges += ( ($noofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice) * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax)/100;


                        //calculate child price
                        $calculatedchildprice += $noofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
                        $calculatedindividualchildprice += $noofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
                        //subtotal is adultprice plus childprice
                        $subtotal = $calculatedindividualchildprice + $calculatedindividualadultprice;
                        //calculate tax on childprice
                        $calculatedinternetcharges += ( ($noofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice) * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax)/100;

                        //insert into database
                        
                        $this->insertDataIntotblbookingsForMultiCheckoutNoSession($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber,$customerid,$ipaddress);
                        //end of insert database
                 
            }//end of for loop

            
              $calculatedadultprice = $this->session->userdata('calculatedadultprice');
              $calculatedchildprice = $this->session->userdata('calculatedchildprice');
              $calculatedkidsmealprice = $this->session->userdata('calculatedkidsmealprice');
              $calculatedinternetcharges = $this->session->userdata('internetcharges');
              $calculatedservicetax = $this->session->userdata('servicetax');
              $calculatedswacchcess = $this->session->userdata('swachhbharath');
              $calculatedkrishicess = $this->session->userdata('kkcess');
              $total = $this->session->userdata('total');
              
              /*
                echo "calculatedadultprice price ".$calculatedadultprice."\n";
                echo "calculatedchildprice price ".$calculatedchildprice."\n";
                echo "calculatedkidsmealprice price ".$calculatedkidsmealprice."\n";
                echo "calculatedinternetcharges price ".$calculatedinternetcharges."\n";
                echo "calculatedservicetax price ".$calculatedservicetax."\n";
                echo "calculatedswacchcess price ".$calculatedswacchcess."\n";
                echo "calculatedkrishicess price ".$calculatedkrishicess."\n";
          echo "total price ".$total."\n";
          
      */
    

          $bokIdArr = $this->session->userdata('bookingsIdArray');

          
                

                      $this->insertDataIntotblpaymentsForMultiCheckoutNoSession($total,$ticketnumber,$customerid,$totalAdultTickets,$totalChildTickets,$calculatedkidsmealprice,$calculatedinternetcharges , $calculatedservicetax ,$calculatedswacchcess,$calculatedkrishicess);

                    $paymentIdArr = $this->session->userdata('paymentsIdArray');

                    echo "true";

      }else{
        echo "false";
      }
    
   

    }

    public function nosessionhandlerOTPCheckEvents(){

      $name = $this->input->post('name');
      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');

      //send sms
      $randNumber = rand(9999,99999);
      $msg = $randNumber." is OTP for transaction at Book4Holiday. This OTP is valid for only 10 mins. Please do not share with anyone.";
      $this->sendsms($mobile,$msg);
      $this->session->set_userdata( 'otp-event-booking' ,$randNumber);
      //echo $msg;
      echo "true";

    }


    public function nosessionhandlerevents(){

      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');
      $name = $this->input->post('name');
      $otp = $this->input->post('otp');
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);

      $OTP_CHECK = $this->session->userdata('otp-event-booking');
    
    
  

      if ($OTP_CHECK==$otp) {
      
      //echo "this is".$OTP_CHECK."<br>";
       
        $customerData = array(

          'name' => $name,
          'username' => $email,
          'password' => hash('sha512',rand(9999,99999)),
          'number' => $mobile,
          'dateofcreation' => date('Y-m-d'),
          'regtype' => 'Guest'


          );
      

        $this->db->insert('tblcustomers',$customerData);
        $customerid = $this->db->insert_id();
       $this->session->set_userdata('customerid',$customerid);

        $m = microtime(true);
                    $m = str_replace(".","",$m);

                    if($m==null || $m=='undefined' || $m==''){
                      $ticketnumber = date('Ymdhis');
                    }else{
                      $ticketnumber = $m;
                    }
    
        $this->session->set_userdata('ticketnumber',$ticketnumber);
      $bookingsdata = array(
          'dateofvisit' => $this->session->userdata('dateofvisit'),
          'date'=>date('Y-m-d'),
          'userid' => $customerid,
          'quantity' => $this->session->userdata('numberofadults'),
          'booking_status' => 'pending',
          'packageid'=>$this->session->userdata('packageid'),
          'amount'=>$this->session->userdata('totalcost'),
          'payment_status'=>'pending',
          'ticketnumber' => $ticketnumber,
          'visitorstatus' => 'absent',
          'vendorid' => $this->session->userdata('vendorid'),
          'childqty' => $this->session->userdata('numberofchildren'),
          'ipaddress' => $ipaddress

       );

      $this->db->insert('tblbookings',$bookingsdata);
      $this->session->set_userdata('bookingsid',$this->db->insert_id());

        $paymentsdata = array(
          'packageid'=> $this->session->userdata('packageid'),
          'totalcost'=> $this->session->userdata('totalcost'),
          'adultpriceperticket'=> $this->session->userdata('adultpriceperticket'),
          'childpriceperticket'=> $this->session->userdata('childpriceperticket'),
          'numberofadults'=> $this->session->userdata('numberofadults'),
          'numberofchildren'=> $this->session->userdata('numberofchildren'),
          'servicetax'=> $this->session->userdata('servicetax'),
          'customerid' => $customerid,
          'status' => 'unpaid',
          'bookingid' => $this->session->userdata('bookingsid'),
          'ticketnumber' => $ticketnumber,
          'internetcharges'=> $this->session->userdata('internetcharges'),
          'swachhbharath'=> $this->session->userdata('swachhbharath'),
          'krishkalyancess'=> $this->session->userdata('kkcess'),

      );

         $this->db->insert('tblpayments',$paymentsdata); 
        $this->session->set_userdata('paytmentsid',$this->db->insert_id());
      
        echo "true";


      }else{
        echo "false";
      }


    }


    public function errorfourzerofourfunction(){
      $this->load->view('frontend/header');
      $this->load->view('frontend/registrationsuccess');
    }

    public function confirmbookings(){

      $packageid = $this->input->post('packageid');
      $resortid = $this->input->post('resortid');
      $dateofvisit = $this->input->post('dateofvisit');
      $dateofvisit = str_replace('/', '-', $dateofvisit);
      $dateofvisit = date("Y-m-d", strtotime($dateofvisit));
      $vendorid = $this->input->post('vendorid');
      $totalcost = $this->input->post('totalcost');
      $adultpriceperticket = $this->input->post('adultpriceperticket');
      $childpriceperticket = $this->input->post('childpriceperticket');
      $numberofadults = $this->input->post('numberofadults');
      $numberofchildren = $this->input->post('numberofchildren');
      $calculatedinternetcharges = $this->input->post('calculatedinternetcharges');
      $calculatedservicetax = $this->input->post('calculatedservicetax');
      $kidsmealqty = $this->input->post('kidsmealqty');
      $currenturl = $this->input->post('currenturl');

      //calcluate number of adults price
      $adultprice = $numberofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice;
      $adultprice = round($adultprice, 2);
      $adultprice = sprintf("%.2f", $adultprice);
      
      //echo "this is what adult price is: ".$adultprice."\n\n";
      //calculate number of children price
      $childrenprice = $numberofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
      $childrenprice = round($childrenprice, 2);
      $childrenprice = sprintf("%.2f", $childrenprice);
       //echo "this is what child price is: ".$childrenprice."\n\n";
      
      //calculate kids meal price
      $kidsmealprice = $kidsmealqty * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->kidsmealprice;
      $kidsmealprice = round($kidsmealprice, 2);
      $kidsmealprice = sprintf("%.2f", $kidsmealprice);
       //echo "this is what kidsmealprice price is: ".$kidsmealprice."\n\n";
     
      //echo $kidsmealprice;
      $subtotal = $adultprice + $childrenprice + $kidsmealprice;
      //echo $subtotal;
      $serviceTaxFromDB = $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax;
      //now calculate service tax
      $calculatedInternetCharges = ($subtotal*$serviceTaxFromDB)/100;
      $calculatedInternetCharges = round($calculatedInternetCharges, 2);
      $calculatedInternetCharges = sprintf("%.2f", $calculatedInternetCharges);
      //echo $calculatedInternetCharges;
      //now calculate service tax over internet charges
      //now get service tax from tax master
      $SERVICETAX = $this->db->get_where('taxmaster' , array('taxid' => 1 ))->row()->servicetax;
      
      $calculatedServiceTax = ($calculatedInternetCharges*$SERVICETAX) / 100;

      //$calculatedServiceTax = round($calculatedServiceTax, 2);
      $calculatedServiceTax = sprintf("%.2f", $calculatedServiceTax);
      //echo $calculatedServiceTax;
       //now calculate Swachh Bharath tax over internet charges
      $SWACHHCESS = $this->db->get_where('taxmaster' , array('taxid' => 1 ))->row()->swachcess;
      //echo "SWACHHCESS tax from database is: ".$SWACHHCESS."\n";
      $calculatedSwachhBharath = ($calculatedInternetCharges*$SWACHHCESS) / 100;
      //echo "swachcess from database is: ".$SWACHHCESS."\n";
      //echo "now calculateinternet charges value  is: ".$calculatedInternetCharges."\n\n";
      //echo "now calculatedSwachhBharath charges value  is: ".$calculatedSwachhBharath."\n\n";
      $calculatedSwachhBharath = round($calculatedSwachhBharath, 2);
      $calculatedSwachhBharath = sprintf("%.2f", $calculatedSwachhBharath);
      
      //echo $calculatedSwachhBharath;
       //now calculate Krishi Kalyan Cess over internet charges
      $KRISHICESS = $this->db->get_where('taxmaster' , array('taxid' => 1 ))->row()->krishicess;
      $calculatedKkCess = ($calculatedInternetCharges*$KRISHICESS) / 100;
      $calculatedKkCess = round($calculatedKkCess, 2);
      $calculatedKkCess = sprintf("%.2f", $calculatedKkCess);
      
      //echo $calculatedKkCess;

      

      //add sub total , calculated service tax and kids meal price
      //$total = round($subtotal+$calculatedServiceTax+$calculatedInternetCharges+$calculatedSwachhBharath+$calculatedKkCess,2);
      $total = $subtotal+$calculatedServiceTax+$calculatedInternetCharges+$calculatedSwachhBharath+$calculatedKkCess;
      $total = round($total, 2);
      $total = sprintf("%.2f", $total);
      
      //echo "adult price is: ".$adultprice."\n";
      //echo "children price is: ".$childrenprice."\n";
      //echo "kidsmealprice is: ".$kidsmealprice."\n";
      //echo "calculatedServiceTax is: ".$calculatedServiceTax."\n";
      //echo "calculatedInternetCharges is: ".$calculatedInternetCharges."\n";
      //echo "calculatedSwachhBharath is: ".$calculatedSwachhBharath."\n";
      //echo "calculatedKkCess is: ".$calculatedKkCess."\n";
      //echo "total is: ".$total."\n";

      $noOfTickets = ($numberofadults)+($numberofchildren);
      
       

      
      $this->session->set_userdata('packageid',$packageid);
      $this->session->set_userdata('totalcost',$total);
      $this->session->set_userdata('adultpriceperticket',$adultprice);
      $this->session->set_userdata('childpriceperticket',$childrenprice);
      $this->session->set_userdata('kidsmealprice',$kidsmealprice);
      $this->session->set_userdata('numberofadults',$numberofadults);
      $this->session->set_userdata('numberofchildren',$numberofchildren);
      $this->session->set_userdata('kidsmealqty',$kidsmealqty);
      $this->session->set_userdata('servicetax',$calculatedServiceTax);
      $this->session->set_userdata('internetcharges',$calculatedInternetCharges);
      $this->session->set_userdata('swachhbharath',$calculatedSwachhBharath);
      $this->session->set_userdata('kkcess',$calculatedKkCess);
      $this->session->set_userdata('vendorid',$vendorid);
      $this->session->set_userdata('dateofvisit',$dateofvisit);
      $this->session->set_userdata('currenturl',$currenturl);
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);

      $m = microtime(true);
                    $m = str_replace(".","",$m);

                    if($m==null || $m=='undefined' || $m==''){
                      $ticketnumber = date('Ymdhis');
                    }else{
                      $ticketnumber = $m;
                    }
      $this->session->set_userdata('ticketnumber',$ticketnumber);

      $bookingsdata = array(
          'dateofvisit' => $this->session->userdata('dateofvisit'),
          'date'=>date('Y-m-d'),
          'userid' => $this->session->userdata('holidayCustomerId'),
          'quantity' => $this->session->userdata('numberofadults'),
          'booking_status' => 'pending',
          'packageid'=>$this->session->userdata('packageid'),
          'amount'=>$this->session->userdata('totalcost'),
          'payment_status'=>'pending',
          'ticketnumber' => $ticketnumber,
          'visitorstatus' => 'absent',
          'vendorid' => $this->session->userdata('vendorid'),
          'childqty' => $this->session->userdata('numberofchildren'),
          'kidsmealqty' => $this->session->userdata('kidsmealqty'),
          'ipaddress' => $ipaddress


      );

      if ($resortid==1) {


        
      }


     if ($this->session->userdata('holidayEmail')) {
       # code...
     
        $this->db->insert('tblbookings',$bookingsdata); 
        $last_bookingid = $this->db->insert_id();
        $this->session->set_userdata('bookingsid',$last_bookingid);

        $paymentsdata = array(
          'packageid'=> $this->session->userdata('packageid'),
          'totalcost'=> $this->session->userdata('totalcost'),
          'adultpriceperticket'=> $this->session->userdata('adultpriceperticket'),
          'childpriceperticket'=> $this->session->userdata('childpriceperticket'),
          'numberofadults'=> $this->session->userdata('numberofadults'),
          'numberofchildren'=> $this->session->userdata('numberofchildren'),
          'servicetax'=> $this->session->userdata('servicetax'),
          'internetcharges'=> $this->session->userdata('internetcharges'),
          'swachhbharath'=> $this->session->userdata('swachhbharath'),
          'krishkalyancess'=> $this->session->userdata('kkcess'),
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'status' => 'unpaid',
          'bookingid' => $this->session->userdata('bookingsid'),
          'noofkidsmeal' => $this->session->userdata('kidsmealqty'),
          'kidsmealprice' => $this->session->userdata('kidsmealprice'),
          'ticketnumber' => $ticketnumber

      );
    
        $this->db->insert('tblpayments',$paymentsdata); 
        $last_paymentsid = $this->db->insert_id();
        $this->session->set_userdata('paymentsid',$last_paymentsid);
      
      echo "true";
    
      }else{
        echo "false";
      }

    }


    public function insertDataIntotblbookingsForMultiCheckout($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber,$ipaddress){

       $bookingsdata = array(
          'dateofvisit' => $dateofvisit,
          'date'=>date('Y-m-d'),
          'userid' => $this->session->userdata('holidayCustomerId'),
          'quantity' => $noofadults,
          'booking_status' => 'pending',
          'packageid'=>$packageid,
          'amount'=>$subtotal,
          'payment_status'=>'pending',
          'ticketnumber' => $ticketnumber,
          'visitorstatus' => 'absent',
          'vendorid' => $vendorid,
          'childqty' => $noofchildren,
          'kidsmealqty' => $kidsmealqty,
          'ipaddress' => $ipaddress


      );


     
       # code...
     
        $this->db->insert('tblbookings',$bookingsdata); 
        

       array_push($this->bookingsIdArray,$this->db->insert_id()); 
       $this->session->set_userdata('bookingsIdArray',$this->bookingsIdArray);

/*

       echo "this is internetcharges values".$this->session->userdata('internetcharges')."\n";
       echo "this is swachhbharath values".$this->session->userdata('swachhbharath')."\n";
       echo "this is session values".$this->session->userdata('internetcharges')."\n";
       echo "this is session values".$this->session->userdata('internetcharges')."\n";
    
   */
    }


    public function insertDataIntotblbookingsForMultiCheckoutNoSession($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber,$customerid,$ipaddress){

       $bookingsdata = array(
          'dateofvisit' => $dateofvisit,
          'date'=>date('Y-m-d'),
          'userid' => $this->session->userdata('customerid'),
          'quantity' => $noofadults,
          'booking_status' => 'pending',
          'packageid'=>$packageid,
          'amount'=>$subtotal,
          'payment_status'=>'pending',
          'ticketnumber' => $ticketnumber,
          'visitorstatus' => 'absent',
          'vendorid' => $vendorid,
          'childqty' => $noofchildren,
          'kidsmealqty' => $kidsmealqty,
          'ipaddress' => $ipaddress
      );


     //print_r($bookingsdata);
       # code...
     
       $this->db->insert('tblbookings',$bookingsdata); 
        

       array_push($this->bookingsIdArray,$this->db->insert_id()); 
       $this->session->set_userdata('bookingsIdArray',$this->bookingsIdArray);
    
       
      
      //echo "true";
    
    

    }



  public function confirmmulticheckoutbookings(){

      $numberofadults = $this->input->post('numberofadults');
      $numberofchildren = $this->input->post('numberofchildren');
      $dateofvisit = $this->input->post('dateofvisit');
      $dateofvisit = str_replace('/', '-', $dateofvisit);
      $dateofvisit = date("Y-m-d", strtotime($dateofvisit));
      $packageIdArray = $this->input->post('packageIdArray');
      $kidsmealqty = $this->input->post('kidsmealqty');
      $currenturl = $this->input->post('currenturl');
      $vendorid = $this->input->post('vendorid');
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);

      
                    $m = microtime(true);
                    $m = str_replace(".","",$m);

                    if($m==null || $m=='undefined' || $m==''){
                      $ticketnumber = date('Ymdhis');
                    }else{
                      $ticketnumber = $m;
                    }


      $calculatedinternetcharges = 0;
      $calculatedadultprice=0;
        $calculatedchildprice=0;
        $totalAdultTickets = 0;
        $totalChildTickets = 0;
        $kidsmealpricefromdb=0;
      for($i=0;$i<count($packageIdArray);$i++){

        $calculatedindividualadultprice=0;
        $calculatedindividualchildprice=0;
        //echo "package id is: ".$packageIdArray[$i]."<br>";


        $packageid = $packageIdArray[$i];
        $kidsmealprice = $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->kidsmealprice;
        $kidsmealqty=0;
        if($kidsmealprice!=0){

          $kidsmealpricefromdb=$kidsmealprice;
          $kidsmealqty = $this->input->post('kidsmealqty');
        }
        $totalAdultTickets += $numberofadults[$i];
        $totalChildTickets += $numberofchildren[$i];
        $noofadults = $numberofadults[$i];
        $noofchildren = $numberofchildren[$i];
        //calculate adult price
        $calculatedadultprice += $noofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice;
        //calculate individual adult price
        $calculatedindividualadultprice += $noofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice;
        //calculate tax
        $calculatedinternetcharges += ( ($noofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice) * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax)/100;


        //calculate child price
        $calculatedchildprice += $noofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
        $calculatedindividualchildprice += $noofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
        //subtotal is adultprice plus childprice
        $subtotal = $calculatedindividualchildprice + $calculatedindividualadultprice;
        //calculate tax on childprice
        $calculatedinternetcharges += ( ($noofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice) * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax)/100;

        //insert into database
        if ($this->session->userdata('holidayEmail')) {
            $this->insertDataIntotblbookingsForMultiCheckout($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber,$ipaddress);

          }

      }
      $kidsmealqty = $this->input->post('kidsmealqty');
      $calculatedadultprice = round($calculatedadultprice, 2);
      $calculatedadultprice = sprintf("%.2f", $calculatedadultprice);

      $calculatedchildprice = round($calculatedchildprice, 2);
      $calculatedchildprice = sprintf("%.2f", $calculatedchildprice);
      //echo "calculated  adult price ".$calculatedadultprice."\n";
      //echo "calculated  child price ".$calculatedchildprice."\n";

      //echo "vendor id is: ".$vendorid."\n";
     $calculatedkidsmealprice =  $kidsmealqty * $this->db->get_where('tblvendors' , array('vendorid' =>  $vendorid ))->row()->kidsmealprice ;
     $calculatedkidsmealprice = round($calculatedkidsmealprice, 2);
      $calculatedkidsmealprice = sprintf("%.2f", $calculatedkidsmealprice);
      //echo "calculated  kids meal PRICE ".$calculatedkidsmealprice."\n";
      //now apply tax on kids meal price
      $calculatedinternetcharges += ( ( $calculatedkidsmealprice * $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->kidsmealtax )/100  );
      $calculatedinternetcharges = round($calculatedinternetcharges, 2);
      $calculatedinternetcharges = sprintf("%.2f", $calculatedinternetcharges);

      //echo "calculatedkidsmealprice price ".$calculatedkidsmealprice."\n";
       //echo "calculatedinternetcharges price ".$calculatedinternetcharges."<br>";
      //now calculate service tax over internet charges
      $calculatedservicetax =  $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->servicetax  )/100;
      $calculatedservicetax = round($calculatedservicetax, 2);
      $calculatedservicetax = sprintf("%.2f", $calculatedservicetax);
       
       
      //now calculate swachh cess
      $calculatedswacchcess =  $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->swachcess  )/100;
      $calculatedswacchcess = round($calculatedswacchcess, 2);
      $calculatedswacchcess = sprintf("%.2f", $calculatedswacchcess);
      
      //now calculate krishi cess
      $calculatedkrishicess =  $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->krishicess  )/100;
      $calculatedkrishicess = round($calculatedkrishicess, 2);
      $calculatedkrishicess = sprintf("%.2f", $calculatedkrishicess);
      


      //echo "calculatedservicetax price ".$calculatedservicetax."\n";
      //echo "calculatedswacchcess price ".$calculatedswacchcess."\n";
      //echo "calculatedkrishicess price ".$calculatedkrishicess."\n";
      

      $total = 0;
      $total += ( $calculatedadultprice + $calculatedchildprice + $calculatedkidsmealprice + $calculatedinternetcharges + $calculatedservicetax + $calculatedswacchcess + $calculatedkrishicess );
      $total = round($total, 2);
      $total = sprintf("%.2f", $total);


      /*
      echo "calculated adult price is: ".$calculatedadultprice."\n";
     echo "calculatedchildprice price is: ".$calculatedchildprice."\n";
      echo "calculatedkidsmealprice price is: ".$calculatedkidsmealprice."\n";
      echo "calculatedinternetcharges is: ".$calculatedinternetcharges."\n";
      echo "calculatedservicetax price is: ".$calculatedservicetax."\n";
     echo "calculatedswacchcess price is: ".$calculatedswacchcess."\n";
      echo "calculatedkrishicess price is: ".$calculatedkrishicess."\n";
      echo "Total is: ".$total."<br>";
     
      
      echo "calculatedadultprice price ".$calculatedadultprice."\n";
      echo "calculatedchildprice price ".$calculatedchildprice."\n";
      echo "calculatedkidsmealprice price ".$calculatedkidsmealprice."\n";
      echo "calculatedinternetcharges price ".$calculatedinternetcharges."\n";
      echo "calculatedservicetax price ".$calculatedservicetax."\n";
      echo "calculatedswacchcess price ".$calculatedswacchcess."\n";
      echo "calculatedkrishicess price ".$calculatedkrishicess."\n";
echo "total price ".$total."\n";
*/

$bokIdArr = $this->session->userdata('bookingsIdArray');

/*
echo "<pre>";
print_r($bokIdArr);
echo "</pre>";
*/




/*
echo "<pre>";
print_r($paymentIdArr);
echo "</pre>";
*/

      //keep these arrays in session
      $this->session->set_userdata('ticketnumber',$ticketnumber);
      $this->session->set_userdata('packageIdArray',$packageIdArray);
      $this->session->set_userdata('numberofadultsArray',$numberofadults);
      $this->session->set_userdata('numberofchildrenArray',$numberofchildren);
      $this->session->set_userdata('calculatedchildprice',$calculatedchildprice);
      $this->session->set_userdata('calculatedadultprice',$calculatedadultprice);
      $this->session->set_userdata('kidsmealprice',$calculatedkidsmealprice);
      $this->session->set_userdata('numberofadults',$numberofadults);
      $this->session->set_userdata('numberofchildren',$numberofchildren);
      $this->session->set_userdata('kidsmealqty',$kidsmealqty);
      $this->session->set_userdata('servicetax',$calculatedservicetax);
      $this->session->set_userdata('internetcharges',$calculatedinternetcharges);
      $this->session->set_userdata('swachhbharath',$calculatedswacchcess);
      $this->session->set_userdata('kkcess',$calculatedkrishicess);
      $this->session->set_userdata('vendorid',$vendorid);
      $this->session->set_userdata('dateofvisit',$dateofvisit);
      $this->session->set_userdata('currenturl',$currenturl);
      $this->session->set_userdata('total',$total);


        //insert into tablepayments
        //insert into database
        if ($this->session->userdata('holidayEmail')) {

            $this->insertDataIntotblpaymentsForMultiCheckout($total,$ticketnumber,$totalAdultTickets,$totalChildTickets,$calculatedkidsmealprice);

          }



          $paymentIdArr = $this->session->userdata('paymentsIdArray');


echo "true";

  }


  public function insertDataIntotblpaymentsForMultiCheckout($total,$ticketnumber,$totalAdultTickets,$totalChildTickets,$calculatedkidsmealprice){

    $total = $this->session->userdata('total');
    $noofkidsmeal = $this->session->userdata('noofkidsmeal');
    $paymentsdata = array(
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'transaction_id'=>date('Ymdhisu'),
          'transdate' => date('Y-m-d'),
          'amount' => $total,
          'ticketnumber'=>$ticketnumber,
          'status'=>'unpaid',
          'totalcost'=> $total,
          'adultpriceperticket'=>$this->session->userdata('calculatedadultprice'),
          'childpriceperticket'=>$this->session->userdata('calculatedchildprice'),
          'kidsmealprice'=>$this->session->userdata('kidsmealprice'),
          'numberofadults' => $totalAdultTickets,
          'numberofchildren' => $totalChildTickets,
          'noofkidsmeal'=>$this->session->userdata('kidsmealqty'),
          'kidsmealprice' => '99.99',
          'servicetax' => $this->session->userdata('servicetax'),
          'internetcharges'=> $this->session->userdata('internetcharges'),
          'swachhbharath'=>$this->session->userdata('swachhbharath'),
          'krishkalyancess' => $this->session->userdata('kkcess')
      );
    
        $this->db->insert('tblpayments',$paymentsdata); 
        

        $this->session->set_userdata('paymentsid',$this->db->insert_id());


  }

  public function insertDataIntotblpaymentsForMultiCheckoutNoSession($total,$ticketnumber,$customerid,$totalAdultTickets,$totalChildTickets,$calculatedkidsmealprice,$calculatedinternetcharges , $calculatedservicetax ,$calculatedswacchcess,$calculatedkrishicess){

    $total = $this->session->userdata('total');
    $noofkidsmeal = $this->session->userdata('noofkidsmeal');
    $paymentsdata = array(
          'customerid' => $this->session->userdata('customerid'),
          'transaction_id'=>date('Ymdhisu'),
          'transdate' => date('Y-m-d'),
          'amount' => $total,
          'ticketnumber'=>$ticketnumber,
          'status'=>'unpaid',
          'totalcost'=> $total,
          'numberofadults' => $totalAdultTickets,
          'numberofchildren' => $totalChildTickets,
          'noofkidsmeal'=>$this->session->userdata('kidsmealqty'),
          'servicetax' => $this->session->userdata('servicetax'),
          'internetcharges'=> $this->session->userdata('internetcharges'),
          'swachhbharath'=>$this->session->userdata('swachhbharath'),
          'krishkalyancess' => $this->session->userdata('kkcess'),
          'kidsmealprice' => $calculatedkidsmealprice,
          'adultpriceperticket' => $this->session->userdata('calculatedadultprice'),
          'childpriceperticket' => $this->session->userdata('calculatedchildprice'),
          'kidsmealprice' => $this->session->userdata('kidsmealprice'),
      );
    
        $this->db->insert('tblpayments',$paymentsdata); 
        

        $this->session->set_userdata('paymentsid',$this->db->insert_id());


  }

    
   public function confirmbookingsevents(){

      $packageid = $this->input->post('packageid');
      $dateofvisit = $this->input->post('dateofvisit');
      $dateofvisit = str_replace('/', '-', $dateofvisit);
      $dateofvisit = date("Y-m-d", strtotime($dateofvisit));
      $vendorid = $this->input->post('vendorid');
      $totalcost = $this->input->post('totalcost');
      $adultpriceperticket = $this->input->post('adultpriceperticket');
      $childpriceperticket = $this->input->post('childpriceperticket');
      $numberofadults = $this->input->post('numberofadults');
      $numberofchildren = $this->input->post('numberofchildren');
      $calculatedinternetcharges = $this->input->post('calculatedinternetcharges');
      $calculatedservicetax = $this->input->post('calculatedservicetax');
      $currenturl = $this->input->post('currenturl');
      $ipaddress = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);
      
      //calcluate number of adults price
      $adultprice = $numberofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice;
      $adultprice = round($adultprice, 2);
      $adultprice = sprintf("%.2f", $adultprice);
      
      //echo $adultprice;
      
      //calculate number of children price
      $childrenprice = $numberofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
      $childrenprice = round($childrenprice, 2);
      $childrenprice = sprintf("%.2f", $childrenprice);
      
      //echo $childrenprice;

      $subtotal = $adultprice + $childrenprice;
      $internethandlingcharges = $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax;
      //now calculate internet handling charges
      $calculatedInternetCharges = ($subtotal*$internethandlingcharges)/100;
      $calculatedInternetCharges = round($calculatedInternetCharges, 2);
      $calculatedInternetCharges = sprintf("%.2f", $calculatedInternetCharges);
      
      //now calculate service tax of 15 % over internet charges
      $SERVICETAX = $this->db->get_where('taxmaster' , array('taxid' => 1 ))->row()->servicetax;
      $calculatedServiceTax = ($calculatedInternetCharges*$SERVICETAX)/100;
      $calculatedServiceTax = round($calculatedServiceTax, 2);
      $calculatedServiceTax = sprintf("%.2f", $calculatedServiceTax);
      



      //now calculate Swachh Bharath tax of 0.05 % over internet charges
       $SWACHHCESS = $this->db->get_where('taxmaster' , array('taxid' => 1 ))->row()->swachcess;

      $calculatedSwachhBharat = ($calculatedInternetCharges*$SWACHHCESS)/100;
      $calculatedSwachhBharat = round($calculatedSwachhBharat, 2);
      $calculatedSwachhBharat = sprintf("%.2f", $calculatedSwachhBharat);
      

      //now calculate Krish Kalyan Cess tax of 0.05 % over internet charges
      $KRISHICESS = $this->db->get_where('taxmaster' , array('taxid' => 1 ))->row()->krishicess;
      $calculatedKkCess = ($calculatedInternetCharges*$KRISHICESS)/100;
      $calculatedKkCess = round($calculatedKkCess, 2);
      $calculatedKkCess = sprintf("%.2f", $calculatedKkCess);
      


      //add sub total , calculated service tax 
       //$total = round($subtotal+$calculatedInternetCharges+$calculatedServiceTax+$calculatedSwachhBharat+$calculatedKkCess,2);
       $total = $subtotal+$calculatedInternetCharges+$calculatedServiceTax+$calculatedSwachhBharat+$calculatedKkCess;
       $total = round($total, 2);
      $total = sprintf("%.2f", $total);
       
       //echo "adult price is: ".$adultprice."\n";
       //echo "child price is: ".$childrenprice."\n";
      // echo "internethandlingcharges is: ".$calculatedInternetCharges."\n";
      // echo "service tax is: ".$calculatedServiceTax."\n";
      // echo "calculatedSwachhBharat price is: ".$calculatedSwachhBharat."\n";
      // echo "calculatedKkCess price is: ".$calculatedKkCess."\n";
       //echo "total is: ".$total."\n";

       $noOfTickets = ($numberofadults)+($numberofchildren);

       

      
      $this->session->set_userdata('packageid',$packageid);
      $this->session->set_userdata('totalcost',$total);
      $this->session->set_userdata('adultpriceperticket',$adultprice);
      $this->session->set_userdata('childpriceperticket',$childrenprice);
      
      $this->session->set_userdata('numberofadults',$numberofadults);
      $this->session->set_userdata('numberofchildren',$numberofchildren);
      $this->session->set_userdata('internetcharges',$calculatedInternetCharges);
      $this->session->set_userdata('servicetax',$calculatedServiceTax);
      $this->session->set_userdata('swachhbharath',$calculatedSwachhBharat);
      $this->session->set_userdata('kkcess',$calculatedKkCess);
     
                    $m = microtime(true);
                    $m = str_replace(".","",$m);

                    if($m==null || $m=='undefined' || $m==''){
                      $ticketnumber = date('Ymdhis');
                    }else{
                      $ticketnumber = $m;
                    }
      $this->session->set_userdata('ticketnumber',$ticketnumber);
      
      $this->session->set_userdata('vendorid',$vendorid);
      $this->session->set_userdata('dateofvisit',$dateofvisit);
      $this->session->set_userdata('currenturl',$currenturl);

      $bookingsdata = array(
          'dateofvisit' => $this->session->userdata('dateofvisit'),
          'date'=>date('Y-m-d'),
          'userid' => $this->session->userdata('holidayCustomerId'),
          'quantity' => $this->session->userdata('numberofadults'),
          'booking_status' => 'pending',
          'packageid'=>$this->session->userdata('packageid'),
          'amount'=>$this->session->userdata('totalcost'),
          'payment_status'=>'pending',
          'ticketnumber' => $ticketnumber,
          'visitorstatus' => 'absent',
          'vendorid' => $vendorid,
          'childqty' => $this->session->userdata('numberofchildren'),
          'ipaddress' => $ipaddress
      );


     if ($this->session->userdata('holidayEmail')) {
       # code...
    //echo "vnedor id: ".$vendorid."\n";
        $this->db->insert('tblbookings',$bookingsdata); 
        $this->session->set_userdata('bookingsid',$this->db->insert_id());

        $paymentsdata = array(
          'packageid'=> $this->session->userdata('packageid'),
          'totalcost'=> $this->session->userdata('totalcost'),
          'adultpriceperticket'=> $this->session->userdata('adultpriceperticket'),
          'childpriceperticket'=> $this->session->userdata('childpriceperticket'),
          'numberofadults'=> $this->session->userdata('numberofadults'),
          'numberofchildren'=> $this->session->userdata('numberofchildren'),
          'internetcharges'=> $this->session->userdata('internetcharges'),
          'servicetax'=> $this->session->userdata('servicetax'),
          'swachhbharath'=> $this->session->userdata('swachhbharath'),
          'krishkalyancess'=> $this->session->userdata('kkcess'),
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'status' => 'unpaid',
          'bookingid' => $this->session->userdata('bookingsid'),
          'ticketnumber' => $ticketnumber,

      );
    
        $this->db->insert('tblpayments',$paymentsdata); 
        $this->session->set_userdata('paymentsid',$this->db->insert_id());
      
      echo "true";
    
}else{
  echo "false";
}

    }


 public function confirmmulticheckout(){


  //$packageid = $this->session->userdata('packageid');

     // $data['resortResults'] =  $this->FrontEndModel->getResortDetailsBasedOnPackageId($packageid);

      $this->load->view('frontend/header');
      $this->load->view('frontend/confirmmulticheckout');

 }

    public function confirm($selectiontype=''){

      if($selectiontype=="events"){

  $packageid = $this->session->userdata('packageid');

  $data['eventResults'] =  $this->FrontEndModel->getResortDetailsBasedOnPackageIdAndEventsTable($packageid);

      $this->load->view('frontend/header');
     $this->load->view('frontend/confirmevents',$data);


      }else{

      $packageid = $this->session->userdata('packageid');

      $data['resortResults'] =  $this->FrontEndModel->getResortDetailsBasedOnPackageId($packageid);

      $this->load->view('frontend/header');
     $this->load->view('frontend/confirm',$data);

     }

    }


    public function confirmevents(){

      $packageid = $this->session->userdata('packageid');

      $data['eventsResults'] =  $this->FrontEndModel->getEventDetailsBasedOnPackageId($packageid);

      $this->load->view('frontend/header');
     $this->load->view('frontend/confirmevents',$data);

    }


    public function response(){
    error_reporting(0);

      $paymentid = $this->session->userdata('paymentsid');
      $bookingid = $this->session->userdata('bookingsid');
      $servicetax = $this->session->userdata('servicetax');
      $vendorid = $this->session->userdata('vendorid');
      $kidsmealprice = $this->session->userdata('kidsmealprice');
      $ticketnumber = $this->session->userdata('ticketnumber');
      //echo "ticketnumber is: ".$ticketnumber."<br>";
      // echo "<br> payment id: ".$bookingid."<br>";
      //echo "amount is: ".$_POST['f_code'];
      //print_r($_POST);
      $amountreceived = ($_POST['amt'])-($servicetax);

      //get last balance row
      $query = $this->db->query("SELECT * FROM tbltransactions WHERE vendorid='$vendorid' ORDER BY tid DESC LIMIT 0,1");
      $balance=0;

      if (count($query->row())>0) {
        $row = $query->row();
        $balance = $row->balance;

        $balance+= $amountreceived;
      } else {
       $balance+= $amountreceived;
      }
      
      $tbltransactionsdata = array(
          'vendorid'=>$vendorid,
          'amountreceived'=>$amountreceived,
          'servicecharges' => $servicetax,
          'balance' => $balance,
          'kidsmealamountrecieved'=>$kidsmealprice
      );

      if($_POST['f_code']==="Ok"){

        $packageid = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->packageid;

        $dateofvisit = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->dateofvisit;

               $eventid = $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->eventid;

               $eventname = $this->db->get_where('tblevents' , array('eventid' =>$eventid))->row()->eventname;

               $elocation = $this->db->get_where('tblevents' , array('eventid' =>$eventid))->row()->location;

               $resortid = $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->resortid;

               $resortname = $this->db->get_where('tblresorts' , array('resortid' =>$resortid))->row()->resortname;

               $rlocation = $this->db->get_where('tblresorts' , array('resortid' =>$resortid))->row()->location;
               $name="";
               $location="";
               if ($eventname!='') {
                 $name = $eventname;
                 $location=$elocation;
               }else{
                $name = $resortname;
                $location=$rlocation;
               }

              // echo $name;



        
        $paymentsdata = array(
          'banktransaction'=>$_POST['bank_txn'],
          'transactiondescription'=>$_POST['desc'],
          'transaction_id'=>$_POST['ipg_txn_id'],
          'authorizationcode'=> $_POST['auth_code'],
          'transdate'=>$_POST['date'],
          'amount'=>$_POST['amt'],
          'discriminator'=>$_POST['discriminator'],
          'cardnumber'=>$_POST['CardNumber'],
          'billingemail'=>$_POST['udf2'],
          'billingphone'=>$_POST['udf3'],
          'udf9'=>$_POST['udf9'],
          'mmp_txn'=>$_POST['mmp_txn'],
          'mer_txn'=>$_POST['mer_txn'],
          'status' => 'paid',
          'responsestatus' => $_POST['f_code']
      );

      $bookingsdata = array(
          'booking_status'=>'booked',
          'payment_status'=>'paid',
          
      );


       $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblpayments', $paymentsdata); 


       $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblbookings', $bookingsdata); 

        //insert into table transactions
        $this->db->insert('tbltransactions',$tbltransactionsdata); 
        $mobile = $_POST['udf3'];

        $dateofvisit = date("d-m-Y", strtotime($dateofvisit));

        $msg = "Your booking is confirmed via Book4Holiday at  ".$name."  for ".$dateofvisit." . Your Booking Id is: ".$ticketnumber;
        $this->sendsms($mobile,$msg);
        $this->sendingEmailTickets($_POST['udf2'],$ticketnumber,$name,$location);
        //echo " post email id is: ".$_POST['udf2']."<br>";
  
      }else{


        //send sms if transaction failed
        $mobile = $_POST['udf3'];

        $msg = "We are sorry, looks like something went wrong. Your transaction at Book4Holiday failed! Transaction Id for your reference is: ".$ticketnumber;
        $this->sendsms($mobile,$msg);
        $this->sendingFailEmail($_POST['udf2'],$ticketnumber);

        $paymentsdata = array(
          'banktransaction'=>$_POST['bank_txn'],
          'transactiondescription'=>$_POST['desc'],
          'transaction_id'=>$_POST['ipg_txn_id'],
          'authorizationcode'=> $_POST['auth_code'],
          'transdate'=>$_POST['date'],
          'amount'=>$_POST['amt'],
          'discriminator'=>$_POST['discriminator'],
          'cardnumber'=>$_POST['CardNumber'],
          'billingemail'=>$_POST['udf2'],
          'billingphone'=>$_POST['udf3'],
          'udf9'=>$_POST['udf9'],
          'mmp_txn'=>$_POST['mmp_txn'],
          'mer_txn'=>$_POST['mer_txn'],
          'status' => 'failed',
          'responsestatus' => $_POST['f_code']
      );

      $bookingsdata = array(
          'booking_status'=>'failed',
          'payment_status'=>'failed',
      );

      $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblpayments', $paymentsdata); 


       $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblbookings', $bookingsdata); 

        //redirect('frontend/index');
      }

     

    $this->load->view('frontend/header');
     $this->load->view('frontend/response',$paymentsdata);
    

    }


    public function response2(){
    error_reporting(0);

      $paymentid = $this->session->userdata('paymentsid');
      $bookingid = $this->session->userdata('bookingsid');
      $servicetax = $this->session->userdata('servicetax');
      $vendorid = $this->session->userdata('vendorid');
      $kidsmealprice = $this->session->userdata('kidsmealprice');
      $ticketnumber = $this->session->userdata('ticketnumber');
      //echo "ticket number is: ".$ticketnumber."<br>";

      $packageid =  $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->packageid;

        $dateofvisit =  $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->dateofvisit;

               $resortid =  $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->resortid;

               $name =  $this->db->get_where('tblresorts' , array('resortid' =>$resortid))->row()->resortname;

               $location =  $this->db->get_where('tblresorts' , array('resortid' =>$resortid))->row()->location;

      $servicetax = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->servicetax;

      $krishkalyancess = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->krishkalyancess;

      $swachhbharath = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->swachhbharath;

      $dateofvisit = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->dateofvisit;


      // echo "<br> payment id: ".$bookingid."<br>";
      //echo "amount is: ".$_POST['f_code'];
      //print_r($_POST);
      $amountreceived = ($_POST['amt'])-($servicetax);

      //get last balance row
      $query = $this->db->query("SELECT * FROM tbltransactions WHERE vendorid='$vendorid' ORDER BY tid DESC LIMIT 0,1");
      $balance=0;

      if (count($query->row())>0) {
        $row = $query->row();
        $balance = $row->balance;

        $balance+= $amountreceived;
      } else {
       $balance+= $amountreceived;
      }
      
      $tbltransactionsdata = array(
          'vendorid'=>$vendorid,
          'amountreceived'=>$amountreceived,
          'servicecharges' => $servicetax,
          'balance' => $balance,
          'kidsmealamountrecieved'=>$kidsmealprice
      );

      if($_POST['f_code']==="Ok"){

        

               
        
        $paymentsdata = array(
          'banktransaction'=>$_POST['bank_txn'],
          'transactiondescription'=>$_POST['desc'],
          'transaction_id'=>$_POST['ipg_txn_id'],
          'authorizationcode'=> $_POST['auth_code'],
          'transdate'=>$_POST['date'],
          'amount'=>$_POST['amt'],
          'discriminator'=>$_POST['discriminator'],
          'cardnumber'=>$_POST['CardNumber'],
          'billingemail'=>$_POST['udf2'],
          'billingphone'=>$_POST['udf3'],
          'udf9'=>$_POST['udf9'],
          'mmp_txn'=>$_POST['mmp_txn'],
          'mer_txn'=>$_POST['mer_txn'],
          'status' => 'paid',
          'responsestatus' => $_POST['f_code']
      );

      $bookingsdata = array(
          'booking_status'=>'booked',
          'payment_status'=>'paid',
          
      );


       $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblpayments', $paymentsdata); 


       $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblbookings', $bookingsdata); 

        //insert into table transactions
        $this->db->insert('tbltransactions',$tbltransactionsdata); 
        $mobile = $_POST['udf3'];
        $dateofvisit = date("d-m-Y", strtotime($dateofvisit));

        $msg = "Your booking is confirmed via Book4Holiday at ".$name.". for ".$dateofvisit.". Your Booking Id is: ".$ticketnumber;
        //echo $msg."<br>mobile is: ";
        //echo $mobile."<br>";
        $this->sendsms($mobile,$msg);
        $this->sendingEmailTickets($_POST['udf2'],$ticketnumber,$name,$location);
  
      }else{

        //send sms if transaction failed
        $mobile = $_POST['udf3'];

        $msg = "OOP's Your Transaction at Book4Holiday Failed. Transaction Id is : ".$ticketnumber;
        $this->sendsms($mobile,$msg);
        $this->sendingFailEmail($_POST['udf2'],$ticketnumber);

        $paymentsdata = array(
          'banktransaction'=>$_POST['bank_txn'],
          'transactiondescription'=>$_POST['desc'],
          'transaction_id'=>$_POST['ipg_txn_id'],
          'authorizationcode'=> $_POST['auth_code'],
          'transdate'=>$_POST['date'],
          'amount'=>$_POST['amt'],
          'discriminator'=>$_POST['discriminator'],
          'cardnumber'=>$_POST['CardNumber'],
          'billingemail'=>$_POST['udf2'],
          'billingphone'=>$_POST['udf3'],
          'udf9'=>$_POST['udf9'],
          'mmp_txn'=>$_POST['mmp_txn'],
          'mer_txn'=>$_POST['mer_txn'],
          'status' => 'failed',
          'responsestatus' => $_POST['f_code']
      );

      $bookingsdata = array(
          'booking_status'=>'failed',
          'payment_status'=>'failed',
      );

      $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblpayments', $paymentsdata); 


       $this->db->where('ticketnumber', $ticketnumber);
       $this->db->update('tblbookings', $bookingsdata); 

        //redirect('frontend/index');
      }

     

     $this->load->view('frontend/header');
     $this->load->view('frontend/response2',$paymentsdata);
    

    }

    public function resortsGridView(){


      $searchterm = $this->session->userdata('searchterm');
      $searchdate = $this->session->userdata('searchdate');
      //echo $searchterm."<br>";

      //$searchterm = str_replace("");

      $this->load->library('pagination');

      //$numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchResorts();


       //pagination settings
        $config['base_url'] = site_url('frontend/resortsGridView');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "6";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT * FROM tblresorts WHERE status=1 AND resortname='$searchterm' AND resortid!=1 order by resortid limit 4";
        
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        if(count($query2->result())==1){
         // echo '<pre>';
         // print_r($query2->result());
         // echo '</pre>';
          $this->session->unset_userdata('resortsearchquery');
          $resortname = str_replace(' ','-',$query2->result()[0]->resortname);
          $resortid =  $query2->result()[0]->resortid;
          redirect('resorts/'.$resortname.'/'.$resortid);
        }else{
      $sql3 = "SELECT * FROM tblresorts WHERE status=1 AND resortid !=1 AND (location LIKE '%$searchterm%' OR resortname LIKE '%$searchterm%' OR description LIKE '%$searchterm%') LIMIT 4";
      $query2 = $this->db->query($sql3);
    }
        $data['getdata'] = $query2;
    

        $this->session->set_userdata('limitcount',0);
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql;
        $total_data = $this->FrontEndModel->get_all_count_resorts();
        $content_per_page = 10; 
        $data['total_data'] = ceil($numberOfRows/$content_per_page); 
         
        $this->load->view('frontend/header'); 
       $this->load->view('frontend/resortsGridView',$data); 

      
    }

    public function load_more()
    {
        $group_no = $this->input->post('group_no');
        $content_per_page = 10;
        $start = ceil($group_no * $content_per_page);
        $all_content = $this->FrontEndModel->get_all_content($start,$content_per_page);
        if(isset($all_content) && is_array($all_content) && count($all_content)) : 
            foreach ($all_content as $key => $content) :
              $sql = "SELECT  min(adultprice) as minprice from tblpackages WHERE resortid='$content->resortid'";
                   //echo $sql."<br>";
                 $query2 = $this->db->query($sql);
                 $row =$query2->row();

                 
                 echo "<div class='col-md-4 col-sm-4 ' data-wow-delay='0.1s' style='visibility: visible; '>
                 <div class='img_container'>
                    <a href='<?php echo site_url().'resorts/'.$content->resortname.'/'.$content->resortid;   ?>'>";
                    echo '<img width="400" height="267" src="'.base_url().'/assets/resortimages/'.$content->bannerimage.'">';         
                    
                    echo "<div class='short_info'>
                      <i class='icon_set_1_icon-4'></i>$content->resortname; 
                      <span class='price'><span><sup>Rs.</sup>$row->minprice</span></span>
                                      
                    </div>
                    </a>
                </div>
                <div class='tour_title'>
                    <a href='<?php echo site_url().'resorts/'.$content->resortname.'/'.$content->resortid;   ?>'>
                        <h3 >$content->resortname</h3>
                    </a>
                  
                </div>
                </div>";                 
            endforeach;                                
        endif; 
    }

    

    public function sortpriceforresorts()
    {

      $price = $this->input->post('price');
       
      if ($price=='') {
        
         $getPriceResults = $this->FrontEndModel->getpriceresults_resort();
        foreach ($getPriceResults->result() as $k) {
          $resorttitleurl = str_replace(" ", "-", $k->resortname);
    $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid='$k->resortid'";
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 events-thumb1' style='visibility: visible;'>
           <div class=''><div class='img_container'>";
       ?>
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'> <?php
        echo '<img src="'.base_url().'/assets/resortimages/'.$k->bannerimage.'" style="min-height:267px;">';         
              
              echo "
              </a>
          </div>
          <div class='tour_title'>"; 
      ?>
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid; ?>'>
          <?php echo "<h3>".$k->resortname."</h3>
              </a>
            
          </div>
          </div>
          </div>"; 
          }
      }
    }else{
      //echo $price;
      if($price=='500a'){

        $price = 500;
      
        $getPriceResults = $this->FrontEndModel->getpriceresults_resort($startprice,$endprice);
        foreach ($getPriceResults->result() as $k) {

          $resorttitleurl = str_replace(" ", "-", $k->resortname);

          $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid='$k->resortid' AND adultprice >='$price'";
          //echo $sql."<br>";
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 events-thumb1' style='visibility: visible;'>
           <div class=''><div class='img_container'>";
       ?>
      
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
              <img src="<?php echo base_url().'assets/resortimages/'.$k->bannerimage ;?>" style="min-height:267px;">
              </a>
          </div>
          <div class='tour_title'>
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
                  <h3 ><?php echo$k->resortname ?></h3>
              </a>
            
          </div>
          </div>
          </div>
<?php       
          }

        }

      }else{

        $rp = explode("-",$price);
      $startprice = $rp[0];
      $endprice =  $rp[1]; 
      
        $getPriceResults = $this->FrontEndModel->getpriceresults_resort($startprice,$endprice);
        foreach ($getPriceResults->result() as $k) {

          $resorttitleurl = str_replace(" ", "-", $k->resortname);

          $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid='$k->resortid' AND adultprice between '$startprice' AND '$endprice' ";
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 events-thumb1' style='visibility: visible;'>
           <div class=''><div class='img_container'>";
       ?>
      
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
              <img src="<?php echo base_url().'assets/resortimages/'.$k->bannerimage ;?>" style="min-height:267px;">
              </a>
          </div>
          <div class='tour_title'>
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
                  <h3 ><?php echo $k->resortname; ?></h3>
              </a>
            
          </div>
          </div>
          </div>
<?php       
          }

        }

      }//end of 500 and above sort
      
      }
    }



    public function sortpriceforresortsAjax()
    {
      $price = $this->input->post('price');
      $lastid = $this->input->post('lastid');
      $limit = $this->input->post('limit');
      $sessionValue = $this->input->post('sessionValue');


       $last_id=$sessionValue*4;
       //echo "Price is".$price;
      if ($price=='') {      
         $getPriceResults = $this->FrontEndModel->getpriceresults_resortAjax($limit,$lastid);
         foreach ($getPriceResults->result() as $k) {
         $resorttitleurl = str_replace(" ", "-", $k->resortname);
         $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid='$k->resortid'";
         $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 events-thumb1' style='visibility: visible;'>
           <div class=''><div class='img_container'>";
       ?>
      
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
              <img src="<?php echo base_url().'/assets/resortimages/'.$k->bannerimage ;?>" style="min-height:267px;">
              </a>
          </div>
          <div class='tour_title'>
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
                  <h3 ><?php echo$k->resortname ?></h3>
              </a>
            
          </div>
          </div>
          </div>
<?php    
          $lastid = $k->resortid;
          }
      }
      if ($lastid != 0) {
  echo '<script type="text/javascript">var last_id = '.$lastid.';</script>';
}
    }else{
      //echo "Price=".$price;
      $rp = explode("-",$price);
      $startprice = $rp[0];
      $endprice =  $rp[1]; 
      
        $getPriceResults = $this->FrontEndModel->getpriceresults_resortAjax($limit,$lastid);
        foreach ($getPriceResults->result() as $k) {
          $resorttitleurl = str_replace(" ", "-", $k->resortname);
          $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid='$k->resortid' AND adultprice between '$startprice' AND '$endprice' ";
      //echo $sql;
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 events-thumb1' style='visibility: visible;'>
           <div class=''><div class='img_container'>";
       ?>
      
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
              <img src="<?php echo base_url().'/assets/resortimages/'.$k->bannerimage ;?>" style="min-height:267px;">
              </a>
          </div>
          <div class='tour_title'>
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
                  <h3 ><?php echo$k->resortname ?></h3>
              </a>
            
          </div>
          </div>
          </div>
<?php 
           $lastid = $k->resortid;
          }

        }
        if ($lastid != 0) {
  echo '<script type="text/javascript">var last_id = '.$lastid.';</script>';
}
      }
    }

    public function placesGridView(){
      
      $searchterm = $this->session->userdata('searchterm');
      //$searchdate = $this->session->userdata('searchdate');
      //echo $searchterm."<br>";

      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchPlaces();


       //pagination settings
        $config['base_url'] = site_url('frontend/placesGridView');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "6";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



       
        $sql = "SELECT r.*,rp.* FROM tblplaces r LEFT JOIN tblplacesphotos rp ON r.plid=rp.plid WHERE r.status=1 AND r.place = '$searchterm' GROUP by rp.plid limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";
    

        $query2 = $this->db->query($sql);
        if(count($query2->result())==1){
         // echo '<pre>';
         // print_r($query2->result());
         // echo '</pre>';

          $place = str_replace(' ','-',$query2->result()[0]->place);
          $plid =  $query2->result()[0]->plid;
          redirect('places/'.$place.'/'.$plid);
          //echo "place is: ";
        }else{
       $sql3 = "SELECT r.*,rp.* FROM tblplaces r LEFT JOIN tblplacesphotos rp ON r.plid=rp.plid WHERE r.status=1 AND (r.address LIKE '%$searchterm%' OR r.place LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.plid limit ".$data['page'].", ".$config['per_page'];
    }
    $query2 = $this->db->query($sql3);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 
        //echo "count is : ".count($query2->result())."<br>";
//echo "this is it2222";

       $this->load->view('frontend/header'); 
       $this->load->view('frontend/placesGridView',$data); 

      
    }



    public function resortsListView(){


      $searchterm = $this->session->userdata('searchterm');
      $searchdate = $this->session->userdata('searchdate');

      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchResorts();


       //pagination settings
        $config['base_url'] = site_url('frontend/resortsListView');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "2";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT r.*,rp.* FROM tblresorts r LEFT JOIN tblresorphotos rp ON r.resortid=rp.resortid WHERE r.status=1 AND (r.location LIKE '%$searchterm%' OR r.resortname LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.resortid limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 

            $this->load->view('frontend/header'); 
        $this->load->view('frontend/resortsListView',$data); 

      
    }

    


    public function eventsGridView(){

      //echo $this->session->userdata('searchdate')."<br>";
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchEvents();


       //pagination settings
        $config['base_url'] = site_url('frontend/eventsGridView');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "8";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $searchterm = $this->session->userdata('searchterm');
    
    $sql= "select * from tblevents where status=1 and (fromdate<='".$this->session->userdata('searchdate')."' OR todate>='".$this->session->userdata('searchdate')."') AND eventname='".$this->session->userdata('searchterm')."'";
    $query2 =$this->db->query($sql);
    if(count($query2->result())==1){
         // echo '<pre>';
         // print_r($query2->result());
         // echo '</pre>';
          $this->session->unset_userdata('eventssearchquery');
          $eventname =  str_replace(' ','-',$query2->result()[0]->eventname);
          $eventid =  $query2->result()[0]->eventid;
          redirect('eventdetails/'.$eventname.'/'.$eventid);
        }else{
      $sql3 = "SELECT * FROM tblevents WHERE status=1 AND (todate>='".$this->session->userdata('searchdate')."' AND fromdate<='".$this->session->userdata('searchdate')."') AND (location LIKE '%".$this->session->userdata('searchterm')."%' OR eventname LIKE '%".$this->session->userdata('searchterm')."%' OR description LIKE '%".$this->session->userdata('searchterm')."%' ) order by eventid limit 4";
      $query2 =$this->db->query($sql3);
    }

      
        $this->session->set_userdata('limitcount',0);
        
       //echo $sql."<br>";

        
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;

        
        $content_per_page = 10; 
        $data['total_data'] = ceil($numberOfRows/$content_per_page); 
       

      $this->load->view('frontend/header'); 
       $this->load->view('frontend/eventsGridView',$data); 

      
    }


    public function load_more_events()
    {
        $group_no = $this->input->post('group_no');
        $date = $this->input->post('date');
        $price = $this->input->post('price');
        $group_no = $this->input->post('group_no');

        $content_per_page = 2;
        $start = ceil($group_no * $content_per_page);
        $all_content = $this->FrontEndModel->get_all_content_events($start,$content_per_page,$date,$price);
        if(isset($all_content) && is_array($all_content) && count($all_content)) : 
            foreach ($all_content as $key => $content) :
              $sql = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$content->eventid'";
                   //echo $sql."<br>";
                 $query2 = $this->db->query($sql);
                 $row =$query2->row();

                 
                 echo "<div class='col-md-4 col-sm-4 ' data-wow-delay='0.1s' style='visibility: visible; '>
                 <div class='img_container'>
                    <a href='site_url().'events/'.$content->eventname.'/'.$content->eventid;'>";
                    echo '<img width="400" height="267" src="'.base_url().'/assets/eventimages/'.$content->bannerimage.'">';         
                    
                    echo "<div class='short_info'>
                      <i class='icon_set_1_icon-4'></i>$content->eventname; 
                      <span class='price'><span><sup>Rs.</sup>$row->minprice</span></span>
                                      
                    </div>
                    </a>
                </div>
                <div class='tour_title'>
                    <a href='site_url().'events/'.$content->eventname.'/'.$content->eventid;'>
                        <h3 >$content->eventname</h3>
                    </a>
                    <p>
                        <a href='site_url().'events/'.$content->eventname.'/'.$content->eventid;'>From : $k->todate</a> 
                        &nbsp;
                        &nbsp;
                        <a href='site_url().'events/'.$content->eventname.'/'.$content->eventid;'>To : $k->fromdate </a>
                    </p>
                  
                </div>
                </div>";                 
            endforeach;                                
        endif; 
    }

    

   


    public function sortpricedateforevents()
    {
      $price = $this->input->post('price');
      $date = $this->input->post('date');
      if ($price=='' && $date=='') {
        $sql = "SELECT * FROM tblevents WHERE status=1 AND (fromdate<='".$this->session->userdata('searchdate')."' AND todate>='".$this->session->userdata('searchdate')."') AND (location LIKE '%".$this->session->userdata('searchterm')."%' OR eventname LIKE '%".$this->session->userdata('searchterm')."%' OR description LIKE '%".$this->session->userdata('searchterm')."%' ) ORDER BY eventid desc LIMIT 4";
        //echo $sql."<br>";

        

        $qq = $this->db->query($sql);

        foreach ($qq->result() as $k) {
          //echo $k->eventid."<br>";
          $eventtitleurl = str_replace(" ", "-", $k->eventname);
          $sql2 = "SELECT min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
          //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
                 if($row->minprice!=''){
        ?>
        <div class="col-md-4 col-sm-4 events-thumb1" style="visibility: visible;">

    
                  
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">      
                                    <div class="short_info">
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                    <p>
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php

                                        $fromdate = date("d-m-Y", strtotime($k->fromdate));
                                         echo $fromdate;

                                         ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php
                                         $todate = date("d-m-Y", strtotime($k->todate));
                                         echo $todate;
                                         

                                          ?></a>
                                    </p>   
                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->

        <?php 
       }//condition show only if price is not empty
        
      }

        
      }else{
        //echo "amar";
     $this->FrontEndModel->getdateandprice_filterevents($price,$date);
      

      }
      
      
    }




    public function sortpricedateforeventsallAjax()
    {
      $last_id = $this->input->post('lastid');
      $limit = $this->input->post('limit');
      $price = $this->input->post('price');
      $date = $this->input->post('date');
      $sessionValue = $this->input->post('sessionValue');
      //echo "date is: ".$date."<br>";
      //echo "last id is: ".$last_id."<br>";

      
      
      $last_id=$sessionValue*4;
      if ($price=='' && $date=='') {


        $sql = "SELECT * FROM tblevents WHERE status=1  ORDER by eventid DESC LIMIT $last_id,$limit";
        //echo $sql."<br>";

        

        $qq = $this->db->query($sql);

        foreach ($qq->result() as $k) {
          $eventtitleurl = str_replace(" ", "-", $k->eventname);
          $sql2 = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
                  if($row->minprice!=''){
        ?>
        <div class="col-md-4 col-sm-4 events-thumb"  style="visibility: visible; ">

    
                  
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                       
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                   
                                   <p class="eventdate">

                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php
                                            echo date("d-m-Y", strtotime($k->fromdate)); 
                                         //echo $k->todate; 

                                         ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php echo date("d-m-Y", strtotime($k->todate)); ?></a>
                                    </p>


                                  
                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->

        <?php
 }//condition show only if price is not empty
        $last_id = $k->eventid;
        
      }

      if ($last_id != 0) {
  echo '<script type="text/javascript">var last_id = '.$last_id.';</script>';
}

        
      }else{
     $this->FrontEndModel->getdateandprice_filtereventsallajax($price,$date,$last_id,$limit);
      //echo $getDateResults;
      
      
      

      }
      
      
    }


    public function sortpricedateforeventsAjax()
    {

      $last_id = $this->input->post('lastid');
      $limit = $this->input->post('limit');
      $price = $this->input->post('price');
      $date = $this->input->post('date');
      $sessionValue = $this->input->post('sessionValue');
      
      

      
      $last_id=$sessionValue*4;
      //echo "sessionvalue is: : ".$last_id."<br>";

        

      if ($price=='' && $date=='') {

        $sql = "SELECT e.* FROM tblevents e WHERE e.status=1 AND (e.fromdate<='".$this->session->userdata('searchdate')."' OR e.todate>='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) ORDER BY e.eventid desc LIMIT $last_id,$limit";
        //echo $sql."<br>";


        

        $qq = $this->db->query($sql);
       

        foreach ($qq->result() as $k) {
          //echo $k->eventid."<br>";
          $sql2 = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
        ?>
        <div class="col-md-4 col-sm-4 events-thumb1" style="visibility: visible;">

    
                  
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                        
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                    <p>
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php

                                        $fromdate = date("d-m-Y", strtotime($k->fromdate));
                                         echo $fromdate;

                                         ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php
                                         $todate = date("d-m-Y", strtotime($k->todate));
                                         echo $todate;
                                         

                                          ?></a>
                                    </p>   
                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->

        <?php

        $last_id = $k->eventid;
        
      }

      if ($last_id != 0) {
  echo '<script type="text/javascript">var last_id = '.$last_id.';</script>';
}

        
      }else{
     $this->FrontEndModel->getdateandprice_filtereventsajax($price,$date,$last_id,$limit);
      //echo $getDateResults;
      
      }
      
      
    }



    public function eventsGridView_ShowAll(){


      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchEvents_showAllEvents();

//echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/eventsGridView_ShowAll');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "2";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT * FROM tblevents WHERE status=1 ORDER by eventid DESC limit 4";
        //echo $sql."<br>";
        $this->session->set_userdata('limitcount',0);
        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 

        $this->load->view('frontend/header'); 
        $this->load->view('frontend/eventsGridView_ShowAll',$data); 

      
    }


    public function showalleventsdateprice()
    {
      $price = $this->input->post('price');
      $date = $this->input->post('date');


      if ($price=='' && $date=='') {
        $sql = "SELECT * FROM tblevents WHERE status=1 ORDER by eventid DESC limit 4";
        //echo $sql."<br>";

        

        $qq = $this->db->query($sql);

        foreach ($qq->result() as $k) {
          //echo $k->eventid."<br>";
          $eventtitleurl = str_replace(" ", "-", $k->eventname);
          $sql2 = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
                 if($row->minprice!=''){
        ?>
        <div class="col-md-4 col-sm-4 events-thumb"  style="visibility: visible; ">

    
                  
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                       <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                   <p class="eventdate">

                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php
                                            echo date("d-m-Y", strtotime($k->fromdate)); 
                                         //echo $k->todate; 

                                         ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php echo date("d-m-Y", strtotime($k->todate)); ?></a>
                                    </p>

                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->

        <?php 
         }//condition show only if price is not empty
        
      }

        
      }else{
     $this->FrontEndModel->getdateandprice_filtereventseventsall($price,$date);
      //echo $getDateResults;
      
      
      

      }
      
      
    }


    public function eventsListView(){


      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchEvents();


       //pagination settings
        $config['base_url'] = site_url('frontend/eventsListView');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "2";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



       $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 AND (e.fromdate>='".$this->session->userdata('searchdate')."' OR e.todate='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) GROUP by ep.bannerimage limit ".$data['page'].", ".$config['per_page'];

        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 

            $this->load->view('frontend/header'); 
        $this->load->view('frontend/eventsListView',$data); 

      
    }

    public function eventsListView_ShowAll(){


      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchEvents_showAllEvents();

//echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/eventsListView_ShowAll');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "2";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 GROUP by ep.eventid ORDER by e.eventid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 

        $this->load->view('frontend/header'); 
        $this->load->view('frontend/eventsListView_ShowAll',$data); 

      
    }

    public function sendsms($mobile,$message){

                // sms start
                
               
                $text=str_replace(" ","%20",$message);
                $url = $this->db->get_where('smssettings' , array('id' =>1))->row()->url;
                $url .= $this->db->get_where('smssettings' , array('id' =>1))->row()->username;
                $url .= "&password=";
                $url .= $this->db->get_where('smssettings' , array('id' =>1))->row()->password;
                $url .= "&to=".$mobile;
                $url .= "&from=".$this->db->get_where('smssettings' , array('id' =>1))->row()->senderid;
                $url .= "&message=".$text;

                //echo $url."<br>";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                //echo $ch."<br>"; 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, '5');
                $content = trim(curl_exec($ch));
                curl_close($ch);
    }

    public function placegridview()
    {
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForPlaces();

       //echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/placegridview');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 and type='Things To Do' GROUP by pp.plid ORDER by p.plid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 
      $this->load->view('frontend/header');
      $this->load->view('frontend/placegridview',$data);

}

    public function resortgridview()
    {
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForResorts();

       //echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/resortgridview');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT * FROM tblresorts WHERE resortid!=1 AND status=1 ORDER by resortid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 
      $this->load->view('frontend/header');
      $this->load->view('frontend/resortgridvieww',$data);

}

  public function kidsdayout()
    {
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getKidsDayoutRows();

       //echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/kidsdayout');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 and p.type='Kids Day Out' GROUP by pp.plid ORDER by p.plid DESC limit ".$data['page'].", ".$config['per_page'];
       // echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
     //   echo $numberOfRows; 
      $this->load->view('frontend/header');
     $this->load->view('frontend/kidsdayout',$data);

}

 public function adventure()
    {
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getAdventureRows();

       //echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/adventure');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 and p.type='Adventure' GROUP by pp.plid ORDER by p.plid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
     //   echo $numberOfRows; 
      $this->load->view('frontend/header');
     $this->load->view('frontend/adventure',$data);

}

public function shopping()
    {
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getShoppingRows();

       //echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/shopping');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 and p.type='Shopping & Fashion' GROUP by pp.plid ORDER by p.plid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
     //   echo $numberOfRows; 
      $this->load->view('frontend/header');
     $this->load->view('frontend/shopping',$data);

}

public function weddings()
    {
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getWeddingRows();

       //echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/weddings');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 and p.type='Weddings/Banquets' GROUP by pp.plid ORDER by p.plid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
     //   echo $numberOfRows; 
      $this->load->view('frontend/header');
     $this->load->view('frontend/weddings',$data);

}

public function nightlife()
    {
      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNightlifeRows();

       //echo $numberOfRows."<br>";
       //pagination settings
        $config['base_url'] = site_url('frontend/nightlife');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        

       

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $sql = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 and p.type='Night Life' GROUP by pp.plid ORDER by p.plid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
     //   echo $numberOfRows; 
      $this->load->view('frontend/header');
     $this->load->view('frontend/nightlife',$data);

}







    public function showResortDetails($resortname='',$resortId=''){


      $data['resortid'] = $resortId;

      //$data['resortResults'] = $this->FrontEndModel->getResortDataBasedOnResortId($resortId);
      //get to know single checkout or multicheckout
      $res = $this->FrontEndModel->findOutSingleCheckoutOrMultipleCheckout($resortId);
      
      //echo $res->bookingtype;
      $resortname = str_replace(" ","-",$res->resortname);
      if($res->bookingtype=='multicheckout'){
        
        redirect('resorts-details/'.$resortname.'/'.$resortId);

      }else{
        $data['resortResults'] = $this->FrontEndModel->getResortDataBasedOnResortId($resortId);
        $this->load->view('frontend/header');

        $this->load->view('frontend/resortDetails',$data);
      }
      

    }


     public function showResortDetails2($resortId=''){


      $data['resortid'] = $resortId;

      $data['resortResults'] = $this->FrontEndModel->getResortDataBasedOnResortId($resortId);
      

      $this->load->view('frontend/header2');

        $this->load->view('frontend/resortDetails',$data);

    }

    public function showResortDetailsMultiCheckout($resortname='',$resortId=''){


      $data['resortid'] = $resortId;

      $data['resortResults'] = $this->FrontEndModel->getResortDataBasedOnResortId($resortId);
      

      $this->load->view('frontend/header');

        $this->load->view('frontend/multicheckoutDetails',$data);

    }

    public function showEventDetails($eventname='',$eventid=''){


      $data['eventid'] = $eventid;

      $data['eventResults'] = $this->FrontEndModel->getResortDataBasedOnEventId($eventid);
      

      $this->load->view('frontend/header');

        $this->load->view('frontend/eventDetails',$data);

    }

    public function orders()
    {
        $this->load->view('frontend/header');
        $this->load->view('frontend/orders');
    }

    public function bookZooTickets($packageid='')
    {
        $dt = $this->FrontEndModel->getUserNameMobileEmail($this->session->userdata('holidayEmail'));
        $data['name'] = $dt->name;
        $data['email'] = $dt->username;
        $data['mobile'] = $dt->number;
        $data['result'] = $this->FrontEndModel->getPackageDetailsBasedOnPackageId($packageid);
        $this->load->view('frontend/header');
        $this->load->view('frontend/details',$data);
        $this->load->view('frontend/cartmodal',$data);
        
    }

    public function registerForm(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/register');
    }

    public function registrationsuccess(){
      $this->load->view('frontend/header');
        $this->load->view('frontend/registrationsuccess');
    }

    public function myAccount(){
      //get details of user
      
     $data['userdetails'] =  $this->FrontEndModel->getUserDetails($this->session->userdata('holidayCustomerId'));
        $this->load->view('frontend/header');
        $this->load->view('frontend/myaccount',$data);
    }

    public function loginForm(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/login');
    }
  public function terms(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/terms');
    }
  public function paymentpolicy(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/payment_policy');
    }
  public function cancellationpolicy(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/cancellation_policy');
    }
  public function privacypolicy(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/privacy_policy');
    }
  public function contactus(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/contact_us');
    }

    public function forgotForm(){
        $this->load->view('frontend/header');
        $this->load->view('frontend/forgot');
    }


public function getPackageAmountAndSetMarkUp(){

  $packageid = $this->input->post('packageid');
  echo $packageid;

}
    

    public function updateMyAccount(){


                    $name = $this->input->post('name');
                    $email = $this->input->post('email');
                    $mobile = $this->input->post('mobile');

                    $newpassword = $this->input->post('newpassword');
                    $cpassword = $this->input->post('cpassword');
                    $checkBoxValue = $this->input->post('updatepassword');


                    if (isset($checkBoxValue)) {
                        $this->form_validation->set_rules("newpassword", "password", "trim|required|matches[cpassword]");
                        $this->form_validation->set_rules("cpassword", "Confirm Password", "trim|required");

                         if ($this->form_validation->run() == FALSE)
                    {  
                        $data['userdetails'] =  $this->FrontEndModel->getUserDetails($this->session->userdata('holidayCustomerId'));
                        $this->load->view('frontend/header');
                        $this->load->view('frontend/myaccount',$data);

                    }else{

                        $convertedpassword = hash('sha512', $newpassword);
                        $data = array(
                                     'name' => $name,
                                     'number' => $mobile,
                                     'password' => $convertedpassword
                                  );

                      $this->db->where('customer_id', $this->session->userdata('holidayCustomerId'));
                      $this->db->update('tblcustomers', $data); 
                      $this->session->set_flashdata('error-msg','<div class="alert alert-success text-center">Name,Mobile and Password Updated Successfully</div>');

                       $data['userdetails'] =  $this->FrontEndModel->getUserDetails($this->session->userdata('holidayCustomerId'));
                        redirect('frontend/myAccount');

                    }


                    }else{
                      //echo 'unchecked';
                      $data = array(
                                     'name' => $name,
                                     'number' => $mobile
                                  );
                       //print_r($data);
                      $this->db->where('customer_id', $this->session->userdata('holidayCustomerId'));
                      $this->db->update('tblcustomers', $data); 
                       $this->session->set_flashdata('error-msg','<div class="alert alert-success text-center">Name and Number Updated Successfully</div>');

                        //$data['userdetails'] =  $this->FrontEndModel->getUserDetails($this->session->userdata('holidayCustomerId'));
                      redirect('frontend/myAccount');
                    }

                    



    }


     public function register(){

                    $name = $this->input->post('name');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $cpassword = $this->input->post('cpassword');
                    $mobile = $this->input->post('mobile');
                    //$url = $this->input->post('url');

                //first check if user exists or not
                $result =  $this->FrontEndModel->checkIfCustomerEmailOrMobileExists($email,$mobile);

                //echo "\n the result count is: ".$result."\n";
                           
                           if($result==0){
                            $randNumber = rand(9999,99999);
                            $this->session->set_userdata('register-otp',$randNumber);
                            
                            $msg = 'OTP for registration at Book4Holiday is: '.$randNumber.'. Please enter the OTP and complete the process';

                             $this->sendsms($mobile,$msg);

                            echo $randNumber;

                           }else{
                          
                            echo "false";
                            
                           }

    }


    public function registrationresendotp(){
      $mobile = $this->input->post('mobile');

      $randNumber = rand(9999,99999);
      $msg = 'OTP for registration at Book4Holiday is: '.$randNumber.'. Please enter the OTP and complete the process';

                             $this->sendsms($mobile,$msg);

                            echo $randNumber;

    }



 public function registerconfirm(){

                    
                    $name = $this->input->post('name');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $cpassword = $this->input->post('cpassword');
                    $mobile = $this->input->post('mobile');
                    $otp = $this->input->post('otp');
                    
                    //insert
                    $convertedpassword = hash('sha512', $password);
            
                    
                            $dt = date('Y-m-d');

          $this->db->query("insert into tblcustomers (name,username,password,number,dateofcreation,regtype) VALUES ('$name','$email','$convertedpassword','$mobile','$dt','registration')");

                            $this->sendsms($mobile,'Thank you for registering at Book4Holiday!');
                            
                            // send mail to user //

                            $to=$this->input->post('email');
                            
                            $this->load->library('email');
                            $data['email'] =  $this->input->post('email');
     

                            $this->email
                                ->from('info@book4holiday.com', 'Book4Holiday')
                                ->to($email)
                                ->subject('Registration Success')
                                ->message($this->load->view('frontend/registrationemail',$data,true))
                                ->set_mailtype('html');

                            // send email
                            $this->email->send();

                            //user email ends here //
                            $this->session->set_flashdata('register-success','<div class=alert alert-success text-center>You are successfully registered</div>');

                             //$this->load->view('frontend/header');
                             //redirect('login');

                              echo "true";

 }


    public function validate_email(){

      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $convertedpassword = hash('sha512', $_POST['password']);
     
      $result = $this->FrontEndModel->checkIfCustomerIsValid($email,$convertedpassword);
           if ($result <1)
          {
            $this->form_validation->set_message('validate_email', 'The Email Id or Password seems to be wrong.');
            return FALSE;
          }
          else
          {
            return TRUE;
          }


    }


    public function validateemailforgot(){

      $email = $this->input->post('email');
      
     
      $result = $this->FrontEndModel->checkIfCustomerIsValid_forgot($email);
      //echo "count is: ".$result;
           if ($result <1)
          {
            $this->form_validation->set_message('validateemailforgot', 'We dont have your Email Account with us. Please register');
            return FALSE;
          }
          else
          {
            return TRUE;
          }


    }


    public function forgotpassword()
    {
      $email = $this->input->post('email');
      $this->form_validation->set_rules("email", "Email", "trim|required|callback_validateemailforgot");
        
                  if ($this->form_validation->run($this) == FALSE)
                  {  
                        $this->load->view('frontend/header');
                        $this->load->view('frontend/forgot');
                        //validation fails

                    }else{
                            //all validations correct
                        //echo "true";
                      $resetpassword =  rand(9999,999999);
                  $convertedpassword = hash('sha512', $resetpassword);
                  $data = array(
                                 'password' => $convertedpassword
                              );

                  $this->db->where('username', $email);
                  $this->db->where('regtype', 'registration');
                  $this->db->update('tblcustomers', $data); 
                  $msg = 'Your password is: '.$resetpassword;

                $mobile =  $this->db->get_where('tblcustomers' , array('username' =>$email,'regtype' => 'registration'))->row()->number;
                 // echo $email."<br>";
                  //echo $msg."<br>";
                  //echo $mobile."<br>";

                  $this->sendsms($mobile,$msg);

                  $this->session->set_flashdata('error-msg','<div class="alert alert-success text-center">A new password has been sent to your Registered Phone. Please login and change the password</div>');
                  redirect('frontend/loginForm');

                        }

      
    }

    public function loginCheck(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $convertedpassword = hash('sha512', $password);
     
      $result = $this->FrontEndModel->checkIfCustomerIsValid($email,$convertedpassword);
           if ($result==0)
          {
            $this->session->set_flashdata('error-msg','<div style="color:red;">Email Id and Password combination seems to be wrong.</div>');
            echo $result."<br>";
             $this->load->view('frontend/header');
            $this->load->view('frontend/login');
          }
          else
          {
           $this->session->set_userdata('holidayEmail',$email);
           $this->session->set_userdata('holidayCustomerName',$this->FrontEndModel->getNameOfCustomerOnEmail($email));
           $this->session->set_userdata('holidayCustomerId',$this->FrontEndModel->getIdOfCustomerOnEmail($email));
           redirect('home');
        }   
                     

    }

    public function about()
    {
        $this->load->view('frontend/about');
    }

    public function trustees()
    {
        $this->load->view('frontend/trustees');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home');
    }

    

    // populating raasi //

  public function ajax_get_raasi1(){
      $birth_star_id=$_REQUEST['birth_star_id'];
      $res=$this->Adminmodel->get_raasi_code('birth_star',$birth_star_id);
      $output=explode(',',$res);
      echo $output['0'];
    }



  

    public function registerdata()
    {
        $this->load->view('frontend/registerdata');
    }

    public function contact()
    {
        $this->load->view('frontend/contact');
    }

    public function feedback()
    {
        $this->load->view('frontend/feedback');
    }

    public function submitfeedback()
    {
        $name = $this->input->post('name');
        //echo '<h3>name is :</h3>'.$name;

        $mobile = $this->input->post('mobile');
        //echo '<h3>mobile is :</h3>'.$mobile;

        $email = $this->input->post('email');
        //echo '<h3>email is :</h3>'.$email;

        $message = $this->input->post('message');
        //echo '<h3>message is :</h3>'.$message;

        // mail code //

        $to="raju.m.d539@gmail.com";
        $subject = "Feedback & Suggestions";
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
        $headers .= 'From: Healthy Matrimony Support <healthymatrimonial@gmail.com>'."\r\n";
        $message="<html>
        <style>
        .panel-body{padding:15px;border:solid 1px green;}
        .panel-heading{padding:10px 15px;border-bottom:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px}

        .panel{border-color:#d6e9c6}
        .panel>.panel-heading{color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6}
        .panel>.panel-heading>.panel-body{border-top-color:#d6e9c6}
        .panel>.panel-heading {color:#dff0d8;background-color:#3c763d}
        .panel> .panel-body{border-bottom-color:#d6e9c6}
        .text1{
          font-family: sans-serif;
        }
         
        }
        </style>
        <body>
        <div class='panel'>
          <div class='panel-heading'>
          
          </div>
          <div class='panel-body'>
            
            <h4>Hello! Admin,</h4>
            <p class='text1'>A User with email ID '".$email."' has sent FEEDBACK/SUGGESTION.<br><br>
            </p>
            <p>Name : '".$name."'</p><br>
            <p>Mobile : '".$mobile."'</p><br>
            <p>Message : '".$message."'</p><br>
          </div>
        </div>
        </body>
        </html>";

        // mail code //

        $this->session->set_flashdata('success','<div class="alert alert-success text-center">Successfully Sent Feedback/Suggestion..</div>');
        redirect('frontend/feedback');


    }

    public function myorders(){

      
      //$customerid= $this->session->userdata('holidayCustomerId');
      // $data['myorders']= $this->FrontEndModel->getAllSuccessfulOrdersOfUser($customerid);
      $this->load->view('frontend/header');
      $this->load->view('frontend/myorders');

    }

    public function invoice($bookingid=''){

      $data['bookingsResults']= $this->FrontEndModel->getAllBookingRelatedDetailsOnBookingId($bookingid);

      //$this->load->view('frontend/header');
      $this->load->view('frontend/invoice',$data);

    }


    public function guestLoginForm(){
      $this->load->view('frontend/header');
      $this->load->view('frontend/guestlogin');
    }

    public function sendRegisterEmail($email,$password)
    {
      // send mail to user //

      $to=$email;
      $subject = "Registration Success";
      $headers = "MIME-Version: 1.0"."\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
      $headers .= 'From: Book4Holiday Support <info@book4holiday.com>'."\r\n";
      $message='<!doctype html>
      <html>
      <head>
      <meta charset="utf-8">

      </head>

      <body>


          <table width="700" height="500" bgcolor="black" align="center">
            <tr>
              <td>
                    <table cellpadding="0" cellspacing="0" style="width:600px;margin:0 auto;padding:0px;font-family:Arial,Helvetica,sans-serif;font-size:12px">
      <tbody>
      <tr>
      <td style="width:600px">
      <div style="width:600px;float:left">
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="font-size:12px;background-color:#1f2533;padding:15px 15px">
      <tbody>
      <tr>
      <td style="width:300px;padding:8px 0 0 0;text-align:left"><a href="#" style="text-decoration:none;color:#010101" target="_blank" data-saferedirecturl="#"><!--<img alt="BookMyShow" height="70" border="0" width="200" style="margin:0px auto" src="book4.png" class="CToWUd">--><h3 style="color:#FFF; font-family:Arial Black; font-size:18px;">Book <span style="color:#49ba8e;">4</span> Holiday</h3>
      </a></td>
      <td style="width:30px;padding-top:8px;text-align:left"><img alt="helpline phone" height="20" border="0" width="18" src="https://ci3.googleusercontent.com/proxy/ox1pr8SuruzQrAsTBgtdjSlHhf0BodFY1HY033BSEDpQQx41C7mSyS3nVKhXYKB2WK98ymYskV6_gH0967w5847IDkg85kno18hz0PjzvlWj2HI=s0-d-e1-ft#http://cnt.in.bookmyshow.com/webin/emailer/helpline-phone.png" class="CToWUd">
      </td>
      <td style="width:80px;text-align:left;color:#49ba8e;padding-top:5px;line-height:14px">
      <span style="font-size:11px">Helpline:</span> <br>
      <span style="letter-spacing:1px;font-weight:bold"><a href="tel:+912261445050" style="text-decoration:none;color:#49ba8e" target="_blank">6144 5050</a>
      </span></td>
      <td style="width:10px;text-align:left;color:gray;padding-top:10px;line-height:14px;font-size:18px">
      |</td>
      <td style="width:180px;font-size:12px;color:#49ba8e;font-weight:bold;padding-top:17px">
      <a href="mailto:info@Book4Holiday.com" style="text-decoration:none;color:#49ba8e" target="_blank">info@book4holiday.com</a>
      </td>
      </tr>
      </tbody>
      </table>
      <table cellpadding="0" cellspacing="0" style="width:600px;margin:0;padding:0px;float:left;background:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#565656">
      <tbody>
      <tr>
      <td style="width:600px;vertical-align:top">
      <table cellpadding="0" cellspacing="0" style="width:600px;margin:0;padding:15px 10px;float:left;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#565656">
      <tbody>
      <tr>
      <td colspan="2">Dear <strong>Customer </strong>, <br>
      <br>
      Below are your account details </td>
      </tr>
      <tr>
      <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
      <td colspan="2">Username : <strong><a href="#" style="text-decoration:none;" target="_blank">'.$email.'</a></strong></td>
      <td colspan="2">Password : <strong><a href="#" style="text-decoration:none;" target="_blank">'.$password.'</a></strong></td>
      </tr>
      <tr>
      <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
      <td colspan="2">So now buy all holiday tickets with the best offers on book4holiday</td>
      </tr>
      <tr>
      <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
      <td colspan="2" style="font-size:16px"><a href="#" style="font-weight:bold;text-decoration:underline;color:#49ba8e" target="_blank" data-saferedirecturl="#">www.book4holiday.com</a>
      </td>
      </tr>
      <tr>
      <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
      <td colspan="2" style="color:#d6181f;font-size:20px;font-weight:bold;font-family:Arial,Helvetica,sans-serif">
      Enjoy the Holiday!</td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
      </tbody>
      </table>
      </div>
      </td>
      </tr>

        <!--3rd line start-->

      <tr>
      <td align="center" style="width:600px">
      <table cellpadding="0" cellspacing="0" align="center" style="width:600px;background:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#7c7c7c">
      <tbody>
      <tr>
      <td align="center" style="width:180px;padding:10px 10px 0 20px;vertical-align:top;background:#f2f2f2">
      <table align="center" cellpadding="0" cellspacing="0" style="padding:0;font-size:11px;width:180px;float:left;font-family:Arial,Helvetica,sans-serif;color:#7c7c7c">
      <tbody>
      <tr>
      <td colspan="2" style="padding:5px 0 0 10px;width:170px;font-size:13px;font-weight:bold;color:#7c7c7c">
      Mobile Application</td>
      </tr>
      <tr>
      <td style="width:76px;padding-top:10px"><a href="#" style="text-decoration:none;color:#60abe4" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://mandrillapp.com/track/click/13389779/in.bookmyshow.com?p%3DeyJzIjoiRXJjRWwzZW1DTmlUV2xRY0hWRmt1Zkw4QlpRIiwidiI6MSwicCI6IntcInVcIjoxMzM4OTc3OSxcInZcIjoxLFwidXJsXCI6XCJodHRwOlxcXC9cXFwvaW4uYm9va215c2hvdy5jb21cXFwvbW9iaWxlXFxcL1wiLFwiaWRcIjpcImVlYmU0MzRmZjZmYjRkMGNiZmJhYmE2ODk0NDIzZjYzXCIsXCJ1cmxfaWRzXCI6W1wiOWJiZDYxN2UxNGZiNTQ2NzQzMmEwMmNmMDRlNmNkODIyZWY0NTQwYVwiXX0ifQ&amp;source=gmail&amp;ust=1465902897173000&amp;usg=AFQjCNG0HPjm_qxrPFJ6D8pD9NpvxSFs7w"><img alt="" src="https://ci5.googleusercontent.com/proxy/UkpoyxX1unvOpExFb_lZm0qcM38Fx_Xbdpc10WKaiq0sdx0BUPi018j-SfgUdxKi7SbZLeugOWM7ycoRnXBsM5PI0fXp4JcGxkPlNDS3sZ8B=s0-d-e1-ft#http://cnt.in.bookmyshow.com/webin/emailer/mobile-app01.png" class="CToWUd">
      </a></td>
      <td valign="top" style="width:86px;padding:15px 0 15px 10px;font-size:11px;line-height:14px">
      Holiday<br>
      tickets on the go<br>
      <a href="#" style="text-decoration:none;color:#60abe4" target="_blank" data-saferedirecturl="#">DOWNLOAD APP</a><br>(Coming Soon)</td>
      </tr>
      </tbody>
      </table>
      </td>
      <td align="center" style="width:190px;padding:10px 10px 0 0;vertical-align:top;background:#f2f2f2">
      <table align="center" cellpadding="0" cellspacing="0" style="padding:0;width:190px;font-size:11px;float:left;font-family:Arial,Helvetica,sans-serif;color:#7c7c7c">
      <tbody>
      <tr>
      <td colspan="2" style="padding:5px 0 0 15px;width:175px;font-size:13px;font-weight:bold;color:#7c7c7c">
      </td>
      </tr>
      <tr>
      <td valign="middle" style="width:54px;padding:15px 0 10px 15px;border-left:1px solid #bebebe">
      </td>
      <td style="width:91px;padding:15px 10px 15px 5px;font-size:11px;border-right:1px solid #bebebe">
      <br>
      </td>
      </tr>
      </tbody>
      </table>
      </td>
      <td align="center" style="width:180px;padding:10px 10px 0 0;vertical-align:top;background:#f2f2f2">
      <table align="center" cellpadding="0" cellspacing="0" style="padding:0 0 0 10px;width:170px;float:left;font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#7c7c7c">
      <tbody>
      <tr>
      <td colspan="2">
      <a href="#" style="text-decoration:none;">
      <p style="color:#49ba8e; font-family:Arial Black; font-size:18px;">Book <span style="color:#000;">4</span> Holiday</p>
      </a></td>
      </tr>
      <tr>
      <td>Your holiday ends here <br>
      <a href="#" style="text-decoration:none;color:#60abe4" target="_new" data-saferedirecturl="#">Know
       more</a></td>
      </tr>
      </tbody>
      </table>
      </td>
      </tr>
        <!--footer start-->
      <tr>
          <td align="center">
            <a href="#" style="text-decoration:none;">
      <p style="color:#49ba8e; font-family:Arial Black;">Book <span style="color:#000;">4</span> Holiday</p>
      </a>
          </td>
          
          <td style="padding-left:35px;">
            <a href="#" style="text-decoration:none;"><a href="#" style="text-decoration:none;">
      <p style="color:#000; font-family:Arial,Helvetica,sans-serif; font-size:12px; line-height:20px;">Terms & Conditions <br> Cancelation Policy <br> Privacy Policy</p></a>
      </a>
          </td>
          
          <td style="padding-left:0px;">
            <a href="#" style="text-decoration:none;"><a href="#" style="text-decoration:none;">
      <p style="color:#000; font-family:Arial,Helvetica,sans-serif; font-size:12px; line-height:20px;"><span style="color:#49ba8e; font-weight:500;">Address:</span> <br> Plot No.21/3, Jay Enclave, 
      <br> Images Garden Road, Madhapur, <br> Hyderabad, TS </p></a>
      </a>
          </td>
          
          
          
      </tr>
        <!--footer end-->
      </tbody>
      </table>
      </td>

      </tr>

        <!--3rd line end-->
          <!--footer start-->

          
      </tbody>
      </table>
                  </td>    
              </tr>
          </table>
          

      </body>
      </html>
      ';
      
      mail($to, $subject, $message, $headers);
    }

    public function submitGuestlogin()
    {
      $email = $this->input->post('email');
      //echo $email."<br>";
      $password = $this->input->post('password');
      //echo $password."<br>";
      $mobile = $this->input->post('mobile');
      //echo $mobile."<br>";
      $name = $this->input->post('name');
      //echo $name."<br>";

      $this->form_validation->set_rules("email", "Email", "trim|required");
      $this->form_validation->set_rules("mobile", "mobile", "trim|required|min_length[10]|max_length[10]");
      if ($this->form_validation->run() == FALSE)
      {  
        $this->load->view('frontend/header');
        $this->load->view('frontend/guestlogin');
      }else{
         //all validations correct
         //first check if user exists or not

         
         $result =  $this->FrontEndModel->checkIfCustomerEmailOrMobileExists($email,$mobile);
         echo $result;
         if($result<1){
          //insert
          $convertedpassword = hash('sha512', $this->input->post('password'));
  
          $data = array(
             'name' => $name ,
             'username' => $email ,
             'password' => $convertedpassword,
             'number' => $mobile,
             'dateofcreation' => date('Y-m-d')
          );

          $this->db->insert('tblcustomers', $data);

          $this->sendRegisterEmail($this->input->post('email'),$this->input->post('password'));

          //$this->sendsms($mobile,'Thank you for the Registration. From Book4Holiday');
          $this->session->set_userdata('holidayEmail',$email);
          $this->session->set_userdata('holidayCustomerName',$this->FrontEndModel->getNameOfCustomerOnEmail($email));
          $this->session->set_userdata('holidayCustomerId',$this->FrontEndModel->getIdOfCustomerOnEmail($email));
          redirect('frontend/index');
        }else{
          $this->session->set_flashdata('error-msg','<div class="alert alert-danger text-center">We have your Email Account. Please click forgot password to get new password to login</div>');
          $this->load->view('frontend/header');
          $this->load->view('frontend/guestlogin');
        }
        
      }
    }



    public function sendingEmailTickets($email,$ticketnumber,$name,$location)
    {
      $data['ticketnumber']=$ticketnumber;
      $data['name']=$name;
      $data['location']=$location;
      $packageid = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->packageid;

      $data['packagename'] = $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->amount;

      $data['amount'] = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->amount;

      $data['dateofvisit'] = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->dateofvisit;

       $data['numberofadults'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->numberofadults;

       $data['adultpriceperticket'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->adultpriceperticket;

       $data['numberofchildren'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->numberofchildren;

       $data['childpriceperticket'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->childpriceperticket;


       $data['noofkidsmeal'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->noofkidsmeal;

       $data['kidsmealprice'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->kidsmealprice;

       $data['internetcharges'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->internetcharges;

       $data['servicetax'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->servicetax;

       $data['swachhbharath'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->swachhbharath;

       $data['krishkalyancess'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->krishkalyancess;

       $data['total'] = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->totalcost;

     $this->load->library('email');
     

$this->email
    ->from('info@book4holiday.com', 'Book4Holiday')
    ->to($email)
    ->subject('Booking Details')
    ->message($this->load->view('frontend/successemail',$data,true))
    ->set_mailtype('html');

// send email
$this->email->send();
    }


    

    public function sendingFailEmail($email,$ticketnumber)
    {
      $data['ticketnumber']=$ticketnumber;
      $data['amount'] = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->amount;

      $data['dateofvisit'] = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->dateofvisit;

     $this->load->library('email');
     

$this->email
    ->from('info@book4holiday.com', 'Book4Holiday')
    ->to($email)
    ->subject('Booking Details')
    ->message($this->load->view('frontend/failureemail',$data,true))
    ->set_mailtype('html');

// send email
$this->email->send();
    }


 
    

  
}

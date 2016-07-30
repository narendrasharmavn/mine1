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
      //echo $searchtype."<br>";
      //echo $searchdate."<br>";
     // echo $searchterm."<br>";
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

        echo "price rating".$pricerating."<br>";

        $data = array(
          'pricereview' => $pricerating,
          'subject' => $subject,
          'review' => $reviewtext,
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'resortname' => $resortid,
          'status' => 0
          );

        $this->db->insert('resortreviews', $data);
        $url = 'resorts/'.$resortname.'/'.$resortid;
        //echo $url;
        ?>
        <script>
          alert("Thank you for the review");
        </script>

        <?php
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
        
        

        $data = array(
          'pricereview' => $pricerating,
          'subject' => $subject,
          'review' => $reviewtext,
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'resortoreventname' => $eventid
          );

        $this->db->insert('eventreviews', $data);
        $eventname = str_replace(" ","-",$eventname);
        $url = 'eventdetails/'.$eventname.'/'.$eventid;
       ?>
        <script>
          alert("Thank you for the review");
        </script>

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

        $data = array(
          'pricereview' => $pricerating,
          'subject' => $subject,
          'review' => $reviewtext,
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'placeid' => $placeid
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
      
                    $this->form_validation->set_rules("searchtype", "searchtype", "trim|required");
                    $this->form_validation->set_rules("searchterm", "searchterm", "trim|required");
                   
                     if ($this->form_validation->run() == FALSE)
                    {  
                        //get latest 6 events to load on index page
                            $data['events']= $this->FrontEndModel->getLatestSixEvents();

                            $this->load->view('frontend/header');
                            $this->load->view('frontend/index',$data);
                        //validation fails

                    }else{
                        //all validations correct
                        $searchtype = $this->input->post('searchtype');
                        $searchterm = addslashes($this->input->post('searchterm'));
                        $searchdate = $this->input->post('date');

                          
                         if ($searchtype!='' || $searchterm!='') {
                          //echo "true"."<br>";
                          //echo $searchterm."<br>";

                               $this->session->set_userdata('searchtype',$searchtype);
                               $this->session->set_userdata('searchterm',$searchterm);
                               if($searchdate!=''){
                                $searchdate = date('Y-m-d', strtotime($searchdate));
                                $this->session->set_userdata('searchdate',$searchdate);
                               }
                               
                               //echo "session in search term is: ".$this->session->set_userdata('searchterm')."<br>";
                               
                          }
                          

                         if ($searchtype=="eventname") {

                          if ($searchdate=='')
                          {  
                              //get latest 6 events to load on index page
                                $this->session->set_flashdata('error-msg','<div class="alert alert-success text-center">Please select a date</div>');
                                  $data['events']= $this->FrontEndModel->getLatestSixEvents();


                                  $this->load->view('frontend/header');
                                  $this->load->view('frontend/index',$data);
                              //validation fails

                          }else{
                          

                         $this->eventsGridView();
                       }

                           
                          } else if ($searchtype=="resortname") {
                            //echo "amar";

                            $this->resortsGridView();
                            
                          }else{
                            $this->placesGridView();
                          }
                        }

     

    }


    public function nosessionhandlerOTPCheckResorts(){

      $name = $this->input->post('name');
      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');

      //send sms
      $randNumber = rand(9999,99999);
      $msg = "Your OTP number is : ".$randNumber;
      $this->sendsms($mobile,$msg);
      $this->session->set_userdata( 'otp-resort-booking' ,$randNumber);

      echo "true";
      echo "Message is: ".$msg;

    }

    public function nosessionhandler(){
      $name = $this->input->post('name');
      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');
      $otp = $this->input->post('otp');

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

                     

                    $bookingsdata = array(
                        'dateofvisit' => $this->session->userdata('dateofvisit'),
                        'date'=>date('Y-m-d'),
                        'userid' => $customerid,
                        'quantity' => $this->session->userdata('numberofadults'),
                        'booking_status' => 'pending',
                        'packageid'=>$this->session->userdata('packageid'),
                        'amount'=>$this->session->userdata('totalcost'),
                        'payment_status'=>'pending',
                        'ticketnumber' => date('Ymdhis'),
                        'visitorstatus' => 'absent',
                        'vendorid' => $this->session->userdata('vendorid'),
                        'childqty' => $this->session->userdata('numberofchildren'),
                        'kidsmealqty' => $this->session->userdata('kidsmealqty')
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
                        'kidsmealprice' => $this->session->userdata('kidsmealprice')

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

      //check otp correct or not through session
      
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

              $packageIdArray = $this->session->userdata('packageIdArray');
              $numberofadults = $this->session->userdata('numberofadultsArray');
              $numberofchildren = $this->session->userdata('numberofchildrenArray');
              $kidsmealqty = $this->session->userdata('kidsmealqty');
              $dateofvisit = $this->session->userdata('dateofvisit');
              $vendorid = $this->session->userdata('vendorid');

              $ticketnumber = date('Ymdhis');
              $calculatedinternetcharges = 0;
              $calculatedadultprice=0;
              $calculatedchildprice=0;

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
                        $this->insertDataIntotblbookingsForMultiCheckoutNoSession($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber,$customerid);
                        //end of insert database
                 
            }//end of for loop

            $kidsmealqty = $this->session->userdata('kidsmealqty');
               // echo "calculated  adult price ".$calculatedadultprice."\n";
                //echo "calculated  child price ".$calculatedchildprice."\n";

               $calculatedkidsmealprice =  $kidsmealqty * $kidsmealpricefromdb;
                //echo "calculated  kids meal PRICE ".$kidsmealqty."\n";
                //now apply tax on kids meal price
                $calculatedinternetcharges += ( ( $calculatedkidsmealprice * $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->kidsmealtax )/100  );

                //echo "calculatedkidsmealprice price ".$calculatedkidsmealprice."\n";
                 //echo "calculatedinternetcharges price ".$calculatedinternetcharges."<br>";
                //now calculate service tax over internet charges
                $calculatedservicetax = round( $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->servicetax  )/100,1);
                 
                //now calculate swachh cess
                $calculatedswacchcess = round( $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->swachcess  )/100,1);
                //now calculate krishi cess
                $calculatedkrishicess = round( $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->krishicess  )/100,1);


                //echo "calculatedservicetax price ".$calculatedservicetax."\n";
                //echo "calculatedswacchcess price ".$calculatedswacchcess."\n";
                //echo "calculatedkrishicess price ".$calculatedkrishicess."\n";
                

                $total = 0;
                $total += ( $calculatedadultprice + $calculatedchildprice + $calculatedkidsmealprice + $calculatedinternetcharges + $calculatedservicetax + $calculatedswacchcess + $calculatedkrishicess );
                $total = round($total,1);
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

          /*
          echo "<pre>";
          print_r($bokIdArr);
          echo "</pre>";
          */


          //insert into tablepayments
          //insert into database
                

                      $this->insertDataIntotblpaymentsForMultiCheckoutNoSession($total,$ticketnumber,$customerid);

          



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
      $msg = "Your OTP number is : ".$randNumber;
      $this->sendsms($mobile,$msg);
      $this->session->set_userdata( 'otp-event-booking' ,$randNumber);

      echo "true";

    }


    public function nosessionhandlerevents(){

      $mobile = $this->input->post('mobile');
      $email = $this->input->post('email');
      $name = $this->input->post('name');
      $otp = $this->input->post('otp');

      $OTP_CHECK = $this->session->userdata('otp-event-booking');

      if ($OTP_CHECK==$otp) {
       
        $customerData = array(

          'name' => 'Guest',
          'username' => $email,
          'password' => hash('sha512',rand(9999,99999)),
          'number' => $mobile,
          'dateofcreation' => date('Y-m-d')


          );

        $this->db->insert('tblcustomers',$customerData);
        $customerid = $this->db->insert_id();

        
      $bookingsdata = array(
          'dateofvisit' => $this->session->userdata('dateofvisit'),
          'date'=>date('Y-m-d'),
          'userid' => $customerid,
          'quantity' => $this->session->userdata('numberofadults'),
          'booking_status' => 'pending',
          'packageid'=>$this->session->userdata('packageid'),
          'amount'=>$this->session->userdata('totalcost'),
          'payment_status'=>'pending',
          'ticketnumber' => date('Ymdhis'),
          'visitorstatus' => 'absent',
          'vendorid' => $this->session->userdata('vendorid'),
          'childqty' => $this->session->userdata('numberofchildren')

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
          'bookingid' => $this->session->userdata('bookingsid')

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
      $dateofvisit = $this->input->post('dateofvisit');
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
      //echo $adultprice;
      //calculate number of children price
      $childrenprice = $numberofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
      
      //calculate kids meal price
      $kidsmealprice = $kidsmealqty * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->kidsmealprice;
      //echo $kidsmealprice;
      $subtotal = $adultprice + $childrenprice + $kidsmealprice;
      //echo $subtotal;
      $serviceTaxFromDB = $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax;
      //now calculate service tax
      $calculatedInternetCharges = ($subtotal*$serviceTaxFromDB)/100;
      //echo $calculatedInternetCharges;
      //now calculate service tax over internet charges
      $calculatedServiceTax = ($calculatedInternetCharges*14) / 100;
      //echo $calculatedServiceTax;
       //now calculate Swachh Bharath tax over internet charges
      $calculatedSwachhBharath = ($calculatedInternetCharges*0.5) / 100;
      //echo $calculatedSwachhBharath;
       //now calculate Krishi Kalyan Cess over internet charges
      $calculatedKkCess = ($calculatedInternetCharges*0.5) / 100;
      //echo $calculatedKkCess;

      //add sub total , calculated service tax and kids meal price
      $total = ceil($subtotal+$calculatedServiceTax+$calculatedInternetCharges+$calculatedSwachhBharath+$calculatedKkCess);
      //echo $total;

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

      $bookingsdata = array(
          'dateofvisit' => $this->session->userdata('dateofvisit'),
          'date'=>date('Y-m-d'),
          'userid' => $this->session->userdata('holidayCustomerId'),
          'quantity' => $this->session->userdata('numberofadults'),
          'booking_status' => 'pending',
          'packageid'=>$this->session->userdata('packageid'),
          'amount'=>$this->session->userdata('totalcost'),
          'payment_status'=>'pending',
          'ticketnumber' => date('Ymdhis'),
          'visitorstatus' => 'absent',
          'vendorid' => $this->session->userdata('vendorid'),
          'childqty' => $this->session->userdata('numberofchildren'),
          'kidsmealqty' => $this->session->userdata('kidsmealqty')


      );


     if ($this->session->userdata('holidayEmail')) {
       # code...
     
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
          'internetcharges'=> $this->session->userdata('internetcharges'),
          'swachhbharath'=> $this->session->userdata('swachhbharath'),
          'krishkalyancess'=> $this->session->userdata('kkcess'),
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'status' => 'unpaid',
          'bookingid' => $this->session->userdata('bookingsid'),
          'noofkidsmeal' => $this->session->userdata('kidsmealqty'),
          'kidsmealprice' => $this->session->userdata('kidsmealprice')

      );
    
        $this->db->insert('tblpayments',$paymentsdata); 
        $this->session->set_userdata('paymentsid',$this->db->insert_id());
      
      echo "true";
    
      }else{
        echo "false";
      }

    }


    public function insertDataIntotblbookingsForMultiCheckout($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber){

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
          'kidsmealqty' => $kidsmealqty


      );


     
       # code...
     
        $this->db->insert('tblbookings',$bookingsdata); 
        

       array_push($this->bookingsIdArray,$this->db->insert_id()); 
       $this->session->set_userdata('bookingsIdArray',$this->bookingsIdArray);
    
   
    }


    public function insertDataIntotblbookingsForMultiCheckoutNoSession($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber,$customerid){

       $bookingsdata = array(
          'dateofvisit' => $dateofvisit,
          'date'=>date('Y-m-d'),
          'userid' => $customerid,
          'quantity' => $noofadults,
          'booking_status' => 'pending',
          'packageid'=>$packageid,
          'amount'=>$subtotal,
          'payment_status'=>'pending',
          'ticketnumber' => $ticketnumber,
          'visitorstatus' => 'absent',
          'vendorid' => $vendorid,
          'childqty' => $noofchildren,
          'kidsmealqty' => $kidsmealqty


      );


     
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
      $dateofvisit = date("Y-m-d", strtotime($dateofvisit));
      $packageIdArray = $this->input->post('packageIdArray');
      $kidsmealqty = $this->input->post('kidsmealqty');
      $currenturl = $this->input->post('currenturl');
      $vendorid = $this->input->post('vendorid');

      
      $ticketnumber = date('Ymdhis');


      $calculatedinternetcharges = 0;
      $calculatedadultprice=0;
        $calculatedchildprice=0;
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

            $this->insertDataIntotblbookingsForMultiCheckout($dateofvisit,$noofadults,$subtotal,$packageid,$vendorid,$noofchildren,$kidsmealqty,$ticketnumber);

          }

      }
      $kidsmealqty = $this->input->post('kidsmealqty');
     // echo "calculated  adult price ".$calculatedadultprice."\n";
      //echo "calculated  child price ".$calculatedchildprice."\n";

     $calculatedkidsmealprice =  $kidsmealqty * $kidsmealpricefromdb;
      //echo "calculated  kids meal PRICE ".$kidsmealqty."\n";
      //now apply tax on kids meal price
      $calculatedinternetcharges += ( ( $calculatedkidsmealprice * $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->kidsmealtax )/100  );

      //echo "calculatedkidsmealprice price ".$calculatedkidsmealprice."\n";
       //echo "calculatedinternetcharges price ".$calculatedinternetcharges."<br>";
      //now calculate service tax over internet charges
      $calculatedservicetax = round( $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->servicetax  )/100,1);
       
      //now calculate swachh cess
      $calculatedswacchcess = round( $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->swachcess  )/100,1);
      //now calculate krishi cess
      $calculatedkrishicess = round( $calculatedinternetcharges * ( $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->krishicess  )/100,1);


      //echo "calculatedservicetax price ".$calculatedservicetax."\n";
      //echo "calculatedswacchcess price ".$calculatedswacchcess."\n";
      //echo "calculatedkrishicess price ".$calculatedkrishicess."\n";
      

      $total = 0;
      $total += ( $calculatedadultprice + $calculatedchildprice + $calculatedkidsmealprice + $calculatedinternetcharges + $calculatedservicetax + $calculatedswacchcess + $calculatedkrishicess );
      $total = round($total,1);
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

/*
echo "<pre>";
print_r($bokIdArr);
echo "</pre>";
*/


//insert into tablepayments
//insert into database
        if ($this->session->userdata('holidayEmail')) {

            $this->insertDataIntotblpaymentsForMultiCheckout($total,$ticketnumber);

          }



          $paymentIdArr = $this->session->userdata('paymentsIdArray');

/*
echo "<pre>";
print_r($paymentIdArr);
echo "</pre>";
*/

      //keep these arrays in session
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


echo "true";

  }


  public function insertDataIntotblpaymentsForMultiCheckout($total,$ticketnumber){

    $paymentsdata = array(
          'customerid' => $this->session->userdata('holidayCustomerId'),
          'transaction_id'=>date('Ymdhis'),
          'transdate' => date('Y-m-d'),
          'amount' => $total,
          'ticketnumber'=>$ticketnumber,
          'status'=>'unpaid'

      );
    
        $this->db->insert('tblpayments',$paymentsdata); 
        

        $this->session->set_userdata('paymentsid',$this->db->insert_id());


  }

  public function insertDataIntotblpaymentsForMultiCheckoutNoSession($total,$ticketnumber,$customerid){

    $paymentsdata = array(
          'customerid' => $customerid,
          'transaction_id'=>date('Ymdhis'),
          'transdate' => date('Y-m-d'),
          'amount' => $total,
          'ticketnumber'=>$ticketnumber,
          'status'=>'unpaid'

      );
    
        $this->db->insert('tblpayments',$paymentsdata); 
        

        $this->session->set_userdata('paymentsid',$this->db->insert_id());


  }

    
   public function confirmbookingsevents(){

      $packageid = $this->input->post('packageid');
      $dateofvisit = $this->input->post('dateofvisit');
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
      
      //calcluate number of adults price
      $adultprice = $numberofadults * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->adultprice;
      //echo $adultprice;
      
      //calculate number of children price
      $childrenprice = $numberofchildren * $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->childprice;
      //echo $childrenprice;

      $subtotal = $adultprice + $childrenprice;
      $internethandlingcharges = $this->db->get_where('tblpackages' , array('packageid' => $packageid ))->row()->servicetax;
      //now calculate internet handling charges
      $calculatedInternetCharges = ($subtotal*$internethandlingcharges)/100;

      //now calculate service tax of 15 % over internet charges
      $calculatedServiceTax = ($calculatedInternetCharges*14)/100;

      //now calculate Swachh Bharath tax of 0.05 % over internet charges
      $calculatedSwachhBharat = ($calculatedInternetCharges*0.5)/100;

      //now calculate Krish Kalyan Cess tax of 0.05 % over internet charges
      $calculatedKkCess = ($calculatedInternetCharges*0.5)/100;


      //add sub total , calculated service tax 
       $total = ceil($subtotal+$calculatedInternetCharges+$calculatedServiceTax+$calculatedSwachhBharat+$calculatedKkCess);

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
          'ticketnumber' => date('Ymdhis'),
          'visitorstatus' => 'absent',
          'vendorid' => $this->session->userdata('vendorid'),
          'childqty' => $this->session->userdata('numberofchildren')


      );


     if ($this->session->userdata('holidayEmail')) {
       # code...
     
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
          'bookingid' => $this->session->userdata('bookingsid')

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

      $paymentid = $this->session->userdata('paymentid');
      $bookingid = $this->session->userdata('bookingid');
      $servicetax = $this->session->userdata('servicetax');
      $vendorid = $this->session->userdata('vendorid');


      $amountreceived = ($_POST['amt'])-($servicetax);

/*
      $paymentsdata = array(
          'banktransaction'=>$_POST['bank_txn'],
          'transactiondescription'=>$_POST['desc'],
          'transaction_id'=>$_POST['ipg_txn_id'],
          'authorizationcode'=> $_POST['auth_code'],
          'transdate'=>$_POST['date'],
          'amount'=>$_POST['amt'],
          'discriminator'=>$_POST['discriminator'],
          'cardnumber'=>$_POST['CardNumber'],
          'status'=>$_POST['f_code'],
          'billingemail'=>$_POST['udf2'],
          'billingphone'=>$_POST['udf3'],
          'udf9'=>$_POST['udf9'],
          'mmp_txn'=>$_POST['mmp_txn'],
          'mer_txn'=>$_POST['mer_txn'],
          'status' => 'paid'
      );

      $bookingsdata = array(
          'booking_status'=>'booked',
          'payment_status'=>'paid',
          
      );


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
          'balance' => $balance
          
      );

*/
      

      if($_POST['f_code']=="Ok"){



       // $this->db->where('paymentid', $paymentid);
       // $this->db->update('tblpayments', $paymentsdata); 



        

       // $this->db->where('bookingid', $bookingid);
       // $this->db->update('tblbookings', $bookingsdata); 



        //insert into table transactions
        //$this->db->insert('tblpayments',$tbltransactionsdata); 
        /*
        $mobile = $this->db->get_where('tblcustomers' , array('username' => $this->session->userdata('holidayEmail') ))->row()->number;
        $msg = 'Your booking is confirmed. Your Ticket Number is: '.$this->db->get_where('tblbookings' , array('bookingid' => $this->session->userdata('bookingid') ))->row()->ticketnumber.' ';
        $this->sendsms($mobile,$msg);
        $this->sendingEmailTickets($_POST['udf2']);
  */
      }else{

redirect('frontend/index');
}

     




      

       $this->load->view('frontend/header');
     //$this->load->view('frontend/response',$paymentsdata);
     $this->load->view('frontend/response');

    }

    public function resortsGridView(){


      $searchterm = $this->session->userdata('searchterm');
      $searchdate = $this->session->userdata('searchdate');
      //echo $searchdate."<br>";

      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchResorts();


       //pagination settings
        $config['base_url'] = site_url('frontend/resortsGridView');
        $config['total_rows'] = $numberOfRows;
        $config['per_page'] = "10";
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



        $sql = "SELECT r.*,rp.* FROM tblresorts r LEFT JOIN tblresorphotos rp ON r.resortid=rp.resortid WHERE r.status=1 AND (r.location LIKE '%$searchterm%' OR r.resortname LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.resortid limit 4";
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        if(count($query2->result())==1){
         // echo '<pre>';
         // print_r($query2->result());
         // echo '</pre>';

          $resortname = str_replace(' ','-',$query2->result()[0]->resortname);
          $resortid =  $query2->result()[0]->resortid;
          redirect('resorts/'.$resortname.'/'.$resortid);
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

                 
                 echo "<div class='col-md-4 col-sm-4 wow zoomIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;'>
                 <div class='img_container'>
                    <a href='<?php echo site_url().'resorts/'.$content->resortname.'/'.$content->resortid;   ?>'>";
                    echo '<img width="400" height="267" src="'.base_url().'/assets/resortimages/'.$content->photoname.'">';         
                    
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
        $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid=$k->resortid";
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 wow zoomIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;'>
           <div class='tour_container'><div class='img_container'>";
       ?>
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>";
              <?php
        echo '<img src="'.base_url().'/assets/resortimages/'.$k->photoname.'" style="min-height:267px;">';         
              
              echo "<div class='short_info'>
                <i class='icon_set_1_icon-4'></i>".$k->resortname." 
                <span class='price'><span><sup>Rs.</sup>".$packagerow->minprice."</span></span>
                                
              </div>
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
      $rp = explode("-",$price);
      $startprice = $rp[0];
      $endprice =  $rp[1]; 
      
        $getPriceResults = $this->FrontEndModel->getpriceresults_resort($startprice,$endprice);
        foreach ($getPriceResults->result() as $k) {

          $resorttitleurl = str_replace(" ", "-", $k->resortname);

          $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid=$k->resortid AND adultprice between $startprice AND $endprice ";
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 wow zoomIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;'>
           <div class='tour_container'><div class='img_container'>";
       ?>
      
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
              <img src="<?php echo base_url().'/assets/resortimages/'.$k->photoname ;?>" style="min-height:267px;">
              
              <div class='short_info'>
                <i class='icon_set_1_icon-4'></i><?php echo $k->resortname; ?>
                <span class='price'><span><sup>Rs.</sup><?php echo $packagerow->minprice; ?></span></span>
                                
              </div>
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
      }
    }



    public function sortpriceforresortsAjax()
    {

      $price = $this->input->post('price');
      $lastid = $this->input->post('lastid');
      $limit = $this->input->post('limit');
      $sessionValue = $this->input->post('sessionValue');


       $last_id=$sessionValue*4;
       
      if ($price=='') {

         
        
         $getPriceResults = $this->FrontEndModel->getpriceresults_resortAjax($limit,$lastid);
        foreach ($getPriceResults->result() as $k) {
          $resorttitleurl = str_replace(" ", "-", $k->resortname);
          $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid=$k->resortid";
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 wow zoomIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;'>
           <div class='tour_container'><div class='img_container'>";
       ?>
      
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
              <img src="<?php echo base_url().'/assets/resortimages/'.$k->photoname ;?>" style="min-height:267px;">
              
              <div class='short_info'>
                <i class='icon_set_1_icon-4'></i><?php echo $k->resortname; ?>
                <span class='price'><span><sup>Rs.</sup><?php echo $packagerow->minprice; ?></span></span>
                                
              </div>
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
      //echo $price;
      $rp = explode("-",$price);
      $startprice = $rp[0];
      $endprice =  $rp[1]; 
      
        $getPriceResults = $this->FrontEndModel->getpriceresults_resortAjax($limit,$lastid);
        foreach ($getPriceResults->result() as $k) {
          $resorttitleurl = str_replace(" ", "-", $k->resortname);
          $sql = "select min(adultprice) as minprice from tblpackages WHERE resortid=$k->resortid AND adultprice between $startprice AND $endprice ";
          $query2 = $this->db->query($sql);
          $packagerow = $query2->row();

          if ($packagerow->minprice!='') {
           echo "<div class='col-md-4 col-sm-4 wow zoomIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;'>
           <div class='tour_container'><div class='img_container'>";
       ?>
      
              <a href='<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>'>
              <img src="<?php echo base_url().'/assets/resortimages/'.$k->photoname ;?>" style="min-height:267px;">
              
              <div class='short_info'>
                <i class='icon_set_1_icon-4'></i><?php echo $k->resortname; ?>
                <span class='price'><span><sup>Rs.</sup><?php echo $packagerow->minprice; ?></span></span>
                                
              </div>
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
      $searchdate = $this->session->userdata('searchdate');
      //echo $searchterm."<br>";

      $this->load->library('pagination');

      $numberOfRows = $this->FrontEndModel->getNumberOfRowsForSearchPlaces();


       //pagination settings
        $config['base_url'] = site_url('frontend/placesGridView');
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



        $sql = "SELECT r.*,rp.* FROM tblplaces r LEFT JOIN tblplacesphotos rp ON r.plid=rp.plid WHERE r.status=1 AND (r.address LIKE '%$searchterm%' OR r.place LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.plid limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        if(count($query2->result())==1){
         // echo '<pre>';
         // print_r($query2->result());
         // echo '</pre>';

          $place = str_replace(' ','-',$query2->result()[0]->place);
          $plid =  $query2->result()[0]->plid;
          redirect('places/'.$place.'/'.$plid);
        }
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 

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

        $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 AND (e.todate>='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) GROUP by ep.photoname limit 4";

        $this->session->set_userdata('limitcount',0);
        
       //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        //echo count($query2->result())."<br>";
        if(count($query2->result())==1){
         // echo '<pre>';
         // print_r($query2->result());
         // echo '</pre>';

          $eventname =  str_replace(' ','-',$query2->result()[0]->eventname);
          $eventid =  $query2->result()[0]->eventid;
          redirect('eventdetails/'.$eventname.'/'.$eventid);
        }
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

                 
                 echo "<div class='col-md-4 col-sm-4 wow zoomIn animated' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;'>
                 <div class='img_container'>
                    <a href='site_url().'events/'.$content->eventname.'/'.$content->eventid;'>";
                    echo '<img width="400" height="267" src="'.base_url().'/assets/eventimages/'.$content->photoname.'">';         
                    
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
        $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 AND (e.fromdate>='".$this->session->userdata('searchdate')."' OR e.todate='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) GROUP by ep.photoname ORDER BY e.eventid desc LIMIT 4";
        //echo $sql."<br>";

        

        $qq = $this->db->query($sql);

        foreach ($qq->result() as $k) {
          //echo $k->eventid."<br>";
          $eventtitleurl = str_replace(" ", "-", $k->eventname);
          $sql2 = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
        ?>
        <div class="col-md-4 col-sm-4 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">

    
                  
                            <div class="tour_container">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->photoname;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-4"></i><?php echo $k->eventname;   ?> 
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                    <p>
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php echo $k->todate; ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php echo $k->fromdate; ?></a>
                                    </p>   
                                  <!--  <div class="rating">
                                        <i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small>
                                    </div> end rating -->
                                    <!--
                                                <div class="wishlist">
                                        <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
                                    </div> End wish list-->
                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->

        <?php 
        
      }

        
      }else{
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

        
        
        //echo "session variable is: ".$this->session->userdata('limitcount')."<br>";

        $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 GROUP by ep.eventid ORDER by e.eventid DESC LIMIT $last_id,$limit";
        //echo $sql."<br>";

        

        $qq = $this->db->query($sql);

        foreach ($qq->result() as $k) {
          $eventtitleurl = str_replace(" ", "-", $k->eventname);
          $sql2 = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
        ?>
        <div class="col-md-4 col-sm-4 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">

    
                  
                            <div class="tour_container">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->photoname;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-4"></i><?php echo $k->eventname;   ?> 
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                    <p>

                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php echo $k->todate; ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php echo $k->fromdate; ?></a>
                                    </p> 

                                  <!--  <div class="rating">
                                        <i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small>
                                    </div> end rating -->
                                    <!--
                                                <div class="wishlist">
                                        <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
                                    </div> End wish list-->
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
      //echo "date is: ".$date."<br>";
      //echo "last id is: ".$last_id."<br>";

      
      $last_id=$sessionValue*4;

      if ($price=='' && $date=='') {

        $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 AND (e.fromdate>='".$this->session->userdata('searchdate')."' OR e.todate='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) GROUP by ep.photoname ORDER BY e.eventid desc LIMIT $last_id,$limit";
        //echo $sql."<br>";

        

        $qq = $this->db->query($sql);

        foreach ($qq->result() as $k) {
          //echo $k->eventid."<br>";
          $sql2 = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
        ?>
        <div class="col-md-4 col-sm-4 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">

    
                  
                            <div class="tour_container">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->photoname;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-4"></i><?php echo $k->eventname;   ?> 
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                    <p>

                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php echo $k->todate; ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php echo $k->fromdate; ?></a>
                                    </p>   
                                  <!--  <div class="rating">
                                        <i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small>
                                    </div> end rating -->
                                    <!--
                                                <div class="wishlist">
                                        <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
                                    </div> End wish list-->
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



        $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 GROUP by ep.eventid ORDER by e.eventid DESC limit 4";
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
        $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 GROUP by ep.eventid ORDER by e.eventid DESC limit 4";
        //echo $sql."<br>";

        

        $qq = $this->db->query($sql);

        foreach ($qq->result() as $k) {
          //echo $k->eventid."<br>";
          $eventtitleurl = str_replace(" ", "-", $k->eventname);
          $sql2 = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql2."<br><br>";


                 $query2 = $this->db->query($sql2);
                 $row =$query2->row();
        ?>
        <div class="col-md-4 col-sm-4 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">

    
                  
                            <div class="tour_container">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->photoname;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-4"></i><?php echo $k->eventname;   ?> 
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                  <!--  <div class="rating">
                                        <i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small>
                                    </div> end rating -->
                                    <!--
                                                <div class="wishlist">
                                        <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
                                    </div> End wish list-->
                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->

        <?php 
        
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



       $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 AND (e.fromdate>='".$this->session->userdata('searchdate')."' OR e.todate='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) GROUP by ep.photoname limit ".$data['page'].", ".$config['per_page'];

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

    public function sendsms($mobile='',$message=''){

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
        $config['per_page'] = "9";
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



        $sql = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 GROUP by pp.plid ORDER by p.plid DESC limit ".$data['page'].", ".$config['per_page'];
        //echo $sql."<br>";

        $query2 = $this->db->query($sql);
        $data['getdata'] = $query2;
        
        $data['pagination'] = $this->pagination->create_links();
       
        $data['totalrows'] = $numberOfRows;
        //echo $sql; 
      $this->load->view('frontend/header');
      $this->load->view('frontend/placegridview',$data);

}


    public function showResortDetails($resortname='',$resortId=''){


      $data['resortid'] = $resortId;

      //$data['resortResults'] = $this->FrontEndModel->getResortDataBasedOnResortId($resortId);
      //get to know single checkout or multicheckout
      $res = $this->FrontEndModel->findOutSingleCheckoutOrMultipleCheckout($resortId);
      
      //echo $res->bookingtype;
      $resortname = str_replace(" ","-",$res->bookingtype);
      if($res->bookingtype=='multicheckout'){
        
        redirect('resorts-multicheckout/'.$resortname.'/'.$resortId);

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
                           //echo $result;
                           if($result<1){
                            $randNumber = rand(9999,99999);
                            $this->session->set_userdata('register-mobile-OTP',$randNumber);
                            
                            $msg = 'Your OTP is: '.$randNumber;

                             $this->sendsms($mobile,$msg);

                            echo "true";

                           }else{
                            //$this->session->set_flashdata('error-msg','<div class=alert alert-success text-center>Email Or Phone Exists with us! Please use different one</div>');
                              //$this->load->view('frontend/header');
                             //$this->load->view('frontend/register');
                            echo "false";
                            
                           }

    }



 public function registerconfirm(){

                    
                    $name = $this->input->post('name');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $cpassword = $this->input->post('cpassword');
                    $mobile = $this->input->post('mobile');
                    $otp = $this->input->post('otp');
                    //$url = $this->input->post('url');

                    

                            $OTP_CHECK = $this->session->userdata('register-mobile-OTP');
                            //echo $OTP_CHECK."<BR>";
                            //echo $otp."<BR>";
                            if($OTP_CHECK==$otp){

                              //insert
                            $convertedpassword = hash('sha512', $password);
                    
                            $data = array(
                               'name' => $name ,
                               'username' => $email ,
                               'password' => $convertedpassword,
                               'number' => $mobile,
                               'dateofcreation' => date('Y-m-d'),
                               'regtype'=> 'registration'
                            );

                            $this->db->insert('tblcustomers', $data);

                            $this->sendsms($mobile,'Thank you for the Registration. From Book4Holiday');
                            
                            // send mail to user //

                            $to=$this->input->post('email');
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
below are your account details </td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">Username : <strong><a href="#" style="text-decoration:none;" target="_blank">'.$this->input->post('email').'</a></strong></td>
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

                            //user email ends here //
                            $this->session->set_flashdata('register-success','<div class=alert alert-success text-center>You are successfully registered</div>');

                             //$this->load->view('frontend/header');
                             //redirect('login');

                              echo "true";

                            }else{
                              echo "false11-book";
                              //echo "false1";
                           }
                      
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
                  $this->db->update('tblcustomers', $data); 
                  $msg = 'Your password is: '.$resetpassword;

  $mobile =  $this->db->get_where('tblcustomers' , array('username' =>$email))->row()->number;
                 // echo $email."<br>";
                  //echo $msg."<br>";
                  //echo $mobile."<br>";

                  $this->sendsms($mobile,$msg);

                  $this->session->set_flashdata('error-msg','<div class="alert alert-success text-center">A new password has been sent to your Registered Phone. Please login and change the password</div>');
                  redirect('frontend/forgotForm');

                        }

      
    }

    public function loginCheck(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');


        $this->form_validation->set_rules("email", "Email", "trim|required|callback_validate_email");
        $this->form_validation->set_rules("password", "Password", "trim|required");

        if ($this->form_validation->run() == FALSE)
                    {  
                        $this->load->view('frontend/header');
                        $this->load->view('frontend/login');
                        

                    }else{
                          
                           $this->session->set_userdata('holidayEmail',$email);
                           $this->session->set_userdata('holidayCustomerName',$this->FrontEndModel->getNameOfCustomerOnEmail($email));
                           $this->session->set_userdata('holidayCustomerId',$this->FrontEndModel->getIdOfCustomerOnEmail($email));
                           redirect('frontend/index');
                        
                        
                            
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
        redirect('frontend/index');
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
      below are your account details </td>
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



    public function sendingEmailTickets($email)
    {
      $to=$email;
      $subject = "Book4Holiday Tickets";
      $headers = "MIME-Version: 1.0"."\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
      $headers .= 'From: Book4Holiday Support <info@book4holiday.com>'."\r\n";
      $message='<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" style="padding:25px 0 15px 0">
      <tbody><tr>
        <td width="100%" valign="top">
          <table cellpadding="0" cellspacing="0" width="600" border="0" align="center" bgcolor="f2f2f2">
            <tbody>
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" width="300" style="background-color:#1f2533;padding-top:10px">
                        <a href="#" style="text-decoration:none;color:#010101" target="_blank" data-saferedirecturl="#"><!--<img alt="BookMyShow" height="70" border="0" width="200" style="margin:0px auto" src="book4.png" class="CToWUd">--><h3 style="color:#FFF; font-family:Arial Black; font-size:18px; padding-left:30px;">Book <span style="color:#49ba8e;">4</span> Holiday</h3>
</a>
                      </td>
                      <td valign="top" width="300" style="background-color:#1f2533;color:#ffffff;font-size:12px;font-weight:bold;font-family:Arial,sans-serif;text-align:right;padding:20px 30px 0px 10px;word-spacing:1px;line-height:16px"> YOUR TICKET<br><a style="text-decoration:none;color:#74777e;font-weight:bold;font-size:11px;color:rgb(176,176,176);text-transform:uppercase"> Scan and Enter</a></td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" width="500" style="background-color:#ffffff;color:#666666;font-size:15px;font-family:Arial,sans-serif;text-align:left;padding:30px 10px 20px 30px;line-height:20px">Dear <span>Customer</span>, <br>Your ticket(s) are <b>Confirmed</b>! </td>
                      <td valign="top" width="100" style="background-color:#ffffff;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:30px 20px 20px 10px;line-height:20px">Booking ID <br><span style="font-size:20px;font-weight:bold">'.$this->session->userdata('bookingid').'</span></td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              <tr>
                <td valign="top" style="background-color:#f2f2f2;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:10px 40px 20px 40px;line-height:20px">
                  <img src="https://ci4.googleusercontent.com/proxy/lh5OJtSOO9gpklDNH62Tmy0cR-LQc2M-OEXcJVGmtIeDqR83L2aLvL7qYxoBtXwgAmCRYmUAVmYKCpV563yu23OzA9B2H4W6YD5rKbKyje_7iPa60PKWUfA-cQJwWxtEZIGztNFxznFDR5pKRn4lJqiuUB9EpfsHiaxnebp8cNVsnCoSTvmD6zoJjUATpI2CuhisalE=s0-d-e1-ft#https://in.bookmyshow.com/secure/barcode/?IsImage=Y&amp;strBarcodeType=qrcode&amp;strBarcodeTxt=B05334880775&amp;intHeight=100&amp;intWidth=100" style="width:100px;min-height:100px;float:right" class="CToWUd">
                  <p style="font-size:14px;float:left;width:70%;padding-top:20px">Please find your holiday tickets attached to this mail or to download your ticket, <a href="#" style="text-decoration:none;color:#4073cf;font-weight:bold" target="_blank" data-saferedirecturl="#">click here</a></p>
                </td>
              </tr>
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center" bgcolor="#1f2533">
                    <tbody><tr>
                      <td width="15">
                      </td><td width="370" valign="top" style="color:#ffffff;font-size:15px;font-family:Arial,sans-serif;text-align:left;padding:25px 10px 25px 15px;line-height:24px;border-right:1px dotted #ffffff">
                        <span style="font-size:20px;color:#ffffff;font-weight:bold">'.$this->db->get_where('tblvendors' , array('vendorid' => $this->session->userdata('vendorid') ))->row()->vendorname.'</span>
                        <br>
                        <span>
                          <span>Your Ticket no: W34C567Q, </span> 
                          <span><span>'.$this->db->get_where('tblvendors' , array('vendorid' => $this->session->userdata('vendorid') ))->row()->address1.'</span><span></span></span>
                        <br><span class="aBn" data-term="goog_1116116412" tabindex="0"><span class="aQJ">1:15pm</span></span> | <span style="overflow:hidden;float:left;line-height:0px">2016-04-23T13:15:00+05:30</span>23 Apr - 28 Apr, 2016</span></td>
                      <td width="140" valign="top" style="color:#ffffff;font-size:15px;font-family:Arial,sans-serif;text-align:center;padding:25px 10px 15px 10px;line-height:20px">
                        <img src="">
                        <br>
                        <b style="width:100%;float:left;word-break:break-all"></b>
                        <br>
                      </td>
                      <td width="15">
                    </td></tr>
                  </tbody></table>
                </td>
              </tr>
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center" bgcolor="#ffffff" style="border:1px solid #e1e5e8;margin-bottom:15px">
                    <tbody>
                      <tr>
                        <td width="538" valign="top">
                          <table cellpadding="0" cellspacing="0" width="488" border="0" align="center">
                            <tbody>
                              <tr>
                                <td width="488" valign="top" style="background-color:#ffffff;color:#666666;font-size:12px;font-weight:bold;font-family:Arial,sans-serif;text-align:left;padding:15px 10px 5px 0px;line-height:20px;
                                border-bottom:1px solid #efefef;letter-spacing:3px">OTHER ITEMS
                                  </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td valign="top" style="width:478px;padding:0 30px">
                          <table cellpadding="0" cellspacing="0" border="0" align="left" style="width:478px;border-bottom:1px dotted #e1e5e8;padding:10px 0">
                            <tbody>
                              <tr>
                                <td valign="top" style="background-color:#ffffff;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:5px 0;line-height:20px;width:100%">
                                  <strong style="color:#0e1422;font-size:13px">Book 4 Holiday (Adults('.$this->session->set_userdata('numberofadults').') children('.$this->session->set_userdata('numberofchildren').'))</strong>
                                  <br>Booking Confirmation Number - '.$this->db->get_where('tblbookings' , array('vendorid' => $this->session->userdata('vendorid') ))->row()->ticketnumber.'</td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="538" border="0" align="center" bgcolor="#ffffff" style="border:1px solid #e1e5e8">
                    <tbody><tr>
                      <td width="538" valign="top">
                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center" bgcolor="#ffffff" style="padding:0 30px">
                          <tbody>
                            <tr>
                              <td valign="top" style="width:478px;background-color:#ffffff;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:10px 10px 10px 0;border-bottom:1px solid #e1e5e8">
                                <span style="font-size:12px">ORDER SUMMARY </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td width="538" valign="top">
                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
                          <tbody>
                            <tr>
                              <td style="width:30px">
                              </td><td valign="top" style="width:265px;background-color:#ffffff;color:#666666;font-size:15px;font-family:Arial,sans-serif;text-align:left;padding:10px 10px 10px 0;border-bottom:2px dotted #bfbfbf">
                                <span style="font-size:14px;font-weight:bold">TICKET AMOUNT</span>
                              </td>
                              <td valign="top" width="213" style="background-color:#ffffff;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:right;padding:10px 0 10px 10px;border-bottom:2px dotted #bfbfbf">Rs.'.$this->session->set_userdata('totalcost')-$this->session->set_userdata('servicetax').'</td>
                              <td style="width:30px">
                            </td></tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" width="538">
                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
                          <tbody>
                            <tr>
                              <td style="width:30px">
                              </td><td valign="top" style="width:265px;padding:10px 10px 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left;line-height:20px">
                                <strong>Quantity</strong>
                              </td>
                              <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;padding:0 0 0 10px;vertical-align:top">
                                <br>
                                <strong>'.$this->session->set_userdata('numberofadults')+$this->session->set_userdata('numberofchildren').'</strong>
                              </td>
                              <td style="width:30px">
                            </td></tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" width="538">
                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
                          <tbody>
                            <tr>
                              <td style="width:30px">
                              </td><td valign="top" style="width:265px;padding:10px 0 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left">
                                <strong></strong>
                              </td>
                              <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;vertical-align:top">
                                <br>
                                <strong></strong>
                              </td>
                              <td style="width:30px">
                            </td></tr>
                            
                            <tr>
                              <td style="width:30px">
                              </td><td valign="top" style="width:265px;background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:left;line-height:20px">Service Tax @ 10%</td>
                              <td valign="top" width="213" style="background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:right;vertical-align:top">Rs.'.$this->session->set_userdata('servicetax').'</td>
                              <td style="width:30px">
                            </td></tr>

                            
                           
                            
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" width="538">
                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
                          <tbody><tr>
                            <td style="width:30px">
                            </td><td valign="top" style="width:265px;padding:10px 10px 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left;line-height:20px">
                              <strong></strong>
                            </td>
                            <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;padding:0 0 0 10px;vertical-align:top">
                              <br>
                              <strong></strong>
                            </td>
                            <td style="width:30px">
                          </td></tr>
                        </tbody></table>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" width="538">
                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
                          <tbody><tr>
                            <td style="width:30px">
                            </td><td valign="top" style="width:265px;padding:10px 10px 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left;line-height:20px">
                              <strong></strong>
                            </td>
                            <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;padding:0 0 0 10px;vertical-align:top">
                              <br>
                              <strong></strong>
                            </td>
                            <td style="width:30px">
                          </td></tr>
                        </tbody></table>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" width="538">
                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
                          <tbody><tr>
                            <td style="width:30px">
                            </td><td valign="top" style="width:265px;padding:15px 10px 0px 0;background-color:#ffffff;color:#666666;font-size:16px;font-family:Arial,sans-serif;text-align:left;border-top:2px dotted #bfbfbf">
                              <strong>AMOUNT PAYABLE</strong>
                            </td>
                            <td valign="top" width="213" style="padding:15px 10px 15px 0;font-size:18px;font-weight:bold;font-family:Arial,sans-serif;text-align:right;background-color:#ffffff;color:#666666;border-top:2px dotted #bfbfbf">Rs.'.$this->session->set_userdata('totalcost').'</td>
                            <td style="width:30px">
                          </td></tr>
                        </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              <tr>
                <td valign="top" width="540">
                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" width="202" style="background-color:#efefef;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:10px 10px 35px 0px;line-height:20px">
                        <b>BOOKING DATE &amp; TIME</b>
                        <br>'.$this->db->get_where('tblbookings' , array('bookingid' => $this->session->userdata('bookingid') ))->row()->date.'<span class="aBn" data-term="goog_1116116413" tabindex="0"><span class="aQJ">8:59am</span></span></td>
                      <td valign="top" width="143" style="background-color:#efefef;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:10px 10px 35px 10px;line-height:20px">
                        <b></b>
                        <br></td>
                      <td valign="top" width="195" style="background-color:#efefef;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:10px 10px 35px 10px;line-height:20px">
                        <b>CONFIRMATION NUMBER</b>
                        <br>
                        <span>'.$this->db->get_where('tblpayments' , array('bookingid' => $this->session->userdata('bookingid') ))->row()->transaction_id.'</span>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              <tr>
                <td valign="top" width="540" style="background-color:#ffffff">
                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" width="540" style="color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:justify;padding:30px 0 40px;line-height:20px">
                        <span style="font-size:12px">
                          <b>Important Instructions</b>
                        </span>
                        <br>
                        <br>
                          Tickets once booked cannot be exchanged, cancelled or refunded.<br>
                          The Credit Card and Credit Card Holder must be present at the ticket counter while collecting the ticket(s).<br>
                          Service Tax &amp; Swachh Bharat Cess collected and paid to the department.<br>
                          Business Auxiliary Services. PAN Based STC No. AABCB3428PST002.<br></td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center" bgcolor="1F2533">
                    <tbody><tr>
                      <td valign="top" width="260" style="background-color:#1f2533;color:#49ba8e;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:20px 10px 15px 20px">For any further assistance<br><a href="mailto:helpdesk@BookMyShow.com" style="text-decoration:none;color:#49ba8e;font-weight:bold" target="_blank">helpdesk@book4holiday.com</a></td>
                      <td style="width:200px;vertical-align:top;background-color:#1f2533;text-align:right;padding:25px 0 15px 0">
                        <img src="https://ci3.googleusercontent.com/proxy/ox1pr8SuruzQrAsTBgtdjSlHhf0BodFY1HY033BSEDpQQx41C7mSyS3nVKhXYKB2WK98ymYskV6_gH0967w5847IDkg85kno18hz0PjzvlWj2HI=s0-d-e1-ft#http://cnt.in.bookmyshow.com/webin/emailer/helpline-phone.png" alt="helpline phone" width="18" height="20" border="0" class="CToWUd">
                      </td>
                      <td style="width:105px;vertical-align:top;padding:25px 0 15px 10px;text-align:left;background-color:#1f2533;color:#49ba8e;line-height:14px;font-size:12px;font-weight:bold">
                        <a href="tel:+912261445050" style="text-decoration:none;color:#49ba8e" target="_blank">+91 40 2345 6789</a>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody></table>

</body>
</html>
';
      
      mail($to, $subject, $message, $headers);

      //user email ends here
    }


 
    

  
}

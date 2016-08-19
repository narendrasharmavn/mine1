<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class FrontEndModel extends CI_Model {

	public function __construct()
	{
	    $this->load->database();
	}

    public function get_all_count_resorts()
    {
        $sql = "SELECT COUNT(*) as tol_records FROM tblresorts";       
        $result = $this->db->query($sql)->row();
        return $result;
    }


    public function getAutoFillSearchDataEvents($searchterm){

      $query = $this->db->query("SELECT eventid,eventname FROM tblevents WHERE location LIKE '%$searchterm%' OR eventname LIKE '%$searchterm%' OR description LIKE '%$searchterm%' LIMIT 4");

      return $query;



    }

    public function getAutoFillSearchDataEventsWithDates($searchterm,$searchdate){

      $searchdate = date("Y-m-d", strtotime($searchdate));
      $query = $this->db->query("SELECT eventid,eventname FROM tblevents WHERE status=1 AND (fromdate<='$searchdate' AND todate>='$searchdate') AND (location LIKE '%$searchterm%' OR eventname LIKE '%$searchterm%' OR description LIKE '%$searchterm%') LIMIT 4");
      //echo "SELECT eventid,eventname FROM tblevents WHERE (fromdate<='$searchdate' AND todate>='$searchdate') AND (location LIKE '%$searchterm%' OR eventname LIKE '%$searchterm%' OR description LIKE '%$searchterm%') LIMIT 4";

      return $query;



    }

    public function getAutoFillSearchDataResorts($searchterm){

      $query = $this->db->query("SELECT resortid,resortname FROM tblresorts WHERE (resortid !=1) AND (location LIKE '%$searchterm%' OR resortname LIKE '%$searchterm%' OR description LIKE '%$searchterm%') LIMIT 4");

      //echo "SELECT resortid,resortname FROM tblresorts WHERE (resortid !=1) AND (location LIKE '%$searchterm%' OR resortname LIKE '%$searchterm%' OR description LIKE '%$searchterm%') LIMIT 4"."<br>";

      return $query;



    }

    public function getAutoFillSearchDataPlaces($searchterm){

      $query = $this->db->query("SELECT plid,place FROM tblplaces WHERE address LIKE '%$searchterm%' OR place LIKE '%$searchterm%' OR city LIKE '%$searchterm%' OR description LIKE '%$searchterm%' OR otherinfo LIKE '%$searchterm%' LIMIT 4");

      return $query;



    }



    public function getpriceresults_resort()
    {   

        //ORDER BY e.eventid desc LIMIT $last_id,$limit
        
        $searchterm = $this->session->userdata('searchterm');

        $query = $this->db->query("SELECT* FROM tblresorts WHERE status=1 AND (resortid !=1) AND (location LIKE '%".$searchterm."%' OR resortname LIKE '%".$searchterm."%' OR description LIKE '%".$searchterm."%')");
       //echo "SELECT r.*,rp.* FROM tblresorts r LEFT JOIN tblresorphotos rp ON r.resortid=rp.resortid WHERE r.status=1 AND (r.location LIKE '%".$searchterm."%' OR r.resortname LIKE '%".$searchterm."%' OR r.description LIKE '%".$searchterm."%') GROUP by rp.resortid"."<br>";
        return $query;
    }


    public function getpriceresults_resortAjax($limit,$last_id)
    {   

        //ORDER BY e.eventid desc LIMIT $last_id,$limit
        
        $searchterm = $this->session->userdata('searchterm');

        $query = $this->db->query("SELECT * FROM tblresorts WHERE status=1 AND (resortid !=1) AND AND (location LIKE '%".$searchterm."%' OR resortname LIKE '%".$searchterm."%' OR description LIKE '%".$searchterm."%') ORDER BY resortid desc LIMIT $last_id,$limit");
       
        return $query;
    }
  
    public function getpriceresults_event($startprice,$endprice)
    {   
        $query = $this->db->query("SELECT te.eventid,te.eventname,tep.photoname,tp.adultprice FROM tblevents te left JOIN tblpackages tp on te.eventid=tp.eventid right join tbleventphotos tep  on tp.eventid=tep.eventid where tp.adultprice between '$startprice' AND '$endprice';");
        return $query;
    }

    public function getdateresults_event($startdate,$enddate)
    {   
        $query = $this->db->query("SELECT te.eventid,te.eventname,te.todate,te.fromdate,tep.photoname,tp.adultprice FROM tblevents te left JOIN tblpackages tp on te.eventid=tp.eventid right join tbleventphotos tep  on tp.eventid=tep.eventid where (te.todate='$startdate' OR te.fromdate='$enddate');");
        return $query;
    }

    public function getdateandprice_filterevents($price,$date)
    {
      $filters= [];
      //$date = $this->input->post('date');

      if (null != $price) {
        
        //echo $price;
        $rp = explode("-",$price);
        $startprice = $rp[0];
        $endprice =  $rp[1]; 
        $filters['price'] = $price;
      }

      if (null != $date) {
        
      
        $filters['date'] = $date;
      }

      $queryString="";
      $priceString="";
      $dateString="";
      $eventsQuery = "SELECT e.* FROM tblevents e WHERE e.status=1 AND (e.fromdate<='".$this->session->userdata('searchdate')."' OR e.todate>='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) ";
      foreach ($filters as $key => $value) {
        //echo $key."  ".$value."<br><br>";
        if ($key=="date") {
          //$value
          if($value=="today")
          {
            $startdate = date('Y-m-d');
            $enddate = date('Y-m-d');
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tomorrow")
          {
            $startdate = date('Y-m-d');
            $d=strtotime("tomorrow");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tweek"){
            $startdate = date('Y-m-d');
            $d = strtotime("+1 week");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else{
            $startdate = date('Y-m-d');
            $d=strtotime("next Saturday");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }
        }else{

            $priceString .="  tp.adultprice between '$startprice' AND '$endprice' ";
            //echo "price string ".$priceString."<br>";
          
        }
      }

      if ($dateString!='') {
         $eventsQuery .= ' AND '.$dateString;
      }

     
      $eventsQuery.=' ORDER by e.eventid DESC limit 4 ';
      //echo $eventsQuery."<br>";
      $eventsresults = $this->db->query($eventsQuery);
        //return $result;

        foreach ($eventsresults->result() as $k) {
          $eventtitleurl = str_replace(" ", "-", $k->eventname);

            $priceQuery = "SELECT min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid'";
            if ($priceString!='') {
                $priceQuery = "SELECT  min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid' AND ".$priceString;
                

            }
            //echo $eventsQuery."<br><br><br>";
            //echo $priceQuery."<br><br>";
            $priceResults = $this->db->query($priceQuery);
                $price= $priceResults->row();
                //echo "count is: ".count($priceResults->row())."<br>";
                if ($price->minprice!='') {
                    ?>

                    <div class="col-md-4 col-sm-4 events-thumb1" style="visibility: visible;">
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">    
                                    <div class="short_info">
                                        <span class="price"><span><sup>Rs.</sup><?php echo $price->minprice;   ?></span></span>
                                                      
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
                }


        

        
      }

      
      
    }



    public function getdateandprice_filtereventsajax($price,$date,$last_id,$limit)
    {
      $filters= [];
      //$date = $this->input->post('date');

      if (null != $price) {
        
        //echo $price;
        $rp = explode("-",$price);
        $startprice = $rp[0];
        $endprice =  $rp[1]; 
        $filters['price'] = $price;
      }

      if (null != $date) {
        
      
        $filters['date'] = $date;
      }

      $queryString="";
      $priceString="";
      $dateString="";
      $eventsQuery = "SELECT e.* FROM tblevents e WHERE e.status=1 AND (e.fromdate<='".$this->session->userdata('searchdate')."' OR e.todate>='".$this->session->userdata('searchdate')."') AND ( e.location LIKE '%".$this->session->userdata('searchterm')."%' OR e.eventname LIKE '%".$this->session->userdata('searchterm')."%' OR e.description LIKE '%".$this->session->userdata('searchterm')."%' ) ";
      foreach ($filters as $key => $value) {
        //echo $key."  ".$value."<br><br>";
        if ($key=="date") {
          //$value
          if($value=="today")
          {
            $startdate = date('Y-m-d');
            $enddate = date('Y-m-d');
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tomorrow")
          {
            $startdate = date('Y-m-d');
            $d=strtotime("tomorrow");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tweek"){
            $startdate = date('Y-m-d');
            $d = strtotime("+1 week");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else{
            $startdate = date('Y-m-d');
            $d=strtotime("next Saturday");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }
        }else{

            $priceString .="  tp.adultprice between '$startprice' AND '$endprice' ";
            //echo "price string ".$priceString."<br>";
          
        }
      }

      if ($dateString!='') {
         $eventsQuery .= ' AND '.$dateString;
      }

     
      $eventsQuery.=" ORDER BY e.eventid desc LIMIT $last_id,$limit";
      //echo $eventsQuery."<br>";
      $eventsresults = $this->db->query($eventsQuery);
        //return $result;

        foreach ($eventsresults->result() as $k) {

            $priceQuery = "SELECT  min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid'";
            if ($priceString!='') {
                $priceQuery = "SELECT  min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid' AND ".$priceString;
                

            }
            //echo $eventsQuery."<br><br><br>";
            //echo $priceQuery."<br><br>";
            $priceResults = $this->db->query($priceQuery);
                $price= $priceResults->row();
                //echo "count is: ".count($priceResults->row())."<br>";
                if ($price->minprice!='') {
                    ?>
        <div class="col-md-4 col-sm-4 events-thumb1" style="visibility: visible;">
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">  
                                    <div class="short_info">
                                        <span class="price"><span><sup>Rs.</sup><?php echo $price->minprice;   ?></span></span>
                                                      
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


        

        
      }

      if ($last_id != 0) {
  echo '<script type="text/javascript">var last_id = '.$last_id.';</script>';
}

      
      
    }



    public function getdateandprice_filtereventsallajax($price,$date,$last_id,$limit)
    {
      $filters= [];
      //$date = $this->input->post('date');

      if (null != $price) {
        
        //echo $price;
        $rp = explode("-",$price);
        $startprice = $rp[0];
        $endprice =  $rp[1]; 
        $filters['price'] = $price;
      }

      if (null != $date) {
        
      
        $filters['date'] = $date;
      }

      $queryString="";
      $priceString="";
      $dateString="";
      $eventsQuery = "SELECT * FROM tblevents e WHERE e.status=1";
      foreach ($filters as $key => $value) {
        //echo $key."  ".$value."<br><br>";
        if ($key=="date") {
          //$value
          if($value=="today")
          {
            $startdate = date('Y-m-d');
            $enddate = date('Y-m-d');
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tomorrow")
          {
            $startdate = date('Y-m-d');
            $d=strtotime("tomorrow");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tweek"){
            $startdate = date('Y-m-d');
            $d = strtotime("+1 week");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else{
            $startdate = date('Y-m-d');
            $d=strtotime("next Saturday");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }
        }else{

            $priceString .="  tp.adultprice between '$startprice' AND '$endprice' ";
            //echo "price string ".$priceString."<br>";
          
        }
      }

      if ($dateString!='') {
         $eventsQuery .= ' AND '.$dateString;
      }

     
      $eventsQuery.=' ORDER by e.eventid DESC LIMIT '.$last_id.','.$limit;
     //echo $eventsQuery."<br>";
      $eventsresults = $this->db->query($eventsQuery);
        //return $result;

        foreach ($eventsresults->result() as $k) {
          $eventtitleurl = str_replace(" ", "-", $k->eventname);
            $priceQuery = "SELECT  min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid'";
            if ($priceString!='') {
                $priceQuery = "SELECT  min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid' AND ".$priceString;
                

            }
            //echo $eventsQuery."<br><br><br>";
            //echo $priceQuery."<br><br>";
            $priceResults = $this->db->query($priceQuery);
                $price= $priceResults->row();
                //echo "count is: ".count($priceResults->row())."<br>";
                if ($price->minprice!='') {
                    ?>
        <div class="col-md-4 col-sm-4 events-thumb1 "  style="visibility: visible; ">

    
                  
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                       <span class="price"><span><sup>Rs.</sup><?php echo $price->minprice;   ?></span></span>
                                                      
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

        $last_id = $k->eventid;
                }


        

        
      }

      if ($last_id != 0) {
  echo '<script type="text/javascript">var last_id = '.$last_id.';</script>';
}

      
      
    }




    public function getdateandprice_filtereventseventsall($price,$date)
    {
      $filters= [];
      //$date = $this->input->post('date');

      if (null != $price) {
        
        //echo $price;
        $rp = explode("-",$price);
        $startprice = $rp[0];
        $endprice =  $rp[1]; 
        $filters['price'] = $price;
      }

      if (null != $date) {
        
      
        $filters['date'] = $date;
      }

      $queryString="";
      $priceString="";
      $dateString="";
      $eventsQuery = "SELECT * FROM tblevents e WHERE e.status=1 ";
      foreach ($filters as $key => $value) {
        //echo $key."  ".$value."<br><br>";
        if ($key=="date") {
          //$value
          if($value=="today")
          {
            $startdate = date('Y-m-d');
            $enddate = date('Y-m-d');
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tomorrow")
          {
            $startdate = date('Y-m-d');
            $d=strtotime("tomorrow");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else if($value=="tweek"){
            $startdate = date('Y-m-d');
            $d = strtotime("+1 week");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }else{
            $startdate = date('Y-m-d');
            $d=strtotime("next Saturday");
            $enddate = date("Y-m-d", $d);
            $dateString .=" (e.todate>='$startdate' OR e.fromdate<='$enddate')  ";
          }
        }else{

            $priceString .="  tp.adultprice between '$startprice' AND '$endprice' ";
            //echo "price string ".$priceString."<br>";
          
        }
      }

      if ($dateString!='') {
         $eventsQuery .= ' AND '.$dateString;
      }

     
      $eventsQuery.=' ORDER by e.eventid DESC limit 4 ';
      //echo $eventsQuery."<br>";
      $eventsresults = $this->db->query($eventsQuery);
        //return $result;

        foreach ($eventsresults->result() as $k) {
          $eventtitleurl = str_replace(" ", "-", $k->eventname);

            $priceQuery = "SELECT  min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid'";
            if ($priceString!='') {
                $priceQuery = "SELECT  min(tp.adultprice) as minprice from tblpackages tp WHERE eventid='$k->eventid' AND ".$priceString;
                

            }
            //echo $eventsQuery."<br><br><br>";
            //echo $priceQuery."<br><br>";
            $priceResults = $this->db->query($priceQuery);
                $price= $priceResults->row();
                //echo "count is: ".count($priceResults->row())."<br>";
                if ($price->minprice!='') {
                    ?>

                    <div class="col-md-4 col-sm-4 events-thumb1 "  style="visibility: visible; ">

    
                  
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                        <span class="price"><span><sup>Rs.</sup><?php echo $price->minprice;   ?></span></span>
                                                      
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
                }


        

        
      }

    
      
    }








    public function get_all_content($start,$content_per_page)
    {
        $searchterm=$this->session->userdata('searchterm');
        $searchdate = $this->session->userdata('searchdate');
        $sql = "SELECT r.*,rp.* FROM tblresorts r LEFT JOIN tblresorphotos rp ON r.resortid=rp.resortid WHERE r.status=1 AND (r.location LIKE '%$searchterm%' OR r.resortname LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.resortid LIMIT $start,$content_per_page";       
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function get_all_content_events($start,$content_per_page,$date,$price)
    {
        $searchterm=$this->session->userdata('searchterm');
        $searchdate = $this->session->userdata('searchdate');

         $sql = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 AND (e.fromdate>='$searchdate' OR e.todate='$searchdate') AND  ( e.location LIKE '%$searchterm%' OR e.eventname LIKE '%$searchterm%' OR e.description LIKE '%$searchterm%' ) GROUP by ep.photoname LIMIT $start,$content_per_page";
        
        $result = $this->db->query($sql);
       
        return $result();
    }

    public function checkIfEmailOrPhoneExistsInVendorTable($email,$mobile){
        $processedResults = $this->db->query("SELECT * FROM tblvendors WHERE email='$email' OR mobile='$mobile'");
        return $processedResults->num_rows();
    }

    public function checkIfCustomerEmailOrMobileExists($email,$mobile){
        $processedResults = $this->db->query("SELECT name FROM tblcustomers WHERE (username='$email' OR number='$mobile') AND regtype='registration'");
        //echo "SELECT name FROM tblcustomers WHERE (username='$email' OR number='$mobile') AND regtype='registration'";
        return $processedResults->num_rows();

    }

    

public function validateEmail($email){
        $processedResults = $this->db->query("SELECT name FROM tblcustomers WHERE username='$email'");
        return $processedResults->num_rows();

    }
    
    public function checkIfCustomerIsValid($email,$password){
        $processedResults = $this->db->query("SELECT name FROM tblcustomers WHERE username='$email' AND password='$password' AND regtype='registration'");
        return $processedResults->num_rows();

    }

    

    public function checkIfCustomerIsValid_forgot($email){
        $processedResults = $this->db->query("SELECT name FROM tblcustomers WHERE username='$email' AND regtype='registration' ");
        return $processedResults->num_rows();

    }


    

    public function getNameOfCustomerOnEmail($email){
        $processedResults = $this->db->query("SELECT name FROM tblcustomers WHERE username='$email' ");
        $row = $processedResults->row();
        return $row->name;

    }

   

    public function  getUserDetails($userId){
        $processedResults = $this->db->query("SELECT * FROM tblcustomers WHERE customer_id='$userId' ");
        $row = $processedResults->row();
        return $row;

    }

   
    public function   getResortDetailsBasedOnPackageId($packageid)
    {
            $processedResults = $this->db->query("SELECT * FROM tblpackages p left join tblresorts r on p.resortid=r.resortid WHERE packageid='$packageid' ");
            $row = $processedResults->row();
            return $row;

        }


    public function   getResortDetailsBasedOnPackageIdAndEventsTable($packageid)
    {
            $processedResults = $this->db->query("SELECT * FROM tblpackages p left join tblevents e on p.eventid=e.eventid WHERE packageid='$packageid' ");
            $row = $processedResults->row();
            return $row;

        }

     public function   getEventDetailsBasedOnPackageId($packageid)
    {
            $processedResults = $this->db->query("SELECT * FROM tblpackages p left join tblevents e on p.eventid=e.eventid WHERE packageid='$packageid' ");
            $row = $processedResults->row();
            return $row;

        }

        public function getAllBookingRelatedDetailsOnBookingId($bookingid)
        {
                $processedResults = $this->db->query("SELECT b.amount,b.quantity,b.childqty,tp.packagename  FROM tblbookings b left join tblpayments p on b.ticketnumber=p.ticketnumber left join tblpackages tp ON b.packageid=tp.packageid WHERE b.ticketnumber='$bookingid' ");
                //$row = $processedResults->row();
                //echo "SELECT * FROM tblbookings b left join tblpayments p on b.ticketnumber=p.ticketnumber left join tblpackages tp ON b.packageid=tp.packageid WHERE b.ticketnumber='$bookingid' ";
                return $processedResults;

            }


    public function getNumberOfRowsForPlaces(){


         $sQuery = "SELECT p.*,pp.* FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid WHERE p.status=1 GROUP by pp.plid";
        
        $query = $this->db->query($sQuery);
       
        return $query->num_rows();
    }

    public function getAllSuccessfulOrdersOfUser($customerid){

      $query = $this->db->query("SELECT b.*,p FROM tblbookings b LEFT INNER JOIN tblpackages p ON b.packageid=p.packageid WHERE userid='$customerid' AND booking_status='booked'");

    }
    

    public function getResortDataBasedOnResortId($resortId){
        $processedResults = $this->db->query("SELECT * from tblresorts WHERE status=1 AND resortid='$resortId' ");
        return $processedResults->row();
        //return $row->name;

    }


    public function findOutSingleCheckoutOrMultipleCheckout($resortId){
        $processedResultss = $this->db->query("SELECT * from tblresorts r left join tblvendors v ON r.vendorid=v.vendorid WHERE r.status=1 AND r.resortid='$resortId' AND v.status=1 ");

        //echo "SELECT * from tblresorts r left join tblvendors v ON r.vendorid=v.vendorid WHERE r.status=1 AND r.resortid='$resortId' AND v.status=1 ";

        return $processedResultss->row();
        //return $row->name;

    }

    

    public function getResortDataBasedOnEventId($eventid){
        $processedResults = $this->db->query("SELECT * from tblevents WHERE status=1 AND eventid='$eventid' ");
        return $processedResults->row();
        //return $row->name;

    }

   

    public function  getIdOfCustomerOnEmail($email){
        $processedResults = $this->db->query("SELECT customer_id FROM tblcustomers WHERE username='$email' ");
        $row = $processedResults->row();
        return $row->customer_id;

    }



    
    public function getPackageDetailsBasedOnPackageId($packageid){
        $sql = "SELECT p.packageid,p.resortid,p.packagename,p.packagetags,p.description as packagedescription,p.amount,p.status,p.servicetax,p.vendorid,p.packageimage
,v.vendorid,v.vendorname,v.website,v.status
,v.email,v.mobile,v.latitude,v.longitude,v.description as vendordescription,v.vendorlogo
 FROM tblpackages p
 LEFT JOIN
 tblvendors v
 ON
 p.vendorid=v.vendorid
 WHERE p.packageid='$packageid' AND p.status='1' AND v.status='1'";
        $query = $this->db->query($sql);
        //return $query->result();

        //$row = $query->row();
        return $query->row();
        //return $row->vendorid;
    }
    

    public function checkLoginCredentials($username,$password,$usertype){
        $processedResults = $this->db->query("SELECT * FROM tblusers WHERE username='$username' AND password='$password' AND usertype='$usertype' AND status=1");
        return $processedResults->num_rows();
    }

    

    public function getUserNameMobileEmail($username){
        $processedResults = $this->db->query("SELECT * FROM tblcustomers WHERE username='$username' ");
        return $processedResults->row();
    }

    public function getVendorsIdAndName(){
        return $this->db->query("SELECT vendorid,vendorname FROM tblvendors");
        
    }

    public function getVendorsData(){
        $query = $this->db->query("SELECT * from tblvendors WHERE status=1 ORDER BY vendorid DESC");
        return $query;
    }





public function getLatestSixEvents(){
        $query = $this->db->query("SELECT * from tblevents WHERE status=1 order by eventid DESC limit 0,6");
        //echo "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 GROUP by ep.eventid LIMIT 0,6";
		return $query;
    }

    

    public function getSpecificTableData($tableName,$tablePhotos,$tableId){

        $sql = 'SELECT e.*,ep.* FROM '.$tableName.' e LEFT JOIN '.$tablePhotos.' ep ON e.'.$tableId.'=ep.'.$tableId.' WHERE e.status=1 GROUP by ep.'.$tableId;
        $query = $this->db->query($sql);
        return $query->row();
    }


    


    public function getResultsBasedOnSearchEvents($searchtype,$searchterm,$searchdate){

        //$sQuery = "";
         $sQuery = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE (e.status=1 AND e.date>='$searchdate') OR e.location LIKE '%$searchterm%' OR e.eventname LIKE '%$searchterm%' OR e.description LIKE '%$searchterm%' GROUP by ep.photoname";
        /*
        if ($searchtype=="eventname") {
                            $sQuery = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE (e.status=1 AND e.date>='$searchdate') OR e.location LIKE '%$searchterm%' OR e.eventname LIKE '%$searchterm%' OR e.description LIKE '%$searchterm%' GROUP by ep.photoname";

                           
                          } else {
                            $sQuery = "SELECT r.*,rp.* FROM tblresorts r LEFT JOIN tblresorphotos rp ON r.resortid=rp.resortid WHERE r.status=1 AND (r.location LIKE '%$searchterm%' OR r.resortname LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.resortid";
                          }

                          */
                    //echo $sQuery."<br>";
                          $query = $this->db->query($sQuery);
       
        return $query;
    }

    

    public function getNumberOfRowsForSearchEvents(){

        $searchterm=$this->session->userdata('searchterm');
        $searchdate = $this->session->userdata('searchdate');

         $sQuery = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 AND (e.fromdate>='$searchdate' OR e.todate='$searchdate') AND  ( e.location LIKE '%$searchterm%' OR e.eventname LIKE '%$searchterm%' OR e.description LIKE '%$searchterm%' ) GROUP by ep.photoname";
        
        $query = $this->db->query($sQuery);
       
        return $query->num_rows();
    }

    public function getNumberOfRowsForSearchEvents_showAllEvents(){


         $sQuery = "SELECT e.*,ep.* FROM tblevents e LEFT JOIN tbleventphotos ep ON e.eventid=ep.eventid WHERE e.status=1 GROUP by ep.eventid";
        
        $query = $this->db->query($sQuery);
       
        return $query->num_rows();
    }

    public function getNumberOfRowsForSearchResorts(){

        $searchterm=$this->session->userdata('searchterm');
        $searchdate = $this->session->userdata('searchdate');

         $sQuery = "SELECT r.*,rp.* FROM tblresorts r LEFT JOIN tblresorphotos rp ON r.resortid=rp.resortid WHERE r.status=1 AND (r.location LIKE '%$searchterm%' OR r.resortname LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.resortid";
        
        $query = $this->db->query($sQuery);
       
        return $query->num_rows();
    }


    

    public function getNumberOfRowsForSearchPlaces(){

        $searchterm=$this->session->userdata('searchterm');
        $searchdate = $this->session->userdata('searchdate');

         $sQuery = "SELECT r.*,rp.* FROM tblplaces r LEFT JOIN tblplacesphotos rp ON r.plid=rp.plid WHERE r.status=1 AND (r.address LIKE '%$searchterm%' OR r.place LIKE '%$searchterm%' OR r.description LIKE '%$searchterm%') GROUP by rp.plid";
        
        $query = $this->db->query($sQuery);
       
        return $query->num_rows();
    }



    public function getResortData($vendorid){
        $query = $this->db->query("SELECT e.resortid,e.vendorid,e.resortname,v.vendorname,e.location,e.description,e.createdby,e.createdon,e.updatedby,e.updatedon from tblresorts e LEFT JOIN tblvendors v ON e.vendorid=v.vendorid WHERE e.status=1 AND e.vendorid='$vendorid' ORDER BY e.resortid DESC;");
        return $query;
    }
    
    public function getLoginsuperuser($username,$password,$usertype)
    {
        $sql ="select * from staff_login where username='".$username."' and password='".$password."' and usertype='".$usertype."'";
        if($query=$this->db->query($sql)==1)
        {
            return "true";
        }else{
            return "false";
        }
        
    }

    public function getLoginstaff($username,$password,$usertype)
    {
        $sql ="select * from staff_login where username='".$username."' and password='".$password."' and usertype='".$usertype."'";
        if($query=$this->db->query($sql)==1)
        {
            return "true";
        }else{
            return "false";
        }
    }

    public function getVendorId($username){
      $query = $this->db->query("SELECT vendorid from tblvendors WHERE username='$username' AND status=1");
      
        $row = $query->row();
        return $row->vendorid;
      
    }

    public function getEventsData($vendorid){
        $query = $this->db->query("SELECT e.eventid,e.vendorid,e.date,v.vendorname,e.location,e.time,e.eventname,e.eventtype,e.cost from tblevents e LEFT JOIN tblvendors v ON e.vendorid=v.vendorid WHERE e.status=1 AND v.vendorid='$vendorid' ORDER BY e.eventid DESC");
        return $query;
    }
	

}
?>


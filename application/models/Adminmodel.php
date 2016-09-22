<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminmodel extends CI_Model {

	public function __construct()
	{
	    $this->load->database();
	}

    public function checkIfEmailOrPhoneExistsInVendorTable($email,$mobile){
        $processedResults = $this->db->query("SELECT * FROM tblvendors WHERE email='$email' OR mobile='$mobile'");
        return $processedResults->num_rows();
    }
    

    public function checkLoginCredentials($username,$password,$usertype){
        $processedResults = $this->db->query("SELECT * FROM tblusers WHERE username='$username' AND password='$password' AND usertype='$usertype' AND status=1");
        return $processedResults->num_rows();
    }

     public function getVendorPayments(){
        $query = $this->db->query("SELECT vp.*, v.vendorname from tblvendorpayments vp left join tblvendors v on vp.vendorid=v.vendorid order by vp.vpid desc;");
        return $query;
    }

    public function getVendorsIdAndName(){
        return $this->db->query("SELECT vendorid,vendorname FROM tblvendors WHERE status=1");
        
    }


    

    public function getVendorOutStandingTransactions(){
        //echo "select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid GROUP BY t.vendorid ORDER BY t.tid desc";
        return $this->db->query("SELECT sum(t.amountrecieved) as amountrecieved, sum(t.servicecharges) as servicecharges,sum(t.amountpaid) as amountpaid,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid GROUP BY t.vendorid ORDER BY t.tid desc");
        
    }


    

    public function getVendorCommissionReportAll($fromdate,$todate){
        //echo "select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid GROUP BY t.vendorid ORDER BY t.tid desc";
        return $this->db->query("select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.transactiondate BETWEEN '$fromdate' AND '$todate' GROUP BY t.vendorid ORDER BY t.tid desc");
        
    }

   
   
     public function  getVendorOutStandingTransactionsOnVendorId($vendorid){
        //echo "select t.*,v.vendorname,SUM(t.amountrecieved)-SUM(t.amountpaid) AS outstanding from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.vendorid='t.vendorid' ORDER BY t.tid desc";
        return $this->db->query("select t.*,v.vendorname,SUM(t.amountreceived)-SUM(t.amountpaid) AS outstanding from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.vendorid='$vendorid' ORDER BY t.tid desc");
        
    }


    


    public function  getVendorCommissionReportOnVendorId($vendorid,$fromdate,$todate){
        //echo "select t.*,v.vendorname,SUM(t.amountreceived)-SUM(t.amountpaid) AS outstanding from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.vendorid='$vendorid' AND t.transactiondate BETWEEN '$fromdate' AND '$todate' ORDER BY t.tid desc";
        return $this->db->query("select t.*,v.vendorname from tbltransactions t INNER JOIN tblvendors v ON t.vendorid=v.vendorid WHERE t.vendorid='$vendorid' AND t.transactiondate BETWEEN '$fromdate' AND '$todate' ORDER BY t.tid desc");
        
    }

    

    public function getPaymentsData(){
        return $this->db->query("SELECT p.paymentid,p.bookingid,p.customerid,p.transaction_id,p.referenceno,p.transdate,p.amount,p.response,b.bookingtype,b.bookingtypeid,b.date,b.userid,b.quantity,b.amount,b.booking_status,b.payment_status,b.ticketnumber,tbp.packagename FROM `tblpayments` p LEFT JOIN tblbookings b ON p.bookingid=b.bookingid LEFT JOIN tblpackages tbp ON b.packageid=tbp.packageid;");
        
    }
    

    public function getSpecificPackageData($packageid){
        $query =  $this->db->query("SELECT * FROM tblpackages WHERE packageid='$packageid'");
        return $query->row();

        
    }

    public function getVendorsBooking($vendorid){
        $sql = "SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid left join tblvendors v ON b.vendorid=v.vendorid WHERE v.vendorid='$vendorid'";
        //echo $sql."<br>";
        $query =  $this->db->query($sql);
        return $query->row();
        
    }


    

    public function getCompletePackagesData(){
        return $this->db->query("SELECT p.resortid,p.packageid,r.resortname,p.packagename,p.description,p.adultprice,p.status,p.createdby, p.createdon,p.updatedby,p.updatedon,p.servicetax,p.vendorid,v.vendorname,p.packageimage,p.packagetags,p.packagetype,p.eventid,e.eventname FROM `tblpackages` p LEFT JOIN `tblresorts` r ON p.resortid=r.resortid LEFT JOIN tblvendors v ON p.vendorid=v.vendorid LEFT JOIN tblevents e ON p.eventid=e.eventid WHERE p.status=1 ;");
        
    }

    

    public function getCompleteEventsData(){
        $query = $this->db->query("SELECT * from tblevents WHERE status=1 ORDER BY eventid DESC");
        return $query->result();
    }

    public function getVendorsData(){
        $query = $this->db->query("SELECT * from tblvendors WHERE status=1 ORDER BY vendorid DESC");
        return $query;
    }

     public function getEventsData(){
        $query = $this->db->query("SELECT e.eventid,e.vendorid,e.todate,e.fromdate,v.vendorname,e.location,e.totime,e.eventname from tblevents e LEFT JOIN tblvendors v ON e.vendorid=v.vendorid WHERE e.status=1 ORDER BY e.eventid DESC");
		echo "SELECT e.eventid,e.vendorid,e.todate,e.fromdate,v.vendorname,e.location,e.totime,e.eventname from tblevents e LEFT JOIN tblvendors v ON e.vendorid=v.vendorid WHERE e.status=1 ORDER BY e.eventid DESC";
		
        return $query;
    }

    public function getResortData(){
        $query = $this->db->query("SELECT e.resortid,e.vendorid,e.resortname,v.vendorname,e.location,e.description,e.createdby,e.createdon,e.updatedby,e.updatedon from tblresorts e LEFT JOIN tblvendors v ON e.vendorid=v.vendorid WHERE e.status=1 ORDER BY e.resortid DESC;");
        return $query;
    }
    public function getVendordetailsbyID($vendorid)
    {
        $query = $this->db->query("SELECT * from tblvendors WHERE  status=1 and vendorid='$vendorid'");
		echo "SELECT * from tblvendors WHERE  status=1 and vendorid='$vendorid'";
        return $query;
    }
    
    public function getCompleteResortsData(){
        $query = $this->db->query("SELECT * from tblresorts WHERE status=1 ORDER BY vendorid DESC;");
        return $query->result();
    }

    public function getPlacesData(){
        $query = $this->db->query("SELECT * from tblplaces;");
        return $query;
    }

    public function getSlidersData(){
        $query = $this->db->query("SELECT * from tblsliders;");
        return $query;
    }

    public function getMobileSliders(){
        $query = $this->db->query("SELECT * from mobilesliders;");
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

    public function get_raasi_code($table,$where){
      $get="select * from ".$table." where s_birth_star='".$where."' ";
      $query=$this->db->query($get);
      foreach($query->result() as $query1){
        return $query1->fk_s_raasi;
      }
    }


    public function checkVendorLoginCredentials($username,$password){
        $processedResults = $this->db->query("SELECT * FROM tblvendors WHERE email='$username' AND password='$password' AND status=1");
        //echo "SELECT * FROM tblvendors WHERE email='$username' AND password='$password' AND status=1";
        return $processedResults->num_rows();
    }
	

}
?>


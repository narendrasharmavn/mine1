<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VendorModel extends CI_Model {

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

    public function getVendorsIdAndName(){
        return $this->db->query("SELECT vendorid,vendorname FROM tblvendors");
        
    }

    public function getVendorsData(){
        $query = $this->db->query("SELECT * from tblvendors WHERE status=1 ORDER BY vendorid DESC");
        return $query;
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
        $query = $this->db->query("SELECT * from tblvendors WHERE email='$username' AND status=1");
        $row = $query->row();
        return $row->vendorid;
    }

    public function getVendorsResorts($vendorid){
        $query = $this->db->query("SELECT * from tblresorts WHERE vendorid='$vendorid' AND status=1 ORDER BY vendorid DESC");
        return $query;
    }

    public function getVendorsEvents($vendorid){
        $query = $this->db->query("SELECT * from tblevents WHERE vendorid='$vendorid' AND status=1 ORDER BY vendorid DESC");
        return $query;
    }


    public function getEventsData($vendorid){
        $query = $this->db->query("SELECT e.eventid,e.vendorid,e.fromdate,e.todate,v.vendorname,e.location,e.totime,e.eventname,e.eventtype,e.cost from tblevents e LEFT JOIN tblvendors v ON e.vendorid=v.vendorid WHERE e.status=1 AND v.vendorid='$vendorid' ORDER BY e.eventid DESC");
        return $query;
    }
	

    public function getVendorsPackages($vendorid){
        $query = $this->db->query("SELECT p.resortid,p.packageid,r.resortname,p.packagename,p.description,p.adultprice,p.childprice,p.status,p.createdby, p.createdon,p.updatedby,p.updatedon,p.servicetax,p.vendorid,v.vendorname,p.packageimage,p.packagetags,p.packagetype,p.eventid,e.eventname FROM `tblpackages` p LEFT JOIN `tblresorts` r ON p.resortid=r.resortid LEFT JOIN tblvendors v ON p.vendorid=v.vendorid LEFT JOIN tblevents e ON p.eventid=e.eventid WHERE p.vendorid='$vendorid' AND p.status=1;");
        return $query;
    }

    public function getVendordetails()
    {
        $query = $this->db->query("SELECT * from tblvendors WHERE  status=1 ORDER BY vendorid DESC");
        return $query;
    }
	

}
?>


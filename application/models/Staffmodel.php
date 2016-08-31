<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staffmodel extends CI_Model {

	public function checkLoginCredentials($email,$password,$usertype,$vendorid){
        $processedResults = $this->db->query("SELECT * FROM tblusers WHERE email='$email' AND password='$password' AND usertype='$usertype' AND vendorid='$vendorid' AND status=1");
        return $processedResults->num_rows();
    }

  
}
?>
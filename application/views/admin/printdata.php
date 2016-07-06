<html>
<head>
  <style type="text/css">
  #tabbdr { border: 1px solid #000; }
  @media print
  {    
      #printbtn
      {
          display: none !important;
      }
  }
</style>
</head>
<body>
<center>
  <h1>Healthy Matrimony</h1>
  <hr>
  <h3>Registration Form</h3>
</center>
<?php
$id = $_GET['id']; 
//echo $id;
$query = $this->db->query("SELECT * FROM register WHERE ID='$id'");
$row = $query->row(); 
$email = $row->lemail;
$sql = $this->db->query("SELECT * FROM photos WHERE email='$email'");
$rows = $query->row(); 
?>

<table align="center" width="1100" height="800" id="tabbdr">
  <tr>
    <td  width="500">
      <table style="line-height:40px;">
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><?php echo $row->name; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $row->lemail; ?></td>
        </tr>
        <tr>
            <td>Birthplace</td>
            <td>:</td>
            <td><?php echo $row->pob; ?></td>
        </tr>
        <tr>
            <td>Height</td>
            <td>:</td>
            <td><?php echo $row->height; ?></td>
        </tr>
        <tr>
            <td>Country</td>
            <td>:</td>
            <td><?php echo $row->residing_country; ?></td>
        </tr>
        <tr>
            <td>District </td>
            <td>:</td>
            <td><?php echo $row->native_district; ?></td>
        </tr>
        <tr>
            <td>Villages  </td>
            <td>:</td>
            <td><?php echo $row->village; ?></td>
        </tr>
        <tr>
            <td>Phone No</td>
            <td>:</td>
            <td><?php echo $row->phone; ?></td>
        </tr>
        <tr>
            <td>Religion</td>
            <td>:</td>
            <td><?php echo $row->religion; ?></td>
        </tr>
        <tr>
            <td>Caste </td>
            <td>:</td>
            <td><?php echo $row->caste; ?></td>
        </tr>
        <tr>
            <td>Birth Star </td>
            <td>:</td>
            <td><?php echo $row->birthstar; ?></td>
        </tr>
        
        <tr>
          <td><b><u>Education & Occupation Details</u></b></td>
        </tr>
        
        <tr>
            <td>Education Type</td>
            <td>:</td>
            <td><?php echo $row->education_type; ?></td>
        </tr>
        <tr>
            <td>Education </td>
            <td>:</td>
            <td><?php echo $row->education; ?></td>
        </tr>

        <tr>
            <td>Property </td>
            <td>:</td>
            <td><?php echo $row->property." ".$row->property_price_type; ?></td>
        </tr>
        <tr>
          <td><b><u>Personal Details</u></b></td>
        </tr>
        <tr>
            <td>Father's Name</td>
            <td>:</td>
            <td><?php echo $row->fathername; ?></td>
        </tr>
        <tr>
            <td>Father's Occupation </td>
            <td>:</td>
            <td><?php echo $row->fatheroccupation; ?></td>
        </tr>
        <tr>
            <td>No of Brothers</td>
            <td>:</td>
            <td><?php echo $row->brothers; ?></td>
        </tr>

        <tr>
            <td>No of Sisters</td>
            <td>:</td>
            <td><?php echo $row->sisters; ?></td>
        </tr>
        
        <tr>
            <td>Reference 1</td>
            <td>:</td>
            <td><?php echo $row->reference1; ?></td>
        </tr>
      </table>
    </td>

    <td width="500">
        <table style="line-height:40px;">
          <tr>
            <td>Surname</td>
            <td>:</td>
            <td><?php echo $row->lastname; ?></td>
          </tr>
          <tr>
            <td>Gender</td>
            <td>:</td>
            <td><?php echo $row->gender; ?></td>
          </tr>
          <tr>
            <td>Date of Birth</td>
            <td>:</td>
            <td><?php echo $row->dob; ?></td>
        </tr>
        <tr>
            <td>State</td>
            <td>:</td>
            <td><?php echo $row->residing_state; ?></td>
        </tr>
        <tr>
            <td>Mandalam</td>
            <td>:</td>
            <td><?php echo $row->mandal; ?></td>
        </tr>
        <tr>
            <td>Alt Phone No</td>
            <td>:</td>
            <td><?php echo $row->alt_phone; ?></td>
        </tr>
        <tr>
            <td>Marital Status </td>
            <td>:</td>
            <td><?php echo $row->maritalstatus; ?></td>
        </tr>
        <tr>
            <td>Sub-Caste</td>
            <td>:</td>
            <td><?php echo $row->subcaste; ?></td>
        </tr>
        <tr>
            <td>Gothram</td>
            <td>:</td>
            <td>Satya</td>
        </tr>
        <tr>
            <td>Padam</td>
            <td>:</td>
            <td><?php echo $row->padam; ?></td>
        </tr>
        <tr>
            <td>Raasi </td>
            <td>:</td>
            <td><?php echo $row->raasi; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Occupation Type</td>
            <td>:</td>
            <td><?php echo $row->occupation_type; ?></td>
        </tr>
        <tr>
            <td>Occupation</td>
            <td>:</td>
            <td><?php echo $row->occupation; ?></td>
        </tr>
        <tr>
            <td>Income</td>
            <td>:</td>
            <td><?php echo $row->income." ".$row->incometype; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td>Mother's Name</td>
            <td>:</td>
            <td><?php echo $row->mothername; ?></td>
        </tr>
        <tr>
            <td>Mother's Occupation</td>
            <td>:</td>
            <td><?php echo $row->motheroccupation; ?></td>
        </tr>
        <tr>
            <td>Proper Address</td>
            <td>:</td>
            <td><?php echo $row->address; ?></td>
        </tr>

        <tr>
            <td>Reference 2</td>
            <td>:</td>
            <td><?php echo $row->reference2; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        
        </table>
    </td> 	
  </tr>
  <tr>
    <td><b><u>Photos Uploaded</u></b></td>
  </tr>
  <tr>  
    <td>
       <?php 
      foreach ($sql->result() as $k) {
       ?>
       <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $k->imgpath; ?>" width="100px" height="100px">
       <?php } ?>
       
    </td>

  </tr>
</table>
<center>
<button onclick="myFunction()" name="print" id="printbtn">Print</button>
</center>
<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>

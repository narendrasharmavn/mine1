<?php
   include 'header.php'; 
   
   
   
   ?>
<section role="main" class="content-body">
<header class="page-header">
   <h2>Add Events</h2>
   <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
         <li>
            <a href="dashboard">
            <i class="fa fa-home"></i>
            </a>
         </li>
         <li><span>Add Events</span></li>
         <li><span>Event's</span></li>
      </ol>
      <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
   </div>
</header>
<!-- start: page -->
<div class="row">
   <div class="col-lg-12 col-xs-12">
      <section class="panel">
         <header class="panel-heading">
            <div class="panel-actions">
               <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
               <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">Add Events</h2>
         </header>
         <div class="panel-body">
            <?php 
               echo form_open_multipart('Vendor/submiteventdata',array('class' => 'form-horizontal','id' => 'addevents'));
               
               ?>
            <?php echo $this->session->flashdata('success'); ?>
            <div class="row">
               <div class="col-md-10">
                  
                  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label pull-left">Event Name *</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="eventname"  placeholder="Enter event name" value="<?php echo set_value('eventname'); ?>">
                      <span class="text-danger"><?php echo form_error('eventname'); ?></span>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address *</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="location"  placeholder="Enter Location" value="<?php echo set_value('location'); ?>">
                      <span class="text-danger"><?php echo form_error('location'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event FromDate *</label>
                    <div class="col-sm-7 col-xs-7">
                      <input type="text" id="fromdate" style="cursor:default;background-color:white;" class="form-control" name="evenfromdate" id="evenfromdate" placeholder="Enter event date" value="<?php echo set_value('evenfromdate'); ?>" readonly>
                      <span class="text-danger"><?php echo form_error('evenfromdate'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event ToDate *</label>
                    <div class="col-sm-7 col-xs-7">
                      <input type="text" id="todate" class="form-control" name="eventodate" id="eventodate" placeholder="Enter event date" style="cursor:default;background-color:white;" value="<?php echo set_value('eventodate'); ?>" readonly>
                      <span class="text-danger"><?php echo form_error('eventodate'); ?></span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label pull-left">FromTime </label>
                    <div class="col-sm-7">
                      <input type="time" class="form-control" name="fromtime" id="fromtime" placeholder="Choose time" value="<?php echo set_value('fromtime'); ?>">
                      <span class="text-danger"><?php echo form_error('fromtime'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label pull-left">ToTime </label>
                    <div class="col-sm-7">
                      <input type="time" class="form-control" name="totime" id="totime" placeholder="Choose time" value="<?php echo set_value('totime'); ?>">
                      <span class="text-danger"><?php echo form_error('totime'); ?></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label pull-left">Latitude </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="latitude"  placeholder="Latitude" value="<?php echo set_value('latitude'); ?>">
                      <span class="text-danger"><?php echo form_error('latitude'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label pull-left">Longitude</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="longitude"  placeholder="Longitude" value="<?php echo set_value('longitude'); ?>">
                      <span class="text-danger"><?php echo form_error('longitude'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description *</label>
                    <div class="col-sm-7">
                      <textarea class="description" name="description" id="description" ><?php echo set_value('description'); ?></textarea>
                      <span class="text-danger"><?php echo form_error('description'); ?></span>
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-5 control-label pull-left">Banner Image *</label>
                      <div class="col-sm-7">
                        <input type="file" id="packageimage" name="userfile">
                        <span class="text-danger"><?php echo form_error('event'); ?></span>
                      </div>
                  </div>
                </div>
              
            </div>
            <div>&nbsp;</div>
            <center>
               <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-6 col-xs-11">
                     <button type="submit"  class="btn btn-primary">Submit</button>
                     <button type="reset"  class="btn btn-danger">Cancel</button>
                  </div>
               </div>
            </center>
            </form>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <h2 class="panel-title">Events Data</h2>
            <hr>
            <hr>
                                  <div>&nbsp;</div>
                                  <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                      <thead>
                        <tr>
                          <th>Vendor Name</th>
                          <th>Event name</th>
                          <th>Location </th>
                          
                          <th>Date</th>
                          <th class="hidden-phone">Edit</th>
                          <th class="hidden-phone">Delete</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        
                          

                          foreach ($results->result() as $k) {
                            # code...
                          
                          
                        ?>
                        <tr>
                          <td><?php echo $k->vendorname; ?></td>
                          <td><?php echo $k->eventname; ?></td>
                          <td><?php echo $k->location; ?></td>
                          
                          <td><?php echo date("d-m-Y", strtotime($k->fromdate))." - ".date("d-m-Y", strtotime($k->todate));  ?></td>
                          
                          <td class="center hidden-phone">
                            <a href="<?php echo site_url(); ?>vendor/editeventdata/<?php echo $k->eventid; ?>"   name="edit" id="edit" value="edit">
                              Edit
                            </a>
                          </td>
                          <td class="center hidden-phone"><a href="#" onclick="deleteeventid(<?php echo $k->eventid; ?>)">Delete</a></td>

                          
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
         </div>
      </section>
   </div>
</div>


<script type="text/javascript">
   function deleteeventid(id)
   
   {
   
       var uid = id;
   
       //alert(uid);
   
       if (confirm("Are You Sure You Want To Delete") == true) {
   
        
   
           $.ajax({
   
       type: "POST",
   
       url: '<?php echo site_url("admin/deleteeventid")?>',
   
       data: {
   
              
   
              uid:uid
   
             },
   
       success: function(res) {
   
       //alert(res); 
   
       location.reload();
   
       }
   
        }); 
   
   
   
    } else {
   
        location.reload();
   
    }
   
   }
   
   
   
</script>
<?php
   include 'footer.php'; 
   
   
   
   ?>
  
      <script>

      var $j = jQuery.noConflict();
      $(document).ready(function(){
    // we call the function
     $( "#expirydate" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});
         //alert(id);

         $("#fromdate").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function () {
            var dt2 = $('#todate');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            //minDate of dt2 datepicker = dt1 selected day
            dt2.datepicker('setDate', minDate);
            //sets dt2 maxDate to the last day of 30 days window
            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
            //same for dt1
            $(this).datepicker('option', 'minDate', minDate);
        }
    });

       $('#todate').datepicker({
        dateFormat: "dd-mm-yy"
    });
       
      

    });




    $j("#addevents").validate({
    
          
        // Specify the validation rules
        rules: {
            eventname : "required",
			location : "required",
			evenfromdate : "required",
			eventodate : "required",
			userfile : "required",
			description : "required"
			
		},
        
        // Specify the validation error messages
        messages: {
			eventname : "Event Name Should not be Empty",
			location : "Location Should not be Empty",
			evenfromdate : "Event FromDate Should not be Empty",
			eventodate : "Event ToDate Should not be Empty",
			userfile : "Upload atleast One Photo",
			description : "Description Should not be Empty"
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
   </script>
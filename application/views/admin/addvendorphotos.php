<?php
 include 'header.php'; 
 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Upload</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Upload Vendor Pics</span></li>
								
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

						


					<!-- start: page -->
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Vendor Images Upload</h2>
									</header>
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/uploadvendorpics/'.$vendorid,array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
			

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Add Pics</label>
								                <div class="col-sm-7">
								                  <input type="file" name="userfile[]" multiple>
												  <span class="text-danger"><?php echo form_error('userfile'); ?></span>
								                </div>
								               
							                </div>

							               
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="submit"  class="btn btn-primary hidden-xs">Add Pics</button>
												</div>
											</div>

										</form>

                                        <div>&nbsp;</div>
			                            <div>&nbsp;</div>

			                            <h2 class="panel-title">Vendors Images Data</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													
													<th>Vendor Image</th>
													
													<th class="hidden-phone">Delete</th>
													
												</tr>
											</thead>
											<tbody>
												<?php 
												
													
													$vendorData = $this->db->query("SELECT * FROM tblvendorphotos WHERE vendorid='$vendorid'");
													
													foreach ($vendorData->result() as $k) {
														# code...
													
													
												?>
												<tr>
													
													<td><img src="<?php echo base_url().'assets/vendorimages/'.$k->photoname; ?>" height="80px;"></td>
								
													<td class="center hidden-phone"><a href="#" onclick="deletevendorimages(<?php echo $k->vphotoid; ?>)">Delete</a></td>

													
												</tr>
												<?php } ?>
											</tbody>
										</table>

									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

	    function deletevendorimages(id)
		{
	   	    var uid = id;
	   	    //alert(uid);
            
           
            
	   	    if (confirm("Are You Sure You Want To Delete") == true) {
		        
	            $.ajax({
			      type: "POST",
			      url: '<?php echo site_url("admin/deletevendorimages")?>',
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
 <script src="<?php echo base_url(); ?>assets/assets/vendor/dropzone/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/javascripts/forms/examples.advanced.form.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-markdown/js/markdown.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/vendor/codemirror/lib/codemirror.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/vendor/codemirror/addon/selection/active-line.js"></script>
 <script type="text/javascript">

    $(document).ready(function(){
		// we call the function
		 var url = window.location.href;
		 var res = url.split("?id="); 
         var id = res[1];
         //alert(id);
        
		ajaxC(id);
        setTimeout(function(){
		  ajaxS(id);
		  setTimeout(function(){
		    ajaxM(id);
		    setTimeout(function(){
			   ajaxE(id);
			}, 2500);
		  }, 2500);
		}, 2500);
       
		


		 

    });

 </script>
<?php
 include 'header.php'; 
 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Edit</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Edit Event Data</span></li>
								
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
						
										<h2 class="panel-title">Event Edit</h2>
									</header>
									<div class="panel-body">
										
										<?php

								            echo form_open_multipart('Admin/submiteditaddslider',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         <?php
								            $sliderid = $this->uri->segment(3, 0); 
											//echo $placeid;
											$query = $this->db->query("SELECT * FROM tblsliders WHERE sid='$sliderid'");
											$rows = $query->row(); 
											//$name = $rows->itemname;
							
								         ?>
									
								         
										 
											<input type="hidden" class="form-control" name="sid" id="sid"  value="<?php echo $rows->sid; ?>">
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Name</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?php echo $rows->name; ?>">
												  <span class="text-danger"><?php echo form_error('name'); ?></span>
								                </div>
							                </div>
											
											
							                                                      
											
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="submit"  class="btn btn-primary hidden-xs">Update</button>
												</div>
											</div>	
										</form>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

	    



	</script>
						
								
<?php
 include 'footer.php'; 

 ?>

 <script type="text/javascript">

    $(document).ready(function(){
		
    });

 </script>
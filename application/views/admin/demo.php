<h3>Partner Preferences Details</h3>
											<hr>

											<div class="form-group">
								                <label for="inputEmail3" class="col-sm-1 control-label">Age</label>
								                    <div class="col-sm-2">
									                  <select class="form-control" name="ages1" id="ages1">
									                    <?php

									                      if($gender=='Female'){ $age1=$age+1;
									                      $age2 = $age+4;
									                      }else{
									                      $age1 =$age-4;
									                      $age2 =$age-1;
									                      }
									                      for($i=18;$i<=60;$i++){
									                      if($i== $age1){
									                      echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
									                      }else{
									                      echo '<option value="'.$i.'" >'.$i.'</option>';
									                      }
									                      }
									                    ?>
									                  </select>
									                </div>

									                <div class="col-sm-2">
									                  <select class="form-control" name="ages2" id="ages2">
									                    <?php
									                    for($i=18;$i<=60;$i++){
									                    if($i== $age2){
									                          echo '<option value="'.$i.'"  selected="selected">'.$i.'</option>';
									                    }else{
									                    echo '<option value="'.$i.'" >'.$i.'</option>';
									                    }
									                    }
									                    ?>
									                  </select>
									                </div> 
								                <label for="inputPassword3" class="col-sm-1 control-label">Height</label>
								                 <div class="col-md-2 col-sm-2">
							                    <select class="form-control" name="pheight" id="pheight">
							                      <option value="">Select </option>
							                      <option value="Any">Any </option>
							                      <?php
							                          $profile_id=$this->session->userdata('pid');
							                          $query = $this->db->query("SELECT * FROM register WHERE profile_id='$profile_id'");
							                          $row = $query->row(); 
							                          $ip = $row->height;
							                          $gender = $row->gender;
							                          $arr = array(4,5,6);
							                          foreach($arr as $num)
							                          {
							                            for($i=0;$i<=11;$i++)
							                            {
							                              $ht = $num.'\' '.$i.'&quot;';
							                              if(strlen($i)==1) { $val = $num.'.0'.$i;}
							                              if(strlen($i)==2) { $val = $num.'.'.$i;}
							                              $split_arr = explode('.',$ip);
							                              $ft =  $split_arr[0];
							                              $inch = $split_arr[1];
							                              if(substr($inch,0,1)==0)
							                              {
							                                $inch = substr($inch,1,1);
							                              }
							                              if($gender == 'Male')
							                              {
							                                $inch-=7;
							                                if($inch<0)
							                                {
							                                  $inch = $inch+12;
							                                  $ft-=1; 
							                                }
							                              }
							                              
							                              if($gender == 'Female')
							                              {
							                                $inch+=4;
							                                
							                                if($inch>11)
							                                {
							                                  $inch = $inch-12;
							                                  $ft+=1; 
							                                }
							                              }
							                              
							                              if($inch<10)
							                                {
							                                $inch = '0'.$inch;  
							                                }
							                              
							                              $ht_val = $ft.'.'.$inch;
							                              if($ht_val == $val)
							                              {
							                                echo '<option value="'.$val.'" selected="selected">'.$ht.'</option>'; 
							                              }
							                              else
							                              {
							                              echo '<option value="'.$val.'">'.$ht.'</option>'; 
							                              }
							                            }
							                          }
							                                  
							                      ?>          
							                    </select>
							                  </div>
							                  <div class="col-md-2 col-sm-2">
							                    <select class="form-control" name="pheight1" id="pheight1">
							                      <option value="">Select </option>
							                      <option value="Any">Any </option>
							                      <?php
							        
							                         foreach($arr as $num)
							                            {
							                              for($i=0;$i<=11;$i++)
							                              {
							                                $ht = $num.'\' '.$i.'&quot;';
							                                if(strlen($i)==1) { $val = $num.'.0'.$i;}
							                                if(strlen($i)==2) { $val = $num.'.'.$i;}
							                                $split_arr = explode('.',$ip);
							                                $ft =  $split_arr[0];
							                                $inch = $split_arr[1];
							                                if(substr($inch,0,1)==0)
							                                {
							                                  $inch = substr($inch,1,1);
							                                }
							                                if($gender == 'Male')
							                                {
							                                  $inch-=4;
							                                  if($inch<0)
							                                  {
							                                    $inch = $inch+12;
							                                    $ft-=1; 
							                                  }
							                                }
							                                
							                                if($gender == 'Female')
							                                {
							                                  $inch+=7;
							                                  
							                                  if($inch>11)
							                                  {
							                                    $inch = $inch-12;
							                                    $ft+=1; 
							                                  }
							                                }
							                                
							                                if($inch<10)
							                                  {
							                                  $inch = '0'.$inch;  
							                                  }
							                                
							                                $ht_val = $ft.'.'.$inch;
							                                if($ht_val == $val)
							                                {
							                                  echo '<option value="'.$val.'" selected="selected">'.$ht.'</option>'; 
							                                }
							                                else
							                                {
							                                echo '<option value="'.$val.'">'.$ht.'</option>'; 
							                                }
							                              }
							                          }        
							                      ?>
							                    </select>
							                  </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Marital Status</label>
								                <div class="col-sm-3">
								                	<select class="form-control" name="pmstatus" id="pmstatus">
								                	  <option value="" <?php echo  set_select('pmstatus', 'Select'); ?>>Select</option>
								                      <option value="UnMarried" <?php echo  set_select('pmstatus', 'UnMarried'); ?>>UnMarried</option>
								                      <option value="Widow/Widower" <?php echo  set_select('pmstatus', 'Widow/Widower'); ?>>Widow/Widower</option>
								                      <option value="Divorce" <?php echo  set_select('pmstatus', 'Divorce'); ?>>Divorce</option>
								                      <option value="Separated" <?php echo  set_select('pmstatus', 'Separated'); ?>>Separated</option>
								                    </select>
								                  
								                </div>
								                <label for="inputPassword3" class="col-sm-2 control-label">Religion</label>
								                <div class="col-sm-3">
								                    <select class="form-control" name="preligion" id="preligion">
									                    <option>Select</option>
									                    <?php 
									                    foreach ($religion->result() as $row)
									                    {               
									                        //echo $row->religion_name;
									                    
									                    ?>
									                    <option value="<?php echo $row->religion_name; ?>"><?php echo $row->religion_name; ?></option>
									                    <?php } ?>
								                    </select>
								                  
								                </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Caste</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="pcaste" id="pcaste" placeholder="Partner Caste" value="<?php echo set_value('pcaste'); ?>">
								                </div>
								                <label for="inputPassword3" class="col-sm-2 control-label">Subcaste</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="psubcaste" id="psubcaste" placeholder="Partner Subcaste" value="<?php echo set_value('psubcaste'); ?>">
								                </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Education Type</label>
								                <div class="col-sm-3">
								                  
								                  <select class="form-control" name="pedtype" id="pedtype" onchange="ajaxPartnerEducation(this.value)">
								                    <option value="0" <?php echo  set_select('pedtype', '0'); ?> style="padding: 3px;border-bottom: solid 1px silver;">Select Education Type</option>
								                    <option style="padding: 3px;border-bottom: solid 1px silver;" value="any" <?php echo  set_select('pedtype', 'any'); ?>>Any</option>
								                    <?php 
								                    foreach ($edtype->result() as $et)
								                    {               
								                      //echo $et->education_name;
								                    ?>
								                    <option value="<?php echo $et->education_table_id; ?>" style="padding: 3px;border-bottom: solid 1px silver;" ><?php echo $et->education_name; ?></option>
								                    <?php } ?>
								                  </select>
								                </div>
								                <label for="inputPassword3" class="col-sm-2 control-label">Education</label>
								                <div class="col-sm-3">
								                    <select class="form-control peducation"  id="peducation" name="peducation">
									                  <option style="padding: 3px;border-bottom: solid 1px silver;">Select Education</option>
									                  <option style="padding: 3px;border-bottom: solid 1px silver;" value="any" <?php echo  set_select('education', 'any'); ?>>Any</option>
									                </select>
								                  
								                </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Occupation Type</label>
								                <div class="col-sm-3">
								                  <select class="form-control"  name="pocctype" id="pocctype">
								                    <option value="0" <?php echo  set_select('pocctype', '0'); ?> style="padding: 3px;border-bottom: solid 1px silver;">Select Occupation</option>
								                    <option style="padding: 3px;border-bottom: solid 1px silver;" value="any" <?php echo  set_select('pocctype', 'any'); ?>>Any</option>
								                    <?php 
								                    foreach ($occtype->result() as $ot)
								                    {               
								                        //echo $ot->education_name;
								                    
								                    ?>
								                    <option value="<?php echo $ot->occupation_table_id; ?>" style="padding: 3px;border-bottom: solid 1px silver;"><?php echo $ot->occupation_name; ?></option>
								                    <?php } ?>
								                  </select>

								                  
								                </div>
								                <label for="inputPassword3" class="col-sm-2 control-label">Occupation </label>
								                <div class="col-sm-3">
								                  <select class="form-control" name="poccupation" id="poccupation">
								                    	<option value="" <?php echo  set_select('poccupation', 'Select'); ?>>Select</option>
								                      <option value="Government" <?php echo  set_select('poccupation', 'Government'); ?>>Government</option>
								                      <option value="Private" <?php echo  set_select('poccupation', 'Private'); ?>>Private</option>
								                      <option value="Business" <?php echo  set_select('poccupation', 'Business'); ?>>Business</option>
								                      <option value="Defence" <?php echo  set_select('poccupation', 'Defence'); ?>>Defence</option>
								                      <option value="Self Employeed" <?php echo  set_select('poccupation', 'Self Employeed'); ?>>Self Employeed</option>
								                      <option value="Other" <?php echo  set_select('poccupation', 'Other'); ?>>Other</option>
								                    </select>
								                  
								                </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Occupation Details</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="poccdetails" id="poccdetails" placeholder="Partner Occupation Details" value="<?php echo set_value('poccdetails'); ?>">
								                </div>
								                <label for="inputPassword3" class="col-sm-2 control-label">Income</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="pincome" id="pincome" placeholder="Partner Income" value="<?php echo set_value('pincome'); ?>">
								                </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Property</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="pproperty" id="pproperty" placeholder="Partner Property" value="<?php echo set_value('pproperty'); ?>">
								                </div>
								                <label for="inputPassword3" class="col-sm-2 control-label">Birthstar</label>
								                <div class="col-sm-3">
								                    <select class="form-control" name="pbstar" id="pbstar">
								                      <option>Select</option>
								                      <?php 
								                       foreach ($birthstar->result() as $bs)
								                      {               
								                          //echo $bs->name;
								                      ?>
								                      <option value="<?php echo $bs->s_birth_star; ?>"><?php echo $bs->s_birth_star; ?></option>
								                      <?php } ?>
								                    </select>
								                  
								                </div>
							                </div>
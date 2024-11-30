<div class="container-fluid content-area">


        <!--page-header closed-->

        <!--row open-->
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="row">
                        <div class="col-md-6 mb-3">

                            <h4 style="margin-left:30px; margin-top:50px;">Manage Role Rights</h4>

                        </div>
                        <div class="col-md-6 mb-3">
                            
                        </div>
                    </div>
                    <div class="card-header">

                    </div>
                    
                    <div class="card-body">
                        
                        <div class="table-responsive">
                    <?php $this->load->helper("form"); ?>
                    <?php echo form_open('Manage_role/saveRights'); ?>
                            <input type="hidden" name="rolecode" value="<?php echo $rolecode; ?>"  />
                            <table id="" class="table table-bordered border-t0 key-buttons text-nowrap w-100" >
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Module Name</th>
                                        <th>View</th>
                                        <th>Add</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($roleInfo)) :
                                        $cnt = 0;
                                        foreach ($roleInfo as $row) :
                                            $ncount_add = 0;$ncount_edit = 0;$ncount_view = 0;$ncount_delete = 0;
                                            $CI =& get_instance();
                                            $ncount_view = $CI->Manage_Role_Model->viewRight($rolecode,$row->mod_modulecode);
                                            $ncount_add = $CI->Manage_Role_Model->addRight($rolecode,$row->mod_modulecode);
                                            $ncount_edit = $CI->Manage_Role_Model->editRight($rolecode,$row->mod_modulecode);
                                            $ncount_delete = $CI->Manage_Role_Model->deleteRight($rolecode,$row->mod_modulecode);
                                            ?>                    
                                            <tr>
                                                <td><?php echo htmlentities($cnt+1); ?></td>
                                                <td><?php 
                                                if($row->mod_modulecode=='Onshelf'){
                                                    echo "Category";
                                                }
                                                elseif($row->mod_modulecode=='OnshelfProduct'){
                                                    echo "Sub Category";
                                                }
                                                else{
                                                echo $row->mod_modulecode; 
                                                }
                                                ?></td>
                                                <td align="">
                                                    
                                                    
                                                    <div class="checkbox"<?php if($row->mod_view==1){ ?> style="visibility:hidden !important;" <?php } ?>>
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" value="yes" name="view[<?php echo $cnt; ?>]" <?php if($ncount_view > 0){ echo 'checked';}?> <?php if($row->mod_view==1){ ?>style="visibility:hidden !important;" <?php } ?> />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td align="">
                                                    <div class="checkbox"<?php if($row->mod_add==1){ ?> style="visibility:hidden !important;" <?php } ?>>
                                                        <label class="checkbox-inline">
                                                        <input type="hidden" name="mod_modulecode[<?php echo $cnt; ?>]" value="<?php echo $row->mod_modulecode; ?>"  />
                                                        <input type="checkbox" value="yes" name="add[<?php echo $cnt; ?>]" <?php if($ncount_add > 0){ echo 'checked';}?> <?php if($row->mod_add==1){ ?>style="visibility:hidden !important;" <?php } ?> />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td align="">
                                                    <div class="checkbox"<?php if($row->mod_edit==1){ ?> style="visibility:hidden !important;" <?php } ?>>
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" value="yes" name="edit[<?php echo $cnt; ?>]" <?php if($ncount_edit > 0){ echo 'checked';}?> <?php if($row->mod_edit==1){ ?>style="visibility:hidden !important;" <?php } ?> />
                                                        </label>
                                                    </div>
                                                </td>
                                                <td align="">
                                                    <div class="checkbox"<?php if($row->mod_delete==1){ ?> style="visibility:hidden !important;" <?php } ?>>
                                                        <label class="checkbox-inline">
                                                        <input type="checkbox" value="yes" name="delete[<?php echo $cnt; ?>]" <?php if($ncount_delete > 0){ echo 'checked';}?> <?php if($row->mod_delete==1){ ?>style="visibility:hidden !important;" <?php } ?> />
                                                        </label>
                                                    </div>
                                                </td>



                                            </tr>
                                            <?php
                                            $cnt++;
                                        endforeach;
                                    else :
                                        ?>

                                        <tr>
                                            <td colspan="6">No Record found</td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>      
                                </tbody>
                              </table>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--row closed-->

    
</div>
<!--app-content closed-->


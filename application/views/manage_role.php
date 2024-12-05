<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<div class="">

<div class="breadcrumb-area">
<h1>All Users</h1>
<ol class="breadcrumb">

<li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
<li class="item">Manage Role</li>
</ol>
</div>

<div class="all-applicants-box">

                <!-- <div class="card"> -->
                    <div class="row">


<table id="example" class="display" style="width:100%">
										
									<thead>
													<tr>
														<th>Sr#</th>
														<th>Role Code</th>
														<th>Role Name</th>
														<th>Description</th>
														
													</tr>
												</thead>
												<tbody>
								<?php
								if(count($roledetails)) :
								$cnt=1; 
								foreach ($roledetails as $row) :
								?>                    
                                                                    <tr>
                                                                      <td><?php echo htmlentities($cnt);?></td>
                                                                      <?php //if (authorize($_SESSION["access"]["ADMIN"]["Role"]["edit"])) { ?>
                                                                      <td><?php echo  anchor("Manage_role/editRoleRights/{$row->role_rolecode}",$row->role_rolecode,'style="color:#ed1b2d; cursor:pointer;letter-spacing: 2px;"')?></td>
                                                                      <?php //} ?>
                                                                      <td><?php echo htmlentities($row->role_rolename)?></td>
                                                                      <td><?php echo htmlentities($row->description)?></td>



                                                                    </tr>
								 <?php 
								$cnt++;
								endforeach;
								else : ?>

								<tr>
								<td colspan="6">No Record found</td>
								</tr>
								<?php
								endif;
								?>      
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

					</section>
				</div>
				<!--app-content closed-->
				<script type="text/javascript">
$(document).ready(function () {
    $('#example').DataTable();
});
</script>

<div class="page-bar">
	<ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Site</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?php echo $tombol; ?></span>
        </li>
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>Detail data Site</p>
</div>

<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase"> Data Tower Rental</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('site'); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
                </div>
			</div>
			<div class="portlet-body">
            
                <form method="post" id="form" class="form-horizontal detailnya">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Site ID</label>
                                <div class="col-sm-10">
                                    <input type="text" name="siteid" value="<?php echo $data['siteid']; ?>" class="form-control aneh" placeholder="Site ID" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Site Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sitename" value="<?php echo $data['sitename']; ?>" class="form-control aneh" placeholder="Site Name" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">TP Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="tpname" value="<?php echo $data['tpname']; ?>" class="form-control aneh" placeholder="TP Name" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Site Status</label>
                                <div class="col-sm-8">
                                    <select name="sitestatus" class="form-control aneh" disabled>
                                    <?php
                                    $arr = array('on air', 'on going');
                                    foreach($arr as $v)
                                    {
                                        $selected = ($v == $data['sitestatus'] ? ' selected' : '');
                                        echo '<option value="'.$v.'">'.strtoupper($v).'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Longitude</label>
                                <div class="col-sm-8">
                                    <input type="text" name="longitude" value="<?php echo $data['longitude']; ?>" class="form-control aneh" placeholder="Longitude" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Latitude</label>
                                <div class="col-sm-8">
                                    <input type="text" name="latitude" value="<?php echo $data['latitude']; ?>" class="form-control aneh" placeholder="Latitude" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" value="<?php echo $data['address']; ?>" class="form-control aneh" placeholder="Address" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">City</label>
                                <div class="col-sm-8">
                                    <input type="text" name="city" value="<?php echo $data['city']; ?>" class="form-control aneh" placeholder="City" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Province</label>
                                <div class="col-sm-8">
                                    <input type="text" name="province" value="<?php echo $data['province']; ?>" class="form-control aneh" placeholder="Province" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Site Available For Colo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="site_available_for_colo" value="<?php echo $data['site_available_for_colo']; ?>" class="form-control aneh" placeholder="Site Available For Colo" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Site Type</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sitetype" value="<?php echo $data['sitetype']; ?>" class="form-control aneh" placeholder="Site Type" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tower Type</label>
                                <div class="col-sm-8">
                                    <input type="text" name="towertype" value="<?php echo $data['towertype']; ?>" class="form-control aneh" placeholder="Tower Type" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Building Height (m)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="buidingheight" value="<?php echo $data['buidingheight']; ?>" class="form-control aneh" placeholder="Site Type" disabled>
                                        <span class="input-group-addon">meter</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tower Height  (m) from DPL</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="towerheight" value="<?php echo $data['towerheight']; ?>" class="form-control aneh" placeholder="Site Type" disabled>
                                        <span class="input-group-addon">meter</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Shareable Status</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shareablestatus" value="<?php echo $data['shareablestatus']; ?>" class="form-control aneh" placeholder="Shareable Status" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Availabletower Space</label>
                                <div class="col-sm-8">
                                    <input type="text" name="availabletowerspace" value="<?php echo $data['availabletowerspace']; ?>" class="form-control aneh" placeholder="Availabletower Space" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Availableground Space</label>
                                <div class="col-sm-8">
                                    <input type="text" name="availablegroundspace" value="<?php echo $data['availablegroundspace']; ?>" class="form-control aneh" placeholder="Availableground Space" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Site Contract Period</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sitecontractperiod" value="<?php echo $data['sitecontractperiod']; ?>" class="form-control aneh" placeholder="Site Contract Period" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Comm Case History</label>
                                <div class="col-sm-8">
                                    <select name="commcasehistory" class="form-control aneh" disabled>
                                    <?php
                                    $arr = array('Y'=>'Yes', 'N'=>'No');
                                    foreach($arr as $k=>$v)
                                    {
                                        $selected = ($k == $data['commcasehistory'] ? ' selected' : '');
                                        echo '<option value="'.$k.'">'.strtoupper($v).'</option>';
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase"> Rental History</span>
                </div>
			</div>
			<div class="portlet-body">
            
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="info">
                            <th>No.</th>
                            <th>Lease Start</th>
                            <th>Lease End</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $this->db->where('id_rsite', $data['id1']);
                    $get = $this->db->get('rsite_sewa');
                    if($get->num_rows() > 0)
                    {
                        $no = 1;
                        foreach($get->result() as $dt)
                        {
                            echo '<tr>
                                    <td class="text-center" width="50">'.$no.'</td>
                                    <td class="text-center">'.$this->apps->tgl_indo($dt->leasestart).'</td>
                                    <td class="text-center">'.$this->apps->tgl_indo($dt->leaseend).'</td>
                                    <td>'.$dt->keterangan.'</td>
                                  </tr>';
                            $no += 1;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            
			</div>
		</div>
	</div>
</div>

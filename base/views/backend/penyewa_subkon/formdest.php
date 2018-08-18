<div class="page-bar">
	<ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?php echo ($site->sitename == '' ? $site->siteid : $site->sitename); ?></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><?php echo ($site->operator); ?></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Penyewa Subkon</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pilih Master Harga</span>
        </li>
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>Pilih Master Harga</p>
</div>

<?php if($this->session->flashdata('error')) { ?>
<div class="note note-info">
    <ul style="margin-left: -15px;margin-bottom: 0;">
        <?php
        echo '<li>'.$this->session->flashdata('error').'</li>';
        ?>
    </ul>
</div>
<?php } ?>

<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase"> Data Site</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('penyewa_subkon/addest/'.$site->id.'/'.$site->idx); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                    <a href="<?php echo base_url('penyewa_subkon/index/'.$site->id.'/'.$site->idx); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
                </div>
			</div>
			<div class="portlet-body">
                <table>
                    <tr>
                        <td width="100"><strong>ID Site</strong></td>
                        <td>: <?php echo $site->siteid; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Site Name</strong></td>
                        <td>: <?php echo $site->sitename; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Operator</strong></td>
                        <td>: <?php echo $site->operator; ?></td>
                    </tr>
                </table>
                
                <hr>
                
                <table class="table table-striped table-bordered table-hover" id="mytable">
                    <thead>
                        <tr class="info">
                            <th style="text-align: center;width: 40px;">No</th>
                            <th>Material</th>
                            <th>Description</th>
                            <th>UOM</th>
                            <th>Harga Satuan</th>
                            <th>PPN</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td colspan="5">Tidak memilih master harga</td>
                            <td class="text-center"><a href="<?php echo base_url('penyewa_subkon/add/'.$site->id.'/'.$site->idx); ?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Pilih</a></td>
                        </tr>
                        <?php
                        $this->db->where('idbouwheer', $site->id_bouwherr);
                        $get = $this->db->get('masterharga');
                        $no = 2;
                        foreach($get->result() as $r)
                        {
                            echo '<tr>
                                    <td class="text-center">'.$no.'</td>
                                    <td class="text-center">'.$r->material.'</td>
                                    <td class="text-left">'.$r->description.'</td>
                                    <td class="text-center">'.$r->uom.'</td>
                                    <td class="text-right">'.number_format($r->hargasatuan, 0, ',', '.').'</td>
                                    <td class="text-center">'.($r->termasukppn == 'Y' ? 'Ya' : 'Tidak').'</td>
                                    <td class="text-center"><a href="'.base_url('penyewa_subkon/add/'.$site->id.'/'.$site->idx.'?ref='.$r->id1).'" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Pilih</a></td>
                                  </tr>';
                            $no += 1;
                        }
                        ?>
                    </tbody>
                </table>
            
			</div>
		</div>
	</div>
</div>
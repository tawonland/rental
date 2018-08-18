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
            <span>Penyewa Keuangan</span>
        </li>
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>Data Penyewa Keuangan</p>
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
                    <a href="<?php echo base_url('penyewa_keuangan/add/'.$site->id.'/'.$site->idx); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
                    <a href="<?php echo base_url('tenant/index/'.$site->id); ?>" class="btn btn-circle btn-primary btn-sm"><i class="fa fa-long-arrow-left"></i> Back</a>
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
                            <th>Tagihan Ke</th>
                            <th>No. Invoice</th>
                            <th>Tgl. Invoice</th>
                            <th>No. PO</th>
                            <th>Status</th>
                            <th>Tgl. Bayar</th>                                                                
                            <th>#</th>                                                                        
                        </tr>
                    </thead>
                </table>
            
			</div>
		</div>
	</div>
</div>

<?php
$url = base_url();
$controller = $this->router->class;
$id_site = $site->id;
$id_tenant = $site->idx;
$js = <<<EOD
$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
{
  return {
    "iStart": oSettings._iDisplayStart,
    "iEnd": oSettings.fnDisplayEnd(),
    "iLength": oSettings._iDisplayLength,
    "iTotal": oSettings.fnRecordsTotal(),
    "iFilteredTotal": oSettings.fnRecordsDisplay(),
    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
  };
};

var t = $('#mytable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": '{$url}{$controller}/data/{$id_site}/{$id_tenant}',
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},
        {"data": "tagihan_ke", "class": "text-left"}, 
        {"data": "no_invoice", "class": "text-left"}, 
        {"data": "tgl_invoice", "class": "text-center"}, 
        {"data": "no_po", "class": "text-left"}, 
        {"data": "sudah_dibayar", "class": "text-center"}, 
        {"data": "tgl_bayar", "class": "text-center"},
        {"data": "aksi", "class": "text-center"}
    ],
    "order": [[2, 'asc']],
    "rowCallback": function (row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
    },
    "createdRow": function( row, data, dataIndex){
        if( data['aktif'] ==  'non aktif'){
            $(row).addClass('redBg');
        }
    }
});
EOD;

$this->apps->set_js($js);
?>
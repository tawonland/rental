<div class="page-bar">
	<ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Report</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Gaji</span>
        </li>
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>Data Report Gaji</p>
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
                    <span class="caption-subject bold uppercase"> Data Report Gaji</span>
                </div>
                <div class="actions">                    
                    <a href="<?php echo base_url('report/export_xls/gaji'); ?>" class="btn btn-circle btn-primary btn-sm" target="_blank" download><i class="fa fa-file-excel-o"></i> Eksport Excel</a>
                </div>
			</div>
			<div class="portlet-body">
            
                <table class="table table-striped table-bordered table-hover" id="mytable">
                    <thead>
                        <tr class="info">
                            <th style="text-align: center;width: 40px;">No</th>
                            <th>Site</th>                                                                        
                            <th>Alamat</th>                                                                        
                            <th>Periode Kontrak</th>                                                                        
                            <th>Jenis Biaya</th>                                                                        
                            <th>Jumlah</th>                                                                        
                            <th>Tgl. Bayar</th>                                                                        
                            <th>Sudah Bayar</th>                                                                        
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
    "ajax": '{$url}{$controller}/data/gaji',
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},
        {"data": "site", "class": "text-left"}, 
        {"data": "alamat", "class": "text-left"}, 
        {"data": "sitecontractperiod", "class": "text-center"}, 
        {"data": "jenis_biaya", "class": "text-center uppercase"}, 
        {"data": "jumlah", "class": "text-right"},
        {"data": "tgl_bayar", "class": "text-center"},
        {"data": "sudah_bayar", "class": "text-center"}
    ],
    "order": [[4, 'asc']],
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
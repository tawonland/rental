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
            <span>Rekap</span>
        </li>
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>Data Report Rekap</p>
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
                    <span class="caption-subject bold uppercase"> Data Report Rekap</span>
                </div>
                <div class="actions">                    
                   <a href="<?php echo base_url('report/export_xls/rekap'); ?>" class="btn btn-circle btn-primary btn-sm" target="_blank" download><i class="fa fa-file-excel-o"></i> Eksport Excel</a>
                </div>
			</div>
            
            <!--
            <div class="portlet-body">
                <div class="caption font-green-sharp">                        
                    <form id="form-filter" class="form-horizontal" method="post" target="_blank">
                        <div class="form-group">
                            <label for="operator" class="col-sm-2 control-label">Operator</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="operator" name="operator">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="LastName" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                                <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="portlet-title">

                <div class="actions">                    
                    <button id="btn-export-excel" class="btn btn-circle btn-primary btn-sm" target="_blank" download><i class="fa fa-file-excel-o"></i> Eksport Excel</button>
                </div>
            </div>
            -->

			<div class="portlet-body">
            
                <table class="table table-striped table-bordered table-hover" id="mytable">
                    <thead>
                        <tr class="info" valign="midle">
                            <th rowspan="2" style="text-align: center;width: 40px;">No</th>
                            <th rowspan="2">Operator</th>
                            <th rowspan="2">Site Name</th>
                            <th rowspan="2">Kabupaten</th>
                            <th colspan="2">Progress</th>
                            <th rowspan="2">Harga Sewa<br>Total</th>
                        </tr>
                        <tr class="info">
                            <th>Tower High</th>
                            <th>Status Progress</th>
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

$url_export_xls = base_url('report/export_xls/rekap');

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
    "ajax": {
        "url" : "{$url}{$controller}/data/rekap",
        "type" : "POST",
        "data" : function ( data ) {
                    data.operator = $('#operator').val();
                }
    },
    
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},
        {"data": "operator", "class": "text-left"}, 
        {"data": "sitename", "class": "text-left"}, 
        {"data": "city", "class": "text-left"}, 
        {"data": "towerheight", "class": "text-left"}, 
        {"data": "sitestatus", "class": "text-center"}, 
        {"data": "sewatotal", "class": "text-right"}
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

$('#btn-filter').click(function(){ //button filter event click
    t.ajax.reload();  //just reload table
});

$('#btn-reset').click(function(){ //button reset event click
    $('#form-filter')[0].reset();
    t.ajax.reload();  //just reload table
});

$('#btn-export-excel').click(function(){
    $('#form-filter').attr('action', '{$url_export_xls}');
    $('#form-filter').submit();
});

EOD;

$this->apps->set_js($js);
?>
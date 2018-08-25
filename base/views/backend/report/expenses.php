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
            <span>Expenses</span>
        </li>
	</ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<div class="note note-info">
    <p>Data Report Expenses</p>
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
                    <span class="caption-subject bold uppercase"> Data Report Expenses</span>
                </div>
                <div class="actions">                    
                    <button id="btn-export-excel" class="btn btn-circle btn-primary btn-sm" target="_blank" download><i class="fa fa-file-excel-o"></i> Eksport Excel</button>
                </div>
			</div>
            
            
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title" >Custom Filter : </h3>
                </div>
                <div class="panel-body">
                    <form id="form-filter" class="form-horizontal" method="get" target="_blank">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tanggal Bayar</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control" placeholder="Tanggal Awal" name="tgl_bayar_awal" required="" autocomplete = "off" id="tgl_bayar_awal">
                                            <span class="input-group-addon"> s/d </span>
                                            <input type="text" class="form-control" placeholder="Tanggal Akhir" name="tgl_bayar_akhir" required="" autocomplete = "off" id="tgl_bayar_akhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Filter" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="txtSearch" id="txtSearch">
                                        <button type="button" id="btn-filter" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                                        <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            

			<div class="portlet-body">
            
                <table class="table table-striped table-bordered table-hover" id="mytable">
                    <thead>
                        <tr class="info" valign="midle">
                            <th style="text-align: center;width: 40px;">No</th>
                            <th>Site</th>
                            <th>Keterangan</th>
                            <th>Jenis Biaya</th>                            
                            <th>Jumlah</th>
                            <th>Tgl Bayar</th>
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

$url_export_xls = base_url('report/export_xls/expenses');

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
                "url" : "{$url}{$controller}/data/expenses",
                "data" : function ( data ) {
                    data.tgl_bayar_awal = $('#tgl_bayar_awal').val();
                    data.tgl_bayar_akhir = $('#tgl_bayar_akhir').val();
                    data.txtSearch = $('input[id=txtSearch]').val();
                },
                "type" : "GET"
            },
    
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},
        {"data": "site", "class": "text-left"},
        {"data": "keterangan", "class": "text-left"},
        {"data": "jenis_biaya", "class": "text-left"}, 
        {"data": "jumlah", "class": "text-right"},
        {"data": "tgl_bayar", "class": "text-center"}, 
        {"data": "sudah_bayar", "class": "text-center"}
    ],
    "order": [[6, 'desc']],
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

    var search = $('input[type=search]').val();

    $('input[id=search]').val(search);
    t.ajax.reload();  //just reload table
});

$('#btn-reset').click(function(){ //button reset event click
    $('#form-filter')[0].reset();
    $('.input-daterange').val('').datepicker('remove').datepicker({autoclose: true, format: 'yyyy-mm-dd',todayHighlight: true});
    t.ajax.reload();  //just reload table
});

$('#btn-export-excel').click(function(){
    $('#form-filter').attr('action', '{$url_export_xls}');

    var search = $('input[type=search]').val();
    $('input[id=txtSearch]').val(search);

    $('#form-filter').submit();
});

$('.input-daterange').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true
});

EOD;

$this->apps->set_js($js);
?>
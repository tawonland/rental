<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase"><?=$title?></span>
                </div>
			</div>
			<div class="portlet-body">                
                <table class="table table-striped table-bordered table-hover" id="mytable">
                    <thead>
                        <tr class="info">
                            <th style="text-align: center;width: 40px;">No</th>
                            <th>Site</th>                                                                        
                            <th>Operator</th>                                                                       
                            <th>Masa Sistem Pembayaran</th>                                                                  
                            <th>Periode Tagihan (Bulan)</th>                                     
                            <th>Tagihan Ke</th>                                     
                            <th>No Invoice</th>                                     
                            <th>Tgl. Invoice</th>                                     
                            <th>Nilai Invoice</th>                                     
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
    "ajax": '{$url}{$controller}/data',
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},
        {"data": "site", "class": "text-left"},
        {"data": "operator", "class": "text-left"},
        {"data": "masa_sistem_pembayaran", "class": "text-center"},
        {"data": "periode_tagihan", "class": "text-center"},
        {"data": "tagihan_ke", "class": "text-center"},
        {"data": "no_invoice", "class": "text-center"},
        {"data": "tgl_invoice", "class": "text-center"},
        {"data": "nilai_invoice", "class": "text-right"}

        ],
    "order": [[7, 'asc']],
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
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <span>Dashboard</span>
        </li>
        <?php
        if (isset($subbreadcrumb)){
            foreach ($subbreadcrumb as $key => $value) {
                ?>
                <li>
                    <i class="fa fa-circle"></i>
                    <span><?php echo $value; ?></span>
                </li>
                <?php
            }
        }
        ?>
        
    </ul>
</div>
<h1 class="page-title font-blue"> <?php echo $title?> | 
    <small>Aplikasi BTS</small>
</h1>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349"><?php echo $total_tenant?></span>
                </div>
                <div class="desc"> Total Tenant</div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349"><?php echo $total_tower?></span>
                </div>
                <div class="desc"> Total Tower</div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase">Jumlah Tenant Per-Site</span>
                </div>                
            </div>
            <div class="portlet-body">                
                <table class="table table-striped table-bordered table-hover" id="tableJmlTenantPersite">
                    <thead>
                        <tr class="info">
                            <th style="text-align: center;width: 40px;">No</th>
                            <th>Site</th>                                                                 
                            <th>City</th>                                                                 
                            <th>Jumlah Tenant</th>                                                                 
                            <th>Nama Tenant</th>                                                                 
                        </tr>
                    </thead>
                </table>            
            </div>
        </div>
    </div>

</div>

<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
                <div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase">Tgl Invoice Yang Belum Dibayar</span>
                </div>                
			</div>
			<div class="portlet-body">                
                <table class="table table-striped table-bordered table-hover" id="tableTglInvoice">
                    <thead>
                        <tr class="info">
                            <th style="text-align: center;width: 40px;">No</th>
                            <th>Operator</th>
                            <th>Site</th>                                                                 
                            <th>Tgl Invoice</th>                                                                 
                            <th>Lease End</th>                                                                 
                        </tr>
                    </thead>
                </table>            
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
                <div class="caption font-green-sharp">                        
                    <span class="caption-subject bold uppercase">Lease End Site</span>
                </div>                
			</div>
			<div class="portlet-body">                
                <table class="table table-striped table-bordered table-hover" id="tableSiteLeaseEnd">
                    <thead>
                        <tr class="info">
                            <th style="text-align: center;width: 40px;">No</th>
                            <th>Site</th>                                                                 
                            <th>City</th>                                                                 
                            <th>Lease</th>                                                                 
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

var t3 = $('#tableJmlTenantPersite').DataTable({
    "processing": true,
    "serverSide": true,
    "pageLength": 5,
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "ajax": '{$url}{$controller}/jml_tenant_persite',
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},        
        {"data": "site", "class": "text-left"},
        {"data": "city", "class": "text-left"},
        {"data": "jml_tenant", "class": "text-center"},
        {"data": "nama_tenant", "class": "text-left"}

        ],
    "order": [[3, 'desc']],
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

var t = $('#tableTglInvoice').DataTable({
    "processing": true,
    "serverSide": true,
    "pageLength": 5,
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "ajax": '{$url}{$controller}/tgl_invoice_blm_bayar',
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},        
        {"data": "operator", "class": "text-left"},
        {"data": "site", "class": "text-left"},
        {"data": "tgl_invoice", "class": "text-center"},
        {"data": "leaseend", "class": "text-center"}

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

var t2 = $('#tableSiteLeaseEnd').DataTable({
    "processing": true,
    "serverSide": true,
    "pageLength": 5,
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "ajax": '{$url}{$controller}/leaseend_site',
    "columns": [
        {"data": "DT_RowId", "class": "text-center", "orderable": false},        
        {"data": "site", "class": "text-left"},
        {"data": "city", "class": "text-left"},
        {"data": "lease", "class": "text-center"}

        ],
   
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
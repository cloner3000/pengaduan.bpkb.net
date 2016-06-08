<div class="span8">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon"><i class="icon-th-list"></i></span>
            <h5>Pemberitahuan</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="data-table table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th width="60%">Pemberitahuan</th>
                    <th width="60%">Tanggal</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2" class="dataTables_empty">Loading data..</td>
                </tr>
                </tbody>
            </table>
            <div class="well well-small"></div>
        </div>
    </div>
</div>



<script type="text/javascript">
    var oTable;
    $(document).ready(function() {
        var url = getBaseURL();
        var cfajax = fconfig("#pesan",true);
        $('#fajax').ajaxForm(cfajax);
        oTable = $('.data-table').dataTable({
            "sDom": '<""rl>ti<"F"fp>',
            "bJQueryUI": true,
            "bProcessing": true,
            "oLanguage": {
                "sProcessing": '<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">loading page..</span></div>',
            },
            "iDisplayStart": 0,
            "iDisplayLength": 50,
            "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, 'All']],
            "sPaginationType": "full_numbers",
            "aaSorting": [[ 1, "DESC" ]],
            "aoColumnDefs": [ {
                "sClass": "tdcenter",
                "aTargets": [0]
            }],
            "bServerSide": true,
            "bDeferRender": true,
            "sAjaxSource": url+"ticket_feed/dataajax",
            "fnServerData": function( sUrl, aoData, fnCallback ) {
                aoData.push();
                $.ajax( {
                    "url": sUrl,
                    "data": aoData,
                    "type" :"POST",
                    "success": fnCallback,
                    "dataType": "json",
                    "cache": false

                } );
            },
            "fnDrawCallback":function(oSettings ){
            }
        });

        $(".dataTables_filter input[type=text]").keydown(function(e) {
            if(e.keyCode == 13){
                oTable.fnFilter(this.value, null, false);
                return false;
            }
        });

    });
</script>

<script type="text/javascript">
    // Filtetr Status
    // function filtetrStatus(enabled_filter = null){
    //     enabled = enabled_filter.value;
    //     $('#data-table').DataTable().ajax.url("{{ route('admin.services.index') }}"+'?enabled='+ enabled +'&type=filter').load();
    // }
    $("#filter_status").on("change", function(){
        $('#data-table').DataTable().ajax.reload(null, !0);
    });
</script>
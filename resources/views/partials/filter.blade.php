<script type="text/javascript">
    // Filtetr Status
    function filtetrStatus(enabled_filter = null){
        enabled = enabled_filter.value;
        $('#data-table').DataTable().ajax.url("{{ route('admin.services.index') }}"+'?enabled='+ enabled +'&type=filter').load();
    }
</script>
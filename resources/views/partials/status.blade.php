<script type="text/javascript">
    // Change Status
    function selectStatus(id){
        status_id = id;
    }

    $(document).on('change', '#status', function(e) {
        var status_option = $(this).find("option:selected").val();
        if(status_option == "1"){
            var lang = "{{ app()->getLocale() }}";
            if (lang == "ar") {
                toastr.success('{{ trans('admin.status_changed') }}');
            } else {
                toastr.success('{{ trans('admin.status_changed') }}', '', {positionClass: 'toast-bottom-left'});
            }
        }else if(status_option == "0"){
            var lang = "{{ app()->getLocale() }}";
            if (lang == "ar") {
                toastr.success('{{ trans('admin.status_changed') }}');
            } else {
                toastr.success('{{ trans('admin.status_changed') }}', '', {positionClass: 'toast-bottom-left'});
            }
        } else {
            var lang = "{{ app()->getLocale() }}";
            if (lang == "ar") {
                toastr.error('{{ trans('admin.status_not_changed') }}');
            } else {
                toastr.error('{{ trans('admin.status_not_changed') }}', '', {positionClass: 'toast-bottom-left'});
            }
        }
        $.ajax({
            url: getLocation + "/updateStatus/" + status_id + "?enabled=" + status_option,
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            method: "POST",
            data: {},
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data)
                {
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                {
                    html += '<p>' + data.errors[count] + '</p>';
                }
                    html += '</div>';
                }
                if(data.success)
                {
                    $('#data-table').DataTable().ajax.reload();
                }
            }
        });
    });
</script>
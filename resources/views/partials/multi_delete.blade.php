<script type="text/javascript">
    // Multiple Delete
    $(document).on('click', '.multi_delete', function(){
        var item_checked = $('[name="item[]"]:checked').length;
        var allids = [];
        var swalAlert;
        if (item_checked > 0) {
            swalAlert = swal({
                title: "{{ trans('admin.multi_delete') }} "+ item_checked +"!",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('admin.yes') }}',
                cancelButtonText: '{{ trans('admin.cancel') }}'
            }) 
        } else {
            swalAlert = swal({
                title: "{{ trans('admin.no_multi_data') }}",
                type: "warning",
                showCloseButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                focusCancel: true,
                cancelButtonColor: '#222223',
                cancelButtonText: '{{ trans('admin.close') }}'
            })
        }
        swalAlert.then(function(result){
            if(result.value){
                $.ajax({
                    type: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    url: getLocation + "destroy/all/multi",
                    success: function(data){
                        $('#data-table').DataTable().ajax.reload();
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.deleted_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.deleted_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }, error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
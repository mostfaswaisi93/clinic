<script type="text/javascript">
    // Multiple Delete
    $(document).on('click', '.multi_delete', function(){
        var item_checked = $('input[class="item_checkbox"]:checkbox').filter(":checked").length;
        var allids = [];
        var swalAlert;
        if (item_checked > 0) {
            swalAlert = swal({
                title: "{{ trans('admin.multi_delete') }} "+ item_checked +"!",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
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
                cancelButtonColor: '#222223',
                cancelButtonText: '{{ trans('admin.close') }}'
            })
        }
        swalAlert.then(function(result){
            if(result.value){
                $.ajax({
                    type: "DELETE",
                    url: getLocation + "/multi" + item_checked,
                    success: function(data){
                        $('#data-table').DataTable().ajax.reload();
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.deleted_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.deleted_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                });
            }
        });
    });
</script>
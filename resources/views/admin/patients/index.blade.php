@extends('layouts.admin')
@section('title') {{ trans('admin.users') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="card">
            <div class="card-header">
                <div class="tbl-title">{{ trans('admin.users') }}</div>
            </div>
            <hr>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" class="check_all" onclick="check_all()" name="ids">
                                            <span class="vs-checkbox vs-checkbox-sm">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>{{ trans('admin.image') }}</th>
                                    <th>{{ trans('admin.full_name') }}</th>
                                    {{-- <th>{{ trans('admin.username') }}</th> --}}
                                    {{-- <th>{{ trans('admin.email') }}</th> --}}
                                    <th>{{ trans('admin.last_login') }}</th>
                                    <th>{{ trans('admin.created_at') }}</th>
                                    <th>{{ trans('admin.status') }}</th>
                                    <th>{{ trans('admin.change_status') }}</th>
                                    <th>
                                        @if(auth()->user()->can(['update_users', 'delete_users']))
                                        {{ trans('admin.action') }}
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="mutlipleDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger">
                    <div class="empty_record hidden">
                        <h4>{{ trans('admin.please_check_some_records') }} </h4>
                    </div>
                    <div class="not_empty_record hidden">
                        <h4>{{ trans('admin.ask_delete_itme') }} <span class="record_count"></span>؟</h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="empty_record hidden">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ trans('admin.close') }}</button>
                </div>
                <div class="not_empty_record hidden">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no') }}</button>
                    <input type="submit" value="{{ trans('admin.yes') }}" class="btn btn-danger del_all" />
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">
    var status  = '';
    $(document).ready(function(){
        // DataTable
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [[ 3, "desc" ]],
            ajax: {
                url: "{{ route('admin.users.index') }}",
            },
            columns: [
                {
                    render: function(data, type, row, meta) {
                        return '<div class="vs-checkbox-con vs-checkbox-primary"><input type="checkbox" name="item[]" class="item_checkbox" value="' + row.id + '"><span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check"><i class="vs-icon feather icon-check"></i></span></span></div>';
                    }, searchable: false, orderable: false
                },
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'image_path',
                    render: function(data, type, row, meta) {
                        return "<img src=" + data + " width='60px' class='img-thumbnail' />";
                    }, searchable: false, orderable: false
                },
                { data: 'full_name' },
                // { data: 'username' },
                // { data: 'email' },
                { data: 'last_login_at',
                    render: function(data, type, row, meta){
                        var text1 = "<div>"+row.last_login+"</div>";
                        var text2 = "<div>"+data+"</div>";
                        return text1 + text2;
                    }
                },
                { data: 'created_at' },
                { data: 'enabled',
                    render: function(data, type, row, meta) {
                        var text = data ? "{{ trans('admin.active') }}" : "{{ trans('admin.inactive') }}";
                        var color = data ? "success" : "danger"; 
                        return "<div class='badge badge-" +color+ "'>"+ text +"</div>";
                    }, searchable: false, orderable: false
                },
                { data: 'enabled' },
                { data: 'action', orderable: false }
            ], "columnDefs": [ {
                "targets": 7,
                render: function (data, type, row, meta){
                var $select = $(`
                    <select class='status form-control'
                    id='status' onchange=selectStatus(${row.id})>
                    <option value='1'>{{ trans('admin.active') }}</option>
                    <option value='0'>{{ trans('admin.inactive') }}</option>
                    </select>
                `);
                $select.find('option[value="'+row.enabled+'"]').attr('selected', 'selected');
                return $select[0].outerHTML
                }
            } ],            
            dom:  "<'row'<''l><'col-sm-8 text-center'B><''f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { text: '<i class="feather icon-refresh-ccw"></i> {{ trans("admin.refresh") }}',
                  className: 'btn dtbtn btn-sm btn-dark',
                  attr: { title: '{{ trans("admin.refresh") }}' },
                    action: function (e, dt, node, config) {
                        dt.ajax.reload(null, false);
                    }
                },
                { text: '<i class="feather icon-trash-2"></i> {{ trans("admin.trash") }}',
                  className: 'btn dtbtn btn-sm btn-danger multi_delete delBtn',
                  attr: { title: '{{ trans("admin.trash") }}' }
                },
                { extend: 'print', className: 'btn dtbtn btn-sm btn-primary',
                  text: '<i class="feather icon-printer"></i> {{ trans("admin.print") }}',
                  attr: { title: '{{ trans("admin.print") }}' }
                },
                { extend: 'csvHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i class="feather icon-file"></i> CSV',
                  attr: { title: 'CSV' }
                },
                { extend: 'excelHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i class="feather icon-file"></i> Excel',
                  attr: { title: 'Excel' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true, 
                  className: 'btn dtbtn btn-sm bg-gradient-danger',
                  text: '<i class="feather icon-file"></i> PDF',
                  pageSize: 'A4', attr: { title: 'PDF' }
                },
                { text: '<i class="feather icon-plus"></i> {{ trans("admin.create_user") }}',
                  className: '@if (auth()->user()->can("create_users")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                          title: '{{ trans("admin.create_user") }}',
                          href: '{{ route("admin.users.create") }}' 
                        },
                    action: function (e, dt, node, config)
                    {
                        // href location
                        window.location.href = '{{ route("admin.users.create") }}';
                    }
                },
            ],
            language: {
                url: getDataTableLanguage(),
                search: ' ',
                searchPlaceholder: '{{ trans("admin.search") }}...'
            }
        });
    });
    
    // Delete
    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        swal({
            title: "{{ trans('admin.delete_msg') }}",
            type: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('admin.yes') }}',
            cancelButtonText: '{{ trans('admin.cancel') }}'
        }).then(function(result){
            if(result.value){
                $.ajax({
                    url:"users/destroy/" + user_id,
                    success: function(data){
                        $('#users-table').DataTable().ajax.reload();
                        toastr.success('{{ trans('admin.deleted_successfully') }}!');
                    }
                });
            }
        });
    });

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
                    url: "users/multi" + item_checked,
                    success: function(data){
                        $('#users-table').DataTable().ajax.reload();
                        toastr.success('{{ trans('admin.deleted_successfully') }}!');
                    }
                });
            }
        });
    });

    // Change Status
    function selectStatus(id){
        user_id = id;
    }

    $(document).on('change', '#status', function(e) {
        var status_user = $(this).find("option:selected").val();
        // console.log(status_user)
        if(status_user == "1"){
            toastr.success('{{ trans('admin.status_changed') }}!');
        }else if(status_user == "0"){
            toastr.success('{{ trans('admin.status_changed') }}!');
        } else {
            toastr.error('{{ trans('admin.status_not_changed') }}!');
        }
        $.ajax({
            url:"users/updateStatus/"+user_id+"?enabled="+status_user,
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            method:"POST",
            data:{},
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
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
                    $('#users-table').DataTable().ajax.reload();
                }
            }
        });
    });
</script>

@endpush
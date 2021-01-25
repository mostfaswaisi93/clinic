@extends('layouts.admin')
@section('title') {{ trans('admin.roles') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="card">
            <div class="card-header">
                <div class="tbl-title">{{ trans('admin.roles') }}</div>
            </div>
            <hr>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="roles-table" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" name="" id="">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.users_count') }}</th>
                                    <th>{{ trans('admin.created_at') }}</th>
                                    <th>
                                        @if(auth()->user()->can(['update_roles', 'delete_roles']))
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

@endsection

@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [[ 2, "desc" ]],
            ajax: {
                url: "{{ route('admin.roles.index') }}",
            },
            columns: [
                {
                    'defaultContent': '<div class="vs-checkbox-con vs-checkbox-primary"><input type="checkbox" name="" id=""><span class="vs-checkbox"><span class="vs-checkbox--check"><i class="vs-icon feather icon-check"></i></span></span></div>',
                    'data'           : 'checkbox',
                    'name'           : 'checkbox',
                    'orderable'      : false,
                    'searchable'     : false,
                    'exportable'     : false,
                    'printable'      : true,
                    'width'          : '10px'
                },
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'name' },
                { data: 'users_count', 
                    render: function(data, type, row, meta) {
                        return "<div class='badge badge-success'>"+ data +"</div>";
                    }
                },
                { data: 'created_at' },
                { data: 'action', orderable: false }
            ],
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
                  className: 'btn dtbtn btn-sm btn-danger delBtn',
                  attr: { title: '{{ trans("admin.trash") }}' }
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
                { extend: 'print', className: 'btn dtbtn btn-sm btn-primary',
                  text: '<i class="feather icon-printer"></i> {{ trans("admin.print") }}',
                  attr: { title: '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true, 
                  className: 'btn dtbtn btn-sm bg-gradient-danger',
                  text: '<i class="feather icon-file"></i> PDF',
                  pageSize: 'A4', attr: { title: 'PDF' }
                },
                { text: '<i class="feather icon-plus"></i> {{ trans("admin.create_role") }}',
                  className: '@if (auth()->user()->can("create_roles")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                          title: '{{ trans("admin.create_role") }}',
                          href: '{{ route("admin.roles.create") }}' 
                        },
                    action: function (e, dt, node, config)
                    {
                        // href location
                        window.location.href = '{{ route("admin.roles.create") }}';
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
    
    $(document).on('click', '.delete', function(){
        role_id = $(this).attr('id');
        swal({
            title: "{{ trans('admin.are_sure') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('admin.yes') }}',
            cancelButtonText: '{{ trans('admin.cancel') }}'
        }).then(function(result){
            if(result.value){
                $.ajax({
                    url:"roles/destroy/" + role_id,
                    success: function(data){
                        $('#roles-table').DataTable().ajax.reload();
                        toastr.success('{{ trans('admin.deleted_successfully') }}!');
                    }
                });
            }
        });
    });
</script>

@endpush
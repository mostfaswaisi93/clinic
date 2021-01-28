@extends('layouts.admin')
@section('title') {{ trans('admin.roles') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ trans('admin.roles') }}</h4>
                    </div>
                    <div class="card-datatable">
                        <div class="col-12">
                            <table id="roles-table"
                                class="table table-striped table-bordered table-responsive dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 100%;">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="custom-control custom-control-primary custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    onclick="check_all()" name="ids" id="check_all" />
                                                <label class="custom-control-label" for="check_all"></label>
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
        </div>
    </section>
</div>

@endsection

@push('scripts')

@include('partials.delete')
{{-- @include('partials.multi_delete.blade') --}}

<script type="text/javascript">
    var getLocation = "roles";
    $(document).ready(function(){
        // DataTable
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
                    render: function(data, type, row, meta) {
                        return '<div class="custom-control custom-control-primary custom-checkbox"><input type="checkbox" name="item[]" class="item_checkbox" value="' + row.id + '"><label class="custom-control-label" for="check_all"></label></div>';
                    }, searchable: false, orderable: false
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
                { text: '<i data-feather="refresh-ccw"></i> {{ trans("admin.refresh") }}',
                  className: 'btn dtbtn btn-sm btn-dark',
                  attr: { title: '{{ trans("admin.refresh") }}' },
                    action: function (e, dt, node, config) {
                        dt.ajax.reload(null, false);
                    }
                },
                { text: '<i data-feather="trash-2"></i> {{ trans("admin.trash") }}',
                  className: 'btn dtbtn btn-sm btn-danger delBtn',
                  attr: { title: '{{ trans("admin.trash") }}' }
                },
                { extend: 'csvHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i data-feather="file"></i> CSV',
                  attr: { title: 'CSV' }
                },
                { extend: 'excelHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i data-feather="file"></i> Excel',
                  attr: { title: 'Excel' }
                },
                { extend: 'print', className: 'btn dtbtn btn-sm btn-primary',
                  text: '<i data-feather="printer"></i> {{ trans("admin.print") }}',
                  attr: { title: '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true, 
                  className: 'btn dtbtn btn-sm btn-danger',
                  text: '<i data-feather="file"></i> PDF',
                  pageSize: 'A4', attr: { title: 'PDF' }
                },
                { text: '<i data-feather="plus"></i> {{ trans("admin.create_role") }}',
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
                        toastr.success('{{ trans('admin.deleted_successfully') }}!');
                    }
                });
            }
        });
    });
</script>

@endpush
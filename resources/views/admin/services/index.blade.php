@extends('layouts.admin')
@section('title') {{ trans('admin.services') }} @endsection

@section('css')

<!-- BEGIN: Vendor CSS -->

<link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<!-- END: Vendor CSS -->

@endsection

@section('content')

<div class="content-body">
    <!-- Basic table -->
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.services.modal')
    </section>
    <!--/ Basic table -->


    <section>
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">{{ trans('admin.services') }}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-control-primary custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="check_all()"
                                                name="ids" id="check_all" />
                                            <label class="custom-control-label" for="colorCheck1"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.price') }}</th>
                                    <th>{{ trans('admin.status') }}</th>
                                    <th>{{ trans('admin.created_at') }}</th>
                                    <th>
                                        @if(auth()->user()->can(['update_services', 'delete_services']))
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

<!-- BEGIN: Page Vendor JS -->
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<!-- END: Page Vendor JS -->

<!-- BEGIN: Page JS -->
{{-- <script src="{{ url('backend/js/datatables-basic.js') }}"></script> --}}
<!-- END: Page JS -->

@include('partials.delete')
@include('admin.services.datatables-basic')
{{-- @include('partials.multi_delete') --}}

<script type="text/javascript">
    var getLocation = "services";
    $(document).ready(function(){
        // DataTable
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [[ 3, "desc" ]],
            ajax: {
                url: "{{ route('admin.services.index') }}",
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
                { data: 'name_trans' },
                { data: 'price' },
                { data: 'enabled',
                    render: function(data, type, row, meta) {
                        var text = data ? "{{ trans('admin.active') }}" : "{{ trans('admin.inactive') }}";
                        var color = data ? "success" : "danger"; 
                        return "<div class='badge badge-" +color+ "'>"+ text +"</div>";
                    }, searchable: false, orderable: false
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
                className: 'btn dtbtn btn-sm btn-danger multi_delete delBtn',
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
                  className: 'btn dtbtn btn-sm bg-gradient-danger',
                  text: '<i data-feather="file"></i> PDF',
                  pageSize: 'A4', attr: { title: 'PDF' }
                },
                { text: '<i data-feather="plus"></i> {{ trans("admin.create_service") }}',
                  className: '@if (auth()->user()->can("create_services")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                          title: '{{ trans("admin.create_service") }}',
                          href: '{{ route("admin.services.create") }}' 
                        },
                    action: function (e, dt, node, config)
                    {
                        // href location
                        window.location.href = '{{ route("admin.services.create") }}';
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
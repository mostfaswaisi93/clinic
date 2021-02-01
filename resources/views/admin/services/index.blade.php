@extends('layouts.admin')
@section('title') {{ trans('admin.services') }} @endsection

@section('css')

<!-- BEGIN: Vendor CSS -->
{{-- <link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}"> --}}
<!-- END: Vendor CSS -->

@endsection

@section('content')

<div class="content-body">
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title"><b>{{ trans('admin.services') }}</b></h4>
                    </div>
                    <div class="table-responsive" style="padding: 10px">
                        <table id="data-table"
                            class="table table-striped table-bordered table-hover table-sm dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input dt-checkboxes" type="checkbox" value=""
                                                name="" id="checkbox" />
                                            <label class="custom-control-label" for="checkbox"></label>
                                        </div>
                                        {{-- <div class="custom-control custom-control-primary custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="check_all()"
                                                name="ids" id="check_all" />
                                        </div> --}}
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
        @include('admin.services.modal')
    </section>
</div>

@endsection

@push('scripts')

<!-- START: Page Vendor JS -->
{{-- <script src="{{ url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script> --}}
<!-- END: Page Vendor JS -->

@include('partials.delete')
{{-- @include('partials.multi_delete') --}}

<script type="text/javascript">
    var getLocation = "services";
    $(document).ready(function(){
        // DataTable
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [[ 2, "desc" ]],
            ajax: {
                url: "{{ route('admin.services.index') }}",
            },
            columns: [
                {
                    render: function(data, type, row, meta) {
                        return (
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                            data +
                            '" /><label class="custom-control-label" for="checkbox' +
                            data +
                            '"></label></div>'
                        );
                    }, searchable: false, orderable: false,
                    checkboxes: {
                        selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                    }
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
                        return "<div class='badge badge-light-"+ color +"'>"+ text +"</div>";
                    }, searchable: false, orderable: false
                },
                { data: 'created_at' },
                { data: 'action', orderable: false,
                    render: function(data, type, row, meta) {
                        return (
                            '<div class="d-inline-flex">' +
                            '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) +
                            'Details</a>' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({ class: 'font-small-4 mr-50' }) +
                            'Archive</a>' +
                            '<a href="javascript:;" id="'+ row.id +'" class="dropdown-item delete-record delete" title="{{ trans("admin.delete") }}">' +
                            feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                            '{{ trans("admin.delete") }}</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="services/'+ row.id +'/edit" class="item-edit edit" title="{{ trans("admin.edit") }}">' +
                            feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                            '</a>'
                        );
                    }
                }
            ],
            dom: '<" justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<" justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
                searchPlaceholder: '{{ trans("admin.search") }}...',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    });
</script>

@endpush
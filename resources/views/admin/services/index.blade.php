@extends('layouts.admin')
@section('title') {{ trans('admin.services') }} @endsection

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
                                    <th></th>
                                    <th>#</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.price') }}</th>
                                    <th>{{ trans('admin.update_status') }}</th>
                                    <th>{{ trans('admin.status') }}</th>
                                    <th>{{ trans('admin.created_at') }}</th>
                                    <th>{{ trans('admin.actions') }}</th>
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

@include('partials.delete')
@include('partials.status')
@include('partials.multi_delete')

<script type="text/javascript">
    var status = '';
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
                { data: 'id' },
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'name_trans' },
                { data: 'price' },
                { data: 'enabled' },
                { data: 'enabled' },
                { data: 'created_at' },
                { data: 'action', orderable: false,
                    render: function(data, type, row, meta) {
                        // Action Buttons
                        return (
                            '<div class="d-inline-flex">' +
                            '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({ class: 'font-small-4 mr-50' }) +
                            'Archive</a>' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['edit-3'].toSvg({ class: 'font-small-4 mr-50' }) +
                            '{{ trans("admin.update_status") }}</a>' +
                            '<a href="javascript:;" id="'+ row.id +'" class="dropdown-item delete" title="{{ trans("admin.delete") }}">' +
                            feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                            '{{ trans("admin.delete") }}</a>' +
                            '</div>' +
                            '</div>' +
                            '<span>@if(auth()->user()->can('update_services'))' +
                            '<a id="'+ row.id +'" name="edit" class="item-edit edit mr-1" data-toggle="modal" data-target="#serviceModal" title="{{ trans("admin.edit") }}">' +
                            feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                            '</a>' +
                            '@endif </span>' +
                            '<span>@if(auth()->user()->can('delete_services'))' +
                            '<a id="'+ row.id +'" class="item-edit delete" title="{{ trans("admin.delete") }}">' +
                            feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                            '</a>' +
                            '@endif </span>'
                        );
                    }
                }
            ],
            "columnDefs": [ 
            {
                // Checkboxes
                "targets": 0,
                orderable: false,
                responsivePriority: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes item_checkbox" name="item[]" type="checkbox" value="'+ row.id +'" id="'+ row.id +'" />' +
                        '<label class="custom-control-label" for="'+ row.id +'">' +
                        '</label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input check_all" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },
            {
                "targets": 4,
                render: function (data, type, row, meta){
                var $select = $(`
                    <select class='status form-control'
                    id='status' onchange=selectStatus(${row.id})>
                    <option value='1'>{{ trans('admin.active') }}</option>
                    <option value='0'>{{ trans('admin.inactive') }}</option>
                    </select>
                `);
                $select.find('option[value="'+ row.enabled +'"]').attr('selected', 'selected');
                return $select[0].outerHTML
                }
            },
            {
                "targets": 5,
                render: function (data, type, row, meta){
                    var text = data ? "{{ trans('admin.active') }}" : "{{ trans('admin.inactive') }}";
                    var color = data ? "success" : "danger"; 
                    var $select = $(`
                        <div class="custom-control custom-control-success custom-switch">
                            <input type="checkbox" data-id="${row.id}" name="enabled" 
                            class="js-switch custom-control-input" ${ row.enabled == 1 ? 'checked' : '' }
                            onchange=selectStatus(${row.id}) >
                            <label class="custom-control-label" for="status" title="{{ trans('admin.update_status') }}"></label>
                            <div class='badge badge-light-${color}'>${text}</div>
                        </div>
                    `);
                    $select.find('option[value="'+ row.enabled +'"]').attr('selected', 'selected');
                    return $select[0].outerHTML
                }
            } ],
            dom:  "<'row'<''l><'col-sm-8 text-center'B><''f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { text: '<i data-feather="refresh-ccw"></i> {{ trans("admin.refresh") }}',
                  className: 'btn dtbtn btn-sm btn-dark',
                  attr: { 'title': '{{ trans("admin.refresh") }}' },
                    action: function (e, dt, node, config) {
                        dt.ajax.reload(null, false);
                    }
                },
                { text: '<i data-feather="trash-2"></i> {{ trans("admin.trash") }}',
                  className: '@if (auth()->user()->can("del_all_services")) btn dtbtn btn-sm btn-danger delBtn multi_delete @else btn dtbtn btn-sm btn-danger delBtn disabled @endif',
                  attr: { 'title': '{{ trans("admin.trash") }}' }
                },
                { extend: 'csvHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i data-feather="file"></i> CSV',
                  attr: { 'title': 'CSV' }
                },
                { extend: 'excelHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i data-feather="file"></i> Excel',
                  attr: { 'title': 'Excel' }
                },
                { text: '<i data-feather="printer"></i> {{ trans("admin.print") }}',
                  className: '@if (auth()->user()->can("print_services")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  extend: 'print', attr: { 'title': '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true, 
                  className: 'btn dtbtn btn-sm btn-danger',
                  text: '<i data-feather="file"></i> PDF',
                  pageSize: 'A4', attr: { 'title': 'PDF' }
                },
                { text: '<i data-feather="plus"></i> {{ trans("admin.create_service") }}',
                  className: '@if (auth()->user()->can("create_services")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                    'title': '{{ trans("admin.create_service") }}',
                    'data-toggle': 'modal',
                    'data-target': '#serviceModal',
                    'name': 'create_service',
                    'id': 'create_service' }
                },
            ],
            language: {
                url: getDataTableLanguage(),
                search: ' ',
                searchPlaceholder: '{{ trans("admin.search") }}...'
            }
        });

        // Open Modal
        $(document).on('click', '#create_service', function(){
            $('.modal-title').text("{{ trans('admin.create_service') }}");
            $('#action_button').val("Add");
            $('#serviceForm').trigger("reset");
            $('#form_result').html('');
            $('#action').val("Add");
        });

        // Add Data
        $('#serviceForm').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.services.store') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data)
                    {
                        var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<div class="alert-body">' + data.errors[count] + '</div>';
                    }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        $('#serviceForm')[0].reset();
                        $('#data-table').DataTable().ajax.reload();
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.added_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.added_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                        $('#form_result').html(html);
                    }
                });
            }
            if($('#action').val() == "Edit")
            {
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.services.update') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data)
                    {
                        var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<div class="alert-body">' + data.errors[count] + '</div>';
                    }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        $('#serviceForm')[0].reset();
                        $('#data-table').DataTable().ajax.reload();
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.updated_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.updated_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                        $('#form_result').html(html);
                    }
                });
            }
        });

        // Edit Data
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"/admin/services/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#name_ar').val(html.data.name.ar);
                    $('#name_en').val(html.data.name.en);
                    $('#price').val(html.data.price);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("{{ trans('admin.edit_service') }}");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                }
            });
        });
    });
</script>

@endpush
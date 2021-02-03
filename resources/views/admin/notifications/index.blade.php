@extends('layouts.admin')
@section('title') {{ trans('admin.patients') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title"><b>{{ trans('admin.patients') }}</b></h4>
                        <div class="text-right">
                            <div class="btn-group btn-group-sm dropup dropdown-icon-wrapper mr-2">
                                <button type="button"
                                    class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="share"></i>
                                    Export
                                    <i data-feather='arrow-down'></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <span class="dropdown-item">
                                        <i data-feather="wifi-off"></i> 1 wifi-off
                                    </span>
                                    <span class="dropdown-item">
                                        <i data-feather="volume-2"></i> 2 wifi-off
                                    </span>
                                    <span class="dropdown-item">
                                        <i data-feather="volume-x"></i> 3 wifi-off
                                    </span>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-item">
                                        <i data-feather="volume-2"></i> 4
                                    </span>
                                </div>
                            </div>
                            <button type="button" name="create_patient" id="create_patient"
                                class="btn btn-sm btn-primary" data-toggle="modal" data-target="#patientModal">
                                <i class="mr-25" data-feather="plus"></i>
                                {{ trans('admin.create_patient') }}</button>
                        </div>
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
                                    <th>{{ trans('admin.change_status') }}</th>
                                    <th>{{ trans('admin.created_at') }}</th>
                                    <th>
                                        @if(auth()->user()->can(['update_patients', 'delete_patients']))
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
        @include('admin.patients.modal')
    </section>
</div>

@endsection

@push('scripts')

@include('partials.delete')
{{-- @include('partials.multi_delete') --}}

<script type="text/javascript">
    var status = '';
    var getLocation = "patients";
    $(document).ready(function(){
        // DataTable
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [[ 2, "desc" ]],
            ajax: {
                url: "{{ route('admin.patients.index') }}",
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
                { data: 'enabled' },
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
                            '<a id="'+ row.id +'" name="edit" class="item-edit edit" data-toggle="modal" data-target="#patientModal" title="{{ trans("admin.edit") }}">' +
                            feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                            '</a>'
                        );
                    }
                }
            ],
            "columnDefs": [ {
                "targets": 5,
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
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [{
                    extend: 'collection',
                    className: 'btn btn-sm btn-outline-secondary dropdown-toggle mr-2',
                    text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                    buttons: [{
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        }
                    ],
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function() {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                },
                {
                    text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + '{{ trans("admin.create_patient") }}',
                    className: 'create-new btn btn-sm btn-primary',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-slide-in'
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],
            // dom: '<" justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<" justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            // buttons: [
            //     { text: '<i data-feather="refresh-ccw"></i> {{ trans("admin.refresh") }}',
            //       className: 'btn dtbtn btn-sm btn-dark',
            //       attr: { title: '{{ trans("admin.refresh") }}' },
            //         action: function (e, dt, node, config) {
            //             dt.ajax.reload(null, false);
            //         }
            //     },
            //     { text: '<i data-feather="trash-2"></i> {{ trans("admin.trash") }}',
            //     className: 'btn dtbtn btn-sm btn-danger multi_delete delBtn',
            //       attr: { title: '{{ trans("admin.trash") }}' }
            //     },
            //     { extend: 'csvHtml5', charset: "UTF-8", bom: true,
            //       className: 'btn dtbtn btn-sm btn-success',
            //       text: '<i data-feather="file"></i> CSV',
            //       attr: { title: 'CSV' }
            //     },
            //     { extend: 'excelHtml5', charset: "UTF-8", bom: true,
            //       className: 'btn dtbtn btn-sm btn-success',
            //       text: '<i data-feather="file"></i> Excel',
            //       attr: { title: 'Excel' }
            //     },
            //     { extend: 'print', className: 'btn dtbtn btn-sm btn-primary',
            //       text: '<i data-feather="printer"></i> {{ trans("admin.print") }}',
            //       attr: { title: '{{ trans("admin.print") }}' }
            //     },
            //     { extend: 'pdfHtml5', charset: "UTF-8", bom: true, 
            //       className: 'btn dtbtn btn-sm bg-gradient-danger',
            //       text: '<i data-feather="file"></i> PDF',
            //       pageSize: 'A4', attr: { title: 'PDF' }
            //     },
            //     { text: '<i data-feather="plus"></i> {{ trans("admin.create_patient") }}',
            //       className: '@if (auth()->user()->can("create_patients")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
            //       attr: {
            //               title: '{{ trans("admin.create_patient") }}',
            //               href: '{{ route("admin.patients.create") }}' 
            //             },
            //         action: function (e, dt, node, config)
            //         {
            //             // href location
            //             window.location.href = '{{ route("admin.patients.create") }}';
            //         }
            //     },
            // ],
            language: {
                url: getDataTableLanguage(),
                search: ' ',
                searchPlaceholder: '{{ trans("admin.search") }}...'
            }
        });

        // Open Modal
        $('#create_patient').click(function(){
            $('.modal-title').text("{{ trans('admin.create_patient') }}");
            $('#action_button').val("Add");
            $('#patientForm').trigger("reset");
            $('#form_result').html('');
            $('#action').val("Add");
        });

        // Add
        $('#patientForm').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.patients.store') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data){
                        console.log(data.responseJSON.errors);
                    },
                    error: function(data){
                        var text = data.responseJSON.errors;
                        console.log(data.responseJSON.errors);
                        $('#form_result').html(text);
                    }
                });
            }
            if($('#action').val() == "Edit")
            {
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.patients.update') }}",
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
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        $('#patientForm')[0].reset();
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

        // Edit
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"/admin/patients/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#name_ar').val(html.data.name.ar);
                    $('#name_en').val(html.data.name.en);
                    $('#price').val(html.data.price);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("{{ trans('admin.edit_patient') }}");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                }
            });
        });
    });

    // Change Status
    function selectStatus(id){
        patient_id = id;
    }

    $(document).on('change', '#status', function(e) {
        var status_patient = $(this).find("option:selected").val();
        console.log(status_patient)
        if(status_patient == "1"){
            toastr.success('{{ trans('admin.status_changed') }}!');
        }else if(status_patient == "0"){
            toastr.success('{{ trans('admin.status_changed') }}!');
        } else {
            toastr.error('{{ trans('admin.status_not_changed') }}!');
        }
        $.ajax({
            url: "patients/updateStatus/"+patient_id+"?enabled="+status_patient,
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

@endpush
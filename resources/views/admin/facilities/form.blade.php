<!-- Facility Modal -->

<div class="modal fade" id="facilityModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body-->
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="POST" id="facilityForm" class="form-horizontal" accept-charset="UTF-8"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @foreach (config('translatable.locales') as $locale)
                        <div class="form-group col-md-6">
                            <label>{{ trans('admin.' . $locale . '.name') }}</label>
                            <input type="text" id="{{ $locale }}[name]" name="{{ $locale }}[name]" class="form-control"
                                value="{{ old($locale . '.name') }}"
                                placeholder="{{ trans('admin.' . $locale . '.name') }}">
                        </div>
                        @endforeach
                        <div class="form-group col-md-6">
                            <label for="enabled">{{ trans('admin.status') }}</label>
                            <select id="enabled" name="enabled" class="form-control">
                                <option value="1">فعال</option>
                                <option value="0">معطل</option>
                            </select>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6 col-12">
                            <div class="media mb-2">
                                <div class="media-body">
                                    <label>{{ trans('admin.icon') }}</label>
                                    <div>
                                        <input type="file" class="form-control-file icon" name="icon" id="icon"
                                            style="display:none;">
                                        <button class="btn btn-primary" onclick="IconUpload();">
                                            <i class="fa fa-plus"></i>
                                            {{ trans('admin.file_upload') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="media mb-2">
                                <img class="icon-preview" height="70" style="display: none;" />
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Modal footer-->
            <div class="modal-footer">
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <button type="submit" class="btn btn-success" id="action_button" name="action_button" value="Add">
                    {{ trans('admin.save') }}
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {{ trans('admin.close') }}
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Status Modal -->

<div class="modal fade" id="statusModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body-->
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="POST" id="statusForm" class="form-horizontal" accept-charset="UTF-8"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="enabled">{{ trans('admin.status') }}</label>
                            <select id="enabled" name="enabled" class="form-control">
                                <option value="1">فعال</option>
                                <option value="0">معطل</option>
                            </select>
                        </div>
                    </div>
            </div>
            <!-- Modal footer-->
            <div class="modal-footer">
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <button type="submit" class="btn btn-success" id="action_button" name="action_button" value="Add">
                    {{ trans('admin.save') }}
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {{ trans('admin.close') }}
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
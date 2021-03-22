<!-- Patient Modal -->
<div class="modal modal-slide-in fade" id="patientModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-lg">
        <form method="POST" class="add-new-record modal-content pt-0" id="patientForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="full_name">{{ trans('admin.ar.full_name') }}:</label>
                        <input id="full_name_ar" type="text" name="full_name[ar]" class="form-control"
                            value="{{ old('full_name.ar') }}" placeholder="{{ trans('admin.ar.full_name') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="full_name">{{ trans('admin.en.full_name') }}:</label>
                        <input id="full_name_en" type="text" name="full_name[en]" class="form-control"
                            value="{{ old('full_name.en') }}" placeholder="{{ trans('admin.en.full_name') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="address">{{ trans('admin.address') }}:</label>
                        <input id="address" type="text" name="address" class="form-control" value="{{ old('address') }}"
                            placeholder="{{ trans('admin.address') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="phone">{{ trans('admin.phone') }}:</label>
                        <input id="phone" type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="{{ trans('admin.phone') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="address">{{ trans('admin.address') }}:</label>
                        <input id="address" type="text" name="address" class="form-control" value="{{ old('address') }}"
                            placeholder="{{ trans('admin.address') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="phone">{{ trans('admin.phone') }}:</label>
                        <input id="phone" type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="{{ trans('admin.phone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="address">{{ trans('admin.address') }}:</label>
                    <input id="address" type="text" name="address" class="form-control" value="{{ old('address') }}"
                        placeholder="{{ trans('admin.address') }}">
                </div>
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <button type="submit" class="btn btn-primary data-submit mr-1" id="action_button" name="action_button"
                    value="Add">
                    {{ trans('admin.save') }}
                </button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    {{ trans('admin.cancel') }}
                </button>
            </div>
        </form>
    </div>
</div>
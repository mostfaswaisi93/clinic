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
                        <label class="form-label" for="first_name">{{ trans('admin.ar.first_name') }}:</label>
                        <input id="first_name_ar" type="text" name="first_name[ar]" class="form-control"
                            value="{{ old('first_name.ar') }}" placeholder="{{ trans('admin.ar.first_name') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="last_name">{{ trans('admin.ar.last_name') }}:</label>
                        <input id="last_name_ar" type="text" name="last_name[ar]" class="form-control"
                            value="{{ old('last_name.ar') }}" placeholder="{{ trans('admin.ar.last_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_name">{{ trans('admin.en.first_name') }}:</label>
                    <input id="first_name_en" type="text" name="first_name[en]" class="form-control"
                        value="{{ old('first_name.en') }}" placeholder="{{ trans('admin.en.first_name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ trans('admin.en.last_name') }}:</label>
                    <input id="last_name_en" type="text" name="last_name[en]" class="form-control"
                        value="{{ old('last_name.en') }}" placeholder="{{ trans('admin.en.last_name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="price">{{ trans('admin.price') }}:</label>
                    <input id="price" type="text" name="price" class="form-control" value="{{ old('price') }}"
                        placeholder="{{ trans('admin.price') }}">
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
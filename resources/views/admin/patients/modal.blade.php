<!-- Patient Modal -->
<div class="modal modal-slide-in fade" id="patientModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-sm">
        <form method="POST" class="add-new-record modal-content pt-0" id="patientForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="alert alert-success d-none" id="msg_div">
                    <span id="res_message"></span>
                </div>
                {{-- @include('partials.errors') --}}
                <span id="form_result"></span>
                <div class="form-group">
                    <label class="form-label" for="name">{{ trans('admin.ar.name') }}</label>
                    <input id="name_ar" type="text" name="name[ar]" class="form-control" value="{{ old('name.ar') }}"
                        placeholder="{{ trans('admin.ar.name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="name">{{ trans('admin.en.name') }}</label>
                    <input id="name_en" type="text" name="name[en]" class="form-control" value="{{ old('name.en') }}"
                        placeholder="{{ trans('admin.en.name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="price">{{ trans('admin.price') }}</label>
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
<!-- Modal to add new record -->
<div class="modal modal-slide-in fade" id="modals-slide-in">
    <div class="modal-dialog sidebar-sm">
        <form class="add-new-record modal-content pt-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
            </div>
            <div class="modal-body flex-grow-1">
                @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label class="form-label" for="name">{{ trans('admin.' . $locale . '.name') }}</label>
                    <input id="name[{{ $locale }}]" type="text" name="name[{{ $locale }}]" class="form-control dt-name"
                        value="{{ old('name.' . $locale) }}" placeholder="{{ trans('admin.' . $locale . '.name') }}"
                        aria-label="John Doe">
                </div>
                @endforeach
                <div class="form-group">
                    <label class="form-label" for="price">{{ trans('admin.price') }}</label>
                    <input id="price" type="text" name="price" class="form-control dt-price" value="{{ old('price') }}"
                        placeholder="{{ trans('admin.price') }}" aria-label="Web Developer">
                </div>
                <button type="button" class="btn btn-primary data-submit mr-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
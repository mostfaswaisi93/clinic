<!-- Service Modal -->
<div class="modal modal-slide-in fade" id="serviceModal">
    <div class="modal-dialog sidebar-sm">
        <form class="add-new-record modal-content pt-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                {{-- @include('partials.errors') --}}
                <span id="form_result"></span>
                <form method="POST" id="serviceForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label class="form-label" for="name">{{ trans('admin.' . $locale . '.name') }}</label>
                        <input id="name[{{ $locale }}]" type="text" name="name[{{ $locale }}]"
                            class="form-control dt-name" value="{{ old('name.' . $locale) }}"
                            placeholder="{{ trans('admin.' . $locale . '.name') }}">
                    </div>
                    @endforeach
                    <div class="form-group">
                        <label class="form-label" for="price">{{ trans('admin.price') }}</label>
                        <input id="price" type="text" name="price" class="form-control dt-price"
                            value="{{ old('price') }}" placeholder="{{ trans('admin.price') }}">
                    </div>
                    <input type="hidden" name="action" id="action" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <button type="submit" class="btn btn-primary data-submit mr-1" id="action_button"
                        name="action_button" value="Add">
                        {{ trans('admin.save') }}
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        {{ trans('admin.cancel') }}
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>
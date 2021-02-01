<!-- Service Modal -->
<div class="modal fade" id="serviceModal" role="dialog" aria-hidden="true">
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
                @include('partials.errors')
                <span id="form_result"></span>
                <form method="POST" id="serviceForm" class="form-horizontal" accept-charset="UTF-8"
                    enctype="multipart/form-data">
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
@extends('layouts.admin')
@section('title') {{ trans('admin.create_role') }} @endsection

@section('content')

<div class="content-body">
    <section class="portlet">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="mr-25" data-feather='plus-circle'></i>
                            {{ trans('admin.create_role') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.roles.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 col-12 mt-1">
                                        <div class="form-group">
                                            <label for="name">{{ trans('admin.name') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" placeholder="{{ trans('admin.name') }}" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">{{ trans('admin.add') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
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
                            <i class="feather icon-plus mr-25"></i>
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
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.name') }}</label>
                                                <input id="name" type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}" placeholder="{{ trans('admin.name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ trans('admin.add') }}
                                                </button>
                                            </div>
                                        </div>
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
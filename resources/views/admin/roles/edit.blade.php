@extends('layouts.admin')
@section('title') {{ trans('admin.edit_role') }} @endsection

@section('content')

<div class="content-body">
    <section class="portlet">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="mr-25" data-feather='edit'></i>
                            {{ trans('admin.edit_role') }} - {{ $role->name }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 col-12 mt-1">
                                        <div class="form-group">
                                            <label for="name">{{ trans('admin.name') }}</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $role->name }}" placeholder="{{ trans('admin.name') }}" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">{{ trans('admin.edit') }}</button>
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
@extends('layouts.admin')
@section('title') {{ trans('admin.create_weight') }} @endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ trans('admin.create_weight') }}</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">{{ trans('admin.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.weights.index') }}">{{ trans('admin.weights') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('admin.create_weight') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <section class="portlet">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="feather icon-plus-circle mr-25"></i>
                            {{ trans('admin.create_weight') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.weights.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    @foreach (config('translatable.locales') as $locale)
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.' . $locale . '.name') }}</label>
                                                <input id="name" type="text" name="name[{{ $locale }}]"
                                                    class="form-control" value="{{ old('name.' . $locale) }}"
                                                    placeholder="{{ trans('admin.' . $locale . '.name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
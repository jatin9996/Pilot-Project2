@extends('admin.layouts.app')

@section('title', __('labels.addUser'))

@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i
                            class="icon-home2 mr-2"></i> {{ __('menu.home') }}</a>
                    <a href="{{ route('admin.users.index') }}"
                       class="breadcrumb-item"> {{ __('menu.users') }}</a>
                    <span class="breadcrumb-item active">{{ __('menu.create') }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content">
        <!-- Profile info -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ __('labels.addUser') }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="post" id="user-form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('labels.firstName') }}</label>
                                <input type="text" value="{{ old('first_name') }}" class="form-control"
                                       name="first_name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('labels.lastName') }}</label>
                                <input type="text" value="{{ old('last_name') }}" class="form-control"
                                       name="last_name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('labels.email') }}</label>
                                <input type="text" value="{{ old('email') }}" class="form-control"
                                       name="email">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('labels.password') }}</label>
                                <input type="password" class="form-control"
                                       name="password">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-light">{{ __('buttons.cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('buttons.addUser') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /profile info -->
    </div>
@endsection
@push('scripts')

@endpush

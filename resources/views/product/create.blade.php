@extends('admin.layouts.app')

@section('title', __('labels.addProduct'))

@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i
                            class="icon-home2 mr-2"></i> {{ __('menu.home') }}</a>
                    <a href="{{ route('admin.products.index') }}"
                       class="breadcrumb-item"> {{ __('menu.products') }}</a>
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
                <h5 class="card-title">{{ __('labels.addProduct') }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="post" id="product-form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('labels.name') }}</label>
                                <input type="text" value="{{ old('name') }}" class="form-control"
                                       name="name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>{{ __('labels.productDescription') }}</label>
                                <textarea name="description" id="description" rows="4"
                                          cols="4">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>{{ __('labels.productImage') }}</label>
                                <input type="file" name="product_image">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-light">{{ __('buttons.cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('buttons.addProduct') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /profile info -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            CKEDITOR.editorConfig = function (config) {
                config.language = 'es';
                config.uiColor = '#F7B42C';
                config.height = 200;
                config.toolbarCanCollapse = true;
            };
            CKEDITOR.replace('description', {
                height: 400
            });
        });
    </script>
@endpush

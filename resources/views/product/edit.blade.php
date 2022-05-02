@extends('admin.layouts.app')

@section('title', __('labels.editProduct'))

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
                    <span class="breadcrumb-item active">{{ __('menu.edit') }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content">
        <!-- Profile info -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ __('labels.editProduct') }}</h5>
            </div>

            <div class="card-body">
                @if(isset($user_product))
                    <form action="{{ route('admin.user-products.update',['user_product' => $product['id']]) }}"
                          method="post"
                          id="product-form"
                          enctype="multipart/form-data">
                        @else
                            <form action="{{ route('admin.products.update',['product' => $product['id']]) }}"
                                  method="post"
                                  id="product-form"
                                  enctype="multipart/form-data">
                                @endif

                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{ __('labels.name') }}</label>
                                            <input type="text" value="{{ old('name', $product['name']) }}"
                                                   class="form-control"
                                                   name="name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{ __('labels.productDescription') }}</label>
                                            <textarea name="description" id="description" rows="4"
                                                      cols="4">{{ old('description',$product['name']) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>{{ __('labels.productImage') }}</label>
                                            <input type="file" name="product_image">
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ $product->productImage }}" height="100" width="100">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    @if(isset($user_product))
                                        <a href="{{ route('admin.users.show', ['user' => $product['user_id']]) }}"
                                           class="btn btn-light">{{ __('buttons.cancel') }}</a>
                                    @else
                                        <a href="{{ route('admin.products.index') }}"
                                           class="btn btn-light">{{ __('buttons.cancel') }}</a>
                                    @endif
                                    <button type="submit"
                                            class="btn btn-primary">{{ __('buttons.updateProduct') }}</button>
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

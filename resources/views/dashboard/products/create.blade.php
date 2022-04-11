@extends('layouts.dashboard.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('site.products')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.dashboard')</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard.products.index') }}">@lang('site.products')</a>
                    </li>
                    <li class="breadcrumb-item active">@lang('site.create')</li>
                    {{-- <li class="breadcrumb-item active">Dashboard v1</li> --}}
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title text-end">@lang('site.create') @lang('site.products')</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @include('partials._errors')
            <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('post') }}
                <div class="card-body">
                    <div class="form-group">
                        <label>@lang('site.categories')</label>
                        <select name="category_id" class="form-control">
                            <option value="">@lang('site.all_categories')</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.name')</label>
                        <input type="text" name="{{ $locale }}[name]" class="form-control"
                            value="{{ old($locale . '.name') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" class="form-control ckeditor">{{ old($locale . '.description') }}</textarea>
                    </div>
                    @endforeach

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>

                    <div class="form-group">
                        <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.purchase_price')</label>
                        <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ old('purchase_price') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.sale_price')</label>
                        <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
@endsection

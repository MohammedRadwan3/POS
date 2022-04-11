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
                    <li class="breadcrumb-item active">@lang('site.edit')</li>
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
                <h3 class="card-title text-end">@lang('site.edit') @lang('site.products')</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @include('partials._errors')
            <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                {{ method_field('put') }}
                <div class="card-body">
                    <div class="form-group">
                        <label>@lang('site.categories')</label>
                        <select name="category_id" class="form-control">
                            <option value="">@lang('site.all_categories')</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' :
                                '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.name')</label>
                        <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $product->translate($locale)->name }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]"
                            class="form-control ckeditor">{{ $product->translate($locale)->description }}</textarea>
                    </div>

                    @endforeach

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>

                    <div class="form-group">
                        <img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                            alt="">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.purchase_price')</label>
                        <input type="number" name="purchase_price" step="0.01" class="form-control"
                            value="{{ $product->purchase_price }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.sale_price')</label>
                        <input type="number" name="sale_price" step="0.01" class="form-control"
                            value="{{ $product->sale_price }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="number" name="stock" class="form-control" value="{{ $product->stock}}">
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
@endsection

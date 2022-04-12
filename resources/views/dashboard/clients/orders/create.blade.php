@extends('layouts.dashboard.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('site.add_order')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.dashboard')</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a>
                    </li>
                    <li class="breadcrumb-item active">@lang('site.add_order')</li>
                    {{-- <li class="breadcrumb-item active">Dashboard v1</li> --}}
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-end">@lang('site.categories')</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">

                        @foreach ($categories as $category)

                        <div id="accordion">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" style="text-decoration: none;" data-toggle="collapse"
                                            href="#{{ str_replace(' ', '-', $category->name) }}">
                                            {{ $category->name }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{ str_replace(' ', '-', $category->name) }}" class="collapse"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        @if ($category->products->count() > 0)
                                        <table class="table table-hover">
                                            <tr>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.stock')</th>
                                                <th>@lang('site.price')</th>
                                                <th>@lang('site.add')</th>
                                            </tr>

                                            @foreach ($category->products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ number_format($product->sale_price, 2) }}</td>
                                                <td>
                                                    <a href="" id="product-{{ $product->id }}"
                                                        data-name="{{ $product->name }}" data-id="{{ $product->id }}"
                                                        data-price="{{ $product->sale_price }}"
                                                        class="btn btn-success btn-sm add-product-btn">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </table><!-- end of table -->

                                        @else
                                        <h5>@lang('site.no_records')</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="col-lg-6">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-end">@lang('site.create') @lang('site.clients')</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <form action="{{ route('dashboard.clients.orders.store', $client->id) }}"
                            method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            @include('partials._errors')

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                </thead>

                                <tbody class="order-list">


                                </tbody>

                            </table><!-- end of table -->

                            <h4>@lang('site.total') : <span class="total-price">0</span></h4>

                            <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i
                                    class="fa fa-plus"></i> @lang('site.add_order')</button>

                        </form>
                    </div>

                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
</section>
@endsection

@extends('layouts.dashboard.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('site.orders')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.dashboard')</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('dashboard.orders.index') }}">@lang('site.orders')</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-8">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">@lang('site.orders') <small class="bg-dark px-2">{{ $orders->total()
                                }}</small>
                        </h3>

                        <form action="{{ route('dashboard.orders.index') }}" method="get">

                            <div class="row">

                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="@lang('site.search')" value="{{ request()->search }}">
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        @lang('site.search')</button>
                                    @if (auth()->user()->hasPermission('orders_create'))
                                    <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('site.add')</a>
                                    @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                        @lang('site.add')</a>
                                    @endif
                                </div>

                            </div>
                        </form><!-- end of form -->

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($orders->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('site.client_name')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.created_at')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index=>$order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->client->name }}</td>
                                    <td>{{ number_format($order->total_price, 2) }}</td>
                                    <td>{{-- {{ $order->created_at->toFormattedDateString() }} / --}} {{
                                        $order->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm order-products"
                                            data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                            data-method="get">
                                            <i class="fa fa-list"></i>
                                            @lang('site.show')
                                        </button>
                                        @if (auth()->user()->hasPermission('orders_update'))
                                        <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                            @lang('site.edit')</a>
                                        @else
                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                            @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('orders_delete'))
                                        <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post"
                                            style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete btn-sm"
                                                onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>
                                                @lang('site.delete')</button>
                                        </form>
                                        @else
                                        <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                            @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->appends(request()->query())->links() }}
                        @else
                        <h2>@lang('site.no_data_found')</h2>
                        @endif
                    </div>
                </div>
                <!-- /.card -->
                <!-- Main row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="col-lg-4">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-end">@lang('site.show_products')</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                            <div class="loader"></div>
                            <p style="margin-top: 10px">@lang('site.loading')</p>
                        </div>

                        <div id="order-product-list">

                        </div><!-- end of order product list -->
                    </div>

                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </div>
</section>
@endsection

@extends('layouts.dashboard.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('site.clients')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.dashboard')</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">@lang('site.clients') <small class="bg-dark px-2">{{ $clients->total() }}</small>
                </h3>

                <form action="{{ route('dashboard.clients.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('clients_create'))
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
                @if ($clients->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.add_order')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $index=>$client)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td>
                            {{-- <td>{{ implode(array_filter($client->phone), '-') }}</td> --}}
                            <td>{{ $client->address }}</td>
                            <td>
                                @if (auth()->user()->hasPermission('orders_create'))
                                    <a href="{{ route('dashboard.clients.orders.create', $client->id) }}" class="btn btn-primary btn-sm">@lang('site.add_order')</a>
                                @else
                                    <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add_order')</a>
                                @endif
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('clients_update'))
                                <a href="{{ route('dashboard.clients.edit', $client->id) }}"
                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('clients_delete'))
                                <form action="{{ route('dashboard.clients.destroy', $client->id) }}" method="post"
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
                {{ $clients->appends(request()->query())->links() }}
                @else
                <h2>@lang('site.no_data_found')</h2>
                @endif
            </div>
        </div>
        <!-- /.card -->
        <!-- Main row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

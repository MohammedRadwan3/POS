@extends('layouts.dashboard.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('site.users')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">@lang('site.dashboard')</a></li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('dashboard.users.index') }}">@lang('site.users')</a></li>
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
                <h3 class="card-title">@lang('site.users')</h3>

                <form action="{{ route('dashboard.users.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                            {{-- @if (auth()->user()->hasPermission('create_users')) --}}
                                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            {{-- @else --}}
                                {{-- <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a> --}}
                            {{-- @endif --}}
                        </div>

                    </div>
                </form><!-- end of form -->

            </div>
            <!-- /.card-header -->
            @if ($users->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>@lang('site.first_name')</th>
                        <th>@lang('site.last_name')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index=>$user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline-block">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h2>@lang('site.no_data_found')</h2>
            @endif
        </div>
        <!-- /.card -->
        <!-- Main row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

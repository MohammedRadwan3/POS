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
                    <li class="breadcrumb-item"><a
                            href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a>
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
                <h3 class="card-title text-end">@lang('site.create') @lang('site.clients')</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @include('partials._errors')
            <form action="{{ route('dashboard.clients.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ method_field('post') }}
                <div class="card-body">

                    <div class="form-group">
                        <label>@lang('site.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                   @for ($i = 0; $i < 2; $i++)
                        <div class="form-group">
                            <label>@lang('site.phone')</label>
                            <input type="text" name="phone[]" class="form-control">
                        </div>
                   @endfor

                    <div class="form-group">
                        <label>@lang('site.address')</label>
                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
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

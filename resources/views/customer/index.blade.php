@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.index.title')
@endsection

@section('page_title')
    <span class="fa fa-smile-o fa-fw"></span>&nbsp;@lang('customer.index.page_title')
@endsection

@section('page_title_desc')
    @lang('customer.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_customer') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('customer.index.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <input id="inputSearch" type="text" class="form-control" placeholder="Search" value="{{ Request::query('s') }}">
                </div>
                <div class="col-md-8">
                    <button id="btnSearch" class="btn btn-default"><span class="fa fa-search-plus fa-fw"></span></button>
                </div>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('customer.index.table.header.name')</th>
                        <th class="text-center">@lang('customer.index.table.header.address')</th>
                        <th class="text-center">@lang('customer.index.table.header.tax_id')</th>
                        <th class="text-center">@lang('customer.index.table.header.status')</th>
                        <th class="text-center">@lang('customer.index.table.header.remarks')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $key => $cust)
                        <tr>
                            <td width="15%" class="text-center">{{ $cust->name }}</td>
                            <td width="20%" class="text-center">{{ $cust->address }}</td>
                            <td width="15%" class="text-center">{{ $cust->tax_id }}</td>
                            <td witdh="10%" class="text-center">@lang('lookup.'.$cust->status)</td>
                            <td width="30%" class="text-center">{{ $cust->remarks }}</td>
                            <td width="10%" class="text-center">
                                <a class="btn btn-xs btn-info" href="{{ route('db.master.customer.show', $cust->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.master.customer.edit', $cust->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.customer.delete', $cust->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.customer.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {{ $customer->render() }}
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#btnSearch').click(function() {
                if ($('#inputSearch').val().length > 0) {
                    window.location.href = '{{ route('db.master.customer') }}' + '?s=' + $('#inputSearch').val();
                }
            });

            $('#inputSearch').focus(function() {
                $(this).select();
            }).keyup(function(e) {
                if (e.keyCode == 13) {
                    $('#btnSearch').click();
                }
            })
        });
    </script>
@endsection
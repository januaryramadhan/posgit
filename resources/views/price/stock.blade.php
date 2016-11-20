@extends('layouts.adminlte.master')

@section('title')
    @lang('price.stock.title')
@endsection

@section('page_title')
    <span class="fa fa-barcode fa-fw"></span>&nbsp;@lang('price.stock.page_title')
@endsection

@section('page_title_desc')
    @lang('price.stock.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div ng-app="stockPriceModule" ng-controller="stockPriceController">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('price.stock.header.title', ['stock_name' => $currentStock->product->name])</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('db.price.stock', $currentStock->hId()) }}"
                      method="post" data-parsley-validate="parsley">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group">
                            <label for="inputDate"
                                   class="col-sm-2 control-label">@lang('price.stock.field.input_date')</label>
                            <div class="col-sm-4">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="inputDate" name="input_date"
                                           data-parsley-required="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="inputMarketPrice"
                                   class="col-sm-2 control-label">@lang('price.stock.field.market_price')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control text-right" name="market_price"
                                       data-parsley-required="true"
                                       data-parsley-pattern="^\d+(,\d+)?$" id="inputMarketPrice" fcsa-number
                                       ng-model="market_price"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('price.stock.field.price')</label>
                        </div>
                    </div>
                    @foreach($priceLevels as $key => $priceLevel)
                        <div class="row">
                            <div class="form-group">
                                <label for="inputPrice_{{ $key }}"
                                       class="col-sm-2 control-label">{{ $priceLevel->name }}</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control text-right" name="price[]"
                                           data-parsley-required="true"
                                           data-parsley-pattern="^\d+(,\d+)?$" id="inputPrice_{{ $key }}"
                                           fcsa-number ng-model="price{{ $key }}"/>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-toolbar">
                                <button id="submitButton" type="submit" name="submit"
                                        class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                                <a id="cancelButton" class="btn btn-primary pull-right"
                                   href="{{ route('db.price.today') }}">@lang('buttons.cancel_button')</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('stockPriceModule', ['fcsa-number']);
        app.controller("stockPriceController", ['$scope', function ($scope) {

        }]);

        $(function () {
            $("#inputDate").daterangepicker({
                useCurrent: false,
                timePicker: true,
                timePickerIncrement: 15,
                locale: {
                    format: 'DD-MM-YYYY hh:mm'
                },
                singleDatePicker: true,
                showDropdowns: true
            });
        });
    </script>
@endsection

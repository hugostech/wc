@extends('wechat::layout.masterConsole')

@section('body')
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Links</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    {!! Form::open(['route'=>config('wechat.prefix').'.console_links_create']) !!}
                    <div class="form-group col-sm-6">
                        <label>Destination Url</label>
                        {!! Form::text('long_url',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Scope Type</label>
                        {!! Form::select('scope',['snsapi_base'=>'snsapi_base','snsapi_userinfo'=>'snsapi_userinfo'],null,['class'=>'form-control','required','placeholder'=>'Select Scope Type']) !!}
                    </div>
                    <div class="form-group col-sm-3">
                        <label>State</label>
                        {!! Form::text('state',null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::submit('Transfer',['class'=>'btn btn-primary']) !!}
                    </div>


                    {!! Form::close() !!}
                </div>

            </div>
            <table class="table"></table>
        </div>
    </div>
@endsection
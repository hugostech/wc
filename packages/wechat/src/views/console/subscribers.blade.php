@extends('wechat::layout.masterConsole')

@section('body')
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Users</h4>
            </div>
            <div class="panel-body">
                    {!! Form::open(['route'=>config('wechat.prefix').'.console_subscribers_sync']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('sync_subscriber','all',false) !!}
                        <label>SYNC ALL SUBSCRIBERS INCLUDE RESETTING EXISITING SUBSCRIBERS INFO (Need More Time)</label>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Import Subscriber', ['class'=>'btn btn-primary btn-sm']) !!}
                    </div>
                    {!! Form::close() !!}


            </div>
            <table class="table"></table>
        </div>
    </div>
@endsection
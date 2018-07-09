@extends('wechat::layout.masterConsole')

@section('body')
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Links</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>config('wechat.prefix').'.console_links_create']) !!}
                {!! Form::text('long_url',null,['class'=>'form-control']) !!}
                {!! Form::submit('Transfer') !!}
                {!! Form::close() !!}
            </div>
            <table class="table"></table>
        </div>
    </div>
@endsection
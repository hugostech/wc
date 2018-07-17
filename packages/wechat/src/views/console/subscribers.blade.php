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
            @if(isset($subs))
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Nickname</th>
                        <th>Remark</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subs as $sub)
                    <tr>
                        <td>
                            <img src="{{$sub->headimgurl}}">
                        </td>
                        <td>{{$sub->nickname}}</td>
                        <td>{{$sub->remark}}</td>
                        <td>{!! Form::select('type',['0'=>'Normal','1'=>'Staff'],$sub->type,['class'=>'form->control']) !!}</td>
                        <td></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif


        </div>
    </div>
@endsection
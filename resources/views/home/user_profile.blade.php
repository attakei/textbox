@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ユーザー情報更新</h2>
    <div class="row">
        {{-- フラッシュメッセージの表示 --}}
        @if (Session::has('flash_message'))
        <div class="alert">{{ Session::get('flash_message') }}</div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/users/_me/profile') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">メールアドレス</label>
                            <div class="col-md-6">
                                {{ Form::email('email', $owner->email, ['class' => 'form-control', 'disabled' => 'disabled',]) }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">名前</label>
                            <div class="col-md-6">
                                {{ Form::text('name', $owner->name, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

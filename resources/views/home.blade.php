@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1 col-lg-8">
        <div class="row">
            <div class="panel panel-success">
                <div class="panel-heading">Messages:</div>
                <div class="panel-body">
                    <div id="messages">
                        @foreach($messages as $message)
                            <p class="new-message">{{ $message }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel  panel-primary">
                <div class="panel-heading">Chat Form:</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'sendmessage', 'method' => 'POST', 'id' => 'formMessage']) !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'required']) !!}
                    {!! Form::submit('Send', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div id="errorMessage"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection

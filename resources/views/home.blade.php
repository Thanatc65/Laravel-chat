@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>All users</h1>
                <div class="card overflow-auto" style="height: 40em">
                    <div class="card-body mt-3">
                        <div class="container">
                            <ul class="list-group list-group-flush text-decoration-none">
                                @foreach ($user as $row)
                                    @if ($row->name != $au)
                                        <li class="list-group-item"><a href="{{ route('chat', $row->id) }}">
                                                {{ $row->name }}
                                            </a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <h1>Chat</h1>
                @if ($rec != '')
                    <div class="card overflow-auto" style="height: 40em">
                        <div class="card-body">
                            @foreach ($chat as $mes)
                                @if ($mes->send == Auth::user()->name and $mes->rec == $rec)
                                    <div class="container">
                                        <div class="row align-items-center d-flex justify-content-between">
                                            <div class="col-6"></div>
                                            <div class="col-6 text-right d-flex flex-row-reverse">
                                                <p></p>
                                                <p></p>
                                                <div class="mt-2">
                                                    <small>{{ $au }}</small>
                                                    <div class="bg-primary text-light text-right pl-3 pr-3 pt-3 pb-1">
                                                        @if (strlen($mes->message) >= 40)
                                                            <p class="text-wrap" style="width: 50vh;">{{ $mes->message }}
                                                            </p>
                                                        @else
                                                            <p class="text-wrap">{{ $mes->message }}</p>
                                                        @endif
                                                    </div>
                                                    <small>{{ $mes->created_at->diffforhumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($mes->send == $rec and $mes->rec == Auth::user()->name)
                                    <div class="container">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-6 col-6 text-left d-flex flex-row">
                                                <p></p>
                                                <p></p>
                                                <div class="mt-2">
                                                    <small>{{ $rec }}
                                                    </small>
                                                    <div class="bg-secondary text-light text-left pl-3 pr-3 pt-3 pb-1">
                                                        @if (strlen($mes->message) >= 40)
                                                            <p class="text-wrap" style="width: 50vh;">{{ $mes->message }}
                                                            </p>
                                                        @else
                                                            <p class="text-wrap">{{ $mes->message }}</p>
                                                        @endif
                                                    </div>
                                                    <small>{{ $mes->created_at->diffforhumans() }}</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <form action="{{ route('sent') }}" method="post">
                        <div class="input-group mb-3">
                            @csrf
                            <input type="hidden" name="send" value="{{ $au }}">
                            <input type="hidden" name="rec" value="{{ $rec }}">
                            <input type="text" name="message" class="form-control" placeholder="Send Message Here">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection


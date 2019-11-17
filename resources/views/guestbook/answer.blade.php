@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="message col-md-12  p-3 mb-2 bg-light">
                            <div class="row col-md-12 text-secondary">{{ $message->user->email }}</div>
                            <div class="row">
                                <div class="message col-md-8">{{ $message->message }}</div>
                                @if (!empty($message->filename))
                                    <div class="message col-md-4">
                                        <img src="{{ $message->getImage() }}" class="mw-100 mh-100" alt="Image {{ $message->id }}">
                                    </div>
                                @endif
                            </div>
                        </div>

                        @include('guestbook._form', ['answer_id' => $message->id])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

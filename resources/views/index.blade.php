@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Guestbook</div>
                <div class="card-body">

                    @include('guestbook._form')

                    <div class="mt-5">
                    @if (count($messages) > 0)
                        @foreach($messages as $message)
                            @include('guestbook._message', ['message' => $message])
                        @endforeach

                        <div class="mt-5">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <p>Messages not found</p>
                    @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

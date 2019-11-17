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
    <div class="row col-md-12 mt-2">
        <a href="{{ route('guestbook-answer', $message->id) }}" class="btn btn-sm btn-primary">Ответить</a>
    </div>

    @foreach($message->answers as $answer)
        <div class="border border-primary mt-3">
        @include('guestbook._message', ['message' => $answer])
        </div>
    @endforeach

</div>

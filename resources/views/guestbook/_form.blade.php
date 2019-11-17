<?php
if (!isset($answer_id)) {
    $answer_id = false;
}
?>
@auth
    <form method="POST" action="{{ !$answer_id ? route('guestbook-send') : route('guestbook-answer', $answer_id) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="message" class="col-md-2 col-form-label text-md-left">{{ __('Message') }}</label>

            <div class="col-md-10">
                <textarea name="message" id="message" rows="3" class="form-control @error('email') is-invalid @enderror">{{ old('message') }}</textarea>

                @error('message')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="image" class="col-md-2 col-form-label text-md-left">{{ __('Image') }}</label>

            <div class="col-md-10">
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">

                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">
                    @if ($answer_id)
                        {{ __('Answer') }}
                    @else
                        {{ __('Send message') }}
                    @endif
                </button>
            </div>
        </div>
    </form>
@endif

@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #F0FFFF">
    <br>
    <div class="row justify-content-center">


                @auth
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Post') }}</div>

                    <div class="card-body">
                    <form method="POST" action="{{route('post.update')}}" aria-label="{{ __('Register') }}" enctype="multipart/form-data" class="p-3 mb-2 bg-dark text-white">
                            @csrf
                            <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file" accept="image/png, image/jpeg, video/mp4" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">

                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                    <input type="hidden" name="id" value="{{ $publication->id_post }}">
                            <div class="form-group row">
                                <label for="game" class="col-md-4 col-form-label text-md-right">{{ __('Game') }}</label>

                                <div class="col-md-6">
                                    <input id="game" type="text" class="form-control{{ $errors->has('game') ? ' is-invalid' : '' }}" name="game" value="{{ $publication->game }}{{ old('game') }}" required autofocus>

                                    @if ($errors->has('game'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('game') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="publicationText" class="col-md-4 col-form-label text-md-right">{{ __('Text') }}</label>

                                <div class="col-md-6">
                                    <textarea cols="30" rows="5" id="publicationText" type="text" class="form-control{{ $errors->has('publicationText') ? ' is-invalid' : '' }}" name="publicationText" value="{{ old('publicationText') }}" required autofocus>{{ $publication->publicationText }}</textarea>


                                    @if ($errors->has('publicationText'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('publicationText') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <div class="text-center">

                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       @endauth

        </div>


</div>
@endsection

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
                    <form method="POST" action="{{route('post.save')}}" aria-label="{{ __('Register') }}" enctype="multipart/form-data" class="p-3 mb-2 bg-dark text-white">
                            @csrf
                            <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file" accept="image/png, image/jpeg, video/mp4" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" required autofocus>

                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="game" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="game" type="text" class="form-control{{ $errors->has('game') ? ' is-invalid' : '' }}" name="game" value="{{ old('game') }}" required autofocus>

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
                                    <textarea cols="30" rows="5" id="publicationText" type="text" class="form-control{{ $errors->has('publicationText') ? ' is-invalid' : '' }}" name="publicationText" value="{{ old('publicationText') }}" required autofocus></textarea>


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
                                        {{ __('Post') }}
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
        @foreach ($landingPosts as $landingPost)
        <?php $likeado = false ?>

        <br>
            <div class="card" style="width: 69.5rem;">
                <div class="card-body">
                @auth
                @if ($landingPost->id_user != \Auth::user()->id)

                <?php $following = false ?>
                    @if($myFollows)
                        @foreach ($myFollows as $myFollow)
                        <?php  if($landingPost->id_user == $myFollow->id_user)
                        $following = true; ?>
                        @endforeach

                        @endif
                        @if (!$following)
                        <a style="margin-left: 1px" class="btn btn-outline-primary" href="{{route('follow.create', $landingPost->Users->id)}}" role="button">Follow</a>
                        @else
                        <a style="margin-left: 1px" class="btn btn-outline-primary" href="{{route('follow.delete', $landingPost->Users->id)}}" role="button">UnFollow</a>

                        @endif
                    @endif

                @endauth
                <div class="p-3 mb-2 bg-dark text-white" >
                <div class="text-center" >

                    <h5 class="card-title">{{ $landingPost->game }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Autor {{$landingPost->Users->nick}}</h6>
                    @if($landingPost->tipoArchivo == 'image/jpeg' || $landingPost->tipoArchivo == 'image/png')
                <img class="img-fluid img-thumbnail" style="width: 200px;height: 200px;" src="{{url('/post/arch/'.$landingPost->archivo)}}" alt="">

                    @else
                    <video width="320" height="240" controls>
                            <source src="{{ route('getVideo', $landingPost->archivo)  }}" type="video/mp4">
                            Your browser does not support the video tag.
                    </video>

                    @endif
                <p class="card-text">{{ $landingPost->publicationText }}</p>
                <br>
@auth

                @foreach ($landingPost->likes as $likes)
                    <?php  if($likes->id_user == \Auth::user()->id)
                                $likeado = true; ?>
                @endforeach

                @if (!$likeado)
                <a style="margin-left: 1.5em" class="btn btn-outline-primary" href="{{ url('/like/'.$landingPost->id_post)}}" role="button">Like {{$landingPost->likes->count()}}</a>
                @else
                <a style="margin-left: 1.5em" class="btn btn-primary" href="{{ url('/dislike/'.$landingPost->id_post)}}" role="button">Liked {{$landingPost->likes->count()}}</a>

                @endif
                @if ($landingPost->id_user == \Auth::user()->id)

                <a style="margin-left: 1.5em" class="btn btn-outline-primary" href="{{ route('post.page', $landingPost->id_post) }}" role="button">Update</a>
                @endif
                </div>
                </div>


                @else
                                <a style="margin-left: 1.5em" class="btn btn-primary" href="" role="button">Likes {{$landingPost->likes->count()}}</a>

                @endauth

            <br><br>
            @auth
                <form action="{{route('comment.save')}}" method="post" class="container">
                            {{ csrf_field() }}
                        <div class="form-inline">
                            <input type="hidden" name="id_post" value="{{$landingPost->id_post}}">
                            <input id="comment" type="text" class="form-control col-md-8{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" placeholder="Comentar..." value="{{ old('comment') }}" required autofocus>

                            @if ($errors->has('game'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('game') }}</strong>
                                </span>
                            @endif
                                <input type="submit" value="Comment" class="btn btn-primary" style="">
                            </div>
                </form>
            @endauth

                        <br>
                        @foreach ($landingPost->comments as $comment)
                        <div class="container">
                                <div class="card" style="width: 60rem;">
                                <div class="p-3 mb-2 bg-dark text-white">

                                    <div class="card-body">
                                      <h6 class="card-subtitle mb-2 text-muted">{{$comment->Users->nick}}</h6>
                                      <p class="card-text">{{$comment->coment_user}}</p>
                                      </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach


            </div>
    </div>

    <br>
    @endforeach

</div>
@endsection

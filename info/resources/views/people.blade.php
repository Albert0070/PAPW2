@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #F0FFFF">
    <br>
    <?php $puesto = 0 ?>
    @foreach ($landingPosts as $landingPost)

    @if ($puesto != 0 && $puesto != $landingPost->id_post)
</div>
</div>
    @endif
    @if($puesto != $landingPost->id_post)

        <?php $puesto = $landingPost->id_post; ?>
        <br>
        <div class="card" style="width: 69.5rem;">
            <div class="card-body">
            <div class="p-3 mb-2 bg-dark text-white">

                <h5 class="card-title">{{ $landingPost->game }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Autor {{$landingPost->nick}}</h6>
                @if($landingPost->tipoArchivo == 'image/jpeg')
            <img class="img-fluid img-thumbnail" style="width: 200px;height: 200px;" src="{{url('/post/arch/'.$landingPost->archivo)}}" alt="">

                @else
                <video width="320" height="240" controls>
                        <source src="{{ route('getVideo', $landingPost->archivo)  }}" type="video/mp4">
                        Your browser does not support the video tag.
                </video>
                <p class="card-text">{{ $landingPost->publicationText }}</p>
                <br>
                @endif


        <br><br>

                    <br>
                    </div>

    @endif

                @if ($landingPost->nickComment != null)


                    <div class="container">
                        <div class="card" style="width: 60rem;">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">{{$landingPost->nickComment}}</h6>
                                <p class="card-text">{{$landingPost->coment_user}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                @endif




    <br>
    @endforeach

</div>

@endsection



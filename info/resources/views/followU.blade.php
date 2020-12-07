@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #F0FFFF">
    <br>
    <?php $puesto = 0 ?>
    <div class="card" style="width: 69.5rem;">
        <div class="card-body">
    @foreach ($landingPosts as $landingPost)



        <br>




            <div class="container">
                <div class="card" style="width: 60rem;">
                    <div class="card-body">
                    <div class="p-3 mb-2 bg-dark text-white">

                        <h6 class="card-subtitle mb-2 text-muted">{{$landingPost->nick}}</h6>
                        <p class="card-text">Start to follow on {{$landingPost->startFollow}}</p>
                    </div>
                    </div>

                </div>
            </div>
            <br>
    <br>
    @endforeach
        </div>
    </div>
    <br>

</div>
@endsection



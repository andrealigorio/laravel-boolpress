@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$category->name}}</h1>
                @foreach ($category->posts as $post)
                    <h1>{{$post->title}}</h1>
                    <p>{{$post->content}}</p>
                    <p>Autore: <strong>{{$post->user->name}}</strong></p>
                    <p>Data: {{$post->user->created_at}}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
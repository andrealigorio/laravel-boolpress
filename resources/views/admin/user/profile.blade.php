@extends('layouts.dashboard')

@section('content')
    <h1>Dati utente</h1>
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            Dati utente
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{Auth::user()->name}}</li>
            <li class="list-group-item">{{Auth::user()->email}}</li>
            @if (Auth::user()->api_token)
                <li class="list-group-item">{{Auth::user()->api_token}}</li>
            @else
            <form action="{{route('admin.generate_token')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary btn-block btn-lg">GENERA TOKEN</button>
            </form>
            @endif
        </ul>
    </div>
@endsection
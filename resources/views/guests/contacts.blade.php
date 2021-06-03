@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Contatti</h1>
            <form action="{{route('contact.sent')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il tuo nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci email" required>
                </div>
                <div class="form-group">
                    <label for="message">Messaggio</label>
                    <textarea name="message" id="message" class="form-control" placeholder="Inserisci il messaggio" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Invia</button>
            </form>
        </div>
    </div>
</div>
@endsection
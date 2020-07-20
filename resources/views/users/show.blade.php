@extends('layouts.master')

@section('content')



<div class="card mx-auto" style="width: 18rem;">
<img src="{{asset("$user->avatar")}}" class="card-img-top" alt="avatar">


  <div class="card-body">
    <h5 class="card-title h2"> {{$user->name}}</h5>
  </div>
  <ul class="list-group list-group-flush">


      <li class="list-group-item">Email: {{$user->email}}</li>
        <li class="list-group-item">Datum narodenia: 01.01.1990</li>
        <li class="list-group-item">Adresa: Prievida</li>
        <li class="list-group-item">Telefon: 0912458125</li>
      <li class="list-group-item">{{$user->created_at}}</li>
</ul>


  <div class="card-body">
       @can('view', $user)
  <a href="/users/{{$user->id}}/edit" class="card-link">Edit</a>
    @endcan

  </div>
</div>

@endsection

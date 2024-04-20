@extends('master')

@section('title', $message->title)

@section('content')

<h3>{{$message->title}}</h3>
<p>{{$message->content}}</p>

<br><br>
<a href='/'>Back to Home</a>

@endsection

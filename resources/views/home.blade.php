@extends('master')

@section('title', 'Homepage')

@section('content')

Post a message:
<form action="/blog/create" method="post">
    <input type="text" name="title" placeholder="Title"><br>
    <textarea name="content" placeholder="Content"></textarea><br>
      {{ csrf_field() }}
    <input type="submit">
</form>

Blog Messages:


<ul>
    @foreach($messages as $message)

    <li> <strong> {{ $message->title }} </strong>
        <br>
        {{ $message->content }}
        <br>
        {{ $message->created_at->diffForHumans() }}
        <br>

        <a href="/message/{{ $message->id }}">View</a>

    </li>

    @endforeach
</ul>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>



@endsection

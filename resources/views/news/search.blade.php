@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search Results for "{{ $query }}"</h1>
    <div class="mt-4">
        @if ($news->isEmpty())
            <p>No results found.</p>
        @else
            @foreach ($news as $article)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->headline }}</h5>
                    <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                    <p class="text-muted">By {{ $article->user->name }} on {{ $article->date_published }}</p>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

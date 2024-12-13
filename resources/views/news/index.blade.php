@extends('layouts.app')

@section('content')
<div class="container">
    <h1>News Articles</h1>
    <form action="{{ route('news.search') }}" method="GET">
        <div class="mb-3">
            <input type="text" class="form-control" name="query" placeholder="Search news...">
        </div>
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>
    <div class="mt-4">
        @foreach ($news as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $article->headline }}</h5>
                <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                <p class="text-muted">By {{ $article->user->name }} on {{ $article->date_published }}</p>
            </div>
        </div>
        @endforeach
    </div>
    {{ $news->links() }}
</div>
@endsection

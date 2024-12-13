@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create News</h1>
    <form action="{{ route('news.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="headline" class="form-label">Headline</label>
            <input type="text" class="form-control @error('headline') is-invalid @enderror" id="headline" name="headline" value="{{ old('headline') }}">
            @error('headline')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date_published" class="form-label">Date Published</label>
            <input type="date" class="form-control @error('date_published') is-invalid @enderror" id="date_published" name="date_published" value="{{ old('date_published') }}">
            @error('date_published')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

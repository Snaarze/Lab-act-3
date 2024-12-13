<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;

class NewsController extends Controller
{
    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'headline' => 'required|string|min:10',
            'content' => 'required|string|min:100',
            'date_published' => 'required|date',
        ]);

        News::create([
            'headline' => $request->headline,
            'content' => $request->content,
            'date_published' => $request->date_published,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'News article created successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $news = News::where('headline', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->get();

        return view('news.search', compact('news', 'query'));
    }

    public function index()
    {
        $news = News::with('user')->paginate(10);
        return view('news.index', compact('news'));
    }
}

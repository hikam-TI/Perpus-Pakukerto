<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->query('search');
        $category = $request->query('category');

        $query = Book::withCount('borrows')
            ->orderByDesc('created_at');

        if ($search) {
            $query->where(function ($sub) use ($search) {
                $sub->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        $books = $query->get();
        $allBooks = Book::withCount('borrows')->orderByDesc('created_at')->get();
        $categories = Book::query()->distinct('category')->pluck('category')->sort()->toArray();
        $activeBorrowed = Borrow::whereNull('returned_at')->count();
        $totalBooks = $allBooks->sum('copies');
        $availableBooks = $allBooks->sum('copies');
        $outOfStock = $allBooks->where('copies', 0)->count();
        $borrowedBookIds = Borrow::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->pluck('book_id')
            ->toArray();
        $currentBorrows = Borrow::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->with('book')
            ->latest('borrowed_at')
            ->get();
        $recentBorrows = Borrow::with('book', 'user')
            ->whereNull('returned_at')
            ->latest('borrowed_at')
            ->limit(4)
            ->get();
        $recentReturns = Borrow::with('book', 'user')
            ->whereNotNull('returned_at')
            ->latest('returned_at')
            ->limit(4)
            ->get();
        $totalReturns = Borrow::whereNotNull('returned_at')->count();

        return view('books.index', compact(
            'books',
            'user',
            'activeBorrowed',
            'totalBooks',
            'availableBooks',
            'outOfStock',
            'borrowedBookIds',
            'categories',
            'search',
            'category',
            'currentBorrows',
            'recentBorrows',
            'recentReturns',
            'totalReturns'
        ));
    }

    public function create()
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('books.create');
    }

    public function store(Request $request)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'copies' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
        ]);

        Book::create($data);

        return redirect()->route('dashboard')->with('success', 'Buku berhasil ditambahkan.');
    }
}

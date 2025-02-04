<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Save;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function index()
    {
        $saves = Save::with('book', 'user')->simplePaginate(10);
        return view('user.view.saved', compact('saves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Save::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
        ]);

        Book::where('id', $request->book_id)->update([
            'is_saved' => 'saved',
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Save $save)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Save $save)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Save $save)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request, $save_id)
    // {
    //     $save = Save::find($save_id);
    //     $save->delete();

    //     Book::where('id', $request->book_id)->update([
    //         'is_saved' => 'unsaved',
    //     ]);

    //     return redirect()->back()->with('success', 'Buku berhasil dihapus');
    // }

    public function destroy(Request $request, $save_id)
    {
        $save = Save::find($save_id);
        if ($save) {
            $save->delete();

            Book::where('id', $request->book_id)->update([
                'is_saved' => 'unsaved',
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}

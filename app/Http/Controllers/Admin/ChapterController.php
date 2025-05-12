<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $item = Chapter::all();
        return Inertia::render('backend/ChapterList', [
            'chapter' => $item
        ]);
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
        // dd($request->all());
        //
        try {
            $validated = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'name' => 'required|string|max:16',
                'sort' => 'nullable|integer',
                'introduction' => 'required|string|max:40',
                'video_url' => 'nullable',
            ]);
            $chapter = $validated;
            Chapter::create($chapter);

            return redirect()->back()->with('success', '章節新增成功');
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->with('error', '章節新增失敗，請稍後再試');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
        // $data = Chapter::find($request->id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:16',
            'sort' => 'nullable|integer',
            'introduction' => 'required|string|max:40',
            'video_url' => 'nullable',
        ]);
        // $data->update($validated);
        $chapter->update($validated);

        return redirect()->back()->with('success', '章節已更新');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //
        $item = Chapter::find($id);
        $item->delete();
        return back()->with('success', '刪除成功');
    }
}

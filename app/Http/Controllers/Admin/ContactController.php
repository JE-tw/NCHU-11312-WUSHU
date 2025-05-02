<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ContactRecord;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $item = ContactRecord::all();
    //     return Inertia::render('backend/ContactList',[
    //         'contacts'=> $item
    //     ]);
    // }
    public function index(Request $request)
    {
        // 取得搜尋與排序參數
        $search = $request->input('search');
        $sortKey = $request->input('sort', 'created_at'); // 正確欄位名
        $sortDirection = $request->input('direction', 'asc');
    
        $allowedSortKeys = ['created_at'];
        $allowedDirections = ['asc', 'desc'];
    
        $query = ContactRecord::query();
    
        // 搜尋姓名
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
    
        // 排序
        if (in_array($sortKey, $allowedSortKeys) && in_array($sortDirection, $allowedDirections)) {
            $query->orderBy($sortKey, $sortDirection);
        }
    
        // 分頁 + 保留查詢參數
        $contacts = $query->paginate(10)->withQueryString();

        $contacts->getCollection()->transform(function ($contact) {
            $contact->formatted_date = $contact->created_at->format('Y-m-d');
            return $contact;
        });
    
        return Inertia::render('backend/ContactList', [
            'contacts' => $contacts,
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //
        $item = ContactRecord::find($id);
        $item->delete();
        return back()->with('success', '刪除成功');
    }
}

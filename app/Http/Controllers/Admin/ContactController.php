<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ContactRecord;
use App\Http\Controllers\Controller;
use App\Traits\HandlesTableFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactController extends Controller
{
    use HandlesTableFilters;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = ContactRecord::query();

        /** @var LengthAwarePaginator $contacts */
        $contacts = $this->applyFiltersAndPaginate($request, $query, [
            'search' => ['name'],
            'allowedSorts' => ['created_at'],
            'defaultSort' => 'created_at',
            'defaultDirection' => 'asc',
            'perPage' => 10,
        ]);

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

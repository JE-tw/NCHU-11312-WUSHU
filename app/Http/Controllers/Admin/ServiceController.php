<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\HandlesTableFilters;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class ServiceController extends Controller
{

    use HandlesTableFilters;

    public function index(Request $request)
    {
        //
        $query = Service::query();
        $services = $this->applyFiltersAndPaginate($request, $query, [
            'search' => [], // 支援搜尋的欄位
            'allowedSorts' => [],
            'defaultSort' => 'name',
            'defaultDirection' => 'asc',
            'perPage' => 10,
        ]);


        return Inertia::render('backend/ServiceList', [
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            // 資料驗證
            $validated = $request->validate([
                'name' => 'required|string|max:12',
                'price' => 'required|numeric|min:0',
                'introduction' => 'required|string|max:100',
            ]);
    
            // 建立服務資料
            Service::create($validated);
    
            return redirect()->back()->with('success', '服務新增成功');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->with('error', '服務新增失敗，請稍後再試');
        }
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
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:12',
            'price' => 'required|numeric',
            'introduction' => 'required|string|max:100',
        ]);
    
        $service->update($validated);
    
        return redirect()->back()->with('success', '服務已更新');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //
        $item = Service::find($id);
        $item->delete();
        return back()->with('success', '刪除成功');
    }
}

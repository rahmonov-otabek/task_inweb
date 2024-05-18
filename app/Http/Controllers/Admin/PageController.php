<?php

namespace App\Http\Controllers\Admin;

use DOMDocument;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::paginate(5); 
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $validated = $request->validated();  
        
        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $validated = $request->validated(); 

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {  
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully'); 
    }
}

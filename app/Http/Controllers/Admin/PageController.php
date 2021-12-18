<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPageRequest;
use App\Models\Page;

class PageController extends Controller
{
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(EditPageRequest $request, Page $page)
    {
        $page->update($request->validated());

        return redirect()->route('admin.pages.edit', $page);
    }
}

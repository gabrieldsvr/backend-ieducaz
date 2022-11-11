<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use App\Models\PageType;
use Illuminate\Http\Request;

class PageTypesController extends Controller
{
    public function index()
    {


    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(String $id)
    {
        return PageType::findOrFail($id);
    }

    public function edit(PageType $pageType)
    {
    }

    public function update(Request $request, PageType $pageType)
    {
    }

    public function destroy(PageType $pageType)
    {
    }
}

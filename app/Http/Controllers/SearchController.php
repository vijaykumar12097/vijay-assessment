<?php

namespace App\Http\Controllers;

use App\Models\DocumentHeader;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = DocumentHeader::query();

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('tags')) {
            $query->whereJsonContains('metadata->tags', $request->tags);
        }

        if ($request->filled('owner')) {
            $query->where('user_id', $request->owner);
        }

        return response()->json($query->get());
    }
}

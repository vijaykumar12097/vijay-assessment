<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index($id)
    {
        $versions = Version::where('document_id', $id)->get();

        return response()->json($versions);
    }
}

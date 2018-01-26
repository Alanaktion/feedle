<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    /**
     * Show a favicon for a domain, caching it when possible.
     *
     * @return \Illuminate\Http\Response
     */
    public function favicon(string $host)
    {
        // TODO: find and load $host's favicon
        // TODO: determine filename and write file
        // Storage::disk('public')->put($filename, $data);
    }
}

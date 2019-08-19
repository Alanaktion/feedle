<?php

namespace App\Http\Controllers;

class ProxyController extends Controller
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

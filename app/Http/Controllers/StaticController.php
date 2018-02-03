<?php

namespace App\Http\Controllers;

class StaticController extends Controller
{
    /**
     * Get a list of all named routes as a JS script file
     *
     * @return \Illuminate\Http\Response
     */
    public function routesJs()
    {
        $routes = app('router')->getRoutes();
        return response()
            ->view('js.routes', ['routes' => $routes])
            ->header('Content-Type', 'application/javascript');
    }
}

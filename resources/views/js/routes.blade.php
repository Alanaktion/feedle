var AppBase = @json(url('/'));
var AppRoutes = {};
@foreach ($routes as $route)
@if ($route->getName())
AppRoutes[@json($route->getName())] = @json($route->uri);
@endif
@endforeach

var route = function(name)
{
    if (name in AppRoutes) {
        return AppBase + '/' + AppRoutes[name].replace(/^\//, '');
    }
};

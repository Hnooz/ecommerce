<?php

route::group(['middleware' => 'Maintenance'], function() {

route::get('/', function() {
    return view('style.home');
});

});

route::get('maintenance', function() {
    if (setting()->status == 'open') {
        return redirect('/');
    } 
    return view('style.maintenance');
});
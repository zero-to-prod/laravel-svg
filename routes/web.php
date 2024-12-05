<?php

\Illuminate\Support\Facades\Route::get(config('svg.endpoint'), config('svg.controller'))->name(config('svg.route_name'))->middleware(config('svg.middleware'));
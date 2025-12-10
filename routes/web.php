<?php

use App\Models\Actor;

Route::get('/test-actor', function () {
    return Actor::limit(20)->get();
});





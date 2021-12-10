<?php

Route::prefix('agent')->middleware(['auth', 'role:Agent'])->group(function() {
    Route::resource('/agent', 'AgentController');
    Route::resource('/icracc', 'AgentController');
    Route::resource('/raporlar', 'AgentController');
    Route::resource('/hatirlatmalar', 'AgentController');
});

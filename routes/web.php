<?php

Route::group(config('translation.route_group_config') + ['namespace' => 'JoeDixon\\Translation\\Http\\Controllers'], function ($router) {
    $router->get(config('translation.ui_url'), 'LanguageController@index');

    $router->get(config('translation.ui_url').'/create', 'LanguageController@create');

    $router->post(config('translation.ui_url'), 'LanguageController@store');

    $router->get(config('translation.ui_url').'/{language}/translations', 'LanguageTranslationController@index');

    $router->post(config('translation.ui_url').'/{language}', 'LanguageTranslationController@update');

    $router->get(config('translation.ui_url').'/{language}/translations/create', 'LanguageTranslationController@create');

    $router->post(config('translation.ui_url').'/{language}/translations', 'LanguageTranslationController@store');
});

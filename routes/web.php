<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/currencies', 'CurrencyController', ['only' => [
    'index', 'show'
]]);

// ->middleware('auth:api')

// Route::get('/currencies/{date}', 'CurrencyController@getByDate');
// Route::get('/currencies/update', 'CurrencyController@updateAll');

// Route::get('/update', function() {
//     $xml = file_get_contents('https://nationalbank.kz/rss/rates_all.xml?switch=russian');
//     $data = simplexml_load_string($xml);
//     foreach($data->channel->item as $item) {
//         $currentDate = date('Y-m-d');
//         $currency = Currency::where('name', $item->title)->first();

//         if(!$currency || $currentDate != $currency->date) {
//             $newCurrency = new Currency;

//             $newCurrency->name = $item->title;
//             $newCurrency->rate = $item->description;
//             $newCurrency->date = $currentDate;
//             $newCurrency->created_at = date('Y-m-d H:i:s');
//             $newCurrency->updated_at = date('Y-m-d H:i:s');

//             $newCurrency->save();
//         } else {
//             $currency->rate = $item->description;
//             $currency->updated_at = date('Y-m-d H:i:s');
//             $currency->save();
//         }
//     }
//     echo 'Updated '.date('Y-m-d');
// });
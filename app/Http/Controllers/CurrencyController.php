<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // check token
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        if($token != 'vbPFS4vtU0312NI4PFoQt6MTQiunCpaaqIPbEwui') {
            if($token == '') {
                return abort(401);   
            }
            return abort(403);
        }

        // current date
        $date = date('Y-m-d');

        // convert input date
        if($request->input('date')) {
            $date = date('Y-m-d', strtotime($request->input('date')));
        }

        $currencies = [];
        $currenciesAll = Currency::where('date', $date)->get();

        foreach($currenciesAll as $currency) {
            // exclude dublicates
            if(array_search($currency->name, array_column($currencies, 'name')) === false) {
                $currencies[] = ['name' => $currency->name, 'rate' => $currency->rate, 'date' => $currency->date];
            }
        }

        $datePrev = date('Y-m-d', strtotime("$date - 1 day"));
        $datePrevLink = '?date='.$datePrev;
        $dateNext = date('Y-m-d', strtotime("$date + 1 day"));
        $dateNextLink = '?date='.$dateNext;
        if($dateNext == date('Y-m-d', strtotime('now + 1 day'))) {
            $dateNext = '';
            $dateNextLink = '';
        }

        if(!$currencies) {
            return abort(404);
        }

        // return json_encode($currencies);
        return view('list', ['currencies' => $currencies, 'title' => 'Currency', 'currentDate' => $date, 'datePrevLink' => $datePrevLink, 'datePrevTitle' => $datePrev, 'dateNextLink' => $dateNextLink, 'dateNextTitle' => $dateNext]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show($currencyName, Request $request)
    {
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        if($token != 'vbPFS4vtU0312NI4PFoQt6MTQiunCpaaqIPbEwui') {
            if($token == '') {
                return abort(401);   
            }
            return abort(403);
        }

        $date = date('Y-m-d');

        if($request->input('date')) {
            $date = date('Y-m-d', strtotime($request->input('date')));
        }

        $currencies = [];
        $item = Currency::where('name', $currencyName)->where('date', $date)->orderBy('id', 'desc')->first();
        if($item) {
            $currencies[] = ['name' => $item->name, 'rate' => $item->rate];
        } else {
            $currencies = false;
        }

        $datePrev = date('Y-m-d', strtotime("$date - 1 day"));
        $datePrevLink = '?date='.$datePrev;
        $dateNext = date('Y-m-d', strtotime("$date + 1 day"));
        $dateNextLink = '?date='.$dateNext;
        if($dateNext == date('Y-m-d', strtotime('now + 1 day'))) {
            $dateNext = '';
            $dateNextLink = '';
        }

        if(!$currencies) {
            return abort(404);
        }

        return view('list', ['currencies' => $currencies, 'title' => 'Currency', 'currentDate' => $date, 'datePrevLink' => $datePrevLink, 'datePrevTitle' => $datePrev, 'dateNextLink' => $dateNextLink, 'dateNextTitle' => $dateNext]);
    }
}

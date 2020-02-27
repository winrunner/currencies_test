<?php

namespace App\Console\Commands;

use App\Currency;
use Illuminate\Console\Command;

class CurrencyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $xml = file_get_contents('https://nationalbank.kz/rss/rates_all.xml?switch=russian');
        $data = simplexml_load_string($xml);
        foreach($data->channel->item as $item) {
            $currentDate = date('Y-m-d');
            $currency = Currency::where('name', $item->title)->first();

            if(!$currency || $currentDate != $currency->date) {
                $newCurrency = new Currency;

                $newCurrency->name = $item->title;
                $newCurrency->rate = $item->description;
                $newCurrency->date = $currentDate;
                $newCurrency->created_at = date('Y-m-d H:i:s');
                $newCurrency->updated_at = date('Y-m-d H:i:s');

                $newCurrency->save();
            } else {
                $currency->rate = $item->description;
                $currency->updated_at = date('Y-m-d H:i:s');
                $currency->save();
            }
        }
        echo 'Currency updated '.date('Y-m-d')."\n";
    }
}

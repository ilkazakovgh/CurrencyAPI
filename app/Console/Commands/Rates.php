<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DOMDocument;
use App\Models\Currency;

class Rates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command gets currency rates from CB web-site and saves it to `currency` table';

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
     * @return int
     */
    public function handle()
    {
        $xmlDoc = new DOMDocument();

        $cbr_url = config('currency.cbr_url');

        if (trim($cbr_url)) {
            if ($xmlDoc->load($cbr_url.'?date_req=' . date('d.m.Y'))) {
                $root = $xmlDoc->documentElement;

                Currency::truncate();
                $currencies = $root->getElementsByTagName('Valute');

                foreach ($currencies as $c) {
                    $num_code = trim($c->getElementsByTagName('NumCode')->item(0)->nodeValue);
                    $char_code = trim($c->getElementsByTagName('CharCode')->item(0)->nodeValue);

                    $name = trim($c->getElementsByTagName('Name')->item(0)->nodeValue);
                    $nominal = intval($c->getElementsByTagName('Nominal')->item(0)->nodeValue);
                    $rate = $value = round(floatval(str_replace(',', '.', trim($c->getElementsByTagName('Value')->item(0)
                        ->nodeValue))));
                    if ($nominal > 1) {
                        $rate = round($value / $nominal, 3);
                    }
                    $this->info($name . '/' . $nominal . '/' . $value . '/' . $rate);

                    if (trim($name) && trim($num_code)  && trim($char_code) && ($nominal > 0) && ($rate > 0) && ($value
                            > 0)) {
                        Currency::create(['name' => $name, 'rate' => $rate, 'num_code' => $num_code, 'char_code' =>
                            $char_code, 'nominal' => $nominal, 'cbr_rate' => $value]);
                    }
                }
                $this->info(PHP_EOL);
                $this->info('Currency rates where updated successfully.');
                unset($currencies);
            }
        } else {
            $this->info('Currency rates url [currency.cbr_url] is not set in config\currency.php.');
        }

        unset($xmlDoc);

        return 1;
    }
}

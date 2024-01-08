<?php

namespace App\Console\Commands;

use App\Mail\SendAwardToCliente;
use App\Models\Award;
use App\Models\Client;
use DateTime;
use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendAwards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-awards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar Email de Prêmios para Clientes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $current_date = (new DateTime('now'))->format('Y-m-d H::i');
        $awards = Award::query()->whereBetween('date', ["$current_date:00", "$current_date:59" ])->get();
        foreach($awards as $award){
            $clients = Client::query()->take($award->amount)->inRandomOrder()->get();

            foreach($clients as $client) {
                Mail::to($client->email, $client->name)->send(new SendAwardToCliente($client));
            }
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Services\CurrencyPairService;
use Illuminate\Console\Command;

class GetIGEpics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ig:update:epics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to loop all of the Currency Pairs and update the ig_epic field Test';

    /**
     * @var CurrencyPairService
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @param CurrencyPairService $service
     */
    public function __construct(CurrencyPairService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service->updatePairEpics(true);
    }
}

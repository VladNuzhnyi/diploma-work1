<?php

namespace App\Console\Commands;

use App\Http\DAL\Models\Ad;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Illuminate\Console\Command;

class ElasticDataImorter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $ads = Ad::with('images')->with('region')->with('rents')->get();
        $elastic = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();

        try{
            $elastic->indices()->delete([
                'index'=>'ad'
            ]);
        }catch (Missing404Exception $e){
            echo "no index created yet";
            echo  $e->getMessage();
        }

        foreach ( $ads as $ad){
            $elastic->index([
                'index' => 'ad',
                'type' => 'ad',
                'id' => $ad->id,
                'body' => $ad->toArray()
            ]);
        }
        return "ok";
    }
}

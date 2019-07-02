<?php

namespace App\Console\Commands;

use App\Listen;
use App\Parsers\LastFmMusicImportParser;
use App\Persistance\ListenSaver;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ScrobbleImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lastfm:scrobbles:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import scrobbles (listens) from a public Last.FM account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LastFmMusicImportParser $parser, ListenSaver $listenSaver)
    {
        $this->parser = $parser;

        $this->listenSaver = $listenSaver;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastfm = new \Dandelionmood\LastFm\LastFm(
            config('services.lastfm.key'),
            config('services.lastfm.secret')
        );

        $recentListens = $lastfm->user_getRecentTracks([
            'user' => config('services.lastfm.username'),
            'limit' => config('services.lastfm.import_limit'),
            'from' => $this->determineFromDate(),
            'to' => $this->determineToDate()
        ]);

        $preparedListens = $this->parser->prepare($recentListens);

        if ($preparedListens) {
            $this->listenSaver->save($preparedListens);
        }

        return;
    }

    public function determineFromDate()
    {
        if (config('scrobbles.backdate') === TRUE) {
            return 47;
        }

        return Listen::lastRetrieved();
    }

    public function determineToDate()
    {
        if (config('scrobbles.backdate') === TRUE) {
            return Listen::earliestListen();
        }

        return with(Carbon::now())->timestamp;
    }
}

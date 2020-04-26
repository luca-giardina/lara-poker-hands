<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Game;
use App\Player;
use App\Hand;
use App\Poker;

class HandsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:hands {filePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import hands from a file';

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
        $filePath = $this->argument('filePath');

        if(!file_exists($filePath))
        {
            $this->info('file doesn\'t exists');
            return;
        }
 
        // player 1
        $oPlayerOne = Player::find(1);
        // player 2
        $oPlayerTwo = Player::find(2);
 
        if (($handle = fopen($filePath, "r")) !== false)
        {

            // get poker object
            $oPoker = new Poker;

            while (($game = fgets($handle)) !== false)
            {
                // create a game
                $oGame = new Game;
                $oGame->save();

                // get cards
                $hand = explode(" ", trim($game));

                // player 1
                $handPlayerOne = array_slice($hand, 0, 5);

                $oHandOne = new Hand;
                $oHandOne->player_id = $oPlayerOne->id;
                $oHandOne->game_id = $oGame->id;
                $oHandOne->hand = json_encode($handPlayerOne);
                // calculate hands
                $oHandOne->hand_value = $oPoker->getScore($handPlayerOne);
                $oHandOne->save();


                // player 2
                $handPlayerTwo = array_slice($hand, 5, 5);

                $oHandTwo = new Hand;
                $oHandTwo->player_id = $oPlayerTwo->id;
                $oHandTwo->game_id = $oGame->id;
                $oHandTwo->hand = json_encode($handPlayerTwo);
                // calculate hands
                $oHandTwo->hand_value = $oPoker->getScore($handPlayerTwo);
                $oHandTwo->save();

                if($oHandOne->hand_value == $oHandTwo->hand_value) {
                    $oGame->tie = true;
                }
                else {
                    $oGame->winner_id = $oHandOne->hand_value > $oHandTwo->hand_value ? $oPlayerOne->id : $oPlayerTwo->id;
                }
                $oGame->save();
            }
            fclose($handle);
        }

        $this->info("done.");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HandValues;

class Poker extends Model
{
    use HandValues;

    /**
     * Suit values
     */
    const SUITS = [
        'S' => 1, // SPADE
        'H' => 2, // HEART
        'D' => 4, // DIAMOND
        'C' => 8  // CLUB
    ];
    
    /**
     * Rank values
     */
    const RANKS = [
        '2' => 0,
        '3' => 1,
        '4' => 2,
        '5' => 3,
        '6' => 4,
        '7' => 5,
        '8' => 6,
        '9' => 7,
        'T' => 8,
        'J' => 9,
        'Q' => 10,
        'K' => 11,
        'A' => 12
    ];
    
    /**
     * When added to highest straight value yields 7642 which is the
     * TOTAL_DISTINCT values and the value of the highest straight
     * flush hand "Royal Flush"
     */
    const STRAIGHT_FLUSH_BONUS = 1599;
    
    /**
     * When added to the highest highcard value yields 7140 which is
     * the value of the highest flush hand
     */
    const HIGHCARD_FLUSH_BONUS = 5863;

    /**
     * prime values of card ranks
     * 
     * @var array
     */
    private $primeRankValues = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41];

    /**
     * Assign a score to the set of cards
     * 
     * @param Array of cards (5) format 1C, 4H ecc.
     * 
     * @return int [1, 7462]
     */
    public function getScore($cards)
    {
        $hand = $this->covertHand($cards);

        $pprod = ($hand[0] & 0x0FF) * ($hand[1] & 0x0FF) * ($hand[2] & 0x0FF) *
                 ($hand[3] & 0x0FF) * ($hand[4] & 0x0FF);


        try {            
            // Check if hand is a flush
            if (0xF00 & $hand[0] & $hand[1] & $hand[2] & $hand[3] & $hand[4]) {
                if ($pprod === 31367009 || $pprod === 14535931 ||
                    $pprod === 6678671  || $pprod === 2800733  ||
                    $pprod === 1062347  || $pprod === 323323   ||
                    $pprod === 85085    || $pprod === 15015    ||
                    $pprod === 2310     || $pprod === 205205) {
                    
                    // It's a straight flush!
                    return $this->score($pprod) + self::STRAIGHT_FLUSH_BONUS;
                }
                
                // It's a regular flush
                return $this->score($pprod) + self::HIGHCARD_FLUSH_BONUS;
            }
            
            return $this->score($pprod);
        }
        catch(\Exception $e) {
            dd("PROBLEM", $cards, $hand, $pprod, 0xF00 & $hand[0] & $hand[1] & $hand[2] & $hand[3] & $hand[4]);
        }
    }
    
    /**
     * Convert card to corresponding 8 bit integer
     * 
     * @param $suit Card suit: Club(8), Diamond(4), Heart(2), Spade(1)
     * @param $rank Card rank: Deuce(0), Trey(1), ..., King(11), Ace(12)
     * 
     * @return int
     */
    public function toInt($suit, $rank)
    {
        return $suit << 8 | $this->primeRankValues[intval($rank)];
    }

    /**
     * Convert hand array to corresponding 8 bit integer array
     * 
     * @param Array of cards format 1C, 4H ecc.
     * 
     * @return Array
     */

    public function covertHand($hand)
    {
        $convertedHand = [];

        foreach ($hand as $card)
        {
            $convertedHand[] = $this->toInt(self::SUITS[$card[1]], self::RANKS[$card[0]]);            
        }

        return $convertedHand;
    }
}
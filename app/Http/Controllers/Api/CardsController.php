<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Card;
use MixCode\CardView;
use MoaAlaa\ApiResponder\ApiResponder;

class CardsController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return $this->api()->response(Card::paginate(20));
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card, Request $request)
    {
        // Increment Views Counter
        $card->increment('views_count');

        // Record New User View
        if (auth('api')->check()) {
            $card->views()->attach(auth('api')->id());
        }
        
        return $this->api()->response($card);
    }

  

    /**
     * List Card Categories resource.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function showCategories(Card $card)
    {
        abort_unless($card->categories()->exists(), Response::HTTP_NOT_FOUND);
        
        return $this->api()->response($card->categories);   
    }

    /**
     * List Card Features resource.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function showCompanies(Card $card)
    {
        abort_unless($card->companies()->exists(), Response::HTTP_NOT_FOUND);
        
        return $this->api()->response($card->companies);   
    }

    /**
     * List Card Languages resource.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function showLanguages(Card $card)
    {
        abort_unless($card->languages()->exists(), Response::HTTP_NOT_FOUND);
        
        return $this->api()->response($card->languages);   
    }

    /**
     * List Favorite Cards.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function showFavorites(Card $card)
    {
        abort_unless($card->languages()->exists(), Response::HTTP_NOT_FOUND);
        
        return $this->api()->response($card->languages);   
    }
}

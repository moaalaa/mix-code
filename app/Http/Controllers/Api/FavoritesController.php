<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Favorite;
use MixCode\Http\Controllers\Controller;
use MixCode\Card;
use MoaAlaa\ApiResponder\ApiResponder;

class FavoritesController extends Controller
{
    use ApiResponder;

    /**
     * Mark card as Favorite.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function markAsFavorite(Card $card)
    {
        $card->markAsFavorite();

        return $this->api()->response([], trans('main.card_favorited'), Response::HTTP_CREATED);
    }

    /**
     * Mark card as Un Favorite.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function markAsUnFavorite(Card $card)
    {
        $card->markAsUnFavorite();

        return $this->api()->response([], trans('main.card_un_favorited'), Response::HTTP_OK);
    }

    /**
     * List Favorite Cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function listFavoriteCards()
    {
        $cards = Card::whereHas('favorites', function (Builder $builder) {
            $builder->where('favorites.user_id', auth()->id());
        })->paginate(20);
          
        return $this->api()->response($cards);
    }
}

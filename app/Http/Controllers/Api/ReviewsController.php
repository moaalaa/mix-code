<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\ReviewsRequest;
use MixCode\Card;
use MoaAlaa\ApiResponder\ApiResponder;

class ReviewsController extends Controller
{
    use ApiResponder;

    /**
     * Store New Review.
     *
     * @param  \MixCode\Card  $card
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitReview(Card $card, ReviewsRequest $request)
    {
        $card = $card->submitReview($request->all());

        return $this->api()->response([], trans('main.thanks_for_review'), Response::HTTP_CREATED);
    }

    /**
     * List Card Reviews resource.
     *
     * @param  \MixCode\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function listCardReview(Card $card)
    {
        abort_unless($card->reviews()->exists(), Response::HTTP_NOT_FOUND);

        return $this->api()->response($card->reviews);   
    }
}

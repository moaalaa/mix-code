<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Category;
use MixCode\Card;
use MoaAlaa\ApiResponder\ApiResponder;

class CategoriesController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->api()->response(Category::active()->with('media')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->api()->response($category);   
    }

    /**
     * List all Cards from requested category.
     *
     * @param  \MixCode\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function cards($category_id)
    {        
        $cards = Card::whereHas('categories', function (Builder $builder) use ($category_id) {
            $builder->where('categories.id', $category_id);
        })->paginate(20);

        return $this->api()->response($cards);
    }
}

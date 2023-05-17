<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the Categories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Category::all();
        return view('home', compact('data'));
    }

    /**
     * Display the SubCategories.
     * @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function subcategories($id)
    {
        $subcategories = Subcategory::where('category_id', '=', $id)->get();
        return view('home.subcategories',compact('subcategories'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
    }

        /**
     * Display the OrderSummary.
     * @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ordersummary($id)
    {
        $subcategories = Subcategory::where('id', '=', $id)->get();
        return view('home.ordersummary',compact('subcategories'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}

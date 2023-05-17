<?php
    
namespace App\Http\Controllers;
    
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
    
class SubcategoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        /*
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
         */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Subcategory::all();
        return view('subcategories.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','name')->all();
        return view('subcategories.create', compact('categories'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
    
        $category_id = Category::where('name', $request->category_id)->first()->id;
        $request->merge(['category_id' => $category_id]);
        Subcategory::create($request->all());
    
        return redirect()->route('categories.index')
                        ->with('success','Subcategory created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        return view('subcategories.show',compact('subcategory'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        return view('subcategories.edit',compact('subcategory'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
         request()->validate([
            'name' => 'required',
        ]);
    
        $subcategory->update($request->all());
    
        return redirect()->route('subcategories.display', $subcategory->category_id)
                        ->with('success','Subcategory updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
    
        return redirect()->route('subcategories.display', $subcategory->category_id)
                        ->with('success','Subcategory deleted successfully');
    }
}
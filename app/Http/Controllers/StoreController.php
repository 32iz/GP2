<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Store;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Store::all();
        return view('Stores.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        $uploadedFile = $request->file('papers');
        $filename = time().$uploadedFile->getClientOriginalName();
  
        Storage::disk('public')->putFileAs(
          'papers/',
          $uploadedFile,
          $filename
        );
  
        Store::create([
          'name' => $request->input("name"),
          'email' => $request->input("email"),
          'papers' => $filename,
          'status' => $request->input("status")
        ]);
  
        return redirect()->route('stores.index')
                        ->with('success','Store created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.show',compact('store'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.edit',compact('store'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:stores,email,'.$id,
            'papers' => 'file|mimes:jpg,jpeg,png,pdf'
        ]);

        $store = Store::findOrFail($id);

        if($request->papers){
          //delete file
          Storage::disk('public')->delete('papers/'.$store->papers);
  
          $uploadedFile = $request->file('papers');
          $filename = time().$uploadedFile->getClientOriginalName();
    
          Storage::disk('public')->putFileAs(
            'papers/',
            $uploadedFile,
            $filename
          );
          $request->merge(['papers' => $filename]);
        }
  

        $store->update($request->input());
        
        return redirect()->route('stores.index')
                        ->with('success','Store updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $store = Store::findOrFail($id);
      Storage::disk('public')->delete('papers/'.$store->papers);
      $store->delete();
        return redirect()->route('stores.index')
                        ->with('success','Store deleted successfully');
    }

    /**
     * Stores registeration function.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function register(Request $request)
    {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:stores,email,',
      'papers' => 'required|file|mimes:jpg,jpeg,png,pdf'
    ]);

        $uploadedFile = $request->file('papers');
        $filename = time().$uploadedFile->getClientOriginalName();
  
        Storage::disk('public')->putFileAs(
          'papers/',
          $uploadedFile,
          $filename
        );
  
        Store::create([
          'name' => $request->input("name"),
          'email' => $request->input("email"),
          'papers' => $filename
        ]);
  
        return redirect()->route('store.form')
                        ->with('success','We have received your request and it is under review. 
                        You will start receiving orders through your email when your request is approved!');
    }

    /**
     * Display stores registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function storesForm()
    {
      return view('stores.register');
    }
}
<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\User;
use App\Http\Requests\Admin\StockStoreRequest;



class StockController extends Controller
{
    public function index(){
        $users = User::all();
        $stocks = Stock::all();
        return view('admin.stock.index',compact('stocks','users'));
    }

    public function create(){
        $users = User::all();
        //dd($users);
        return view('admin.stock.create',compact('users'));
    }
    
  
        public function store(Request $request)
        {
            $request->validate([
                'item_name' => 'required',
                'quantity' => 'nullable',
                'price'    =>'required',
            ]);
    
            $code = 'STK-' . strtoupper(uniqid());
    
            $stock = new Stock();
    
            if (auth()->check()) {
                $stock->user_id = auth()->user()->id;
            } else {
                return redirect()->route('login')->with('error', 'Please log in to add stock items.');
            }
    
            $stock->item_name = $request->input('item_name');
            $stock->quantity = $request->input('quantity');
            $stock->price=$request->input('price');
            $stock->code = $code;
    
            $stock->save();
    
            return redirect()->route('stock.index')->with('success', 'Stock item added successfully.');
        }
        public function edit($id)
        {
            $stock = Stock::findOrFail($id); 
        
            return view('admin.stock.edit', compact('stock'));
        }
        public function update(Request $request, $id)
    {
      
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $stock = Stock::findOrFail($id);

        $stock->item_name = $request->input('item_name');
        $stock->quantity = $request->input('quantity');
        $stock->price = $request->input('price');
        
        $stock->save();

        return redirect()->route('stock.index')->with('success', 'Stock item updated successfully.');
    }
    public function view(){
        $stocks = Stock::all();
        return view('admin.stock.view',compact('stocks'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use App\Models\Item;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public function index()
    {
        return Explorer::with('items')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);

        $explorer = Explorer::create($data);

        return response()->json($explorer, 201);
    }

    public function show(Explorer $explorer)
    {
        return $explorer->load('items');
    }

    public function updateLocation(Request $request, Explorer $explorer)
    {
        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        $explorer->update($data);

        return response()->json($explorer, 200);
    }

    public function addItem(Request $request, Explorer $explorer)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'value' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
    
        $item = Item::create($data);
    

        $explorer->items()->attach($item->id);
    
        return response()->json($item, 201);
    }
    
    

    public function tradeItems(Request $request)
    {
        $data = $request->validate([
            'explorer1_id' => 'required|exists:explorers,id',
            'explorer2_id' => 'required|exists:explorers,id',
            'items1' => 'required|array',
            'items2' => 'required|array',
            'items1.*' => 'exists:items,id',
            'items2.*' => 'exists:items,id'
        ]);

        $explorer1 = Explorer::find($data['explorer1_id']);
        $explorer2 = Explorer::find($data['explorer2_id']);

        $items1 = Item::whereIn('id', $data['items1'])->get();
        $items2 = Item::whereIn('id', $data['items2'])->get();

        $value1 = $items1->sum('value');
        $value2 = $items2->sum('value');

        if ($value1 != $value2) {
            return response()->json(['error' => 'Trade must be of equal value'], 400);
        }

        $explorer1->items()->detach($data['items1']);
        $explorer2->items()->detach($data['items2']);

        $explorer1->items()->attach($data['items2']);
        $explorer2->items()->attach($data['items1']);

        return response()->json(['message' => 'Items traded successfully'], 200);
    }
}

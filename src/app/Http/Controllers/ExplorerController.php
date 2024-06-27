<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use App\Models\ExplorerItem;
use App\Models\ExplorerLocationHistory;
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

    public function updateLocation(Request $request, Explorer $explorer, $id)
    {
        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        $explorer = Explorer::findOrFail($id);
        $explorer->update($data);
        return response()->json($explorer, 200);
    }

    public function addItem(Request $request)
    {
        $inventory = ExplorerItem::create($request->all());
            return response()->json($inventory, 201);
    }

    public function locationHistory($id)
    {

        $explorer = Explorer::findOrFail($id);
        $historico = ExplorerLocationHistory::where('explorer_id', $explorer->id)
                                            ->orderBy('created_at', 'desc')
                                            ->get(['id', 'explorer_id', 'latitude', 'longitude', 'created_at', 'updated_at']);

        return response()->json($historico, 200);
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
            return response()->json(['error' => 'precisa do mesmo valor, piazão'], 400);
        }

        $explorer1->items()->detach($data['items1']);
        $explorer2->items()->detach($data['items2']);

        $explorer1->items()->attach($data['items2']);
        $explorer2->items()->attach($data['items1']);

        return response()->json(['message' => 'barganha deu boa Pia'], 200);
    }
}

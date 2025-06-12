<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StyleItem;
use Illuminate\Http\Request;

class StyleItemController extends Controller
{
    public function index()
    {
        return StyleItem::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'extraPrompt' => 'nullable|string',
            'url' => 'required|string|max:255',
        ]);

        $styleItem = StyleItem::create($validated);

        return response()->json($styleItem, 201);
    }

    public function show($id)
    {
        $styleItem = StyleItem::findOrFail($id);
        return response()->json($styleItem);
    }

    public function update(Request $request, $id)
    {
        $styleItem = StyleItem::findOrFail($id);

        $validated = $request->validate([
            'code' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'extraPrompt' => 'nullable|string',
            'url' => 'sometimes|required|string|max:255',
        ]);

        $styleItem->update($validated);

        return response()->json($styleItem);
    }

    public function destroy($id)
    {
        $styleItem = StyleItem::findOrFail($id);
        $styleItem->delete();

        return response()->json(null, 204);
    }
}

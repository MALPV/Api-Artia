<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StyleItem;
use Illuminate\Http\Request;
use App\Models\CategoryStyle;
use Illuminate\Validation\ValidationException;


class StyleItemController extends Controller
{
    public function index()
    {
        $items = StyleItem::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Lista de estilos obtenida correctamente.',
            'data' => $items
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|max:255',
                'category_id' => 'required|integer|exists:category_styles,id',
                'extraPrompt' => 'nullable|string',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $firstMessage = collect($errors)->first()[0];
        
            return response()->json([
                'status' => 'error',
                'message' => $firstMessage,
                'data' => null
            ], 200);
        }
    
        $path = $request->file('image')->store('style-items', 'public');
    
        $styleItem = StyleItem::create([
            ...$validated,
            'url' => asset("storage/$path"),
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Estilo creado correctamente.',
            'data' => $styleItem
        ], 200);
    }    

    public function show($id)
    {
        $styleItem = StyleItem::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Estilo encontrado.',
            'data' => $styleItem
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $styleItem = StyleItem::find($id);
    
        if (!$styleItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Estilo no encontrado.',
                'data' => null
            ], 200);
        }
    
        try {
            $validated = $request->validate([
                'code' => 'sometimes|required|string|max:255',
                'category_id' => 'sometimes|required|integer|exists:category_styles,id',
                'extraPrompt' => 'nullable|string',
                'url' => 'sometimes|required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos inválidos',
                'data' => $e->errors()
            ], 200);
        }
    
        $styleItem->update($validated);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Estilo actualizado correctamente.',
            'data' => $styleItem
        ], 200);
    }    

    public function destroy($id)
    {
        $styleItem = StyleItem::findOrFail($id);
        $styleItem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Estilo eliminado correctamente.',
            'data' => null
        ], 200);
    }
}
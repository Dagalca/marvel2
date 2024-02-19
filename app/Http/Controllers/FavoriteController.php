<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Auth;

class FavoriteController extends Controller
{
    // Añadir a favoritos
    public function add(Request $request)
    {
        $user = Auth::user();

        // Verificar si el elemento ya está en favoritos
        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('favoritable_id', $request->favoritable_id)
            ->where('favoritable_type', $request->favoritable_type)
            ->first();

        // Si el elemento ya está en favoritos, mostrar un mensaje de error en la vista actual
        if ($existingFavorite) {
            return back()->with('error', 'Este elemento ya está en favoritos.');
        }

        // Si el elemento no está en favoritos, añadirlo
        $favorite = new Favorite([
            'user_id' => $user->id,
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $request->favoritable_type,
            'title' => $request->title,
            'image_url' => $request->image_url,
            'description' => $request->description,
            'additional_info' => $request->additional_info
        ]);
        $favorite->save();

        return back()->with('success', 'Añadido a favoritos!');
    }


    // Borrar de favoritos
    public function remove($id)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('id', $id)->first();
        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Eliminado de favoritos!');
        }

        return back()->with('error', 'Favorito no encontrado');
    }

    // Mostrar favoritos
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->get();

        return view('marvel.favorites', compact('favorites'));
    }

    //...otros métodos según necesidad
}

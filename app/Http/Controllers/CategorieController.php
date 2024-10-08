<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        $categories=Categorie::all();
        return response()->json($categories);

        } catch(\Exception $e){
            return response()->json("impossible d afficher les categories");

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $categorie = new Categorie([
                'nomcategorie' => $request->input('nomcategorie'),
                'imagecategorie' => $request->input('imagecategorie')
                ]);
                $categorie->save();
                return response()->json('Catégorie créée !');
        } catch (\Exception $e) {
            return response()->json("probleme d ajout de categorie");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            return response()->json($categorie);
        } catch (\Exception $e) {
            return response()->json("probleme d affichage de categorie");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            $categorie->update($request->all());
        } catch (\Exception $e) {
            return response()->json("probleme d modifier de categorie {$e->getMessage()}, {$e->getCode()},");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            $categorie->delete();
            return response()->json($categorie);
        } catch (\Exception $e) {
            return response()->json("probleme d supprimer de categorie");
        }
    }
}

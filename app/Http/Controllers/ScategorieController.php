<?php

namespace App\Http\Controllers;

use App\Models\Scategorie;
use Illuminate\Http\Request;

class ScategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $scategories=Scategorie::with('categorie')->get(); // Inclut la catégorie liée;
            return response()->json($scategories,200);
            } catch (\Exception $e) {
            return response()->json("Sélection impossible {$e->getMessage()}");
    }}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $scategorie=new Scategorie([
            "nomscategorie"=>$request->input("nomscategorie"),
            "imagescategorie"=>$request->input("imagescategorie"),
            "categorieID"=>$request->input("categorieID")
            ]);
            $scategorie->save();
            return response()->json($scategorie);
            } catch (\Exception $e) {
            return response()->json("insertion impossible {$e->getMessage()}");
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $scategorie=Scategorie::with('categorie')->findOrFail($id);
            return response()->json($scategorie,200);
            } catch (\Exception $e) {
            return response()->json("Sélection impossible {$e->getMessage()}");
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scategorie $scategorie, $id)
    {
        try {
            $scategorie=Scategorie::findOrfail($id);
            $scategorie->update($request->all());
            return response()->json($scategorie);
            
            } catch (\Exception $e) {
            return response()->json("modification impossible {$e->getMessage()}");
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $scategorie=Scategorie::findOrFail($id);
            $scategorie->delete();
            return response()->json("Sous catégorie supprimée avec succes");
            } catch (\Exception $e) {
            return response()->json("Suppression impossible {$e->getMessage()}");
            }
    }

    public function showSCategorieByCAT($idcat)
        {
        try {
        $Scategorie= Scategorie::where('categorieID', $idcat)->with('categorie')->get();
        return response()->json($Scategorie);
        } catch (\Exception $e) {
        return response()->json("Selection impossible {$e->getMessage()}");
        }
        }
}

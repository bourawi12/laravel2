<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
/**
* Display a listing of the resource.
*/
public function index()
{
try {
$articles=Article::with('scategorie')->get(); // Inclut la sous catégorie liée;
return response()->json($articles,200);
} catch (\Exception $e) {
return response()->json("Sélection impossible {$e->getMessage()}");
}
}

/**
* Store a newly created resource in storage.
*/
public function store(Request $request)
{
try {
$article=new Article([
"designation"=> $request->input('designation'),
"marque"=> $request->input('marque'),
"reference"=> $request->input('reference'),
"qtestock"=> $request->input('qtestock'),
"prix"=> $request->input('prix'),
"imageart"=> $request->input('imageart'),
"scategorieID"=> $request->input('scategorieID'),
]);
$article->save();
return response()->json($article);

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
$article=Article::findOrFail($id);
return response()->json($article);
} catch (\Exception $e) {
return response()->json("probleme de récupération des données {$e->getMessage()}");
}
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request, $id)
{
try {
$article=Article::findorFail($id);
$article->update($request->all());
return response()->json($article);
} catch (\Exception $e) {
return response()->json("probleme de modification {$e->getMessage()}");
}
}

/**
* Remove the specified resource from storage.
*/
public function destroy($id)
{
try {
$article=Article::findOrFail($id);



$article->delete();
return response()->json("catégorie supprimée avec succes");
} catch (\Exception $e) {
return response()->json("probleme de suppression de catégorie {$e->getMessage()}");
}
}

    public function articlesPaginate()
    {
    try {
    $perPage = request()->input('pageSize', 10);
    // Récupère la valeur dynamique pour la pagination
    $articles = Article::with('scategorie')->paginate($perPage);
    // Retourne le résultat en format JSON API
    return response()->json([
    'products' => $articles->items(), // Les articles paginés
    'totalPages' => $articles->lastPage(), // Le nombre de pages
    ]);
    } catch (\Exception $e) {
    return response()->json("Selection impossible {$e->getMessage()}");
    }
    }
}
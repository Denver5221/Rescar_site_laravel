<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Categorie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Categorie::all();
            return view('pages.actualites.categorie',  ['categories'=>$categories,'title' => 'Categories - Actualités | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

            // return view('pages.rescar-aoc.partenaire', );

            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la récupération des donnees. Veuillez verifier votre connexion internet'])->withInput();
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        try {

            $messages = [
                'nom.required' => 'Le champ nom de categorie est obligatoire.',
            ];

            $validatedData = $request->validate([
                'nom' => 'required',
            ], $messages);
            DB::beginTransaction();


            $categorie = new Categorie();
            $categorie->id_user = auth()->user()->id;
            $categorie->nom = $validatedData['nom'];
            $slug = Str::slug($categorie->nom . ' ' . time());
            $categorie->slug = $slug;
            $categorie->save();
                // Traiter l'image si elle est présente

            /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Cette categorie été ajouté: '.$categorie->nom;
            $activity->type = 't-warning';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();

            DB::commit();


            // return redirect()->route('partenaire')->with('success', 'Partenaire a été créé avec succès!');
            session()->flash('success', 'Categorie ajouté avec succès');
            return redirect()->route('categories.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }

             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

             session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout: ' . $errorsString);

             return redirect()->back()->withErrors($errors)->withInput();

            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());

                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout . Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {

            $messages = [
                'nom.required' => 'Le champ nom de categorie est obligatoire.',
            ];

            $validatedData = $request->validate([
                'nom' => 'required',
            ], $messages);
            DB::beginTransaction();
              // Trouver le poste à mettre à jour
              $categorie = Categorie::findOrFail($id);

              // Mettre à jour les attributs du poste

            $categorie->id_user = auth()->user()->id;
            $categorie->nom = $validatedData['nom'];
            $slug = Str::slug($categorie->nom . ' ' . time());
            $categorie->slug = $slug;
            $categorie->save();
                // Traiter l'image si elle est présente


            DB::commit();


            // return redirect()->route('partenaire')->with('success', 'Partenaire a été créé avec succès!');
            session()->flash('success', 'categorie Modifier avec succès');
            return redirect()->route('categories.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }

             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

             session()->flash('error', 'Une erreur s\'est produite lors de la modifiaction: ' . $errorsString);

             return redirect()->back()->withErrors($errors)->withInput();

            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());

                session()->flash('error', 'Une erreur s\'est produite lors de la modofication. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite lors de la modifiaction. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            // Chercher le partenaire par son ID
            $categorie = Categorie::findOrFail($id);

            // Supprimer le partenaire
            $categorie->delete();

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'une erreur sais produite, veuillez verifier votre connexion internet et reéssayer plutard.']);
        }
    }
}

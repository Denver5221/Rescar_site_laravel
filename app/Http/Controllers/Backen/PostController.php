<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $postes = Post::all();
            return view('pages.rescar-aoc.poste', ['postes'=>$postes, 'title' => 'Postes - Rescar-Aoc | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

            // return view('pages.rescar-aoc.partenaire', );

            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite.Veuillez réessayer plus tard ou contacter l\'assistance'])->withInput();
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
            $validatedData = $request->validate([
                'nom' => 'required',

            ]);

            DB::beginTransaction();


            $poste = new Post;
            $poste->id_user = auth()->user()->id;
            $poste->nom = $validatedData['nom'];

            $poste->save();
                // Traiter l'image si elle est présente

                       /////////////////////////////// historique
                       $activity = new Activity();
                       $activity->title = 'Un partenaire été ajouté: '.$poste->nom;
                       $activity->type = 't-warning';
                       $activity->icon = 'feather-plus';
                       $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
                       $activity->save();

            DB::commit();


            // return redirect()->route('partenaire')->with('success', 'Partenaire a été créé avec succès!');
            session()->flash('success', 'POst ajouté avec succès');
            return redirect()->route('poste');

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

                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout du membre. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout du membre. Veuillez réessayer plus tard ou contacter l\'assistance.');
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
            // Valider les données du formulaire de modification
        $validatedData = $request->validate([
            'nom' => 'required|max:225',
        ]);

        try {
            // Trouver le poste à mettre à jour
            $poste = Post::findOrFail($id);

            // Mettre à jour les attributs du poste
            $poste->nom = $request->input('nom');
            $poste->id_user = auth()->user()->id;
            $poste->save();

            return redirect()->back()->with('success', 'Le poste a été modifié avec succès.');
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

                session()->flash('error', 'Une erreur s\'est produite lors de la modification. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite lors de la modification. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $poste)
    {
        try {
            // Supprimer le partenaire
            $poste->delete();

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance']);
            }
    }

    }


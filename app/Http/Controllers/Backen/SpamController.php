<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Spam;
use App\Models\Thematique;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $spams = Spam::all();
            $thematiquesWithSpam = Thematique::where(function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select('id')
                        ->from('spam')
                        ->whereRaw("thematiques.thematique LIKE CONCAT('%', spam.nom, '%')")
                        ->orWhereRaw("thematiques.description LIKE CONCAT('%', spam.nom, '%')");
                });
            })
            ->get();

                 return view('pages.forum.spams', ['spams'=>$spams, 'thematiquesWithSpam'=>$thematiquesWithSpam,'title' => ' Spams - Forum | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

            // return view('pages.rescar-aoc.partenaire', );

            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Veuillez verifier votre connexion et réessayer plus tard ou contacter l\'assistance.'])->withInput();
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


            $spam = new Spam();
            $spam->id_user = auth()->user()->id;
            $spam->nom = $validatedData['nom'];
            $spam->save();
                 /////////////////////////////// historique
                 $activity = new Activity();
                 $activity->title = 'Un spam été ajouté: '.$spam->nom;
                 $activity->type = 't-danger';
                 $activity->icon = 'feather-plus';
                 $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
                 $activity->save();


            DB::commit();


            // return redirect()->route('partenaire')->with('success', 'Partenaire a été créé avec succès!');
            session()->flash('success', 'Spam ajouté avec succès');
            return redirect()->route('spams.index');


        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }

             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

             session()->flash('error', 'Une erreur s\'est produite : ' . $errorsString);

             return redirect()->back()->withErrors($errors)->withInput();

            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());

                session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
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
        // dd($request);
        try {

            $messages = [
                'nom.required' => 'Le champ nom de categorie est obligatoire.',
            ];

            $validatedData = $request->validate([
                'nom' => 'required',
            ], $messages);
            DB::beginTransaction();
              // Trouver le poste à mettre à jour
              $spam = Spam::findOrFail($id);

              // Mettre à jour les attributs du poste

            $spam->id_user = auth()->user()->id;
            $spam->nom = $validatedData['nom'];
            $spam->save();
                // Traiter l'image si elle est présente


            DB::commit();


            // return redirect()->route('partenaire')->with('success', 'Partenaire a été créé avec succès!');
            session()->flash('success', 'Spam Modifier avec succès');
            return redirect()->route('spams.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }

             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

             session()->flash('error', 'Une erreur s\'est produite : ' . $errorsString);

             return redirect()->back()->withErrors($errors)->withInput();

            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());

                session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
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
            $spam = Spam::findOrFail($id);

            // Supprimer le partenaire
            $spam->delete();

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' =>'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }
}

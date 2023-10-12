<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Partenaire;
use App\Models\Recrutement;
use App\Models\RecrutementPartenaire;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class RecrutementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $recrutement_partenaires = RecrutementPartenaire::join('partenaires', 'recrutement_partenaires.id_partenaire', '=', 'partenaires.id')
            ->select('recrutement_partenaires.*', 'partenaires.nom as partenaire_nom')
            ->get();

            $partenaires = Partenaire::all();
            $recrutements =Recrutement::all();

            return view('pages.rescar-aoc.recrutement', ['partenaires'=>$partenaires,'recrutements'=>$recrutements,'recrutement_partenaires'=>$recrutement_partenaires,'title' => 'Recrutements - Rescar-Aoc | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite veuillez plutard ou contacter l\'assistance'])->withInput();
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
                'image' => 'nullable|image|max:2048', // Exemple de règle de validation pour l'image
                'nom' => 'required|string',
                'description' => 'required|string',
                'file' => 'nullable',
            ]);
            // dd($validatedData);
            DB::beginTransaction();

            // Formatez le nom du fichier en utilisant le nom et le prénom
            $nom = $validatedData['nom'];
            // $id_partenaire = $validatedData['id_partenaire'];
            $nomFichier = Str::slug($nom . ' ' . time());

            // Téléchargez et sauvegardez la file
            if ($request->hasFile('file')) {
                $fichier = $request->file('file');
                $nomFichierAvecExtensionfile = $nomFichier . '.' . $fichier->getClientOriginalExtension();
                   $cheminDeDestination = public_path('storage/dossier_file_recrutement') . '/' . $nomFichierAvecExtensionfile;
                   $fichier->move(public_path('storage/dossier_file_recrutement'), $nomFichierAvecExtensionfile);
                // Enregistrez le chemin de la photo dans la base de données
                // $membre->photo = $cheminPhoto;
            }

            if ($request->hasFile('image')) {
                $fichier = $request->file('image');
                   $nomFichierAvecExtensionimage = $nomFichier . '.' . $fichier->getClientOriginalExtension();
                   $cheminDeDestination = public_path('storage/dossier_image_recrutement') . '/' . $nomFichierAvecExtensionimage;
                   $fichier->move(public_path('storage/dossier_image_recrutement'), $nomFichierAvecExtensionimage);
                // Enregistrez le chemin de la photo dans la base de données
                // $membre->photo = $cheminPhoto;
            }



            $recrutement = new Recrutement();
            $recrutement->id_user = auth()->user()->id;
            $recrutement->nom = $validatedData['nom'];
            $recrutement->description = $validatedData['description'];
            $recrutement->file ='dossier_file_recrutement/'. $nomFichierAvecExtensionfile;
            $recrutement->image ='dossier_image_recrutement/'. $nomFichierAvecExtensionimage;
            $slug = Str::slug($recrutement->nom . ' ' . time());
            $recrutement->slug = $slug;
            $recrutement->save();

             /////////////////////////////// historique
             $activity = new Activity();
             $activity->title = 'Un recrutement été ajouté: '.$recrutement->nom;
             $activity->type = 't-warning';
             $activity->icon = 'feather-plus';
             $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
             $activity->save();


            DB::commit();

            session()->flash('success', 'Recrutement  ajouté avec succès');
            return redirect()->route('recrutement');

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

        try {
                 // Récupérer le Recrutement à mettre à jour
        $recrutement = Recrutement::findOrFail($id);

           $validatedData = $request->validate([
                'nom' => 'required|string',
                'description' => 'required|string',
           ]);
           // dd($validatedData);
           DB::beginTransaction();

            // Vérifier si le champ 'photo' est présent et un fichier a été téléchargé
               if ($request->hasFile('file')) {
                   // Supprimer l'ancienne photo si elle existe
                   if ($recrutement->file) {
                       $image = public_path($recrutement->file);
                       if (file_exists($image)) {
                           unlink($image);
                       }
                   }

                    // Formatez le nom du fichier en utilisant le nom et le prénom
                   $nom = $validatedData['nom'];
                   $nomFichier = Str::slug($nom . ' ' . time());
                   // Télécharger et sauvegarder la nouvelle photo
                   $fichier = $request->file('file');
                   $nomFichierAvecExtension = $nomFichier . '.' . $fichier->getClientOriginalExtension();
                   $cheminDeDestination = public_path('storage/dossier_file_recrutement') . '/' . $nomFichierAvecExtension;
                   $fichier->move(public_path('storage/dossier_file_recrutement'), $nomFichierAvecExtension);
                //    $cheminfichierfile = $fichier->storeAs('dossier_file_recrutement', $nomFichier . '.' . $fichier->getClientOriginalExtension(), 'public');
                   // Enregistrez le chemin de la photo dans la base de données
                   $recrutement->file ='dossier_file_recrutement/'. $nomFichierAvecExtension;
               }

               if ($request->hasFile('image')) {
                // Supprimer l'ancienne photo si elle existe
                if ($recrutement->image) {
                    $image = public_path($recrutement->image);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                 // Formatez le nom du fichier en utilisant le nom et le prénom
                 $nom = $validatedData['nom'];
                 $nomFichier = Str::slug($nom . ' ' . time());
                 // Télécharger et sauvegarder la nouvelle photo
                $fichier = $request->file('image');

                $nomFichierAvecExtension = $nomFichier . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_image_recrutement') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_image_recrutement'), $nomFichierAvecExtension);
                // $cheminFileimage = $fichier->storeAs('dossier_image_recrutement', $nomFichier . '.' . $fichier->getClientOriginalExtension(), 'public');
                // Enregistrez le chemin de la photo dans la base de données
                $recrutement->image = 'dossier_image_recrutement/'.$nomFichierAvecExtension;

            }





            // Mettre à jour les autres champs du membre
            $recrutement->id_user = auth()->user()->id;
            $recrutement->nom = $validatedData['nom'];
            $recrutement->description = $validatedData['description'];
            $slug = Str::slug($recrutement->nom . ' ' . time());
            $recrutement->slug = $slug;
            // Enregistrer les modifications
            $recrutement->save();

           DB::commit();

           session()->flash('success', 'Recrutement modifier avec succès');
           return redirect()->route('recrutement');

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

    //////////////////////// changer de staut
    public function updateStatus(Request $request, $recrutementId)
    {

        try {
            $recrutement = Recrutement::findOrFail($recrutementId);

            if ($recrutement->status == 1) {

            // Mettre à jour le statut du partenaire
            $recrutement->status = 0;
            $recrutement->save();
            }else {
                // Mettre à jour le statut du partenaire
            $recrutement->status = 1;
            $recrutement->save();
            }
            // Répondre avec succès
            return response()->json(['success' => true]);

            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => ' Veuillez verifier votre connexion et réessayer plus tard ou contacter l\'assistance']);
            }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Recrutement $recrutement)
    {
        try {
            // Supprimer le partenaire
            $recrutement->delete();
            $image = public_path('storage/' .$recrutement->image);
                if (file_exists($image)) {
                    unlink($image);
                }
            // Storage::delete('public/' . $recrutement->image);
            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => ' Veuillez verifier votre connexion et réessayer plus tard ou contacter l\'assistance']);
            }
    }
}

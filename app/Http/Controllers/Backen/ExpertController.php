<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Expert;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $experts = Expert::all();


             return view('pages.repertoires.experts', ['experts'=>$experts, 'title' => 'Membres - Rescar-Aoc | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite : Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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
                'photo' => 'nullable|mimes:jpeg,png,gif|max:2048',
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'email' => 'required|string|email',
                'telephone' => 'required',
                'facebook' => 'nullable|string|',
                'linkedin' => 'nullable|string|',
            ]);
            // dd($validatedData);
            DB::beginTransaction();

            // Formatez le nom du fichier en utilisant le nom et le prénom
            $nom = $validatedData['nom'];
            $prenom = $validatedData['prenom'];
            $nomFichier = Str::slug($prenom . ' ' . $nom);

            // Téléchargez et sauvegardez la photo
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $nomFichierAvecExtension = $nomFichier . '.' . $photo->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_photos') . '/' . $nomFichierAvecExtension;
                    $photo->move(public_path('storage/dossier_photos'), $nomFichierAvecExtension);
            }
            // Téléchargez et sauvegardez le CV



            $expert = new Expert();
            $expert->id_user = auth()->user()->id;
            $expert->nom = $validatedData['nom'];
            $expert->prenom = $validatedData['prenom'];
            $expert->email = $validatedData['email'];
            $expert->telephone = $validatedData['telephone'];
            $expert->facebook = $validatedData['facebook'];
            $expert->linkedin = $validatedData['linkedin'];
            $expert->photo = 'dossier_photos/'.$nomFichierAvecExtension;
            $slug = Str::slug($expert->nom . ' ' . $expert->prenom . ' ' . $expert->email);
            $expert->slug = $slug;
            // dd($expert);
            $expert->save();

            /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Un expert été ajouté:'.$expert->nom;
            $activity->type = 't-danger';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();
            DB::commit();

            session()->flash('success', 'experts ajouté avec succès');
            return redirect()->route('experts');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }

             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

             session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout du membre : ' . $errorsString);

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
        try {
           $validatedData = $request->validate([
               'nom' => 'required|string',
               'prenom' => 'required|string',
               'email' => 'required|string|email',
               'telephone' => 'required|integer',
               'facebook' => 'nullable|string|',
               'linkedin' => 'nullable|string|',
           ]);
           // dd($validatedData);
           DB::beginTransaction();
        //    Nb: $membre =$expert
           $membre = Expert::findOrFail($id);


            // Vérifier si le champ 'photo' est présent et un fichier a été téléchargé
               if ($request->hasFile('photo')) {
                   // Supprimer l'ancienne photo si elle existe
                   if ($membre->photo) {
                    $image = public_path($membre->photo);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                 }

                    // Formatez le nom du fichier en utilisant le nom et le prénom
                   $nom = $validatedData['nom'];
                   $prenom = $validatedData['prenom'];
                   $nomFichier = Str::slug($prenom . ' ' . $nom);
                   // Télécharger et sauvegarder la nouvelle photo
                   $photo = $request->file('photo');
                   $nomFichierAvecExtension = $nomFichier . '.' . $photo->getClientOriginalExtension();
                   $cheminDeDestination = public_path('storage/dossier_photos') . '/' . $nomFichierAvecExtension;
                   $photo->move(public_path('storage/dossier_photos'), $nomFichierAvecExtension);
                   // Enregistrez le chemin de la photo dans la base de données
                   $membre->photo = 'dossier_photos/'.$nomFichierAvecExtension;
               }






            // Mettre à jour les autres champs du membre
           $membre->nom = $validatedData['nom'];
           $membre->prenom = $validatedData['prenom'];
           $membre->email = $validatedData['email'];
           $membre->telephone = $validatedData['telephone'];
           $membre->facebook = $validatedData['facebook'];
           $membre->linkedin = $validatedData['linkedin'];
            // Enregistrer les modifications
           $membre->save();

           DB::commit();

           session()->flash('success', 'Expert modifier avec succès');
           return redirect()->route('experts');

       } catch (\Illuminate\Validation\ValidationException $e) {
           DB::rollBack();
            $errors = $e->errors();
            $errorsString = '';
            foreach ($errors as $fieldErrors) {
                $errorsString .= implode(', ', $fieldErrors) . ', ';
            }

            $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

            session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout : ' . $errorsString);

            return redirect()->back()->withErrors($errors)->withInput();

           } catch (QueryException $e) {
               // Gérer les erreurs de base de données
               // ...
               // Loguer l'erreur
               Log::error($e->getMessage());

               session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout. Veuillez réessayer plus tard ou contacter l\'assistance.');
               return redirect()->back();
           } catch (\Exception $e) {
               // Gérer d'autres types d'erreurs
               // ...

               session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout. Veuillez réessayer plus tard ou contacter l\'assistance.');
               return redirect()->back();
           }
    }

    public function updateStatus(Request $request, $id)
    {

        try {

            $expert = Expert::findOrFail($id);

            if ($expert->status == 1) {

            // Mettre à jour le statut du partenaire
            $expert->status = 0;
            $expert->save();
            }else {
                // Mettre à jour le statut du expert
            $expert->status = 1;
            $expert->save();
            }
            // Répondre avec succès
            return response()->json(['success' => true]);

            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Une erreur s\'est produite lors du changement de status. Veuillez réessayer plus tard ou contacter l\'assistance.']);
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
            // Supprimer le partenaire
            $expert = Expert::findOrFail($id);

            $expert->delete();
            $image = public_path('storage/' .$expert->photo);
            if (file_exists($image)) {
                unlink($image);
            }
            // Storage::delete('public/' .$expert->photo);

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Une erreur s\'est produite lors de la suppression. Veuillez réessayer plus tard ou contacter l\'assistance.']);
            }
    }
}

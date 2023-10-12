<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Membre;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MembreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $membres = Membre::join('posts', 'membres.id_post', '=', 'posts.id')
            ->select('membres.*', 'posts.nom as post_nom')
            ->get();

            $postes = Post::all();

             return view('pages.rescar-aoc.membre', ['membres'=>$membres, 'postes'=>$postes, 'title' => 'Membres - Rescar-Aoc | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


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
                'id_post' => 'required',
                'email' => 'required|string|email',
                'telephone' => 'required|',
                'facebook' => 'nullable|string|',
                'linkedin' => 'nullable|string|',
                'cv' => 'nullable',
            ]);
            // dd($validatedData);
            DB::beginTransaction();

            // Formatez le nom du fichier en utilisant le nom et le prénom
            $nom = $validatedData['nom'];
            $prenom = $validatedData['prenom'];
            $nomFichier = Str::slug($prenom . ' ' . $nom);




            $membre = new Membre();
            $membre->id_user = auth()->user()->id;
            $membre->nom = $validatedData['nom'];
            $membre->prenom = $validatedData['prenom'];
            $membre->id_post = $validatedData['id_post'];
            $membre->email = $validatedData['email'];
            $membre->telephone = $validatedData['telephone'];
            $membre->facebook = $validatedData['facebook'];
            $membre->linkedin = $validatedData['linkedin'];
            // $membre->photo = $cheminPhoto;
            // $membre->cv =$cheminCV;
            $slug = Str::slug($membre->nom . ' ' . $membre->prenom . ' ' . $membre->email);
            $membre->slug = $slug;
            // Téléchargez et sauvegardez la photo
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $nomFichierAvecExtension = $nomFichier . '.' . $photo->getClientOriginalExtension();
                $cheminDeDestination = public_path('photoMembre') . '/' . $nomFichierAvecExtension;
                $photo->move(public_path('photoMembre'), $nomFichierAvecExtension);

                // Enregistrez le chemin de la photo dans la base de données
                $membre->photo = 'photoMembre/' . $nomFichierAvecExtension;
            }
            // Téléchargez et sauvegardez le CV
            if ($request->hasFile('cv')) {
                $cv = $request->file('cv');
                $nomFichierAvecExtension = $nomFichier . '.' . $cv->getClientOriginalExtension();
                $cheminDeDestination = public_path('dossier_cv') . '/' . $nomFichierAvecExtension;
                $photo->move(public_path('dossier_cv'), $nomFichierAvecExtension);
                // Enregistrez le chemin du CV dans la base de données
                $membre->cv = 'dossier_cv/' . $nomFichierAvecExtension;
            }
            $membre->save();

            /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Un membre été ajouté:'.$membre->nom;
            $activity->type = 't-danger';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();
            DB::commit();

            session()->flash('success', 'Membre ajouté avec succès');
            return redirect()->route('membre');

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
         // Récupérer le membre à mettre à jour
             $membre = Membre::findOrFail($id);
             try {
                $validatedData = $request->validate([
                    'nom' => 'required|string',
                    'prenom' => 'required|string',
                    'id_post' => 'required',
                    'email' => 'required|string|email',
                    'telephone' => 'required|',
                    'facebook' => 'nullable|string|',
                    'linkedin' => 'nullable|string|',
                ]);
                // dd($validatedData);
                DB::beginTransaction();

                 // Vérifier si le champ 'photo' est présent et un fichier a été téléchargé
                    if ($request->hasFile('photo')) {
                        // Supprimer l'ancienne photo si elle existe
                        if ($membre->photo) {
                            $photoPath = public_path($membre->photo);
                            if (file_exists($photoPath)) {
                                unlink($photoPath);
                                }
                        }

                         // Formatez le nom du fichier en utilisant le nom et le prénom
                        $nom = $validatedData['nom'];
                        $prenom = $validatedData['prenom'];
                        $nomFichier = Str::slug($prenom . ' ' . $nom);
                        // Télécharger et sauvegarder la nouvelle photo
                        $photo = $request->file('photo');
                        $nomFichierAvecExtension = $nomFichier . '.' . $photo->getClientOriginalExtension();
                        $cheminDeDestination = public_path('photoMembre') . '/' . $nomFichierAvecExtension;
                        $photo->move(public_path('photoMembre'), $nomFichierAvecExtension);

                        // Enregistrez le chemin de la photo dans la base de données
                        $membre->photo = 'photoMembre/' . $nomFichierAvecExtension;
                    }


                     // Vérifier si le champ 'cv' est présent et un fichier a été téléchargé
                    if ($request->hasFile('cv')) {
                        // Supprimer l'ancien CV s'il existe
                        if ($membre->cv) {
                            $cvPath = public_path($membre->cv);
                            if (file_exists($cvPath)) {
                                unlink($cvPath);
                                }
                        }
                        // Formatez le nom du fichier en utilisant le nom et le prénom
                        $nom = $validatedData['nom'];
                        $prenom = $validatedData['prenom'];
                        $nomFichier = Str::slug($prenom . ' ' . $nom);

                        // Télécharger et sauvegarder le nouveau CV
                        $cv = $request->file('cv');
                        $cvAvecExtension = $nomFichier . '.' . $cv->getClientOriginalExtension();
                        $cheminDeDestination = public_path('dossier_cv') . '/' . $cvAvecExtension;
                        $cv->move(public_path('dossier_cv'), $cvAvecExtension);
                        // Enregistrez le chemin du CV dans la base de données
                        $membre->cv = 'dossier_cv/' . $cvAvecExtension;
                    }



                 // Mettre à jour les autres champs du membre
                $membre->nom = $validatedData['nom'];
                $membre->prenom = $validatedData['prenom'];
                $membre->id_post = $validatedData['id_post'];
                $membre->email = $validatedData['email'];
                $membre->telephone = $validatedData['telephone'];
                $membre->facebook = $validatedData['facebook'];
                $membre->linkedin = $validatedData['linkedin'];
                 // Enregistrer les modifications
                $membre->save();

                DB::commit();

                session()->flash('success', 'Membre modifier avec succès');
                return redirect()->route('membre');

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

     //////////////////////// changer de staut
     public function updateStatus(Request $request, $membreId)
     {

         try {
             $membre = Membre::findOrFail($membreId);

             if ($membre->status == 1) {

             // Mettre à jour le statut du partenaire
             $membre->status = 0;
             $membre->save();
             }else {
                 // Mettre à jour le statut du membre
             $membre->status = 1;
             $membre->save();
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
    public function destroy(Request $request, Membre $membre)
    {
        try {
            // Supprimer le partenaire
            $membre->delete();
            $cvPath = public_path($membre->cv);
            $photoPath = public_path($membre->photo);

            if (file_exists($cvPath)) {
                unlink($cvPath);
            }

            if (file_exists($photoPath)) {
                unlink($photoPath);
            }

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Une erreur s\'est produite lors de la suppression. Veuillez réessayer plus tard ou contacter l\'assistance.']);
            }
    }
}

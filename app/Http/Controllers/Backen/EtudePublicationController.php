<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\EtudePublication;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EtudePublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $etudes = EtudePublication::select('titre','description','file_fr' , 'image', 'status', 'id', 'slug', 'created_at')->get();
            return view('pages.ressources.etudes',  ['etudes'=>$etudes,'title' => 'Etudes et publications - Ressources ', 'breadcrumb' => 'This Breadcrumb']);
            // return view('pages.actualites.actualites',  ['title' => 'Actualités | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la récupération des donnees, Veuillez verifier votre connexion et reéssayer plutard.'])->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Categorie::pluck('nom')->toArray();
            return view('pages.ressources.ajouteretudes', ['categories'=>$categories ,'title' => ' Ajouter - Etudes et publications - Ressources | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite veuillez verifier votre connexion et reéssayer plutart.'])->withInput();
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //    dd($request->file('image'), $request);

        try {



            $validatedData = $request->validate([
                'titre' => 'required|string',
                'description' => 'required',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'tags' => 'nullable|array',
                'image' => 'nullable|image|max:2048', // Exemple de règle de validation pour l'image
                'file_fr' => 'nullable|file|max:2048',
                'file_an' => 'nullable|file|max:2048',
                'file_pr' => 'nullable|file|max:2048',
            ]);




            DB::beginTransaction();

            // Créer une nouvelle instance d'Actualite
            $etudePublication = new EtudePublication();
            $etudePublication->id_user = auth()->user()->id;
            $etudePublication->titre = $validatedData['titre'];
            $etudePublication->description = $validatedData['description'];
            $etudePublication->meta_title = $validatedData['meta_title'];
            $etudePublication->meta_description = $validatedData['meta_description'];

            // Enregistrer les tags dans le modèle
            $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

            $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

            // Assuming you have an instance of the etudePublication model, you can set the tags attribute and save the model
            $etudePublication->tags = $tags;

            // Gérer l'image si elle est présente
            // if ($request->hasFile('image')) {
            //     $cheminFile = Str::slug($etudePublication->titre . ' ' . time());
            //     $fichier = $request->file('image');
            //     $cheminImage = $fichier->storeAs('dossier_file_etudePublication', $cheminFile . '.' . $fichier->getClientOriginalExtension(), 'public');
            //     $etudePublication->image = $cheminImage;
            // }
            // Gérer l'image si elle est présente
            if ($request->hasFile('image')) {
                $cheminFile = Str::slug($etudePublication->titre . ' ' . time());
                $fichier = $request->file('image');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                $etudePublication->image ='dossier_file_etudePublication/'. $nomFichierAvecExtension;
            }

            if ($request->hasFile('file_fr')) {
                $cheminFile = Str::slug($etudePublication->titre . ' ' . time());
                $fichier = $request->file('file_fr');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                $etudePublication->file_fr = 'dossier_file_etudePublication/'.$nomFichierAvecExtension;
            }

            if ($request->hasFile('file_an')) {
                $cheminFile = Str::slug($etudePublication->titre . ' ' . time());
                $fichier = $request->file('file_an');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                $etudePublication->file_an = 'dossier_file_etudePublication/'. $nomFichierAvecExtension;
            }

            if ($request->hasFile('file_pr')) {
                $cheminFile = Str::slug($etudePublication->titre . ' ' . time());
                $fichier = $request->file('file_pr');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                $etudePublication->file_pr = 'dossier_file_etudePublication/'. $nomFichierAvecExtension;
            }



            // Gérer le champ active_commentaire
            $etudePublication->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $etudePublication->status = boolval($request->input('status'));


            $slug = Str::slug($etudePublication->titre . '' . time());
            $etudePublication->slug = $slug;

            $etudePublication->save();




            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $etudePublication->categories()->attach($etudePublication->id, ['id_category' => $category->id]);
                }
            }


            /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Cette etude de publication été ajouté: '.$etudePublication->titre;
            $activity->type = 't-warning';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();


            DB::commit();

            session()->flash('success', 'Etude de Publication créée avec succès');
            return redirect()->route('etudes.index');

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
    public function edit($slug)
    {
        try {
            // Récupérer le forum à éditer en utilisant le slug
            $etudes = EtudePublication::where('slug', $slug)->firstOrFail();
            $categories = Categorie::pluck('nom')->toArray();
            $tags = json_decode($etudes->tags, true); // Convertir les tags en tableau


            // dd($actualite);

            return view('pages.ressources.modifieretudes', ['tags'=>$tags,'categories'=>$categories,'etudes'=>$etudes,'title' => 'Modifier - ETUDE | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite, veuillez verifier votre connexion et reéssayer plutard.'])->withInput();
        }
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
        // dd($request, $request->file('image'));
        try {


            $validatedData = $request->validate([
                'titre' => 'required|string',
                'description' => 'required',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'tags' => 'nullable|array',
                'image' => 'nullable|image|max:2048', // Exemple de règle de validation pour l'image
                'file_fr' => 'nullable|file|max:2048',
                'file_an' => 'nullable|file|max:2048',
                'file_pr' => 'nullable|file|max:2048',
            ]);




            DB::beginTransaction();
            $etude = EtudePublication::findOrFail($id);


            // if ($request->hasFile('image')) {
            //     // Supprimer l'ancienne photo si elle existe
            //     if ($etude->file) {
            //         Storage::delete('public/' . $etude->image);

            //     }

            //      // Formatez le nom du fichier en utilisant le nom et le prénom
            //       // Gérer l'image si elle est présente
            //         $cheminFile = Str::slug($etude->titre . ' ' . time());
            //         $fichier = $request->file('image');
            //         $cheminImage = $fichier->storeAs('dossier_file_etudePublication', $cheminFile . '.' . $fichier->getClientOriginalExtension(), 'public');
            //         $etude->image = $cheminImage;

            // }
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne photo si elle existe
                if ($etude->file) {
                    $image = public_path($etude->image);
                    if (file_exists($image)) {
                        unlink($image);
                    }

                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                  // Gérer l'image si elle est présente
                    $cheminFile = Str::slug($etude->titre . ' ' . time());
                    $fichier = $request->file('image');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                    $etude->image = 'dossier_file_etudePublication/'. $nomFichierAvecExtension;

            }

            if ($request->hasFile('file_fr')) {
                // Supprimer l'ancienne photo si elle existe
                if ($etude->file) {
                    $image = public_path($etude->file_fr);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                  // Gérer l'file_fr si elle est présente
                    $cheminFile = Str::slug($etude->titre . ' ' . time().'an');
                    $fichier = $request->file('file_fr');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                    $etude->file_fr = 'dossier_file_etudePublication/'. $nomFichierAvecExtension;

            }
            if ($request->hasFile('file_an')) {
                // Supprimer l'prcienne photo si elle existe
                if ($etude->file) {
                    $image = public_path($etude->file_an);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisprt le nom et le prénom
                  // Gérer l'file_an si elle est présente
                    $cheminFile = Str::slug($etude->titre . ' ' . time().'pr');
                    $fichier = $request->file('file_an');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                    $etude->file_an = 'dossier_file_etudePublication/'. $nomFichierAvecExtension;


            }
            if ($request->hasFile('file_pr')) {
                // Supprimer l'prcienne photo si elle existe
                if ($etude->file) {
                    // Storage::delete('public/' . $etude->file_pr);
                    $image = public_path($etude->file_pr);
                    if (file_exists($image)) {
                        unlink($image);
                    }

                }

                 // Formatez le nom du fichier en utilisprt le nom et le prénom
                  // Gérer l'file_pr si elle est présente
                    $cheminFile = Str::slug($etude->titre . ' ' . time().'pr');
                    $fichier = $request->file('file_pr');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_etudePublication') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_etudePublication'), $nomFichierAvecExtension);

                    $etude->file_pr = 'dossier_file_etudePublication/'. $nomFichierAvecExtension;

            }


            // Créer une nouvelle instance d'Actualite
            $etude->id_user = auth()->user()->id;
            $etude->titre = $validatedData['titre'];
            $etude->description = $validatedData['description'];
            $etude->meta_title = $validatedData['meta_title'];
            $etude->meta_description = $validatedData['meta_description'];

             // Enregistrer les tags dans le modèle
             $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

             $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

             // Assuming you have an instance of the etude model, you can set the tags attribute and save the model
             $etude->tags = $tags;



            // Gérer le champ active_commentaire
            $etude->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $etude->status = boolval($request->input('status'));


            $slug = Str::slug($etude->titre . ' ' . time());
            $etude->slug = $slug;





            // Supprimer toutes les catégories actuelles de l'actualité
            $etude->categories()->detach();

            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $etude->categories()->attach($etude->id, ['id_category' => $category->id]);
                }
            }


            $etude->save();


            DB::commit();

            session()->flash('success', 'Actualité créée avec succès');
            return redirect()->route('etudes.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }

             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

             session()->flash('error', 'Une erreur s\'est produite lors de la modification: ' . $errorsString);

             return redirect()->back()->withErrors($errors)->withInput();

            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());

                session()->flash('error', 'Une erreur s\'est produite lors de la modification . Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite lors de la modification. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            }
    }

    //////////////////////// changer de staut
    public function updateStatus(Request $request, $id)
    {
            // dd($id);
        try {
            $etude = EtudePublication::findOrFail($id);

            if ($etude->status == 1) {

            // Mettre à jour le statut du partenaire
            $etude->status = 0;
            $etude->save();
            }else {
                // Mettre à jour le statut du partenaire
            $etude->status = 1;
            $etude->save();
            }
            // Répondre avec succès
            return response()->json(['success' => true]);

            } catch (\Exception $e) {
                // dd($e->getMessage(),);
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Veuillez verifier votre connxion internet de et ressayer plutard']);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Chercher le partenaire par son ID
            $etude = EtudePublication::findOrFail($id);

            // Supprimer le partenaire

            $etude->delete();

            if ($etude->image) {
                // Storage::delete('public/' . $etude->image);
                $image = public_path('storage/' .$etude->image);
                if (file_exists($image)) {
                    unlink($image);
                }

            }
            if ($etude->file_an) {
                // Storage::delete('public/' . $etude->file_an);
                $image = public_path('storage/' .$etude->file_an);
                if (file_exists($image)) {
                    unlink($image);
                }
            }
            if ($etude->file_pr) {
                // Storage::delete('public/' . $etude->file_pr);
                $image = public_path('storage/' .$etude->file_pr);
                if (file_exists($image)) {
                    unlink($image);
                }
            }
            if ($etude->file_fr) {
                // Storage::delete('public/' . $etude->file_fr);
                $image = public_path('storage/' .$etude->file_fr);
                if (file_exists($image)) {
                    unlink($image);
                }
            }


            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez verifier votre connxion et reésssayer plutard']);
        }
    }
}

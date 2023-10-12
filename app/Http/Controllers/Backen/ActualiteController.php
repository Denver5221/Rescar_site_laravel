<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Actualite;
use App\Models\Categorie;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ActualiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $actualites = Actualite::select('titre', 'image', 'status', 'id', 'slug', 'created_at')->get();
            return view('pages.actualites.actualites',  ['actualites'=>$actualites,'title' => 'Actualités | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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
            return view('pages.actualites.ajouteractualite', ['categories'=>$categories ,'title' => 'Ajouter - Actualités | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

            // return view('pages.rescar-aoc.partenaire', );

            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite Veuillez réessayer plus tard ou contacter l\'assistance..'])->withInput();
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
                'blog-description-2' => 'required',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'tags' => 'nullable|array',
                'image' => 'nullable|image|max:2048', // Exemple de règle de validation pour l'image

            ]);




            DB::beginTransaction();

            // Créer une nouvelle instance d'Actualite
            $actualite = new Actualite();
            $actualite->id_user = auth()->user()->id;
            $actualite->titre = $validatedData['titre'];
            $actualite->contenu = $validatedData['blog-description-2'];
            $actualite->meta_title = $validatedData['meta_title'];
            $actualite->meta_description = $validatedData['meta_description'];

             // Enregistrer les tags dans le modèle
             $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

             $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

             // Assuming you have an instance of the Actualite model, you can set the tags attribute and save the model
             $actualite->tags = $tags;

            // Gérer l'image si elle est présente
            if ($request->hasFile('image')) {
                $cheminFile = Str::slug($actualite->titre . ' ' . time());
                $fichier = $request->file('image');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_actualiter') . '/' . $nomFichierAvecExtension;

                    $fichier->move(public_path('storage/dossier_file_actualiter'), $nomFichierAvecExtension);

                    $actualite->image = 'dossier_file_actualiter/'. $nomFichierAvecExtension;
            }



            // Gérer le champ active_commentaire
            $actualite->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $actualite->status = boolval($request->input('status'));


            $slug = Str::slug($actualite->titre . ' ' . time());
            $actualite->slug = $slug;

            $actualite->save();




            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $actualite->categories()->attach($actualite->id, ['id_category' => $category->id]);
                }
            }

             /////////////////////////////// historique
             $activity = new Activity();
             $activity->title = 'Une nouvelle activité a été créé:'.$actualite->titre;
             $activity->type = 't-secondary';
             $activity->icon = 'feather-file';
             $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
             $activity->save();



            DB::commit();

            session()->flash('success', 'Actualité créée avec succès');
            return redirect()->route('actualites.index');

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
    public function show($slug)
    {
        try {
            // Récupérer le forum à éditer en utilisant le slug
            $actualite = Actualite::where('slug', $slug)->firstOrFail();
            $categories = Categorie::pluck('nom')->toArray();
            $tags = json_decode($actualite->tags, true); // Convertir les tags en tableau


            // dd($actualite);

            return view('pages.actualites.modifieractualite', ['tags'=>$tags,'categories'=>$categories,'actualite'=>$actualite,'title' => 'Modifier - Actualités | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
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
        // dd($request, $request->file('image'));
        try {

            $messages = [
                // Messages de validation personnalisés si nécessaire
                'titre.required'=> 'le champ titre est obligatoire',
                'blog-description-2.required'=> 'le champ blog-description-2 est obligatoire',
                'meta_title.required'=> 'le champ meta_title est obligatoire',
                'meta_description.required'=> 'le champ titre est obligatoire',
                'tags.required'=> 'le champ tags est obligatoire',
                'image.required'=> 'le champ image est obligatoire',
                'category.required'=> 'le champ category est obligatoire',

            ];

            $validatedData = $request->validate([
                'titre' => 'required|string',
                'blog-description-2' => 'required',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'tags' => 'nullable|array',
                'image' => 'nullable|image|max:2048', // Exemple de règle de validation pour l'image

            ], $messages);




            DB::beginTransaction();
            $actualite = Actualite::findOrFail($id);


            if ($request->hasFile('image')) {
                // Supprimer l'ancienne photo si elle existe
                if ($actualite->image) {
                    $image = public_path($actualite->image);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                  // Gérer l'image si elle est présente
                    $cheminFile = Str::slug($actualite->titre . ' ' . time());
                    $fichier = $request->file('image');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_actualiter') . '/' . $nomFichierAvecExtension;

                    $fichier->move(public_path('storage/dossier_file_actualiter'), $nomFichierAvecExtension);

                    $actualite->image = 'dossier_file_actualiter/'. $nomFichierAvecExtension;

            }


            // Créer une nouvelle instance d'Actualite
            $actualite->id_user = auth()->user()->id;
            $actualite->titre = $validatedData['titre'];
            $actualite->contenu = $validatedData['blog-description-2'];
            $actualite->meta_title = $validatedData['meta_title'];
            $actualite->meta_description = $validatedData['meta_description'];

             // Enregistrer les tags dans le modèle
             $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

             $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

             // Assuming you have an instance of the Actualite model, you can set the tags attribute and save the model
             $actualite->tags = $tags;



            // Gérer le champ active_commentaire
            $actualite->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $actualite->status = boolval($request->input('status'));


            $slug = Str::slug($actualite->titre . ' ' . time());
            $actualite->slug = $slug;





            // Supprimer toutes les catégories actuelles de l'actualité
            $actualite->categories()->detach();

            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $actualite->categories()->attach($actualite->id, ['id_category' => $category->id]);
                }
            }


            $actualite->save();
                /////////////////////////////// historique
             $activity = new Activity();
             $activity->title = 'Une activité a été modifier:'.$actualite->titre;
             $activity->type = 't-warning';
             $activity->icon = 'feather-file';
             $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
             $activity->save();

            DB::commit();

            session()->flash('success', 'Actualité créée avec succès');
            return redirect()->route('actualites.index');


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

                session()->flash('error', 'Une erreur s\'est produite lors de la modification. Veuillez réessayer plus tard ou contacter l\'assistance.');
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
            $actualite = Actualite::findOrFail($id);

            if ($actualite->status == 1) {

            // Mettre à jour le statut du partenaire
            $actualite->status = 0;
            $actualite->save();
            }else {
                // Mettre à jour le statut du partenaire
            $actualite->status = 1;
            $actualite->save();
            }
            // Répondre avec succès
            return response()->json(['success' => true]);

            } catch (\Exception $e) {
                // dd($e->getMessage(),);
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
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
            $actualite = Actualite::findOrFail($id);

            // Supprimer le partenaire
            $actualite->delete();
            $image = public_path('storage/' .$actualite->image);
            if (file_exists($image)) {
                unlink($image);
            }
            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }
}

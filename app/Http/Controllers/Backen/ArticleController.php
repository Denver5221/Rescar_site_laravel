<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $articles = Article::select('titre','description', 'image', 'status', 'id', 'slug', 'created_at')->get();
            return view('pages.ressources.articles',  ['articles'=>$articles,'title' => 'Etudes et publications - Ressources ', 'breadcrumb' => 'This Breadcrumb']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors, Veuillez reéssayer plutard ou contacter l\'assistance.'])->withInput();
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
            return view('pages.ressources.ajouterarticles', ['categories'=>$categories ,'title' => ' Ajouter - Fiches d\'expériences - Ressources | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite. Veuillez reéssayer plutard ou contacter l\'assistance.'])->withInput();
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

            // Créer une nouvelle instance
            $article = new Article();
            $article->id_user = auth()->user()->id;
            $article->titre = $validatedData['titre'];
            $article->description = $validatedData['description'];
            $article->meta_title = $validatedData['meta_title'];
            $article->meta_description = $validatedData['meta_description'];

            // Enregistrer les tags dans le modèle
            $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

            $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

            // Assuming you have an instance of the article model, you can set the tags attribute and save the model
            $article->tags = $tags;

            // Gérer l'image si elle est présente
            if ($request->hasFile('image')) {
                $cheminFile = Str::slug($article->titre . ' ' . time());
                $fichier = $request->file('image');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                $article->image ='dossier_file_article/'. $nomFichierAvecExtension;
            }

            if ($request->hasFile('file_fr')) {
                $cheminFile = Str::slug($article->titre . ' ' . time());
                $fichier = $request->file('file_fr');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                $article->file_fr = 'dossier_file_article/'.$nomFichierAvecExtension;
            }

            if ($request->hasFile('file_an')) {
                $cheminFile = Str::slug($article->titre . ' ' . time());
                $fichier = $request->file('file_an');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                $article->file_an = 'dossier_file_article/'. $nomFichierAvecExtension;
            }

            if ($request->hasFile('file_pr')) {
                $cheminFile = Str::slug($article->titre . ' ' . time());
                $fichier = $request->file('file_pr');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                $article->file_pr = 'dossier_file_article/'. $nomFichierAvecExtension;
            }



            // Gérer le champ active_commentaire
            $article->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $article->status = boolval($request->input('status'));


            $slug = Str::slug($article->titre . ' ' . time());
            $article->slug = $slug;

            $article->save();




            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $article->categories()->attach($article->id, ['id_category' => $category->id]);
                }
            }

            /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Une article a été créé:'.$article->titre;
            $activity->type = 't-danger';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();



            DB::commit();

            session()->flash('success', 'article de Publication créée avec succès');
            return redirect()->route('articles.index');

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
            $article = Article::where('slug', $slug)->firstOrFail();
            $categories = Categorie::pluck('nom')->toArray();
            $tags = json_decode($article->tags, true); // Convertir les tags en tableau


            // dd($actualite);

            return view('pages.ressources.modifierarticles', ['tags'=>$tags,'categories'=>$categories,'article'=>$article,'title' => 'Modifier - ETUDE | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite. Veuillez reéssayer plutard ou contacter l\'assistance.'])->withInput();
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
            $article = Article::findOrFail($id);


            if ($request->hasFile('image')) {
                // Supprimer l'ancienne photo si elle existe
                if ($article->file) {
                    $image = public_path($article->image);
                    if (file_exists($image)) {
                        unlink($image);
                    }

                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                  // Gérer l'image si elle est présente
                    $cheminFile = Str::slug($article->titre . ' ' . time());
                    $fichier = $request->file('image');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                    $article->image = 'dossier_file_article/'. $nomFichierAvecExtension;

            }

            if ($request->hasFile('file_fr')) {
                // Supprimer l'ancienne photo si elle existe
                if ($article->file) {
                    $image = public_path($article->file_fr);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                  // Gérer l'file_fr si elle est présente
                    $cheminFile = Str::slug($article->titre . ' ' . time().'an');
                    $fichier = $request->file('file_fr');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                    $article->file_fr = 'dossier_file_article/'. $nomFichierAvecExtension;

            }
            if ($request->hasFile('file_an')) {
                // Supprimer l'prcienne photo si elle existe
                if ($article->file) {
                    $image = public_path($article->file_an);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisprt le nom et le prénom
                  // Gérer l'file_an si elle est présente
                    $cheminFile = Str::slug($article->titre . ' ' . time().'pr');
                    $fichier = $request->file('file_an');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                    $article->file_an = 'dossier_file_article/'. $nomFichierAvecExtension;


            }
            if ($request->hasFile('file_pr')) {
                // Supprimer l'prcienne photo si elle existe
                if ($article->file) {
                    // Storage::delete('public/' . $article->file_pr);
                    $image = public_path($article->file_pr);
                    if (file_exists($image)) {
                        unlink($image);
                    }

                }

                 // Formatez le nom du fichier en utilisprt le nom et le prénom
                  // Gérer l'file_pr si elle est présente
                    $cheminFile = Str::slug($article->titre . ' ' . time().'pr');
                    $fichier = $request->file('file_pr');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_article') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_article'), $nomFichierAvecExtension);

                    $article->file_pr = 'dossier_file_article/'. $nomFichierAvecExtension;


            }


            // Créer une nouvelle instance d'Actualite
            $article->id_user = auth()->user()->id;
            $article->titre = $validatedData['titre'];
            $article->description = $validatedData['description'];
            $article->meta_title = $validatedData['meta_title'];
            $article->meta_description = $validatedData['meta_description'];

             // Enregistrer les tags dans le modèle
             $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

             $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

             // Assuming you have an instance of the article model, you can set the tags attribute and save the model
             $article->tags = $tags;



            // Gérer le champ active_commentaire
            $article->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $article->status = boolval($request->input('status'));


            $slug = Str::slug($article->titre . ' ' . time());
            $article->slug = $slug;





            // Supprimer toutes les catégories actuelles de l'actualité
            $article->categories()->detach();

            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $article->categories()->attach($article->id, ['id_category' => $category->id]);
                }
            }


            $article->save();

             /////////////////////////////// historique
             $activity = new Activity();
             $activity->title = 'Une article a été modifier: '.$article->titre;
             $activity->type = 't-warning';
             $activity->icon = 'feather-plus';
             $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
             $activity->save();

            DB::commit();

            session()->flash('success', 'Actualité créée avec succès');
            return redirect()->route('articles.index');

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

                session()->flash('error', 'Une erreur s\'est produite lors de a modification . Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite lors de la modification. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            }
    }

    ////////////////// change status

    public function updateStatus(Request $request, $id)
    {
        try {
            $data = Article::findOrFail($id);

            if ($data->status == 1) {

            // Mettre à jour le statut du partenaire
            $data->status = 0;
            $data->save();
            }else {
                // Mettre à jour le statut du partenaire
            $data->status = 1;
            $data->save();
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
            $data = Article::findOrFail($id);

            // Supprimer le partenaire

            $data->delete();

            if ($data->image) {

                // Storage::delete('public/' . $data->image);
                $image = public_path('storage/' .$data->image);
                if (file_exists($image)) {
                    unlink($image);
                }

            }
            if ($data->file_an) {
                // Storage::delete('public/' . $data->file_an);
                $image = public_path('storage/' .$data->file_an);
                if (file_exists($image)) {
                    unlink($image);
                }
            }
            if ($data->file_pr) {
                // Storage::delete('public/' . $data->file_pr);
                $image = public_path('storage/' .$data->file_pr);
                if (file_exists($image)) {
                    unlink($image);
                }
            }
            if ($data->file_fr) {
                // Storage::delete('public/' . $data->file_fr);
                $image = public_path('storage/' .$data->file_fr);
                if (file_exists($image)) {
                    unlink($image);
                }
            }
             /////////////////////////////// historique
             $activity = new Activity();
             $activity->title = 'Un article a été supprimer: '.$data->titre;
             $activity->type = 't-warning';
             $activity->icon = 'feather-plus';
             $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
             $activity->save();

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }
}

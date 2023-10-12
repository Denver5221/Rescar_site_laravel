<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\Fiche;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ficheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $fiches = Fiche::select('titre','description', 'image', 'status', 'id', 'slug', 'created_at')->get();
            return view('pages.ressources.fiches',  ['fiches'=>$fiches,'title' => 'Etudes et publications - Ressources ', 'breadcrumb' => 'This Breadcrumb']);
            // return view('pages.actualites.actualites',  ['title' => 'Actualités | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite, veuillez verifier votre connexion et reéssayer plutard ou contactez l\'assistance.'])->withInput();
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
            return view('pages.ressources.ajouterfiches', ['categories'=>$categories ,'title' => ' Ajouter - Fiches d\'expériences - Ressources | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite, veuillez reéssayer plutard ou contacter l\'assistance.'])->withInput();
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

            $messages = [
                // Messages de validation personnalisés si nécessaire
                'titre.required'=> 'le champ titre est obligatoire',
                'description.required'=> 'le champ description est obligatoire',
                'meta_title.required'=> 'le champ meta_title est obligatoire',
                'meta_description.required'=> 'le champ titre est obligatoire',
                'tags.required'=> 'le champ tags est obligatoire',
                'image.required'=> 'le champ image est obligatoire',
                'category.required'=> 'le champ category est obligatoire',
                'numero.required'=> 'le champ numero est obligatoire',

            ];

            $validatedData = $request->validate([
                'titre' => 'required|string',
                'description' => 'required',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'numero' => 'required',
                'tags' => 'nullable|array',
                'image' => 'nullable|image|max:2048', // Exemple de règle de validation pour l'image
                'file_fr' => 'nullable|file|max:2048',
                'file_an' => 'nullable|file|max:2048',
                'file_pr' => 'nullable|file|max:2048',
            ], $messages);




            DB::beginTransaction();

            // Créer une nouvelle instance d'Actualite
            $fiche = new Fiche();
            $fiche->id_user = auth()->user()->id;
            $fiche->titre = $validatedData['titre'];
            $fiche->numero = $validatedData['numero'];
            $fiche->description = $validatedData['description'];
            $fiche->meta_title = $validatedData['meta_title'];
            $fiche->meta_description = $validatedData['meta_description'];

            // Enregistrer les tags dans le modèle
            $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

            $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

            // Assuming you have an instance of the fiche model, you can set the tags attribute and save the model
            $fiche->tags = $tags;

            if ($request->hasFile('image')) {
                $cheminFile = Str::slug($fiche->titre . ' ' . time());
                $fichier = $request->file('image');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                $fiche->image ='dossier_file_fiche/'. $nomFichierAvecExtension;
            }

            if ($request->hasFile('file_fr')) {
                $cheminFile = Str::slug($fiche->titre . ' ' . time());
                $fichier = $request->file('file_fr');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                $fiche->file_fr = 'dossier_file_fiche/'.$nomFichierAvecExtension;
            }

            if ($request->hasFile('file_an')) {
                $cheminFile = Str::slug($fiche->titre . ' ' . time());
                $fichier = $request->file('file_an');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                $fiche->file_an = 'dossier_file_fiche/'. $nomFichierAvecExtension;
            }

            if ($request->hasFile('file_pr')) {
                $cheminFile = Str::slug($fiche->titre . ' ' . time());
                $fichier = $request->file('file_pr');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                $fiche->file_pr = 'dossier_file_fiche/'. $nomFichierAvecExtension;
            }



            // Gérer le champ active_commentaire
            $fiche->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $fiche->status = boolval($request->input('status'));


            $slug = Str::slug($fiche->titre . ' ' . time());
            $fiche->slug = $slug;

            $fiche->save();




            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $fiche->categories()->attach($fiche->id, ['id_category' => $category->id]);
                }
            }


            /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Cette fiche été ajouté: '.$fiche->titre;
            $activity->type = 't-dark';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();


            DB::commit();

            session()->flash('success', 'Fiche de Publication créée avec succès');
            return redirect()->route('fiches');

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
            $fiches = Fiche::where('slug', $slug)->firstOrFail();
            $categories = Categorie::pluck('nom')->toArray();
            $tags = json_decode($fiches->tags, true); // Convertir les tags en tableau


            // dd($actualite);

            return view('pages.ressources.modifierfiches', ['tags'=>$tags,'categories'=>$categories,'fiches'=>$fiches,'title' => 'Modifier - ETUDE | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la récupération du formulaire à éditer, veuiller reéssayer plutard.'])->withInput();
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
                'numero' => 'required',
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
            $fiche = Fiche::findOrFail($id);

            if ($request->hasFile('image')) {
                // Supprimer l'ancienne photo si elle existe
                if ($fiche->file) {
                    $image = public_path($fiche->image);
                    if (file_exists($image)) {
                        unlink($image);
                    }

                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                  // Gérer l'image si elle est présente
                    $cheminFile = Str::slug($fiche->titre . ' ' . time());
                    $fichier = $request->file('image');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                    $fiche->image = 'dossier_file_fiche/'. $nomFichierAvecExtension;

            }

            if ($request->hasFile('file_fr')) {
                // Supprimer l'ancienne photo si elle existe
                if ($fiche->file) {
                    $image = public_path($fiche->file_fr);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                  // Gérer l'file_fr si elle est présente
                    $cheminFile = Str::slug($fiche->titre . ' ' . time().'an');
                    $fichier = $request->file('file_fr');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                    $fiche->file_fr = 'dossier_file_fiche/'. $nomFichierAvecExtension;

            }
            if ($request->hasFile('file_an')) {
                // Supprimer l'prcienne photo si elle existe
                if ($fiche->file) {
                    $image = public_path($fiche->file_an);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisprt le nom et le prénom
                  // Gérer l'file_an si elle est présente
                    $cheminFile = Str::slug($fiche->titre . ' ' . time().'pr');
                    $fichier = $request->file('file_an');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                    $fiche->file_an = 'dossier_file_fiche/'. $nomFichierAvecExtension;


            }
            if ($request->hasFile('file_pr')) {
                // Supprimer l'prcienne photo si elle existe
                if ($fiche->file) {
                    // Storage::delete('public/' . $fiche->file_pr);
                    $image = public_path($fiche->file_pr);
                    if (file_exists($image)) {
                        unlink($image);
                    }

                }

                 // Formatez le nom du fichier en utilisprt le nom et le prénom
                  // Gérer l'file_pr si elle est présente
                    $cheminFile = Str::slug($fiche->titre . ' ' . time().'pr');
                    $fichier = $request->file('file_pr');
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                    $cheminDeDestination = public_path('storage/dossier_file_fiche') . '/' . $nomFichierAvecExtension;
                    $fichier->move(public_path('storage/dossier_file_fiche'), $nomFichierAvecExtension);

                    $fiche->file_pr = 'dossier_file_fiche/'. $nomFichierAvecExtension;


            }


            // Créer une nouvelle instance d'Actualite
            $fiche->id_user = auth()->user()->id;
            $fiche->titre = $validatedData['titre'];
            $fiche->numero = $validatedData['numero'];
            $fiche->description = $validatedData['description'];
            $fiche->meta_title = $validatedData['meta_title'];
            $fiche->meta_description = $validatedData['meta_description'];

             // Enregistrer les tags dans le modèle
             $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

             $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

             // Assuming you have an instance of the fiche model, you can set the tags attribute and save the model
             $fiche->tags = $tags;



            // Gérer le champ active_commentaire
            $fiche->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $fiche->status = boolval($request->input('status'));


            $slug = Str::slug($fiche->titre . ' ' . time());
            $fiche->slug = $slug;





            // Supprimer toutes les catégories actuelles de l'actualité
            $fiche->categories()->detach();

            // Parcourir les catégories sélectionnées
            $categoriesData = json_decode($request->category[0], true);
            foreach ($categoriesData as $categoryData) {
                // Récupérer l'ID de la catégorie à partir de son nom
                $category = Categorie::where('nom', $categoryData['value'])->first();

                // Vérifier si la catégorie existe
                if ($category) {
                    // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                    $fiche->categories()->attach($fiche->id, ['id_category' => $category->id]);
                }
            }


            $fiche->save();


            DB::commit();

            session()->flash('success', 'Fiche modifier avec succès');
            return redirect()->route('fiches');

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

    ////////////////// change status

    public function updateStatus(Request $request, $id)
    {
        try {
            $data = Fiche::findOrFail($id);

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
                return response()->json(['success' => false, 'error' =>'Veuillez reéssayer pluttard ou contacter le service d\'assitance']);
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
            $data = Fiche::findOrFail($id);

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

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez reéssayer pluttard ou contacter le service d\'assitance']);
        }
    }
}

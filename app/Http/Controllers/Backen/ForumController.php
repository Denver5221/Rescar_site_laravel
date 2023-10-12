<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\Forum;
use App\Models\Thematique;
use App\Models\User;
use App\Models\Spam;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Récupérer les forums avec pagination
            $forums = Forum::with('thematique', 'categories')->get(); // Modifier le nombre d'éléments par page selon vos besoins

            return view('pages.forum.forum',  ['forums'=>$forums,'title' => 'Forum | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la récupération des donnés, veillez reéssayer plutard.'])->withInput();
        }

        // $motsInterdits = MotInterdit::pluck('mot_interdit')->toArray();
        // $messageContent = $request->input('content');

        // // Vérifie si le contenu du message contient des mots interdits
        // foreach ($motsInterdits as $motInterdit) {
        //     if (Str::contains($messageContent, $motInterdit)) {
        //         return redirect()->back()->withError("Le contenu du message contient des mots interdits.");
        //     }
        // }

    }

    public function utilisateurs()
    {
        try {
            // Récupérer les forums avec pagination
            $users = User::withCount('forums')->get();

            return view('pages.forum.utilisateurs', ['users'=>$users,'title' => ' Utilisateurs - Forum | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite. Veuillez reéssayer pluatard ou contacter l\'assistance'])->withInput();
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
            return view('pages.forum.ajouterforum', ['categories'=>$categories ,'title' => 'Ajouter - Forum | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite. Veuillez reéssayer plutard ou contacter l\assistance.'])->withInput();
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
        // dd($request);

        try {


            $validatedData = $request->validate([
                'thematique' => 'required',
                'status' => 'nullable|',
                'commentaire_active' => 'nullable|',
                'tags' => 'nullable|array',
            ]);

            DB::beginTransaction();


            $theme = new Thematique();
            $theme->thematique = $request->thematique;
            $theme->description = $request->description;

            if($request->tags)
             {// Enregistrer les tags dans le modèle
             $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

             $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

             // Assuming you have an instance of the Actualite model, you can set the tags attribute and save the model
             $theme->tags = $tags;
            }
             // Gérer le champ active_commentaire

             $thema = $request->thematique;
             $description = $request->description;
             $motsInterdits = Spam::pluck('nom')->toArray();

            //  $theme->status = true; // Valeur par défaut

             $statusInput = $request->input('status');

            //  if ($statusInput !== "true" && $statusInput !== "false") {
            //      // Gérer le cas où la valeur n'est pas valide (ni "true", ni "false")
            //      // Par exemple, attribuer une valeur par défaut ou retourner une erreur
            //      $theme->status = true; // ou autre valeur par défaut
            //      // return response()->json(['error' => 'La valeur du champ status doit être true ou false'], 400);
            //  } else {
            //      $theme->status = boolval($statusInput);
            //  }
             foreach ($motsInterdits as $motInterdit) {
                if (Str::contains($description, $motInterdit) || Str::contains($thema, $motInterdit)) {
                    $theme->status = false;
                    //return redirect()->back()->withError("Les champs contiennent des mots interdits.");
                    break; // Sortir de la boucle dès qu'un mot interdit est trouvé
                }
            }
                // Vérifier si la valeur est soit true, soit false
                $active = $request->input('active_commentaire');

                // if ($active !== "true" && $active !== "false") {
                //     // Gérer le cas où la valeur n'est pas valide (ni "true", ni "false")
                //     // Par exemple, attribuer une valeur par défaut ou retourner une erreur
                //     $theme->active_commentaire = true; // ou autre valeur par défaut
                //     // return response()->json(['error' => 'La valeur du champ status doit être true ou false'], 400);
                // } else {
                //     $theme->active_commentaire = boolval($active);
                // }
            $theme->status = boolval($statusInput);
            $theme->active_commentaire = boolval($active);
            $theme->save();

            $forum = new Forum();
            $forum->slug = $theme->thematique;
            $forum->id_user =  auth()->user()->id;
            $forum->id_thematique = $theme->id;

            $forum->save();

             // Parcourir les catégories sélectionnées
             $categoriesData = json_decode($request->category[0], true);
             foreach ($categoriesData as $categoryData) {
                 // Récupérer l'ID de la catégorie à partir de son nom
                 $category = Categorie::where('nom', $categoryData['value'])->first();

                 // Vérifier si la catégorie existe
                 if ($category) {
                     // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                     $forum->categories()->attach($forum->id, ['id_category' => $category->id]);
                 }
             }

                    /////////////////////////////// historique
                $activity = new Activity();
                $activity->title = 'Une thematique a été créé:'.$theme->thematique;
                $activity->type = 't-dark';
                $activity->icon = 'feather-plus';
                $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
                $activity->save();

            DB::commit();

            session()->flash('success', 'Theme créée avec succès');
            return redirect()->route('forum');

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
        try {
            // Récupérer les forums avec pagination

            $user = User::find($id);

            return view('pages.forum.voirtutilisateurs', ['user'=>$user,'title' => ' Information Utilisateurs - Forum | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite, veuillez reéssayer plutard et verifier votre connexion internet.'])->withInput();
        }
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
            // $forum = Forum::findOrFail($id);
            $forum = Forum::where('slug', $slug)->first();

            // Vérifier si l'utilisateur a la permission d'éditer le forum
            if ($forum->id_user != auth()->user()->id) {
                // Rediriger ou retourner une erreur si l'utilisateur n'a pas la permission
                // return redirect()->back()->withError("Vous n'êtes pas autorisé à modifier ce forum.");
                session()->flash("Vous n'êtes pas autorisé à modifier ce forum.");
                return redirect()->back()->withInput();
                // ou
                // abort(403, "Vous n'êtes pas autorisé à modifier ce forum.");
            }
            $tags = json_decode($forum->thematique->tags, true); // Convertir les tags en tableau

            $categories = Categorie::pluck('nom')->toArray();
            return view('pages.forum.modiferforum', ['tags'=>$tags,'forum'=>$forum,'categories'=>$categories ,'title' => 'Modifier - Forum | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite, veuillez verifier votre connexion internet et reéssayer plutard.'])->withInput();
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
        // dd($request);

        try {
            // dd($request);
       $messages = [
           // Messages de validation personnalisés si nécessaire
           'thematique.required'=> 'le champ titre est thematique',
       ];

       $validatedData = $request->validate([
           'thematique' => 'required',
           'status' => 'nullable|',
           'commentaire_active' => 'nullable|',
           'tags' => 'nullable|array',
       ], $messages);

       DB::beginTransaction();

       $theme = Thematique::findOrFail($id);



       $theme->thematique = $request->thematique;
       $theme->description = $request->description;

       if($request->tags)
        {// Enregistrer les tags dans le modèle
        $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

        $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

        // Assuming you have an instance of the Actualite model, you can set the tags attribute and save the model
        $theme->tags = $tags;
       }
        // Gérer le champ active_commentaire


        $thema = $request->thematique;
        $description = $request->description;
        $motsInterdits = Spam::pluck('nom')->toArray();

        $theme->status = true; // Valeur par défaut

        $statusInput = $request->input('status');

        // if ($statusInput !== "true" && $statusInput !== "false") {
        //     // Gérer le cas où la valeur n'est pas valide (ni "true", ni "false")
        //     // Par exemple, attribuer une valeur par défaut ou retourner une erreur
        //     $theme->status = true; // ou autre valeur par défaut
        //     // return response()->json(['error' => 'La valeur du champ status doit être true ou false'], 400);
        // } else {
        //     $theme->status = boolval($statusInput);
        // }
        foreach ($motsInterdits as $motInterdit) {
           if (Str::contains($description, $motInterdit) || Str::contains($thema, $motInterdit)) {
               $theme->status = false;
               //return redirect()->back()->withError("Les champs contiennent des mots interdits.");
               break; // Sortir de la boucle dès qu'un mot interdit est trouvé
           }
       }
           // Vérifier si la valeur est soit true, soit false
           $active = $request->input('active_commentaire');

        //    if ($active !== "true" && $active !== "false") {
        //        // Gérer le cas où la valeur n'est pas valide (ni "true", ni "false")
        //        // Par exemple, attribuer une valeur par défaut ou retourner une erreur
        //        $theme->active_commentaire = true; // ou autre valeur par défaut
        //        // return response()->json(['error' => 'La valeur du champ status doit être true ou false'], 400);
        //    } else {
        //        $theme->active_commentaire = boolval($active);
        //    }

           //  $theme->status = boolval($request->input('status'));
       $theme->status = boolval($statusInput);
       $theme->active_commentaire = boolval($active);
       $theme->save();

       $forum = Forum::findOrFail($request->id_forum);
       $forum->slug = $theme->thematique;
       $forum->id_user =  auth()->user()->id;
       $forum->id_thematique = $theme->id;

       $forum->save();


       // Supprimer toutes les catégories actuelles de l'actualité
          $forum->categories()->detach();
        // Parcourir les catégories sélectionnées
        $categoriesData = json_decode($request->category[0], true);
        foreach ($categoriesData as $categoryData) {
            // Récupérer l'ID de la catégorie à partir de son nom
            $category = Categorie::where('nom', $categoryData['value'])->first();

            // Vérifier si la catégorie existe
            if ($category) {
                // Créer une entrée dans la table de pivot avec l'ID de l'actualité et l'ID de la catégorie
                $forum->categories()->attach($forum->id, ['id_category' => $category->id]);
            }
        }

                           /////////////////////////////// historique
                           $activity = new Activity();
                           $activity->title = 'Une thematique a été modifier:'.$theme->thematique;
                           $activity->type = 't-warning';
                           $activity->icon = 'feather-plus';
                           $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
                           $activity->save();

       DB::commit();

       session()->flash('success', 'Theme créée avec succès');
       return redirect()->route('forum');

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

            session()->flash('error', 'Une erreur s\'est produite lors de modifiaction . Veuillez réessayer plus tard ou contacter l\'assistance.');
            return redirect()->back();
        } catch (\Exception $e) {
            // Gérer d'autres types d'erreurs
            // ...

            session()->flash('error', 'Une erreur s\'est produite lors de la modifiaction. Veuillez réessayer plus tard ou contacter l\'assistance.');
            return redirect()->back();
        }
    }

    //////////////////////// changer de staut
    public function updateStatus(Request $request, $thematiqueId)
    {

        try {
            // // $thematique = Thematique::where('forum_id', $forumId)->first();
            // $thematique = Thematique::where('forum_id', $forumId)->firstOrFail();
            $thematique = Thematique::findOrFail($thematiqueId);



            if ($thematique->status == 1) {

            // Mettre à jour le statut du partenaire
            $thematique->status = 0;
            $thematique->save();
            }
            else {
                // Mettre à jour le statut du partenaire
            $thematique->status = 1;
            $thematique->save();
            }
            // Répondre avec succès
            return response()->json(['success' => true]);

            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Veuillez reéssayer plutard ou contacter l\'assistance']);
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
            $thematique = Thematique::findOrFail($id);

                                           /////////////////////////////// historique
                                           $activity = new Activity();
                                           $activity->title = 'Une thematique a été supprimer:'.$thematique->thematique;
                                           $activity->type = 't-dark';
                                           $activity->icon = 'feather-plus';
                                           $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
                                           $activity->save();

            // Supprimer le partenaire
            $thematique->delete();


            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez reéssayer plutard ou contacter l\'assistance']);
        }
    }
}

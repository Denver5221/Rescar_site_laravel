<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\CommentaireForum;
use App\Models\Forum;
use App\Models\Like;
use App\Models\Spam;
use App\Models\Thematique;
use App\Models\Vue;
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


     public function index(Request $request, $categorie = null)
     {
         try {
             $query = Forum::query();

             if ($request->has('search')) {
                 $searchTerm = '%' . $request->search . '%';
                 $forums = $query
                        ->join('thematiques', 'forums.id_thematique', '=', 'thematiques.id')
                        ->where(function ($q) use ($searchTerm) {
                            $q->where('thematiques.thematique', 'like', $searchTerm)
                            ->orWhere('thematiques.description', 'like', $searchTerm);
                        })
                        ->where('thematiques.status', 1)
                        ->select('forums.*')
                        ->latest('forums.created_at')
                        ->with('thematique', 'categories')
                        ->get();
             }

             elseif (!is_null($categorie) && $categorie !== 'all') {
                 $category = Categorie::find($categorie);
                 if ($category) {
                     $query->whereHas('categories', function ($q) use ($category) {
                         $q->where('categories.id', $category->id);
                     });

                        $forums = $query
                        ->join('thematiques', 'forums.id_thematique', '=', 'thematiques.id')
                        ->where('thematiques.status', 1)
                        ->select('forums.*') // Sélectionnez toutes les colonnes de la table 'forums'
                        ->latest('forums.created_at') // Triez par la colonne 'created_at' de la table 'forums'
                        ->with('thematique', 'categories')
                        ->get();
                 }
             }else{
                $forums = $query
                ->join('thematiques', 'forums.id_thematique', '=', 'thematiques.id')
                ->where('thematiques.status', 1)
                ->select('forums.*') // Sélectionnez toutes les colonnes de la table 'forums'
                ->latest('forums.created_at') // Triez par la colonne 'created_at' de la table 'forums'
                ->with('thematique', 'categories')
                ->get();
            }

             $categories = Categorie::pluck('nom', 'id')->toArray();
             $categori = Categorie::latest()->get();
             $recenteComent = CommentaireForum::latest()->take(4)->get();
             $commentaires = CommentaireForum::latest()->get();

             $viewData = [
                 'commentaires' => $commentaires,
                 'recenteComent' => $recenteComent,
                 'categori' => $categori,
                 'categories' => $categories,
                 'forums' => $forums,
                 'title' => 'Forum | RESCAR-AOC',
                 'description' => 'Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
             ];

             return view('front.forum.forum', $viewData);
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la récupération des données, veuillez réessayer plus tard.'])->withInput();
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
        // dd($request);

        try {

        $validatedData = $request->validate([
            'thematique' => 'required',
            'tags' => 'nullable|array',
        ]);

        DB::beginTransaction();


        $theme = new Thematique();
        $theme->thematique = $request->thematique;
        // $theme->description = $request->description;

        if($request->tags)
         {// Enregistrer les tags dans le modèle
         $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

         $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

         // Assuming you have an instance of the Actualite model, you can set the tags attribute and save the model
         $theme->tags = $tags;
        }
         // Gérer le champ active_commentaire

         $thema = $request->thematique;
        //  $description = $request->description;
         $motsInterdits = Spam::pluck('nom')->toArray();

         $theme->status = true; // Valeur par défaut
         $theme->active_commentaire = true;

        //  $statusInput = $request->input('status');

        //  if ($statusInput !== "true" && $statusInput !== "false") {
        //      // Gérer le cas où la valeur n'est pas valide (ni "true", ni "false")
        //      // Par exemple, attribuer une valeur par défaut ou retourner une erreur
        //      $theme->status = true; // ou autre valeur par défaut
        //      // return response()->json(['error' => 'La valeur du champ status doit être true ou false'], 400);
        //  } else {
        //      $theme->status = boolval($statusInput);
        //  }
         foreach ($motsInterdits as $motInterdit) {
            if (Str::contains($thema, $motInterdit)) {
                $theme->status = false;
                //return redirect()->back()->withError("Les champs contiennent des mots interdits.");
                break; // Sortir de la boucle dès qu'un mot interdit est trouvé
            }
        }
            // Vérifier si la valeur est soit true, soit false
            // $active = $request->input('active_commentaire');

            // if ($active !== "true" && $active !== "false") {
            //     // Gérer le cas où la valeur n'est pas valide (ni "true", ni "false")
            //     // Par exemple, attribuer une valeur par défaut ou retourner une erreur
            //     $theme->status = true; // ou autre valeur par défaut
            //     // return response()->json(['error' => 'La valeur du champ status doit être true ou false'], 400);
            // } else {
            //     $theme->status = boolval($active);
            // }

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
        return redirect()->route('front.forum.index');

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
            // Récupérer les forums avec pagination
            $forum = Forum::where('slug', $slug)->firstOrFail(); // Modifier le nombre d'éléments par page selon vos besoins

            $vue = new Vue();
            $vue->compteur = 1;
            $vue->id_forum = $forum->id;
            $vue->save();

            $categories = Categorie::pluck('nom')->toArray();
            $categori = Categorie::latest()->get();

            $recenteComent = CommentaireForum::latest()->where('id_forum', $forum->id)->take(4)->get();

            $comments = CommentaireForum::latest()->where('id_forum', $forum->id)->get();


            return view('front.forum.forum-single',  ['comments'=>$comments,'recenteComent'=>$recenteComent,'categori'=>$categori,'categories'=>$categories,'forum'=>$forum,'title' => $forum->thematique->thematique , 'description' => $forum->thematique->description, ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la récupération des donnés, veillez reéssayer plutard.'])->withInput();
        }
    }

    public function like(Request $request)
    {
        $postId = $request->input('post_id');
        $userId = auth()->user()->id;

        // Vérifier si un like associé à l'utilisateur et au post existe déjà
        $existingLike = Like::where('id_forum', $postId)
                            ->where('id_user', $userId)
                            ->first();

        if ($existingLike) {
            // L'utilisateur a déjà liké ce post, vous pouvez ici renvoyer un message d'erreur ou rediriger l'utilisateur
            return response()->json(['error' => 'Vous avez déjà liké ce post']);
        }

        // Créer un nouveau like car l'utilisateur n'a pas encore liké ce post
        $like = new Like();
        $like->compteur = 1;
        $like->id_forum = $postId;
        $like->id_user = $userId;
        $like->save();

        // Mettez ici la logique pour mettre à jour le compteur de likes sur le post lui-même

        // Retourner le nombre total de likes pour mettre à jour l'interface utilisateur
        $totalLikes = Like::where('id_forum', $postId)->count();
        return response()->json(['likes' => $totalLikes]);
    }

    public function commentaire(Request $request)
    {
        try {
            // Validation des champs "content" et "id_lier"

            $validatedData = $request->validate([
                'content' => 'required',
                'id_lier' => 'required',
            ]);

            // Vérification des mots interdits dans le contenu
            $motsInterdits = Spam::pluck('nom')->toArray();
            $content = $validatedData['content'];

            if (Str::contains($content, $motsInterdits)) {
                return redirect()->back()->withError("Le contenu du commentaire contient des mots interdits.");
            }

            DB::beginTransaction();

            $comment = new CommentaireForum();
            $comment->id_forum = $validatedData['id_lier'];
            $comment->id_user = auth()->user()->id;
            $comment->content = $content;

            // Vérification et assignation du parent_id
            if ($request->has('parent_id')) {
                $comment->parent_id = $request->parent_id;
            }
            $comment->save();

            DB::commit();
            return redirect()->back()->with('success', 'Le formulaire a été soumis avec succès.');

            // $slug = Forum::FindOrFail($$validatedData['id_lier']);

            // return redirect()->route('front.forum.show',$slug->slug);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la création du commentaire.'])->withInput();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

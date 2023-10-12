<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Categorie;
use App\Models\CommentaireActualite;
use App\Models\Spam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ActualiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        try {
            $query = Actualite::query();

            if ($request->has('search')) {
                $searchTerm = '%' . $request->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('titre', 'like', $searchTerm)
                        ->orWhere('contenu', 'like', $searchTerm);
                });
            }
            if ($id) {
                $categorie = Categorie::findOrFail($id);
                $query->whereHas('categories', function ($q) use ($categorie) {
                    $q->where('categories.id', $categorie->id);
                });
            }
                $query->where('status', 1)->latest();


            $actualites = $query->get();
            $recenteComent = CommentaireActualite::latest()->take(4)->get();
            $categories = Categorie::latest()->get();

            $viewData = [
                'recenteComent' => $recenteComent,
                'actualites' => $actualites,
                'categories' => $categories,
                'title' => 'Actualités | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];

            session()->flash('success','succès');
            return view('front.actualites.news', $viewData);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            $errors = $e->errors();
            $errorsString = '';
            foreach ($errors as $fieldErrors) {
                $errorsString .= implode(', ', $fieldErrors) . ', ';
            }

            $errorsString = rtrim($errorsString, ', ');
            session()->flash('error', 'Veuillez réessayer plus tard ou contacter l\'assistance.');
            return redirect()->back()->withErrors($errors)->withInput();

            // return redirect()->back()->withErrors([])->withInput();
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

            $comment = new CommentaireActualite();
            $comment->id_lier = $validatedData['id_lier'];
            $comment->id_user = auth()->user()->id;
            $comment->content = $content;

            // Vérification et assignation du parent_id
            if ($request->has('parent_id')) {
                $comment->parent_id = $request->parent_id;
            }
            $comment->save();

            DB::commit();

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la création du commentaire.'])->withInput();
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
        try{
            // dd($slug);
            $categories = Categorie::latest()->get();

            $data = Actualite::where('slug', $slug)->firstOrFail();


            $comments = CommentaireActualite::latest()->where('id_lier',$data->id)->get();

            $recenteComent = CommentaireActualite::latest()->where('id_lier',$data->id)->take(4)->get();
            // dd($slug);

            return view('front.actualites.news-single',  ['recenteComent'=>$recenteComent,'comments'=>$comments,'categories'=>$categories,'data'=>$data,'title' =>$data->meta_title, 'description' =>$data->meta_description]);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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

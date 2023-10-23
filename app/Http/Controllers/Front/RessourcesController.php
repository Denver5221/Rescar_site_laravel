<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\CommentaireArticle;
use App\Models\CommentaireFiche;
use App\Models\CommentaireRapport;
use App\Models\CommentaireSupport;
use App\Models\CommentEtude;
use App\Models\EtudePublication;
use App\Models\Fiche;
use App\Models\Rapport;
use App\Models\Supportformation;
use App\Models\GroupeTravail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RessourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function etude(Request $request, $id = null)
    {
        // dd($id);
        try {
            $query = EtudePublication::query();

            if ($request->has('search')) {
                $searchTerm = '%' . $request->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('titre', 'like', $searchTerm)
                        ->orWhere('description', 'like', $searchTerm);
                });
            }
            if ($id) {
                $categorie = Categorie::findOrFail($id);
                $query->whereHas('categories', function ($q) use ($categorie) {
                    $q->where('categories.id', $categorie->id);
                });
            }
                $query->where('status', 1)->latest();


            $etudes = $query->get();
            $recenteComent = CommentEtude::latest()->take(4)->get();
            $categories = Categorie::latest()->get();

            $viewData = [
                'recenteComent' => $recenteComent,
                'categories' => $categories,
                'etudes' => $etudes,
                'title' => 'Etudes | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];

            return view('front.ressources.etudes', $viewData);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }


    public function etude_show($slug)
    {
        try{
            $categories = Categorie::latest()->get();

            $etudes = EtudePublication::where('slug', $slug)->firstOrFail();



            $comments = CommentEtude::latest()->where('id_lier',$etudes->id)->get();

            $recenteComent = CommentEtude::latest()->where('id_lier',$etudes->id)->take(4)->get();



            return view('front.ressources.etudes-single',  ['recenteComent'=>$recenteComent,'comments'=>$comments,'categories'=>$categories,'etudes'=>$etudes,'title' =>$etudes->	meta_title, 'description' =>$etudes->meta_description]);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }


    ////////////// fiche

    public function fiche(Request $request, $id = null)
    {
        try {
            $query = Fiche::query();

            if ($request->has('search')) {
                $searchTerm = '%' . $request->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('titre', 'like', $searchTerm)
                        ->orWhere('description', 'like', $searchTerm);
                });
            }

            if ($id) {
                $query->whereHas('categories', function ($q) use ($id) {
                    $q->where('categories.id', $id);
                });
            }

            $query->where('status', 1)->latest();

            $fiches = $query->select('titre', 'description', 'image', 'status', 'id', 'slug', 'created_at')->get();
            $recenteComent = CommentaireFiche::latest()->take(4)->get();
            $categories = Categorie::latest()->get();

            $viewData = [
                'recenteComent' => $recenteComent,
                'categories' => $categories,
                'fiches' => $fiches,
                'title' => 'Fiches | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];

            return view('front.ressources.fiches', $viewData);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function fiche_show($slug)
    {
        try{
            $categories = Categorie::latest()->get();

            $data = Fiche::where('slug', $slug)->firstOrFail();

            $comments = CommentaireFiche::latest()->where('id_lier',$data->id)->get();

            $recenteComent = CommentaireFiche::latest()->where('id_lier',$data->id)->take(4)->get();
            // dd($fiches);
            return view('front.ressources.fiches-single',  ['recenteComent'=>$recenteComent,'comments'=>$comments,'categories'=>$categories,'data'=>$data,'title' =>$data->	meta_title, 'description' =>$data->meta_description]);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

     ////////////// rapport
     public function rapport(Request $request, $id = null)
    {
        try {
            $query = Rapport::query();

            if ($request->has('search')) {
                $searchTerm = '%' . $request->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('titre', 'like', $searchTerm)
                        ->orWhere('description', 'like', $searchTerm);
                });
            }

            if ($id) {
                $query->whereHas('categories', function ($q) use ($id) {
                    $q->where('categories.id', $id);
                });
            }

            $query->where('status', 1)->latest();

            $rapports = $query->select('titre', 'description', 'image', 'status', 'id', 'slug', 'created_at')->get();
            $recenteComent = CommentaireRapport::latest()->take(4)->get();
            $categories = Categorie::latest()->get();

            $viewData = [
                'recenteComent' => $recenteComent,
                'categories' => $categories,
                'rapports' => $rapports,
                'title' => 'Rapports | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];

            return view('front.ressources.rapports', $viewData);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

     public function rapport_show($slug)
     {
         try{
             $categories = Categorie::latest()->get();

             $data = Rapport::where('slug', $slug)->firstOrFail();

              $comments = CommentaireRapport::latest()->where('id_lier',$data->id)->get();

            $recenteComent = CommentaireRapport::latest()->where('id_lier',$data->id)->take(4)->get();

             return view('front.ressources.rapports-single',  ['recenteComent'=>$recenteComent,'comments'=>$comments,'categories'=>$categories,'data'=>$data,'title' =>$data->	meta_title, 'description' =>$data->meta_description]);

         }catch(\Exception $e){
             DB::rollBack();
             return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
         }
     }


      ////////////// supports
      public function support(Request $request, $id = null)
    {
        try {
            $query = Supportformation::query();

            if ($request->has('search')) {
                $searchTerm = '%' . $request->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('titre', 'like', $searchTerm)
                        ->orWhere('description', 'like', $searchTerm);
                });
            }

            if ($id) {
                $query->whereHas('categories', function ($q) use ($id) {
                    $q->where('categories.id', $id);
                });
            }

            $query->where('status', 1)->latest();

            $supports = $query->select('titre', 'description', 'image', 'status', 'id', 'slug', 'created_at')->paginate(5);
            $recenteComent = CommentaireSupport::latest()->take(4)->get();
            $categories = Categorie::latest()->get();

            $viewData = [
                'recenteComent' => $recenteComent,
                'categories' => $categories,
                'supports' => $supports,
                'title' => 'Supports | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];

            return view('front.ressources.supports', $viewData);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

      public function support_show($slug)
      {
          try{
              $categories = Categorie::latest()->get();

              $data = Supportformation::where('slug', $slug)->firstOrFail();

              $comments = CommentaireSupport::latest()->where('id_lier',$data->id)->get();

              $recenteComent = CommentaireSupport::latest()->where('id_lier',$data->id)->take(4)->get();

              return view('front.ressources.supports-single',  ['recenteComent'=>$recenteComent,'comments'=>$comments,'categories'=>$categories,'data'=>$data,'title' =>$data->	meta_title, 'description' =>$data->meta_description]);

          }catch(\Exception $e){
              DB::rollBack();
              return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
          }
      }


      ////////////// article
      public function article(Request $request, $id = null)
        {
            try {
                $query = Article::query();

                if ($request->has('search')) {
                    $searchTerm = '%' . $request->search . '%';
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('titre', 'like', $searchTerm)
                            ->orWhere('description', 'like', $searchTerm);
                    });
                }

                if ($id) {
                    $query->whereHas('categories', function ($q) use ($id) {
                        $q->where('categories.id', $id);
                    });
                }

                $query->where('status', 1)->latest();

                $articles = $query->select('titre', 'description', 'image', 'status', 'id', 'slug', 'created_at')->paginate(5);
                $recenteComent = CommentaireArticle::latest()->take(4)->get();
                $categories = Categorie::latest()->get();

                $viewData = [
                    'recenteComent' => $recenteComent,
                    'categories' => $categories,
                    'articles' => $articles,
                    'title' => 'Articles | ReSCAR-AOC',
                    'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
                ];

                return view('front.ressources.articles', $viewData);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
            }
        }

      public function article_show($slug)
      {
          try{

              $categories = Categorie::latest()->get();

              $data = Article::where('slug', $slug)->firstOrFail();


              $comments = CommentaireArticle::latest()->where('id_lier',$data->id)->get();

              $recenteComent = CommentaireArticle::latest()->where('id_lier',$data->id)->take(4)->get();

              return view('front.ressources.articles-single',  ['recenteComent'=>$recenteComent,'comments'=>$comments,'categories'=>$categories,'data'=>$data,'title' =>$data->	meta_title, 'description' =>$data->meta_description]);

          }catch(\Exception $e){
              DB::rollBack();
              return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
          }
      }



       ////////////// Froupe de travail
      public function travail(Request $request, $id = null)
    {
        try {
            $query = GroupeTravail::query();

            if ($request->has('search')) {
                $searchTerm = '%' . $request->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('titre', 'like', $searchTerm)
                        ->orWhere('description', 'like', $searchTerm);
                });
            }

            if ($id) {
                $query->whereHas('categories', function ($q) use ($id) {
                    $q->where('categories.id', $id);
                });
            }

            $query->where('status', 1)->latest();

            $groupetravail = $query->select('titre', 'description', 'image', 'status', 'id', 'slug', 'created_at')->paginate(5);
            $categories = Categorie::latest()->get();

            $viewData = [
                'categories' => $categories,
                'groupetravail' => $groupetravail,
                'title' => 'Supports | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];

            return view('front.ressources.travail', $viewData);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

      public function travail_show($slug)
      {
          try{
              $categories = Categorie::latest()->get();

              $data = GroupeTravail::where('slug', $slug)->firstOrFail();



              return view('front.ressources.travail-single',  ['categories'=>$categories,'data'=>$data,'title' => $data->meta_title, 'description' =>$data->meta_description]);

          }catch(\Exception $e){
              DB::rollBack();
              return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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
        //
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

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CommentaireArticle;
use App\Models\CommentaireFiche;
use App\Models\CommentaireRapport;
use App\Models\CommentaireSupport;
use App\Models\CommentEtude;
use App\Models\Spam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CommentaireController extends Controller
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

    public function etude_commentaire(Request $request)
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

            $comment = new CommentEtude();
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

    ///////////////  commentaire fiche fonction
    public function fiche_commentaire(Request $request)
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

            $comment = new CommentaireFiche();
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

      ///////////////  commentaire Rapport fonction
      public function rapport_commentaire(Request $request)
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

              $comment = new CommentaireRapport();
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

      ///////////////  commentaire Support fonction
      public function support_commentaire(Request $request)
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

              $comment = new CommentaireSupport();
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

         ///////////////  commentaire Article fonction
         public function article_commentaire(Request $request)
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

                 $comment = new CommentaireArticle();
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

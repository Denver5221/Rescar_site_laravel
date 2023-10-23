<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\GroupeTravail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class GTravailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $groupetravail = GroupeTravail::latest()->get();
            return view('pages.ressources.travail',  ['groupetravail'=>$groupetravail,'title' => 'Groupe de Travail - Ressources ', 'breadcrumb' => 'This Breadcrumb']);
            
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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
            // $categories = Categorie::pluck('nom')->toArray();
            return view('pages.ressources.ajoutertravail', [
                // 'categories'=>$categories ,
                'title' => ' Groupe de Travail  - Ressources | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                    DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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
                'titre' => 'required|string',
                'description' => 'required',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'tags' => 'nullable|array',
                'image' => 'nullable', // Exemple de règle de validation pour l'image
                'file_fr' => 'nullable|file|max:2048',
                // 'file_an' => 'nullable|file|max:2048',
                // 'file_pr' => 'nullable|file|max:2048',
            ]);




            DB::beginTransaction();

            // Créer une nouvelle instance
            $groupetravail = new GroupeTravail();
            $groupetravail->id_user = auth()->user()->id;
            $groupetravail->titre = $validatedData['titre'];
            $groupetravail->description = $validatedData['description'];
            $groupetravail->meta_title = $validatedData['meta_title'];
            $groupetravail->meta_description = $validatedData['meta_description'];

            // Enregistrer les tags dans le modèle
            $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array

            $tags = json_encode($tagsData); // Encode the array of tags as a JSON string

            // Assuming you have an instance of the su$groupetravail model, you can set the tags attribute and save the model
            $groupetravail->entreprise = $tags;

            // Gérer l'image si elle est présente
            if ($request->hasFile('image')) {
                $cheminFile = Str::slug($groupetravail->titre . ' ' . time());
                $fichier = $request->file('image');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_groupedetravail') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_groupedetravail'), $nomFichierAvecExtension);

                $groupetravail->image ='dossier_file_groupedetravail/'. $nomFichierAvecExtension;
            }

            if ($request->hasFile('file_fr')) {
                $cheminFile = Str::slug($groupetravail->titre . ' ' . time());
                $fichier = $request->file('file_fr');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_file_groupedetravail') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_file_groupedetravail'), $nomFichierAvecExtension);

                $groupetravail->file_fr = 'dossier_file_groupedetravail/'.$nomFichierAvecExtension;
            }

            



            // Gérer le champ active_commentaire
            $groupetravail->active_commentaire = boolval($request->input('active_commentaire'));

            // Gérer le champ status
            $groupetravail->status = boolval($request->input('status'));


            $slug = Str::slug($groupetravail->titre . ' ' . time());
            $groupetravail->slug = $slug;

            $groupetravail->save();


            DB::commit();

            session()->flash('success', 'Groupe de travail créée avec succès');
            return redirect()->route('travail.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }

             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une

             session()->flash('error', 'Une erreur s\'est produite : ' . $errorsString);

             return redirect()->back()->withErrors($errors)->withInput();

            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());

                session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...

                session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
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
            $data = GroupeTravail::where('slug', $slug)->firstOrFail();
            $tags = json_decode($data->entreprise, true); // Convertir les tags en tableau


            // dd($actualite);

            return view('pages.ressources.modifiertravail', ['tags'=>$tags,'data'=>$data,'title' => 'Modifier - Groupe | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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
        {
            // dd($request, $request->file('image'));
            try {
   
               $validatedData = $request->validate([
                   'titre' => 'required|string',
                   'description' => 'required',
                   'meta_title' => 'required|string',
                   'meta_description' => 'required|string',
                   'tags' => 'nullable|array',
                   'image' => 'nullable|', // Exemple de règle de validation pour l'image
                   'file_fr' => 'nullable|file|max:2048',
                  
               ]);
   
   
   
   
               DB::beginTransaction();
               $groupetravail = GroupeTravail::findOrFail($id);
   
               if ($request->hasFile('image')) {
                   // Supprimer l'ancienne photo si elle existe
                   if ($groupetravail->file) {
                       $image = public_path($groupetravail->image);
                       if (file_exists($image)) {
                           unlink($image);
                       }
   
                   }
   
                    // Formatez le nom du fichier en utilisant le nom et le prénom
                     // Gérer l'image si elle est présente
                       $cheminFile = Str::slug($groupetravail->titre . ' ' . time());
                       $fichier = $request->file('image');
                       $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                       $cheminDeDestination = public_path('storage/dossier_file_groupedetravail') . '/' . $nomFichierAvecExtension;
                       $fichier->move(public_path('storage/dossier_file_groupedetravail'), $nomFichierAvecExtension);
   
                       $groupetravail->image = 'dossier_file_groupedetravail/'. $nomFichierAvecExtension;
   
               }
   
               if ($request->hasFile('file_fr')) {
                   // Supprimer l'ancienne photo si elle existe
                   if ($groupetravail->file) {
                       $image = public_path($groupetravail->file_fr);
                       if (file_exists($image)) {
                           unlink($image);
                       }
                   }
   
                    // Formatez le nom du fichier en utilisant le nom et le prénom
                     // Gérer l'file_fr si elle est présente
                       $cheminFile = Str::slug($groupetravail->titre . ' ' . time().'an');
                       $fichier = $request->file('file_fr');
                       $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                       $cheminDeDestination = public_path('storage/dossier_file_groupedetravail') . '/' . $nomFichierAvecExtension;
                       $fichier->move(public_path('storage/dossier_file_groupedetravail'), $nomFichierAvecExtension);
   
                       $groupetravail->file_fr = 'dossier_file_groupedetravail/'. $nomFichierAvecExtension;
   
               }
             
   
   
               // Créer une nouvelle instance d'Actualite
               $groupetravail->id_user = auth()->user()->id;
               $groupetravail->titre = $validatedData['titre'];
               $groupetravail->description = $validatedData['description'];
               $groupetravail->meta_title = $validatedData['meta_title'];
               $groupetravail->meta_description = $validatedData['meta_description'];
   
                // Enregistrer les tags dans le modèle
                $tagsData = json_decode($request->tags[0], true); // Decode the JSON string to an array
   
                $tags = json_encode($tagsData); // Encode the array of tags as a JSON string
   
                // Assuming you have an instance of the groupetravail model, you can set the tags attribute and save the model
                $groupetravail->entreprise = $tags;
   
   
   
               // Gérer le champ active_commentaire
               $groupetravail->active_commentaire = boolval($request->input('active_commentaire'));
   
               // Gérer le champ status
               $groupetravail->status = boolval($request->input('status'));
   
   
               $slug = Str::slug($groupetravail->titre . ' ' . time());
               $groupetravail->slug = $slug;
   
   
               $groupetravail->save();
   
   
               DB::commit();
   
               session()->flash('success', 'Groupe de travail modifier avec succès');
               return redirect()->route('travail.index');
           } catch (\Illuminate\Validation\ValidationException $e) {
               DB::rollBack();
                $errors = $e->errors();
                $errorsString = '';
                foreach ($errors as $fieldErrors) {
                    $errorsString .= implode(', ', $fieldErrors) . ', ';
                }
   
                $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une
   
                session()->flash('error', 'Une erreur s\'est produite : ' . $errorsString);
   
                return redirect()->back()->withErrors($errors)->withInput();
   
               } catch (QueryException $e) {
                   // Gérer les erreurs de base de données
                   // ...
                   // Loguer l'erreur
                   Log::error($e->getMessage());
   
                   session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
                   return redirect()->back();
               } catch (\Exception $e) {
                   // Gérer d'autres types d'erreurs
                   // ...
   
                   session()->flash('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard ou contacter l\'assistance.');
                   return redirect()->back();
               }
         
 }
}
    ////////////////// change status

    public function updateStatus(Request $request, $id)
    {
        try {
            $data = GroupeTravail::findOrFail($id);

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
                return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance']);
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
            $data = GroupeTravail::findOrFail($id);

            // Supprimer le partenaire

            $data->delete();

            if ($data->image) {
                // Storage::delete('public/' . $data->image);
                $image = public_path('storage/' .$data->image);
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
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance']);
        }
    }
}

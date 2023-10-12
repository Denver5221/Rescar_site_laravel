<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Organisme;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class OrganismeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
                $organismes = Organisme::all();
                return view('pages.repertoires.organismes', ['organismes'=>$organismes, 'title' => 'Organisme - Rescar-Aoc | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

                // return view('pages.rescar-aoc.partenaire', );

        } catch (\Exception $e) {
            DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite lors de la récupération des forums.'])->withInput();
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
            //   dd($request->image);
            $validatedData = $request->validate([
                'nom' => 'required',
                'description' => 'required',
                'site' => 'nullable',
                'numero' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);

            // dd($validatedData);
            DB::beginTransaction();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // L'image est valide, vous pouvez poursuivre le traitement
                $nom = $validatedData['nom'];
                $numero = $validatedData['numero'];
                $nomFichier = Str::slug($numero . ' ' . $nom);

                $photo = $request->file('image');
                $nomFichierAvecExtension = $nomFichier . '.' . $photo->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_photos') . '/' . $nomFichierAvecExtension;
                $photo->move(public_path('storage/dossier_photos'), $nomFichierAvecExtension);
                // $imagePath = $request->file('image')->store('imagePartenaire', 'public');

            } else {
                session()->flash('error', 'vous devez ajouter une image');
                return redirect()->back()->withInput();
            }


            $partner = new Organisme();
            $partner->id_user = auth()->user()->id;
            $partner->nom = $validatedData['nom'];
            $partner->image = 'dossier_photos/'.$nomFichierAvecExtension;
            $partner->description = $validatedData['description'];
            $partner->site = $validatedData['site'];
            $partner->numero = $validatedData['numero'];
            $partner->save();
                // Traiter l'image si elle est présente

                    /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Un Organisme été ajouté: '.$partner->nom;
            $activity->type = 't-danger';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();

            DB::commit();


            // return redirect()->route('partenaire')->with('success', 'Partenaire a été créé avec succès!');
            session()->flash('success', 'Organismes ajouté avec succès');
            return redirect()->route('organismes');

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
        try {
            //   dd($request->image);
            $validatedData = $request->validate([
                'nom' => 'required',
                'description' => 'required',
                'site' => 'nullable',
                'numero' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);

            // dd($validatedData);
            DB::beginTransaction();

            $partner  = Organisme::findOrFail($id);

            if ($request->hasFile('image')) {
                // Supprimer l'ancienne photo si elle existe
                if ($partner->image) {
                    $image = public_path($partner->image);
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }

                 // Formatez le nom du fichier en utilisant le nom et le prénom
                $nom = $validatedData['nom'];
                // $prenom = $validatedData['prenom'];
                $nomFichier = Str::slug(time() . ' ' . $nom);
                // Télécharger et sauvegarder la nouvelle photo
                $photo = $request->file('image');
                $nomFichierAvecExtension = $nomFichier . '.' . $photo->getClientOriginalExtension();
                   $cheminDeDestination = public_path('storage/dossier_photos') . '/' . $nomFichierAvecExtension;
                   $photo->move(public_path('storage/dossier_photos'), $nomFichierAvecExtension);
                // Enregistrez le chemin de la photo dans la base de données
                $partner->image = 'dossier_photos/'.$nomFichierAvecExtension;
            }

            // if ($request->hasFile('image') && $request->file('image')->isValid()) {
            //     // L'image est valide, vous pouvez poursuivre le traitement
            //     $imagePath = $request->file('image')->store('imagePartenaire', 'public');

            // } else {
            //     session()->flash('error', 'vous devez ajouter une image');
            //     return redirect()->back()->withInput();
            // }


            $partner->id_user = auth()->user()->id;
            $partner->nom = $validatedData['nom'];
            $partner->description = $validatedData['description'];
            $partner->site = $validatedData['site'];
            $partner->numero = $validatedData['numero'];
            $partner->save();
                // Traiter l'image si elle est présente

                    /////////////////////////////// historique
            $activity = new Activity();
            $activity->title = 'Un Organisme été Modifier: '.$partner->nom;
            $activity->type = 't-danger';
            $activity->icon = 'feather-plus';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();

            DB::commit();


            // return redirect()->route('partenaire')->with('success', 'Partenaire a été créé avec succès!');
            session()->flash('success', 'Organismes Modifier avec succès');
            return redirect()->route('organismes');

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

     //////////////////////// changer de staut
     public function updateStatus(Request $request, $id)
     {

         try {
             $partenaire = Organisme::findOrFail($id);

             if ($partenaire->status == 1) {

             // Mettre à jour le statut du partenaire
             $partenaire->status = 0;
             $partenaire->save();
             }else {
                 // Mettre à jour le statut du partenaire
             $partenaire->status = 1;
             $partenaire->save();
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
    public function destroy(Request $request,  $id)
    {
        try {
            // Supprimer le partenaire
            $organismes = Organisme::findOrFail($id);

            $organismes->delete();
            $image = public_path('storage/' .$organismes->image);
            if (file_exists($image)) {
                unlink($image);
            }
            // Storage::delete('public/' .$organismes->image);


            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez reéssayer plutard ou contacter l\'assistance']);
        }
    }
}

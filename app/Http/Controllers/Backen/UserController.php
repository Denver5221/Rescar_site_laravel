<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Information;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $informations = Information::all();
            $roles = Role::all();
            return view('pages.utilisateurs.listeutilisateurs',  ['roles'=>$roles,'informations'=>$informations,'title' => 'Etudes et publications - Ressources ', 'breadcrumb' => 'This Breadcrumb']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            if (auth()->check()) {
                $information = Information::where('id_user', auth()->user()->id)->firstOrFail();
                            // Récupérez les 10 dernières activités à partir de votre base de données (par exemple)
                $recentActivities = Activity::orderBy('created_at', 'desc')->take(20)->get();
                // dd($recentActivities);

                return view('pages.utilisateurs.utilisateurs',  ['recentActivities'=>$recentActivities,'information'=>$information, 'title' => 'Utilisateurs | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);

                // Le reste du code ici...
            } else {
                // Gérer le cas où l'utilisateur n'est pas authentifié
            }

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|min:5',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'phone' => 'required|integer',
            'role' => 'required',
            // 'roles' => 'required|array',
            // 'roles.*' => 'exists:roles,id',
        ]);

        try {
            // Créer un nouvel utilisateur
            $user = new User();
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            // Créer une entrée dans la table d'information
            $information = new Information();
            $information->id_user = $user->id;
            $information->nom = $validatedData['nom'];
            $information->prenom = $validatedData['prenom'];
            $information->phone = $validatedData['phone'];
            $slug = Str::slug($information->nom .$information->nom. ' ' . time());
            $information->slug = $slug;
            $information->save();

              /////////////////////////////// historique
              $activity = new Activity();
              $activity->title = '- Nouveau Utilisateur créé: '.$information->nom.''.$information->prenom;
              $activity->type = 't-secondary';
              $activity->icon = 'feather-plus';
              $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
              $activity->save();

            // Attribuer les rôles à l'utilisateur
            // $user->roles()->attach($validatedData['roles']);
            // $user->roles()->attach($validatedData['role']);
            $user->roles()->attach($user->id, ['id_role' => $validatedData['role']]);



            // Redirection ou réponse JSON en cas de succès
            session()->flash('success', 'Utilisateur mis à jour avec succès');
            return redirect()->route('utilisateurs.index');
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
        // Valider les données du formulaire
        // dd($request);


        try {

            $validatedData = $request->validate([
                'email' => 'required',
                'password' => 'nullable|min:5',
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'phone' => 'required|integer',
                'role' => 'required',
            ]);
            // Trouver l'utilisateur à mettre à jour
            $user = User::findOrFail($id);
            $user->email = $validatedData['email'];

            // Mettre à jour le mot de passe si fourni
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            $user->save();

            // Mettre à jour les informations de l'utilisateur
            $information = Information::where('id_user', $id)->firstOrFail();
            $information->nom = $validatedData['nom'];
            $information->prenom = $validatedData['prenom'];
            $information->phone = $validatedData['phone'];
            $slug = Str::slug($information->nom .$information->nom. ' ' . time());
            $information->slug = $slug;
            $information->save();

            // Mettre à jour le rôle de l'utilisateur
            $user->roles()->sync([$validatedData['role']]);

            ////////////////////// historique activity
            $activity = new Activity();
            $activity->title = $request->nom . ' ' . $request->prenom . ' - Utilisateur modifier';
            $activity->type = 't-danger';
            $activity->icon = 'feather-check';
            $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
            $activity->save();

            session()->flash('success', 'Utilisateur mis à jour avec succès');
            return redirect()->route('utilisateurs.index');

            // Redirection ou réponse JSON en cas de succès
            // return response()->json(['success' => true, 'message' => 'Utilisateur mis à jour avec succès']);
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

    ////////////////// change status

    public function updateStatus(Request $request, $id)
    {
        try {
            $data = Information::findOrFail($id);

            if ($data->status == 1) {

            // Mettre à jour le statut du partenaire
            $data->status = 0;
            $data->save();
             ////////////////////// historique activity
             $activity = new Activity();
             $activity->title = $data->nom . ' ' . $data->prenom . ' - Utilisateur desactivé';
             $activity->type = 't-primary';
             $activity->icon = 'feather-edite';
             $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
             $activity->save();

            }else {
                // Mettre à jour le statut du partenaire
            $data->status = 1;
            $data->save();
             ////////////////////// historique activity
             $activity = new Activity();
             $activity->title = $data->nom . ' ' . $data->prenom . ' - Utilisateur activé';
             $activity->type = 't-warning';
             $activity->icon = 'feather-edite';
             $activity->id_user = auth()->user()->id; // Associer l'ID de l'utilisateur actuel à l'activité
             $activity->save();
            }
            // Répondre avec succès
            return response()->json(['success' => true]);

            } catch (\Exception $e) {
                // dd($e->getMessage(),);
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.']);
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
            $data = Information::findOrFail($id);

            // Supprimer le partenaire

            $data->delete();

            if ($data->image) {
                Storage::delete('public/' . $data->image);

            }

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }
}

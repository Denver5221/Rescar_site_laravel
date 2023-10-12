<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Categorie;
use App\Models\Membre;
use App\Models\MembreMorale;
use App\Models\MembrePhysique;
use App\Models\Newsletter;
use App\Models\Partenaire;
use App\Models\Recrutement;
use App\Models\RecrutementPartenaire;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator; // Ajoutez cette ligne

class AceuilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $actualites = Actualite::latest()->take(3)->get();
            $partenaires = Partenaire::latest()->get();
            return view('front.index',  ['actualites'=>$actualites,'partenaires'=>$partenaires,'title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function recrutements()
    {
        try{
          // Récupérez les données de la table "Recrutement" triées par date de création décroissante
            $recrutement = Recrutement::latest()->where('status', 1)->get();

            // Récupérez les données de la table "RecrutementPartenaire" triées par date de création décroissante
            $recrutementpartenaire = RecrutementPartenaire::latest()->where('status', 1)->get();

            // Concaténez les deux collections sans supprimer les doublons
            $combinedCollection = $recrutementpartenaire->concat($recrutement);

            // Triez la collection combinée par date de création décroissante
            $sortedCollection = $combinedCollection->sortByDesc('created_at');

            $categories = Categorie::latest()->get();

            return view('front.recrutements',  ['categories'=>$categories,'sortedCollection'=>$sortedCollection,'recrutementpartenaire'=>$recrutementpartenaire,'title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Newsletter::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Vous avez été abonné au newsletter avec succès !');
    }




    public function membres()
    {
        try{
            // $actualites = Actualite::latest()->take(3)->get();
            $membres = Membre::latest()->get();
            return view('front.membres',  ['membres'=>$membres,'title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function partenaires()
    {
        try{
            // $actualites = Actualite::latest()->take(3)->get();
            $partenaires = Partenaire::latest()->get();
            return view('front.partenaires',  ['partenaires'=>$partenaires,'title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function gouvernances()
    {
        try{
            // $actualites = Actualite::latest()->take(3)->get();
            // $partenaires = Partenaire::latest()->get();
            return view('front.gouvernances',  ['title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function histoire()
    {
        try{
            // $actualites = Actualite::latest()->take(3)->get();
            // $partenaires = Partenaire::latest()->get();
            return view('front.histoire',  ['title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function objectif()
    {
        try{
            // $actualites = Actualite::latest()->take(3)->get();
            // $partenaires = Partenaire::latest()->get();
            return view('front.objectifs',  ['title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function membrePhysique()
    {
        try{
            return view('front.membre_physique',  ['title' => 'Membres Physique | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function membrePhysique_post(Request $request)
    {
        // dd($request);
        try{
            $validatedData = $request->validate([
                'nom' => 'required|string',
                'prenom' => 'required',
                'date_naissance' => 'required',
                'pays' => 'required|string',
                'sexe' => 'required',
                'niveau' => 'required',
                'fonction' => 'required',
                'phone' => 'required|string',
                'email' => 'required',
                'message' => 'required',
                'terme' => 'required',
                'domaine' => 'required',
            ]);

            DB::beginTransaction();

            $data = new MembrePhysique();

            $data->nom = $validatedData['nom'];
            $data->prenom = $validatedData['prenom'];
            $data->data_naissance = $validatedData['date_naissance'];
            $data->pays =$validatedData['pays'];
            $data->sexe = $validatedData['sexe'];
            $data->profil_academique = $validatedData['niveau'];
            $data->domaine_specialisation = $validatedData['domaine'];
            $data->fonction_actuelle = $validatedData['fonction'];
            $data->phone = $validatedData['phone'];
            $data->email = $validatedData['email'];
            $data->Biographie = $validatedData['message'];
            //  dd($data);
            $slug = Str::slug($data->prenom.''.$data->nom. ' ' . time());
            $data->slug = $slug;

            $data->save();

            DB::commit();

            session()->flash('success', 'Envoyer avec succès');
            return redirect()->back();

        }catch (\Illuminate\Validation\ValidationException $e) {
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

    public function membreMorale()
    {
        try{
            return view('front.membre_morale',  ['title' => 'Membres Morale | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
    }

    public function membreMorale_post(Request $request)
    {
        // dd($request);

        try{
            $validatedData = $request->validate([
                'nom' => 'required|string',
                'domaine' => 'required',
                'pays' => 'required',
                'légalisée' => 'required',
                'nombre' => 'required',
                'nom_contact' => 'required',
                'prenom_contact' => 'required',
                'fonction_contact' => 'required|string',
                'email' => 'required|max:255|email',
                'phone_contact' => 'required',
                'message' => 'required',
                'logo' => 'required|max:2048',
                'terme' => 'required',
            ]);

            // dd($validatedData);

            DB::beginTransaction();

            $data = new MembreMorale();

            $data->nom = $validatedData['nom'];
            $data->domaine = $validatedData['domaine'];

            $data->légalisée = $validatedData['légalisée'];

            $data->pays =$validatedData['pays'];
            $data->nombre_personnel = $validatedData['nombre'];
            $data->nom_contact = $validatedData['nom_contact'];
            $data->prenom_contact = $validatedData['prenom_contact'];
            $data->fonction_contact = $validatedData['fonction_contact'];
            $data->phone_contact = $validatedData['phone_contact'];
            $data->email = $validatedData['email'];
            $data->Biographie = $validatedData['message'];


            $slug = Str::slug($data->prenom.''.$data->nom. ' ' . time());
            $data->slug = $slug;


            if ($request->hasFile('logo')) {
                $cheminFile = Str::slug($data->nom . ' ' . time());
                $fichier = $request->file('logo');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();
                $cheminDeDestination = public_path('storage/dossier_membre_morale') . '/' . $nomFichierAvecExtension;
                $fichier->move(public_path('storage/dossier_membre_morale'), $nomFichierAvecExtension);

                $data->logo ='dossier_membre_morale/'. $nomFichierAvecExtension;
            }
            // dd($data);


            $data->save();

            DB::commit();

            session()->flash('success', 'Envoyer avec succès');
            return redirect()->back();

        }catch (\Illuminate\Validation\ValidationException $e) {
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

    public function espace()
    {
        try{
            $morale = MembreMorale::latest()->where('status', 1)->get();
            $physique = MembrePhysique::latest()->where('status', 1)->get();
            $viewData = [
                'morale'=>$morale,
                'physique' => $physique,
                'title' => 'Membre | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];
            return view('front.espace',$viewData);
        }catch(\Exception $e){
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


    public function show_recrutement($slug)
    {
        try{
            $categories = Categorie::latest()->get();

            $recrutement = Recrutement::where('slug', $slug)->firstOrFail();
            return view('front.recrutements-single',  ['categories'=>$categories,'recrutement'=>$recrutement,'title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }


    }
    public function show_recrutement_partenaire($slug)
    {
        try{
            $categories = Categorie::latest()->get();

            $recrutement = RecrutementPartenaire::where('slug', $slug)->firstOrFail();
            return view('front.recrutements-single',  ['categories'=>$categories,'recrutement'=>$recrutement,'title' => 'Membres | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ' Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }

    }
}

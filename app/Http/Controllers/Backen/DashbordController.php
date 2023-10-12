<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Actualite;
use App\Models\CommentaireForum;
use App\Models\Forum;
use App\Models\Like;
use App\Models\Membre;
use App\Models\MembreMorale;
use App\Models\MembrePhysique;
use App\Models\Partenaire;
use App\Models\Post;
use App\Models\Recrutement;
use App\Models\RecrutementPartenaire;
use App\Models\User;
use App\Models\Vue;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashbordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $currentMonth = Carbon::now()->month; // Obtient le mois en cours

            $activities = Activity::whereMonth('created_at', $currentMonth)
                    ->latest() // Tri décroissant par date de création
                    ->get();
            $partenaire = Partenaire::count();
            $membre = Membre::count();
            $recrutement = Recrutement::count();
            $recrutementP = RecrutementPartenaire::count();
            $actualite = Actualite::count();
            $posts = Forum::count();
            $commentaire = CommentaireForum::count();
            $vue = Vue::count();
            $like = Like::count();
            $utilisateur = User::count();
            $membrephysique = MembrePhysique::count();
            $membremorale = MembreMorale::count();

            $activityClasses = [
                'timeline-primary',
                'timeline-success',
                'timeline-danger',
                'timeline-dark',
                'timeline-warning',
                'timeline-secondary'
                ];


            $viewData = [
                'activityClasses' => $activityClasses,
                'membremorale' => $membremorale,
                'membrephysique' => $membrephysique,
                'utilisateur' => $utilisateur,
                'like' => $like,
                'vue' => $vue,
                'commentaire' => $commentaire,
                'posts' => $posts,
                'actualite' => $actualite,
                'recrutementP' => $recrutementP,
                'recrutement' => $recrutement,
                'membre' => $membre,
                'partenaire' => $partenaire,
                'activities' =>$activities,
                'title' => 'Dashboard | ReSCAR-AOC',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];
            // dd($viewData);
            return view('pages.dashboard.analytics',$viewData);

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
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

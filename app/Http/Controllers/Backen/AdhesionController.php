<?php

namespace App\Http\Controllers\Backen;

use App\Http\Controllers\Controller;
use App\Models\MembreMorale;
use App\Models\MembrePhysique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdhesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $morale = MembreMorale::all();
            $physique =MembrePhysique::all();

            return view('pages.rescar-aoc.adhesion', ['morale'=>$morale,'physique'=>$physique,'title' => 'Adhésion - Rescar-Aoc | RESCAR-AOC -Dashboard ', 'breadcrumb' => 'This Breadcrumb']);


            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite veuillez plutard ou contacter l\'assistance'])->withInput();
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

    ////////////////// change status

    public function updateStatus(Request $request, $id)
    {
        try {
            $data = MembrePhysique::findOrFail($id);

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
                return response()->json(['success' => false, 'error' =>'Veuillez reéssayer pluttard ou contacter le service d\'assitance']);
            }
    }

    public function updateStatus2(Request $request, $id)
    {
        try {
            $data = MembreMorale::findOrFail($id);

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
                return response()->json(['success' => false, 'error' =>'Veuillez reéssayer pluttard ou contacter le service d\'assitance']);
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
                $data = MembrePhysique::findOrFail($id);

                // Supprimer le partenaire

                $data->delete();



                // Renvoyer une réponse JSON avec succès
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Veuillez reéssayer pluttard ou contacter le service d\'assitance']);
            }
        }

        public function destroy2($id)
    {
            try {
                // Chercher le partenaire par son ID
                $data = MembreMorale::findOrFail($id);

                // Supprimer le partenaire

                $data->delete();

                if ($data->logo) {
                    $image = public_path('storage/' .$data->logo);
                    if (file_exists($image)) {
                        unlink($image);
                    }

                }


                // Renvoyer une réponse JSON avec succès
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
                return response()->json(['success' => false, 'error' => 'Veuillez reéssayer pluttard ou contacter le service d\'assitance']);
            }
    }

}

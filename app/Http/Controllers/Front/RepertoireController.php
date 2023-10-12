<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\Organisme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepertoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            // $actualites = Actualite::latest()->take(3)->get();
            $experts = Expert::latest()->get();
            return view('front.repertoires.experts',  ['experts'=>$experts,'title' => 'Experts | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

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
            // $actualites = Actualite::latest()->take(3)->get();
            $organismes = Organisme::latest()->get();
            return view('front.repertoires.organismes',  ['organismes'=>$organismes,'title' => 'Organisme | ReSCAR-AOC', 'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.']);

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

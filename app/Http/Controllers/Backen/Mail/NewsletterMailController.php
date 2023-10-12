<?php

namespace App\Http\Controllers\Backen\Mail;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterMailController extends Controller
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

            // dd($request);
        $request->validate([
            'email_envoi' => 'required|email',
            // 'email_reception' => 'required|email',
            'cc' => 'nullable|email',
            'sujet' => 'required',
            'fichier' => 'nullable|mimes:pdf,doc,docx',
            'contenu' => 'required',
        ]);

        // Enregistrement des données dans la base de données
        // ...

        // Envoi de l'e-mail
        $emailEnvoye = $request->input('email_envoi');
        // $emailReception = $request->input('email_reception');
        $cc = $request->input('cc');
        $sujet = $request->input('sujet');
        $fichier = $request->file('fichier');
        $contenu = $request->input('contenu');

        $newsletterData = new \stdClass();
        $newsletterData->email_envoi = $emailEnvoye;
        // $newsletterData->email_reception = $emailReception;
        $newsletterData->cc = $cc;
        $newsletterData->sujet = $sujet;
        $newsletterData->fichier = $fichier ? $fichier->getClientOriginalName() : null;
        $newsletterData->contenu = $contenu;

        ///////////////////////////////
        $abonnes = Newsletter::pluck('email');

        foreach ($abonnes as $abonne) {
            Mail::to($abonne)->cc($cc)->send(new NewsletterMail($newsletterData));
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

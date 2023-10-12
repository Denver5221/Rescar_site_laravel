<?php

namespace App\Http\Controllers\Backen\Mail;

use App\Http\Controllers\Controller;
use App\Mail\MessageEnvoye;
use App\Models\Newsletter;
use App\Models\Rescamail;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try{

            // $messages = Newsletter::latest()->get();
            $subscribedEmails = Newsletter::latest()->get(); // Récupérez toutes les adresses e-mail souscrites
            // $subscribedEmails = $subscribedEmails->email;
            $subscriptions = [];

            foreach ($subscribedEmails as $subscribedEmail) {
                $email = $subscribedEmail->email;
                $user = User::where('email', $email)->first();

                $subscriptions[] = [
                    'email' => $email,
                    'name' => $user ? $user->information->nom : null,
                    'lastname' => $user ? $user->information->prenom : null,
                    'created_at' => $subscribedEmail->created_at,
                ];
            }

            $viewData = [
                'subscriptions' => $subscriptions,
                'title' => 'Mail - Messagerie | RESCAR-AOC -Dashboard',
                'breadcrumb' => 'This Breadcrumb',
                'description' => 'RESCAR-AOC : Acteur majeur du conseil agricole et rural en Afrique de l’Ouest et du Centre, renforçant les synergies pour un développement durable.'
            ];

            return view('pages.messagerie.mail', $viewData);

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
        try {
            $request->validate([
                'email_envoi' => 'required|email',
                // 'email_reception' => 'required|email',
                'cc' => 'nullable|email',
                'sujet' => 'required',
                'fichier' => 'nullable',
                'blog-description-2' => 'required',
            ]);

            DB::beginTransaction();

            $emailEnvoye = $request->input('email_envoi');
            // $emailReception = $request->input('email_reception');
            $cc = $request->input('cc');
            $sujet = $request->input('sujet');
            $fichier = $request->file('fichier');
            $contenu = $request->input('blog-description-2');

            // Récupérer toutes les adresses e-mail souscrites
             $subscribedEmails = Newsletter::pluck('email');

            foreach ($subscribedEmails as $email) {
                // Créez et configurez l'objet MessageEnvoye pour chaque e-mail
                $message = new Rescamail();

                // Configurez les détails du message (expéditeur, sujet, contenu, pièce jointe, etc.)
                $message->id_user = auth()->user()->id;
                $message->expediteur = $emailEnvoye;
                $message->cc = $cc;
                $message->subject = $sujet;
                $message->contenu = $contenu;

                if ($request->hasFile('fichier')) {
                    $fichier = $request->file('fichier');
                    $cheminFile = Str::slug($message->fichier . ' ' . time());
                    $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();

                    $fichier->storeAs('dossier_file_message', $nomFichierAvecExtension);

                    $message->fichier = 'dossier_file_message/' . $nomFichierAvecExtension;
                }


                $slug = Str::slug($message->destinataire . ' ' . time());
                $message->slug = $slug;

                // Utilisez l'adresse e-mail actuelle comme destinataire
                $message->destinataire = $email;

                // Créez une instance du mail
                $mail = new MessageEnvoye($message);
                // $mail->setSender($emailEnvoye);

                // Envoyez l'e-mail
                Mail::to($email)
                    ->cc($cc)
                    ->send($mail);
            }


            DB::commit();



            session()->flash('success', 'Le mail a été envoyé avec succès');
            return redirect()->route('mail');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            $errors = $e->errors();
            $errorsString = '';

            foreach ($errors as $fieldErrors) {
                $errorsString .= implode(', ', $fieldErrors) . ', ';
            }

            $errorsString = rtrim($errorsString, ', ');

            session()->flash('error', 'Une erreur s\'est produite lors de l\'envoi du mail : ' . $errorsString);
            return redirect()->back()->withErrors($errors)->withInput();
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

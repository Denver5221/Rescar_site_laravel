<?php

use App\Http\Controllers\Front\AceuilleController;
use App\Http\Controllers\Front\ActualiteController;
use App\Http\Controllers\Front\CommentaireController;
use App\Http\Controllers\Front\ForumController;
use App\Http\Controllers\Front\RepertoireController;
use App\Http\Controllers\Front\RessourcesController;
use App\Http\Livewire\LikeDislike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require_once 'theme-routes.php';



Route::get('/barebone', function () {
    return view('barebone', ['title' => 'This is Title']);
});

Route::get('/deconnexion', function () {
    Auth::logout(); // Déconnexion de l'utilisateur
    // return view('auth.login');
    return  redirect()->route('login');
})->name('deconnexion');

// Route::get('/logout', function () {
//     Auth::logout(); // Déconnexion de l'utilisateur
//     // return view('auth.login');
//     return  redirect()->route('index.aceiulle');
// })->name('deconnexion');

/////////////////////////// le route su site web

        Route::get('/',[AceuilleController::class, 'index'])->name('index.aceiulle');
        Route::post('/subscribe', [AceuilleController::class, 'subscribe'])->name('subscribe');

        Route::prefix('qui-somme-nous')->group(function (){

            Route::get('/histoire', [AceuilleController::class, 'histoire'] )->name('qui-somme-nous.histoire');

            Route::get('/objectif-mission', [AceuilleController::class, 'objectif'])->name('qui-somme-nous.objectif-mission');

            Route::get('/gouvernances', [AceuilleController::class, 'gouvernances'])->name('qui-somme-nous.gouvernances');

            Route::get('/partenaires-financiers',[AceuilleController::class, 'partenaires'] )->name('qui-somme-nous.partenaires-financiers');

            Route::get('/membres', [AceuilleController::class, 'membres'])->name('qui-somme-nous.membres');

            Route::get('/recrutements', [AceuilleController::class, 'recrutements'])->name('qui-somme-nous.recrutements');

            Route::get('/recrutements/{slug}', [AceuilleController::class, 'show_recrutement'])->name('qui-somme-nous.recrutements.show');

            Route::get('/recrutements/partenaire/{slug}', [AceuilleController::class, 'show_recrutement_partenaire'])->name('qui-somme-nous.recrutements.partenaire.show');

            Route::get('/membres/physique', [AceuilleController::class, 'membrePhysique'])->name('qui-somme-nous.membrePhysique');

            Route::post('/membres/physique', [AceuilleController::class, 'membrePhysique_post'])->name('qui-somme-nous.membrePhysique_post');

            Route::get('/membres/morale', [AceuilleController::class, 'membreMorale'])->name('qui-somme-nous.membreMorale');

            Route::post('/membres/morale', [AceuilleController::class, 'membreMorale_post'])->name('qui-somme-nous.membreMorale_post');

            Route::get('/espace', [AceuilleController::class, 'espace'])->name('qui-somme-nous.espace');


        });


        ////////////////////////////////////////////// actualiter
        Route::prefix('actualite')->group(function (){

            Route::get('',[ActualiteController::class, 'index'])->name('front.actualite.index');

            Route::post('', [ActualiteController::class, 'index'])->name('front.actualite.search');

            Route::get('recherche_par_category/{id}',[ActualiteController::class, 'index'])->name('front.actualite.category_search');

            Route::get('/{slug}', [ActualiteController::class, 'show'])->name('front.actualite.show');

            Route::post('/comentaire',[ActualiteController::class, 'store'])->name('front.actualites.store')->middleware(['auth', 'checkUserStatus']);

            Route::delete('/suppression', )->name('front.actualites.suppression');
        });

        Route::prefix('ressources')->group(function(){
            //////////////////////////////////////////////// etude
            Route::get('/etudes',[RessourcesController::class, 'etude'])->name('ressources.etudes-publications');

            //////////////////// route de rechereche
            Route::post('/etudes', [RessourcesController::class, 'etude'])->name('ressources.etudes-publications.search');

            /////////////////////////////// recherche_par_category
            Route::get('/etudes/recherche_par_category/{id}',[RessourcesController::class, 'etude'])->name('ressources.etudes-publications.recherche_par_category');

            Route::get('/etudes/{slug}', [RessourcesController::class, 'etude_show'])->name('ressources.etudes-publications.show');

            Route::post('/etudes/commentaire',[CommentaireController::class, 'etude_commentaire'])->name('ressources.etudes-publications.commentaire')->middleware(['auth', 'checkUserStatus']);

            //////////////////////////////////////////////////////// fiche
            Route::get('/fiches-expériences', [RessourcesController::class, 'fiche'])->name('ressources.fiches-expériences');

            Route::post('/fiches-expériences', [RessourcesController::class, 'fiche'])->name('ressources.fiches-expériences.search');

            //////////////////////////////////////////recherche_par_category
            Route::get('/fiches-expériences/recherche_par_category/{id}', [RessourcesController::class, 'fiche'])->name('ressources.fiches-expériences.recherche_par_category');


            Route::get('/fiches-expériences/{slug}', [RessourcesController::class, 'fiche_show'])->name('ressources.fiches-expériences.show');

            Route::post('/fiches-expériences/commentaire',[CommentaireController::class, 'fiche_commentaire'])->name('ressources.fiches-expériences.commentaire')->middleware(['auth', 'checkUserStatus']);

            ////////////////////////////////////// rapport
            Route::get('/rapport-activités',[RessourcesController::class, 'rapport'])->name('ressources.rapport-activités');

            Route::post('/rapport-activités',[RessourcesController::class, 'rapport'])->name('ressources.rapport-activités.search');

            ////////////////////recherche_par_category/{id}
            Route::get('/rapport-activités/recherche_par_category/{id}',[RessourcesController::class, 'rapport'])->name('ressources.rapport-activités.recherche_par_category');


            Route::get('/rapport-activités/{slug}',[RessourcesController::class, 'rapport_show'])->name('ressources.rapport-activités.show');

            Route::post('/rapport-activités/commentaire',[CommentaireController::class, 'rapport_commentaire'])->name('ressources.rapport-activités.commentaire')->middleware(['auth', 'checkUserStatus']);

            //////////////////////////////////////////////////// support
            Route::get('/support-formation',[RessourcesController::class, 'support'])->name('ressources.support-formation');

            Route::post('/support-formation',[RessourcesController::class, 'support'])->name('ressources.support-formation.search');

            ///////////////////////////////////////// recherche_par_category/{id}
            Route::get('/support-formation/recherche_par_category/{id}',[RessourcesController::class, 'support'])->name('ressources.support-formation.recherche_par_category');


            Route::get('/support-formation/{slug}',[RessourcesController::class, 'support_show'])->name('ressources.support-formation');

            Route::post('/support-formation/commentaire',[CommentaireController::class, 'support_commentaire'])->name('ressources.support-formation.commentaire')->middleware(['auth', 'checkUserStatus']);

            /////////////////////////////////////// article
            Route::get('/articles-mémoires-recherche',[RessourcesController::class, 'article'])->name('ressources.articles-mémoires-recherche');
            Route::post('/articles-mémoires-recherche',[RessourcesController::class, 'article'])->name('ressources.articles-mémoires-recherche.search');

            /////////////////////////// recherche_par_category/{id}
            Route::get('/articles-mémoires-recherche/recherche_par_category/{id}',[RessourcesController::class, 'article'])->name('ressources.articles-mémoires-recherche.recherche_par_category');

            Route::get('/articles-mémoires-recherche/{slug}',[RessourcesController::class, 'article_show'])->name('ressources.articles-mémoires-recherche');

            Route::post('/articles-mémoires-recherche/commentaire',[CommentaireController::class, 'article_commentaire'])->name('ressources.articles-mémoires-recherche.commentaire')->middleware(['auth', 'checkUserStatus']);


        });
        Route::prefix('repertoires')->group(function(){

            Route::get('/experts',[RepertoireController::class, 'index'])->name('front.repertoire.expert.index');

            Route::get('/organismes',[RepertoireController::class, 'create'])->name('front.repertoire.organisme.create');
        });

        Route::prefix('forum')->group(function(){

            Route::get('', [ForumController::class, 'index'])->name('front.forum.index');
            Route::post('/recherche', [ForumController::class,  'index'])->name('front.forum.search');
            ////////////////////// recherche_par_category
            Route::get('/recherche_par_category/{category}', [ForumController::class, 'index'])->name('front.forum.index.recherche_par_category');


            Route::get('/detail/{slug}', [ForumController::class, 'show'])->name('front.forum.show');

            Route::post('/like', [ForumController::class, 'like'])->name('front.forum.like')->middleware(['auth', 'checkUserStatus']);

            Route::get('/like-dislike/{post}', LikeDislike::class)->name('like-dislike');

            Route::post('/commentaire', [ForumController::class, 'commentaire'])->name('front.forum.commentaire')->middleware(['auth', 'checkUserStatus']);

            Route::post('',[ForumController::class, 'store'])->name('front.forum.store')->middleware(['auth', 'checkUserStatus']);
        });

        Route::fallback(function () {
            return view('404');
        });

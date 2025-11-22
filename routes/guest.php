<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
$featured_pets = [
[
'name' => 'Moka',
'breed' => 'Caniche',
'age' => 5,
'sex' => 'Mâle',
'trait' => 'Affectueux',
'image' => 'moka',
'slug' => 'moka',
'status' =>'Disponible'
],
[
'name' => 'Luna',
'breed' => 'Berger Australien',
'age' => 3,
'sex' => 'Femelle',
'trait' => 'Affectueux',
'image' => 'luna',
'slug' => 'luna',
'status' =>'Indisponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
];
$stats = [
[
'number' => 127,
'label' => 'Adoptions réussies',
'color' => 'orange',
'icon' => 'heart'
],
[
'number' => 12,
'label' => 'Bénévoles actifs',
'color' => 'green',
'icon' => 'users'
],
[
'number' => 23,
'label' => 'Animaux au refuge',
'color' => 'blue',
'icon' => 'paw'
],
[
'number' => 5,
'label' => 'Années d\'existence',
'color' => 'purple',
'icon' => 'calendar'
],
];

return view('pages.guest.home.index', compact('featured_pets', 'stats'));
})->name('home');

Route::get('/pets', function () {

$featured_pets = [
[
'name' => 'Moka',
'breed' => 'Caniche',
'age' => 5,
'sex' => 'Mâle',
'trait' => 'Affectueux',
'image' => 'moka',
'slug' => 'moka',
'status' =>'Disponible'
],
[
'name' => 'Luna',
'breed' => 'Berger Australien',
'age' => 3,
'sex' => 'Femelle',
'trait' => 'Affectueux',
'image' => 'luna',
'slug' => 'luna',
'status' =>'Indisponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Indisponible'
],
];
return view('pages.guest.pets.index', compact('featured_pets'));
})->name('pets.index');

Route::get('/pets/moka', function () {

$featured_pets = [
[
'name' => 'Moka',
'breed' => 'Caniche',
'age' => 5,
'sex' => 'Mâle',
'trait' => 'Affectueux',
'image' => 'moka',
'slug' => 'moka',
'status' =>'Disponible'
],
[
'name' => 'Luna',
'breed' => 'Berger Australien',
'age' => 3,
'sex' => 'Femelle',
'trait' => 'Affectueux',
'image' => 'luna',
'slug' => 'luna',
'status' =>'Indisponible'
],
[
'name' => 'Rex',
'breed' => 'Berger Allemand',
'age' => 4,
'sex' => 'Mâle',
'trait' => 'Joueur',
'image' => 'rex',
'slug' => 'rex',
'status' =>'Disponible'
],
];

return view('pages.guest.pets.show', compact('featured_pets'));
})->name('pets.show');

Route::get('/adoption', function () {
return view('pages.guest.adoption.create');
})->name('adoption.create');

Route::get('/adoption/confirmation', function () {
return view('pages.guest.adoption.confirmation');
})->name('adoption.confirmation');

Route::get('/about', function () {
$team_members = [
['name' => 'Élise Dubois', 'role' => 'Fondatrice', 'image' => 'elise'],
['name' => 'Thomas Martin', 'role' => 'Étudiant vétérinaire', 'image' => 'thomas'],
['name' => 'Sophie Leroux', 'role' => 'Éducatrice canine', 'image' => 'sophie'],
['name' => 'Marc Durand', 'role' => 'Retraité', 'image' => 'marc'],
['name' => 'Julie Bernard', 'role' => 'Toiletteuse', 'image' => 'julie'],
['name' => 'David Petit', 'role' => 'Photographe', 'image' => 'david'],
['name' => 'Lucas Moreau', 'role' => 'Étudiant', 'image' => 'lucas'],
['name' => 'Emma Rousseau', 'role' => 'Enseignante', 'image' => 'emma'],
];

return view('pages.guest.about.index', compact('team_members'));
})->name('about');

Route::get('/contact', function () {
$faqs = [
[
'question' => 'Comment adopter un animal ?',
'answer' => 'Consultez notre page "Nos animaux", choisissez l\'animal qui vous intéresse et remplissez le formulaire de demande d\'adoption. Nous vous recontacterons rapidement pour organiser une rencontre au refuge.'
],
[
'question' => 'Puis-je visiter le refuge sans rendez-vous ?',
'answer' => 'Non, les visites se font uniquement sur rendez-vous pour garantir le bien-être de nos animaux et vous offrir un accueil personnalisé. Contactez-nous par téléphone ou email pour planifier votre visite.'
],
[
'question' => 'Quels sont les frais d\'adoption ?',
'answer' => 'Les frais d\'adoption varient selon l\'animal (espèce, âge, soins reçus). Ils couvrent les frais vétérinaires (vaccins, stérilisation, identification). Nous vous communiquerons le montant exact lors de votre demande.'
],
[
'question' => 'Comment devenir bénévole ?',
'answer' => 'Contactez-nous via ce formulaire en sélectionnant "Devenir bénévole" comme sujet, ou appelez-nous directement. Nous organisons régulièrement des sessions d\'accueil pour les nouveaux bénévoles.'
],
[
'question' => 'Acceptez-vous les dons ?',
'answer' => 'Oui ! Nous acceptons les dons financiers, de nourriture, de jouets, de couvertures, etc. Contactez-nous pour connaître nos besoins actuels. Chaque don, petit ou grand, fait une différence pour nos pensionnaires.'
],
];

return view('pages.guest.contact.index', compact('faqs'));
})->name('contact');

Route::get('/legal', function () {
return view('pages.guest.legal.index');
})->name('legal');

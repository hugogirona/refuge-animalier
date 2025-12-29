<!DOCTYPE html>
<html>
<head>
    <title>Un email de bienvenue</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .btn { background: #f97316; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Bonjour {{ $user->first_name }} !</h1>

    <p>Un compte a été créé pour vous sur la plateforme administrative.</p>

    <p>Voici vos identifiants de connexion :</p>
    <ul>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Mot de passe temporaire :</strong> {{ $tempPassword }}</li>
    </ul>

    <p style="margin-top: 30px;">
        <a href="{{ route('login') }}" class="btn">Se connecter</a>
    </p>

    <p>Merci de changer ce mot de passe dès votre première connexion dans votre espace profile, rubrique sécurité.</p>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de la reception de votre demande d'adoption</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .highlight { color: #f97316; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>Bonjour {{ $adoptionRequest->first_name }},</h1>

    <p>Nous avons bien reçu votre demande d'adoption pour <span class="highlight">{{ $adoptionRequest->pet->name }}</span> ! 🐾</p>

    <p>Notre équipe va étudier votre dossier avec attention. Nous vous recontacterons très prochainement par {{ $adoptionRequest->preferred_contact_method === 'phone' ? 'Téléphone' : 'Email'}}.</p>

    <p>Merci pour votre intérêt envers nos protégés.</p>

    <p>Cordialement,<br>
        L'équipe du refuge</p>
</div>
</body>
</html>

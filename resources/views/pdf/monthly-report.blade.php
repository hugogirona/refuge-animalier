<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport Mensuel</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 40px; border-bottom: 2px solid #f97316; padding-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #f97316; }
        .title { font-size: 20px; margin-top: 10px; }
        .stats-table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        .stats-table th, .stats-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .stats-table th { background-color: #f3f4f6; }
        .value { font-size: 18px; font-weight: bold; }
        .footer { margin-top: 50px; font-size: 12px; text-align: center; color: #666; }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">Les Pattes Heureuses</div>
    <div class="title">Rapport d'activité mensuel : {{ $monthName }}</div>
</div>

<p>Bonjour,</p>
<p>Veuillez trouver ci-joint les statistiques d'activité du refuge pour le mois écoulé, à destination des services communaux.</p>

<table class="stats-table">
    <thead>
    <tr>
        <th>Indicateur</th>
        <th>Valeur</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Nombre d'animaux accueillis (nouveaux arrivants)</td>
        <td class="value">{{ $arrivedCount }}</td>
    </tr>
    <tr>
        <td>Nombre d'adoptions réussies</td>
        <td class="value">{{ $adoptedCount }}</td>
    </tr>
    <tr>
        <td>Nombre d'animaux actuellement au refuge</td>
        <td class="value">{{ $currentInShelterCount }}</td>
    </tr>
    </tbody>
</table>

<div class="footer">
    Document généré le {{ $generatedAt }} par la plateforme de gestion.
</div>
</body>
</html>

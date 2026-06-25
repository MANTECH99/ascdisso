<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hors ligne - ASC Disso</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: sans-serif; background: #f5f5f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .container { text-align: center; background: white; border-radius: 20px; padding: 40px 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); max-width: 400px; width: 100%; }
        .icon { font-size: 80px; margin-bottom: 20px; animation: pulse 2s infinite; }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
        h1 { color: #4D1111; font-size: 24px; margin-bottom: 12px; }
        p { color: #666; margin-bottom: 24px; }
        button { background: #E81E25; color: white; border: none; padding: 15px 40px; border-radius: 50px; font-size: 16px; font-weight: bold; cursor: pointer; }
        button:hover { background: #cc1a20; }
        .logo { width: 80px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="logo">
        <div class="icon">📡</div>
        <h1>Vous êtes hors ligne</h1>
        <p>Veuillez vérifier votre connexion internet pour continuer vos achats sur ASC Disso.</p>
        <button onclick="window.location.reload()">Réessayer</button>
    </div>
</body>
</html>
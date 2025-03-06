<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="border rounded-md p-5 text-center">
        <h1 class="font-semibold">Status de Votre Réservation</h1>
        <p>votre réservation dans GrandTaxiGo et accépter</p>
        <img src="data:image/png;base64,{{ $qrcodeBase64 }}" alt="QR Code">
    </div>
</body>
</html>
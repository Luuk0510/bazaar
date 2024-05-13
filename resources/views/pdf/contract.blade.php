<!DOCTYPE html>
<html>

<head>
    <title>Contract</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .contract {
            width: 800px;
            margin: 0 auto;
        }

        .signature {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="contract">
        <h2>Contract - Bazaar</h2>
        <p>Klant: {{ $userName }}</p>
        <p>Email: {{ $userEmail }}</p>
        <p>Registratiedatum: {{ $registrationDate }}</p>
        <div class="signature">
            <p>Handtekening:</p>
            <br>
            <div style="border-top: 1px solid #000; width: 200px;"></div>
        </div>
    </div>
</body>

</html>

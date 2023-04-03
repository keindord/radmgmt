<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RadMGMT</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .container {
              display: grid;
              grid-gap: 20px;
              grid-template-columns: 50px auto 50px;
              align-items: stretch;
              align-content: center;
            }
            .item {
              justify-self: center;
              align-self: center;
              grid-column: 2;
            }
        </style>
    </head>
    <body>
      <div class="container">
        <div class="item">
          <h2>Wellcome to</h2>
          <img src="img/logo.png" alt="RadMGMT">
      </div>
      </div>
    </body>
</html>

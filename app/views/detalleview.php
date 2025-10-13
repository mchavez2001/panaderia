<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Especial</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #ff7eb3, #ff758c);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .heart {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            transform: rotate(45deg);
            animation: float 6s infinite ease-in-out;
        }

        .heart:before, .heart:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            top: -10px;
            left: 0;
        }

        .heart:after {
            left: 10px;
            top: 0;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(45deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(45deg);
                opacity: 0;
            }
        }

        .photos {
            margin-top: 20px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .photos img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .photos img:hover {
            transform: scale(1.2);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 1.5rem;
            }

            p {
                font-size: 1rem;
            }

            .photos img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Espero te guste este detalle que hice para ti! ❤️</h1>
        <p>Te aprecio muchísimo y siempre quiero verte feliz 😊</p>
        <p>¡Espero que estas fotos te saquen una sonrisa! 🌟</p>

        <div class="photos">
            <img src="../public/img/foto1.jpg" alt="Foto 1">
            <img src="../public/img/foto2.jpg" alt="Foto 2">
            <img src="../public/img/foto3.jpg" alt="Foto 3">
        </div>
    </div>

    <!-- Corazones flotando -->
    <div class="heart" style="left: 20%; animation-delay: 0s;"></div>
    <div class="heart" style="left: 40%; animation-delay: 1s;"></div>
    <div class="heart" style="left: 60%; animation-delay: 2s;"></div>
    <div class="heart" style="left: 80%; animation-delay: 3s;"></div>
</body>
</html>
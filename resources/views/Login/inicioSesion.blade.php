<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Rock Burgers</title>
    <link rel="shortcut icon" href="{{ asset('iconoTBR/TheBurgerRock.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('LoginCss/inicioSesion.css')}}">
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/TheBurgerRockLogo.png') }}" alt="Rock Burgers" class="logo">
        <h1>Inicio de Sesión</h1>
        <form action="{{route('iniciarSesionAdmin')}}" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="email" placeholder="Correo" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
        <div class="links">
            <a href="#">¿Olvidaste tu contraseña?</a>
            <a href="#">Crear una cuenta</a>
        </div>
        <div class="footer">
            &copy; 2024 Rock Burgers. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>

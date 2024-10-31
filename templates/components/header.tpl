<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titulo}}</title>
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5430ad88d0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="/css/styles.css" rel="stylesheet">
    <base href="/">
</head>
<body>
<header>
    <script>
        function confirmarEliminacion(url) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige a la ruta de eliminación
                    window.location.href = url;
                }
            });
        }
    </script>
    <nav class="navbar navbar-expand-sm bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{if $gestion}gestion/{/if}inicio">
            <img src="/img/logo.png" alt="Bootstrap" width="50" height="50">
            <h3>Mi biblioteca</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center flex-grow-1">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{if $gestion}gestion/{/if}libros">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{if $gestion}gestion/{/if}autores">Autores</a>
            </li>
            <li class="nav-item session-button d-flex align-items-center">
            {if $gestion}
                <a class="btn btn-primary" href="inicio">
                <i class="fa-solid fa-right-from-bracket"></i>
                Salir
                </a>  
            {else}
                <a class="btn btn-primary" href="gestion">
                <i class="fa-solid fa-right-to-bracket"></i>
                Iniciar sesión
                </a>
            {/if}
            </li>
            </ul>
        </div>
        </div>
    </nav>
</header>
<main class="row d-flex justify-content-center">

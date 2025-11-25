<?php
    function mostrarPerfil () {
        echo " 
                <div class='profile-card'>
                <div class='profile-image'>
                    <svg
                    fill='#000000'
                    xml:space='preserve'
                    viewBox='0 0 64 64'
                    height='70px'
                    width='70px'
                    xmlns:xlink='http://www.w3.org/1999/xlink'
                    xmlns='http://www.w3.org/2000/svg'
                    id='Layer_1'
                    version='1.0'
                    >
                    <g stroke-width='0' id='SVGRepo_bgCarrier'></g>
                    <g
                        stroke-linejoin='round'
                        stroke-linecap='round'
                        id='SVGRepo_tracerCarrier'
                    ></g>
                    <g id='SVGRepo_iconCarrier'>
                        <g>
                        <path
                            d='M18,12c0-5.522,4.478-10,10-10h8c5.522,0,10,4.478,10,10v7c0-3.313-2.687-6-6-6h-6c-2.209,0-4-1.791-4-4 c0-0.553-0.447-1-1-1s-1,0.447-1,1c0,2.209-1.791,4-4,4c-3.313,0-6,2.687-6,6V12z'
                            fill='#506C7F'
                        ></path>
                        <path
                            d='M62,60c0,1.104-0.896,2-2,2H4c-1.104,0-2-0.896-2-2v-8c0-1.104,0.447-2.104,1.172-2.828l-0.004-0.004 c4.148-3.343,8.896-5.964,14.046-7.714C20.869,45.467,26.117,48,31.973,48c5.862,0,11.115-2.538,14.771-6.56 c5.167,1.75,9.929,4.376,14.089,7.728l-0.004,0.004C61.553,49.896,62,50.896,62,52V60z'
                            fill='#7d988a'
                        ></path>
                        <g>
                            <path
                            d='M32,42c-2.853,0-5.502-0.857-7.715-2.322c-1.675,0.283-3.325,0.638-4.934,1.097 C22.602,43.989,27.041,46,31.973,46c4.938,0,9.383-2.017,12.634-5.238c-1.595-0.454-3.231-0.803-4.892-1.084 C37.502,41.143,34.853,42,32,42z'
                            fill='#F9EBB2'
                            ></path>
                            <path
                            d='M46,22h-1c-0.553,0-1-0.447-1-1v-1v-1c0-2.209-1.791-4-4-4h-6c-2.088,0-3.926-1.068-5-2.687 C27.926,13.932,26.088,15,24,15c-2.209,0-4,1.791-4,4v1v1c0,0.553-0.447,1-1,1h-1c-0.553,0-1,0.447-1,1v2c0,0.553,0.447,1,1,1h1 c0.553,0,1,0.447,1,1v1c0,6.627,5.373,12,12,12s12-5.373,12-12v-1c0-0.553,0.447-1,1-1h1c0.553,0,1-0.447,1-1v-2 C47,22.447,46.553,22,46,22z'
                            fill='#F9EBB2'
                            ></path>
                        </g>
                        <path
                            d='M62.242,47.758l0.014-0.014c-5.847-4.753-12.84-8.137-20.491-9.722C44.374,35.479,46,31.932,46,28 c1.657,0,3-1.343,3-3v-2c0-0.886-0.391-1.673-1-2.222V12c0-6.627-5.373-12-12-12h-8c-6.627,0-12,5.373-12,12v8.778 c-0.609,0.549-1,1.336-1,2.222v2c0,1.657,1.343,3,3,3c0,3.932,1.626,7.479,4.236,10.022c-7.652,1.586-14.646,4.969-20.492,9.722 l0.014,0.014C0.672,48.844,0,50.344,0,52v8c0,2.211,1.789,4,4,4h56c2.211,0,4-1.789,4-4v-8C64,50.344,63.328,48.844,62.242,47.758z M18,12c0-5.522,4.478-10,10-10h8c5.522,0,10,4.478,10,10v7c0-3.313-2.687-6-6-6h-6c-2.209,0-4-1.791-4-4c0-0.553-0.447-1-1-1 s-1,0.447-1,1c0,2.209-1.791,4-4,4c-3.313,0-6,2.687-6,6V12z M20,28v-1c0-0.553-0.447-1-1-1h-1c-0.553,0-1-0.447-1-1v-2 c0-0.553,0.447-1,1-1h1c0.553,0,1-0.447,1-1v-2c0-2.209,1.791-4,4-4c2.088,0,3.926-1.068,5-2.687C30.074,13.932,31.912,15,34,15h6 c2.209,0,4,1.791,4,4v2c0,0.553,0.447,1,1,1h1c0.553,0,1,0.447,1,1v2c0,0.553-0.447,1-1,1h-1c-0.553,0-1,0.447-1,1v1 c0,6.627-5.373,12-12,12S20,34.627,20,28z M24.285,39.678C26.498,41.143,29.147,42,32,42s5.502-0.857,7.715-2.322 c1.66,0.281,3.297,0.63,4.892,1.084C41.355,43.983,36.911,46,31.973,46c-4.932,0-9.371-2.011-12.621-5.226 C20.96,40.315,22.61,39.961,24.285,39.678z M62,60c0,1.104-0.896,2-2,2H4c-1.104,0-2-0.896-2-2v-8c0-1.104,0.447-2.104,1.172-2.828 l-0.004-0.004c4.148-3.343,8.896-5.964,14.046-7.714C20.869,45.467,26.117,48,31.973,48c5.862,0,11.115-2.538,14.771-6.56 c5.167,1.75,9.929,4.376,14.089,7.728l-0.004,0.004C61.553,49.896,62,50.896,62,52V60z'
                            fill='#242424'
                        ></path>
                        <path
                            d='M24.537,21.862c0.475,0.255,1.073,0.068,1.345-0.396C25.91,21.419,26.18,21,26.998,21 c0.808,0,1.096,0.436,1.111,0.458C28.287,21.803,28.637,22,28.999,22c0.154,0,0.311-0.035,0.457-0.111 c0.491-0.253,0.684-0.856,0.431-1.347C29.592,19.969,28.651,19,26.998,19c-1.691,0-2.618,0.983-2.9,1.564 C23.864,21.047,24.063,21.609,24.537,21.862z'
                            fill='#242424'
                        ></path>
                        <path
                            d='M34.539,21.862c0.475,0.255,1.073,0.068,1.345-0.396C35.912,21.419,36.182,21,37,21 c0.808,0,1.096,0.436,1.111,0.458C38.289,21.803,38.639,22,39.001,22c0.154,0,0.311-0.035,0.457-0.111 c0.491-0.253,0.684-0.856,0.431-1.347C39.594,19.969,38.653,19,37,19c-1.691,0-2.618,0.983-2.9,1.564 C33.866,21.047,34.065,21.609,34.539,21.862z'
                            fill='#242424'
                        ></path>
                        </g>
                    </g>
                    </svg>
                </div>
                <div class='profile-info'>
                    <p class='profile-name'>Narmesh Kumar Sah</p>
                    <div class='profile-title'>@Your Web Wizard</div>
                    <div class='profile-bio'>
                    Creative design and web enthusiast. Building digital experiences that
                    matter.
                    </div>
                </div>
                <div class='stats'>
                    <div class='stat-item'>
                    <div class='stat-value'>15k</div>
                    <div class='stat-label'>Followers</div>
                    </div>
                    <div class='stat-item'>
                    <div class='stat-value'>82</div> 
                    <div class='stat-label'>Posts</div>
                    </div>
                    <div class='stat-item'>
                    <div class='stat-value'>4.8</div>
                    <div class='stat-label'>Rating</div>
                    </div>
                </div>
            </div>
        ";
    }
    function ingresarContraseniaActual ()  {
        echo "<form class='form-contrasenia-actual' action='modificacion-contrasenia.php' method='post'>
                <div class='group'>
                    <input name='contrasenia-actual' required='' type='password' class='input'>
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Contrasenia actual</label>
                </div>
                <input type='submit' value='Continuar'>
            </form>";
    }
    function modificarContrasenia () {
        echo "
        <form class='form-contrasenia' action='modificacion-contrasenia.php' method='post'>
            <div>
                <div class='group'>
                    <input name='contrasenia-nueva' required='' type='password' class='input'>
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Contrasenia nueva</label>
                </div>
                <div class='group'>
                    <input name='contrasenia-nueva-conf' required='' type='password' class='input'>
                    <span class='highlight'></span>
                    <span class='bar'></span>
                    <label>Confirmar contrasenia</label>
                </div>
            </div>
            <input type='submit' value='Cambiar contrasenia'>
        </form>";
    }

    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>

    <link rel="stylesheet" href="../configuracion-css/configuracion.css">
</head>
<body>
    <main>
        <section>
            <article>
                <div class="card">
                    <ul class="list">
                        <li class="element">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                            <a href="configuracion.php?perfil=ok" class="label">Ver Perfil</a>
                        </li>
                    </ul>
                    <div class="separator"></div>
                    <ul class="list">
                        <li class="element">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                            <a href="configuracion.php?contrasenia=mod" class="label">Cambiar contrasenia</a>
                        </li>
                        <li class="element">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                            <a href="configuracion.php?email=mod" class="label">Cambiar email</a>
                        </li>
                    </ul>
                <div class="separator"></div>
                <ul class="list">
                    <li class="element delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                        <a href="../log/cerrarSesion.php" class="label">Cerrar Sesion</a>
                    </li>
                    </ul>
                    <div class="separator"></div>
                </div>
            </article>
        </section>
        <section class="seccion-elegida">
            <article>
                <?php
                    if (isset($_GET["perfil"])) {
                        mostrarPerfil();
                    }
                    if (isset($_GET["contrasenia"]) == "mod") {
                        echo "<link rel='stylesheet' href='../configuracion-css/modificacion-contrasenia.css'>";

                        if (isset($_GET["contraInvalida"])) {
                            echo "<div class='alert alert-danger' role='alert'>
                                La contrasenia ingresada no es valida
                            </div>";
                        }
                        if (isset($_GET["contraseniaM"])) {
                            echo "<div class='alert alert-success' role='alert'>
                                Contrasenia cambiada correctamente ✅
                            </div>";
                        }

                        ingresarContraseniaActual();
                    }
                    if (isset($_GET["contraIgual"])) {
                        echo "<link rel='stylesheet' href='../configuracion-css/modificacion-contrasenia.css'>";

                        if (isset($_GET["contraseniaC"])) {
                            echo "<div class='alert alert-danger' role='alert'>
                                Las contrasenias no coinciden
                            </div>";
                        }
                        modificarContrasenia();
                    }
                ?>
            </article>
        </section>
    </main>
</body>
</html>
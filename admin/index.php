<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../index.php");
    }
        include_once("../componentes-admin/header.php");
?>
    <main>
        <section>
            <article>
                <h1>
                    Bienvenido al panel del consultorio
                </h1>
            </article>
        </section>
    </main>
<?php
    include_once("../librerias/bootstrap-js.php");
?>
</body>
</html>
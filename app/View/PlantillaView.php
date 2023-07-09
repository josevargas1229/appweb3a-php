<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tropical World Shop</title>
    <link rel="stylesheet" href="app/View/style.css">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <a id="boton-cerrar" class="boton-cerrar" href="javascript:void(0)" onclick="ocultar()">&times;</a>
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/proyecto/">Inicio</a></li>
                <li><a href="http://localhost/proyecto/?c=ProductsController&m=index">Productos</a></li>
                <li><a href="http://localhost/proyecto/?c=OrderController&m=index">Pedidos</a></li>
                <li><a href="http://localhost/proyecto/?c=AboutController&m=index">Acerca de</a></li>
                <li><a href="http://localhost/proyecto/?c=UserController&m=index">Usuarios</a></li>
                <li><a href="http://localhost/proyecto/?c=UserController&m=CallFormLogin">login</a></li>
            </ul>
        </nav>
    </div>
    <header class="header">
        <div class="header-contenido" id="header-contenido">
            <div class="header-contenido-menu">
                <a id="open" class="open" href="javascript:void(0)" onclick="mostrar()">&equiv;</a>
            </div>
            <div class="header-contenido-principal">
                <div class="header-contenido-principal-titulo">
                    <h1>Tropical World Shop</h1>
                </div>
                <div class="header-contenido-principal-menu">
                <nav class="navbar" id="navbar1">
                    <ul>
                        <li><a href="http://localhost/proyecto/">Inicio</a></li>
                        <li><a href="http://localhost/proyecto/?c=ProductsController&m=index">Productos</a></li>
                        <li><a href="http://localhost/proyecto/?c=OrderController&m=index">Pedidos</a></li>
                        <li><a href="http://localhost/proyecto/?c=AboutController&m=index">Acerca de</a></li>
                        <li><a href="http://localhost/proyecto/?c=UserController&m=index">Usuarios</a></li>
                        <li><a href="http://localhost/proyecto/?c=UserController&m=CallFormLogin">login</a></li>
                    </ul>
                </nav>
                </div>
            </div>
        </div>
    </header>
    <section class="content">
        <!--Aqui va todo lo que pueda ser contenido de la plantilla-->
        <?php include_once($vista)?>
    </section>
    <footer class="footer">
        <div class="footer-logo">

        </div>
        <div class="footer-text"></div>
        <h4>Contacto</h4>
        <p>¡Nos encantaría escuchar de ti! Puedes ponerte en contacto con nosotros utilizando la siguiente información <br>
        Teléfono: 123-456-7890 <br>
        Correo Electrónico: info@cajetademango.com <br>
        Dirección: Calle Principal #123, Huejutla de Reyes, Hidalgo</p>
        <p>© Tropical World, Derechos reservados.</p>
    </footer>
</div>
    <script>
        function mostrar(){
            document.getElementById("sidebar").style.width="200px";
            document.getElementById("contenido").style.marginLeft="200px";
            document.getElementById("open").style.display="none";
            document.getElementById("close").style.display="inline";
        }
        function ocultar(){
            document.getElementById("sidebar").style.width="0";
            document.getElementById("contenido").style.marginLeft="0";
            document.getElementById("open").style.display="inline";
            document.getElementById("close").style.display="none";
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mobile.css')}}">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <title>Home</title>
</head>

<body>
    <div id="container-menu" style="background-color:{{$front_config['bgcolor']}}">
        <h1>Laravel CMS</h1>
        <nav>
            <ul>
                @foreach($front_menu as $menuSlug => $menuTitle)
                <li><a href="{{$menuSlug}}">{{$menuTitle}}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
    <header>
        <div id="cabecalho">
            <h1>Gerenciador de Sites</h1>
            <p>CMS desenvolvido em Laravel com Painel Administrativo</p>
            <a href="">saiba mais</a>
        </div>
    </header>

    <section id="container">
        <div id="headline">
            <h2>Tecnologias Usadas</h2>
        </div>
        <div id="image">
            <img id="js" src="{{asset('assets/images/javascript.png')}}" alt="">
            <img id="php" src="{{asset('assets/images/php7.jpg')}}" alt="">
            <img id="html" src="{{asset('assets/images/html.png')}}" alt="">
            <img id="css" src="{{asset('assets/images/css.png')}}" alt="">
            <img id="laravel" src="{{asset('assets/images/laravel.png')}}" alt="">
        </div>
    </section>


    <section id="container-2">
        <div class="website-content">
            @yield('content')
        </div>
    </section>

    <footer>
        <div class="footer-start">
            <div id="footer-menu-1">
                <h3 class="footer-title">Laravel CMS</h3>
                <p>Interface feita com a biblioteca adminlte</p>
                <a href="{{route('painel')}}">Ver Painel</a>
            </div>
            <div id="footer-menu-2">
                <h3 class="footer-title">Funcionalinades</h3>
                <ul id="mini-menu">
                    <li>Adicionar Usuários</li>
                    <li>Criar e editar Páginas</li>
                    <li>Definir Cor do Texto</li>
                    <li>Verificar usuários e dados de acesso</li>
                </ul>
            </div>
            <div id="footer-menu-3">
                <h3 class="footer-title">Contato</h3>
                <div id="icones">
                    <ion-icon name="logo-linkedin">Linkedin</ion-icon>
                    <ion-icon name="mail">E-mail</ion-icon>
                </div>
            </div>

        </div>
        <div class="footer-end">
            <p>&copy2022 | desenvolvido por Vinícius Krausche</p>
        </div>
    </footer>
</body>

</html>
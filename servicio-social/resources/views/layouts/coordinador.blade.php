<!doctype html>
<html lang = "es">
    <head>
        <meta charset = "UTF-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>

        /*Slidenav*/
        @import url('https://fonts.googleapis.com/css?family=Encode+Sans+Condensed:400,600');

        header {
        display: flex;
        position: fixed;
        width: 100%;
        height: 70px;
        background: #414bb2;
        color: #fff;
        justify-content: flex-end;
        align-items: center;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        }

        main {
        padding: 20px 20px 0;
        display: flex;
        flex-direction: column;
        height: 100%;
        }

        main > div {
        margin: auto;
        max-width: 1300px;
        }

        #nav-container {
        position: fixed;
        height: 100vh;
        width: 100%;
        pointer-events: none;
        }

        #nav-container .bg {
        position: absolute;
        top: 70px;
        left: 0;
        width: 100%;
        height: calc(100% - 70px);
        visibility: hidden;
        opacity: 0;
        transition: .3s;
        background: #000;
        }

        #nav-container:focus-within .bg {
        visibility: visible;
        opacity: .6;
        }
        
        #nav-container * {
        visibility: visible;
        }

        .button {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        z-index: 1;
        -webkit-appearance: none;
        border: 0;
        background: transparent;
        border-radius: 0;
        height: 70px;
        width: 30px;
        cursor: pointer;
        pointer-events: auto;
        margin-left: 25px;
        touch-action: manipulation;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        }

        .icon-bar {
        display: block;
        width: 100%;
        height: 3px;
        background: #fff;
        transition: .3s;
        }
        
        .icon-bar + .icon-bar {
        margin-top: 5px;
        }

        #nav-container:focus-within .button {
        pointer-events: none;
        }
        #nav-container:focus-within .icon-bar:nth-of-type(1) {
        transform: translate3d(0,8px,0) rotate(45deg);
        }
        #nav-container:focus-within .icon-bar:nth-of-type(2) {
        opacity: 0;
        }
        #nav-container:focus-within .icon-bar:nth-of-type(3) {
        transform: translate3d(0,-8px,0) rotate(-45deg);
        }

        #nav-content {
        margin-top: 70px;
        padding: 20px;
        width: 90%;
        max-width: 300px;
        position: absolute;
        top: 0;
        left: 0;
        height: calc(100% - 70px);
        background: #414bb2;
        pointer-events: auto;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        transform: translateX(-100%);
        transition: transform .3s;
        will-change: transform;
        contain: paint;
        }

        #nav-content ul {
        height: 100%;
        display: flex;
        flex-direction: column;
        }

        #nav-container:focus-within #nav-content {
        transform: none;
        }


        /* Page content */
        a:link { text-decoration: none; }

        a:visited { text-decoration: none; }

        a:hover { text-decoration: none; }

        /*Styles elements*/
        .btnh5 {
        position: relative;
        display: inline-block;
        cursor: pointer;
        outline: none;
        border: 0;
        vertical-align: middle;
        text-decoration: none;
        background: transparent;
        padding: 0;
        font-size: 15px;
        font-family: inherit;
        margin-top: 0.5rem;
        }
        
        .learn-more-h5 {
        width: 16rem;
        height: auto;
        margin: 0.5rem -2rem;
        }

        .header-h5 {
            width:12rem;
            margin-right: 2rem;
        }
        
        .learn-more-h5 .circle {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        position: relative;
        display: block;
        margin: 0;
        width: 3rem;
        height: 2.5rem;
        background: #fff;
        border-radius: 1.625rem;
        }
        
        .learn-more-h5 .circle .icon-h5 {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        background: #fff;
        }
        
        .learn-more-h5 .circle .icon-h5.arrow {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        left: 0.625rem;
        width: 1.125rem;
        height: 0.125rem;
        background: none;
        }
        
        .learn-more-h5 .circle .icon-h5.arrow::before {
        position: absolute;
        content: "";
        top: -0.29rem;
        right: 0.0625rem;
        width: 0.625rem;
        height: 0.625rem;
        border-top: 0.125rem solid #000;
        border-right: 0.125rem solid #000;
        transform: rotate(45deg);
        }
        
        .learn-more-h5 .button-text {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        position: absolute;
        top: -5px;
        left: 25px;
        right: 0;
        bottom: 0;
        padding: 0.75rem 0;
        margin: 0 0 0 1.85rem;
        color: #fff;
        font-weight: 700;
        line-height: 1.6;
        text-align: start;
        text-transform: uppercase;
        }
        
        .btnh5:hover .circle {
        width: 100%;
        }
        
        .btnh5:hover .circle .icon-h5.arrow {
        background: #000;
        transform: translate(1rem, 0);
        }
        
        .btnh5:hover .button-text {
        color: #000;
        }

        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Coordinador</title>
    </head>
    <body>
        <div class="page">
            <header tabindex="0">
                <h5 class="learn-more-h5 btnh5 header-h5"><a href="{{route('departamento.logout')}}">
                <span class="circle" aria-hidden="true">
                <span class="icon-h5 arrow"></span>
                </span>
                <span class="button-text">Cerrar Sesión</span></a>
                </h5>
            </header>
            <div id="nav-container">
                <div class="bg"></div>
                <div class="button" tabindex="0">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div id="nav-content" tabindex="0">
                    <ul>
                        <h5 class="learn-more-h5 btnh5"><a href="#">
                        <span class="circle" aria-hidden="true">
                        <span class="icon-h5 arrow"></span>
                        </span>
                        <span class="button-text">Alumnos pendientes</span></a>
                        </h5>

                        <h5 class="learn-more-h5 btnh5"><a href="#">
                        <span class="circle" aria-hidden="true">
                        <span class="icon-h5 arrow"></span>
                        </span>
                        <span class="button-text">Alumnos inscritos</span></a>
                        </h5>

                        <h5 class="learn-more-h5 btnh5"><a href="#">
                        <span class="circle" aria-hidden="true">
                        <span class="icon-h5 arrow"></span>
                        </span>
                        <span class="button-text">Estadísticas</span></a>
                        </h5>
                    </ul>
                </div>
            </div>

            <main>
                <div class="content">
                @yield('contenido')
                </div>
            </main>
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>
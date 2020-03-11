<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/storage/icons/logoif.png" type="image/x-icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>REPOIF</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    
    <!-- Progress Bar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f2a0c0f26f.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>

</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md" style="background-color: #195128;">
                <a class="navbar-brand text-light mr-auto" href="{{ url('/projects') }}">
                    <img src="/storage/icons/logo.png" alt="logo do repositorio REPOIF">
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mgl">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/news') }}">Ultimos envios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/photos') }}">Fotos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/videos') }}">Vídeos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/codes') }}">Scripts</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/projects/create') }}">
                                <span  class="teste">
                                    CRIAR
                                </span>
                            </a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0 mgr" action="/projects/search" method="post">
                        @method('POST')
                        @csrf
                        <input class="form-control mr-sm-2" type="text" placeholder="Buscar ...">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>

                    <ul class="navbar-nav flex-row mr-lg-0">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light dropdown-toggle mr-3 mr-lg-0 mgl " id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret text-light">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/user/profile/{{auth()->id()}}">
                                    Meu Perfil
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>

                </div>
            </nav>
       

        <div class="container-fluid">

            <main class="py-4">
                <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Criar Projeto</div>

                <div class="card-body">
                    <form method="post" id="formProject" action="/projects" enctype="multipart/form-data" class="lef">

                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="title" maxlength="34">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrição do projeto') }}</label>

                            <div class="col-md-6">
                                <textarea name="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo do projeto') }}</label>

                            <div class="col-md-6">
                                <select name="type">
                                  <option value="1">Foto</option>
                                  <option value="2">Vídeo</option>
                                  <option value="3" data-toggle="tooltip" title="Por favor caso seu arquivo for um site envie em formato zip e deixe sua pagína principal nomeada como index">Código
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin: auto auto auto 100px; text-align: center;">
                            <section>
                                <strong>
                                    <p>Por favor caso seu arquivo for um site envie em formato zip <br>e deixe sua pagína principal nomeada como index</p>
                                </strong>                            
                            </section>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Selecionar arquivo: ') }}</label>
                            <div class="col-md-6">
                              <input type="file" name="file" id="file">
                            </div>

                             <div class="progress">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated"></div >
                                <div class="percent"></div >
                            </div>
                        </div>

                            <div id="status"></div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="upload" value="Upload" class="btn btn-success">
                                    {{ __('Enviar projeto') }}
                                </button>
                            </div>
                        </div>                     
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 
    function validate(formData, jqForm, options) {
        var form = jqForm[0];
        if (!form.file.value) {
            alert('File not found');
            return false;
        }
    }
 
    (function() {
 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
 
    $('form').ajaxForm({
        beforeSubmit: validate,
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            var posterValue = $('input[name=file]').fieldValue();
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = 'Wait, Saving';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            let resultado = JSON.parse(xhr.responseText);
            status.html(resultado.success);
            //window.location.href = "/projects";
        }
    });
     
    })();
</script>
            </main>
    </div>
</body>
</html>

 




@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="container">
        <div class="card-body fildcontainer" style="border: border-box; margin-left: 0px; ">
            <form method="post" id="formProject" action="/projects" enctype="multipart/form-data" class="lef">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label py-2 text-md-right">{{ __('Titulo') }}</label>

                        <div class="col-md-6">
                            <input type="text" name="title" maxlength="34" class="my-2 form-control inputformact">

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
                            <textarea class="form-control" name="description"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-md-4 mt-0 pt-0 col-form-label text-md-right">{{ __('Tipo do projeto') }}</label>

                        <div class="col-md-6">
                            <select name="type">
                                <option value="1">Foto</option>
                                <option value="2">Vídeo</option>
                                <option value="3" data-toggle="tooltip" title="Por favor caso seu arquivo for um site envie em formato zip e deixe sua pagína principal nomeada como index">Arquivos e Sites
                            </select>
                        </div>
                    </div>
                    <div class="row helper">
                        <section>
                            <strong>
                                <p class=" center center-responsive" >Por favor caso seu arquivo for um site envie em formato zip <br>e deixe sua pagína principal nomeada como index</p>
                            </strong>                            
                        </section>
                    </div>

                    <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Selecionar arquivo: ') }}</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control px-1 py-1 mx-1" name="file" id="file">
                        </div>
                        <div style="display: relative; border: border-box; margin-left: 0px; padding:0px 10px 0px 0px;" class="container center">
                            <div style="display: absolute; width: 97%; padding-left: 0%;" class="progress form-control w-loading-100 align-content-center">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated"></div>
                                <div class="percent"></div>
                            </div>
                        </div>
                    </div>

                    <div id="status"></div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="upload" value="Upload" class="btn my-2 btn-success">
                                {{ __('Enviar projeto') }}
                            </button>
                        </div>
                    </div>                     
                </form>
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

@endsection
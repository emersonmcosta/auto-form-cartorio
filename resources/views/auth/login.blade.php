@extends('base')
    <div class="login-container">
        <div class="login-card text-white" style="width:45dvh">

            <img src="{{asset('img/logo-branco.png')}}" alt="" style="width: 100px; padding-bottom: 15px;" class="logo">
 

            <div id="mensagem" class="border p-2 text-dark bg-white small"></div>

            <div class="mb-3">
                <label for="email" class="form-label">Usuário</label>
                <input type="text" id="email" class="form-control" placeholder="digite seu email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" class="form-control" placeholder="digite sua senha">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button id="btnLogin" class="btn btn-primary w-100 shadow">LOGAR</button>
        </div>
    </div>

    <!-- Modal de loading -->
    <div class="modal fade" id="modal-loading" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


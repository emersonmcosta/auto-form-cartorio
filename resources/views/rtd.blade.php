@extends('base')

<section class="ftco-section">
    <div class="container">
        <div class="col-md-12 text-center mb-3 justify-content-center">
            <img src="{{asset('img/logo-branco.png')}}" alt="">
            <div class="text-white text-lg">
                RTD - Registro de Títulos e Documentos
            </div>
        </div>
        <div class="card p-5">
        <div class="row justify-content-center" id="options">
            <div class="col-lg-10 col-md-12">
                <a href="/RTD/assembleia-de-condominio">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">Assembleia de Condomínio</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="/">
                    <button class="btn btn-danger mb-4 fw-bold text-dark text-lg w-100">Voltar</button>
                </a>
            </div>
        </div>
    </div>
    </div>
</section>
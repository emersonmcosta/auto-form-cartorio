@extends('base')

<section class="ftco-section">
    <div class="container">
        <div class="col-md-12 text-center mb-3 justify-content-center">
            <img src="{{asset('img/logo-branco.png')}}" alt="">
        </div>
        <div class="card p-5">
        <div class="row justify-content-center" id="options">
            <div class="col-lg-10 col-md-12">
                <a href="RCPJ">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">RCPJ - Registro Civil das Pessoas Jurídicas</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="PET">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">Registro de PET</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="RTD">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">RTD - Registro de Títulos e Documentos</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="NT" >
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">Notificação Extrajudicial</button>
                </a>
            </div>
        </div>
    </div>
    </div>
</section>
@extends('base')

<section class="ftco-section">
    <div class="container">
        <div class="col-md-12 text-center mb-3 justify-content-center">
            <img src="{{asset('img/logo-branco.png')}}" alt="">
            <div class="text-white text-lg">
                Notificação Extrajudicial
            </div>
        </div>
        <div class="card p-5">
        <div class="row justify-content-center" id="options">
            <div class="col-lg-10 col-md-12">
                <a href="{{route('NT-ADE')}}">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">{{$LABELS::BTN_ABANDONO_EMPREGO}}</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="{{route('NT-CDD')}}">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">{{$LABELS::BTN_COBRANCA_DIVIDA}}</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="{{route('NT-DVBI')}}">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">{{$LABELS::BTN_DESOCUPACAO_VOLUNTARIA}}</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="{{route('NT-RDP')}}" >
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">{{$LABELS::BTN_REVOGACAO_PROCURACAO}}</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="{{route('NT-RLI')}}" >
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">{{$LABELS::BTN_RECISAO_CONTRATUAL_IMOVEL}}</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="{{route('NT-TL')}}" >
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">{{$LABELS::BTN_TEXTO_LIVRE}}</button>
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
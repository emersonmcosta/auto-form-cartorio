@extends('base')

<section class="ftco-section">
    <div class="container">
        <div class="col-md-12 text-center mb-3 justify-content-center">
            <img src="{{asset('img/logo-branco.png')}}" alt="">
            <div class="text-white text-lg">
                RCPJ - Registro Civil das Pessoas Jurídicas
            </div>
        </div>
        <div class="card p-5">
        <div class="row justify-content-center" id="options">
            <div class="col-lg-10 col-md-12">
                <a href="/RCPJ/constituicao-associacao">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">Constituição de Associação</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="/RCPJ/constituicao-sociedade-simples">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100">Constituição de Sociedade Simples</button>
                </a>
            </div>
            <div class="col-lg-10 col-md-12">
                <a href="/RCPJ/constituicao-sociedade-simples-unipessoal">
                    <button class="btn btn-info mb-4 fw-bold text-dark text-lg w-100"> Constituição de Sociedade Simples Unipessoal</button>
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
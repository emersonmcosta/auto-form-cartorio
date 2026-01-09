@extends('base')

@section('content')
<section class="ftco-section">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10 text-center mb-5">
                <h2 class="heading-section">RCPJ - Constituição de Associação</h2>
            </div>
        </div>

        <form method="POST" id="formDocument" name="formDocument" class="formDocument">
            @csrf            

            {{-- ================================
                 INFORMAÇÕES GERAIS
            ================================= --}}
            <h4>Informações Gerais</h4>
            <div class="row">
                <div class="col-md-12 mb-3"> 
                    <label class="form-label">Nome da Associação *</label>
                    <input type="text" name="campo_1" class="form-control" data-request="true">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data da Assembleia *</label>
                    <input type="date" name="campo_2" class="form-control" data-request="true">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Hora da Assembleia *</label>
                    <input type="time" name="campo_3" class="form-control" data-request="true">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Nome de quem convocou *</label>
                    <input type="text" name="campo_4" class="form-control" data-request="true">
                </div>
            </div>

            {{-- ================================
                 ENDEREÇO
            ================================= --}}
            <h4>Endereço da Associação</h4>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Endereço completo *</label>
                    <input type="text" name="campo_5" class="form-control" data-request="true">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">CEP *</label>
                    <input type="text" name="campo_6" class="form-control" data-request="true">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Bairro *</label>
                    <input type="text" name="campo_7" class="form-control" data-request="true">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Cidade/UF *</label>
                    <input type="text" name="campo_8" class="form-control" data-request="true">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nº anos do mandato *</label>
                    <input type="number" name="campo_9" class="form-control" data-request="true">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data final do mandato *</label>
                    <input type="date" name="campo_10" class="form-control" data-request="true">
                </div>
            </div>

            {{-- ================================
                 DIRETORIA (LAÇO)
            ================================= --}}
            @php $n = 11; @endphp

            @foreach ([
                'Presidente',
                'Vice-Presidente',
                'Secretário',
                'Tesoureiro',
                '1º Conselheiro',
                '2º Conselheiro',
                '3º Conselheiro'
            ] as $cargo)

                <h4>{{ $cargo }}</h4>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">CPF</label>
                        <input type="text" name="campo_{{ $n++ }}" class="form-control cpf_cnpj" data-request="true">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Endereço completo</label>
                        <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Profissão</label>
                        <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Estado civil</label>
                        <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nacionalidade</label>
                        <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                    </div>
                </div>

            @endforeach

            {{-- ================================
                 ESTATUTO SOCIAL
            ================================= --}}
            <h4>Estatuto Social</h4>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Finalidades</label>

                    <input class="form-control mb-3" name="campo_{{ $n++ }}" data-request="true">
                    <input class="form-control mb-3" name="campo_{{ $n++ }}" data-request="true">
                    <input class="form-control mb-3" name="campo_{{ $n++ }}" data-request="true">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Antecedência mínima</label>
                    <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                </div>
            </div>

            {{-- ================================
                 ADVOGADO
            ================================= --}}
            <h4>Sobre o Advogado</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nº da OAB/UF</label>
                    <input type="text" name="campo_{{ $n++ }}" class="form-control" data-request="true">
                </div>
            </div>

            @include('forms.buttons-footer', [
                'actionRoute' => '/RCPJ/constituicao-associacao',
                'backRoute' => '/RCPJ'
            ])

        </form>
    </div>
</section>
@endsection

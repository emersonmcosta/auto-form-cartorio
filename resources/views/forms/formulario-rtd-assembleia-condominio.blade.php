<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulário - Assembleia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet" />

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #1d352c;
            color: #fff;
        }

        .form-control,
        .form-select {
            background-color: #fff;
            color: #000;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-warning {
            color: #000;
        }

        .title {
            font-size: 1.5rem;
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
    
</head>

<body>

    <div class="container py-4">
        <div class="col-md-10 text-center mb-5">
            <h2 class="title">FORMULÁRIO - CONVOCAÇÃO DE ASSEMBLEIA</h2>
        </div>

        <form id="formDocument" method="POST" action="/RTD/assembleia-de-condominio">
            @csrf
            <!-- Labels para todos os inputs -->
            <!-- Dados do condomínio -->
            <h5>Dados do Condomínio</h5>
            <div class="row mb-3">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-6">
                    <label for="nome_condominio" class="form-label">Nome do Condomínio</label>
                    <input type="text" class="form-control" id="nome_condominio" name="nome_condominio" placeholder="Nome do Condomínio" required data-request="true" />
                </div>
                <div class="col-md-6">
                    <label for="cnpj_condominio" class="form-label">CNPJ do Condomínio</label>
                    <input type="text" class="form-control" id="cnpj_condominio" name="cnpj_condominio" placeholder="CNPJ do Condomínio" required data-request="true" />
                </div>
            </div>


            <!-- Dados da Assembleia -->
            <h5>Dados da Assembleia</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="data_assembleia" class="form-label">Data da Assembleia</label>
                    <input type="text" class="form-control" id="data_assembleia" name="data_assembleia" required data-request="true" />
                </div>
                <div class="col-md-6">
                    <label for="hora_assembleia" class="form-label">Hora 1ª Convocação</label>
                    <input type="text" class="form-control" id="hora_assembleia" name="hora_assembleia" placeholder="Hora 1ª Convocação" required data-request="true" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="horario_segunda_convocacao" class="form-label">Hora 2ª Convocação</label>
                    <input type="text" class="form-control" id="horario_segunda_convocacao" name="horario_segunda_convocacao" placeholder="Hora 2ª Convocação" required data-request="true" />
                </div>
                <div class="col-md-3">
                    <label for="hora_fim" class="form-label">Hora Encerramento</label>
                    <input type="text" class="form-control" id="hora_fim" name="hora_fim" placeholder="Hora término" required data-request="true" />
                </div>
                <div class="col-md-3">
                    <label for="tipo_assembleia" class="form-label">Tipo (Ordinária/Extraordinária)</label>
                    <select class="form-select" id="tipo_assembleia" name="tipo_assembleia" required data-request="true">
                        <option value="" disabled selected>Selecione</option>
                        <option value="Ordinária">Ordinária</option>
                        <option value="terça-feira">Extraordinária</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dia_semana" class="form-label">Dia da Semana</label>
                    <select class="form-select" id="dia_semana" name="dia_semana" required data-request="true">
                        <option value="" disabled selected>Selecione o dia da semana</option>
                        <option value="segunda-feira">Segunda-feira</option>
                        <option value="terça-feira">Terça-feira</option>
                        <option value="quarta-feira">Quarta-feira</option>
                        <option value="quinta-feira">Quinta-feira</option>
                        <option value="sexta-feira">Sexta-feira</option>
                        <option value="sábado">Sábado</option>
                        <option value="domingo">Domingo</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="qnt_minima_pessoas" class="form-label">Quantidade requerida</label>
                    <select class="form-select" id="qnt_minima_pessoas" name="qnt_minima_pessoas" required data-request="true">
                        <option value="" disabled selected>Selecione</option>
                        <option value="1/3 (Um terço)">1/3</option>
                        <option value="2/3 (Dois terços)">2/3</option>
                        <option value="3/3 (Três terços)">3/3</option>
                    </select>
                </div>
            </div>

            <!-- Endereço -->
            <div class="row mb-3">
                <div class="col">
                    <label for="endereco_completo" class="form-label">Endereço completo</label>
                    <input type="text" class="form-control" id="endereco_completo" name="endereco_completo" placeholder="Endereço completo" required data-request="true" />
                </div>
            </div>
            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="obs" name="obs" placeholder="Informações complementares" rows="4" required data-request="true"></textarea>
            </div>
            <!-- Participantes -->
            <h5>Participantes</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome_sindico" class="form-label">Nome do(a) Síndico(a)</label>
                    <input type="text" class="form-control" id="nome_sindico" name="nome_sindico" placeholder="Nome do(a) Síndico(a)" required data-request="true" />
                </div>
                <div class="col-md-6">
                    <label for="nome_secretario" class="form-label">Nome do(a) Secretário(a)</label>
                    <input type="text" class="form-control" id="nome_secretario" name="nome_secretario" placeholder="Nome do(a) Secretário(a)" required data-request="true" />
                </div>
            </div>

            <!-- Assuntos -->
            <h5>Assuntos da Assembleia</h5>
            <div class="mb-3">
                <label for="assuntos_assembleia" class="form-label">Ordem do dia </label>
                <textarea class="form-control" id="assuntos_assembleia" name="assuntos_assembleia" placeholder="Ordem do dia " rows="4" required data-request="true"></textarea>
            </div>

            <h5>Descrição dos Assuntos</h5>
            <div class="mb-3">
                <label for="descricao_assuntos_assembleia" class="form-label">Descrição </label>
                <textarea class="form-control" id="descricao_assuntos_assembleia" name="descricao_assuntos_assembleia" placeholder="Descrição " rows="4" required data-request="true"></textarea>
            </div>

            <!-- Botões -->
            @include('forms.buttons-footer', ['actionRoute' => '/RTD/assembleia-de-condominio', 'backRoute' => '/RTD'])

        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/jquery-mask.min.js"></script>
    <script src="../js/sweetalert-2.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        $(function() {
            $('#hora_assembleia, #horario_segunda_convocacao, #hora_fim').mask('00:00');
        });
        $('#cnpj_condominio').mask('00.000.000/0000-00');
        $('#data_assembleia').mask('00/00/0000');
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Declaração de Guarda de Animais Domésticos</title>
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
    <div class="container mt-4 mb-4">
        <div class="col-md-10 text-center mb-5">
            <h2 class="mb-4">Declaração de Guarda de Animais Domésticos</h2>
        </div>

        <form id="formDocument" method="POST" enctype="multipart/form-data" action="/PET/guarda-individual-animal-domestico-compartilhada">
            @csrf
            <!-- Foto do Animal -->
            <div class="form-section">
                <div class="form-title">Foto de Identificação do Animal</div>
                <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" name="foto_animal">
            </div>

            <!-- Dados do Animal -->
            <div class="form-section">
                <div class="row">

                    <h5 class="form-title mt-3">Informações do Animal</h5>
    
                    <div class="mb-3 col-6">
                        <label>Nome:</label>
                        <input type="text" class="form-control" name="nome_animal">
                    </div>
    
                    <div class="mb-3 col-6">
                        <label>Espécie (Ex.: Cachorro, Gato, Coelho):</label>
                        <input type="text" class="form-control" name="especie">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Raça:</label>
                        <input type="text" class="form-control" name="raca">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Sexo:</label>
                        <select class="form-control" name="sexo">
                            <option>Macho</option>
                            <option>Fêmea</option>
                        </select>
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Cores:</label>
                        <input type="text" class="form-control" name="cores">
                    </div>
    
                    <div class="mb-3 col-6">
                        <label>Pelagem (Longo/Curto):</label>
                        <input type="text" class="form-control" name="pelagem">
                    </div>
    
                    <div class="mb-3 col-6">
                        <label>Data de Nascimento/Adoção:</label>
                        <input type="date" class="form-control" name="data_nascimento">
                    </div>
    
                    <div class="mb-3 col-12">
                        <label>Características físicas adicionais:</label>
                        <textarea class="form-control" name="caracteristicas_fisicas" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <hr/>
            <!-- Dados do Tutor 1 -->
            <div class="form-section">
                <div class="row">
                    <h5 class="form-title">Informações do Tutor 1</h5>
    
                    <div class="mb-3 col-8">
                        <label>Nome completo:</label>
                        <input type="text" class="form-control" name="nome_tutor">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Contato (DDD + número):</label>
                        <input type="text" class="form-control" name="contato">
                    </div>
    
                    <div class="mb-3 col-12">
                        <label>Endereço completo:</label>
                        <textarea class="form-control" name="endereco" rows="2"></textarea>
                    </div>
    
                    <!-- <div class="mb-3 col-4">
                        <label>País:</label>
                        <input type="text" class="form-control" name="pais">
                    </div> -->
    
                    <div class="mb-3 col-4">
                        <label>Nacionalidade:</label>
                        <input type="text" class="form-control" name="nacionalidade">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Estado Civil:</label>
                        <input type="text" class="form-control" name="estado_civil">
                    </div>
    
                    <div class="mb-3 col-12">
                        <label>Profissão:</label>
                        <input type="text" class="form-control" name="profissao">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Identidade (RG/CNH) e Órgão Expedidor:</label>
                        <input type="text" class="form-control" name="identidade">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>CPF:</label>
                        <input type="text" class="form-control cpf" name="cpf">
                    </div>
                </div>
            </div>
            <hr/>
            <!-- Dados do Tutor 2 -->
            <div class="form-section">
                <div class="row">
                    <h5 class="form-title">Informações do Tutor 2</h5>
    
                    <div class="mb-3 col-8">
                        <label>Nome completo:</label>
                        <input type="text" class="form-control" name="nome_tutor_2">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Contato (DDD + número):</label>
                        <input type="text" class="form-control" name="contato_2">
                    </div>
    
                    <div class="mb-3 col-12">
                        <label>Endereço completo:</label>
                        <textarea class="form-control" name="endereco_2" rows="2"></textarea>
                    </div>
    
                    <!-- <div class="mb-3 col-4">
                        <label>País:</label>
                        <input type="text" class="form-control" name="pais">
                    </div> -->
    
                    <div class="mb-3 col-4">
                        <label>Nacionalidade:</label>
                        <input type="text" class="form-control" name="nacionalidade_2">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Estado Civil:</label>
                        <input type="text" class="form-control" name="estado_civil_2">
                    </div>
    
                    <div class="mb-3 col-12">
                        <label>Profissão:</label>
                        <input type="text" class="form-control" name="profissao_2">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>Identidade (RG/CNH) e Órgão Expedidor:</label>
                        <input type="text" class="form-control" name="identidade_2">
                    </div>
    
                    <div class="mb-3 col-4">
                        <label>CPF:</label>
                        <input type="text" class="form-control cpf" name="cpf_2">
                    </div>
                </div>
            </div>
            <hr/>
            <!-- Declaração -->
            <div class="form-section row">
                <div class="form-title col-12">
                    <h5>Declaração</h5>
                    <p>Declaro, sob as penas da lei, que o animal acima descrito está sob a minha guarda e responsabilidade. Estou ciente das legislações aplicáveis e comprometo-me a zelar pelo bem-estar do animal conforme as normas legais vigentes.</p>
                </div>
            </div>

            <!-- Local e Data -->
            <div class="form-section">
                <div class="row">
                    <!-- <div class="mb-3 col-8">
                        <label>Cidade:</label>
                        <input type="text" class="form-control" name="cidade">
                    </div> -->
    
                    <div class="mb-3 col-4">
                        <label>Data:</label>
                        <input type="date" class="form-control" name="data_declaracao" value="{{date('Y-m-d')}}">
                    </div>
                </div>
            </div>

            <!-- Assinatura -->
            <div class="d-flex justify-content-between">
                <div class="form-section row">
                    <div class="col-12">
                        <div class="form-title">Assinatura do Tutor 1</div>
                        <p>______________________________</p>
                    </div>
                </div>
    
                <div class="form-section row">
                    <div class="col-12">
                        <div class="form-title">Assinatura do Tutor 2</div>
                        <p>______________________________</p>
                    </div>
                </div>
            </div>

            @include('forms.buttons-footer', ['actionRoute' => '/PET/guarda-individual-animal-domestico-compartilhada', 'backRoute' => '/PET'])

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/jquery-mask.min.js"></script>
    <script src="../js/sweetalert-2.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>
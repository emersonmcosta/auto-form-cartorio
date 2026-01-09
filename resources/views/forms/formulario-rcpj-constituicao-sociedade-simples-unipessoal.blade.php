@extends('base')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center mb-5">
                <h2 class="heading-section">FORMULÁRIO - CONSTITUIÇÃO DE SOCIEDADE</h2>
            </div>
        </div>
        <form method="POST" id="formDocument" name="formDocument" class="formDocument">
            @csrf    
            <h4>Sócio</h4>
            <div id="socios-container"> 
                <div class="row">
                    <div class="mb-3 col-6"><input class="form-control mb-2" name="nome" placeholder="Nome" data-request="true" /></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="nacionalidade" placeholder="Nacionalidade" data-request="true" /></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="profissao" placeholder="Profissão" data-request="true"/></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="estado_civil" placeholder="Estado Civil" data-request="true" /></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="cpf" placeholder="CPF" data-request="true" /></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="rg" placeholder="RG ou Carteira Profissional" data-request="true" /></div>
                    <div class="mb-3 col-6"><input class="form-control mb-2" name="endereco" placeholder="Endereço Completo" data-request="true" /></div>
                </div>
            </div>

            <h4 class="mt-4">Dados da Sociedade</h4>
            <div class="row">
                <div class="mb-3 col-2"><input type="text" class="form-control" name="data_documento" placeholder="Data do documento" data-request="true" /></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="razao_social" placeholder="Razão Social da Empresa" data-request="true" /></div>
                <div class="mb-3 col-6"><input type="text" class="form-control" name="nome_fantasia" placeholder="Nome Fantasia" data-request="true" /></div>
                <div class="mb-3"><textarea class="form-control" name="objetos_sociais" rows="3" placeholder="Descrever os objetos sociais da empresa" data-request="true"></textarea></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="endereco_empresa" placeholder="Rua, Número, Complemento" data-request="true" /></div>
                <div class="mb-3 col-2"><input type="text" class="form-control" name="cep_empresa" placeholder="cep" data-request="true" /></div>
                <div class="mb-3 col-3"><input type="text" class="form-control" name="bairro_empresa" placeholder="Bairro" data-request="true" /></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="capital_social" placeholder="Capital Social" data-request="true" /></div>
                <div class="mb-3 col-8"><input type="text" class="form-control" name="capital_social_extenso" placeholder="Capital social por extenso" data-request="true" /></div>
            </div>
            @include('forms.buttons-footer', ['actionRoute' => '/RCPJ/constituicao-sociedade-simples-unipessoal', 'backRoute' => '/RCPJ'])
        </form>
    </div>
    <script>
        let contadorSocios = 0;
        $(document).ready(function() {
            $('input[name="cpf"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 11) value = value.slice(0, 11);
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                $(this).val(value);
            });

            $('input[name="rg"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 12) value = value.slice(0, 12);
                $(this).val(value);
            });
            $('input[name="cep_empresa"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 8) value = value.slice(0, 8);
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
                $(this).val(value);
            });
            $('input[name="data_documento"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 8) value = value.slice(0, 8);
                value = value.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
                $(this).val(value);
            });
            $('input[name="capital_social"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 15) value = value.slice(0, 15);
                value = value.replace(/(\d)(\d{2})$/, '$1,$2');
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                $(this).val(value);
            });
        });
    </script>
</body>

</html>
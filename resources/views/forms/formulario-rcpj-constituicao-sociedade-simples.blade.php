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
            <h4>Sócios</h4>
            <div id="socios-container"></div>
            <button type="button" class="btn btn-outline-light mb-4" onclick="adicionarSocio()">+ Adicionar Sócio</button>

            <h4 class="mt-4">Dados da Sociedade</h4>
            <div class="row">
                <div class="mb-3 col-2"><input type="date" class="form-control" name="data_documento" placeholder="Data do documento"></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="razao_social" placeholder="Razão Social da Empresa"></div>
                <div class="mb-3 col-6"><input type="text" class="form-control" name="nome_fantasia" placeholder="Nome Fantasia"></div>
                <div class="mb-3"><textarea class="form-control" name="objetos_sociais" rows="3" placeholder="Descrever os objetos sociais da empresa"></textarea></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="endereco" placeholder="Rua, Número, Complemento"></div>
                <div class="mb-3 col-2"><input type="text" class="form-control" name="cep" placeholder="cep"></div>
                <div class="mb-3 col-3"><input type="text" class="form-control" name="bairro" placeholder="Bairro"></div>
                <div class="mb-3 col-3"><input type="text" class="form-control" name="cidade_uf" placeholder="Cidade/UF"></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="capital_social" placeholder="Capital Social"></div>
                <div class="mb-3 col-8"><input type="text" class="form-control" name="capital_social_extenso" placeholder="Capital social por extenso"></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="numero_cotas" placeholder="Número de Cotas"></div>
                <div class="mb-3 col-8"><input type="text" class="form-control" name="numero_cotas_extenso" placeholder="Número de cotas por extenso"></div>
                <div class="mb-3 col-4"><input type="text" class="form-control" name="valor_cota" placeholder="Valor por cota"></div>
                <div class="mb-3 col-8"><input type="text" class="form-control" name="valor_cota_extenso" placeholder="Valor cota por extenso"></div>
            </div>
            @include('forms.buttons-footer', ['actionRoute' => '/RCPJ/constituicao-sociedade-simples', 'backRoute' => '/RCPJ'])
        </form>
    </div>
    <script>
        let contadorSocios = 0;

        function adicionarSocio() {
            contadorSocios++;
            const container = document.getElementById("socios-container");
            const socioHTML = `
                <div class="socio-card row">
                    <h5>Sócio ${contadorSocios}</h5>
                    <div class="mb-3 col-6"><input class="form-control mb-2" name="socio_nome_${contadorSocios}" placeholder="Nome"></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="socio_nacionalidade_${contadorSocios}" placeholder="Nacionalidade"></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="socio_profissao_${contadorSocios}" placeholder="Profissão"></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="socio_estado_civil_${contadorSocios}" placeholder="Estado Civil"></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="socio_cpf_${contadorSocios}" placeholder="CPF"></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="socio_rg_${contadorSocios}" placeholder="RG ou Carteira Profissional"></div>
                    <div class="mb-3 col-6"><input class="form-control mb-2" name="socio_endereco_${contadorSocios}" placeholder="Endereço Completo"></div>
                    <div class="mb-3 col-2"><input class="form-control mb-2" name="valor_cota_socio_${contadorSocios}" placeholder="Valor da cota do sócio"></div>
                    <div class="mb-3 col-2">
                        <select class="form-control mb-2" name="socio_admin_${contadorSocios}">
                        <option value="Sim" selected>Sócio administrador?</option>
                        <option value="Sim" >Sim</option>
                        <option value="Não">Não</option>
                        </select>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', socioHTML);
        }

        window.onload = () => adicionarSocio();
    </script>
</body>

</html>
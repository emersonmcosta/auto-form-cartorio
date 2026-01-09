@extends('base')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center mb-5">
                <h2 class="heading-section">FORMULÁRIO NT - COBRANÇA DE DÍVIDA</h2>
            </div>
        </div>
        <form method="POST" id="formDocument" name="formDocument" class="formDocument">
            @csrf
            <div class="row">
                <h5 class="text-white">{{$LABELS::DADOS_NOTIFICADO}}</h5>
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="form-group w-50 pr-1">
                        <label class="text-white">{{$LABELS::NOME_NOTIFICADO}} *</label>
                        <input type="text" class="form-control" name="{{$INPUTS::NOME_NOTIFICADO}}" id="{{$INPUTS::NOME_NOTIFICADO}}" placeholder="{{$PLACEHOLDER::NOME_COMPLETO}}" field="{{$LABELS::NOME_NOTIFICADO}}" data-request="true">
                    </div>
                    <div class="form-group w-50 pl-1">
                        <label class="text-white">{{$LABELS::CPF_CNPJ}} *</label>
                        <input type="text" class="form-control cpf_cnpj" name="{{$INPUTS::CPF_CNPJ_NOTIFICADO}}" id="{{$INPUTS::CPF_CNPJ_NOTIFICADO}}" placeholder="{{$PLACEHOLDER::CPF_CNPJ}}" field="{{$LABELS::CPF_CNPJ}}" data-request="true">
                    </div>
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label class="text-white">{{$LABELS::ENDERECO_COMPLETO}} *</label>
                        <input type="text" class="form-control" name="{{$INPUTS::ENDERECO_NOTIFICADO}}" id="{{$INPUTS::ENDERECO_NOTIFICADO}}" placeholder="{{$PLACEHOLDER::ENDERECO_COMPLETO}}" field="{{$LABELS::ENDERECO_COMPLETO}}" data-request="true">
                    </div>
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label class="text-white">{{$LABELS::DADOS_COMPLEMENTARES}}</label>
                        <textarea type="text" class="form-control" name="{{$INPUTS::DADOS_COMPLEMENTARES}}" id="{{$INPUTS::DADOS_COMPLEMENTARES}}" placeholder="{{$PLACEHOLDER::DADOS_COMPLEMENTARES}}"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <h5 class="text-white">{{$LABELS::DADOS_NOTIFICANTE}}</h5>
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="form-group w-50 pr-1">
                        <label class="text-white">{{$LABELS::NOME_NOTIFICANTE}} *</label>
                        <input type="text" class="form-control" name="{{$INPUTS::NOME_NOTIFICANTE}}" id="{{$INPUTS::NOME_NOTIFICANTE}}" placeholder="{{$PLACEHOLDER::NOME_COMPLETO}}" field="{{$LABELS::NOME_NOTIFICANTE}}" data-request="true">
                    </div>
                    <div class="form-group w-50 pl-1">
                        <label class="text-white">{{$LABELS::CPF_CNPJ}} *</label>
                        <input type="text" class="form-control cpf_cnpj" name="{{$INPUTS::CPF_CNPJ_NOTIFICANTE}}" id="{{$INPUTS::CPF_CNPJ_NOTIFICANTE}}" placeholder="{{$PLACEHOLDER::CPF_CNPJ}}" field="{{$LABELS::CPF_CNPJ}}" data-request="true">
                    </div>
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label class="text-white">{{$LABELS::ENDERECO_COMPLETO}} *</label>
                        <input type="text" class="form-control" name="{{$INPUTS::ENDERECO_NOTIFICANTE}}" id="{{$INPUTS::ENDERECO_NOTIFICANTE}}" placeholder="{{$PLACEHOLDER::ENDERECO_COMPLETO}}" field="{{$LABELS::ENDERECO_COMPLETO}}" data-request="true">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <h5 class="text-white mt-2">{{$LABELS::DADOS_NOTIFICACAO}}</h5>
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="form-group w-50 pr-1">
                        <label class="text-white">{{$LABELS::DATA_OPERACAO}} *</label>
                        <input type="date" class="form-control" name="{{$INPUTS::DATA_OPERACAO}}" id="{{$INPUTS::DATA_OPERACAO}}" field="{{$LABELS::DATA_OPERACAO}}" data-request="true">
                    </div>
                    <div class="form-group w-50 pl-1">
                        <label class="text-white">{{$LABELS::VALOR_INICIAL}} *</label>
                        <input type="text" class="form-control valor" name="{{$INPUTS::VALOR_INICIAL}}" id="{{$INPUTS::VALOR_INICIAL}}" placeholder="{{$PLACEHOLDER::VALOR}}" field="{{$LABELS::VALOR_INICIAL}}" data-request="true">
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="form-group w-50 pr-1">
                        <label class="text-white">{{$LABELS::DATA_PAGAMENTO}} *</label>
                        <input type="date" class="form-control"  name="{{$INPUTS::DATA_PAGAMENTO}}" id="{{$INPUTS::DATA_PAGAMENTO}}" field="{{$LABELS::DATA_PAGAMENTO}}" data-request="true">
                    </div>
                    <div class="form-group w-50 pl-1">
                        <label class="text-white">{{$LABELS::VALOR_ATUALIZADO}} *</label>
                        <input type="text" class="form-control valor" name="{{$INPUTS::VALOR_ATUALIZADO}}" id="{{$INPUTS::VALOR_ATUALIZADO}}" placeholder="{{$PLACEHOLDER::VALOR}}" field="{{$LABELS::VALOR_ATUALIZADO}}" data-request="true">
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="form-group w-50 pr-1">
                        <label class="text-white">{{$LABELS::PRAZO_PAGAMENTO_DIAS}} *</label>
                        <input type="number" class="form-control" name="{{$INPUTS::PRAZO_PAGAMENTO}}" id="{{$INPUTS::PRAZO_PAGAMENTO}}" placeholder="{{$PLACEHOLDER::PRAZO_PAGAMENTO_DIAS}}" field="{{$LABELS::PRAZO_PAGAMENTO_DIAS}}" data-request="true">
                    </div>
                </div>
            </div>
            <div class="row">
                <h5 class="text-white mt-2">{{$LABELS::DADOS_BANCARIOS}}</h5>
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="form-group w-25 pr-1">
                        <label class="text-white">{{$LABELS::CONTA}} *</label>
                        <input type="text" class="form-control" name="{{$INPUTS::CONTA_BANCARIA}}" id="{{$INPUTS::CONTA_BANCARIA}}" placeholder="{{$PLACEHOLDER::CONTA}}" field="{{$LABELS::CONTA}}" data-request="true">
                    </div>
                    <div class="form-group w-25 pl-1">
                        <label class="text-white">{{$LABELS::AGENCIA}} *</label>
                        <input type="text" class="form-control" name="{{$INPUTS::AGENCIA_BANCARIA}}" id="{{$INPUTS::AGENCIA_BANCARIA}}" placeholder="{{$PLACEHOLDER::AGENCIA}}" field="{{$LABELS::AGENCIA}}" data-request="true">
                    </div>
                    <div class="form-group w-50 pl-2">
                        <label class="text-white">{{$LABELS::BANCO}} *</label>
                        <select class="form-control" name="{{$INPUTS::BANCO_BANCARIA}}" id="{{$INPUTS::BANCO_BANCARIA}}" field="{{$LABELS::BANCO}}" data-request="true">
                            <option>Selecione uma opção</option>
                            @foreach ($bancos as $banco)
                                <option value="{{$banco}}">{{$banco}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-between">
                    <div class="form-group w-50 pr-1">
                        <label class="text-white">{{$LABELS::NOME_FAVORECIDO}} *</label>
                        <input type="text" class="form-control" name="{{$INPUTS::FAVORECIDO_BANCARIA}}" id="{{$INPUTS::FAVORECIDO_BANCARIA}}" placeholder="{{$PLACEHOLDER::NOME_COMPLETO}}" field="{{$LABELS::NOME_FAVORECIDO}}" data-request="true">
                    </div>
                    <div class="form-group w-50 pl-1">
                        <label class="text-white">{{$LABELS::CPF_CNPJ}} *</label>
                        <input type="text" class="form-control cpf_cnpj" name="{{$INPUTS::CPF_CNPJ_BANCARIO}}" id="{{$INPUTS::CPF_CNPJ_BANCARIO}}" placeholder="{{$PLACEHOLDER::CPF_CNPJ}}" field="{{$LABELS::CPF_CNPJ}}" data-request="true">
                    </div>
                </div>

            </div>
            @include('forms.buttons-footer', ['actionRoute' => '/NT/NT-CDD', 'backRoute' => '/NT'])
        </form>
    </div>
</section>
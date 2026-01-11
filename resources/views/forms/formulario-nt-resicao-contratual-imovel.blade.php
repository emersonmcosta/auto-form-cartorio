@extends('base')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center mb-5">
                <h2 class="heading-section">FORMULÁRIO NT - RESIÇÃO CONTRATUAL LOCAÇÃO DE IMÓVEL</h2>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-white">{{$LABELS::DADOS_ENDERECO_IMOVEL}} *</label>
                        <textarea type="date" class="form-control" 
                            name="{{$INPUTS::DADOS_ENDERECO_IMOVEL}}" 
                            id="{{$INPUTS::DADOS_ENDERECO_IMOVEL}}" rows="5" field="{{$LABELS::DADOS_ENDERECO_IMOVEL}}" data-request="true"></textarea>
                    </div>
                </div>
            </div>
            @include('forms.buttons-footer', ['actionRoute' => '/NT/NT-RLI', 'backRoute' => '/NT'])
        </form>
    </div>
</section>
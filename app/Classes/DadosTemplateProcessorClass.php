<?php

namespace App\Classes;


USE \App\Enums\RequestInputsEnum;
use \IntlDateFormatter;

class DadosTemplateProcessorClass
{
    
    
    public static function getNotificado($request)
    {
        $INPUTS = new RequestInputsEnum();

        $dados = [
            $INPUTS::NOME_NOTIFICADO => $request->input($INPUTS::NOME_NOTIFICADO),
            $INPUTS::DADOS_COMPLEMENTARES => !empty($request->input($INPUTS::DADOS_COMPLEMENTARES)) ? 'Dados complementares: '.$request->input($INPUTS::DADOS_COMPLEMENTARES) : '',
            $INPUTS::CPF_CNPJ_NOTIFICADO => $request->input($INPUTS::CPF_CNPJ_NOTIFICADO),
            $INPUTS::ENDERECO_NOTIFICADO => $request->input($INPUTS::ENDERECO_NOTIFICADO)
        ];

        return $dados;
    }

    public static function getNotificante($request)
    {
        $INPUTS = new RequestInputsEnum();

        $dados = [
            $INPUTS::NOME_NOTIFICANTE => $request->input($INPUTS::NOME_NOTIFICANTE),
            $INPUTS::CPF_CNPJ_NOTIFICANTE => $request->input($INPUTS::CPF_CNPJ_NOTIFICANTE),
            $INPUTS::ENDERECO_NOTIFICANTE => $request->input($INPUTS::ENDERECO_NOTIFICANTE)
        ];

        return $dados;
    }

    public function getDadosBancario($request)
    {
        $INPUTS = new RequestInputsEnum();

        $dados = [
            $INPUTS::CONTA_BANCARIA => $request->input($INPUTS::CONTA_BANCARIA),
            $INPUTS::AGENCIA_BANCARIA => $request->input($INPUTS::AGENCIA_BANCARIA),
            $INPUTS::BANCO_BANCARIA => $request->input($INPUTS::BANCO_BANCARIA),
            $INPUTS::FAVORECIDO_BANCARIA => $request->input($INPUTS::FAVORECIDO_BANCARIA),
            $INPUTS::CPF_CNPJ_BANCARIO => $request->input($INPUTS::CPF_CNPJ_BANCARIO)
        ];

        return $dados;
    }

    public function getDataAtual()
    {
        // Formatação de data para o template
        $data = now(); // Usando a função now() para pegar a data atual
        $fmt = new IntlDateFormatter('pt_BR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'America/Sao_Paulo');
        $dataFormatada = $fmt->format($data);

        $dados = [
            'data_atual' => $dataFormatada
        ];

        return $dados;
    }

}

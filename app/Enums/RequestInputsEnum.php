<?php
declare(strict_types=1);

namespace App\Enums;

class RequestInputsEnum
{
    public const NOME_NOTIFICADO = 'nome_notificado';
    public const CPF_CNPJ_NOTIFICADO = 'cpf_cnpj_notificado';
    public const ENDERECO_NOTIFICADO = 'endereco_notificado';
    public const DADOS_COMPLEMENTARES = 'dados_complementares_notificado';
    public const NOME_NOTIFICANTE = 'nome_notificante';
    public const CPF_CNPJ_NOTIFICANTE = 'cpf_cnpj_notificante';
    public const ENDERECO_NOTIFICANTE = 'endereco_notificante';
    public const DATA_OPERACAO = 'data_operacao';
    public const VALOR_INICIAL = 'valor_inicial';
    public const DATA_PAGAMENTO = 'data_pagamento';
    public const VALOR_ATUALIZADO = 'valor_atualizado';
    public const PRAZO_PAGAMENTO = 'prazo_pagamento';
    public const CONTA_BANCARIA = 'conta_bancario';
    public const AGENCIA_BANCARIA = 'agencia_bancario';
    public const BANCO_BANCARIA = 'banco_bancario';
    public const FAVORECIDO_BANCARIA = 'favorecido_bancario';
    public const CPF_CNPJ_BANCARIO = 'cpf_cnpj_bancario';
    public const DATA_AUSENCIA = 'data_ausencia';
    public const DADOS_ENDERECO_IMOVEL = 'dados_endereco_imovel';
    public const DATA_PROCURACAO = 'data_procuracao';
    public const CARTORIO_PROCURACAO = 'cartorio_procuracao';
    public const LIVRO_PROCURACAO = 'livro_procuracao';
    public const FOLHAS_PROCURACAO = 'folhas_procuracao';
    public const DATA_REVOGACAO = 'data_revogacao';
    public const CARTORIO_REVOGACAO = 'cartorio_revogacao';
    public const LIVRO_REVOGACAO = 'livro_revogacao';
    public const FOLHAS_REVOGACAO = 'folhas_revogacao';
    public const TEXTO_LIVRE = "texto_livre";


    public static function toArray(): array
    {
        return [
            self::NOME_NOTIFICADO,
            self::CPF_CNPJ_NOTIFICADO,
            self::ENDERECO_NOTIFICADO,
            self::DADOS_COMPLEMENTARES,
            self::NOME_NOTIFICANTE,
            self::CPF_CNPJ_NOTIFICANTE,
            self::ENDERECO_NOTIFICANTE,
            self::DATA_OPERACAO,
            self::VALOR_INICIAL,
            self::DATA_PAGAMENTO,
            self::VALOR_ATUALIZADO,
            self::PRAZO_PAGAMENTO,
            self::CONTA_BANCARIA,
            self::AGENCIA_BANCARIA,
            self::BANCO_BANCARIA,
            self::FAVORECIDO_BANCARIA,
            self::CPF_CNPJ_BANCARIO,
            self::DATA_AUSENCIA,
            self::DADOS_ENDERECO_IMOVEL,
            self::DATA_PROCURACAO,
            self::DATA_REVOGACAO,
            self::LIVRO_PROCURACAO,
            self::LIVRO_REVOGACAO,
            self::FOLHAS_PROCURACAO,
            self::FOLHAS_REVOGACAO,
            self::CARTORIO_PROCURACAO,
            self::CARTORIO_REVOGACAO,
            self::TEXTO_LIVRE
        ];
    }
}

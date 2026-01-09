<?php
declare(strict_types=1);

namespace App\Enums;

class LabelFormsEnum
{
    public const BTN_ABANDONO_EMPREGO = 'Abandono de Emprego';
    public const BTN_COBRANCA_DIVIDA = 'Cobrança de dívida';
    public const BTN_DESOCUPACAO_VOLUNTARIA = 'Desocupação voluntária do bem imóvel';
    public const BTN_REVOGACAO_PROCURACAO = 'Revogação de procuração';
    public const BTN_RECISAO_CONTRATUAL_IMOVEL = 'Rescisão contratual de locação imóvel';
    public const BTN_TEXTO_LIVRE = "Texto Livre";
    public const DADOS_NOTIFICADO = 'Dados do Notificado';
    public const NOME_NOTIFICADO = 'Nome do Notificado';
    public const CPF_CNPJ = 'CPF/CNPJ';
    public const ENDERECO_COMPLETO = 'Endereço Completo';
    public const DADOS_COMPLEMENTARES = 'Dados Complementares';
    public const DADOS_NOTIFICANTE = 'Dados do Notificante';
    public const NOME_NOTIFICANTE = 'Nome do Notificante';
    public const DADOS_NOTIFICACAO = 'Dados da Notificação';
    public const DATA_AUSENCIA = 'Data da Ausência';
    public const DADOS_BANCARIOS = 'Dados Bancários';
    public const DATA_OPERACAO = 'Data da Operação';
    public const VALOR_INICIAL = 'Valor Inicial R$';
    public const VALOR_ATUALIZADO = 'Valor Atualizado R$';
    public const DATA_PAGAMENTO = 'Data de Pagamento';
    public const CONTA = 'Conta';
    public const AGENCIA = 'Agência';
    public const BANCO = 'Banco';
    public const PRAZO_PAGAMENTO_DIAS = 'Prazo de Pagamento (dias)';
    public const NOME_FAVORECIDO = 'Nome do Favorecido';
    public const DADOS_ENDERECO_IMOVEL = 'Endereço Completo e Dados do Imóvel a ser Desocupado';
    public const DADOS_PROCURACAO = 'DADOS DO REGISTRO DA PROCURAÇÃO';
    public const DADOS_PROCURACAO_REVOGACAO = 'DADOS DO REGISTRO DA REVOGAÇÃO';
    public const CARTORIO = 'Cartório';
    public const DATA = 'Data';
    public const LIVRO = 'Livro';
    public const FOLHAS = 'Folhas';
    public const TEXTO_LIVRE = "Escreva as Informações do Documento no Campo Abaixo";


    public static function toArray(): array
    {
        return [
            self::BTN_ABANDONO_EMPREGO,
            self::BTN_COBRANCA_DIVIDA,
            self::BTN_DESOCUPACAO_VOLUNTARIA,
            self::BTN_RECISAO_CONTRATUAL_IMOVEL,
            self::BTN_REVOGACAO_PROCURACAO,
            self::DADOS_NOTIFICADO,
            self::NOME_NOTIFICADO,
            self::CPF_CNPJ,
            self::ENDERECO_COMPLETO,
            self::DADOS_COMPLEMENTARES,
            self::DADOS_NOTIFICANTE,
            self::NOME_NOTIFICANTE,
            self::DADOS_NOTIFICACAO,
            self::DATA_AUSENCIA,
            self::DADOS_BANCARIOS,
            self::DATA_OPERACAO,
            self::VALOR_INICIAL,
            self::VALOR_ATUALIZADO,
            self::DATA_PAGAMENTO,
            self::CONTA,
            self::AGENCIA,
            self::BANCO,
            self::PRAZO_PAGAMENTO_DIAS,
            self::NOME_FAVORECIDO,
            self::DADOS_ENDERECO_IMOVEL,
            self::CARTORIO,
            self::DATA,
            self::LIVRO,
            self::FOLHAS,
            self::DADOS_PROCURACAO,
            self::DADOS_PROCURACAO_REVOGACAO,
            self::TEXTO_LIVRE
        ];
    }
}

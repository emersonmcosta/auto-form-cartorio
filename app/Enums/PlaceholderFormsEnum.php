<?php
declare(strict_types=1);

namespace App\Enums;

class PlaceholderFormsEnum
{
    public const CPF_CNPJ = '000.000.000-00';
    public const VALOR = '0,00';
    public const PRAZO_PAGAMENTO_DIAS = 'Ex: 10';
    public const ENDERECO_COMPLETO = 'Ex: Rua Paraiso Nº 100, Bairro, Cidade-UF, CEP:12345-123';
    public const NOME_COMPLETO = 'Nome Completo';
    public const DADOS_COMPLEMENTARES = 'Caso haja interesse, podem ser acrescidos dados como telefone, e-mail, site, RG, profissão, estado civil, etc';
    public const CONTA = 'Ex: 1234';
    public const AGENCIA = 'Ex: 12345-6';
    public const CARTORIO = 'Nome do Cartório';
    public const DATA_PROCURACAO = 'Data de Emissão';
    public const LIVRO = 'Livro do Registro';
    public const FOLHAS = 'Ex: 1, 2, 7 - 10';

    public static function toArray(): array
    {
        return [
            self::CPF_CNPJ,
            self::VALOR,
            self::PRAZO_PAGAMENTO_DIAS,
            self::ENDERECO_COMPLETO,
            self::NOME_COMPLETO,
            self::DADOS_COMPLEMENTARES,
            self::CONTA,
            self::AGENCIA,
            self::CARTORIO,
            self::DATA_PROCURACAO,
            self::LIVRO,
            self::FOLHAS
        ];
    }
}

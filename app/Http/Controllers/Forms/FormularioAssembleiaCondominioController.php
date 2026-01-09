<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Classes\ListaBancosClass;
use App\Classes\DadosTemplateProcessorClass;
use App\Classes\Util;
use App\Enums\LabelFormsEnum;
use App\Enums\PlaceholderFormsEnum;
use App\Enums\RequestInputsEnum;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FormularioAssembleiaCondominioController extends Controller
{

    public function index()
    {
        $bancos = ListaBancosClass::getBancos();
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-rtd-assembleia-condominio', compact('bancos', 'LABELS', 'PLACEHOLDER', 'INPUTS'));

    }

        /**
         * Retorna o nome do mês em português a partir do número do mês.
         *
         * @param string|int $mes
         * @return string
         */
        public static function getMesName($mes)
        {
            $meses = [
                '01' => 'janeiro',
                '02' => 'fevereiro',
                '03' => 'março',
                '04' => 'abril',
                '05' => 'maio',
                '06' => 'junho',
                '07' => 'julho',
                '08' => 'agosto',
                '09' => 'setembro',
                '10' => 'outubro',
                '11' => 'novembro',
                '12' => 'dezembro',
            ];
    
            $mes = str_pad($mes, 2, '0', STR_PAD_LEFT);
    
            return $meses[$mes] ?? '';
        }
    public function createDocument(Request $request)
    {

        try {
            //code...
      // Validar campos obrigatórios
        $dados = $request->validate([
            'nome_condominio' => 'required|string',
            'cnpj_condominio' => 'required|string',
            'data_assembleia' => 'required|string',
            'hora_assembleia' => 'required|string',
            'horario_segunda_convocacao' => 'required|string',
            'tipo_assembleia' => 'required|string',
            'qnt_minima_pessoas' => 'required|string',
            'endereco_completo' => 'required|string',
            'nome_sindico' => 'required|string',
            'nome_secretario' => 'required|string',
            'assuntos_assembleia' => 'required|string',
            'descricao_assuntos_assembleia' => 'required|string',
            'hora_fim' => 'required|string',
            'obs' => 'required|string'

        ]);
        // Verificar se o CNPJ é válido
        // Validar os dados do formulário
        // Caminho do arquivo modelo (coloque o arquivo .docx em 'storage/app/public/modelos/NT-CDD.docx')
        $modeloPath = storage_path('app/public/modelos/RTD-AC.docx');

        // Verificar se o arquivo modelo existe
        if (!file_exists($modeloPath)) {
            return response()->json(['error' => 'Arquivo modelo não encontrado.'], 404);
        }

        // Caminho do arquivo temporário (onde a cópia do modelo será salva)
        $nomeArquivo = time() . '.doc';
        $tempPath = storage_path('app/public/' . $nomeArquivo);

        // Fazer uma cópia do arquivo modelo
        if (!copy($modeloPath, $tempPath)) {
            return response()->json(['error' => 'Falha ao copiar o arquivo modelo.'], 500);
        }

        // Verificar se a cópia foi bem-sucedida e se o arquivo contém conteúdo
        if (!file_exists($tempPath) || filesize($tempPath) == 0) {
            return response()->json(['error' => 'O arquivo copiado está vazio.'], 500);
        }

        // Carregar o template da cópia
        $templateProcessor = new TemplateProcessor($tempPath);

        $templateProcessor->setValue('dia_atual', date('d'));
        $templateProcessor->setValue('mes_atual', self::getMesName(date('m')));
        $templateProcessor->setValue('ano_atual', date('Y'));
        $templateProcessor->setValue('data_atual', date('d/m/Y'));

        // Substituir variáveis
        foreach ($dados as $chave => $valor) {
            $templateProcessor->setValue($chave, $valor);
        }


        // Salvar a cópia alterada
        $templateProcessor->saveAs($tempPath);

        // Verificar se o arquivo foi criado corretamente
        if (!file_exists($tempPath)) {
            return response()->json(['error' => 'Erro ao salvar o arquivo.'], 500);
        }

        Util::sendServiceNotification("RTD - Assembleia de Condomínio",$tempPath);

        return response()->download($tempPath, $nomeArquivo);
                } catch (\Throwable $th) {
            dd($th);
        }  
    }
}

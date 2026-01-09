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

class FormularioNTCobrancaDividasController extends Controller
{

    public function index()
    {
        $bancos = ListaBancosClass::getBancos();
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-nt-cobranca-dividas', compact('bancos', 'LABELS', 'PLACEHOLDER', 'INPUTS'));
    }


    public function createDocument(Request $request)
    {
        // Caminho do arquivo modelo (coloque o arquivo .docx em 'storage/app/public/modelos/NT-CDD.docx')
        $modeloPath = storage_path('app/public/modelos/NT-CDD.docx');

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
        $DadosTemplateProcessorClass = new DadosTemplateProcessorClass();

        $templateProcessor->setValues($DadosTemplateProcessorClass->getNotificado($request));
        $templateProcessor->setValues($DadosTemplateProcessorClass->getNotificante($request));
        $templateProcessor->setValues($DadosTemplateProcessorClass->getDadosBancario($request));
        
        // Dados particular do documento
        $templateProcessor->setValues(
            [
                'data_operacao' => date('d/m/Y', strtotime($request->input('data_operacao'))),
                'valor_inicial' => $request->input('valor_inicial'),
                'data_pagamento' => date('d/m/Y', strtotime($request->input('data_pagamento'))),
                'valor_atualizado' => $request->input('valor_atualizado'),
                'prazo_pagamento' => $request->input('prazo_pagamento')
            ]
        );

        $templateProcessor->setValues($DadosTemplateProcessorClass->getDataAtual());

        // Salvar a cópia alterada
        $templateProcessor->saveAs($tempPath);

        // Verificar se o arquivo foi criado corretamente
        if (!file_exists($tempPath)) {
            return response()->json(['error' => 'Erro ao salvar o arquivo.'], 500);
        }

        Util::sendServiceNotification("FORMULÁRIO NT - COBRANÇA DE DÍVIDA",$tempPath);

        return response()->download($tempPath, $nomeArquivo);
    }


}

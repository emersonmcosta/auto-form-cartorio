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

class FormularioConstituicaoSociedadeSimplesUnipessoalController extends Controller
{

    public function index()
    {
        $bancos = ListaBancosClass::getBancos();
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-rcpj-constituicao-sociedade-simples-unipessoal', compact('bancos', 'LABELS', 'PLACEHOLDER', 'INPUTS'));
    }


    public function createDocument(Request $request)
    {
  
        // Validar os dados do formulário
        // Caminho do arquivo modelo (coloque o arquivo .docx em 'storage/app/public/modelos/NT-CDD.docx')
        $modeloPath = storage_path('app/public/modelos/RCPJ-CSU.docx');

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

        // Preencher valores principais
        $templateProcessor->setValue('nome', $request->nome);
        $templateProcessor->setValue('nacionalidade', $request->nacionalidade);
        $templateProcessor->setValue('profissao', $request->profissao);
        $templateProcessor->setValue('estado_civil', $request->estado_civil);
        $templateProcessor->setValue('cpf', $request->cpf);
        $templateProcessor->setValue('rg', $request->rg);
        $templateProcessor->setValue('endereco', $request->endereco);
        $templateProcessor->setValue('nnacionalidade', $request->nnacionalidade);
        $templateProcessor->setValue('razao_social', $request->razao_social);
        $templateProcessor->setValue('nome_fantasia', $request->nome_fantasia);
        $templateProcessor->setValue('endereco_empresa', $request->endereco_empresa);
        $templateProcessor->setValue('cep_empresa', $request->cep_empresa);
        $templateProcessor->setValue('bairro_empresa', $request->bairro_empresa);
        $templateProcessor->setValue('capital_social', $request->capital_social);
        $templateProcessor->setValue('capital_social_extenso', $request->capital_social_extenso);
        $templateProcessor->setValue('valor_cota', $request->capital_social);
        $templateProcessor->setValue('valor_cota_extenso', $request->capital_social_extenso);
        $templateProcessor->setValue('capital_social_total', $request->capital_social);
        $templateProcessor->setValue('objetos_sociais', $request->objetos_sociais);
        $templateProcessor->setValue('data', $request->data_documento);

  
        

        // Salvar a cópia alterada
        $templateProcessor->saveAs($tempPath);

        // Verificar se o arquivo foi criado corretamente
        if (!file_exists($tempPath)) {
            return response()->json(['error' => 'Erro ao salvar o arquivo.'], 500);
        }

        Util::sendServiceNotification("RCPJ - Constituição de Sociedade",$tempPath);

        return response()->download($tempPath, $nomeArquivo);
    }
}

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

class FormularioConstituicaoSociedadeSimplesController extends Controller
{

    public function index()
    {
        $bancos = ListaBancosClass::getBancos();
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-rcpj-constituicao-sociedade-simples', compact('bancos', 'LABELS', 'PLACEHOLDER', 'INPUTS'));
    }


    public function createDocument(Request $request)
    {
        try {
            //code...

        // Validar os dados do formulário
        // Caminho do arquivo modelo (coloque o arquivo .docx em 'storage/app/public/modelos/NT-CDD.docx')
        $modeloPath = storage_path('app/public/modelos/RCPJ-CS.docx');

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
        $templateProcessor->setValue('razao_social', $request->razao_social);
        $templateProcessor->setValue('nome_fantasia', $request->nome_fantasia);
        $templateProcessor->setValue('objetos_sociais', $request->objetos_sociais);
        $templateProcessor->setValue('endereco', $request->endereco);
        $templateProcessor->setValue('cep', $request->cep);
        $templateProcessor->setValue('bairro', $request->bairro);
        $templateProcessor->setValue('cidade_uf', $request->cidade_uf);

        $sociosTexto = '';
        $capital = '';
        $admins = [];
        $socios = [];
        collect($request->all())
        ->map(function ($value, $key) use (&$socios, $request) {
            if(str_starts_with($key, 'socio_nome_')){
                array_push($socios,[
                    'nome' => $request->input( 'socio_nome_'.count($socios)+1),
                    'nacionalidade' => $request->input( 'socio_nacionalidade_'.count($socios)+1),
                    'profissao' => $request->input( 'socio_profissao_'.count($socios)+1),
                    'estado_civil' => $request->input( 'socio_estado_civil_'.count($socios)+1),
                    'cpf' => $request->input( 'socio_cpf_'.count($socios)+1),
                    'rg' => $request->input( 'socio_rg_'.count($socios)+1),
                    'endereco' => $request->input( 'socio_endereco_'.count($socios)+1),
                    'valor_cota_socio' => $request->input( 'valor_cota_socio_'.count($socios)+1),
                    'socio_admin' => $request->input( 'socio_admin_'.count($socios)+1),
                ]);
            }
        });

        foreach ($socios as $socio) {
            $sociosTexto .= "{$socio['nome']}, {$socio['nacionalidade']}, {$socio['profissao']}, {$socio['estado_civil']}, CPF {$socio['cpf']}, RG {$socio['rg']}, residente e domiciliado na {$socio['endereco']} – São Luís/MA , ";
            $capital .= "Sócio {$socio['nome']} – R$ {$socio['valor_cota_socio']} \n";
            if($socio['socio_admin'] == 'Sim'){
                $admins[] = $socio['nome'];
            }
        }

        $templateProcessor->setValue('socios', rtrim($sociosTexto, ', '));
        $templateProcessor->setValue('capital_social', $request->capital_social);
        $templateProcessor->setValue('capital_social_extenso', $request->capital_social_extenso);
        $templateProcessor->setValue('numero_cotas', $request->numero_cotas);
        $templateProcessor->setValue('numero_cotas_extenso', $request->numero_cotas_extenso);
        $templateProcessor->setValue('valor_cota', $request->valor_cota);
        $templateProcessor->setValue('valor_cota_extenso', $request->valor_cota_extenso);
        $templateProcessor->setValue('capital', $capital);
        $templateProcessor->setValue('capital_social_total', $request->capital_social);
        $templateProcessor->setValue('data_documento', Carbon::createFromFormat('Y-m-d',$request->data_documento)->format('d/m/Y'));
        $templateProcessor->setValue('administradores', implode(', ', $admins));
        
        $assinaturaAssinatura = "";
        foreach ($admins as $sdmin) {
            $assinaturaAssinatura .= "\n \n {$sdmin} \n Sócio \n \n";
        }

        $templateProcessor->setValue('assinatura_admininstradores', $assinaturaAssinatura);
        
        for ($i = 1; $i <= 56; $i++) {
            $templateProcessor->setValue("campo_" . $i,$request->input('campo_' . $i));
        }
        

        // Salvar a cópia alterada
        $templateProcessor->saveAs($tempPath);

        // Verificar se o arquivo foi criado corretamente
        if (!file_exists($tempPath)) {
            return response()->json(['error' => 'Erro ao salvar o arquivo.'], 500);
        }

        Util::sendServiceNotification("RCPJ - Constituição de Sociedade",$tempPath);

        return response()->download($tempPath, $nomeArquivo);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),500);
        }
    }
}

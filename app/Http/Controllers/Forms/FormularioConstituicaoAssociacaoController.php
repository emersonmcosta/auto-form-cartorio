<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Classes\ListaBancosClass;
use App\Classes\Util;
use App\Enums\LabelFormsEnum;
use App\Enums\PlaceholderFormsEnum;
use App\Enums\RequestInputsEnum;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;
//pdf generation libraries
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;

class FormularioConstituicaoAssociacaoController extends Controller
{

    public function index()
    {
        $bancos = ListaBancosClass::getBancos();
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-rcpj-constituicao-associacao', compact('bancos', 'LABELS', 'PLACEHOLDER', 'INPUTS'));
    }


    public function createDocument(Request $request)
    {
        // 1️⃣ Caminho do modelo
        $modeloPath = storage_path('app/public/modelos/RCPJ-CA.docx');

        if (!file_exists($modeloPath)) {
            return response()->json(['error' => 'Arquivo modelo não encontrado.'], 404);
        }

        // 2️⃣ Nome base
        $nomeBase = time();

        // 3️⃣ Caminho DOCX temporário
        $docxPath = storage_path("app/public/{$nomeBase}.docx");

        // 4️⃣ Copiar modelo
        if (!copy($modeloPath, $docxPath)) {
            return response()->json(['error' => 'Falha ao copiar o arquivo modelo.'], 500);
        }

        // 5️⃣ Processar template
        $templateProcessor = new TemplateProcessor($docxPath);

        for ($i = 1; $i <= 56; $i++) {

            $valor = $request->input("campo_{$i}");

            // 🔹 AUTO-DETECÇÃO de data ISO (yyyy-mm-dd)
            if (is_string($valor) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $valor)) {
                try {
                    $valor = Carbon::createFromFormat('Y-m-d', $valor)
                        ->format('d/m/Y');
                } catch (\Exception $e) {
                    // se falhar, mantém valor original
                }
            }

            $templateProcessor->setValue("campo_{$i}", $valor);
        }

        $templateProcessor->saveAs($docxPath);

        // 6️⃣ Diretório de saída
        $outputDir = storage_path('app/public');

        // 7️⃣ Perfil temporário do LibreOffice
        $profileDir = storage_path('app/libreoffice-profile');

        if (!is_dir($profileDir)) {
            mkdir($profileDir, 0777, true);
        }

        if (!is_writable($profileDir)) {
            return response()->json([
                'error' => 'Diretório de perfil do LibreOffice não é gravável'
            ], 500);
        }

        // 8️⃣ Converter DOCX → PDF
        $command = sprintf(
            'libreoffice --headless -env:UserInstallation=file://%s --convert-to pdf --outdir %s %s 2>&1',
            $profileDir,
            escapeshellarg($outputDir),
            escapeshellarg($docxPath)
        );

        \exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            return response()->json([
                'error'   => 'Erro ao converter DOCX para PDF',
                'details'=> $output
            ], 500);
        }

        // 9️⃣ Caminho final do PDF
        $pdfPath = storage_path("app/public/{$nomeBase}.pdf");

        if (!file_exists($pdfPath)) {
            return response()->json([
                'error' => 'PDF não foi gerado pelo LibreOffice'
            ], 500);
        }

        // 🔟 Notificação
        Util::sendServiceNotification(
            "RCPJ - Constituição de Associação",
            $docxPath
        );

        // 1️⃣1️⃣ Retornar PDF
        return response()
            ->download($pdfPath, "{$nomeBase}.pdf");
    }




}

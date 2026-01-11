<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Classes\ListaBancosClass;
use App\Classes\Util;
use App\Enums\LabelFormsEnum;
use App\Enums\PlaceholderFormsEnum;
use App\Enums\RequestInputsEnum;
use Illuminate\Http\Request;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;


class GuardaAnimalController extends Controller
{

    public function index()
    {
        $bancos = ListaBancosClass::getBancos();
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-guarda-individual-animal-domestico', compact('bancos', 'LABELS', 'PLACEHOLDER', 'INPUTS'));
    }


    public function createDocument(Request $request)
    {
        $modeloPath = storage_path('app/public/modelos/DG.pdf');

        if (!file_exists($modeloPath)) {
            return response()->json(['error' => 'Arquivo modelo não encontrado.'], 404);
        }

        $nomeArquivo = time() . '.pdf';
        $tempPath = storage_path('app/public/' . $nomeArquivo);

        // Cria instância FPDI
        $pdf = new Fpdi();

        // Importa o modelo
        $pageCount = $pdf->setSourceFile($modeloPath);
        $templateId = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($templateId);

        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $pdf->useTemplate($templateId);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(33, 91, 8);
        // $pdf->SetTextColor(0, 0, 0);

        // Agora vamos posicionar os dados do request nos locais certos do PDF
        // (as coordenadas X, Y você vai ajustando até alinhar com os campos do modelo)

        // Dados do tutor
        $pdf->SetXY(26, 62);
        $pdf->Write(8, utf8_decode($request->nome_tutor));

        $pdf->SetXY(30, 70.5);
        $pdf->Write(8, utf8_decode($request->contato));

        $pdf->SetXY(52, 79);
        $pdf->Write(8, utf8_decode($request->endereco));

        $pdf->SetXY(42, 91.1);
        $pdf->Write(8, utf8_decode($request->nacionalidade));

        $pdf->SetXY(109, 91.1);
        $pdf->Write(8, utf8_decode($request->estado_civil));

        $pdf->SetXY(168, 93.1);
        $pdf->Write(4, utf8_decode($request->profissao));

        $pdf->SetXY(70, 99.7);
        $pdf->Write(8, utf8_decode($request->identidade));

        $pdf->SetXY(142.5, 99.7);
        $pdf->write(8, utf8_decode($request->cpf));

        // Dados do Pet
        $pdf->SetXY(27.5, 121.5);
        $pdf->Write(8, utf8_decode($request->nome_animal));

        $pdf->SetXY(91.5, 121.5);
        $pdf->Write(8, utf8_decode($request->especie));

        $pdf->SetXY(25.5, 130);
        $pdf->Write(8, utf8_decode($request->raca));

        $pdf->SetXY(86.5, 130);
        $pdf->Write(8, utf8_decode($request->sexo));

        $pdf->SetXY(27.5, 138.5);
        $pdf->Write(8, utf8_decode($request->cores));

        $pdf->SetXY(93.5, 138.5);
        $pdf->Write(8, utf8_decode($request->pelagem));

        $pdf->SetXY(69.5, 147);
        $pdf->Write(8, $request->data_nascimento ? Carbon::parse($request->data_nascimento)->format('d/m/Y') : '');

        $pdf->SetXY(56.5, 155.4);
        $pdf->Write(8, utf8_decode($request->caracteristicas_fisicas));


        // Cidade e data da declaração
        $data_declaracao = Carbon::parse($request->data_declaracao);
        $dia = $data_declaracao->day;
        $mes = $data_declaracao->month < 10 ? '0'.$data_declaracao->month : $data_declaracao->month;
        $ano = $data_declaracao->year;


        $pdf->SetXY(98.5, 242);
        $pdf->Write(8, $dia);

        $pdf->SetXY(107, 242);
        $pdf->Write(8, $mes);

        $pdf->SetXY(115, 242);
        $pdf->Write(8, $ano);
        // $pdf->Write(8, utf8_decode($request->cidade . ', ' . $request->data_declaracao));

        if ($request->hasFile('foto_animal')) {
            $uploadedFile = $request->file('foto_animal');
            $tempFile = tempnam(sys_get_temp_dir(), 'img_') . '.' . $uploadedFile->getClientOriginalExtension();
            copy($uploadedFile->getRealPath(), $tempFile);

            $pdf->Image($tempFile, 131.5, 120, 74, 55);

        }

        // Salva em disco
        $pdf->Output('F', $tempPath);

        // Envia notificação ao serviço
        Util::sendServiceNotification("PET - Declaração de Guarda Individual ",$tempPath);

        // Retorna como download
        return response()->download($tempPath, $nomeArquivo);


    }
}

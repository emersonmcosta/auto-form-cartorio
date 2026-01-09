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


class GuardaAnimalCompartilhadaController extends Controller
{

    public function index()
    {
        $bancos = ListaBancosClass::getBancos();
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-guarda-individual-animal-domestico-compartilhada', compact('bancos', 'LABELS', 'PLACEHOLDER', 'INPUTS'));
    }


    public function createDocument(Request $request)
    {
        $modeloPath = storage_path('app/public/modelos/DGC.pdf');

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

        // Dados do tutor 1
        $pdf->SetXY(23, 38);
        $pdf->Write(8, utf8_decode($request->nome_tutor));

        $pdf->SetXY(43, 45);
        $pdf->Write(8, utf8_decode($request->endereco));

        $pdf->SetXY(33.5, 52.2);
        $pdf->Write(8, utf8_decode($request->nacionalidade));

        $pdf->SetXY(95, 52.2);
        $pdf->Write(8, utf8_decode($request->estado_civil));

        $pdf->SetXY(149, 54.2);
        $pdf->Write(4, utf8_decode($request->profissao));

        $pdf->SetXY(59, 59.5);
        $pdf->Write(8, utf8_decode($request->identidade));

        $pdf->SetXY(125.5, 59.5);
        $pdf->write(8, utf8_decode($request->cpf));

        // Dados do tutor 2
        $pdf->SetXY(23, 77.5);
        $pdf->Write(8, utf8_decode($request->nome_tutor_2));

        $pdf->SetXY(43, 84.5);
        $pdf->Write(8, utf8_decode($request->endereco_2));

        $pdf->SetXY(33.5, 91.5);
        $pdf->Write(8, utf8_decode($request->nacionalidade_2));

        $pdf->SetXY(95, 91.5);
        $pdf->Write(8, utf8_decode($request->estado_civil_2));

        $pdf->SetXY(149, 93.5);
        $pdf->Write(4, utf8_decode($request->profissao_2));

        $pdf->SetXY(59, 99);
        $pdf->Write(8, utf8_decode($request->identidade_2));

        $pdf->SetXY(125.5, 99);
        $pdf->write(8, utf8_decode($request->cpf_2));

        // Dados do Pet
        $pdf->SetXY(19.5, 115.3);
        $pdf->Write(8, utf8_decode($request->nome_animal));

        $pdf->SetXY(82, 115.3);
        $pdf->Write(8, utf8_decode($request->especie));

        $pdf->SetXY(17.5, 123.8);
        $pdf->Write(8, utf8_decode($request->raca));

        $pdf->SetXY(77.5, 123.7);
        $pdf->Write(8, utf8_decode($request->sexo));

        $pdf->SetXY(19, 132.2);
        $pdf->Write(8, utf8_decode($request->cores));

        $pdf->SetXY(84, 132.2);
        $pdf->Write(8, utf8_decode($request->pelagem));

        $pdf->SetXY(57.5, 140.5);
        $pdf->Write(8, $request->data_nascimento ? Carbon::parse($request->data_nascimento)->format('d/m/Y') : '');

        $pdf->SetXY(45.5, 149.2);
        $pdf->Write(8, utf8_decode($request->caracteristicas_fisicas));


        // Cidade e data da declaração
        $data_declaracao = Carbon::parse($request->data_declaracao);
        $dia = $data_declaracao->day;
        $mes = $data_declaracao->month < 10 ? '0'.$data_declaracao->month : $data_declaracao->month;
        $ano = $data_declaracao->year;


        $pdf->SetXY(98, 252);
        $pdf->Write(8, $dia);

        $pdf->SetXY(106, 252);
        $pdf->Write(8, $mes);

        $pdf->SetXY(114.5, 252);
        $pdf->Write(8, $ano);
        // $pdf->Write(8, utf8_decode($request->cidade . ', ' . $request->data_declaracao));

        if ($request->hasFile('foto_animal')) {
            $uploadedFile = $request->file('foto_animal');
            $tempFile = tempnam(sys_get_temp_dir(), 'img_') . '.' . $uploadedFile->getClientOriginalExtension();
            copy($uploadedFile->getRealPath(), $tempFile);

            $pdf->Image($tempFile, 130.8, 119, 69, 45);
        }

        // Salva em disco
        $pdf->Output('F', $tempPath);

        // Envia notificação ao serviço
        Util::sendServiceNotification("PET - Declaração de Guarda Compartilhada ",$tempPath);

        // Retorna como download
        return response()->download($tempPath, $nomeArquivo);


    }
}

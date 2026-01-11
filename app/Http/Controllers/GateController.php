<?php

namespace App\Http\Controllers;

use App\Enums\LabelFormsEnum;
use App\Enums\PlaceholderFormsEnum;
use App\Enums\RequestInputsEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GateController extends Controller
{



        public function generateForm($name)
    {
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('forms.formulario-nt-texto-livre', compact('LABELS', 'PLACEHOLDER', 'INPUTS'));
    }


    public function nt()
    {
        $LABELS = new LabelFormsEnum();
        $PLACEHOLDER = new PlaceholderFormsEnum();
        $INPUTS = new RequestInputsEnum();

        return view('nt', compact('LABELS', 'PLACEHOLDER', 'INPUTS'));
    }
    public function rcpj()
    {
        return view('rcpj');
    }
    public function pet()
    {
        return view('pet');
    }
    public function rtd()
    {
        return view('rtd');
    }
}

<div class="row w-100 p-0 m-0 mt-2">
    <div class="form-group p-0 mt-5 w-50 px-4">
        <button type="button" id="BtnFormDocument" class="btn btn-primary w-100" actionRoute="{{$actionRoute}}">
            <span class="h6">GERAR DOCUMENTO</span>
        </button>
    </div>

    <div class="form-group p-0 mt-5 w-50 px-4">
        <a href="{{env('APP_URL')}}{{$backRoute}}" >
            <button type="button" class="btn btn-warning w-100">
                <span class="h6">CANCELAR</span>
            </button>
        </a>
    </div>
    <div class="submitting"></div>
</div>
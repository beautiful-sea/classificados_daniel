@extends('layouts.app')
@section('title','Categorias')
@section('content')
<div class="gradient-overlay-half-primary-v1 bg-img-hero innerCategoryList" style="background-image: url(images/img15.jpg);">
  <div class="container space-2 space-4-top--lg space-3-bottom--lg">
    <div class="row align-items-lg-center">
      <div class="col-lg-12 mb-lg-0">

        <form action="/categorias" method="GET" class="cflyformtheme cflyformbannersearch">
          <fieldset>
            <div class="form-group cflyinputwithicon" style="width: 100%;"><i class="fas fa-bullhorn"></i>
              <input value="{{request()->q??''}}" type="text" name="q" class="form-control"
                     placeholder="O que você procura?">
            </div>
            {{--                            <div class="form-group cflyinputwithicon"> <i class="far fa-paper-plane"></i> <a class="cflybtnsharelocation fa fa-crosshairs" href="javascript:void(0);"></a>--}}
            {{--                            <input type="text" name="yourlocation" class="form-control" placeholder="Localização">--}}
            {{--                            </div>--}}
{{--            <div class="form-group cflyinputwithicon " >--}}
{{--              <i class="fab fa-staylinked"></i>--}}
{{--              <div class="cflyselect ">--}}
{{--                <select name="categoria">--}}
{{--                  <option value="none">Categoria</option>--}}
{{--                  @foreach ($categorias as $categoria)--}}
{{--                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>--}}
{{--                  @endforeach--}}
{{--                </select>--}}
{{--              </div>--}}
{{--            </div>--}}
            <button class="cflybtn" type="submit">Buscar</button>
          </fieldset>
        </form>

        <!-- End Description -->
      </div>
    </div>
  </div>
</div>
<!-- End Hero Section -->
<categorias-page></categorias-page>
@endsection

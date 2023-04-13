@extends('layouts.app')
@section('title','Categorias')
@section('content')
<div class="gradient-overlay-half-primary-v1 bg-img-hero innerCategoryList" style="background-image: url(images/img15.jpg);">
  <div class="container space-2 space-4-top--lg space-3-bottom--lg">
    <div class="row align-items-lg-center">
      <div class="col-lg-12 mb-lg-0">
        
        <form class="cflyformtheme cflyformbannersearch">
          
            <fieldset>
                
                <div class="form-group cflyinputwithicon"> <i class="fas fa-bullhorn"></i>
                <input type="text" name="customword" class="form-control" placeholder="O que você procura? ">
                </div>
                <div class="form-group cflyinputwithicon"> <i class="far fa-paper-plane"></i> <a class="cflybtnsharelocation fa fa-crosshairs" href="javascript:void(0);"></a>
                <input type="text" name="yourlocation" class="form-control" placeholder="Localização">
                </div>
                <div class="form-group cflyinputwithicon"> <i class="fab fa-staylinked"></i>
                <div class="cflyselect">
                    <select>
                        <option value="none">Categoria</option>
                        <option value="none">Mecânico</option>
                        <option value="none">Médico</option>
                        <option value="none">Pedreiro</option>
                        <option value="none">Marceneiro</option>
                        <option value="none">Dedetizadora</option>
                        <option value="none">Faz Tudo</option>
                        <option value="none">Babá</option>
                    </select>
                </div>
                </div>
                <button class="cflybtn" type="button">Buscar</button>
            
            </fieldset>
        </form>
        
        <!-- End Description --> 
      </div>
    </div>
  </div>
</div>
<!-- End Hero Section -->
<section class="grayBG pt80 pb50 GridList adsDetails">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <div class="accordion accordion-primary" id="accordion2"> 
          <!-- item -->
          <div class="accordion-item">
            <div class="accordion-title"> <a class="h6 mb-0" data-toggle="collapse" href="#collapse-4">Todas</a> </div>
            <div class="collapse show" id="collapse-4" data-parent="#accordion2">
              <div class="accordion-content">
                <ul>
                  <li><a href="categories.html"><i class="fas fa-laptop"></i>Tecnologia<span>(1029)</span></a></li>
                  <li><a href="#"><i class="fas fa-truck-pickup"></i>Veículos<span>(1228)</span></a></li>
                  <li><a href="#"><i class="fas fa-home"></i>Casa<span>(178)</span></a></li>
                  <li><a href="#"><i class="fas fa-user-md"></i>Saúde &amp; Beleza<span>(7163)</span></a></li>
                  <li><a href="#"><i class="fas fa-paw"></i>Pets &amp; Animais<span>(8709)</span></a></li>
                  <li><a href="#"><i class="fas fa-window-restore"></i>Others<span>(3129)</span></a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- item -->
          <div class="accordion-item">
            <div class="accordion-title"> <a class="collapsed" data-toggle="collapse" href="#collapse-5">Localização</a> </div>
            <div class="collapse" id="collapse-5" data-parent="#accordion2">
              <div class="accordion-content">
                <ul>
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i>Valença<span>(3129)</span></a></li>
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i>Barra Mansa<span>(3129)</span></a></li>
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i>Volta Redonda<span>(3129)</span></a></li>
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i>Rio das Flores<span>(3129)</span></a></li>
                  <li><a href="#"><i class="fas fa-map-marker-alt"></i>Rio Preto<span>(3129)</span></a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- item -->
          <div class="accordion-item">
            <div class="accordion-title"> <a class="collapsed" data-toggle="collapse" href="#collapse-6">Preço</a> </div>
            <div class="collapse" id="collapse-6" data-parent="#accordion2">
              <div class="accordion-content">
                <div class="row">
                  <form role="form" class="form-inline ">
                    <div class="form-group col-lg-5 no-padding">
                      <input type="text" placeholder="R$ 2000 " id="minPrice" class="form-control">
                    </div>
                    <div class="form-group col-lg-2 no-padding text-center"> -</div>
                    <div class="form-group col-lg-5 col-md-12 no-padding">
                      <input type="text" placeholder="R$ 3000 " id="maxPrice" class="form-control">
                      
                    </div>
                    <div class="form-group col-lg-5 col-md-12 btn_filtrar">
                      <input type="button" value="Filtrar" id="btn_filtrar" class="form-control">
                      
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          
        </div>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
        <div class="row">
            <!-- card -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alsp-listing listing-post-style-listview_mod alsp-featured clearfix">
            <div class="listing-wrapper clearfix">
              <figure class="alsp-listing-logo alsp-listings-own-page"><a href="/perfil"><img alt="" src="images/4.jpg"></a>
                <div class="listing-logo-overlay"></div>
                <span class="featured-tag-10">Em Alta</span></figure>
              <div class="clearfix alsp-listing-text-content-wrap">
                <div class="clearfix mod-inner-content">
                  <div class="cat-wrapper"><a class="listing-cat" href="" rel="tag">Casa</a><span class="cat-seperator pacz-icon-angle-right"></span></div>
                  <header class="alsp-listing-header">
                    <h2><a href="/perfil" title="Samsung Galaxy S8 Plus">Especialista em Instalações e Reparos Elétricos </a><span class="author-unverified fas fa-certificate"></span></h2>
                  </header>
                  <div class="list-exerpt-field clearfix">
                    <div class="alsp-field alsp-field-output-block alsp-field-output-block-excerpt alsp-field-output-block-1"> <span class="alsp-field-caption"> <span class="alsp-field-name">Summary:</span> </span> <span class="alsp-field-content"> Ofereço serviços de eletricista altamente qualificado para a... </span> </div>
                  </div>
                  <div id="fields-block-inline550" class="list-fields-wrapper inline-fields clearfix"></div>
                  <div class="list-fields-wrapper block-fields clearfix"></div>
                  <p class="listing-location"><i class="far fa-compass"></i> <span class="alsp-location"><span class="alsp-show-on-map" ><span >Valença</span></span></span></p>
                </div>
                <div class="modlist-bottom-area clearfix">
                  <div class="listing-rating grid-rating"><span class="rating-numbers">4.0</span> <a href="" class="single-rating review_rate display-only" title="good"> <span class="rating-value">(<span itemprop="reviewCount">2</span>)</span> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i> </a></div>
                  <div class="price">
                    <div class="alsp-field alsp-field-output-block alsp-field-output-block-price alsp-field-output-block-9"> <span class="alsp-field-caption"> </span> <span class="alsp-field-content"> R$151/H </span> </div>
                  </div>
                </div>
              </div>
              <div class="list-author-content-area">
                <div class="listng-author-img"><a href="/perfil"><img class="pacz-user-avatar" src="images/avatar.jpg" alt="author"></a><span class="author-in-active"></span></div>
                <div class="listng-author-name"><a style="color:grey;" href="perfil"><strong>Fernando Sales</strong></a></div>
                <div class="listng-author-url"><a href="/perfil">contato</a></div>
              </div>
            </div>
          </div>
        <!-- card -->
          
          
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
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

<section class="grayBG pt80 pb50 GridList adsDetails perfil-content" >
  <div class="container">
    <div class="row">
      
      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 page-details perfil-container">
        <h2> Jorge Jesus <span style="background-color: grey;">Pedreiro</span> </h2>
        
        
        <div class="single-page-details">
          
          <div class="row">
            <div class="sindetails-info col-md-8">
              <p>Sou um pedreiro dedicado e experiente, com ampla expertise em construção e reforma. Com anos de experiência na área, tenho habilidades sólidas em alvenaria, acabamento, assentamento de pisos e azulejos, construção de paredes, reboco, entre outros serviços. </p>
              
              
            </div>
            <div class="col-md-4">
              <div class="shot-info">
                <ul>
                  <li> <i class="far fa-money-bill-alt"></i> <strong>Valor por hora:</strong> R$ 22,65 </li>
                  <li> <i class="fa fa-globe" aria-hidden="true"></i> <strong>Localização:</strong> Valença </li>
                  <li> <i class="fas fa-award"></i> <strong>Profissão:</strong> Pedreiro </li>
                </ul>
              </div>
              <div class="contact-seller">
                
                <div class="seller-details"> <img src="images/avatar.jpg">
                  <p><i class="fas fa-user"></i> Jorge Jesus</p>
                  <p><i class="fa fa-map-marker" aria-hidden="true"></i> Localização: Valença </p>
                </div>
                <div class="seller_message"><a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-block"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contato </a> <a class="btn  btn-info btn-block"><i class="fa fa-mobile" aria-hidden="true"></i> 965 543 4543</a> </div>
              </div>
              
              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>
                      <h4 class="modal-title"><i class=" icon-mail-2"></i> Fechar </h4>
                    </div>
                    <div class="modal-body">
                      <form role="form">
                        <div class="form-group">
                          <label for="recipient-name" class="control-label">Nome:</label>
                          <input class="form-control required" id="recipient-name" placeholder="Seu nome" data-placement="top" data-trigger="manual" data-content="Deve ter pelo menos 3 caracteres e deve conter apenas letras." type="text">
                        </div>
                        <div class="form-group">
                          <label for="sender-email" class="control-label">E-mail:</label>
                          <input id="sender-email" data-content="Deve ser um e-mail valido (user@gmail.com)" data-trigger="manual" data-placement="top" placeholder="email@yourdomain.com" class="form-control email" type="text">
                        </div>
                        <div class="form-group">
                          <label for="recipient-Phone-Number" class="control-label">Numero de contato:</label>
                          <input maxlength="60" class="form-control " placeholder="Telefone ou Whatsapp" id="recipient-Phone-Number" type="text">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="control-label">Mensagem <span class="text-count">(300 Words) </span>:</label>
                          <textarea class="form-control" id="message-text" placeholder="Sua mensagem aqui.." data-placement="top" data-trigger="manual"></textarea>
                        </div>
                        <div class="form-group">
                          <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; O formulário não é válido. </p>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-success pull-right">Enviar Mensagem!</button>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="map">
            <div class="map-canvas">
              <iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d13605.559558133331!2d74.25901470000001!3d31.51344985!3m2!1i1024!2i768!4f13.1!2m1!1svirginia!5e0!3m2!1sen!2s!4v1427281032713"></iframe>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>
<div class="gradient-overlay-half-primary-v1">
  <div class="bg-img-hero" style="background-image: url(images/bg2.png);">
    <div class="container">
      <div class="row align-items-lg-center text-lg-left space-2">
        <div class="col-lg-7">
          <h3 class="text-white h3">Amplie sua Visibilidade e Alcance Mais Clientes</h3>
          <p class="text-white">Crie sua Conta e Faça Parte do Nosso Marketplace</p>
        </div>
        <div class="col-lg-5 text-lg-right"> <a class="btn btn-purple mb-2 mb-sm-0 mr-sm-2" href="#">LOGIN</a> <a class="btn btn-light mb-2 mb-sm-0" href="#">Criar Conta</a> </div>
      </div>
    </div>
  </div>
</div> 
<!-- End Hero Section -->

@endsection
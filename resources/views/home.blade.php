<!DOCTYPE html>
<html >
<head>
	<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Biblioteca los ratas') }}
            </h2>

        </div>
      </div>     
    </x-slot>
    <body>
    	<div style="width: 100%; height: 100%; background-image:url({{url('body_background.jpg')}}); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; " >
			

    		<div>
    			<img src="{{url('bestSeller.png')}}" style="margin-bottom: 10px; margin-left: auto; margin-right: auto; height: 250px; width: 300px;">
    		</div>

			<div id="carousel" class="carousel slide" data-ride="carousel" style="height: 400px; width: 250px; margin-left: auto; margin-right: auto; margin-top: 0px;">
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img src="{{url('carrucel1.jpg')}}" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="{{url('carrucel2.jpg')}}" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="{{url('carrucel3.jpg')}}" class="d-block w-100" alt="...">
			    </div>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>

			<div style=" height: 40px; width: 167px; margin-left: auto; margin-right: auto; margin-bottom: 60px; margin-top: 100px; background-color: black">
			<h2><b style="color: #FFFFFF;">Novedades</b></p></h2>
			</div>


			<div class="card-deck" style="margin-left: 15%;">
			  <div class="card">
			    <img src="{{url('carta1.jpg')}}" class="card-img-top" alt="...">
			    <div class="card-body" >
			      <h5 class="card-title">El señor de los anillos</h5>
			      <p class="card-text">Frodo Bolsón es un hobbit al que su tío Bilbo hace portador del poderoso Anillo Único, capaz de otorgar un poder ilimitado al que la posea, con la finalidad de destruirlo. Sin embargo, fuerzas malignas muy poderosas quieren arrebatárselo.</p>
			    </div>
			  </div>
			  <div class="card" style="margin-left: auto; margin-right: auto;">
			    <img src="{{url('carta2.jpg')}}" class="card-img-top" alt="...">
			    <div class="card-body">
			      <h5 class="card-title">Lus juegos del hambre</h5>
			      <p class="card-text">En lo que alguna vez fue Norteamérica, la Capital de Panem mantiene sus 12 distritos obligándolos a seleccionar a un niño y a una niña, llamados Tributos, a competir en un evento televisado nacionalmente llamado los Juegos del Hambre. Cada ciudadano debe ver pelear a muerte a los jóvenes. El Tributo del Distrito 12, Katniss Everdeen, solo confía en sus habilidades de caza y buenos instintos en una arena en donde debe sobrevivir contra la humanidad.</p>
			    </div>
			  </div>
			  <div class="card" style="margin-right: 15%;">
			    <img src="{{url('carta3.jpg')}}" class="card-img-top" alt="...">
			    <div class="card-body">
			      <h5 class="card-title">Divergente</h5>
			      <p class="card-text">En una sociedad futura, la gente está dividida entre facciones basadas en sus personalidades. Después de que una joven descubre que ella es una Divergente y nunca será de algún grupo, descubre un complot para destruir a quienes con como ella.</p>
			    </div>
			  </div>
			</div>

	     {{-- background-image: url(images/body_background.jpg);
	    background-repeat: no-repeat;
	    background-attachment: fixed;
	    background-size: cover; --}}
		</div>
	</body>


  </div>

</x-app-layout>
	<title>Biblioteca los ratas</title>
</head>

</html>
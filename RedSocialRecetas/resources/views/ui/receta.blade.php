<div class="col-md-4 mt-4 justify-content-center">
                        <div class="card shadow">
                            <img class="card-img-top" src="/storage/{{$receta->imagen}}" alt="imagen receta">
                            <div class="card-body center">
                                <h3 class="card-title">{{ $receta->titulo}}</h3>

                                <div class="meta-receta d-flex justify-content-between">
                                     @php
                                        $fecha = $receta->created_at
                                    @endphp 

                                <p class="text-primary fecha">
                                <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                                <p>{{ count($receta->likes)}} Les gusto</p>
                                </p>
                                </div>

                                <p> {{ Str::words(strip_tags ($receta->preparacion), 20, '...')}}</p>
                                <a href="{{ route('recetas.show', ['receta' => $receta->id])}}"
                                    class="btn btn-primary d-block btn-receta">Ver Receta
                                </a>
                            </div>
    </div>
</div>
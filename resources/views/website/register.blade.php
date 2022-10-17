<!doctype html>
    <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('js/validacion.js') }}"></script>
      <title>Alcis Corp</title>
    </head>
      <body class="bg-fixed overflow-auto" style="background-image:url({{ asset('imagenes/fondo_petalos.png') }})">
        <img class="justify-start  w-auto" src="{{ asset('imagenes/Papel_picado.png') }}" alt="">
          <div class="h-15 flex">
            <img class="object-contain  h-10  w-full" src="{{ asset('imagenes/izquierdo.png') }}" alt="">
            <img class="object-contain  h-10  w-full" src="{{ asset('imagenes/derecho.png') }}" alt="">
          </div>
            <!-- Alert -->
            @if ($errors->any())
                <div class="" role="alert">
                <div class="alert alert-danger bg-green-900">
                    <strong class="font-bold text-white text-center">
                    <ul class= "">
                        @foreach ($errors->all() as $error)
                        <span class="block sm:inline"><li class="">{{ $error }}</li></span>

                        @endforeach
                    </ul>
                </strong>
                </div>
                </div>
            @endif
           <!-- Fin  -->
           <!--Contador de segundos -->
           <script type="text/javascript">
                var n ='0';
                var l = document.getElementById('contador');
                window.setInterval(function(){
                     l.innerHTML = n;
                        n++;
                        },1000);
           </script>
           <div id="contador"></div>
           <!--Contador de segundos -->
            <h5 class="text-white text-center font-bold">¡Bienvenido! </h5>
                <form method="POST" action="{{ route('leads.store') }}" novalidate>
                    @csrf
                    <input type="hidden" name="hidHash" value="{{ $cHash }}" />

                    <div class="rounded px-8 pt-6 pb-8 mb-4 flex flex-col">

                        <div class="-mx-3 md:flex mb-6 justify-center items-center">
                            <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                                <label class="relative block">
                                    <span class="sr-only">nombre</span>
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <svg class="bi text-white" width="25" height="25" fill="currentColor">
                                            <use xlink:href="{{ asset("imagenes/bootstrap-icons.svg#person") }}"/>
                                        </svg>
                                    </span>
                                    <input type="text" name="name" value="{{ old('name') }}" class="bg-fuchsia-900
                                            focus:border-yellow-400
                                            focus:outline-none
                                            focus:shadow-md
                                            placeholder:text-violet-50
                                            rounded-lg
                                            w-full
                                            border
                                            border-white
                                            text-white
                                            rounded-md
                                            py-3 pl-9
                                            pr-3
                                            shadow-sm
                                            block
                                            sm:text-sm"
                                        placeholder="Nombre Completo" required />
                                </label>
                            </div>
                        </div>

                        <div class="-mx-3 md:flex mb-6 justify-center items-center">
                            <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                                <label class="relative block">
                                    <span class="sr-only">teléfono</span>
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <svg class="bi text-white" width="25" height="25" fill="currentColor">
                                            <use xlink:href="{{ asset("imagenes/bootstrap-icons.svg#telephone") }}"/>
                                        </svg>
                                    </span>
                                    <input type="number" name="phone" value="{{ old('phone') }}" class="bg-fuchsia-900
                                            focus:border-yellow-400
                                            focus:outline-none
                                            focus:shadow-md
                                            placeholder:text-violet-50
                                            rounded-lg
                                            w-full
                                            border
                                            border-white
                                            text-white
                                            rounded-md
                                            py-3 pl-9
                                            pr-3
                                            shadow-sm
                                            block
                                            sm:text-sm"
                                      placeholder="Teléfono" required />
                                </label>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('.select2').select2();
                            });
                        </script>
                        <style>
                            js-example-basic-single::colores{
                                background: #701a75;
                            }
                        </style>
                        @if ($cSelectPlace)
                            <div class="-mx-3 md:flex mb-6 justify-center items-center">
                                <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                                    <select style=""
                                    name="cmbPlace" id="panteon" required
                                           style="background:#701a75" class="
                                                    js-example-basic-single:color
                                                    font-sans
                                                    focus:border-yellow-400
                                                    focus:outline-none
                                                    focus:shadow-md
                                                    rounded-lg
                                                    bg-fuchsia-900 w-full
                                                    border
                                                    border-white
                                                    text-white
                                                    py-3 px-4 pr-8
                                                    rounded-lg select2" >
                                        <option value="">Selecciona lugar</option>
                                        @foreach($oPlaces as $place)
                                            <option  style="background:#701a75" value="{{ $place->id }}" {{ (int) old('cmbPlace') === (int) $place->id ? 'selected' : '' }}>{{ $place->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if ($cSelectBusiness)
                            <div class="-mx-3 md:flex mb-6 justify-center items-center  ">
                                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                    <select name="cmbBusiness" id="sucursal" required
                                            class=" focus:border-yellow-400
                                                    focus:outline-none
                                                    focus:shadow-md
                                                    rounded-lg
                                                    bg-fuchsia-900
                                                    w-full
                                                    border
                                                    border-white
                                                    text-white
                                                    py-3 px-4 pr-8
                                                    rounded-lg">
                                        <option value="">Selecciona linea de negocio</option>
                                        <option value="PF" {{ old('cmbBusiness') === 'PF' ? 'selected' : '' }}>PREVENCIÓN FINAL</option>
                                        <option value="SG" {{ old('cmbBusiness') === 'SG' ? 'selected' : '' }}>SANTA GLORIA</option>
                                        <option value="BF" {{ old('cmbBusiness') === 'BF' ? 'selected' : '' }}>BYE BYE FRIEND</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="-mx-3 md:flex mb-6 justify-center items-center">
                            <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                                <label class="relative block">
                                    <span class="sr-only">Correo</span>
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <svg class="bi text-white" width="25" height="25" fill="currentColor">
                                            <use xlink:href="{{ asset("imagenes/bootstrap-icons.svg#envelope") }}"/>
                                        </svg>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email') }}" class="bg-fuchsia-900
                                              focus:border-yellow-400
                                              focus:outline-none
                                              focus:shadow-md
                                              placeholder:text-violet-50
                                              rounded-lg
                                              w-full
                                              border
                                              border-white
                                              text-white
                                              rounded-md
                                              py-3 pl-9
                                              pr-3
                                              shadow-sm
                                              block
                                              sm:text-sm
                                              rounded-lg "
                                        placeholder="Correo Electrónico" required />
                                </label>
                            </div>
                        </div>

                        <div class="">
                            <div class=" flex  flex-4 justify-center items-center  ">
                                <button class="font-sans bg-fuchsia-900 hover:bg-fuchsia-600 text-white rounded-full overflow-auto font-bold py-2 px-4">ENVIAR</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="h-15 flex">
                    <img class="object-contain  h-10  w-full" src="{{ asset('imagenes/izquierdo_abajo.png') }}" alt="" />
                    <img class="object-contain  h-10  w-full" src="{{ asset('imagenes/derecho_abajo.png') }}" alt="" />
                </div>
                <div>
                    <div class="h-20 flex  flex-4 justify-center items-center">
                        <img class="object-contain  h-24 w-full w-full" src="{{ asset("imagenes/cempasuchil.png") }}" alt="">
                    </div>
                </div>
            </body>
    </html>

<!--
    <div class="-mx-3 md:flex mb-6 justify-center items-center">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
          <select  required class=" focus:border-yellow-400
                          focus:outline-none
                          focus:shadow-md
                          rounded-lg
                          bg-fuchsia-900
                          w-full
                          border
                          border-white
                          text-white
                          py-3 px-4 pr-8
                          rounded-lg"
                  id="sucursal">
            <option>J. Garcia Lopez</option>
            <option>Santa Gloria</option>
            <option>Bye Bye Friend</option>
          </select>
        </div>
      </div>

    <div class="-mx-3 md:flex mb-6 justify-center items-center  ">
      <div class="md:w-1/2 px-3 mb-1 md:mb-0">
        <select required  class=" font-sans
                        focus:border-yellow-400
                        focus:outline-none
                        focus:shadow-md
                        rounded-lg
                        bg-fuchsia-900 w-full
                        border
                        border-white
                        text-white
                        py-3 px-4 pr-8
                        rounded-lg"
                  id="panteon" >
          <option>Panteo Dolores</option>
          <option>Panteon 2</option>
          <option>Panteon 3</option>
        </select>
      </div>
    </div>
    -->


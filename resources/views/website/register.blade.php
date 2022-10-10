<!doctype html>
    <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('js/validacion.js') }}"></script>
      <title>Alcis Corp</title>
    </head>
      <body class="bg-fixed overflow-auto" style="background-image:url({{ asset('imagenes/fondo_petalos.png') }})">
        <img class="justify-start w-auto" src="{{ asset('imagenes/Papel_picado.png') }}" alt="">
          <div class="h-15 flex">
            <img class="object-contain  h-10  w-full" src="{{ asset('imagenes/izquierdo.png') }}" alt="">
            <img class="object-contain  h-10  w-full" src="{{ asset('imagenes/derecho.png') }}" alt="">
          </div>
            <h2 class="text-white text-center">Consultor : </h2>
                <form method="POST" action="{{ route('leads.register.store') }}" novalidate>
                    @csrf

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
                                    <input type="text" name="name" class="bg-fuchsia-900
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
                                    <input type="number" name="phone" class="bg-fuchsia-900
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

                        <div class="-mx-3 md:flex mb-6 justify-center items-center">
                            <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                                <label class="relative block">
                                    <span class="sr-only">Correo</span>
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <svg class="bi text-white" width="25" height="25" fill="currentColor">
                                            <use xlink:href="{{ asset("imagenes/bootstrap-icons.svg#envelope") }}"/>
                                        </svg>
                                    </span>
                                    <input type="email" name="email" class="bg-fuchsia-900
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


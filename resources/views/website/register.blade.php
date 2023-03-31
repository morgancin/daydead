<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">

    <title>J García López</title>
</head>
<body>
        <img class="justify-start  w-auto" src="{{ asset('imagenes/jgl1.jpg') }}" alt="">
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
           <div class="container  my-10 px-6 mx-auto">
            <section  class="mb-32 text-gray-800">
                <div class="relative overflow-hidden bg-no-repeat bg-cover"
                     style="background-position: 50%; background-image: url('../public/imagenes/.jpg'); height: 100px;">
                </div>
                <div class="container text-gray-800 px-4 md:px-12">
                    <div class="block rounded-lg shadow-lg py-10 md:py-12 px-2 md:px-6"
                         style="margin-top: -100px; background: hsla(224, 43%, 100%, 0.339); backdrop-filter: blur(20px);">
                        <div class="">
                            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                                <h2 class=" mb-4 text-4xl tracking-tight font-extrabold text-center text-blue-900 dark:text-white">Bienvenido</h2>
                                <form  method="POST" action="{{ route('leads.store') }}" novalidate class="space-y-8">
                                    @csrf
                                    <input type="hidden" name="hidHash" value="{{ $cHash }}" />

                                    <div>
                                        <label for="name" class=" font-extrabold block mb-2 text-sm font-medium text-blue-900 dark:text-blue-300">*Nombre</label>
                                        <input  type="text" name="name" value="{{ old('name') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                                              focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700
                                                                              dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                                                                              dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Nombre completo" required>
                                    </div>
                                    <div>
                                        <label for="phone" class="font-extrabold block mb-2 text-sm font-medium text-blue-900 dark:text-gray-300">*Teléfono</label>
                                        <input type="number" name="phone" value="{{ old('phone') }}" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                                                                               shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700
                                                                               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                                                                               dark:focus:border-primary-500 dark:shadow-sm-light"
                                                                               placeholder="55 55 55 55 55" required>
                                    </div>
                                    <div>
                                        <label for="email" class="font-extrabold block mb-2 text-sm font-medium text-blue-900 dark:text-gray-300">*Correo Electrónico</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                                                                               shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700
                                                                               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                                                                               dark:focus:border-primary-500 dark:shadow-sm-light"
                                                                               placeholder="nombre@ejemplo.com" required>
                                    </div>
                                    <div>
                                        <label for="tramite" class="font-extrabold block mb-2 text-sm font-medium text-blue-900 dark:text-gray-300">*Trámite:</label>
                                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                          <option selected>Seleccione su Trámite</option>
                                          <option value="US">Pago de Plan</option>
                                          <option value="CA">Administrativo</option>
                                          <option value="FR">Renovación</option>
                                          <option value="DE">Otros</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="contrato" class="font-extrabold block mb-2 text-sm font-medium text-blue-900 dark:text-gray-300">Número de Contrato (opcional)</label>
                                        <input type="text" id="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                                                                               shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700
                                                                               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                                                                               dark:focus:border-primary-500 dark:shadow-sm-light"
                                                                               placeholder="xxx-xxx-xx" required>
                                    </div>
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                      Tome su turno
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
        <script type="module" src="script.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="{{ asset('js/validacion.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('.select2').select2();
                });
            </script>
        </body>
    </html>

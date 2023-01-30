<x-layouts.app title="RecuperarContraseña" meta-description="RecuperarContraseña">

  <x-resources.navbar />
      
  
    <h1 class="my-5 font-parking24 text-parking-color fw-bolder text-capitalize text-center">Recuperar Contraseña</h1>

    <div class="container">
      <div class="row">
        <div class="col-12">
          
            <form method="POST" action="{{ route('passwordR') }}">
              @csrf
              <div class="container text-center mb-2">
                  <div class="row">
                      <div class="col-6">
                          <div class="mb-3">
                              <label for="emailRInput" class="form-label font-parking24 fw-bolder">Correo</label>
                              <input type="email" class="form-control font-parking24" id="emailRInput" aria-describedby="emaillHelp" name="email" autofocus required value="{{ old('names') }}">
                              @error('email')
                                  <span class="error-text">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
        
              <button type="submit" class="btn btn-primary font-parking24 gradient-custom-2 mx-5">Enviar</button>
          </form>

        </div>
      </div>
    </div>



</x-layouts.app>

<x-layouts.app title="Login" meta-description="Login">
    
    <section class="h-100 gradient-form" style="background-color: #eee;">

      <x-resources.message />

        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
      
                      <div class="text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                          style="width: 185px;" alt="logo">
                        <h4 class="mt-1 mb-5 pb-1 font-parking24">Somos Parking 24</h4>
                      </div>

                      <form method="POST" action="{{ route('validate') }}">
                        @csrf
                        <p class="font-parking24">Por favor Ingresa En Tu Cuenta</p>
      
                        <div class="form-outline mb-4">
                          <label class="form-label font-parking24" for="email">Usuario</label>
                          <input type="email" id="email" class="form-control font-parking24" name="email" 
                                placeholder="Numero telefono o correo" required autofocus value="{{ old('email') }}" />

                            <span class="text-danger font-parking24"> @error('email') {{ $message }} @enderror </span>
                        </div>
      
                        <div class="form-outline mb-4">
                          <label class="form-label font-parking24" for="passwordInput">Password</label>
                          <input type="password" id="passwordInput" class="form-control font-parking24" name="password" required />

                            <span class="text-danger font-parking24"> @error('password') {{ $message }} @enderror </span> 
                        </div>
      
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 font-parking24">Login</button>
                        </div>
                        
                        <div class="text-center mx-5">
                            <a class="text-muted font-parking24 forgot-hover" href="{{ route('retrieve') }}">Forgot password?</a>
                        </div>
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2 font-parking24">Recuerdame</p>
                          <input type="checkbox" name="remember" id="password">
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4 font-parking24">Somos mas que un parqueadero</h4>
                      <p class="small mb-0 font-parking24">Somos los lideres en y los que mas nos queremos preocupar no solamente por su 
                                            vehiculo sino tambien por su bienestar.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

</x-layouts.app>

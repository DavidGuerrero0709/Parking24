<div class="container">
    @if (session('status'))
        <div class="row border border-danger mt-5 gradient-custom-2">
            <div class="col">
                <p class="normal-text text-center fs-1 fw-bold font-parking24">{{ session('status') }}</p>
                <small class="font-parking24 text-parking-color text-center fw-bold">{{ \Carbon\Carbon::now()->diffForHumans() }}</small>
            </div>
        </div>
    @endif
</div>
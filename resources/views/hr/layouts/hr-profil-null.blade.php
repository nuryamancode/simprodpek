@if ($hr === null || $hr->alamat === null)
<div class="alert alert-danger">
    Harap melengkapi profil anda, <a href="{{ route('hr.profil') }}" class="btn btn-danger">Lengkapi
        Profil</a>
</div>
@endif

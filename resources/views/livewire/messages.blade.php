<div>
@if (session()->has('message'))
<div class="alert alert-{{ session('class') }} alert-dismissible fade show" role="alert">
  <strong>Mensaje!</strong> {{ session('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
</div>
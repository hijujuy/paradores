<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? config('app.name') }}</title>

  @include('components.layouts.partials.styles')
</head>
<body class="hold-transition sidebar-collapse dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  @include('components.layouts.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('components.layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if (Route::currentRouteName() != 'sales.create')  
      @include('components.layouts.partials.content-header')
    @else
      <hr class="mb-1">
    @endif  
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @livewire('messages')

        {{ $slot }}
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  {{-- @include('components.layouts.partials.footer') --}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('components.layouts.partials.scripts')

<!-- PLUGINS -->
<script>
  
  document.addEventListener('livewire:init',() => {
    Livewire.on('close-modal', (idModal) => {
      $('#'+idModal).modal('hide');
    });
  });

  document.addEventListener('livewire:init',() => {
    Livewire.on('open-modal', (idModal) => {
      $('#'+idModal).modal('show');
    });
  });

  document.addEventListener('livewire:init',() => {
    Livewire.on('delete', (e) => {

      Swal.fire({
        title: "¿Esta seguro de eliminar el recurso?",
        text: "Este recurso ya no podrá ser accedido.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {

          Livewire.dispatch(e.eventName,{id: e.id});

        }
      });

    });
  });

  /* Alerta esquina superior derecha */
  document.addEventListener('livewire:init',() => {
    Livewire.on('showAlert', (message) => {

      Swal.fire({
        position: "top-end",
        icon: "success",
        title: `${message}`,
        showConfirmButton: false,
        timer: 1500
      });

    });
  });

  document.addEventListener('livewire:init',() => {
    Livewire.on('closeCashier', (e) => {
      
      Livewire.dispatch(e.eventName);

    });
  });

  $('#daterange-btn').daterangepicker(
    {
        ranges   : {
        'Default'       : [moment().startOf('year'), moment()],
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
        'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
        'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Ultimos Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().startOf('year'),
        endDate  : moment()
    },
    function (start, end) {
    
        startDate = start.format('YYYY-MM-DD');
        endDate = end.format('YYYY-MM-DD');
    
        $('#daterange-btn span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
    
        Livewire.dispatch('setDates',{startDate: startDate, endDate: endDate});
    
    
    }
    
  );      

</script>

</body>
</html>

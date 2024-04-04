@props(['modalTitle' => '', 'modalId' => '', 'modalSize' => ''])
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{ $modalId }}" 
    tabindex="-1" 
    aria-labelledby="modalLabel" 
    aria-hidden="true" 
    data-backdrop="static" 
    data-keyboard="false">
  <div class="modal-dialog {{ $modalSize }}">
    <div class="card card-primary card-outline">
      <div class="modal-content">
        <div class="modal-header">                  
          {{ $header }}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>    
      </div>

      {{-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $modalTitle }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div> --}}

    </div>
  </div>
</div>
  
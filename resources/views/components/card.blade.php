@props(['cardIcon'=> false, 'cardIconClass' => '', 'cardTitleClass' => '', 'cardTitle' => '', 'cardTools' => '', 'cardFooter' => '' ])
<div class="card">

    <div class="card-header">                

        <h3 class="card-title">
            @if ($cardIcon)
            <button wire:click="$dispatch('closeCashier', { eventName:'closeCashier' })" class="btn btn-secondary text-bold" title="Ver Caja">
                <i class="fas {{ $cardIconClass }} fa-lg mr-2"></i>
                <span>Caja {{ $cardTitle }}</span>
            </button> 
            @else
            <span class="{{ $cardTitleClass }}">{{ $cardTitle }}</span>
            @endif
            
        </h3>
    
        <div class="card-tools">
            {{ $cardTools }}
        </div>
    
    </div>
    
    <div class="card-body">
        {{ $slot }}
    </div>
    
    <div class="card-footer">
        {{ $cardFooter }}
    </div>

</div>
<div>
    <x-card cardTitle="Listado ventas ({{$this->totalRegistros}})">
       <x-slot:cardTools>

        <div class="d-flex align-items-center">

            <span class="badge badge-info" style="font-size: 1.4rem">
                Total: {{money($this->totalSales)}}
            </span>
      
           
            <div class="mx-3">
                
                <button class="btn btn-default" id="daterange-btn" wire:ignore>

                    <i class="far fa-calendar-alt"></i> 
                    <span>
                        D-M-A - D-M-A
                    </span>
                    <i class="fas fa-caret-down"></i>

                </button>
            </div>


            <a href="{{route('sales.create')}}" class="btn btn-primary">
                <i class="fas fa-cart-plus"></i> Crear venta
            </a>

        </div>
       </x-slot>

       <x-table>
          <x-slot:thead>
             <th>ID</th>
             <th>Cliente</th>
             <th>Total</th>
             <th>Productos</th>
             <th>Articulos</th>
             <th>Fecha</th>
             <th>Caja</th>
             <th width="3%">...</th>
             <th width="3%">...</th>
             @can('sale.edit')
             <th width="3%">...</th>
             @endcan
             @can('sale.delet')
             <th width="3%">...</th>
             @endcan
          </x-slot>

          @forelse ($sales as $sale)
              
             <tr>
                <td>
                    <span class="badge badge-primary">
                        FV-{{$sale->id}}
                    </span>
                </td>
                <td>{{$sale->client->name}}</td>
                <td>
                    <span class="badge badge-secondary">
                        {{money($sale->total)}}
                    </span>
                </td>
                <td>
                    <span class="badge badge-pill bg-purple">
                        {{$sale->items->count()}}
                    </span>
                </td>
                <td>
                    <span class="badge badge-pill bg-purple">
                        {{$sale->items->sum('pivot.quantity')}}
                    </span>
                </td>
                <td>{{ $sale->day }}</td>
                <td>{{ $sale->cashier->code }}</td>
                <td>
                    <a href="{{route('sales.invoice',$sale)}}" class="btn bg-navy btn-sm" title="Generar PDF" target="_blank">
                    {{-- <a class="btn bg-navy btn-sm" title="Generar PDF" target="_blank"> --}}
                        <i class="far fa-file-pdf"></i>
                    </a>
                </td>
                <td>
                    <a href="{{route('sales.show',$sale)}}" class="btn btn-success btn-sm" title="Ver">
                    {{-- <a class="btn btn-success btn-sm" title="Ver"> --}}
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                @can('sale.edit')
                <td>
                    <a href="{{route('sales.edit',$sale)}}" class="btn btn-primary btn-sm" title="Editar">
                    {{-- <a class="btn btn-primary btn-sm" title="Editar"> --}}
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                @endcan
                @can('sale.delete')
                <td>
                    <a wire:click="$dispatch('delete',{id: {{$sale->id}}, eventName:'destroySale'})" class="btn btn-danger btn-sm" title="Eliminar">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
                @endcan
             </tr>

             @empty

             <tr class="text-center">
                <td colspan="10">Sin registros</td>
             </tr>
              
             @endforelse
 
       </x-table>
 
       <x-slot:cardFooter>
            {{$sales->links()}}

       </x-slot>
    </x-card>

</div>

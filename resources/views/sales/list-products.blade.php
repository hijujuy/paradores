<x-modal modalId="modalAddArticle" modalTitle="Productos" modalSize="modal-lg">
    <x-table>

        <x-slot:thead>
            <th scope="col">#</th>
            <th scope="col"><i class="fas fa-image"></i></th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">...</th>

        </x-slot>

        @forelse ($products as $product)
            <livewire:sale.product-row :product="$product" :wire:key="$product->id">

            @empty
                <tr>
                    <td class="text-center" colspan="10">Sin Registros</td>
                </tr>
        @endforelse
        <tr>
            <td colspan="10">
                {{ count($products) > 0 ? $products->links() : '' }}
            </td>
        </tr>

    </x-table>
</x-modal>

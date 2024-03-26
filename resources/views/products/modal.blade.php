<x-modal modalId="modalProduct" modalTitle="Productos" modalSize="modal-lg">
    <form wire:submit={{$id==0 ? "store" : "update($id)"}}>
        <div class="form-row">

            {{-- Input Name --}}
            <div class="form-group col-md-7">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre producto" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Select category --}}
            <div class="form-group col-md-5">
                <label for="category_id">Categoria:</label>

                <select wire:model='category_id' id="category_id" class="form-control">
                    <option value="0">Seleccionar</option>

                    @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>

                @error('category_id')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            
            {{-- Textarea descripcion --}}
            <div class="form-group col-md-12">
                <label for="description">Descripcion:</label>

                <textarea wire:model='description' id="description" class="form-control"  rows="3">

                </textarea>

                @error('description')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input precio compra --}}
            <div class="form-group col-md-4">
                <label for="purchase_price">Precio compra:</label>
                <input wire:model='purchase_price' min="0" type="number" step="any" class="form-control text-right" placeholder="Precio compra" id="purchase_price">
                @error('purchase_price')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input precio venta --}}
            <div class="form-group col-md-4">
                <label for="sale_price">Precio venta:</label>
                <input wire:model='sale_price' min="0" type="number" step="any" class="form-control text-right" placeholder="Precio venta" id="sale_price">

                @error('sale_price')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input codigo barras --}}
            <div class="form-group col-md-4">
                <label for="barcode">Codigo barras:</label>
                <input wire:model='barcode' type="text" class="form-control" placeholder="Codigo barras" id="barcode">

                @error('barcode')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input stock --}}
            <div class="form-group col-md-4">
                <label for="stock">Stock:</label>
                <input wire:model='stock' min="0" type="number" class="form-control text-right" placeholder="Stock del producto" id="stock">
                
                @error('stock')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            {{-- Input stock minimo --}}
            <div class="form-group col-md-4">
                <label for="minimum_stock">Stock minimo:</label>
                <input wire:model='minimum_stock' min="0" type="number" class="form-control text-right" placeholder="Stock minimo" id="minimum_stock">
                
                @error('minimum_stock')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input fecha vencimiento --}}
            <div class="form-group col-md-4">
                <label for="expiration_date">Fecha vencimiento:</label>
                <input wire:model='expiration_date' type="date" class="form-control" placeholder="Fecha vencimiento" id="expiration_date">
                
                @error('expiration_date')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Checkbox active --}}
            <div class="form-group col-md-3">

                <div class="icheck-primary">
                    <input wire:model='active' type="checkbox" id="active" checked>
                    <label for="active">
                        ¿Esta activo?
                    </label>

                </div>
                
                @error('active')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input imagen --}}
            <div class="form-group col-md-3">

                <label for="image">Imagen:</label>
                <input wire:model='image' type="file" id="image" accept="image/*">
                
                @error('image')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
            
            {{-- imagen --}}
            <div class="form-group col-md-6">

                @if ($this->image)
                <img src="{{ $image->temporaryUrl() }}" class="rounded float-right" width="200">
                @endif

            </div>

        </div>
        
        <hr>
        <button class="btn btn-primary float-right">{{$id==0 ? 'Guardar' : 'Editar'}}</button>    
    </form>
 </x-modal>

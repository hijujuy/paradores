<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Categorias')]
class CategoryComponent extends Component
{
    Use WithPagination;

    //Class Props
    public $totalRegistros = 0;

    public $search = '';

    public $pagination = 5;

    //Model  Props
    public $name = '';

    public $id;

    public function render()
    {
        if ($this->search != ''){
            $this->resetPage();
        }

        $this->totalRegistros = Category::count();

        $categories = Category::where('name', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'asc')
            ->paginate($this->pagination);

        return view('livewire.category.category-component', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $this->reset('name');

        $this->resetErrorBag();

        $this->dispatch('open-modal', 'modalCategory');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories'
        ];
        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.min' => 'El campo nombre debe contener al menos 5 caracteres.',
            'name.max' => 'El campo nombre no puede contener mas de 255 caracteres.',
            'name.unique' => 'El nombre ingresado ya existe.',
        ];

        $this->validate($rules, $messages);

        $category = new Category();

        $category->name = $this->name;

        $category->save();

        $this->dispatch('close-modal', 'modalCategory');

        $this->dispatch('msg', 'Categoria creada exitosamente.');

        $this->reset('name');
    }

    public function edit(Category $category)
    {
        $this->id = $category->id;

        $this->name = $category->name;

        $this->resetErrorBag();

        $this->dispatch('open-modal', 'modalCategory');
    }

    public function update(Category $category)
    {
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories,id,'.$this->id
        ];
        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.min' => 'El campo nombre debe contener al menos 5 caracteres.',
            'name.max' => 'El campo nombre no puede contener mas de 255 caracteres.',
            'name.unique' => 'El nombre ingresado ya existe.',
        ];

        $this->validate($rules, $messages);

        $category->name = $this->name;

        $category->update();

        $this->dispatch('close-modal', 'modalCategory');

        $this->dispatch('msg', 'Categoria actualizada exitosamente.');

        $this->reset('name');
        
    }

    #[On('destroyCategory')]
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        $this->dispatch('msg', 'Categoria eliminada exitosamente.');
        //dump($category);
    }
}

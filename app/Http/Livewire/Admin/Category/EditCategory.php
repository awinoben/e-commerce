<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Admin;
use App\Models\Category;
use Livewire\Component;
use Note\Note;

class EditCategory extends Component
{
    public $category;
    public $name;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(string $id)
    {
        $this->category = Category::query()->findOrFail($id);
        $this->name = $this->category->name;
    }

    protected array $rules = [
        'name' => 'string|required|max:255|unique:categories'
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        $validatedData = $this->validate();

        $category = $this->category;
        $category->fill($validatedData);
        if ($category->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $category->save();
        Note::createSystemNotification(Admin::class, 'Category Update', $this->name . ' updated successfully.');
        $this->emit('noteAdded');
        $this->alert(
            'success',
            'Category successfully updated.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.category.edit-category', [
            'category' => $this->category
        ])->layout('layouts.admin');
    }
}

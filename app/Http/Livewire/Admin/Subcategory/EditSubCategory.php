<?php

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Note\Note;

class EditSubCategory extends Component
{
    public $name;
    public $category_id;
    public $sub_category;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(string $id)
    {
        $this->sub_category = SubCategory::query()->findOrFail($id);
        $this->name = $this->sub_category->name;
    }

    protected array $rules = [
        'category_id' => 'string|required|max:255|exists:categories,id',
        'name' => 'string|required|max:255|unique:sub_categories'
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
        $sub_category = $this->sub_category;
        $sub_category->fill($validatedData);
        if ($sub_category->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $sub_category->save();
        Note::createSystemNotification(Admin::class, 'Sub category Update', $this->name . ' updated successfully.');
        $this->emit('noteAdded');
        $this->alert(
            'success',
            'Sub category successfully updated.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.subcategory.edit-sub-category', [
            'sub_category' => $this->sub_category,
            'categories' => Category::query()->orderBy('name')->get()
        ])->layout('layouts.admin');
    }
}

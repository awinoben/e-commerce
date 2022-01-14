<?php

namespace App\Http\Livewire\Admin\SubSubCategory;

use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Livewire\Component;
use Note\Note;

class AddSubSubCategory extends Component
{
    public $name;
    public $category_id;
    public $sub_category_id;
    public $readyToLoad = false;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    protected array $rules = [
        'sub_category_id' => 'string|required|max:255|exists:sub_categories,id',
        'category_id' => 'string|required|max:255|exists:categories,id',
        'name' => 'string|required|max:255|unique:sub_categories',
    ];

    protected $messages = [
        'category_id.required' => 'The category cannot be empty.',
        'sub_category_id.required' => 'The sub category cannot be empty.',
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

        // Execution doesn't reach here if validation fails.
        SubSubCategory::query()->create($validatedData);
        Note::createSystemNotification(Admin::class, 'New Sub-SubCategory', $this->name . ' added successfully.');
        $this->emit('noteAdded');
        $this->reset();
        $this->alert(
            'success',
            'Sub-SubCategory successfully saved.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.sub-sub.add-sub-sub-category', [
            'categories' => $this->readyToLoad
                ? Category::query()->orderBy('name')->get()
                : [],
            'sub_categories' => $this->readyToLoad
                ? SubCategory::query()->orderBy('name')->whereIn('category_id', [$this->category_id])->get()
                : [],
        ])->layout('layouts.admin');
    }
}

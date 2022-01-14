<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Note\Note;

class AddBrand extends Component
{
    public $name;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected array $rules = [
        'name' => 'string|required|max:255|unique:brands'
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
        Brand::query()->create($validatedData);
        Note::createSystemNotification(Admin::class, 'New Brand', $this->name . ' added successfully.');
        $this->emit('noteAdded');
        $this->reset();
        $this->alert(
            'success',
            'Brand successfully saved.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.brand.add-brand')
            ->layout('layouts.admin');
    }
}

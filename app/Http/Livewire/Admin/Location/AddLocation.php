<?php

namespace App\Http\Livewire\Admin\Location;

use App\Models\Admin;
use App\Models\Location;
use Livewire\Component;
use Note\Note;

class AddLocation extends Component
{
    public $name;
    public $cost;
    public $address;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected array $rules = [
        'name' => 'string|required|max:255|unique:locations',
        'cost' => 'numeric|required',
        'address' => 'string|required',
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
        Location::query()->create($validatedData);
        Note::createSystemNotification(Admin::class, 'New location', $this->name . ' added successfully.');
        $this->emit('noteAdded');
        $this->reset();
        $this->alert(
            'success',
            'Location successfully saved.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.location.add-location')
            ->layout('layouts.admin');
    }
}

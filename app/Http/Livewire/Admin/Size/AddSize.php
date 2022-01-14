<?php

namespace App\Http\Livewire\Admin\Size;

use App\Models\Admin;
use App\Models\Size;
use Livewire\Component;
use Note\Note;

class AddSize extends Component
{
    public $value;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected array $rules = [
        'value' => 'string|required|max:255|unique:sizes'
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
        Size::query()->create($validatedData);
        Note::createSystemNotification(Admin::class, 'New Size', $this->value . ' added successfully.');
        $this->emit('noteAdded');
        $this->reset();
        $this->alert(
            'success',
            'Size successfully saved.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.size.add-size')
            ->layout('layouts.admin');
    }
}

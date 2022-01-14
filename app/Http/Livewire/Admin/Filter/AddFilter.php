<?php

namespace App\Http\Livewire\Admin\Filter;

use App\Models\Admin;
use App\Models\FilterType;
use Livewire\Component;
use Note\Note;

class AddFilter extends Component
{
    public $name;
    public $type;
    public array $filters = [
        'Processor',
        'Hard Drive',
        'Hard Drive Type',
        'Memory',
        'Operating System',
    ];

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected array $rules = [
        'name' => 'string|required|max:255',
        'type' => 'string|required|max:255',
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
        FilterType::query()->create($validatedData);
        Note::createSystemNotification(Admin::class, 'New Filter Type', $this->name . ' added successfully.');
        $this->emit('noteAdded');
        $this->reset();
        $this->alert(
            'success',
            'Filter successfully saved.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.filter.add-filter')
            ->layout('layouts.admin');
    }
}

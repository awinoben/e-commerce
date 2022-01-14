<?php

namespace App\Http\Livewire\Admin\Location;

use App\Models\Admin;
use App\Models\Location;
use Livewire\Component;
use Note\Note;

class EditLocation extends Component
{
    public $location;
    public $name;
    public $cost;
    public $address;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(string $id)
    {
        $this->location = Location::query()->findOrFail($id);
        $this->name = $this->location->name;
        $this->cost = $this->location->cost;
        $this->address = $this->location->address;
    }

    protected array $rules = [
        'name' => 'string|required|max:255',
        'cost' => 'numeric|required',
        'address' => 'string|required'
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

        $location = $this->location;
        $location->fill($validatedData);
        if ($location->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $location->save();
        Note::createSystemNotification(Admin::class, 'Location Update', $this->name . ' updated successfully.');
        $this->emit('noteAdded');
        $this->alert(
            'success',
            'Location successfully updated.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.location.edit-location', [
            'location' => $this->location
        ])->layout('layouts.admin');
    }
}

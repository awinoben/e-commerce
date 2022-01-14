<?php

namespace App\Http\Livewire\Admin\Color;

use App\Models\Admin;
use App\Models\Color;
use Livewire\Component;
use Note\Note;

class EditColor extends Component
{
    public $color;
    public $value;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(string $id)
    {
        $this->color = Color::query()->findOrFail($id);
        $this->value = $this->color->value;
    }

    protected array $rules = [
        'value' => 'string|required|max:255|unique:colors'
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

        $color = $this->color;
        $color->fill($validatedData);
        if ($color->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $color->save();
        Note::createSystemNotification(Admin::class, 'Color Update', $this->value . ' updated successfully.');
        $this->emit('noteAdded');
        $this->alert(
            'success',
            'Color successfully updated.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.color.edit-color', [
            'color' => $this->color
        ])->layout('layouts.admin');
    }
}

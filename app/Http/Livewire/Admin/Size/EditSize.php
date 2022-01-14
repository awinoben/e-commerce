<?php

namespace App\Http\Livewire\Admin\Size;

use App\Models\Admin;
use App\Models\Size;
use Livewire\Component;
use Note\Note;

class EditSize extends Component
{
    public $size;
    public $value;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(string $id)
    {
        $this->size = Size::query()->findOrFail($id);
        $this->value = $this->size->value;
    }

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

        $size = $this->size;
        $size->fill($validatedData);
        if ($size->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $size->save();
        Note::createSystemNotification(Admin::class, 'Size Update', $this->value . ' updated successfully.');
        $this->emit('noteAdded');
        $this->alert(
            'success',
            'Size successfully updated.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.size.edit-size', [
            'size' => $this->size
        ])->layout('layouts.admin');
    }
}

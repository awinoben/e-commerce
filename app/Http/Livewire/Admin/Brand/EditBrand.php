<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Admin;
use App\Models\Brand;
use Livewire\Component;
use Note\Note;

class EditBrand extends Component
{
    public $brand;
    public $name;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(string $id)
    {
        $this->brand = Brand::query()->findOrFail($id);
        $this->name = $this->brand->name;
    }

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

        $brand = $this->brand;
        $brand->fill($validatedData);
        if ($brand->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $brand->save();
        Note::createSystemNotification(Admin::class, 'Brand Update', $this->name . ' updated successfully.');
        $this->emit('noteAdded');
        $this->alert(
            'success',
            'Brand successfully updated.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.brand.edit-brand', [
            'brand' => $this->brand
        ])->layout('layouts.admin');
    }
}

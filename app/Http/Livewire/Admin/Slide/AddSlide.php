<?php

namespace App\Http\Livewire\Admin\Slide;

use App\Http\Controllers\SystemController;
use App\Models\Admin;
use App\Models\Slide;
use Livewire\Component;
use Livewire\WithFileUploads;
use Note\Note;

class AddSlide extends Component
{
    use WithFileUploads;

    public $name;
    public $url;
    public $slide_image;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected array $rules = [
        'name' => 'string|required|max:255',
        'url' => 'url|nullable|max:255',
        'slide_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000','required']
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
        // pass image params
        $image = SystemController::store_media($this->slide_image);

        Slide::query()->create([
            'name' => $this->name,
            'url' => $this->url,
            'slide_image' => $image[0],
            'slide_image_url' => $image[1],
        ]);
        Note::createSystemNotification(Admin::class, 'New Slide', $this->name . ' added successfully.');
        $this->emit('noteAdded');
        $this->reset();
        $this->alert(
            'success',
            'Slide successfully saved.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.slide.add-slide')
            ->layout('layouts.admin');
    }
}

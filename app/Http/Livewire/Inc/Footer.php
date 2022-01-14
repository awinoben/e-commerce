<?php

namespace App\Http\Livewire\Inc;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Subscriber;
use Livewire\Component;
use Note\Note;

class Footer extends Component
{
    public $email;

    protected $listeners = [
        'confirmedSubscription',
        'cancelled'
    ];

    protected array $rules = [
        'email' => 'string|email|required|max:255|unique:subscribers'
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
            'onConfirmed' => 'confirmedSubscription',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmedSubscription()
    {
        $validatedData = $this->validate();

        // Execution doesn't reach here if validation fails.
        Subscriber::query()->create($validatedData);
        Note::createSystemNotification(Admin::class, 'New Subscriber', $this->email . ' has subscribed to our system.');
        $this->emit('noteAdded');
        $this->reset();
        $this->alert(
            'success',
            'Thank you for subscribing with us, we will be updating you in any new item that we bring.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.inc.footer',[
            'categories'=>Category::query()->inRandomOrder()->limit(4)->get()
        ]);
    }
}

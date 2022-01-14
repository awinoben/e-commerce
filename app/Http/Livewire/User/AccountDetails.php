<?php

namespace App\Http\Livewire\User;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;

class AccountDetails extends Component
{
    use FindGuard;

    public $name;
    public $email;
    public $phone_number;
    public $password;
    public $validatedData;
    public $confirm_password;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount()
    {
        $this->name = $this->findGuardType()->user()->name;
        $this->email = $this->findGuardType()->user()->email;
        $this->phone_number = $this->findGuardType()->user()->phone_number;
    }

    public function submit()
    {
        $this->validatedData = $this->validate([
            'name' => 'required|min:6',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ]);

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
        $user = $this->findGuardType()->user();
        $user->fill($this->validatedData);
        if ($user->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $user->save();
        $this->alert('success', 'Account details updated successfully.');
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.user.account-details', [
            'user' => $this->findGuardType()->user()
        ]);
    }
}

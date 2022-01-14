<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Note\Note;

class AdminProfile extends Component
{
    use FindGuard;

    public $admin;
    public $email;
    public $name;
    public $phone_number;
    public $old_password;
    public $new_password;
    public $confirm_password;

    public function mount()
    {
        $this->admin = $this->findGuardType()->user();
        $this->name = $this->admin->name;
        $this->phone_number = $this->admin->phone_number;
        $this->email = $this->admin->email;
    }

    protected $listeners = [
        'confirmed',
        'cancelled',
        'changePassword'
    ];

    protected array $rules = [
        'name' => 'string|required|max:255',
        'email' => 'string|email|required|max:255',
        'phone_number' => 'numeric|required'
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

    public function resetPassword()
    {
        $this->validate([
            'old_password' => 'required|string',
            'new_password' => 'nullable|min:6|required_with:confirm_password|string|confirmed',
            'confirm_password' => 'required|min:6|string',
        ]);

        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'changePassword',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function changePassword()
    {
        $admin = $this->admin;
        // check if password match
        if (Hash::check($this->old_password, $admin->password)) {
            $admin->password = bcrypt($this->new_password);
            $admin->save();
            Note::createSystemNotification(Admin::class, 'Password Update', $this->name . ' updated successfully.');
            $this->emit('noteAdded');
            $this->alert(
                'success',
                'Password successfully updated.'
            );
        } else {
            $this->alert('error', 'You provided a wrong current password.');
        }
    }

    public function confirmed()
    {
        $validatedData = $this->validate();
        $admin = $this->admin;
        $admin->fill($validatedData);
        if ($admin->isClean()) {
            $this->alert('warning', 'At least one value must change.');
            return redirect()->back();
        }

        $admin->save();
        Note::createSystemNotification(Admin::class, 'Profile Update', $this->name . ' updated successfully.');
        $this->emit('noteAdded');
        $this->alert(
            'success',
            'Profile successfully updated.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.profile.admin-profile', [
            'admin' => $this->admin
        ])->layout('layouts.admin');
    }
}

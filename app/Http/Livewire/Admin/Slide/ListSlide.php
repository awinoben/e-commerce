<?php

namespace App\Http\Livewire\Admin\Slide;

use App\Http\Controllers\SystemController;
use App\Models\Admin;
use App\Models\Slide;
use Livewire\Component;
use Livewire\WithPagination;
use Note\Note;

class ListSlide extends Component
{
    use WithPagination;

    public $readyToLoad = false;
    public $search = '';
    public $model_id;

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(string $id)
    {
        $this->model_id = $id;
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
        $slide = Slide::query()->findOrFail($this->model_id);
        SystemController::un_link_media($slide->slide_image);
        $slide->forceDelete();
        Note::createSystemNotification(Admin::class, 'Slide Deletion', 'Slide deleted successfully.');
        $this->emit('noteAdded');
        $this->loadData();
        $this->alert(
            'success',
            'Slide deleted successfully.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.slide.list-slide', [
            'slides' => $this->readyToLoad
                ? Slide::query()
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->search . '%')
                            ->orWhere('slug', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}

<?php

namespace App\Http\Livewire\Inc;

use Livewire\Component;
use ShiftechAfrica\CodeGenerator\ShiftCodeGenerator;

class Modal extends Component
{
    public $product;
    public $tab1;
    public $tab2;
    public $tab3;
    public $tab4;

    public function mount()
    {
        $this->tab1 = (new ShiftCodeGenerator)->generate();
        $this->tab2 = (new ShiftCodeGenerator)->generate();
        $this->tab3 = (new ShiftCodeGenerator)->generate();
        $this->tab4 = (new ShiftCodeGenerator)->generate();
    }

    public function render()
    {
        return view('livewire.inc.modal');
    }
}

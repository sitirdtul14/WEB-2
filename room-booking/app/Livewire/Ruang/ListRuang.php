<?php
namespace App\Livewire\Ruang;

use App\Models\Ruang;
use Livewire\Component;

class ListRuang extends Component
{
    public function render()
    {
        return view('livewire.ruang.list-ruang', [
            'ruangs' => Ruang::all(),
        ]);
    }
}

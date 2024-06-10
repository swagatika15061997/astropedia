<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Astrologer;

class ChatComponent extends Component
{
    public $astrologer;
    public function render()
    {
        return view('livewire.chat-component');
    }
    public function mount($id)
    {
       $this->astrologer = Astrologer::where('id',$id)->first();
    }
}

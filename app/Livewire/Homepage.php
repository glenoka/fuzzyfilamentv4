<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Formation;

class Homepage extends Component
{
     public $search = '';
    public $formasi;
    public $perPage = 3;
    public $loaded = 3;
   
    
    public function loadMore()
    {
        $this->loaded += $this->perPage;
    }
    
    
    
    public function render()
    {
        $dataformasi = Formation::when($this->search, function($query) {
            return $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->with(['village', 'district'])
      
        ->paginate($this->loaded);

        return view('livewire.homepage',compact('dataformasi'));
    }
    
}

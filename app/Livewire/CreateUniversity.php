<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\University;

class CreateUniversity extends Component
{
    public $name, $email, $location;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:universities,email',
        'location' => 'required|string',
    ];

    public function createUniversity()
    {
        $this->validate();

        University::create([
            'name' => $this->name,
            'email' => $this->email,
            'location' => $this->location,
        ]);

        session()->flash('success', 'University added successfully.');
        $this->reset(); // Clear form
    }

    public function render()
    {
        return view('livewire.admin.create-university');
    }
}

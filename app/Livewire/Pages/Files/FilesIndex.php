<?php

namespace App\Livewire\Pages\Files;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class FilesIndex extends Component
{
    use WithFileUploads;

    #[Rule(['files.*' => 'required|file|max:3072'])]
    public $files = [];

    public function upload()
    {
        $this->validate();

        foreach ($this->files as $file) {
            $file->store('files');
        }

        $this->files = [];
    }

    public function render()
    {
        return view('livewire.pages.files.index')->extends('layouts.app')->section('content');
    }
}

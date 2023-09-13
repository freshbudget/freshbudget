<?php

namespace App\Livewire\Pages\Files;

use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FilesIndex extends Component
{
    use WithFileUploads;

    #[Rule(rule: [
        'files.*' => 'required|file|max:50000',
    ], attribute: [
        'files.*.required' => 'Please select at least one file to upload.',
    ])]
    public $files = [];

    public function updatedFiles()
    {
        $this->validate();

        /** @var TemporaryUploadedFile $file */
        foreach ($this->files as $file) {
            currentBudget()
                ->addMedia($file)
                ->usingName($file->getClientOriginalName())
                ->usingFileName(Str::ulid())
                ->toMediaCollection('root');
        }

        $this->files = [];
    }

    public function render()
    {
        return view('livewire.pages.files.index')->extends('layouts.app')->section('content');
    }
}

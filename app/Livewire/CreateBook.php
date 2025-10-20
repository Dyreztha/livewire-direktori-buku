<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Tambah Buku Baru')]
class CreateBook extends Component
{
    use WithFileUploads;

    public $title = '';
    public $author = '';
    public $rating = 1;
    public $description = '';
    public $pages = 0;
    public $isbn = '';
    public $cover;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'author' => 'required|min:3|max:255',
        'rating' => 'required|integer|min:1|max:5',
        'description' => 'nullable|string',
        'pages' => 'required|integer|min:1',
        'isbn' => 'required|unique:books,isbn',
        'cover' => 'nullable|image|max:2048'
    ];

    protected $messages = [
        'cover.image' => 'File harus berupa gambar.',
        'cover.max' => 'Ukuran gambar maksimal 2MB.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated = $this->validate();
        if ($this->cover) {
            $coverPath = $this->cover->store('covers', 'public');
            $validated['cover'] = $coverPath;
        }

        Book::create($validated);
        session()->flash('message', 'Buku berhasil ditambahkan!');
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.create-book');
    }
}

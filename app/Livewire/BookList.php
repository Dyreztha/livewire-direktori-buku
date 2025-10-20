<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\Url;

class BookList extends Component
{
    #[Url]
    public $search = '';
    public $name = '';
    public function mount()
    {
        $this->name = session('user_name', 'Guest');
    }

    public function updateName()
    {
        $this->validate([
            'name' => 'required|min:3'
        ]);
        session(['user_name' => $this->name]);
        session()->flash('message', 'Nama berhasil diperbarui menjadi: ' . $this->name);
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);
        
        if ($book) {
            $book->delete();
            session()->flash('message', 'Buku berhasil dihapus!');
        }
    }

    public function render()
    {
        $books = Book::where('title', 'like', '%' . $this->search . '%')
                     ->orWhere('author', 'like', '%' . $this->search . '%')
                     ->latest()
                     ->get();

        return view('livewire.book-list', [
            'books' => $books
        ]);
    }
}

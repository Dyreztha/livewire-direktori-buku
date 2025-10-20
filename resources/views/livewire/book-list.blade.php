<div class="container">
    <div class="header">
        <h1>Direktori Buku</h1>
        
        <div class="name-section">
            <input 
                type="text" 
                wire:model.live="name" 
                placeholder="Masukkan nama Anda"
                class="input"
            >
            <button wire:click="updateName" class="btn btn-primary">
                Perbarui Nama
            </button>
            <p>Halo, {{ $name }}!</p>
        </div>

        <div class="search-section">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Cari buku berdasarkan judul atau penulis..."
                class="input search-input"
            >
        </div>

        <a href="{{ route('books.create') }}" wire:navigate class="btn btn-success">
            + Tambah Buku Baru
        </a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="books-grid">
        @forelse ($books as $book)
            <div class="book-card">
                @if ($book->cover)
                    <div class="book-cover">
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover {{ $book->title }}">
                    </div>
                @else
                    <div class="book-cover-placeholder">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 2H9c-1.1 0-2 .9-2 2v5.5c0 .8.7 1.5 1.5 1.5s1.5-.7 1.5-1.5V4h9v16H9.5c-.3 0-.5.2-.5.5s.2.5.5.5H19c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                        </svg>
                        <span>No Cover</span>
                    </div>
                @endif

                <div class="book-info">
                    <h3>{{ $book->title }}</h3>
                    <p class="author">oleh {{ $book->author }}</p>
                    <p class="rating">Rating: {{ $book->rating }}/5 ⭐</p>
                    <p class="description">{{ Str::limit($book->description, 100) }}</p>
                    <p class="pages">Halaman: {{ $book->pages }}</p>
                    <p class="isbn">ISBN: {{ $book->isbn }}</p>
                    
                    <button 
                        wire:click="deleteBook({{ $book->id }})" 
                        wire:confirm="Apakah Anda yakin ingin menghapus buku ini?"
                        class="btn btn-danger"
                    >Hapus</button>
                </div>
            </div>
        @empty
            <p class="no-books">Tidak ada buku ditemukan.</p>
        @endforelse
    </div>
</div>

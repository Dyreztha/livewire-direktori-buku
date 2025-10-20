<div class="container">
    <div class="header">
        <h1>Tambah Buku Baru</h1>
        <a href="{{ route('books.index') }}" wire:navigate class="btn btn-secondary">
            ← Kembali ke Daftar Buku
        </a>
    </div>

    <form wire:submit.prevent="save" class="book-form">
        
        <div class="form-group">
            <label>Cover Buku</label>
            <div 
                class="upload-area @error('cover') error @enderror"
                x-data="{ 
                    isDragging: false,
                    handleDrop(e) {
                        this.isDragging = false;
                        if (e.dataTransfer.files.length > 0) {
                            @this.upload('cover', e.dataTransfer.files[0]);
                        }
                    }
                }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="handleDrop($event)"
                :class="{ 'dragging': isDragging }"
            >
                @if ($cover)
                    <div class="cover-preview">
                        <img src="{{ $cover->temporaryUrl() }}" alt="Preview Cover">
                        <button type="button" wire:click="$set('cover', null)" class="remove-cover">
                            ✕ Hapus Cover
                        </button>
                    </div>
                @else
                    <div class="upload-placeholder">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="upload-text">Seret gambar ke sini atau</p>
                        <label for="cover-input" class="btn btn-outline">
                            Pilih File
                        </label>
                        <input 
                            type="file" 
                            id="cover-input"
                            wire:model="cover" 
                            accept="image/*"
                            class="hidden-input"
                        >
                        <p class="upload-hint">PNG, JPG, JPEG (Max 2MB)</p>
                    </div>
                @endif
            </div>
            
            @error('cover') 
                <span class="error-message">{{ $message }}</span> 
            @enderror

            <div wire:loading wire:target="cover" class="upload-progress">
                Mengunggah cover...
            </div>
        </div>

        <div class="form-group">
            <label for="title">Judul Buku *</label>
            <input 
                type="text" 
                id="title"
                wire:model.blur="title" 
                class="input @error('title') error @enderror"
                placeholder="Masukkan judul buku"
            >
            @error('title') 
                <span class="error-message">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Nama Penulis *</label>
            <input 
                type="text" 
                id="author"
                wire:model.blur="author" 
                class="input @error('author') error @enderror"
                placeholder="Masukkan nama penulis"
            >
            @error('author') 
                <span class="error-message">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group">
            <label for="rating">Rating (1-5) *</label>
            <input 
                type="number" 
                id="rating"
                wire:model.blur="rating" 
                min="1" 
                max="5"
                class="input @error('rating') error @enderror"
            >
            @error('rating') 
                <span class="error-message">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group">
            <label for="pages">Jumlah Halaman *</label>
            <input 
                type="number" 
                id="pages"
                wire:model.blur="pages" 
                min="1"
                class="input @error('pages') error @enderror"
                placeholder="Masukkan jumlah halaman"
            >
            @error('pages') 
                <span class="error-message">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group">
            <label for="isbn">Nomor ISBN *</label>
            <input 
                type="text" 
                id="isbn"
                wire:model.blur="isbn" 
                class="input @error('isbn') error @enderror"
                placeholder="Masukkan nomor ISBN"
            >
            @error('isbn') 
                <span class="error-message">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Buku</label>
            <textarea 
                id="description"
                wire:model.blur="description" 
                rows="4"
                class="input @error('description') error @enderror"
                placeholder="Masukkan deskripsi singkat tentang buku"
            ></textarea>
            @error('description') 
                <span class="error-message">{{ $message }}</span> 
            @enderror
        </div>

<button 
    type="submit" 
    class="btn btn-success"
    wire:loading.attr="disabled"
    wire:target="save, cover"
>
    <span wire:loading.remove wire:target="save">💾 Simpan Buku</span>
    <span wire:loading wire:target="save">⏳ Menyimpan...</span>
</button>

<div wire:loading wire:target="cover" class="loading-message">
    Mengunggah cover buku...
</div>

    </form>
</div>

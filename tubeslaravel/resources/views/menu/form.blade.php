<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu' }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 600px; margin: auto; background: white;
                     padding: 25px; border-radius: 8px; }
        label { display: block; margin-top: 14px; font-weight: bold; }
        input, textarea, select { width: 100%; box-sizing: border-box;
                                  padding: 10px; margin-top: 6px; }
        button, .back { display: inline-block; padding: 10px 14px;
                        margin-top: 20px; border: none; border-radius: 4px;
                        cursor: pointer; text-decoration: none; }
        button { background: #198754; color: white; }
        .back { background: #6c757d; color: white; }
        .error { color: #dc3545; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu' }}</h1>

    @if ($errors->any())
        <div class="error">
            <p>Periksa kembali data yang kamu masukkan:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($menu)
        ? route('menu.update', $menu->id)
        : route('menu.store') }}" method="POST">

        @csrf

        @if (isset($menu))
            @method('PUT')
        @endif

        <label>Nama Menu</label>
        <input type="text" name="nama"
               value="{{ old('nama', $menu->nama ?? '') }}" required>

        <label>Kategori</label>
        <input type="text" name="kategori"
               value="{{ old('kategori', $menu->kategori ?? '') }}"
               placeholder="Makanan atau Minuman" required>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" min="0"
               value="{{ old('harga', $menu->harga ?? '') }}" required>

        <label>Alergen</label>
        <input type="text" name="alergen"
               value="{{ old('alergen', $menu->alergen ?? '') }}"
               placeholder="Contoh: susu, kacang, atau tidak ada" required>

        
<label>Status Halal</label>
<select name="halal" required>
    <option value="">-- Pilih Status --</option>

    <option value="Ya" {{ old('halal', $menu->halal ?? '') == 'Ya' ? 'selected' : '' }}>
        Ya
    </option>

    <option value="Tidak" {{ old('halal', $menu->halal ?? '') == 'Tidak' ? 'selected' : '' }}>
        Tidak
    </option>

    <option value="Belum diketahui" {{ old('halal', $menu->halal ?? '') == 'Belum diketahui' ? 'selected' : '' }}>
        Belum diketahui
    </option>
</select>


        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4" required>{{ old('deskripsi', $menu->deskripsi ?? '') }}</textarea>

        <button type="submit">Simpan</button>
        <a href="{{ route('menu.index') }}" class="back">Kembali</a>
    </form>
</div>
</body>
</html>
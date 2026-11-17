
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Menu Restaurant & Cafe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        h1 { color: #333; }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .add { background: #198754; }
        .edit { background: #0d6efd; }
        .delete { background: #dc3545; }
        .login { background: #0d6efd; }
        .register { background: #198754; }
        .logout { background: #dc3545; }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 25px;
            padding: 15px;
            background: white;
            border-radius: 6px;
        }

        .message {
            background: #d1e7dd;
            padding: 12px;
            margin: 15px 0;
        }

        .error {
            background: #f8d7da;
            padding: 12px;
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th { background: #333; color: white; }

        form.inline { display: inline; }
    </style>
</head>

<body>
<div class="container">

    <!-- NAVIGATION -->
    <div class="navbar">
        <div>
            @auth
                <strong>Halo, {{ auth()->user()->name }}!</strong>
                <span>
                    ({{ ucfirst(auth()->user()->role) }})
                </span>
            @else
                <strong>Selamat Datang!</strong>
                <span>Silakan login untuk mengakses akun.</span>
            @endauth
        </div>

        <div>
            @guest
                <a href="{{ route('login') }}" class="btn login">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn register">
                    Register
                </a>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn logout">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>

    <h1>Buku Menu Restaurant & Cafe</h1>
    <p>Daftar makanan dan minuman</p>

    <!-- SUCCESS MESSAGE -->
    @if (session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    <!-- ERROR MESSAGE -->
    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <!-- ADMIN ONLY: ADD MENU BUTTON -->
    @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('menu.create') }}" class="btn add">
                + Tambah Menu
            </a>
        @endif
    @endauth

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Alergen</th>
                <th>Halal</th>
                <th>Deskripsi</th>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <th>Aksi</th>
                    @endif
                @endauth
            </tr>
        </thead>

        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>{{ $menu->alergen }}</td>
                    <td>{{ $menu->halal }}</td>
                    <td>{{ $menu->deskripsi }}</td>

                    <!-- ADMIN ONLY: EDIT AND DELETE -->
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <td>
                                <a href="{{ route('menu.edit', $menu->id) }}"
                                   class="btn edit">
                                    Edit
                                </a>

                                <form class="inline"
                                      action="{{ route('menu.destroy', $menu->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn delete">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        @endif
                    @endauth
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data menu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
</body>
</html>

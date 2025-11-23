<!DOCTYPE html>
<html>
<head>
    <title>Data Role User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .action-buttons {
            display: flex; /* Untuk menata tombol sejajar */
            gap: 5px;      /* Memberi sedikit jarak antar tombol */
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Data Role User</h1>
        
        <a href="{{ route('admin.role-user.create') }}" class="btn btn-primary mb-3">
            Tambah Role User
        </a>

        <table border="1" cellpadding="8" cellspacing="0" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Nama Role</th>
                    <th>Status</th>
                    <th style="width: 15%;">Aksi</th> </tr>
            </thead>
            <tbody>
                @foreach ($roleUsers as $index => $ru)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ru->user->nama ?? '-' }}</td>
                        <td>{{ $ru->user->email ?? '-' }}</td>
                        <td>{{ $ru->role->nama_role ?? '-' }}</td>
                        <td>{{ $ru->status == 1 ? 'Active' : 'Inactive' }}</td>
                        
                        {{-- KOLOM AKSI --}}
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.role-user.edit', $ru->idrole_user) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.role-user.destroy', $ru->idrole_user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Role User ini?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Data Role User</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Role User</h1>
    
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Nama Role</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roleUsers as $index => $ru)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ru->user->nama ?? '-' }}</td>
                    <td>{{ $ru->user->email ?? '-' }}</td>
                    <td>{{ $ru->role->nama_role ?? '-' }}</td>
                    <td>{{ $ru->status == 1 ? 'Active' : 'Inactive' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detail Peminjaman Buku</h1>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Nama Peminjam</th>
                    <td>{{ $loan['user']['name'] }}</td>
                </tr>
                <tr>
                    <th>Judul Buku</th>
                    <td>{{ $loan['book']['judul'] }}</td>
                </tr>
                <tr>
                    <th>Tanggal Peminjaman</th>
                    <td>{{ $loan['tanggal_pinjam'] }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengembalian</th>
                    <td>{{ $loan['tanggal_jatuh_tempo'] }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $loan['status_pengembalian'] }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Perpustakaan</p>
        </div>
    </div>
</body>
</html>

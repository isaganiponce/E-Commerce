<!DOCTYPE html>
<html>
<head>
    <title>Finance Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Customer Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finances as $finance)
            <tr>
                <td>{{ $finance->id }}</td>
                <td>{{ $finance->product_id }}</td>
                <td>{{ $finance->quantity }}</td>
                <td>{{ $finance->price }}</td>
                td>{{ $finance->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<html lang="en">
    <head>
        <title>Alle verhuringen.</title>
        <style></style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Start datum:</th>
                    <th>Eind datum:</th>
                    <th>Status:</th>
                    <th>Groep:</th>
                    <th>Email:</th>
                    <th>Tel. Nummer:</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all as $rental)
                    <tr>
                        <td>#{!! $rental->id !!}</td>
                        <td>{{ date('d/m/Y', strtotime($rental->start_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($rental->end_date)) }}</td>
                        <td>{{ $rental->status->name }}</td>
                        <td>{{ $rental->group }}</td>
                        <td>{{ $rental->email }}</td>
                        <td>{{ $rental->phone_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>

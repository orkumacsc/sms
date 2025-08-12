<table>
    <tr>
        <th colspan="2" class="text-center">
            <h4>{{ $student['surname'] }}, {{ $student['firstname'] }} {{ $student['middlename']}}</h4>
        </th>
    </tr>
    <tr>
        <th colspan="2" class="text-center">PERSONAL DATA</th>
    </tr>
    <tr>
        <th>GENDER</th>
        <td>{{ $student['gendername'] }}</td>
    </tr>
    <tr>
        <th>ADMISSION NO</th>
        <td>{{ $student['admission_no'] }}</td>
    </tr>
    <tr>
        <th>DATE OF BIRTH</th>
        <td>{{ \Carbon\Carbon::parse($student['date_of_birth'])->format('d M., Y') }}</td>
    </tr>
    <tr>
        <th>HOUSE</th>
        <td>{{ $student['name'] }}</td>
    </tr>
    <tr>
        <th>CLUB/SOCIETY</th>
        <td>{{ $student['club'] ?? '-' }}</td>
    </tr>
</table>
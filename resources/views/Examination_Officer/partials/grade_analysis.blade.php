<table>
    <tr>
        <th colspan="2" class="text-center">GRADE ANALYSIS</th>
    </tr>
    <tr>
        <th>GRADE</th>
        <th>NO</th>
    </tr>
    @foreach(['A','B','C','D','E','F'] as $grade)
        <tr>
            <th>{{ $grade }}</th>
            <td>{{ $grade_analysis[$student['id']][$grade] ?? '-' }}</td>
        </tr>
    @endforeach
</table>
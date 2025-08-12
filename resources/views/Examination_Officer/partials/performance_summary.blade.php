@php
    $student_result = $computed_results[$student['id']] ?? null;
@endphp
@if($student_result)
<table>
    <tr>
        <th colspan="2" class="text-center">PERFORMANCE SUMMARY</th>
    </tr>
    <tr>
        <th>TOTAL SUBJECTS OFFERED</th>
        <td>{{ $student_result['total_subjects_offered'] ?? count($subjects_in_class) }}</td>
    </tr>
    <tr>
        <th>TOTAL MARKS OBTAINABLE</th>
        <td>{{ $student_result['obtainable_marks'] ?? (count($subjects_in_class) * 100) }}</td>
    </tr>
    <tr>
        <th>TOTAL MARKS OBTAINED</th>
        <td>{{ $student_result['obtained_marks'] ?? '-' }}</td>
    </tr>
    <tr>
        <th>AVERAGE</th>
        <td>{{ $student_result['average_score'] ?? '-' }}</td>
    </tr>
    <tr>
        <th>POSITION Out Of CLASS SIZE</th>
        <td>
            {{ isset($student_result['position_in_class']) ? suffix($student_result['position_in_class']) : '-' }}
            out Of {{ count($computed_results) }}
        </td>
    </tr>
    <tr>
        <th>CLASS AVERAGE</th>
        <td>{{ $class_average ?? '-' }}</td>
    </tr>
    <tr>
        <th>PERFORMANCE REMARK (PASSED/FAILED)</th>
        <td>
            {{ isset($student_result['average_score']) && $student_result['average_score'] > 0 ? gradeOrRemark($student_result['average_score']) : 'FAILED' }}
        </td>
    </tr>
</table>
@endif
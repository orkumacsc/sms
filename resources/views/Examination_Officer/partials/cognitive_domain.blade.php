<table>
    <thead>
        <tr>
            <th class="text-center">COGNITIVE DOMAIN</th>
            <th colspan="{{ count($assessments) }}" class="text-center">SUMMARY OF C.A. SCORES</th>
            <th rowspan="2" class="vertical">TERM TOTAL</th>
            <th rowspan="3" class="vertical">CLASS AVERAGE</th>
            <th rowspan="3" class="vertical">CLASS HIGHEST</th>
            <th rowspan="3" class="vertical">CLASS LOWEST</th>
            <th rowspan="3" class="vertical">SUBJECT POSITION</th>
            <th rowspan="3" class="vertical">GRADE</th>
            <th rowspan="3" class="vertical">GRADE REMARKS</th>
        </tr>
        <tr>
            <th rowspan="2">SUBJECTS</th>
            @foreach($assessments as $cass)
                <th class="text-center">{{ $cass['name'] }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($assessments as $cass)
                <th class="text-center">{{ $cass['percentage'] }}</th>
            @endforeach
            <th class="text-center">100</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects_in_class as $subject)
            <tr>
                <td>{{ $subject['subject_name'] }}</td>
                @foreach ($assessments as $cass)
                    <td class="text-center">
                        {{ $students_cass[$student['id']][$subject['id']][$cass['id']]['scores'] ?? '-' }}
                    </td>
                @endforeach
                @php
                    $summary = $subject_summary[$student['id']][$subject['id']] ?? null;
                @endphp
                <td class="text-center">{{ $summary['total_scores'] ?? '-' }}</td>
                <td class="text-center">{{ $summary['class_average'] ?? '-' }}</td>
                <td class="text-center">{{ $summary['class_highest'] ?? '-' }}</td>
                <td class="text-center">{{ $summary['class_lowest'] ?? '-' }}</td>
                <td class="text-center">{{ isset($summary['subject_position']) ? suffix($summary['subject_position']) : '-' }}</td>
                <td class="text-center">
                    {{ isset($summary['total_scores']) && $summary['total_scores'] > 0 ? gradeOrRemark($summary['total_scores'], false) : 'F' }}
                </td>
                <td class="text-center">
                    {{ isset($summary['total_scores']) && $summary['total_scores'] > 0 ? gradeOrRemark($summary['total_scores'], false, false) : 'FAIL' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
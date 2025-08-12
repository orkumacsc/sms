<table>
    <tr>
        <th colspan="2" class="text-center">CLASS DATA</th>
        <td rowspan="8" class="text-center">
            <img src="{{ (!empty($student['passport'])) ? url('storage/' . $student['passport']) : asset('backend/images/passport.png') }}" width="150" height="200">
        </td>
    </tr>
    <tr>
        <th>CLASS</th>
        <td>{{ $school_class->classname }} {{ $class_arm->arm_name }}</td>
    </tr>
    <tr>
        <th>TERM</th>
        <td>{{ $term->name }}</td>
    </tr>
    <tr>
        <th>SESSION</th>
        <td>{{ $academic_session->name }} ACADEMIC SESSION</td>
    </tr>
    <tr>
        <th colspan="2" class="text-center">ATTENDANCE SUMMARY</th>
    </tr>
    <tr>
        <th>No of Times School Opened</th>
        <td>{{ $student['attendance']['opened'] ?? 0 }}</td>
    </tr>
    <tr>
        <th>No of Times Present</th>
        <td>{{ $student['attendance']['present'] ?? 0 }}</td>
    </tr>
    <tr>
        <th>No of Times Absent</th>
        <td>{{ $student['attendance']['absent'] ?? 0 }}</td>
    </tr>
</table>
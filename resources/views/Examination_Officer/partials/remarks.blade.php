<table>
    <tr>
        <th>Form Master/Mistress Remark</th>
        <td class="text-right">{{ $student['form_master_remark'] ?? '' }}</td>
    </tr>
    <tr>
        <th>Principal's Remark</th>
        <td class="text-right">BAMIGBOYE, OLANREWAJU TIMOTHY</td>
    </tr>
    <tr>
        <th colspan="2">
            <p class="text-right">Sign Date: {{ \Carbon\Carbon::parse($term_end)->format('d M., Y') }}</p>
            Next Term Begins: {{ \Carbon\Carbon::parse($next_term_start)->format('d M., Y')  }}
        </th>
    </tr>
</table>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Pegawai</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11.5px;
        }

        table {
            margin-top: 7px;
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #444;
            padding: 2px;
            text-align: center;
            vertical-align: middle;
        }

        td.name-cell {
            white-space: nowrap;
            min-width: 120px;
            text-align: left;
        }

        .off {
            background-color: #f8a1a1;
            color: #e02424;
        }

        .shift-pagi { background-color: #A0C3D2; }
        .shift-siang { background-color: #EAC7C7; }
        .shift-sore { background-color: #EDC6B1; }
        .shift-malam { background-color: #B7B7B7; }
        .shift-off { background-color: #eee; color: #aaa; }
    </style>
</head>
<body>
@foreach ($groupedDates as $monthName => $datesInMonth)
<div style="page-break-after: always;">
    <h3 style="margin-bottom: 0;">Jadwal Piket OS PPSDM Aparatur</h3>
    <p>Bulan: {{ \Carbon\Carbon::parse($monthName)->translatedFormat('F Y') }}</p>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Pegawai</th>
                @foreach ($datesInMonth as $date)
                    <th>{{ \Carbon\Carbon::parse($date)->translatedFormat('D') }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach ($datesInMonth as $date)
                    <th>{{ \Carbon\Carbon::parse($date)->translatedFormat('j') }}</th>
                @endforeach
            </tr>
        </thead>
    
        <tbody>
            @foreach ($employees as $i => $employee)
                {{-- Baris Job Code --}}
                <tr>
                    <td >{{ $i + 1 }}</td>
                    <td class="text-left name-cell">{{ $employee->name }}</td>
                    @foreach ($datesInMonth as $date)
                        @php
                            $schedule = $employee->schedules->first(function ($item) use ($date) {
                                return \Carbon\Carbon::parse($item->work_date)->format('Y-m-d') === $date;
                            });
    
                            $jobCode = $schedule?->job?->code ?? 'OFF';
                        @endphp
    
                        <td class="cell text-center {{ strtolower($jobCode) }}">
                            {{ $jobCode }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach

</body>
</html>

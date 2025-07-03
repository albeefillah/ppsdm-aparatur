<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Pegawai</title>
    <style>
        @page {
            size: Legal landscape;
            margin: 1cm;
        }

    
        body {
            font-family: Helvetica;
            font-size: 9.5px; /* diperkecil sedikit agar muat */
        }
    
        table {
            width: 100%;
            table-layout: auto; /* ini penting agar kolom punya lebar rata */
            border-collapse: collapse;
        }
    
        th, td {
            border: 1px solid #dee2e6;
            padding: 3px;
            font-size: 9.5px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }
    
        .name-column {
            width: 200px;
            min-width: 180px;
            max-width: 220px;
            white-space: nowrap;
            text-align: left;
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
        }


    
        thead th {
            background-color: #dce9f7;
        }
    
        /* Warna shift & off */
        .pagi { background-color: #d1ecf1; }
        .siang { background-color: #fce4ec; }
        .sore { background-color: #fff3cd; }
        .malam { background-color: #e2e3e5; }
        .off {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
        }

        th.weekend,
        th.holiday {
            background-color: #ffd6d6;
            color: #b10000;
            font-weight: bold;
        }
    </style>
    
    
</head>
<body>
@foreach ($groupedDates as $monthName => $datesInMonth)
<div style="page-break-after: always;">
    <center><h1 style="margin-bottom: 0; font-size; 20px">Jadwal Piket CS PPSDM Aparatur</h1></center>
    <p style="font-size: 12px;">Bulan: {{ \Carbon\Carbon::parse($monthName)->translatedFormat('F Y') }}</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2" class="name-column">Nama Pegawai</th>
                @foreach ($datesInMonth as $date)
                    @php
                        $carbonDate = \Carbon\Carbon::parse($date);
                        $isWeekend = $carbonDate->isSaturday() || $carbonDate->isSunday();
                        $isHoliday = $holidays->contains($carbonDate->format('Y-m-d'));
                        $headerClass = $isWeekend || $isHoliday ? 'weekend holiday' : '';
                    @endphp
                    <th class="{{ $headerClass }}">
                        {{ $carbonDate->translatedFormat('D') }}
                    </th>
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
                    <td class="text-left name-column">{{ $employee->name }}</td>
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

    <p style="margin-top: 10px; font-size: 9.5px;"><strong>Keterangan:</strong></p>
    @php
        $jobChunks = $jobs->chunk(ceil($jobs->count() / 3));
    @endphp
    <table style="width: 100%; font-size: 9px; border: none; border-collapse: collapse; margin-top: 5px;">
        <tr>
            @foreach ($jobChunks as $chunk)
                <td style="vertical-align: top; width: 33%; border: none;">
                    <table style="width: 100%; border: none; border-collapse: collapse;">
                        @foreach ($chunk as $job)
                            <tr>
                                <td style="width: 40px; border: none; text-align:right;"><strong>{{ $job->code }}</strong></td>
                                <td style="border: none; text-align:left">
                                    = {{ $job->name }} 
                                    ({{ \Carbon\Carbon::parse($job->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($job->end)->format('H:i') }})
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            @endforeach
        </tr>
    </table>
    



    
</div>
@endforeach

</body>
</html>

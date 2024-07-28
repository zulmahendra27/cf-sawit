<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
        }

        .text-center {
            text-align: center;
        }

        .fs-3 {
            font-size: 1.2rem;
        }

        .fw-bold {
            font-weight: 400;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        table#consultation {
            width: 100%;
            border-collapse: collapse;
        }

        table#consultation th,
        table#consultation td {
            border: 1px solid black;
            padding: 8px;
            /* text-align: left; */
        }

        table#consultation th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 class="text-center">{{ $title }}</h1>

    <table class="mb-3">
        <tr class="fs-3 fw-bold">
            <td>Nama</td>
            <td>:</td>
            <td>{{ $consultations->name }}</td>
        </tr>
    </table>

    <table id="consultation">
        <tr>
            <th>No</th>
            <th>Nama Penyakit</th>
            <th>Persentase</th>
        </tr>
        @forelse ($consultations->logs as $consultation)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $consultation->highestConsultation->disease->nama }}
                </td>
                <td class="text-center">{{ $consultation->highestConsultation->percentage . ' %' }}
                </td>
            </tr>
        @empty
            <tr>
                <th colspan="3" class="text-center fs-5">-- Tidak ada data --</th>
            </tr>
        @endforelse
    </table>

</body>

</html>

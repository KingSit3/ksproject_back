<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      .page-break {
      page-break-after: always;
      }
      @media print {
          @page {
              margin-top: 0;
              margin-bottom: 0;
          }
          body {
              padding-top: 72px;
              padding-bottom: 72px ;
          }
      }
  </style>
  </head>
<body>

  <!-- {{-- Header --}} -->
  <div style="text-align: center; border-bottom-color: blue; border-bottom-width: 120px; border: 10px;">
    <h1>
      Laporan Infaq
      <br>
      Masjid Al-Istiqomah 
    </h1>
    <h3>
      Tahun: {{ $year }}
    </h3>
  </div>
  <!-- {{-- End Header --}} -->
  <table border="1" style="justify-content: center; align-items: center; text-align: center; width: 100%; padding: 10px 50px;">
    <tr>
      <td style="width: 10%; font-weight: bold">No</td>
      <td style="width: 40%; font-weight: bold">Bulan</td>
      <td style="width: 40%; font-weight: bold">Total Infaq</td>
    </tr>
    @forelse ($totalInfaq as $infaq)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $month[$loop->index] }}</td>
        <td>{{ 'Rp.'.number_format($infaq,0, ',' , '.') }}</td>
      </tr>
    @empty
        
    @endforelse
  </table>
</body>
</html>


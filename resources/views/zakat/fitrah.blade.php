<!DOCTYPE html>
<html lang="en">
<body>

  <!-- {{-- Header --}} -->
  <div style="text-align: center; border-bottom-color: blue; border-bottom-width: 120px; border: 10px;">
    <h1>
      Laporan Zakat Fitrah
      <br>
      Masjid Al-Istiqomah 
    </h1>
    <h3>
      Tahun: {{ $year }}
    </h3>
  </div>
  <!-- {{-- End Header --}} -->
  <div style="width: 100%; padding: 10px 300px;">
    <table>
      <tr>
        <td>Jumlah Muzakki</td>
        <td>:</td>
        <td>{{ $totalMuzakki }} Orang</td>
      </tr>
      <tr>
        <td>Total Zakat Uang</td>
        <td>:</td>
        <td>{{ $totalZakatUang }}</td>
      </tr>
      <tr>
        <td>Total Zakat Beras</td>
        <td>:</td>
        <td>{{ $totalZakatBeras }} Liter</td>
      </tr>
      <tr><td>&nbsp;</td></tr>
    </table>

    <table border="1"> 
      <thead>
        <th style="padding: 0 10px">No</th>
        <th style="padding: 0 10px">Nama</th>
        <th style="padding: 0 10px">No Telp</th>
        <th style="padding: 0 10px">Jenis Zakat</th>
        <th style="padding: 0 10px">Jumlah Zakat</th>
        <th style="padding: 0 10px">Tanggal Zakat</th>
      </thead>
      <tbody>
        
        @forelse ($dataZakat as $zakat)
        <tr>
          <td style="padding: 0 10px">{{ $loop->iteration }}</td>
          <td style="padding: 0 10px">{{ $zakat->nama }}</td>
          <td style="padding: 0 10px">{{ $zakat->no_telp ?? '-' }}</td>
          <td style="padding: 0 10px">{{ $zakat->jenis ?? '-' }}</td>
          <td style="padding: 0 10px">{{ $zakat->jenis == 'uang' ? 'Rp.'.number_format($zakat->jumlah,0, ',' , '.') : number_format($zakat->jumlah, 0).' Liter' }}</td>
          <td style="padding: 0 10px">{{  Carbon\Carbon::parse($zakat->created_at)->format('d-m-Y') }}</td>
        </tr>

        @empty
        <tr>
          <td colspan="6">Tidak Ada Data Zakat</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</body>
</html>
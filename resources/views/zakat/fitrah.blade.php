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
  <div style="width: 100%;">
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
    
    <table border="1" style="width: 100%">
      <thead>
        <th style="width: 5%">No</th>
        <th style="width: 25%">Nama</th>
        <th style="width: 25%">No Telp</th>
        <th style="width: 10%">Jenis Zakat</th>
        <th style="width: 20%">Jumlah Zakat</th>
        <th style="width: 20%">Tanggal Zakat</th>
      </thead>
    </table>

    <table border="1" style="width: 100%"> 
      <tbody>
        
        @forelse ($dataZakat as $zakat)
        <tr>
          <td style="width: 5%">{{ $loop->iteration }}</td>
          <td style="width: 25%">{{ $zakat->nama }}</td>
          <td style="width: 25%">{{ $zakat->no_telp ?? '-' }}</td>
          <td style="width: 10%">{{ $zakat->jenis ?? '-' }}</td>
          <td style="width: 20%">{{ $zakat->jenis == 'uang' ? 'Rp.'.number_format($zakat->jumlah,0, ',' , '.') : number_format($zakat->jumlah, 0).' Liter' }}</td>
          <td style="width: 20%">{{  Carbon\Carbon::parse($zakat->created_at)->format('d-m-Y') }}</td>
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
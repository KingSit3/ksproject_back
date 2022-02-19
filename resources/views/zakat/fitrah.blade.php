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
  </div>
</body>
</html>
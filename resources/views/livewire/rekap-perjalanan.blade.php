<div>

    {{ $this->table }}
    {{-- <table>
        <thead></thead>
        <tbody>
            @foreach ( $perjalanan as $p)
                <tr>
                    <td>{{ $p->mak->kode }}</td>
                    <td>{{ $p->kode_st }}</td>
                    <td>{{ $p->maksud_perjalanan }}</td>
                    <td>{{ $p->nama_pelaksana }}</td>
                    <td>{{ $p->kota_tujuan }}</td>
                    <td>{{ $p->tanggal_berangkat }}</td>
                    <td>{{ $p->uang_harian }}</td>
                    <td>{{ $p->uang_transport }}</td>
                    <td>{{ $p->total_bayar_spj }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->current_user }}</td>
                    <td>
                        <ul>
                            @foreach ($p->files as $file)
                            <li>
                                {{ $file }}
                            </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</div>

@extends('LKTNbooking/layout')

@section('title', 'LKTNbooking-jengkautbooking')

@section('content')

    <style>
        .text-red {}
    </style>
    <section class="mt-16" x-data="{
        kawasans: [
            'LKTN NEGERI KELANTAN',
            'BKK, PASIR PUTEH',
            'LKTN KAWASAN PASIR PUTEH',
            'RMCC, BUKIT MERBAU, PASIR PUTEH',
            'LKTN KAWASAN PASIR MAS',
            'LKTN KAWASAN BACHOK',
            'RMCC BERIS TENGAH',
            'CPMC, TOK BALI'
        ],
    
        selectedRows: [],
    
        showAlert: function(index) {
    
            if (!this.selectedRows || this.selectedRows.length === 0) {
                alert('No rows selected');
                event.preventDefault();
            }
    
        },
    
    
    }">

        <div class="flex flex-col items-center ">

            <div class="flex flex-col">


                <h1 class="font-bold text-xl self-center">Tempahan Jengkaut</h1>

                <div class="bg-white p-5 rounded-xl shadow-md mt-8 ">
                    <p>Negeri : {{ $negeriPilihan }} </p>
                    <p>Tarikh Tempahan : {{ $tarikhTempahan }} </p>
                    <p>Keluasan : {{ $keluasanTanah }} Hektar</p>

                </div>



                <div class=" w-auto bg-white rounded-xl p-5 shadow-md mt-4">
                    <div class="  overflow-x-auto ">
                        <table class=" table-auto">
                            <thead>
                                <tr>
                                    <th class="border border-black px-4 py-2 text-xs">Pilih Kerja</th>
                                    <th class="border border-black px-4 py-2 text-xs">Nama Kerja</th>
                                    <th class="border border-black px-4 py-2 text-xs">Harga</th>

                                </tr>
                            </thead>


                            <tbody>

                                @foreach ($tugasJengkaut as $tugas)
                                    <tr>
                                        <td class="border border-black px-4 py-2 text-center">
                                            <input type="checkbox" value="{{ $tugas }}" x-model="selectedRows">
                                        </td>
                                        <td class="border border-black px-4 py-2 ">{{ $tugas }}</td>
                                        <td class="border border-black px-4 py-2 text-center">
                                            <p>RM 40</p>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>



                    </div>


                </div>
                <form method="GET" action="/confirm-booking-vehicle" class="flex flex-col ">

                    @csrf
                    <div class="bg-white p-5 rounded-xl shadow-md mt-4 ">
                        <label for="pilih-daerah" class="text-sm">Pilih Daerah :</label>

                        <div class="mb-2">
                            <select name="pilih-daerah"
                                class="w-full border p-2 mt-2 border-black rounded-xl bg-transparent text-gray-600 text-sm">
                                @foreach ($negeri as $n)
                                    <option value="{{ $n }}">{{ $n }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="lokasi-tugas" class="text-sm">Lokasi Tugas :</label>
                        <input type="text" name="lokasi-tugas" required
                            class="w-full border p-2 mt-2 border-black rounded-xl bg-transparent text-gray-600 text-sm">
                        <input type="hidden" name="pilihan-tugas" :value="selectedRows">
                        <input type="hidden" name="jenis-servis" value="Jengkaut">
                        <input type="hidden" name="tarikh-tempahan" value="{{ $tarikhTempahan }}">
                        <input type="hidden" name="keluasan-tanah" value="{{ $keluasanTanah }}">
                        <input type="hidden" name="negeri" value="{{ $negeriPilihan }}">
                    </div>


                    <x-primary-button type="submit" class="mt-8 "
                        @click="showAlert">
                        Sahkan Tempahan
                    </x-primary-button>


                </form>

            </div>

        </div>

    </section>

    <script></script>
@endsection

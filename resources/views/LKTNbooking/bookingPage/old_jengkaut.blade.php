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
    
        {{-- BC01 --}}
        taskNameBC01: 'BC01-CUCI GALI PARIT',
        rateSelectionBC01: 40,
        tempohTempahanBC01: 1,
    
        priceBC01: function() {
            return this.rateSelectionBC01 * this.tempohTempahanBC01;
        },
    
        {{-- BC02 --}}
        taskNameBC02: 'BC02-hello',
        rateSelectionBC02: 40,
        tempohTempahanBC02: 1,
    
        priceBC02: function() {
            return this.rateSelectionBC02 * this.tempohTempahanBC02;
        },
    
        {{-- BC03 --}}
        taskNameBC03: 'BC03-bye',
        rateSelectionBC03: 40,
        tempohTempahanBC03: 1,
    
        priceBC03: function() {
            return this.rateSelectionBC03 * this.tempohTempahanBC03;
        },
    
        {{-- totalPrice: 0, --}}
        remainingHour: {{ $totalHour }},
    
    
        totalHour: function() {
            let hour = 0;
    
            if (this.selectedRows.includes('BC01')) {
                if (parseInt(this.rateSelectionBC01) >= 100) {
                    hour += parseInt(this.tempohTempahanBC01) * 5;
                } else {
                    hour += parseInt(this.tempohTempahanBC01);
                }
            }
    
            if (this.selectedRows.includes('BC02')) {
                if (parseInt(this.rateSelectionBC02) >= 100) {
                    hour += parseInt(this.tempohTempahanBC02) * 5;
                } else {
                    hour += parseInt(this.tempohTempahanBC02);
                }
            }
    
            if (this.selectedRows.includes('BC03')) {
                if (parseInt(this.rateSelectionBC03) >= 100) {
                    hour += parseInt(this.tempohTempahanBC03) * 5;
                } else {
                    hour += parseInt(this.tempohTempahanBC03);
                }
            }
    
            return this.remainingHour - hour;
        },
    
    
    
        totalPrice: function() {
            let total = 0;
    
            if (this.selectedRows.includes('BC01')) {
                total += this.priceBC01();
            }
    
            if (this.selectedRows.includes('BC02')) {
                total += this.priceBC02();
            }
    
            if (this.selectedRows.includes('BC03')) {
                total += this.priceBC03();
            }
    
            return total;
        },
    
        showAlert: function(index) {
            const hour = this.totalHour();
    
            if (hour < 0) {
                alert('Reached Hour Limit');
                event.preventDefault();
            }
    
            if (!this.selectedRows || this.selectedRows.length === 0) {
                alert('No rows selected');
                event.preventDefault();
            }
    
        },
    
        
        postSelectedRows: function() {
    
            let receipt = [];
    
            if (this.selectedRows.includes('BC01')) {
                receipt.push({
                    taskName: this.taskNameBC01,
                    rate: this.rateSelectionBC01,
                    tempoh: this.tempohTempahanBC01,
                    price: this.priceBC01()
                });
            }
    
            if (this.selectedRows.includes('BC02')) {
                receipt.push({
                    taskName: this.taskNameBC02,
                    rate: this.rateSelectionBC02,
                    tempoh: this.tempohTempahanBC02,
                    price: this.priceBC02()
                });
            }
    
            if (this.selectedRows.includes('BC03')) {
                receipt.push({
                    taskName: this.taskNameBC03,
                    rate: this.rateSelectionBC03,
                    tempoh: this.tempohTempahanBC03,
                    price: this.priceBC03()
                });
            }
    
            console.log(receipt);
    
            return JSON.stringify(receipt);
        },
    
    }">
        <div class="flex justify-center">
            <h1 class="font-bold text-xl md:text-2xl">Tempahan Jengkaut</h1>
        </div>


        <div class="flex flex-col items-center mt-8">

            <div class="bg-white p-5 rounded-xl shadow-md">
                <p>Negeri : {{ $negeriPilihan }} </p>
                <p>Tarikh Masuk : {{ $tarikhSewa }} </p>
                <p>Tempoh (Hari): {{ $tempohSewa }} Hari</p>
                <p>Tempoh (Jam): {{ $totalHour }} Jam</p>
                <p>Baki Jam: <span x-text="totalHour"></span> Jam</p>

            </div>

            <div class="flex flex-row max-w-3xl justify-between p-3 items-center gap-x-5 mt-5 ">
                <div>
                    <button class="bg-primary text-white rounded-lg text-xs  p-3 md:p-4">
                        Lihat semua Jentera
                    </button>
                </div>

                <div>
                    <select id="kawasan" name="kawasan" form="passValue"
                        class="border-2 border-black rounded-lg w-28 p-1 h-10 md:h-12 md:w-64 text-gray-600 text-sm">
                        <template x-for="kawasan in kawasans">
                            <option x-text="kawasan" :value="kawasan"></option>
                        </template>
                    </select>
                </div>
            </div>

            <div class="w-5/6 max-w-3xl md:w-auto bg-accent rounded-xl p-5 shadow-xl mt-4 mb-4">
                <div class="  overflow-x-auto ">

                    <table class=" table-auto">
                        <thead>
                            <tr>
                                <th class="border border-black px-4 py-2 text-xs">Pilih Kerja</th>
                                <th class="border border-black px-4 py-2 text-xs">Nama Kerja</th>
                                <th class="border border-black px-4 py-2 text-xs">Kadar Pilihan</th>
                                <th class="border border-black px-4 py-2 text-xs">Tempoh/Kuantiti</th>
                                <th class="border border-black px-4 py-2 text-xs">Harga</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- bc01 --}}
                            <tr>
                                <td class="border border-black px-4 py-2 text-center">
                                    <input type="checkbox" value="BC01" x-model="selectedRows" @change="showAlert">
                                </td>
                                <td class="border border-black px-4 py-2 ">BC01-CUCI GALI PARIT</td>
                                <td class="border border-black px-4 py-2">
                                    <select id="rate" name="rate"
                                        class="border border-black rounded-lg bg-transparent  p-1  text-gray-600 text-xs"
                                        x-model="rateSelectionBC01">
                                        <option value="40">RM 40 per jam</option>
                                        <option value="280">RM 280 per hari</option>
                                    </select>
                                </td>
                                <td class="border border-black px-4 py-2 text-center">
                                    <select id="tempoh" name="tempoh" x-model="tempohTempahanBC01"
                                        class="border border-black rounded-lg bg-transparent  p-1  text-gray-600 text-xs">
                                        <template x-for="i in 7">
                                            <option x-text="i"></option>
                                        </template>
                                    </select>
                                </td>
                                <td class="border border-black px-4 py-2 text-center">
                                    <p x-text="priceBC01" class=" bg-white "></p>
                                </td>
                            </tr>
                            {{-- bc02 --}}
                            <tr>
                                <td class="border border-black px-4 py-2 text-center">
                                    <input type="checkbox" value="BC02" x-model="selectedRows" @change="showAlert">
                                </td>
                                <td class="border border-black px-4 py-2">BC02-GALI KOLAM</td>
                                <td class="border border-black px-4 py-2">
                                    <select id="rate" name="rate" x-model="rateSelectionBC02"
                                        class="border border-black rounded-lg bg-transparent  p-1  text-gray-600 text-xs">
                                        <option value="40">RM 40 per jam</option>
                                        <option value="280">RM 280 per hari</option>
                                    </select>
                                </td>
                                <td class="border border-black px-4 py-2 text-center">
                                    <select id="tempoh" name="tempoh" x-model="tempohTempahanBC02"
                                        class="border border-black rounded-lg bg-transparent  p-1  text-gray-600 text-xs">
                                        <template x-for="i in 7">
                                            <option x-text="i"></option>
                                        </template>
                                    </select>
                                </td>
                                <td class="border border-black px-4 py-2 text-center">
                                    <p x-text="priceBC02" class=" bg-white "></p>
                                </td>
                            </tr>
                            {{-- bc03 --}}
                            <tr>
                                <td class="border border-black px-4 py-2 text-center">
                                    <input type="checkbox" value="BC03" x-model="selectedRows" @change="showAlert">
                                </td>
                                <td class="border border-black px-4 py-2">BC03-CUCI KAWASAN</td>
                                <td class="border border-black px-4 py-2">
                                    <select id="rate" name="rate" x-model="rateSelectionBC03"
                                        class="border border-black rounded-lg bg-transparent  p-1  text-gray-600 text-xs">
                                        <option value="40">RM 40 per jam</option>
                                        <option value="280">RM 280 per hari</option>
                                    </select>
                                </td>
                                <td class="border border-black px-4 py-2 text-center">
                                    <select id="tempoh" name="tempoh" x-model="tempohTempahanBC03"
                                        class="border border-black rounded-lg bg-transparent  p-1  text-gray-600 text-xs ">
                                        <template x-for="i in 7">
                                            <option x-text="i"></option>
                                        </template>
                                    </select>
                                </td>
                                <td class="border border-black px-4 py-2 text-center">
                                    <p x-text="priceBC03" class=" bg-white "></p>
                                </td>
                            </tr>


                        </tbody>


                    </table>

                    <div class="mt-4">
                        <div>
                            <p> Jumlah Harga: RM <span x-text="totalPrice"></span></p>

                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="/payment-page" id="passValue">

                @csrf
                <input type="hidden" name="selectedValue" :value="postSelectedRows">
                <input type="hidden" name="tarikhMasuk" value="{{$tarikhSewa}}">
                <input type="hidden" name="tempohSewa" value="{{$tempohSewa}}">

                

                <div class="flex self-start p-2 gap-7">

                    <div>
                        <button type="submit" class="bg-primary text-white rounded-lg text-xs p-3 md:p-4"
                            @click="showAlert">
                            Sahkan Tempahan
                        </button>
                    </div>
                </div>

            </form>


        </div>
    </section>

    <script></script>
@endsection

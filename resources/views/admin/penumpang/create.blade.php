@extends('admin.app.content')
@section('content')
    <div class="panel">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">Forms Input</h5>
            <a class="font-semibold hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-600" href="javascript:;"
                @click="toggleCode('code5')">
                <span class="flex items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ltr:mr-2 rtl:ml-2">
                        <path
                            d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path opacity="0.5" d="M13.9868 5L10.0132 19.8297" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path
                            d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                    Code
                </span>
            </a>
        </div>
        <div class="mb-5">
            <form class="space-y-5" method="POST" action="{{ route('penumpang.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                    <div>
                        <label for="level">Level</label>
                        <input id="level" name="level" type="text" placeholder="nama plat" class="form-input" autocomplete="">
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input id="harga" name="harga" type="text" placeholder="nama harga" class="form-input" autocomplete="">
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-12 lg:grid-cols-12">
                        <div>
                            <label for="ticket_type_id">Pilih Tiket</label>
                            <select id="ticket_type_id" name="ticket_type_id" class="form-select text-white-dark">
                                <option>Jenis Tiket</option>
                                @foreach ($tiket as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
               
                <button type="submit" class="btn btn-primary !mt-6">Submit</button>
            </form>
        </div>
       
    </div>
@endsection

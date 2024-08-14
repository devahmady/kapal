@extends('admin.app.content')
@section('content')
    <div class="panel">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">Update Route</h5>
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
            <form class="space-y-5" action="{{ route('route.update', $route->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="start_point">Start Point</label>
                        <input type="text" name="start_point" id="start_point" class="form-input" value="{{ old('start_point', $route->start_point) }}" required>
                    </div>
                    <div>
                        <label for="end_point">End Point</label>
                        <input type="text" name="end_point" id="end_point" class="form-input" value="{{ old('end_point', $route->end_point) }}" required>
                    </div>
                </div>
                <div>
                    <label for="jam">Time</label>
                    <input type="time" name="jam" id="jam" class="form-input" value="{{ old('jam', $route->jam) }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            
        </div>
        
    </div>
@endsection

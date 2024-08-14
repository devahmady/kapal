<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s"
            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
            <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
        </div>

        <div class="row g-4">
            @foreach ($rute as $b)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s"
                    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/room-1.jpg" alt="">
                            <small
                                class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">Rp.
                                {{ number_format($b->price, 2, '.', ',') }}</small>
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{ $b->transportation->type }}</h5>
                                <div class="ps-2">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <small class="border-end me-3 pe-3">
                                   {{ $b->start_point }} <i class="fa fa-ship text-primary me-2"></i>{{ $b->end_point }}
                                </small>
                                <small><i class="fa fa-clock text-primary me-2"></i>{{ \Carbon\Carbon::createFromFormat('H:i:s', $b->jam)->format('g:i A') }}</small>
                            </div>
                          
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

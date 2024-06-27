@php
    $room = App\Models\Room::latest()->limit(4)->get();
@endphp
<div class="room-area pt-100 pb-70 section-bg" style="background-color:#ffffff">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">ROOMS</span>
            <h2>Our Rooms & Rates</h2>
        </div>
        <div class="row pt-45">
            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="room-details.html">
                                    <img src="{{ asset('frontend/assets/img/room/room-style-img1.jpg') }}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h3>
                                     <a href="room-details.html">Luxury Room</a>
                                </h3>
                                <span>320 / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> 4 Person</li>
                                    <li><i class='bx bx-expand'></i> 35m2 / 376ft2</li>
                                </ul>

                                <ul>
                                    <li><i class='bx bx-show-alt'></i> Sea Balcony</li>
                                    <li><i class='bx bxs-hotel'></i> Kingsize / Twin</li>
                                </ul>

                                <a href="room-details.html" class="book-more-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($room as $item)
            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="room-details.html">
                                    <img src="{{ asset('frontend/assets/img/room/room-style-img2.jpg') }}" alt="Images">
                                    <img src="{{ asset( 'upload/roomimg/'.$item->image ) }}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h3>
                                     <a href="room-details.html">Single Room</a>
                                     <a href="room-details.html">{{ $item['type']['name'] }}</a>
                                </h3>
                                <span>300 / Per Night </span>
                                <span>{{ $item->price }} / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.</p>
                                <p>{{ $item->short_desc }}</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> 1 Person</li>
                                    <li><i class='bx bx-expand'></i> 25m2 / 276ft2</li>
                   <li><i class='bx bx-user'></i> {{ $item->room_capacity }} Person</li>
                   <li><i class='bx bx-expand'></i> {{ $item->size }}ft2</li>
                                </ul>

                                <ul>
                                    <li><i class='bx bx-show-alt'></i> Sea Balcony</li>
                                    <li><i class='bx bxs-hotel'></i> Smallsize / Twin</li>
        <li><i class='bx bx-show-alt'></i>{{ $item->view }}</li>
        <li><i class='bx bxs-hotel'></i> {{ $item->bed_style }}</li>
                                </ul>

                                <a href="room-details.html" class="book-more-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach


            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="room-details.html">
                                    <img src="{{ asset('frontend/assets/img/room/room-style-img3.jpg') }}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h3>
                                     <a href="room-details.html">Family Room</a>
                                </h3>
                                <span>400 / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> 6 Person</li>
                                    <li><i class='bx bx-expand'></i> 55m2 / 476ft2</li>
                                </ul>

                                <ul>
                                    <li><i class='bx bx-show-alt'></i> Sea Balcony</li>
                                    <li><i class='bx bxs-hotel'></i> Kingsize / Twin</li>
                                </ul>

                                <a href="room-details.html" class="book-more-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="room-details.html">
                                    <img src="{{ asset('frontend/assets/img/room/room-style-img4.jpg') }}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h3>
                                     <a href="room-details.html">Deluxe Room</a>
                                </h3>
                                <span>340 / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed pulvinar purus.</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> 4 Person</li>
                                    <li><i class='bx bx-expand'></i> 45m2 / 376ft2</li>
                                </ul>

                                <ul>
                                    <li><i class='bx bx-show-alt'></i> Sea Balcony</li>
                                    <li><i class='bx bxs-hotel'></i> Kingsize / Twin</li>
                                </ul>

                                <a href="room-details.html" class="book-more-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
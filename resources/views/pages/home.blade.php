@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<!-- <div>
		include('includes.carousel')
	</div> -->
<!--Main layout-->
<main>

    <div class="container">

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

            <!-- Navbar brand -->
            <span class="navbar-brand">Categories:</span>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">All
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Breed</a>
                    </li>

                </ul>
                <!-- Links -->
                <a href="{{ url('/search') }}"><button type="button" class="btn btn-mdb-color">Pet Finder</button></a>
                <form class="form-inline" action="/search/searchpets" method="get">

                    <div class="md-form my-0">

                        <input class="form-control mr-sm-2" name="searchData" id="searchData" type="text"
                            placeholder="Search">



                    </div>
                </form>
            </div>
            <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->

        <!--Section: Products v.3-->
        <section class="text-center mb-4">
            <!--Grid row-->
            <p>Most Liked</p>

            <div class="row wow fadeIn">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4" v-for="like in likes" v-if="like.likeCount > 0"
                    @click="showModal(like)">
                    <!--Card-->
                    <div class="card" data-toggle="modal" data-target="#exampleModalLong">

                        <div class="view overlay">
                            <!--Card image-->
                            <!-- <div class="view overlay">

												</div> -->
                            <img :src="'/images/'+ JSON.parse(like.petImg)[0]" class="card-img-top" alt="" height="175">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                            <!--Card image-->

                            <!--Card content-->
                            <div class="card-body">

                                <h4 class="font-weight-bold blue-text">
                                    <strong>@{{ like.likeCount }}</strong>
                                </h4>
                                <h4 class="font-weight-bold blue-text">
                                    <strong>@{{ like.petName }}</strong>
                                </h4>

                                <h5>
                                    <strong>
                                        <a href="" class="dark-grey-text">@{{ like.breed }}
                                            <!-- <span class="badge badge-pill danger-color">NEW</span> -->
                                        </a>
                                    </strong>
                                </h5>
                            </div>
                            <!--Card content-->

                        </div>


                    </div>
                    <!--Card-->

                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->


            <p>All Pets</p>
            <div class="row wow fadeIn">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4" v-for="pet in pets" @click="showModal(pet)">
                    <!--Card-->
                    <div class="card" data-toggle="modal" data-target="#exampleModalLong">

                        <div class="view overlay">
                            <!--Card image-->
                            <!-- <div class="view overlay">

								</div> -->
                            <img :src="'/images/'+ JSON.parse(pet.petImg)[0]" class="card-img-top" alt="" height="175">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                            <!--Card image-->

                            <!--Card content-->


                            <div class="card-body">

                                <h4 class="font-weight-bold blue-text">
                                    <strong>@{{ pet.petName }}</strong>
                                </h4>

                                <h5>
                                    <strong>
                                        <a href="" class="dark-grey-text">@{{ pet.breed }}
                                            <!-- <span class="badge badge-pill danger-color">NEW</span> -->
                                        </a>
                                    </strong>
                                </h5>
                            </div>
                            <!--Card content-->

                        </div>


                    </div>
                    <!--Card-->

                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->

        </section>
        <!--Section: Products v.3-->


        <!--Pagination-->
        <nav class="d-flex justify-content-center wow fadeIn" v-if="false">
            <ul class="pagination pg-blue">

                <!--Arrow left-->
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>

                <li class="page-item active">
                    <a class="page-link" href="#">1
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">5</a>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!--Pagination-->

    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true" v-if="petDetail">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLongTitle">@{{ petDetail.id }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> <!-- // modal-header -->

                <div class="modal-body">

                    <img class="img-responsive" v-if="petImages" v-for="img in petImages" :src="'/images/'+ img"
                        class="card-img-top" height="175">
                    <hr>

                    <div class="pet-details">
                        <div class="pet-info">

                            <h5>
                                <strong>Name:</strong>
                                <span>
                                    @{{ petDetail.petName }}
                                </span>
                            </h5>
                            <h5>
                                <strong>Breed:</strong>
                                <span>
                                    @{{ petDetail.breed }}
                                </span>
                            </h5>
                            <h5>
                                <strong>Birth:</strong>
                                <span>
                                    @{{ petDetail.petBirth | formatDate }}
                                </span>
                            </h5>
                            <h5>
                                <strong>Owner:</strong>
                                <span>
                                    @{{ petDetail.petOwner }}
                                </span>
                            </h5>
                            <h5>
                                <strong>Address:</strong>
                                <span>
                                    @{{ petDetail.address }}
                                </span>
                            </h5>
                            <h5>
                                <strong>Description:</strong>
                                <span>
                                    @{{ petDetail.description }}
                                </span>
                            </h5>

                            <h5>
                                <strong>Likes:</strong>
                                <span>
                                    @{{ petDetail.likeCount }}
                                </span>
                            </h5>


                        </div>
                        <div class="pet-comments">

                            <div class="pet-comments-inner">
                                <h5>
                                    <h6 v-for="comment in comments">
                                        "@{{ comment.petComment }}" name:
                                        <span class="font-weight-bold blue-text">
                                            @{{ comment.username }}
                                        </span>

                                    </h6>
                                </h5>
                            </div>

                            <!-- Comment section  modal-->
                            <form method="get" class="form" :action="'/pet/commentPet/' + petDetail.id">

                                <div class="com-inpt">
                                    <input type="text" name="petComment" id="petComment" class="form-control"
                                        placeholder="Comment" required rows="3"></textarea>
                                </div>

                                <div class="com-btn">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>


                            </form>
                            <!-- Comment section -->
                        </div> <!-- // pet-comments -->




                    </div>






                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form method="get" class="form" :action="'/pet/likePet/' + petDetail.id">
                        <button type="submit" class="btn btn-primary">Like</button>
                    </form>


                    <form method="get" class="form" :action="'/pet/getUserRequest/' + petDetail.id">
                        <button type="submit" class="btn btn-primary">Request</button>
                    </form>

                </div> <!-- // modal-footer -->
            </div>
        </div> <!-- // modal-dialog -->
    </div> <!-- // modal -->
</main>
<!--Main layout-->

{{-- 	
		@if(session('success'))
		<script>alert('No data found');</script>
		{{ redirect('home') }}
@endif --}}

@endsection

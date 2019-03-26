@extends ('layouts.app')
@section('title', 'Home - Recommended')

@section('content')


<main id="body">

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

                <form class="form-inline">
                    <div class="md-form my-0">
                        <a href="{{ url('/search') }}"><button type="button" class="btn btn-mdb-color">Pet
                                Finder</button></a>
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    </div>
                </form>
            </div>
            <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->
        <!--Section: Products v.3-->
        <section class="text-center mb-4">
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
            </div>
            <!--Grid row-->

            <p>Recommended</p>
            <div class="row">
                @foreach($result as $value)
                @php
                $comment = DB::table('comments')->where('pet_id',$value->id)->get()->toArray();
                $likes = DB::table('likes')->where('pet_id',$value->id)->get()->toArray();
                @endphp
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4">
                    <!--Card-->
                    <div class="card" data-toggle="modal" data-target="#petLogin{{$value->id}}" data-comments=""
                        data-id="{{$value->id}}" data-name="{{ $value->petName }}" data-breed="{{$value->breed}}"
                        data-birth="{{$value->petBirth}}" data-owner="{{$value->petOwner}}"
                        data-address="{{$value->address}}" data-description="{{$value->description}}"
                        data-image="/images/{{$value->petImg[0]}}">

                        <div class="view overlay">
                            <!--Card image-->
                            <!-- <div class="view overlay">

								</div> -->
                            <img src="/images/{{$value->petImg[0]}}" class="card-img-top" alt="" height="175">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                            <!--Card image-->

                            <!--Card content-->


                            <div class="card-body">

                                <h4 class="font-weight-bold blue-text">
                                    <strong>{{ $value->petName }}</strong>
                                </h4>

                                <h5>
                                    <strong>
                                        <a href="" class="dark-grey-text">{{ $value->breed }}
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
                <!-- Modal -->
                <div class="modal fade text-left" id="petLogin{{$value->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $value->id }}</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> <!-- // modal-header -->

                            <div class="modal-body">

                                <img id="petimage" src="/images/{{$value->petImg[0]}}" class="img-responsive"
                                    class="card-img-top" height="175">
                                <hr>

                                <div class="pet-details">
                                    <div class="pet-info">
                                        <h5>
                                            <strong>Name:</strong>
                                            <span id="petname">
                                                {{$value->petName}}
                                            </span>
                                        </h5>
                                        <h5>
                                            <strong>Breed:</strong>
                                            <span id="petbreed">
                                                {{$value->breed}}
                                            </span>
                                        </h5>
                                        <h5>
                                            <strong>Birth:</strong>
                                            <span id="petbirth">
                                                {{$value->petBirth}}
                                            </span>
                                        </h5>
                                        <h5>
                                            <strong>Owner:</strong>
                                            <span id="petowner">
                                                {{$value->petOwner}}
                                            </span>
                                        </h5>
                                        <h5>
                                            <strong>Address:</strong>
                                            <span id="petaddress">
                                                {{$value->address}}
                                            </span>
                                        </h5>
                                        <h5>
                                            <strong>Description:</strong>
                                            <span id="petdescription">
                                                {{$value->description}}
                                            </span>
                                        </h5>

                                        <h5>
                                            <strong>Likes:</strong>
                                            <span id="petlikes">
                                                {{count($likes)}}
                                            </span>
                                        </h5>


                                    </div>

                                    <div class="pet-comments">

                                        <div class="pet-comments-inner">
                                            <h5 id="comment_content">
                                                @for($i=0; $i<count($comment); $i++) <h6>
                                                    "{{$comment[$i]->petComment}}" <strong>name</strong>
                                                    <span id="comment_author" class="font-weight-bold blue-text">
                                                        {{$comment[$i]->username}}
                                                    </span>

                                                    </h6>
                                                    @endfor
                                            </h5>
                                        </div>

                                        <!-- Comment section  modal-->
                                        <form method="get" id="petcomment" class="form"
                                            action="/pet/commentPet/{{$value->id}}">

                                            <div class="com-inpt">
                                                <input type="text" name="petComment" id="petComment"
                                                    class="form-control" placeholder="Comment" required
                                                    rows="3"></textarea>
                                            </div>

                                            <div class="com-btn">
                                                <button type="submit" class="btn btn-primary">Send Message</button>
                                            </div>


                                        </form>
                                        <!-- Comment section -->
                                    </div> <!-- // pet-comments -->


                                </div>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <form method="get" class="form" action="/pet/likePet/{{ $value->id }}">
                                    <button type="submit" class="btn btn-primary">Like</button>
                                </form>


                                <form method="get" class="form" :action="'/pet/getUserRequest/' + petDetail.id">
                                    <button type="submit" class="btn btn-primary">Request</button>
                                </form>

                            </div> <!-- // modal-footer -->
                        </div>
                    </div> <!-- // modal-dialog -->
                </div> <!-- // modal -->
                @endforeach
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

        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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

    </div>

</main>
<!--Main layout-->



@endsection

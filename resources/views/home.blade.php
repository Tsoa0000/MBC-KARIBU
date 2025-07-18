@include("partials.header")
@include("partials.navbar")
@include("partials.footer")

<div id="carouselExampleFade" class="carousel slide carousel-fade ">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="assets/image/f1.jpg" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
        <img src="assets/image/f2.jpg" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
        <img src="assets/image/f3.jpg" class="d-block w-100" alt="">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

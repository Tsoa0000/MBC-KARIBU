@include("partials.header")
@include("partials.footer")

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Message:</label>
                    <textarea name="message" class="form-control" cols="10" rows="10"></textarea>
                </div>
                <button type="submit" name="envoyer" class="btn btn-primary w-100 ">Envoyer</button>
            </form>
        </div>
    </div>
</div>

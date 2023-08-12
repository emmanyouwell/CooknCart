<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="container my-3">
        <h1 class="display-1">CooknCart</h1>
        
        <br><strong><h2 class="fw-bold">Your order {{$track}} has been cancelled.</h2></strong>
        <br>
        <p class="fw-normal">
            Hi {{$customer}},<br> <br>
            This email confirms that your order with the ID of {{$track}}, has been cancelled. We're sorry for the inconvenience.
        </p>

        <p class="fw-bold lead">You won't be charged for any items.</p>
        <p class="fw-normal">If you cancelled this order, it means you haven't paid anything and the order status is still pending. If you have requested us to cancel this order, then you will be refunded. Questions about refunds are covered in our <a href="#">Refunds Policy</a>.</p>
        {{-- <p class="fw-bold lead">
            Made a mistake? Having second thoughts?
        </p>
        <p class="fw-normal">
            If you believe this cancellation is an error, or you have questions about your account, please visit <a href="#">https://cookncart.support</a>.Order mo nalang ulit lods. Ito link oh -> <a href="#">https://xzcvxsd.com</a>
        </p> --}}
        <p class="fw-bold lead">
            Help us improve
        </p>
        <p class="fw-normal">
            We'd love to know why you cancelled. We're always looking for ways to get better. If you have a feedback you think would be useful, please take this <a href="#">cancellation survey</a>.
        </p>

        <p class="lead">
            Thanks again for being our customer.
        </p>
        <p class="lead">Contact us</p>
        <a href="#">https://cookncart.com</a>
    </div>
</body>
</html>
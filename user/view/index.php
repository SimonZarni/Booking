<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/MovieController.php';
include_once __DIR__ . '/../controller/BookingController.php';

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row upcome_2 mt-4">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <div class="upcome_2i row">
                        <?php foreach ($movies as $movie) : ?>
                            <div class="col-md-3">
                                <div class="upcome_2i1 clearfix position-relative">
                                    <div class="movie_img clearfix">
                                        <img src="../../admin/uploads/<?php echo $movie['image']; ?>" style="height:350px; width:260px">
                                    </div>
                                    <div class="upcome_2i1i1 clearfix position-absolute top-0 text-center mx-5">
                                        <h6 class="text-uppercase"><a class="button_1" href="">View Trailer</a></h6>
                                        <h6 class="text-uppercase mb-0"><a class="button_2" href="movie_details.php?id=<?php echo $movie['id']; ?>">View Details</a></h6>
                                    </div>
                                </div>
                                <div class="upcome_2i_last bg-white p-3">
                                    <div class="upcome_2i_lasti row">
                                        <div class="col-md-6">
                                            <div class="upcome_2i_lastil">
                                                <h5><a href=""><?php echo $movie['name']; ?></a></h5>
                                                <h6 class="text-muted"><?php echo $movie['category_name']; ?></h6>
                                                <h6 class="text-muted"><?php echo $movie['duration']; ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="add_cart pt-3">
                                                <span><a class="col_red rounded" href="booking.php?id=<?php echo $movie['id']; ?>"><i class="fa fa-book"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include_once __DIR__ . '/../layouts/footer.php';
?>
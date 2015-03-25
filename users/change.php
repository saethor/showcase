<?php 
require_once '../app/init.php';

$image = $db_man->getImageInfo($_GET['id']);
$redirect =  $redirect = $path . 'users/';

if (!(isset($_GET['id']) && !empty($image))) 
{
    // If there is no image id ore image is not available user is redirected
    header("Location: {$redirect}?error=yes");
    exit;
}

if (isset($_POST['save']))
{
    $imageId        = $_POST['image-id'];
    $imageName      = $_POST['image-name'];
    $imagePath      = $image[2];
    $imageText      = $_POST['image-text'];
    $imageCategorie = $_POST['image-categorie'];

    $db_man->updateImageInfo($imageId, $imageName, $imagePath, $imageText, $imageCategorie);

    header("Location: {$redirect}");
    exit;
}

if (isset($_POST['create']))
{
    $imageId        = $_POST['image-id'];
    $imageName      = $_POST['image-name'];
    $imagePath      = $image[2];
    $imageText      = $_POST['image-text'];
    $imageCategorie = $_POST['image-categorie'];
    $newCategorie   = $_POST['new-categorie'];

    $db_man->newCategory($newCategorie);

    $image[0] = $imageId;
    $image[1] = $imageName;
    $image[2] = $imagePath;
    $image[3] = $imageText;
    $image[4] = $newCategorie;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="<?php echo $path; ?>assets/stylesheets/main.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar -->
    <?php include '../includes/nav.inc.php'; ?>
    
    <section class="section-contact" id="section-contact">
        <div class="row">
            <h2 class="section-title">Change image information</h2>

            <div class="col-xs-12 col-md-6 col-lg-4">
                <img src="<?= $image[2]; ?>" alt="<?= $image[3] ?>" class="img-responsive">
            </div>

            <div class="col-xs-12 col-md-6 col-lg-8">
                <form action="" method="post"> 
                    <input type="hidden" name="image-id" value="<?= $image[0] ?>">

                    <div class="form-group">
                        <label for="image-name">Image Name</label>
                        <input type="text" name="image-name" class="form-control" id="image-name" value="<?= $image[1]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="image-text">Image text</label>
                        <textarea name="image-text" id="image-text" class="form-control" cols="30" rows="10"><?= $image[3]; ?></textarea>
                    </div>

                    <div class="form-group row">
                        <!-- Choose from existing categorie -->
                        <div class="col-sm-6">
                            <label for="image-categorie">Image Categorie</label>
                            <select name="image-categorie" id="image-categorie" class="form-control">
                                <?php foreach ($db_man->categoryList() as $categorie): ?>
                                    <option value="<?= $categorie[0] ?>" <?= ($categorie[1] == $image[4]) ? 'selected' : ''; ?> >
                                        <?= $categorie[1] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>  
                        </div>

                        <!-- Create a new one -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="new-categorie">Create new categorie</label>
                                <div class="input-group">

                                    <input type="text" name="new-categorie" class="form-control">
                                    <span class="input-group-btn">
                                        <input type="submit" name="create" value="Create" class="btn btn-primary">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="submit" name="save" value="Save" class="btn btn-success btn-lg pull-right"></input>

                </form>
            </div>
        </div>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo $path ?>assets/javascripts/bootstrap.min.js"></script>
<script>
    $(function(){

        $('.contact .form-group .form-control').focusout(function() {

            var text_val = $(this).val();

            if(text_val === "") {
                $(this).removeClass('has-value');
            } else {
                $(this).addClass('has-value');
            }

        });

    });
</script>
</body>
</html>

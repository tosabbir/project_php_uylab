<?php
require_once('functions/admin_function.php');

// header part here 
get_header();

// sidebar part here 
get_sidebar();

// store data in variable from form 
if (!empty($_POST)) {
    $portfolio_name = $_POST['portfolio_name'];
    $portfolio_title = $_POST['portfolio_title'];
    $portfolio_text = $_POST['portfolio_text'];
    $button_link = $_POST['button_link'];
    $button_text = $_POST['button_text'];

    $portfolio_image = $_FILES['portfolio_image'];
    $portfolio_icon = $_POST['portfolio_icon'];
    $portfolio_category_id = $_POST['portfolio_category_name'];

    // user image custome name set from here 
    if ($portfolio_image['name'] != '') {
        $imageCustomeName = 'portfolio_' . time() . '_' . rand(10000, 1000000) . '.' . pathinfo($portfolio_image['name'], PATHINFO_EXTENSION);
    }

    // empty validation here 
    if (!empty($portfolio_name)) {

        // create protfolio slug 
        $portfolio_slug = strtolower(str_replace(' ', '-', $portfolio_name));

        if (!empty($portfolio_title)) {
            if (!empty($portfolio_icon)) {
                if (!empty($portfolio_text)) {
                    if (!empty($button_link)) {
                        if (!empty($button_text)) {
                            if (!empty($portfolio_image['name'])) {
                                if (!empty($portfolio_category_id)) {
                                    $imageCustomeName = 'portfolio_' . time() . '_' . rand(10000, 1000000) . '.' . pathinfo($portfolio_image['name'], PATHINFO_EXTENSION);
                                    // insert query here 
                                    $insert = "INSERT INTO portfolios(portfolio_name,portfolio_slug,portfolio_title,portfolio_icon,portfolio_text,button_link,button_text,portfolio_image, portfolio_category_id)
                                     VALUES('$portfolio_name','$portfolio_slug','$portfolio_title','$portfolio_icon','$portfolio_text','$button_link','$button_text','$imageCustomeName','$portfolio_category_id')";

                                    // insert query run or data insert here 
                                    if (mysqli_query($con, $insert)) {

                                        move_uploaded_file($portfolio_image['tmp_name'], 'uploads/' . $imageCustomeName);

                                        header('Location: all_portfolio.php');
                                        $_SESSION['success'] = "portfolio Insert successful";
                                    } else {
                                        $_SESSION['success'] = "Ops! portfolio Insert failed";
                                    }
                                } else {
                                    $portfolio_category_name_error = "Please Select portfolio Category";
                                }
                            } else {
                                $portfolio_image_error = "Please Select portfolio Image";
                            }
                        } else {
                            $button_text_error = "Please enter Button Text";
                        }
                    } else {
                        $button_link_error = "Please enter portfolio Link";
                    }
                } else {
                    $portfolio_text_error = "Please enter portfolio Text";
                }
            } else {
                $portfolio_icon_error = "Please enter portfolio Icon";
            }
        } else {
            $portfolio_title_error = "Please Enter portfolio Title";
        }
    } else {
        $portfolio_name_error = "Please Enter portfolio Name";
    }
}

?>
<!-- // main content here  -->
<div class="main-wrapper">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-30">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4 class="font-20">Add portfolios</h4>

                                <div class="d-flex flex-wrap">

                                    <!-- start add new portfolio btn  -->
                                    <div class="dropdown-button mt-3 mt-sm-0">
                                        <a href="all_portfolio.php" type="button" class="btn style--two orange">All portfolio</a>
                                    </div>
                                    <!-- end add new portfolio btn  -->
                                </div>
                            </div>
                            <br>
                            <div class="edit-personal-info mb-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="mb-3">portfolio Information</h4>
                                    </div>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="portfolio_name">portfolio Name</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" id="portfolio_name" class="form-control <?php if (isset($portfolio_name_error)) echo 'is-invalid' ?>" name="portfolio_name" value="<?php if (isset($_POST['portfolio_name'])) echo  $_POST['portfolio_name'] ?>">

                                            <?php
                                            if (isset($portfolio_name_error)) {
                                            ?>
                                                <span class="text-danger"></span><?= $portfolio_name_error; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="portfolio_title">portfolio Title</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" id="portfolio_title" class="form-control <?php if (isset($portfolio_title_error)) echo 'is-invalid' ?>" name="portfolio_title" value="<?php if (isset($_POST['portfolio_title'])) echo  $_POST['portfolio_title'] ?>">

                                            <?php
                                            if (isset($portfolio_title_error)) {
                                            ?>
                                                <span class="text-danger"></span><?= $portfolio_title_error; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="portfolio_icon">portfolio Icon</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" id="portfolio_icon" class="form-control <?php if (isset($portfolio_icon_error)) echo 'is-invalid' ?>" name="portfolio_icon" value="<?php if (isset($_POST['portfolio_icon'])) echo  $_POST['portfolio_icon'] ?>">

                                            <?php
                                            if (isset($portfolio_icon_error)) {
                                            ?>
                                                <span class="text-danger"></span><?= $portfolio_icon_error; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="portfolio_icon"></label>
                                        </div>
                                        <div class="col-9" style="height: 100px; overflow: scroll;">
                                            <!-- all icon show here  -->
                                            <?php
                                            require_once('all_icon_class.php');

                                            foreach ($fonts as $key => $font) {


                                            ?>

                                                <i class="<?= 'fa' . ' ' . $font ?>" value="<?= 'fa' . ' ' . $font ?>" onclick="showValue('<?= 'fa' . ' ' . $font ?>')"></i>

                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="portfolio_text">portfolio Text</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="phone" class="form-control <?php if (isset($portfolio_text_error)) echo 'is-invalid' ?>" id="portfolio_text" name="portfolio_text" value="<?php if (isset($_POST['portfolio_text'])) echo  $_POST['portfolio_text'] ?>">
                                            <?php
                                            if (isset($portfolio_text_error)) {
                                            ?>
                                                <span class="text-danger"></span><?= $portfolio_text_error; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="button_link">Button Link</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="phone" class="form-control <?php if (isset($button_link_error)) echo 'is-invalid' ?>" id="button_link" name="button_link" value="<?php if (isset($_POST['button_link'])) echo  $_POST['button_link'] ?>">
                                            <?php
                                            if (isset($button_link_error)) {
                                            ?>
                                                <span class="text-danger"></span><?= $button_link_error; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="button_text">Button Text</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="phone" class="form-control <?php if (isset($button_text_error)) echo 'is-invalid' ?>" id="button_text" name="button_text" value="<?php if (isset($_POST['button_text'])) echo  $_POST['button_text'] ?>">
                                            <?php
                                            if (isset($button_text_error)) {
                                            ?>
                                                <span class="text-danger"></span><?= $button_text_error; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="portfolio_image">portfolio Image</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="file" class="" id="portfolio_image" name="portfolio_image" onchange="show_update_btn()">

                                            <?php
                                            if (isset($portfolio_image_error)) {
                                            ?>
                                                <span class="text-danger"></span><?= $portfolio_image_error; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group row align-items-center">
                                        <div class="col-3">
                                            <label for="portfolio_category_name">Portfolio Category</label>
                                        </div>
                                        <div class="col-9">
                                            <select class="theme-input-style" id="exampleSelect1" name="portfolio_category_name">
                                                <option value="">Select Category</option>

                                                <?php
                                                $selrq = "SELECT * FROM portfolio_categoty ORDER BY id ASC";
                                                $selr = mysqli_query($con, $selrq);

                                                while ($portfolio_category = mysqli_fetch_assoc($selr)) {
                                                ?>

                                                    <option value="<?= $portfolio_category['id'] ?>"><?= $portfolio_category['portfolio_categoty_name'] ?></option>

                                                <?php
                                                }

                                                ?>
                                                <?php
                                                if (isset($user_portfolio_category_name_error)) {
                                                ?>
                                                    <span class="text-danger"></span><?= $user_portfolio_category_name_error; ?></span>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <div class="button-group pt-1 m-auto" id="portfolio_data_update_btn">
                                        <button type="reset" class="link-btn bg-transparent mr-3 soft-pink" id="update_cancel_btn" onclick="hide_user_data_update_btn()">Cancel</button>

                                        <button type="submit" class="btn btn-sm">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- // main content end here  -->
</div>
<?php
// footer part here 
get_footer();
?>

<script>
    function showValue(a) {

        $font_class = a;

        $portfolio_icon = document.getElementById('portfolio_icon');

        $portfolio_icon.setAttribute('value', $font_class)
        document.getElementById('portfolio_data_update_btn').style.display = "block";

    }
</script>
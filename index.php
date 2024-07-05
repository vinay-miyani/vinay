<?php
include "header.php";

$res = getdatewisedata($conn);
?>
<div class="container">
    <div class="form-row">
        <form action="" method="post" class="col-md-12 post-filter-form">
            <div class="form-row">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control search-article" placeholder="Search articles">
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-control sort-order">
                        <option value="desc">Newest First</option>
                        <option value="asc">Oldest First</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="sort-data" class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </form>
    </div>
    <button class="btn btn-primary mb-4 my-2"><a href="add_article.php" class="text-light">Add Article</a></button>
    <div class="row append-article">
        <?php while ($row = mysqli_fetch_assoc($res)) {
            echo artical_html($row); ?>
        <?php } ?>
    </div>
</div>
<?php
include "footer.php";
?>
<?php
include "config.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $slug = $_POST['slug'];
    $date = date('Y-m-d H:i:s');

    if ($id) {
        $sql = "UPDATE article SET title = '$title', description = '$description', category = '$category', slug = '$slug', date = '$date' WHERE id = '$id'";
    } else {
        $sql = "INSERT INTO article (title, description, category, slug, date) VALUES ('$title', '$description', '$category', '$slug', '$date')";
    }
    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("Location: index.php");
        exit();
    }
}
if (isset($_POST['op']) && $_POST['op'] == "delete") {
    $id = $_POST['id'];
    $sql = "DELETE FROM article WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}

if (isset($_POST['op']) && $_POST['op'] == "search-article") {
    $search = $_POST['search'];
    $sortOrder = $_POST['sortOrder'];
    $sql = "SELECT * FROM article WHERE category LIKE '%$search%' OR title LIKE '%$search%' OR description LIKE '%$search%' ORDER BY date $sortOrder";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        echo artical_html($row);
    }
    exit;
}


function artical_html($row)
{
    $formatted_date = date('F j, Y, g:i a', strtotime($row['date']));

    return '<div class="col-md-12 article-container remove-article">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                            <p class="card-text">' . $formatted_date . '</p>
                            <p class="card-text">' . nl2br(htmlspecialchars($row['description'])) . '</p>
                            <p class="card-text"><small class="text-muted">' . htmlspecialchars($row['category']) . '</small></p>
                            <p class="card-text"><small class="text-muted">' . htmlspecialchars($row['slug']) . '</small></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="add_article.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <button class="btn btn-sm btn-outline-secondary delete" data-id="' . $row['id'] . '">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
}

function getData($id, $conn)
{
    $sql = "SELECT * FROM article WHERE id ='$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    return $row;
}

function getdatewisedata($conn)
{
    $sql = "SELECT * FROM article ORDER BY date DESC";
    $res = mysqli_query($conn, $sql);
    return $res;
}

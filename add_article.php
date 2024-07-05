<?php
include "header.php";
$id = isset($_GET['id']) ? $_GET['id'] : '';
$title = '';
$description = '';
$category = '';
$slug = '';
if ($id) {
    $articleData = getData($id, $conn);
    $id = $articleData['id'];
    $title = $articleData['title'];
    $description = $articleData['description'];
    $category = $articleData['category'];
    $slug = $articleData['slug'];
}
?>
<h2 class="form-title"><?php echo $id ? 'Edit Article' : 'Add Article'; ?></h2>
<form action="" method="post" enctype="multipart/form-data" class="styled-form">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter title" value="<?php echo $title; ?>">
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Enter description" rows="3"><?php echo $description; ?></textarea>
    </div>
    <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" name="category" class="form-control">
            <option value="Food" <?php if ($category == 'Food') echo 'selected'; ?>>Food</option>
            <option value="Educations" <?php if ($category == 'Educations') echo 'selected'; ?>>Educations</option>
            <option value="Businessmen" <?php if ($category == 'Businessmen') echo 'selected'; ?>>Businessmen</option>
            <option value="Positions" <?php if ($category == 'Positions') echo 'selected'; ?>>Positions</option>
        </select>
    </div>
    <div class="form-group">
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" placeholder="Enter slug" value="<?php echo $slug; ?>">
    </div>
    <input type="submit" name="submit" value="submit">
</form>
<?php
require_once "function.php";
$con = opendb('CONNECTION');

session_start();

if(!isset($_SESSION['cUsername'])){
  header("Location: login.php");
};

$id = $_GET['id'];

$sql = "select id, image, content, title, category, insert_user, updated_at, status from emading.tbl_articles where id='$id'";
$rs = myQuery($con, $sql);
$rc = fetch($rs, 'name');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eMading - Edit Article</title>
    <?php
    include "header.php";

    ?>
</head>
<script>
    // Function Edit Article
    function edit_article(btn,id) {
        const selectedFile = $('#cover')[0].files[0];
        const title = $('#title').val();

        if(title == null || title == ''){
            Swal.fire({
                            position: "center",
                            icon: "error",
                            title:  "Required Title!",
                            showConfirmButton: false,
                            timer: 1000
                        });
            return;
        }

        const contents = $("trix-editor").find('div').html();

        var formData = new FormData();;
        formData.append('id', id);
        formData.append('title', title);
        formData.append('category', $('#category').val());
        formData.append('content', $('.textarea').summernote('code'));
        if(selectedFile == undefined){
            formData.append('cover', $('#img').attr('src'));
        }else{
            formData.append('cover', selectedFile);
        }
        formData.append('status', btn);
        
        $.ajax({
            url: 'edit-article-script.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data) {
                Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "successful!",
                            showConfirmButton: false,
                            timer: 1000
                        });
                setTimeout(() => {
                    window.location.href = 'article.php';
                }, 1000);
            },
            error: function(e) {
                Swal.fire({
                            position: "center",
                            icon: "error",
                            title:  "failed!",
                            showConfirmButton: false,
                            timer: 1000
                        });
            }
        });
    }
</script>
<style>
    .select2 {
        width: 100% !important;
    }

    .select2-selection {
        height: 100% !important;
        padding: 5px 10px !important;
    }

    .select2-selection__rendered {
        text-align: left !important;
        padding: 0px !important;
    }

    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php
    include 'menu.php';
    ?>

    <!-- Section -->
    <section class="content">
        <div class="content-wrapper">   
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Edit Article</h1>
                        </div>
                    </div>
                    <div class="row mt-5 d-flex justify-content-center p-5">
                        <div class="card-form p-5 mb-4" style="width:80%;background-color: #F3F0CA;border-radius:10px;border:1px solid #E1AA74">
                            <h2 class="text-center mb-5" style="font-weight: 550;">Article</h2>
                            <form role="form" enctype="multipart/form-data" style="width:100%">
                                <div class="form-group row">
                                    <div class="col-lg-12 pl-0 d-flex justify-content-between">
                                        <p class="pl-2">Status  : <?= $rc['status'] ?></p>
                                        <p class="pl-2">Last Updated : <?= $rc['updated_at'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-between">
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <label for="title" class="mb-0" style="font-size:20px">Title</label>
                                    </div>
                                    <div class="col-lg-8 pl-0">
                                        <input type="text" name="title" class="form-control" id="title" value="<?= $rc['title'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-between">
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <label for="category" class="mb-0" style="font-size:20px">Category</label>
                                    </div>
                                    <div class="col-lg-8 pl-0">
                                        <select class="category" name="category" id="category">
                                            <option value="<?= $rc['category'] ?>"><?= $rc['category'] ?></option>
                                                <?php
                                                $sql1 = "select distinct category from emading.tbl_articles LIMIT 10";
                                                $rst = myQuery($con, $sql1);
                                                while ($rec1 = fetch($rst, "name")) {
                                                    $category = $rec1['category'];
                                                    echo "<option value='" . $category . "'>" . $category . "</option>\n";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-between">
                                    <div class="col-lg-2">
                                        <label for="content" class="mb-0" style="font-size:20px">Content</label>
                                    </div>
                                    <div class="col-lg-8 pl-0">
                                        <textarea class="textarea" placeholder="Place some text here"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row d-flex justify-content-between">
                                    <div class="col-lg-2">
                                        <label for="cover" class="mb-0" style="font-size:20px">Cover</label>
                                    </div>
                                    <div class="col-lg-8 pl-0">
                                        <div id="imagePreview" class="mt-5">

                                        </div>
                                        <input class="custom-file-input border-0 text-right" type="file" name="file" id="cover" accept="image/*">
                                        <label class="custom-file-label" id="fileLabel" for="cover" style="width: max-width; overflow: hidden">No image chosen</label>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="button" class="btn pl-3 pr-3 mb-2 mt-2 mr-2" id="draft" style="background-color: #706233;color:#FFFFDD;font-weight:600" onclick="edit_article(this.id,<?= $rc['id'] ?>)">Save As Draft</button>
                                    <button type="button" class="btn pl-3 pr-3 mb-2 mt-2" id="upload" style="background-color: #706233;color:#FFFFDD;font-weight:600" onclick="edit_article(this.id,<?= $rc['id'] ?>)">Upload Article</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>

    <script>
        $(document).ready(function() {

            var responseData = '<?= $rc['content']?>';

                $('.textarea').summernote({
                    codeviewFilter: false,
                    codeviewIframeFilter: true,
                    callbacks: {
                        onInit: function () {
                            $('.textarea').summernote('code', responseData);
                        }
                    }
                });
 
            $("#category").selectize({
                persist: false,
                maxItems: 1,
                create: function(input) {
                    return {
                        value: input,
                        text: input,
                    };
                }
            });

            const fileInput = $('#cover');

            function updateLabel() {
                const label = $('.custom-file-label');
                const textWarning = $('.text-upload');

                if (fileInput[0].files.length > 0) {
                    label.text(fileInput[0].files[0].name);
                    textWarning.html('');
                } else {
                    label.text('Choose File');
                }
            }

            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        $("#imagePreview").html(`<img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px;" />`);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function ToggleBtn() {
                const title = $('#title').val();
                const category = $('#category').val();

                if (category !== '' && title !== '') {
                    $('#upload').prop("disabled", false);
                } else {
                    $('#upload').prop("disabled", true);
                }
            }

            $('#title, #category, #description').on('keyup change', function() {
                ToggleBtn();
            });

            $('#cover').on('change', function() {
                ToggleBtn();
                const fileInput = this;
                const maxSize = 1024 * 1024;

                if (fileInput.files.length > 0) {
                    const fileSize = fileInput.files[0].size;
                    if (fileSize > maxSize) {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Oops..",
                            text: "File size exceeds the maximum limit of 1MB.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#cover').val('');
                        $('.custom-file-label').text('Upload New Image');
                        $("#imagePreview").html(``);
                    }else{
                        updateLabel();
                        previewImage(this);
                    }
                }
            });
        });
    </script>
    <?php
    include 'footer.php';
    ?>
</body>
</html> 